<?php
require __DIR__ . '/bootstrap.php';

use App\Core\Database;
use App\Models\Category;
use App\Models\Product;

$products = [];
$categories = [];
$selectedCollection = trim((string) ($_GET['collection'] ?? ''));
$dbError = null;

try {
    $db = Database::getConnection();
    $categories = (new Category($db))->allActive();
    $validSlugs = array_column($categories, 'slug');

    if ($selectedCollection !== '' && !in_array($selectedCollection, $validSlugs, true)) {
        $selectedCollection = '';
    }

    $products = (new Product($db))->all(true, $selectedCollection ?: null);
} catch (Throwable $exception) {
    $dbError = $exception->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Doree - Shop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <section class="shop">
        <div class="container">
            <div class="section-header">
                <div class="section-header-left">
                    <h2 class="heading-display section-title">Our Shop</h2>
                    <p class="text-body section-subtitle">Discover exquisite fragrances available for purchase</p>
                </div>
                <form class="shop-filters" method="get" action="shop.php">
                    <label class="sr-only" for="collection">Filter products by collection</label>
                    <select class="filter-select" id="collection" name="collection" onchange="this.form.submit()">
                        <option value="">All Collections</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= e($category['slug']) ?>" <?= $selectedCollection === $category['slug'] ? 'selected' : '' ?>><?= e($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <noscript><button class="btn-primary" type="submit">Apply</button></noscript>
                </form>
            </div>

            <?php if ($dbError): ?>
                <p class="admin-alert admin-alert--error"><?= e($dbError) ?></p>
            <?php endif; ?>

            <div class="products-grid">
                <?php if ($products === [] && !$dbError): ?>
                    <p class="shop-empty">No fragrances are currently assigned to this collection. Explore another collection or view the complete shop.</p>
                <?php endif; ?>
                <?php foreach ($products as $product): ?>
                    <article class="product-card">
                        <div class="product-image">
                            <img src="<?= e($product['image_path']) ?>" alt="<?= e($product['image_alt']) ?>">
                            <?php if ($product['badge']): ?>
                                <div class="product-badge"><?= e($product['badge']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><?= e($product['name']) ?></h3>
                            <p class="product-description"><?= e($product['description']) ?></p>
                            <p class="product-price"><?= e(money($product['price'], $product['currency'])) ?></p>
                            <button class="btn-primary product-btn">Add to Cart</button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
