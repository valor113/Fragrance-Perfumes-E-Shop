<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\ProductController;
use App\Core\Auth;

Auth::requireAdmin();

$controller = new ProductController();
$products = $controller->index()['products'];
$message = flash('success');
$pageTitle = 'Products';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-panel">
    <div class="admin-heading-row">
        <div>
            <p class="text-label">CRUD Administration</p>
            <h1 class="heading-display admin-title">Products</h1>
        </div>
        <a class="btn-primary" href="create.php">Create Product</a>
    </div>
    <?php if ($message): ?>
        <p class="admin-alert admin-alert--success"><?= e($message) ?></p>
    <?php endif; ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= e($product['name']) ?></td>
                        <td><?= e($product['sku']) ?></td>
                        <td><?= e(money($product['price'], $product['currency'])) ?></td>
                        <td><?= (int) $product['stock_quantity'] ?></td>
                        <td><?= ((int) $product['is_active'] === 1) ? 'Active' : 'Hidden' ?></td>
                        <td class="admin-table-actions">
                            <a href="edit.php?id=<?= (int) $product['id'] ?>">Edit</a>
                            <form method="post" action="delete.php" onsubmit="return confirm('Delete this product?');">
                                <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require __DIR__ . '/../app/Views/admin/footer.php'; ?>
