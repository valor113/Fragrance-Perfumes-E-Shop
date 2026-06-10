<?php
use App\Core\Auth;

$currentPage = basename($_SERVER['PHP_SELF']);
$isLoggedIn = Auth::check();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Admin') ?> - Maison Doree</title>
    <meta name="theme-color" content="#171714">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,500&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="admin-body<?= $isLoggedIn ? '' : ' admin-body--guest' ?>">
    <div class="admin-layout">
        <header class="admin-topbar">
            <a class="admin-brand" href="<?= $isLoggedIn ? 'index.php' : '../index.php' ?>">
                <span class="admin-brand-mark">MD</span>
                <span class="admin-brand-copy">Maison <strong>Doree</strong><small>Administration</small></span>
            </a>
            <?php if ($isLoggedIn): ?>
                <nav class="admin-nav" aria-label="Admin navigation">
                    <a class="<?= $currentPage === 'index.php' ? 'is-active' : '' ?>" href="index.php">
                        <span class="admin-nav-icon" aria-hidden="true">01</span>
                        Products
                    </a>
                    <a class="<?= $currentPage === 'appointments.php' ? 'is-active' : '' ?>" href="appointments.php">
                        <span class="admin-nav-icon" aria-hidden="true">02</span>
                        Appointments
                    </a>
                    <a class="<?= str_starts_with($currentPage, 'testimonial') ? 'is-active' : '' ?>" href="testimonials.php">
                        <span class="admin-nav-icon" aria-hidden="true">03</span>
                        Testimonials
                    </a>
                </nav>
                <div class="admin-topbar-footer">
                    <a class="admin-store-link" href="../shop.php" target="_blank" rel="noopener">
                        View storefront <span aria-hidden="true">&nearr;</span>
                    </a>
                    <a class="admin-logout-link" href="logout.php">Sign out</a>
                </div>
            <?php endif; ?>
        </header>
        <main class="admin-shell">
            <?php if ($isLoggedIn): ?>
                <div class="admin-mobile-bar">
                    <span><?= e($pageTitle ?? 'Admin') ?></span>
                    <a href="../shop.php">View shop</a>
                </div>
            <?php endif; ?>
