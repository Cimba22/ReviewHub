<?php



class SessionManager
{

    public static function startSession(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function getCurrentUserID()
    {
        self::startSession();
        return $_SESSION['userID'] ?? null;
    }

    public static function getCurrentUserLogin()
    {
        self::startSession();
        return $_SESSION['login'] ?? null;
    }

    public static function getCurrentUserRoleID()
    {
        self::startSession();
        return $_SESSION['roleID'] ?? null;
    }

    public static function isUserLoggedIn(): bool
    {
        self::startSession();
        return !empty($_SESSION['userID']);
    }


}