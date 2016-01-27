<?php
namespace MyMVC\Library\MVC;

use MyMVC\Library\App;
use MyMVC\Library\Utility\Hellper;

abstract class BaseController
{

    protected $method;

    protected function __construct()
    {
    	$this->method = App::getRouter()->getRequestMethod();
    }

    protected function redirect($route = null,
        $controler = null, $action = null, $params = [])
    {
        $url = Hellper::buildUrl(null, $route,
            $controler, $action, $params);

        header("Location: {$url}");
        exit();
    }

    public function index()
    {}
}