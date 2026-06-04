<?php
require __DIR__ . '/bootstrap.php';

use App\Core\Database;
use App\Models\HeroSlide;
use App\Models\Product;

$slides = [];
$featured = null;
$dbError = null;

try {
    $db = Database::getConnection();
    $slides = (new HeroSlide($db))->allActive();
    $featured = (new Product($db))->featured();
} catch (Throwable $exception) {
    $dbError = $exception->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Doree - Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <p class="text-label hero-tagline">Luxury Fragrance Boutique</p>
            <h1 class="heading-display hero-title">Where Scent<br>Becomes <em>Art</em></h1>
            <p class="text-body hero-description">
                Discover curated perfumes from iconic houses and niche makers, selected for elegance, character, and lasting impression.
            </p>
            <div class="hero-actions">
                <a href="collections.php" class="btn-primary">Explore Collections</a>
                <a href="story.php" class="btn-text">Our Heritage</a>
            </div>
            <?php if ($dbError): ?>
                <p class="admin-alert admin-alert--error"><?= e($dbError) ?></p>
            <?php endif; ?>
        </div>
        <div class="hero-image">
            <?php foreach ($slides as $index => $slide): ?>
                <div class="hero-slide <?= $index === 0 ? 'active' : '' ?>" data-title="<?= e($slide['title']) ?>">
                    <img src="<?= e($slide['image_path']) ?>" alt="<?= e($slide['image_alt']) ?>">
                </div>
            <?php endforeach; ?>
            <div class="hero-image-overlay">
                <p class="overlay-title" id="heroTitle"><?= e($slides[0]['title'] ?? 'Maison Doree') ?></p>
                <p class="overlay-price" id="heroPrice"></p>
            </div>
        </div>
    </section>

    <?php if ($featured): ?>
        <section class="featured-piece">
            <div class="container">
                <div class="featured-grid">
                    <div class="featured-image-wrapper">
                        <div class="featured-image">
                            <img src="<?= e($featured['image_path']) ?>" alt="<?= e($featured['image_alt']) ?>">
                        </div>
                        <div class="featured-badge">Featured</div>
                    </div>
                    <div class="featured-content">
                        <p class="text-label featured-label">Featured Fragrance</p>
                        <h2 class="heading-display featured-title"><?= e($featured['name']) ?></h2>
                        <p class="text-body featured-description"><?= e($featured['description']) ?></p>
                        <div class="featured-details">
                            <div class="detail-row">
                                <span class="detail-label">Brand</span>
                                <span class="detail-value"><?= e($featured['brand']) ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">SKU</span>
                                <span class="detail-value"><?= e($featured['sku']) ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Stock</span>
                                <span class="detail-value"><?= (int) $featured['stock_quantity'] ?> available</span>
                            </div>
                        </div>
                        <p class="featured-price"><?= e(money($featured['price'], $featured['currency'])) ?></p>
                        <a href="shop.php" class="btn-primary">View in Shop</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
