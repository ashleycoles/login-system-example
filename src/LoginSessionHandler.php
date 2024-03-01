<?php

class LoginSessionHandler
{
    public function __construct()
    {
        // Connect to the session automatically whenever you instantiate a LoginSessionHandler
        if (session_status() !== PHP_SESSION_ACTIVE) { // Check to make sure the session isn't already active
            session_start();
        }
    }

    public function getCurrentUserId(): int|false
    {
        if (!$this->isUserLoggedIn()) {
            return false;
        }

        return $_SESSION['uid'];
    }

    public function isUserLoggedIn(): bool
    {
        return isset($_SESSION['uid']);
    }

    public function setLoggedIn(int $uid): void
    {
        if ($this->isUserLoggedIn()) {
            throw new Exception('Error - User already logged in');
        }

        $_SESSION['uid'] = $uid;
    }

    public function logout(): void
    {
        session_destroy();
    }
}