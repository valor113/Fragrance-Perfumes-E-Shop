<?php

namespace App\Models;

use PDO;

class Product
{
    public function __construct(private PDO $db)
    {
    }

    public function all(bool $activeOnly = false, ?string $categorySlug = null): array
    {
        $sql = 'SELECT DISTINCT products.* FROM products';
        $conditions = [];
        $parameters = [];

        if ($categorySlug !== null && $categorySlug !== '') {
            $sql .= ' INNER JOIN product_categories ON product_categories.product_id = products.id
                      INNER JOIN categories ON categories.id = product_categories.category_id';
            $conditions[] = 'categories.slug = :category_slug';
            $conditions[] = 'categories.is_active = 1';
            $parameters['category_slug'] = $categorySlug;
        }

        if ($activeOnly) {
            $conditions[] = 'products.is_active = 1';
        }

        if ($conditions !== []) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $sql .= ' ORDER BY products.sort_order ASC, products.id ASC';
        $statement = $this->db->prepare($sql);
        $statement->execute($parameters);

        return $statement->fetchAll();
    }

    public function featured(): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM products WHERE is_featured = 1 AND is_active = 1 ORDER BY sort_order ASC LIMIT 1');
        $statement->execute();
        $product = $statement->fetch();

        return $product ?: null;
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM products WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $product = $statement->fetch();

        return $product ?: null;
    }

    public function create(array $data): void
    {
        $statement = $this->db->prepare(
            'INSERT INTO products (sku, slug, name, brand, description, price, currency, image_path, image_alt, badge, is_featured, stock_quantity, is_active, sort_order)
             VALUES (:sku, :slug, :name, :brand, :description, :price, :currency, :image_path, :image_alt, :badge, :is_featured, :stock_quantity, :is_active, :sort_order)'
        );
        $statement->execute($this->sanitizeData($data));
    }

    public function update(int $id, array $data): void
    {
        $payload = $this->sanitizeData($data);
        $payload['id'] = $id;

        $statement = $this->db->prepare(
            'UPDATE products
             SET sku = :sku, slug = :slug, name = :name, brand = :brand, description = :description, price = :price,
                 currency = :currency, image_path = :image_path, image_alt = :image_alt, badge = :badge,
                 is_featured = :is_featured, stock_quantity = :stock_quantity, is_active = :is_active, sort_order = :sort_order
             WHERE id = :id'
        );
        $statement->execute($payload);
    }

    public function delete(int $id): void
    {
        $statement = $this->db->prepare('DELETE FROM products WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    private function sanitizeData(array $data): array
    {
        return [
            'sku' => trim((string) $data['sku']),
            'slug' => trim((string) $data['slug']),
            'name' => trim((string) $data['name']),
            'brand' => trim((string) ($data['brand'] ?? '')),
            'description' => trim((string) $data['description'],
            ),
            'price' => (float) $data['price'],
            'currency' => strtoupper(trim((string) ($data['currency'] ?? 'USD'))),
            'image_path' => trim((string) $data['image_path']),
            'image_alt' => trim((string) $data['image_alt']),
            'badge' => ($data['badge'] ?? '') !== '' ? $data['badge'] : null,
            'is_featured' => isset($data['is_featured']) ? 1 : 0,
            'stock_quantity' => (int) ($data['stock_quantity'] ?? 0),
            'is_active' => isset($data['is_active']) ? 1 : 0,
            'sort_order' => (int) ($data['sort_order'] ?? 0),
        ];
    }
}
