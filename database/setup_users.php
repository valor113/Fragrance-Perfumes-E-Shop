<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require dirname(__DIR__) . '/app/Core/Autoloader.php';

use App\Core\Autoloader;
use App\Core\Database;

Autoloader::register();

$db = Database::getConnection();

$columnExists = static function (\PDO $db, string $column): bool {
    $statement = $db->prepare(
        "SELECT COUNT(*)
         FROM information_schema.COLUMNS
         WHERE TABLE_SCHEMA = DATABASE()
           AND TABLE_NAME = 'users'
           AND COLUMN_NAME = :column"
    );
    $statement->execute(['column' => $column]);

    return (int) $statement->fetchColumn() > 0;
};

$indexExists = static function (\PDO $db, string $index): bool {
    $statement = $db->prepare(
        "SELECT COUNT(*)
         FROM information_schema.STATISTICS
         WHERE TABLE_SCHEMA = DATABASE()
           AND TABLE_NAME = 'users'
           AND INDEX_NAME = :index"
    );
    $statement->execute(['index' => $index]);

    return (int) $statement->fetchColumn() > 0;
};

$db->exec(
    "CREATE TABLE IF NOT EXISTS users (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(190) NOT NULL,
        phone_number VARCHAR(30) NOT NULL DEFAULT '',
        password_hash VARCHAR(255) NOT NULL,
        role VARCHAR(20) NOT NULL DEFAULT 'user',
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_users_username (username),
        UNIQUE KEY uq_users_email (email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
);

$requiredColumns = [
    'username' => "VARCHAR(50) NOT NULL AFTER `id`",
    'email' => "VARCHAR(190) NOT NULL AFTER `username`",
    'phone_number' => "VARCHAR(30) NOT NULL DEFAULT '' AFTER `email`",
    'password_hash' => "VARCHAR(255) NOT NULL AFTER `phone_number`",
    'role' => "VARCHAR(20) NOT NULL DEFAULT 'user' AFTER `password_hash`",
    'created_at' => "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `role`",
];

foreach ($requiredColumns as $column => $definition) {
    if (!$columnExists($db, $column)) {
        $db->exec("ALTER TABLE `users` ADD COLUMN `{$column}` {$definition}");
    }
}

// Keep every existing role, including any privileged role, and set the default for new users.
$db->exec("UPDATE `users` SET `role` = 'user' WHERE `role` IS NULL OR `role` = ''");
$db->exec("ALTER TABLE `users` MODIFY COLUMN `role` VARCHAR(20) NOT NULL DEFAULT 'user'");

if (!$indexExists($db, 'uq_users_username')) {
    $db->exec("ALTER TABLE `users` ADD UNIQUE KEY `uq_users_username` (`username`)");
}

if (!$indexExists($db, 'uq_users_email')) {
    $db->exec("ALTER TABLE `users` ADD UNIQUE KEY `uq_users_email` (`email`)");
}

$db->exec(
    "CREATE TABLE IF NOT EXISTS cart_items (
        user_id INT UNSIGNED NOT NULL,
        product_id INT UNSIGNED NOT NULL,
        quantity INT UNSIGNED NOT NULL DEFAULT 1,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (user_id, product_id),
        KEY idx_cart_items_product (product_id),
        CONSTRAINT fk_cart_items_user
            FOREIGN KEY (user_id) REFERENCES users (id)
            ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT fk_cart_items_product
            FOREIGN KEY (product_id) REFERENCES products (id)
            ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
);

$testUsers = [
    ['username' => 'user1', 'email' => 'user1@example.com', 'phone_number' => '+421 900 000 001'],
    ['username' => 'user2', 'email' => 'user2@example.com', 'phone_number' => '+421 900 000 002'],
    ['username' => 'user3', 'email' => 'user3@example.com', 'phone_number' => '+421 900 000 003'],
    ['username' => 'user4', 'email' => 'user4@example.com', 'phone_number' => '+421 900 000 004'],
    ['username' => 'user5', 'email' => 'user5@example.com', 'phone_number' => '+421 900 000 005'],
];

$findUser = $db->prepare(
    'SELECT id, phone_number
     FROM users
     WHERE username = :username OR email = :email
     LIMIT 1'
);
$insertUser = $db->prepare(
    'INSERT INTO users (username, email, phone_number, password_hash, role)
     VALUES (:username, :email, :phone_number, :password_hash, :role)'
);
$updateBlankPhone = $db->prepare(
    "UPDATE users
     SET phone_number = :phone_number
     WHERE id = :id AND (phone_number IS NULL OR phone_number = '')"
);

$created = 0;
$existing = 0;

$db->beginTransaction();

try {
    foreach ($testUsers as $testUser) {
        $findUser->execute([
            'username' => $testUser['username'],
            'email' => $testUser['email'],
        ]);
        $existingUser = $findUser->fetch();

        if ($existingUser) {
            $updateBlankPhone->execute([
                'id' => $existingUser['id'],
                'phone_number' => $testUser['phone_number'],
            ]);
            $existing++;
            continue;
        }

        $insertUser->execute([
            'username' => $testUser['username'],
            'email' => $testUser['email'],
            'phone_number' => $testUser['phone_number'],
            'password_hash' => password_hash('Password123!', PASSWORD_DEFAULT),
            'role' => 'user',
        ]);
        $created++;
    }

    $db->commit();
} catch (Throwable $exception) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }

    throw $exception;
}

echo "User and cart database setup complete: {$created} users created, {$existing} already present." . PHP_EOL;
