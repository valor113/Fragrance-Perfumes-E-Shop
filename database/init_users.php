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
        password_hash VARCHAR(255) NOT NULL,
        role VARCHAR(20) NOT NULL DEFAULT 'user',
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_users_username (username),
        UNIQUE KEY uq_users_email (email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
);

$testUsers = [
    ['username' => 'user1', 'email' => 'user1@example.com'],
    ['username' => 'user2', 'email' => 'user2@example.com'],
    ['username' => 'user3', 'email' => 'user3@example.com'],
    ['username' => 'user4', 'email' => 'user4@example.com'],
    ['username' => 'user5', 'email' => 'user5@example.com'],
];

$find = $db->prepare(
    'SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1'
);
$insert = $db->prepare(
    'INSERT INTO users (username, email, password_hash, role)
     VALUES (:username, :email, :password_hash, :role)'
);

$created = 0;
$existing = 0;

foreach ($testUsers as $testUser) {
    $find->execute($testUser);

    if ($find->fetch()) {
        $existing++;
        continue;
    }

    $insert->execute([
        'username' => $testUser['username'],
        'email' => $testUser['email'],
        'password_hash' => password_hash('Password123!', PASSWORD_DEFAULT),
        'role' => 'user',
    ]);
    $created++;
}

echo "User initialization complete: {$created} created, {$existing} already present." . PHP_EOL;
