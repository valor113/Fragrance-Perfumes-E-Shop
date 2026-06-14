<?php

namespace App\Models;

use PDO;

class Cart
{
    public function __construct(private PDO $db)
    {
    }

    public function items(int $userId): array
    {
        $statement = $this->db->prepare(
            'SELECT cart_items.product_id, cart_items.quantity, products.name, products.description,
                    products.price, products.currency, products.image_path, products.image_alt,
                    products.stock_quantity, products.is_active
             FROM cart_items
             INNER JOIN products ON products.id = cart_items.product_id
             WHERE cart_items.user_id = :user_id
             ORDER BY cart_items.updated_at DESC, cart_items.product_id ASC'
        );
        $statement->execute(['user_id' => $userId]);

        return $statement->fetchAll();
    }

    public function quantity(int $userId, int $productId): int
    {
        $statement = $this->db->prepare(
            'SELECT quantity
             FROM cart_items
             WHERE user_id = :user_id AND product_id = :product_id'
        );
        $statement->execute([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return (int) ($statement->fetchColumn() ?: 0);
    }

    public function save(int $userId, int $productId, int $quantity): void
    {
        $statement = $this->db->prepare(
            'INSERT INTO cart_items (user_id, product_id, quantity)
             VALUES (:user_id, :product_id, :quantity)
             ON DUPLICATE KEY UPDATE quantity = VALUES(quantity), updated_at = CURRENT_TIMESTAMP'
        );
        $statement->execute([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    public function remove(int $userId, int $productId): void
    {
        $statement = $this->db->prepare(
            'DELETE FROM cart_items
             WHERE user_id = :user_id AND product_id = :product_id'
        );
        $statement->execute([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);
    }

    public function clear(int $userId): void
    {
        $statement = $this->db->prepare('DELETE FROM cart_items WHERE user_id = :user_id');
        $statement->execute(['user_id' => $userId]);
    }
}
