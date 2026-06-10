<?php
require __DIR__ . '/bootstrap.php';

use App\Core\Database;
use App\Models\Category;

$categories = [];
$dbError = null;

try {
    $categories = (new Category(Database::getConnection()))->allActive();
} catch (Throwable $exception) {
    $dbError = $exception->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfume Collections by Scent and Occasion - Maison Doree</title>
    <meta name="description" content="Explore Maison Doree perfume collections by scent family, mood, occasion, season, and personal style.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <section class="collections" id="collections">
        <div class="container">
            <div class="section-header">
                <div class="section-header-left">
                    <p class="text-label">Find Your Fragrance</p>
                    <h1 class="heading-display section-title">Perfume Collections</h1>
                    <p class="text-body section-subtitle">Explore scents by fragrance family, mood, occasion, and the moments you want to remember.</p>
                </div>
                <a href="shop.php" class="btn-text">Shop All Fragrances</a>
            </div>
            <?php if ($dbError): ?>
                <p class="admin-alert admin-alert--error"><?= e($dbError) ?></p>
            <?php endif; ?>
            <div class="collections-grid">
                <?php foreach ($categories as $category): ?>
                    <a class="collection-item" href="shop.php?collection=<?= e(urlencode($category['slug'])) ?>">
                        <div class="collection-image">
                            <img src="<?= e($category['image_path']) ?>" alt="<?= e($category['image_alt']) ?>">
                        </div>
                        <div class="collection-overlay">
                            <h3 class="collection-name"><?= e($category['name']) ?></h3>
                            <p class="collection-description"><?= e($category['description']) ?></p>
                            <p class="collection-count"><?= (int) $category['product_count'] ?> <?= (int) $category['product_count'] === 1 ? 'fragrance' : 'fragrances' ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
