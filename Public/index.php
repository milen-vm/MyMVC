<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(dirname(__FILE__)) . DS);

require_once '..' . DS . 'Library' . DS . 'Autoloader.php';

\MyMVC\Library\Autoloader::init();

require_once '..' . DS . 'Config' . DS . 'config.php';

$router = new \MyMVC\Library\Routing\DefaultRouter();

$app = \MyMVC\Library\App::getInstance();
$app->start($router);