<?php

namespace App\Models;

use PDO;

class HeroSlide
{
    public function __construct(private PDO $db)
    {
    }

    public function allActive(): array
    {
        $statement = $this->db->prepare('SELECT * FROM hero_slides WHERE is_active = 1 ORDER BY sort_order ASC, id ASC');
        $statement->execute();

        return $statement->fetchAll();
    }
}
