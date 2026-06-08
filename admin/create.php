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
<section class="admin-page">
    <div class="admin-page-header admin-page-header--form">
        <div>
            <a class="admin-back-link" href="index.php">&larr; Product collection</a>
            <p class="admin-eyebrow">New catalog entry</p>
            <h1 class="heading-display admin-title">Create product</h1>
            <p class="admin-page-intro">Add a new fragrance and prepare it for the storefront.</p>
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
    $action = 'create.php';
    $submitLabel = 'Create Product';
    require __DIR__ . '/../app/Views/admin/product_form.php';
    ?>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
