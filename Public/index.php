<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(dirname(__FILE__)).DS);
define('ROOT_VIEWS_DIR', ROOT_DIR.'Application'.DS.'Views'.DS);
define('LINK_PREFIX', rtrim(
    str_replace($_SERVER['DOCUMENT_ROOT'], '', ROOT_DIR), DS)
);

require_once '..' . DS . 'Library' . DS . 'Autoloader.php';

\MyMVC\Library\Autoloader::init();

require_once '..' . DS . 'Config' . DS . 'config.php';

\MyMVC\Library\Utility\Session::start();

$router = new \MyMVC\Library\Routing\DefaultRouter();

$app = \MyMVC\Library\App::getInstance();
$app->start($router);