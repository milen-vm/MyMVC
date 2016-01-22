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
        $ip = '46.233.7.17'; //$_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

        return new View(new User('Милен', 'Милев', 35));
    }
}