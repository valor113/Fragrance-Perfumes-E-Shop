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
$db->exec(
    "CREATE TABLE IF NOT EXISTS users (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(190) NOT NULL,
        phone_number VARCHAR(30) NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        role VARCHAR(20) NOT NULL DEFAULT 'user',
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_users_username (username),
        UNIQUE KEY uq_users_email (email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
);

$phoneColumn = $db->query(
    "SELECT COUNT(*)
     FROM information_schema.COLUMNS
     WHERE TABLE_SCHEMA = DATABASE()
       AND TABLE_NAME = 'users'
       AND COLUMN_NAME = 'phone_number'"
)->fetchColumn();

if ((int) $phoneColumn === 0) {
    $db->exec(
        "ALTER TABLE users
         ADD COLUMN phone_number VARCHAR(30) NOT NULL DEFAULT '' AFTER email"
    );
}

$testUsers = [
    ['username' => 'user1', 'email' => 'user1@example.com', 'phone_number' => '+421 900 000 001'],
    ['username' => 'user2', 'email' => 'user2@example.com', 'phone_number' => '+421 900 000 002'],
    ['username' => 'user3', 'email' => 'user3@example.com', 'phone_number' => '+421 900 000 003'],
    ['username' => 'user4', 'email' => 'user4@example.com', 'phone_number' => '+421 900 000 004'],
    ['username' => 'user5', 'email' => 'user5@example.com', 'phone_number' => '+421 900 000 005'],
];

$find = $db->prepare(
    'SELECT id, phone_number FROM users WHERE username = :username OR email = :email LIMIT 1'
);
$insert = $db->prepare(
    'INSERT INTO users (username, email, phone_number, password_hash, role)
     VALUES (:username, :email, :phone_number, :password_hash, :role)'
);
$updatePhone = $db->prepare(
    "UPDATE users SET phone_number = :phone_number
     WHERE id = :id AND phone_number = ''"
);

$created = 0;
$existing = 0;

foreach ($testUsers as $testUser) {
    $find->execute([
        'username' => $testUser['username'],
        'email' => $testUser['email'],
    ]);
    $existingUser = $find->fetch();

    if ($existingUser) {
        $updatePhone->execute([
            'id' => $existingUser['id'],
            'phone_number' => $testUser['phone_number'],
        ]);
        $existing++;
        continue;
    }

    $insert->execute([
        'username' => $testUser['username'],
        'email' => $testUser['email'],
        'phone_number' => $testUser['phone_number'],
        'password_hash' => password_hash('Password123!', PASSWORD_DEFAULT),
        'role' => 'user',
    ]);
    $created++;
}

echo "User initialization complete: {$created} created, {$existing} already present." . PHP_EOL;
