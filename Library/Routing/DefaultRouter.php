<?php
namespace MyMVC\Library\Routing;

use MyMVC\Library\Config;

class DefaultRouter implements IRouter
{
    
    private $uri;
    
    private $requestMethod;
    
    private $controller;
    
    private $action;
    
    private $params;
    
    private $route;
    
    private $area;
    
    private $language;
    
    public function __construct()
    {
        $this->setUri();
        $this->setRequestMethod();

        // Set defaults from config file
        $this->controller = Config::get('defaultController');
        $this->action = Config::get('defaultAction');       
        $this->route = Config::get('defaultRoute');

        $routes = Config::get('routes');
        $this->area = isset($routes[$this->route]) ? $routes[$this->route] : null;
        $this->language = Config::get('defaultLanguage');

        $this->parseUri($routes);
    }
    
    private function parseUri($routes)
    {
        $pathParts = explode('/', $this->uri);
    
        if (current($pathParts)) {
    
            // Get language at first element
            if (in_array(current($pathParts), Config::get('languages'))) {
                $this->language = array_shift($pathParts);
            }
    
            // Get route at next element
            if (in_array(current($pathParts), array_keys($routes))) {
                $this->route = array_shift($pathParts);
                $this->area = isset($routes[$this->route]) ? $routes[$this->route] : null;
            }
    
            // Get controller and action - next element of array
            if (count($pathParts)) {
                $this->controller = array_shift($pathParts);
                 
                if (count($pathParts)) {
                    $this->action = array_shift($pathParts);
                }
            }
    
            // Get params - all the rest
            $this->params = $pathParts;
        }
    }
    
    public function getUri()
    {
        return $this->uri;
    }
    
    private function setUri()
    {
        $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $baseDir = dirname(dirname($_SERVER['PHP_SELF']));
    
        $uri = str_replace($baseDir, '', $request);
        $this->uri = trim($uri, '/');
    }
    
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }
    
    private function setRequestMethod()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }
    
    public function getParams()
    {
        return $this->params;
    }
    
    public function getRoute()
    {
        return $this->route;
    }
    
    public function getArea()
    {
        return $this->area;
    }
    
    public function getLanguage()
    {
        return $this->language;
    }
}