<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Product;

class ProductController extends Controller
{
    private Product $products;

    public function __construct()
    {
        $this->products = new Product(Database::getConnection());
    }

    public function index(): array
    {
        return ['products' => $this->products->all()];
    }

    public function store(array $request): array
    {
        $errors = $this->validate($request);

        if ($errors !== []) {
            return ['errors' => $errors, 'old' => $request];
        }

        $this->products->create($request);
        $this->flash('success', 'Product created successfully.');
        $this->redirect('index.php');
    }

    public function update(int $id, array $request): array
    {
        $errors = $this->validate($request);

        if ($errors !== []) {
            return ['errors' => $errors, 'old' => $request];
        }

        $this->products->update($id, $request);
        $this->flash('success', 'Product updated successfully.');
        $this->redirect('index.php');
    }

    public function destroy(int $id): void
    {
        $this->products->delete($id);
        $this->flash('success', 'Product deleted successfully.');
        $this->redirect('index.php');
    }

    public function find(int $id): ?array
    {
        return $this->products->find($id);
    }

    private function validate(array $data): array
    {
        $errors = [];

        foreach (['sku', 'slug', 'name', 'description', 'price', 'image_path', 'image_alt'] as $field) {
            if (trim((string) ($data[$field] ?? '')) === '') {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
            }
        }

        if (isset($data['price']) && !is_numeric($data['price'])) {
            $errors[] = 'Price must be a number.';
        }

        return $errors;
    }
}
