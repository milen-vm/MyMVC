<?php
namespace MyMVC\Library\MVC;

use MyMVC\Library\App;

class View
{
    
    const VIEW_EXTENSION = '.php';
    
    private $data;
    
    private $path;
    
    public function __construct($data = [], $path = null)
    {
        $this->data = $data;
        $this->setPath($path);
    }
    
    private function setPath($path)
    {
        if ($path == null) {
        	$this->path = self::getDefaultViewPath();
        } elseif (!file_exists($path)) {
        	throw new \Exception("Templeate file is not found in the path {$path}");
        } else {
            $this->path = $path;
        }
    }
    
    private function getDefaultViewPath()
    {
        $router = App::getRouter();
        if (!$router) {
        	throw new \Exception('Router not found. Can not get controller name.');
        }
        
        $controllerDir = ucfirst(strtolower($router->getController()));
        $templeatName = $router->getArea().$router->getAction().self::VIEW_EXTENSION;

        return VIEWS_PATH.DS.$controllerDir.DS.$templeatName;
    }
    
    public function render()
    {
        $data = $this->data;
        
        ob_start();
        require $this->path;
        $content = ob_get_clean();
        
        return $content;
    }
}