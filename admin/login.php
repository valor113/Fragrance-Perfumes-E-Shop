<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\AuthController;
use App\Core\Auth;

if (Auth::check()) {
    header('Location: index.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = (new AuthController())->login($_POST);
    $error = $result['error'] ?? null;
}

$pageTitle = 'Login';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-panel admin-panel--narrow">
    <h1 class="heading-display admin-title">Admin Login</h1>
    <?php if ($error): ?>
        <p class="admin-alert admin-alert--error"><?= e($error) ?></p>
    <?php endif; ?>
    <form method="post" class="admin-form">
        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input class="form-input" type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-input" type="password" id="password" name="password" required>
        </div>
        <button class="btn-primary" type="submit">Login</button>
    </form>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
