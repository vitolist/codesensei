<?php

class CSRF
{
    public static function generate()
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['csrf_token_expiry'] = time() + 3600; // Token valid for 1 hour
        return $_SESSION['csrf_token'];
    }

    public static function get()
    {
        // get token from session or create if not set
        if (!isset($_SESSION['csrf_token'])) {
            return self::generate();
        }
        return $_SESSION['csrf_token'];
    }

    public static function check($token)
    {
        if (
            isset($_SESSION['csrf_token'], $_SESSION['csrf_token_expiry']) &&
            $_SESSION['csrf_token'] === $token &&
            $_SESSION['csrf_token_expiry'] >= time()
        ) {
            unset($_SESSION['csrf_token'], $_SESSION['csrf_token_expiry']);
            return true;
        }
        return false;
    }

    public static function input()
    {
        // generates hidden input field with token
        return '<input type="hidden" name="csrf_token" value="' . self::generate() . '">';
    }
}
