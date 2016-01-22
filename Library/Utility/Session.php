<?php
namespace MyMVC\Library\Utility;

class Session
{

    public static function start()
    {
        session_start();
    }

    public static function destroy()
    {
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

    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}