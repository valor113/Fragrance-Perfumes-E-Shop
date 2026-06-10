<?php

namespace App\Models;

use PDO;

class Testimonial
{
    public function __construct(private PDO $db)
    {
    }

    public function allActive(): array
    {
        $statement = $this->db->prepare('SELECT * FROM testimonials WHERE is_active = 1 ORDER BY sort_order ASC, id ASC');
        $statement->execute();

        return $statement->fetchAll();
    }

    public function all(): array
    {
        return $this->db->query('SELECT * FROM testimonials ORDER BY sort_order ASC, id ASC')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM testimonials WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $testimonial = $statement->fetch();

        return $testimonial ?: null;
    }

    public function create(array $data): void
    {
        $statement = $this->db->prepare(
            'INSERT INTO testimonials (author_name, author_detail, quote, rating, avatar_path, avatar_alt, is_active, sort_order)
             VALUES (:author_name, :author_detail, :quote, :rating, :avatar_path, :avatar_alt, :is_active, :sort_order)'
        );
        $statement->execute($this->sanitizeData($data));
    }

    public function update(int $id, array $data): void
    {
        $payload = $this->sanitizeData($data);
        $payload['id'] = $id;

        $statement = $this->db->prepare(
            'UPDATE testimonials
             SET author_name = :author_name, author_detail = :author_detail, quote = :quote, rating = :rating,
                 avatar_path = :avatar_path, avatar_alt = :avatar_alt, is_active = :is_active, sort_order = :sort_order
             WHERE id = :id'
        );
        $statement->execute($payload);
    }

    public function delete(int $id): void
    {
        $statement = $this->db->prepare('DELETE FROM testimonials WHERE id = :id');
        $statement->execute(['id' => $id]);
        $this->normalizeSortOrder();
    }

    public function move(int $id, string $direction): void
    {
        $testimonials = $this->all();
        $currentIndex = null;

        foreach ($testimonials as $index => $testimonial) {
            if ((int) $testimonial['id'] === $id) {
                $currentIndex = $index;
                break;
            }
        }

        if ($currentIndex === null) {
            return;
        }

        $targetIndex = $direction === 'up' ? $currentIndex - 1 : $currentIndex + 1;

        if (!isset($testimonials[$targetIndex])) {
            return;
        }

        [$testimonials[$currentIndex], $testimonials[$targetIndex]] = [$testimonials[$targetIndex], $testimonials[$currentIndex]];
        $this->saveOrder(array_column($testimonials, 'id'));
    }

    private function normalizeSortOrder(): void
    {
        $this->saveOrder(array_column($this->all(), 'id'));
    }

    private function saveOrder(array $ids): void
    {
        $statement = $this->db->prepare('UPDATE testimonials SET sort_order = :sort_order WHERE id = :id');

        $this->db->beginTransaction();

        try {
            foreach ($ids as $index => $id) {
                $statement->execute([
                    'sort_order' => $index + 1,
                    'id' => (int) $id,
                ]);
            }

            $this->db->commit();
        } catch (\Throwable $exception) {
            $this->db->rollBack();
            throw $exception;
        }
    }

    private function sanitizeData(array $data): array
    {
        $avatarPath = trim((string) ($data['avatar_path'] ?? ''));
        $avatarAlt = trim((string) ($data['avatar_alt'] ?? ''));

        return [
            'author_name' => trim((string) $data['author_name']),
            'author_detail' => trim((string) ($data['author_detail'] ?? '')) ?: null,
            'quote' => trim((string) $data['quote']),
            'rating' => (int) ($data['rating'] ?? 5),
            'avatar_path' => $avatarPath !== '' ? $avatarPath : null,
            'avatar_alt' => $avatarPath !== '' ? ($avatarAlt ?: trim((string) $data['author_name'])) : null,
            'is_active' => isset($data['is_active']) ? 1 : 0,
            'sort_order' => max(0, (int) ($data['sort_order'] ?? 0)),
        ];
    }
}
