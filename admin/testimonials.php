<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\TestimonialController;
use App\Core\Auth;

Auth::requireAdmin();

$controller = new TestimonialController();
$testimonials = $controller->index()['testimonials'];
$message = flash('success');
$activeTestimonials = count(array_filter($testimonials, static fn (array $testimonial): bool => (int) $testimonial['is_active'] === 1));
$pageTitle = 'Testimonials';
require __DIR__ . '/../app/Views/admin/header.php';
?>
<section class="admin-page">
    <div class="admin-page-header">
        <div>
            <p class="admin-eyebrow">Customer experiences</p>
            <h1 class="heading-display admin-title">Testimonials</h1>
            <p class="admin-page-intro">Manage the perfume stories displayed on the contact page.</p>
        </div>
        <a class="admin-button admin-button--primary" href="testimonial-create.php"><span aria-hidden="true">+</span> Add testimonial</a>
    </div>

    <?php if ($message): ?>
        <p class="admin-alert admin-alert--success"><?= e($message) ?></p>
    <?php endif; ?>

    <div class="admin-stats admin-stats--compact" aria-label="Testimonial summary">
        <article class="admin-stat-card">
            <span class="admin-stat-label">Total stories</span>
            <strong><?= count($testimonials) ?></strong>
            <span>Saved customer testimonials</span>
        </article>
        <article class="admin-stat-card">
            <span class="admin-stat-label">Published</span>
            <strong><?= $activeTestimonials ?></strong>
            <span>Visible on the contact page</span>
        </article>
    </div>

    <div class="admin-panel">
        <div class="admin-panel-header">
            <div>
                <h2>All testimonials</h2>
                <p>Use the arrows to change the display order</p>
            </div>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Testimonial</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($testimonials === []): ?>
                        <tr>
                            <td class="admin-empty-state" colspan="6">No testimonials yet. Add a perfume customer story to begin.</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <tr>
                            <td>
                                <div class="admin-order-controls">
                                    <form method="post" action="testimonial-reorder.php">
                                        <input type="hidden" name="id" value="<?= (int) $testimonial['id'] ?>">
                                        <input type="hidden" name="direction" value="up">
                                        <button type="submit" aria-label="Move <?= e($testimonial['author_name']) ?> up" <?= $index === 0 ? 'disabled' : '' ?>>&uarr;</button>
                                    </form>
                                    <span><?= $index + 1 ?></span>
                                    <form method="post" action="testimonial-reorder.php">
                                        <input type="hidden" name="id" value="<?= (int) $testimonial['id'] ?>">
                                        <input type="hidden" name="direction" value="down">
                                        <button type="submit" aria-label="Move <?= e($testimonial['author_name']) ?> down" <?= $index === count($testimonials) - 1 ? 'disabled' : '' ?>>&darr;</button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="admin-product-cell">
                                    <?php if ($testimonial['avatar_path']): ?>
                                        <div class="admin-product-thumb admin-product-thumb--round">
                                            <img src="../<?= e($testimonial['avatar_path']) ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <strong><?= e($testimonial['author_name']) ?></strong>
                                        <span><?= e($testimonial['author_detail'] ?: 'Perfume customer') ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="admin-message-cell"><?= e($testimonial['quote']) ?></td>
                            <td><strong><?= (int) $testimonial['rating'] ?>/5</strong></td>
                            <td><span class="admin-status <?= (int) $testimonial['is_active'] === 1 ? 'admin-status--active' : 'admin-status--hidden' ?>"><?= (int) $testimonial['is_active'] === 1 ? 'Active' : 'Hidden' ?></span></td>
                            <td class="admin-table-actions">
                                <a class="admin-action-edit" href="testimonial-edit.php?id=<?= (int) $testimonial['id'] ?>">Edit</a>
                                <form method="post" action="testimonial-delete.php" onsubmit="return confirm('Delete this testimonial?');">
                                    <input type="hidden" name="id" value="<?= (int) $testimonial['id'] ?>">
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
