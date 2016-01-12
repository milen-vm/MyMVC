<?php
namespace MyMVC\Application\Models;

use MyMVC\Library\MVC\BaseModel;

class UserModel extends BaseModel
{
    public function register($username, $pasword, $email)
    {
        $db = $this->getDb();
    }
}