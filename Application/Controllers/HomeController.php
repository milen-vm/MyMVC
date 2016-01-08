<?php
namespace MyMVC\Application\Controllers;

use MyMVC\Library\MVC\BaseController;

class HomeController extends BaseController
{
    
    public function __construct($data = [])
    {
        parent::__construct($data);
    }
    
    public function index()
    {
        $this->data['testContent'] = 'Echo from Home controller, index action';
    }
}