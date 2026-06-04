<?php

namespace App\Core;

abstract class Controller
{
    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    protected function flash(string $key, string $message): void
    {
        $_SESSION['flash'][$key] = $message;
    }

    protected function old(array $data, string $key, string $default = ''): string
    {
        return isset($data[$key]) ? (string) $data[$key] : $default;
    }
}
