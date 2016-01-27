<?php
namespace MyMVC\Library\Utility;

use MyMVC\Library\Config;

class Hellper
{

    public static function buildUrl($lang = null, $route = null,
        $controler = null, $action = null, $params = [])
    {
        $url = LINK_PREFIX;

        if ($lang == null) {
            $storedLang = Storage::get('lang');
        	if ($storedLang != null && $storedLang != Config::get('defaultLanguage')) {
        		$url .= "/{$storedLang}";
        	}
        } else {
            $url .= "/{$lang}";
        }

        if ($route !== null && $route !== Config::get('defaultRoute')) {
            $url .= "/{$route}";
        }

        if ($controler !== null) {
        	$url .= "/{$controler}";
        }

        if ($action !== null) {
            $url .= "/{$action}";

            foreach ($params as $param) {
                $url .= "/{$param}";
            }
        }

        return $url;
    }
}