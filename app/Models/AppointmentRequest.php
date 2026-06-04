<?php

namespace App\Models;

use PDO;

class AppointmentRequest
{
    public function __construct(private PDO $db)
    {
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
