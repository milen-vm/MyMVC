<?php
namespace MyMVC\Library\MVC;

use MyMVC\Library\App;

abstract class BaseController
{

    protected $model;

    protected function __construct()
    {}

    public function getModel()
    {
        return $this->model;
    }
}