<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\UserAuth;
use App\Models\CustomerUser;
use PDOException;

class UserAuthController extends Controller
{
    public function register(array $request): array
    {
        $username = trim((string) ($request['username'] ?? ''));
        $email = strtolower(trim((string) ($request['email'] ?? '')));
        $phoneNumber = trim((string) ($request['phone_number'] ?? ''));
        $password = (string) ($request['password'] ?? '');
        $passwordConfirmation = (string) ($request['password_confirmation'] ?? '');
        $old = [
            'username' => $username,
            'email' => $email,
            'phone_number' => $phoneNumber,
        ];
        $errors = [];

        if ($username === '') {
            $errors[] = 'Username is required.';
        } elseif (strlen($username) > 50) {
            $errors[] = 'Username must be 50 characters or fewer.';
        }

        if ($email === '') {
            $errors[] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        if ($phoneNumber === '') {
            $errors[] = 'Phone number is required.';
        } elseif (!$this->isValidPhoneNumber($phoneNumber)) {
            $errors[] = 'Please enter a valid phone number, including the country code when applicable.';
        }

        if ($password === '') {
            $errors[] = 'Password is required.';
        } elseif (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters.';
        }

        if ($passwordConfirmation === '') {
            $errors[] = 'Password confirmation is required.';
        } elseif ($password !== $passwordConfirmation) {
            $errors[] = 'Password confirmation does not match.';
        }

        if ($errors) {
            return ['errors' => $errors, 'old' => $old];
        }

        $users = new CustomerUser(Database::getConnection());

        if ($users->findByUsername($username)) {
            $errors[] = 'That username is already registered.';
        }

        if ($users->findByEmail($email)) {
            $errors[] = 'That email address is already registered.';
        }

        if ($errors) {
            return ['errors' => $errors, 'old' => $old];
        }

        try {
            $userId = $users->create(
                $username,
                $email,
                $phoneNumber,
                password_hash($password, PASSWORD_DEFAULT)
            );
        } catch (PDOException $exception) {
            if ((string) $exception->getCode() === '23000') {
                return [
                    'errors' => ['That username or email address is already registered.'],
                    'old' => $old,
                ];
            }

            throw $exception;
        }

        UserAuth::login([
            'id' => $userId,
            'username' => $username,
            'email' => $email,
            'phone_number' => $phoneNumber,
            'role' => 'user',
        ]);

        $this->redirect('index.php');
    }

    public function login(array $request): array
    {
        $email = strtolower(trim((string) ($request['email'] ?? '')));
        $password = (string) ($request['password'] ?? '');
        $old = ['email' => $email];

        if ($email === '' || $password === '') {
            return ['errors' => ['Please enter both email and password.'], 'old' => $old];
        }

        $user = (new CustomerUser(Database::getConnection()))->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return ['errors' => ['Invalid email or password.'], 'old' => $old];
        }

        UserAuth::login($user);
        $this->redirect('index.php');
    }

    public function logout(): void
    {
        UserAuth::logout();
        $this->redirect('index.php');
    }

    private function isValidPhoneNumber(string $phoneNumber): bool
    {
        if (strlen($phoneNumber) > 30 || !preg_match('/^\+?[0-9\s().-]+$/', $phoneNumber)) {
            return false;
        }

        $digits = preg_replace('/\D/', '', $phoneNumber);

        return strlen($digits) >= 7 && strlen($digits) <= 15;
    }
}
