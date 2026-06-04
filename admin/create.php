<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\ProductController;
use App\Core\Auth;

Auth::requireAdmin();

$controller = new ProductController();
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->store($_POST);
    $errors = $result['errors'] ?? [];
    $old = $result['old'] ?? [];
}

$pageTitle = 'Create Product';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-panel">
    <h1 class="heading-display admin-title">Create Product</h1>
    <?php if ($errors): ?>
        <div class="admin-alert admin-alert--error">
            <?php foreach ($errors as $error): ?>
                <p><?= e($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php
    $action = 'create.php';
    $submitLabel = 'Create Product';
    require __DIR__ . '/../app/Views/admin/product_form.php';
    ?>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
