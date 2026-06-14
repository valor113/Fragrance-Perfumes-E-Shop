<?php
use App\Core\Auth;
use App\Core\UserAuth;

$storefrontUser = UserAuth::user();
?>
<div class="mobile-overlay" id="mobileOverlay"></div>
<nav class="mobile-nav" id="mobileNav">
    <button class="mobile-nav-close" id="mobileNavClose" aria-label="Close menu">&times;</button>
    <ul class="mobile-nav-links">
        <li><a href="collections.php">Collections</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="story.php">Our Story</a></li>
        <li><a href="fragrance-guide.php">Fragrance Guide</a></li>
        <li><a href="contact.php">Visit Us</a></li>
        <?php if (Auth::check()): ?>
            <li><a href="admin/index.php">Admin</a></li>
        <?php endif; ?>
        <?php if ($storefrontUser): ?>
            <li><a href="cart.php">Cart</a></li>
            <li><span class="mobile-account-name">Signed in as <?= e($storefrontUser['username']) ?></span></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
    <div class="mobile-nav-cta">
        <a href="contact.php" class="btn-primary">Book Appointment</a>
    </div>
</nav>
