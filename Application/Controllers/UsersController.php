<?php
namespace MyMVC\Application\Controllers;

use MyMVC\Library\MVC\BaseController;
use MyMVC\Library\MVC\View;
use MyMVC\Application\Models\UserModel;
use MyMVC\Library\Utility\Storage;
use MyMVC\Library\Utility\Session;

class UsersController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return new View();
    }

    public function register()
    {

    }

    public function login()
    {
        if ($this->method == 'POST') {
        	$model = new UserModel();
        	$userData = $model->login($_POST);

        	Storage::set('name', $userData['name']);
        	Session::set('id', $userData['id']);
        	Session::set('role', $userData['role']);

        	$this->redirect(null, 'users');
        }

        return new View();
    }

    public function logout()
    {
//         var_dump(session_name());
//         var_dump(session_get_cookie_params());
        Session::destroy();

        $this->redirect();
    }
}