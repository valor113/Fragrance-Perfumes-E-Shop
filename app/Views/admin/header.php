<?php
use App\Core\Auth;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Admin') ?> - Maison Doree</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="admin-body">
    <main class="admin-shell">
        <header class="admin-topbar">
            <a class="admin-brand" href="index.php">Maison <span>Doree</span> Admin</a>
            <?php if (Auth::check()): ?>
                <nav class="admin-nav">
                    <a href="index.php">Products</a>
                    <a href="../shop.php">View Shop</a>
                    <a href="logout.php">Logout</a>
                </nav>
            <?php endif; ?>
        </header>
