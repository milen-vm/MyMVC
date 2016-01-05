<?php

namespace MyMVC\Library;

class Autoloader
{
    
    public static function init()
    {
        spl_autoload_register(function ($class)
        {
            $pathElements = explode('\\', $class);
            array_shift($pathElements);
            $path = implode(DS, $pathElements);

            require_once ROOT_DIR . $path . '.php';
        });
    }
}