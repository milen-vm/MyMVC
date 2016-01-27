<?php
namespace MyMVC\Library\MVC;

use MyMVC\Library\App;
use MyMVC\Library\Utility\Storage;
use MyMVC\Library\Config;
use MyMVC\Library\Utility\Hellper;

class View
{

    const LAYOUTS_DIR_NAME = 'layouts';

    const LAYOUT_HEADER_FILE_NAME = 'header';

    const LAYOUT_FOOTER_FILE_NAME = 'footer';

    const VIEW_EXTENSION = '.php';

    /**
     * @todo replace DefaultRouter with IRouter
     * @var \MyMVC\Library\Routing\DefaultRouter
     */
    private static $router;

    private $viewPath;

    /**
     *
     * @param \MyMVC\Application\ViewModels $model
     * @param string $path
     * @param boolean $includeLayout
     */
    public function __construct($model = null, $path = null, $includeLayout = true)
    {
        $this->setRouter();
        $this->setPath($path);
        $this->render($model, $includeLayout);
    }

    private function setRouter()
    {
        $router = App::getRouter();
        if (!$router) {
            throw new \Exception('Router not found. Can not render view.');
        }

        self::$router = $router;
    }

    private function setPath($path)
    {
        if ($path == null) {
        	$path = self::getDefaultViewPath();
        } else {
            $path = strtolower($path);
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
            $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
            $path = trim($path, DIRECTORY_SEPARATOR);
            $path = ROOT_VIEWS_DIR.$path.self::VIEW_EXTENSION;

            if (!file_exists($path)) {
            	throw new \Exception("Templeate file is not found in the path {$path}");
            }
        }

        $this->viewPath = $path;
    }

    private function getDefaultViewPath()
    {
        $controllerDir = self::$router->getController();
        $templeatName = self::$router->getAction().self::VIEW_EXTENSION;

        return ROOT_VIEWS_DIR.$controllerDir.DIRECTORY_SEPARATOR.$templeatName;
    }

    private function render($model, $includeLayout)
    {
        if ($includeLayout) {
        $layoutDir = ROOT_VIEWS_DIR
        	   .self::LAYOUTS_DIR_NAME
        	   .DIRECTORY_SEPARATOR
        	   .self::$router->getRoute()
        	   .DIRECTORY_SEPARATOR;

        	$headerPath = $layoutDir
        	   .self::LAYOUT_HEADER_FILE_NAME
        	   .self::VIEW_EXTENSION;

        	require $headerPath;
        }

        require $this->viewPath;

        if ($includeLayout) {
            $footerPath = $layoutDir
            .self::LAYOUT_FOOTER_FILE_NAME
    	    .self::VIEW_EXTENSION;

            require $footerPath;
        }
    }

    public static function url($route = null,
        $controler = null, $action = null, $params = [])
    {
        echo Hellper::buildUrl(null, $route,
            $controler, $action, $params);
    }

    public static function isActiv($controllerName, $actionName)
    {
        $isActive = (strtolower($controllerName) == self::$router->getController()) &&
            (strtolower($actionName) == self::$router->getAction());

        echo $isActive ? 'active' : '';
    }
}