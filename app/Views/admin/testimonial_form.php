<?php
$testimonial = $testimonial ?? [];
$old = $old ?? $testimonial;
$action = $action ?? 'testimonial-create.php';
?>
<form method="post" action="<?= e($action) ?>" class="admin-form">
    <div class="admin-form-section">
        <div class="admin-form-section-heading">
            <span>01</span>
            <div>
                <h2>Customer story</h2>
                <p>Describe the fragrance experience in the customer's own voice.</p>
            </div>
        </div>
        <div class="admin-form-grid">
            <div class="form-group">
                <label class="form-label" for="author_name">Customer name</label>
                <input class="form-input" type="text" id="author_name" name="author_name" maxlength="120" value="<?= e($old['author_name'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="author_detail">Fragrance or experience</label>
                <input class="form-input" type="text" id="author_detail" name="author_detail" maxlength="120" value="<?= e($old['author_detail'] ?? '') ?>" placeholder="Signature scent consultation">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="quote">Testimonial</label>
            <textarea class="form-textarea" id="quote" name="quote" required><?= e($old['quote'] ?? '') ?></textarea>
        </div>
    </div>

    <div class="admin-form-section">
        <div class="admin-form-section-heading">
            <span>02</span>
            <div>
                <h2>Presentation</h2>
                <p>Set the rating, portrait, visibility, and storefront position.</p>
            </div>
        </div>
        <div class="admin-form-grid">
            <div class="form-group">
                <label class="form-label" for="rating">Rating</label>
                <select class="form-input" id="rating" name="rating" required>
                    <?php for ($rating = 5; $rating >= 1; $rating--): ?>
                        <option value="<?= $rating ?>" <?= (int) ($old['rating'] ?? 5) === $rating ? 'selected' : '' ?>><?= $rating ?> star<?= $rating === 1 ? '' : 's' ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="sort_order">Sort order</label>
                <input class="form-input" type="number" min="0" id="sort_order" name="sort_order" value="<?= e((string) ($old['sort_order'] ?? '0')) ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="avatar_path">Avatar path</label>
                <input class="form-input" type="text" id="avatar_path" name="avatar_path" maxlength="255" value="<?= e($old['avatar_path'] ?? '') ?>" placeholder="images/avatar-01.jpg">
            </div>
            <div class="form-group">
                <label class="form-label" for="avatar_alt">Avatar alt text</label>
                <input class="form-input" type="text" id="avatar_alt" name="avatar_alt" maxlength="255" value="<?= e($old['avatar_alt'] ?? '') ?>" placeholder="Portrait of the customer">
            </div>
        </div>
        <div class="admin-checks">
            <label>
                <input type="checkbox" name="is_active" value="1" <?= (int) ($old['is_active'] ?? 1) === 1 ? 'checked' : '' ?>>
                <span><strong>Active</strong><small>Visible in the testimonials section</small></span>
            </label>
        </div>
    </div>

    <div class="admin-actions">
        <button type="submit" class="admin-button admin-button--primary"><?= e($submitLabel ?? 'Save Testimonial') ?></button>
        <a href="testimonials.php" class="admin-button admin-button--quiet">Cancel</a>
    </div>
</form>
