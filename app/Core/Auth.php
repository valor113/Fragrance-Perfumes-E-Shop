<?php

namespace App\Core;

class Auth
{
    public static function check(): bool
    {
        return (
            isset($_SESSION['admin_user'])
            && ($_SESSION['admin_user']['role'] ?? '') === 'admin'
        ) || UserAuth::isAdmin();
    }

    public static function user(): ?array
    {
        if (
            isset($_SESSION['admin_user'])
            && ($_SESSION['admin_user']['role'] ?? '') === 'admin'
        ) {
            return $_SESSION['admin_user'];
        }

        return UserAuth::isAdmin() ? UserAuth::user() : null;
    }

    public static function login(array $user): void
    {
        session_regenerate_id(true);
        $_SESSION['admin_user'] = [
            'id' => (int) $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => 'admin',
        ];
    }

    public static function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
    }

    public static function requireAdmin(): void
    {
        if (!self::check()) {
            header('Location: login.php');
            exit;
        }
    }
}
