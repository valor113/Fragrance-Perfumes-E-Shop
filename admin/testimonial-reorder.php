<?php
require __DIR__ . '/../bootstrap.php';

use App\Controllers\TestimonialController;
use App\Core\Auth;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    (new TestimonialController())->move(
        (int) ($_POST['id'] ?? 0),
        (string) ($_POST['direction'] ?? '')
    );
}

header('Location: testimonials.php');
exit;
