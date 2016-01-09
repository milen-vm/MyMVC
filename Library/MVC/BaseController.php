<?php
namespace MyMVC\Library\MVC;

use MyMVC\Library\App;

abstract class BaseController
{

    protected $model;

    protected $params;

    protected function __construct()
    {
        $this->params = App::getRouter()->getParams();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getParams()
    {
        return $this->params;
    }
}