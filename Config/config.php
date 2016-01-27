<?php

use MyMVC\Library\Config;

Config::set('siteName', 'MyMVC');

Config::set('sessionId', '_mymvc_sess_identi_');

Config::set('languages', ['bg', 'en']);

Config::set('defaultLanguage', 'bg');

Config::set('routes', [
	'default' => '',
	'admin' => 'admin',
]);

Config::set('defaultRoute', 'default');

Config::set('defaultController', 'Home');

Config::set('defaultAction', 'index');

// Database setings
Config::set('dbDrive', 'mysql');

Config::set('dbHost', 'localhost');

Config::set('dbUser', 'root');

Config::set('dbPass', '');

Config::set('dbName', 'mymvc');

Config::set('dbInstance', 'app');