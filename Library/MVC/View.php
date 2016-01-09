<?php
namespace MyMVC\Library\MVC;

use MyMVC\Library\App;

class View
{

    const ARGS_COUNT_MODEL_AND_VIEW = 2;

    const VIEW_EXTENSION = '.php';

    private $viewPath;

    public function __construct($model = null, $path = null)
    {
        $this->setPath($path);
        $this->render($model);
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
        $router = App::getRouter();
        if (!$router) {
        	throw new \Exception('Router not found. Can not get controller name.');
        }

        $controllerDir = strtolower($router->getController());
        $templeatName = $router->getArea().$router->getAction().self::VIEW_EXTENSION;

        return ROOT_VIEWS_DIR.$controllerDir.DIRECTORY_SEPARATOR.$templeatName;
    }

    private function render($model)
    {
        require $this->viewPath;
    }
}
