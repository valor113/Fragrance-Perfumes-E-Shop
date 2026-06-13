<?php
require __DIR__ . '/bootstrap.php';

use App\Controllers\UserAuthController;

(new UserAuthController())->logout();
