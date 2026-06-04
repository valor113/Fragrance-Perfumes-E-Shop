<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Database;
use App\Models\User;

class AuthController extends Controller
{
    public function login(array $request): array
    {
        $email = trim((string) ($request['email'] ?? ''));
        $password = (string) ($request['password'] ?? '');

        if ($email === '' || $password === '') {
            return ['error' => 'Please enter both email and password.'];
        }

        $user = (new User(Database::getConnection()))->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return ['error' => 'Invalid login credentials.'];
        }

        Auth::login($user);
        $this->redirect('index.php');
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('login.php');
    }
}
