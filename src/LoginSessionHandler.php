<?php

class LoginSessionHandler
{
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function getCurrentUserId(): int|false
    {
        if (!isset($_SESSION['uid'])) {
            return false;
        }

        return $_SESSION['uid'];
    }

    public function redirectIfLoggedIn(string $location = 'account.php'): void
    {
        if (isset($_SESSION['uid'])) {
            header("Location: $location");
        }
    }

    public function redirectIfLoggedOut(string $location = 'login.php'): void
    {
        if (!isset($_SESSION['uid'])) {
            header("Location: $location");
        }
    }

    public function setLoggedIn(int $uid): void
    {
        if (isset($_SESSION['uid'])) {
            throw new Exception('Error - User already logged in');
        }

        $_SESSION['uid'] = $uid;
    }

    public function logout(): void
    {
        session_destroy();
    }
}