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
    <title>Maison Doree - Collections</title>
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
                    <h2 class="heading-display section-title">Our Collections</h2>
                    <p class="text-body section-subtitle">Discover scents crafted for every chapter of your story</p>
                </div>
                <a href="shop.php" class="btn-text">View All Collections</a>
            </div>
            <?php if ($dbError): ?>
                <p class="admin-alert admin-alert--error"><?= e($dbError) ?></p>
            <?php endif; ?>
            <div class="collections-grid">
                <?php foreach ($categories as $category): ?>
                    <article class="collection-item">
                        <div class="collection-image">
                            <img src="<?= e($category['image_path']) ?>" alt="<?= e($category['image_alt']) ?>">
                        </div>
                        <div class="collection-overlay">
                            <h3 class="collection-name"><?= e($category['name']) ?></h3>
                            <p class="collection-count"><?= (int) $category['piece_count'] ?> pieces</p>
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
