<?php

use MyMVC\Library\Config;

Config::set('siteName', 'MyMVC');

Config::set('languages', ['bg', 'en']);

Config::set('routes', [
	'default' => '',
	'admin' => 'admin',
]);

Config::set('defaultRoute', 'default');

Config::set('defaultLanguage', 'bg');

Config::set('defaultController', 'Home');

Config::set('defaultAction', 'Index');