<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\ProductController;
use App\Core\Auth;

Auth::requireAdmin();

$controller = new ProductController();
$products = $controller->index()['products'];
$message = flash('success');
$activeProducts = count(array_filter($products, static fn (array $product): bool => (int) $product['is_active'] === 1));
$featuredProducts = count(array_filter($products, static fn (array $product): bool => (int) $product['is_featured'] === 1));
$lowStockProducts = count(array_filter($products, static fn (array $product): bool => (int) $product['stock_quantity'] < 5));
$pageTitle = 'Products';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-page">
    <div class="admin-page-header">
        <div>
            <p class="admin-eyebrow">Catalog management</p>
            <h1 class="heading-display admin-title">Product collection</h1>
            <p class="admin-page-intro">Manage the fragrances displayed in your online boutique.</p>
        </div>
        <a class="admin-button admin-button--primary" href="create.php"><span aria-hidden="true">+</span> Add product</a>
    </div>
    <?php if ($message): ?>
        <p class="admin-alert admin-alert--success"><?= e($message) ?></p>
    <?php endif; ?>

    <div class="admin-stats" aria-label="Catalog summary">
        <article class="admin-stat-card">
            <span class="admin-stat-label">Total products</span>
            <strong><?= count($products) ?></strong>
            <span>In your catalog</span>
        </article>
        <article class="admin-stat-card">
            <span class="admin-stat-label">Published</span>
            <strong><?= $activeProducts ?></strong>
            <span>Visible in the shop</span>
        </article>
        <article class="admin-stat-card">
            <span class="admin-stat-label">Featured</span>
            <strong><?= $featuredProducts ?></strong>
            <span>Highlighted pieces</span>
        </article>
        <article class="admin-stat-card<?= $lowStockProducts > 0 ? ' admin-stat-card--warning' : '' ?>">
            <span class="admin-stat-label">Low stock</span>
            <strong><?= $lowStockProducts ?></strong>
            <span>Fewer than 5 units</span>
        </article>
    </div>

    <div class="admin-panel">
        <div class="admin-panel-header">
            <div>
                <h2>All products</h2>
                <p><?= count($products) ?> catalog <?= count($products) === 1 ? 'entry' : 'entries' ?></p>
            </div>
        </div>
        <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products === []): ?>
                    <tr>
                        <td class="admin-empty-state" colspan="6">No products yet. Add your first fragrance to begin.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>
                            <div class="admin-product-cell">
                                <div class="admin-product-thumb">
                                    <img src="../<?= e($product['image_path']) ?>" alt="">
                                </div>
                                <div>
                                    <strong><?= e($product['name']) ?></strong>
                                    <span><?= e($product['brand'] ?: 'Maison Doree') ?></span>
                                </div>
                            </div>
                        </td>
                        <td><span class="admin-mono"><?= e($product['sku']) ?></span></td>
                        <td><strong><?= e(money($product['price'], $product['currency'])) ?></strong></td>
                        <td>
                            <span class="<?= (int) $product['stock_quantity'] < 5 ? 'admin-stock-low' : '' ?>">
                                <?= (int) $product['stock_quantity'] ?> units
                            </span>
                        </td>
                        <td><span class="admin-status <?= ((int) $product['is_active'] === 1) ? 'admin-status--active' : 'admin-status--hidden' ?>"><?= ((int) $product['is_active'] === 1) ? 'Active' : 'Hidden' ?></span></td>
                        <td class="admin-table-actions">
                            <a class="admin-action-edit" href="edit.php?id=<?= (int) $product['id'] ?>">Edit</a>
                            <form method="post" action="delete.php" onsubmit="return confirm('Delete this product?');">
                                <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                <button class="admin-action-delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
