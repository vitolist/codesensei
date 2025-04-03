<?php

class Session
{
    private static $cookieName = 'studrent_session_id';
    private static $cookieLifetime = 3600; // 1 hour
    private static $isLoggedIn = false;

    // Start the session if it hasn't been started yet
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Check if the session is active
    public static function isActive()
    {
        return session_status() == PHP_SESSION_ACTIVE;
    }

    // Set a session variable
    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    // Get a session variable
    public static function get($key)
    {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Check if a session variable is set
    public static function has($key)
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    // Unset a session variable
    public static function delete($key)
    {
        self::start();
        unset($_SESSION[$key]);
    }

    // Destroy the session
    public static function destroy()
    {
        self::start();
        session_destroy();
        self::deleteCookie();
    }

    // Regenerate session ID
    public static function regenerate()
    {
        self::start();
        session_regenerate_id(true);
    }

    // Generate a unique session ID
    public static function generateSessionID()
    {
        return md5(uniqid(rand(), true));
    }

    // Set the custom session cookie
    public static function setCookie($value = null, $validDays = 30)
    {
        if ($value === null) {
            $value = self::generateSessionID();
        }
        setcookie(self::$cookieName, $value, time() + (86400 * $validDays), "/");
    }

    // Get the custom session cookie
    public static function getCookie()
    {
        return isset($_COOKIE[self::$cookieName]) ? $_COOKIE[self::$cookieName] : null;
    }

    // Delete the custom session cookie
    public static function deleteCookie()
    {
        if (isset($_COOKIE[self::$cookieName])) {
            setcookie(self::$cookieName, '', time() - 3600, "/");
            unset($_COOKIE[self::$cookieName]);
        }
    }

    // function for getting logged in information
    public static function isLoggedIn()
    {
        return self::$isLoggedIn;
    }

    public static function logIn($value = true)
    {
        self::$isLoggedIn = $value;
    }


}