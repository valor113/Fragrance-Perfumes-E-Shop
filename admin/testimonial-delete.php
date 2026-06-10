<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\TestimonialController;
use App\Core\Auth;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    (new TestimonialController())->destroy((int) ($_POST['id'] ?? 0));
}

header('Location: testimonials.php');
exit;
