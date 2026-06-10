<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\TestimonialController;
use App\Core\Auth;

Auth::requireAdmin();

$controller = new TestimonialController();
$id = (int) ($_GET['id'] ?? 0);
$testimonial = $controller->find($id);

if (!$testimonial) {
    http_response_code(404);
    exit('Testimonial not found.');
}

$errors = [];
$old = $testimonial;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->update($id, $_POST);
    $errors = $result['errors'] ?? [];
    $old = $result['old'] ?? $testimonial;
}

$pageTitle = 'Edit Testimonial';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-page">
    <div class="admin-page-header admin-page-header--form">
        <div>
            <a class="admin-back-link" href="testimonials.php">&larr; Testimonials</a>
            <p class="admin-eyebrow">Customer story</p>
            <h1 class="heading-display admin-title">Edit <?= e($testimonial['author_name']) ?></h1>
            <p class="admin-page-intro">Update the testimonial copy, presentation, and storefront visibility.</p>
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
        $action = 'testimonial-edit.php?id=' . (int) $testimonial['id'];
        $submitLabel = 'Update Testimonial';
        require __DIR__ . '/../app/Views/admin/testimonial_form.php';
        ?>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
