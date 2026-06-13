<?php
require __DIR__ . '/bootstrap.php';

use App\Controllers\UserAuthController;
use App\Core\UserAuth;

if (UserAuth::check()) {
    header('Location: index.php');
    exit;
}

$formResult = [];
$dbError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $formResult = (new UserAuthController())->register($_POST);
    } catch (Throwable $exception) {
        $dbError = $exception->getMessage();
    }
}

$old = $formResult['old'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Maison Doree</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <main class="auth-page">
        <div class="container auth-layout">
            <section class="auth-intro" aria-labelledby="register-title">
                <p class="text-label">Maison Doree Membership</p>
                <h1 class="heading-display" id="register-title">Create your account.</h1>
                <p class="text-body">Join our fragrance community and keep your Maison Doree experience close at hand.</p>
            </section>

            <section class="auth-card" aria-label="Registration form">
                <h2 class="form-title">Register</h2>

                <?php if ($dbError): ?>
                    <p class="auth-alert auth-alert--error" role="alert"><?= e($dbError) ?></p>
                <?php endif; ?>

                <?php if (!empty($formResult['errors'])): ?>
                    <div class="auth-alert auth-alert--error" role="alert">
                        <?php foreach ($formResult['errors'] as $error): ?>
                            <p><?= e($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="register.php">
                    <div class="form-group">
                        <label class="form-label" for="username">Full Name / Username</label>
                        <input class="form-input" type="text" id="username" name="username" value="<?= e($old['username'] ?? '') ?>" maxlength="50" autocomplete="username" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input class="form-input" type="email" id="email" name="email" value="<?= e($old['email'] ?? '') ?>" maxlength="190" autocomplete="email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone_number">Phone Number</label>
                        <input class="form-input" type="tel" id="phone_number" name="phone_number" value="<?= e($old['phone_number'] ?? '') ?>" maxlength="30" autocomplete="tel" placeholder="+421 900 123 456" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-input" type="password" id="password" name="password" minlength="8" autocomplete="new-password" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" minlength="8" autocomplete="new-password" required>
                    </div>
                    <button class="form-submit" type="submit">Create Account</button>
                </form>

                <p class="auth-switch">Already registered? <a href="login.php">Sign in</a></p>
            </section>
        </div>
    </main>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
