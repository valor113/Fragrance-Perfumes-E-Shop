<?php

namespace App\Models;

use PDO;

class AppointmentRequest
{
    public function __construct(private PDO $db)
    {
    }

    public function all(): array
    {
        $statement = $this->db->prepare('SELECT * FROM appointment_requests ORDER BY created_at DESC, id DESC');
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create(array $data): void
    {
        $statement = $this->db->prepare(
            'INSERT INTO appointment_requests (full_name, email, phone, message)
             VALUES (:full_name, :email, :phone, :message)'
        );
        $statement->execute([
            'full_name' => trim((string) $data['name']),
            'email' => trim((string) $data['email']),
            'phone' => trim((string) ($data['phone'] ?? '')),
            'message' => trim((string) ($data['message'] ?? '')),
        ]);
    }
}
