<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\UserAuth;
use App\Models\AppointmentRequest;

class AppointmentController extends Controller
{
    public function store(array $request): array
    {
        $loggedInUser = UserAuth::user();

        if ($loggedInUser) {
            $request['email'] = $loggedInUser['email'];

            if (($loggedInUser['phone_number'] ?? '') !== '') {
                $request['phone'] = $loggedInUser['phone_number'];
            }
        }

        $errors = [];

        if (trim((string) ($request['name'] ?? '')) === '') {
            $errors[] = 'Full name is required.';
        }

        if (!filter_var($request['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email address is required.';
        }

        if ($errors !== []) {
            return ['errors' => $errors, 'old' => $request];
        }

        (new AppointmentRequest(Database::getConnection()))->create($request);

        return ['success' => 'Thank you. Your appointment request was saved.'];
    }
}
