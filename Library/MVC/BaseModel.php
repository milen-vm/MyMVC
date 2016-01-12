<?php
namespace MyMVC\Library\MVC;

use MyMVC\Library\Core\Database;
use MyMVC\Library\Config;

abstract class BaseModel
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance(Config::get('dbInstance'));
    }

    protected function getDb()
    {
        return $this->db;
    }
}