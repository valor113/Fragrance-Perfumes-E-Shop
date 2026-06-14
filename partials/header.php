<?php
use App\Core\Auth;
use App\Core\UserAuth;

$storefrontUser = UserAuth::user();
?>
<header class="site-header" id="header">
    <div class="container">
        <div class="header-inner">
            <a href="index.php" class="logo">Maison <span>Doree</span></a>
            <nav class="nav-main">
                <a href="collections.php">Collections</a>
                <a href="shop.php">Shop</a>
                <a href="story.php">Our Story</a>
                <a href="fragrance-guide.php">Fragrance Guide</a>
                <a href="contact.php">Visit Us</a>
                <?php if (Auth::check()): ?>
                    <a href="admin/index.php">Admin</a>
                <?php endif; ?>
                <?php if ($storefrontUser): ?>
                    <a href="cart.php">Cart</a>
                    <span class="nav-account-name"><?= e($storefrontUser['username']) ?></span>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php endif; ?>
                <a href="contact.php" class="nav-cta">Book Appointment</a>
            </nav>
            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>
