<?php
require __DIR__ . '/bootstrap.php';

use App\Core\Database;
use App\Core\UserAuth;
use App\Models\Cart;
use App\Models\Product;

if (!UserAuth::check()) {
    header('Location: login.php');
    exit;
}

$userId = (int) UserAuth::user()['id'];
$db = Database::getConnection();
$cart = new Cart($db);
$products = new Product($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
        http_response_code(403);
        exit('Invalid request token.');
    }

    $action = (string) ($_POST['action'] ?? '');
    $productId = filter_var($_POST['product_id'] ?? null, FILTER_VALIDATE_INT);

    if ($action === 'clear') {
        $cart->clear($userId);
        $_SESSION['flash']['cart_success'] = 'Your cart has been cleared.';
    } elseif (in_array($action, ['add', 'update', 'remove'], true) && $productId) {
        if ($action === 'remove') {
            $cart->remove($userId, (int) $productId);
            $_SESSION['flash']['cart_success'] = 'The item was removed from your cart.';
        } else {
            $product = $products->find((int) $productId);
            $requestedQuantity = filter_var($_POST['quantity'] ?? 1, FILTER_VALIDATE_INT);

            if (
                !$product
                || (int) $product['is_active'] !== 1
                || (int) $product['stock_quantity'] < 1
            ) {
                $_SESSION['flash']['cart_error'] = 'That product is not currently available.';
            } elseif ($requestedQuantity === false || $requestedQuantity < 1) {
                $_SESSION['flash']['cart_error'] = 'Quantity must be at least 1.';
            } else {
                $quantity = (int) $requestedQuantity;

                if ($action === 'add') {
                    $quantity += $cart->quantity($userId, (int) $productId);
                }

                $maximum = min(99, (int) $product['stock_quantity']);

                if ($quantity > $maximum) {
                    $quantity = $maximum;
                    $_SESSION['flash']['cart_error'] = 'Quantity was adjusted to the available stock.';
                } else {
                    $_SESSION['flash']['cart_success'] = $action === 'add'
                        ? 'Product added to your cart.'
                        : 'Cart quantity updated.';
                }

                $cart->save($userId, (int) $productId, $quantity);
            }
        }
    } else {
        $_SESSION['flash']['cart_error'] = 'Invalid cart request.';
    }

    header('Location: cart.php');
    exit;
}

$items = $cart->items($userId);
$total = 0.0;

foreach ($items as $item) {
    $total += (float) $item['price'] * (int) $item['quantity'];
}

$success = flash('cart_success');
$error = flash('cart_error');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Maison Doree</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/mobile-nav.php'; ?>

    <main class="cart-page">
        <div class="container">
            <div class="section-header cart-header">
                <div class="section-header-left">
                    <p class="text-label">Your Selection</p>
                    <h1 class="heading-display section-title">Shopping Cart</h1>
                    <p class="text-body section-subtitle">Saved to <?= e(UserAuth::user()['username']) ?>'s account.</p>
                </div>
                <?php if ($items): ?>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                        <input type="hidden" name="action" value="clear">
                        <button class="btn-text cart-clear" type="submit">Clear Cart</button>
                    </form>
                <?php endif; ?>
            </div>

            <?php if ($success): ?>
                <p class="auth-alert auth-alert--success" role="status"><?= e($success) ?></p>
            <?php endif; ?>
            <?php if ($error): ?>
                <p class="auth-alert auth-alert--error" role="alert"><?= e($error) ?></p>
            <?php endif; ?>

            <?php if (!$items): ?>
                <div class="cart-empty">
                    <h2 class="heading-display">Your cart is empty.</h2>
                    <p>Explore the fragrance collection and save your favorites here.</p>
                    <a class="btn-primary" href="shop.php">Browse Fragrances</a>
                </div>
            <?php else: ?>
                <div class="cart-layout">
                    <div class="cart-items">
                        <?php foreach ($items as $item): ?>
                            <article class="cart-item">
                                <img src="<?= e($item['image_path']) ?>" alt="<?= e($item['image_alt']) ?>">
                                <div class="cart-item-copy">
                                    <h2 class="heading-display"><?= e($item['name']) ?></h2>
                                    <p><?= e($item['description']) ?></p>
                                    <strong><?= e(money($item['price'], $item['currency'])) ?></strong>
                                    <?php if ((int) $item['is_active'] !== 1): ?>
                                        <p class="cart-unavailable">This product is no longer available.</p>
                                    <?php endif; ?>
                                </div>
                                <div class="cart-item-actions">
                                    <?php if ((int) $item['is_active'] === 1 && (int) $item['stock_quantity'] > 0): ?>
                                        <form method="post" action="cart.php" class="cart-quantity-form">
                                            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="product_id" value="<?= (int) $item['product_id'] ?>">
                                            <label for="quantity-<?= (int) $item['product_id'] ?>">Quantity</label>
                                            <input id="quantity-<?= (int) $item['product_id'] ?>" type="number" name="quantity" value="<?= (int) $item['quantity'] ?>" min="1" max="<?= min(99, (int) $item['stock_quantity']) ?>" required>
                                            <button class="btn-primary" type="submit">Update</button>
                                        </form>
                                    <?php endif; ?>
                                    <form method="post" action="cart.php">
                                        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="product_id" value="<?= (int) $item['product_id'] ?>">
                                        <button class="btn-text cart-remove" type="submit">Remove</button>
                                    </form>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <aside class="cart-summary">
                        <p class="text-label">Order Summary</p>
                        <div><span>Items</span><strong><?= array_sum(array_column($items, 'quantity')) ?></strong></div>
                        <div class="cart-total"><span>Total</span><strong><?= e(money($total)) ?></strong></div>
                        <p>Checkout is not configured yet. Your cart will remain saved to this account.</p>
                    </aside>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'partials/footer.php'; ?>
    <script src="templatemo-maison-doree.js"></script>
</body>
</html>
