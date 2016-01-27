<?php
namespace MyMVC\Library\Utility;

use MyMVC\Library\Config;

class Session
{

    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_name(Config::get('sessionId'));
            session_start();
        }

        // For versions of PHP < 5.4.0
//         if(session_id() == '') {
//             session_start();
//         }
    }

    public static function destroy()
    {
        $_SESSION = [];
        session_destroy();
        self::start();
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function isSetKey($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}