<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\TestimonialController;
use App\Core\Auth;

Auth::requireAdmin();

$controller = new TestimonialController();
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->store($_POST);
    $errors = $result['errors'] ?? [];
    $old = $result['old'] ?? [];
}

$pageTitle = 'Create Testimonial';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-page">
    <div class="admin-page-header admin-page-header--form">
        <div>
            <a class="admin-back-link" href="testimonials.php">&larr; Testimonials</a>
            <p class="admin-eyebrow">New customer story</p>
            <h1 class="heading-display admin-title">Create testimonial</h1>
            <p class="admin-page-intro">Add a customer experience centered on perfume, scent, or fragrance service.</p>
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
        $action = 'testimonial-create.php';
        $submitLabel = 'Create Testimonial';
        require __DIR__ . '/../app/Views/admin/testimonial_form.php';
        ?>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
