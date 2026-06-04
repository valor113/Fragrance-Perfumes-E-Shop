<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\ProductController;
use App\Core\Auth;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    (new ProductController())->destroy((int) ($_POST['id'] ?? 0));
}

header('Location: index.php');
exit;
