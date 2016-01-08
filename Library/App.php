<?php
namespace MyMVC\Library;

use MyMVC\Library\Routing\IRouter;
use MyMVC\Library\MVC\View;

class App
{
    
    const CONTROLLERS_NAMESPACE = '\\MyMVC\\Application\\Controllers\\';
    
    const CONTROLLERS_SUFFIX = 'Controller';
    
    private static $instance = null;
    
    /**
     * @todo replace DefaultRouter with IRouter
     * @var \MyMVC\Library\Routing\DefaultRouter
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
        
        $controllerClass = self::CONTROLLERS_NAMESPACE
            .ucfirst(strtolower(self::$router->getController()))
            .self::CONTROLLERS_SUFFIX;
        
        $controllerMethod = strtolower(self::getRouter()->getArea()
            .self::$router->getAction());

        /**
         * 
         *@var \MyMVC\Library\MVC\BaseController 
         */
        $controllerObject = new $controllerClass();
        if (method_exists($controllerObject, $controllerMethod)) {
            // Controller's action may return view path
        	$viewPath = $controllerObject->{$controllerMethod}();
        	$viewObject = new View($controllerObject->getData(), $viewPath);
        	$content = $viewObject->render();
        } else {
            throw new \Exception('Method '.$controllerMethod.' in class '
                .$controllerClass.' does not exist');
        }
        
        $layout = self::$router->getRoute();
        $layoutPath = VIEWS_PATH.DS.$layout.$viewObject::VIEW_EXTENSION;
        $layoutViewObject = new View(compact('content'), $layoutPath);
        echo $layoutViewObject->render();
    }
    
    /**
     * @todo replace DefaultRouter with IRouter
     * @return \MyMVC\Library\Routing\DefaultRouter
     */
    public static function getRouter()
    {
        return self::$router;
    }
}