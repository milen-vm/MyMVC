<?php
namespace MyMVC\Application\Controllers;

use MyMVC\Library\MVC\BaseController;
use MyMVC\Library\MVC\View;
use MyMVC\Application\ViewModels\User;

class HomeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        return new View(new User('Милен', 'Милев', 35));
    }
}