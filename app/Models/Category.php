<?php

namespace App\Models;

use PDO;

class Category
{
    public function __construct(private PDO $db)
    {
    }

    public function allActive(): array
    {
        $statement = $this->db->prepare('SELECT * FROM categories WHERE is_active = 1 ORDER BY sort_order ASC, id ASC');
        $statement->execute();

        return $statement->fetchAll();
    }
}
