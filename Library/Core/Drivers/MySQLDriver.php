<?php
namespace MyMVC\Library\Core\Drivers;

class MySQLDriver extends BaseDriver
{

    public function getDSN()
    {
        $dsn = $dns = 'mysql:host='.$this->host.';dbname='.$this->dbName;

        return $dsn;
    }
}