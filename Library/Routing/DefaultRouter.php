<?php
namespace MyMVC\Library;

use MyMVC\Library\Config;

class Router
{

    private $uri;

    private $controller;

    private $action;

    private $params;
    
    private $route;
    
    private $methodPrefix;
    
    private $language;

    public function __construct($uri)
    {
        $this->uri = strtolower($uri);

        // Set defaults from config file
        $this->controller = Config::get('defaultController');
        $this->action = Config::get('defaultAction');
        $routes = Config::get('routes');
        $this->route = Config::get('defaultRoute');
        $this->methodPrefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
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
            	$this->methodPrefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
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
    
    public function getMethodPrefix()
    {
        return $this->methodPrefix;
    }
    
    public function getLanguage()
    {
        return $this->language;
    }
}