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
<section class="admin-login">
    <div class="admin-login-intro">
        <p class="admin-eyebrow">Maison Doree</p>
        <h1 class="heading-display admin-title">Welcome back.</h1>
        <p>Sign in to curate your collection and manage private appointment requests.</p>
    </div>
    <div class="admin-panel admin-panel--narrow">
    <p class="admin-login-label">Secure administration</p>
    <h2 class="heading-display">Sign in</h2>
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
        <button class="admin-button admin-button--primary admin-button--full" type="submit">Enter dashboard</button>
    </form>
    <a class="admin-back-link" href="../index.php">&larr; Return to storefront</a>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
