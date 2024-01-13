<?php

namespace session;

class SessionManager
{

    public static function getCurrentUserID()
    {
        session_start();
        return $_SESSION['user_id'] ?? null;
    }

}