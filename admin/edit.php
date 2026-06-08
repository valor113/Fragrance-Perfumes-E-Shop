<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\ProductController;
use App\Core\Auth;

Auth::requireAdmin();

$controller = new ProductController();
$id = (int) ($_GET['id'] ?? 0);
$product = $controller->find($id);

if (!$product) {
    http_response_code(404);
    exit('Product not found.');
}

$errors = [];
$old = $product;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->update($id, $_POST);
    $errors = $result['errors'] ?? [];
    $old = $result['old'] ?? $product;
}

$pageTitle = 'Edit Product';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-page">
    <div class="admin-page-header admin-page-header--form">
        <div>
            <a class="admin-back-link" href="index.php">&larr; Product collection</a>
            <p class="admin-eyebrow">Catalog entry</p>
            <h1 class="heading-display admin-title">Edit <?= e($product['name']) ?></h1>
            <p class="admin-page-intro">Update product details, availability, and storefront presentation.</p>
        </div>
    </div>
    <div class="admin-panel admin-form-panel">
    <?php if ($errors): ?>
        <div class="admin-alert admin-alert--error">
            <?php foreach ($errors as $error): ?>
                <p><?= e($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php
    $action = 'edit.php?id=' . (int) $product['id'];
    $submitLabel = 'Update Product';
    require __DIR__ . '/../app/Views/admin/product_form.php';
    ?>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
