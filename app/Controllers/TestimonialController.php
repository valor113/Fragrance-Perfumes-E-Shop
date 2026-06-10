<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    private Testimonial $testimonials;

    public function __construct()
    {
        $this->testimonials = new Testimonial(Database::getConnection());
    }

    public function index(): array
    {
        return ['testimonials' => $this->testimonials->all()];
    }

    public function find(int $id): ?array
    {
        return $this->testimonials->find($id);
    }

    public function store(array $request): array
    {
        $errors = $this->validate($request);

        if ($errors !== []) {
            return ['errors' => $errors, 'old' => $request];
        }

        $this->testimonials->create($request);
        $this->flash('success', 'Testimonial created successfully.');
        $this->redirect('testimonials.php');
    }

    public function update(int $id, array $request): array
    {
        $errors = $this->validate($request);

        if ($errors !== []) {
            return ['errors' => $errors, 'old' => $request];
        }

        $this->testimonials->update($id, $request);
        $this->flash('success', 'Testimonial updated successfully.');
        $this->redirect('testimonials.php');
    }

    public function destroy(int $id): void
    {
        $this->testimonials->delete($id);
        $this->flash('success', 'Testimonial deleted successfully.');
        $this->redirect('testimonials.php');
    }

    public function move(int $id, string $direction): void
    {
        if (!in_array($direction, ['up', 'down'], true)) {
            $this->redirect('testimonials.php');
        }

        $this->testimonials->move($id, $direction);
        $this->flash('success', 'Testimonial order updated.');
        $this->redirect('testimonials.php');
    }

    private function validate(array $data): array
    {
        $errors = [];

        foreach (['author_name', 'quote'] as $field) {
            if (trim((string) ($data[$field] ?? '')) === '') {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
            }
        }

        $rating = filter_var($data['rating'] ?? null, FILTER_VALIDATE_INT);

        if ($rating === false || $rating < 1 || $rating > 5) {
            $errors[] = 'Rating must be a whole number from 1 to 5.';
        }

        if (isset($data['sort_order']) && filter_var($data['sort_order'], FILTER_VALIDATE_INT) === false) {
            $errors[] = 'Sort order must be a whole number.';
        }

        return $errors;
    }
}
