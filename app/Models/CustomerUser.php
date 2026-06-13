<?php

namespace App\Models;

use PDO;

class CustomerUser
{
    public function __construct(private PDO $db)
    {
    }

    public function findByEmail(string $email): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        return $user ?: null;
    }

    public function findByUsername(string $username): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
        $statement->execute(['username' => $username]);
        $user = $statement->fetch();

        return $user ?: null;
    }

    public function create(string $username, string $email, string $phoneNumber, string $passwordHash): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO users (username, email, phone_number, password_hash, role)
             VALUES (:username, :email, :phone_number, :password_hash, :role)'
        );
        $statement->execute([
            'username' => $username,
            'email' => $email,
            'phone_number' => $phoneNumber,
            'password_hash' => $passwordHash,
            'role' => 'user',
        ]);

        return (int) $this->db->lastInsertId();
    }
}
