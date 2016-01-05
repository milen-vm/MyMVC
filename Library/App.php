<?php
namespace MyMVC\Library;

class App
{

    private static $instance = null;

    private static $uri;
    
    /**
     * 
     * @var \MyMVC\Library\Router
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

    public function start()
    {
        self::setUri();
        self::$router = new Router(self::$uri);
    }

    private static function setUri()
    {
        $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $baseDir = dirname(dirname($_SERVER['PHP_SELF']));
        
        $uri = str_replace($baseDir, '', $request);
        self::$uri = trim($uri, '/');
    }

    public function getUri()
    {
        return self::$uri;
    }
    
    /**
     * 
     * @return \MyMVC\Library\Router
     */
    public static function getRouter()
    {
        return self::$router;
    }
}