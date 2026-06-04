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
<section class="admin-panel">
    <h1 class="heading-display admin-title">Edit Product</h1>
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
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
