<?php
namespace MyMVC\Library;

use MyMVC\Library\Routing\IRouter;

class App
{

    private static $instance = null;
    
    /**
     * 
     * @var \MyMVC\Library\Routing\IRouter
     */
    private static $router;

    private function __construct()
    {}

    /**
     *
     * @return \MyMVC\Library\App
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    public function start(IRouter $router)
    {
        self::$router = $router;
        var_dump(self::$router);
    }
    
    /**
     * 
     * @return \MyMVC\Library\Routing\IRouter
     */
    public static function getRouter()
    {
        return self::$router;
    }
}