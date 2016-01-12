<?php
namespace MyMVC\Library\Utility;

class Storage
{

    const EXPIRATION_TIME = 2592000;    // 30 days

    public static function set(
        $name,
        $value,
        $expire = self::EXPIRATION_TIME,
        $path = '/',
        $domain = '',
        $secure = false
    ) {
        setcookie($name, $value, $expire, $path, $domain, $secure, true);
        $_COOKIE[$name] = $value;
    }

    public static function get($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }
}