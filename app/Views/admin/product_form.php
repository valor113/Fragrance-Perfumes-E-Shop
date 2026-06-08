<?php
$product = $product ?? [];
$old = $old ?? $product;
$action = $action ?? 'store';
?>
<form method="post" action="<?= e($action) ?>" class="admin-form">
    <div class="admin-form-section">
        <div class="admin-form-section-heading">
            <span>01</span>
            <div>
                <h2>Product identity</h2>
                <p>The essential details used throughout the catalog.</p>
            </div>
        </div>
    <div class="admin-form-grid">
        <div class="form-group">
            <label class="form-label" for="sku">SKU</label>
            <input class="form-input" type="text" id="sku" name="sku" value="<?= e($old['sku'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="slug">Slug</label>
            <input class="form-input" type="text" id="slug" name="slug" value="<?= e($old['slug'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input class="form-input" type="text" id="name" name="name" value="<?= e($old['name'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="brand">Brand</label>
            <input class="form-input" type="text" id="brand" name="brand" value="<?= e($old['brand'] ?? '') ?>">
        </div>
    </div>
    </div>
    <div class="admin-form-section">
        <div class="admin-form-section-heading">
            <span>02</span>
            <div>
                <h2>Pricing and presentation</h2>
                <p>Control how this fragrance appears in the boutique.</p>
            </div>
        </div>
    <div class="admin-form-grid">
        <div class="form-group">
            <label class="form-label" for="price">Price</label>
            <input class="form-input" type="number" step="0.01" min="0" id="price" name="price" value="<?= e((string) ($old['price'] ?? '')) ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="currency">Currency</label>
            <input class="form-input" type="text" id="currency" name="currency" maxlength="3" value="<?= e($old['currency'] ?? 'USD') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="image_path">Image path</label>
            <input class="form-input" type="text" id="image_path" name="image_path" value="<?= e($old['image_path'] ?? 'images/ysl.jpg') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="image_alt">Image alt text</label>
            <input class="form-input" type="text" id="image_alt" name="image_alt" value="<?= e($old['image_alt'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="badge">Badge</label>
            <select class="form-input" id="badge" name="badge">
                <option value="">No badge</option>
                <?php foreach (['New', 'Bestseller'] as $badge): ?>
                    <option value="<?= e($badge) ?>" <?= (($old['badge'] ?? '') === $badge) ? 'selected' : '' ?>><?= e($badge) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-textarea" id="description" name="description" required><?= e($old['description'] ?? '') ?></textarea>
    </div>
    </div>
    <div class="admin-form-section">
        <div class="admin-form-section-heading">
            <span>03</span>
            <div>
                <h2>Inventory and visibility</h2>
                <p>Set stock levels and storefront availability.</p>
            </div>
        </div>
    <div class="admin-form-grid">
        <div class="form-group">
            <label class="form-label" for="stock_quantity">Stock quantity</label>
            <input class="form-input" type="number" min="0" id="stock_quantity" name="stock_quantity" value="<?= e((string) ($old['stock_quantity'] ?? '0')) ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="sort_order">Sort order</label>
            <input class="form-input" type="number" min="0" id="sort_order" name="sort_order" value="<?= e((string) ($old['sort_order'] ?? '0')) ?>">
        </div>
    </div>
    <div class="admin-checks">
        <label><input type="checkbox" name="is_active" value="1" <?= ((int) ($old['is_active'] ?? 1) === 1) ? 'checked' : '' ?>><span><strong>Active</strong><small>Visible in the storefront</small></span></label>
        <label><input type="checkbox" name="is_featured" value="1" <?= ((int) ($old['is_featured'] ?? 0) === 1) ? 'checked' : '' ?>><span><strong>Featured</strong><small>Highlight this product</small></span></label>
    </div>
    </div>
    <div class="admin-actions">
        <button type="submit" class="admin-button admin-button--primary"><?= e($submitLabel ?? 'Save Product') ?></button>
        <a href="index.php" class="admin-button admin-button--quiet">Cancel</a>
    </div>
</form>
