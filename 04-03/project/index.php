<?php

class Index
{
    public static function getBaseDir($path = NULL)
    {
        if ($path == NULL) {
            return getcwd();
        }
        return getcwd() . DIRECTORY_SEPARATOR . $path;
    }

    public static function getBaseUrl($url = NULL)
    {
        if ($url == NULL) {
            return $_SERVER['PHP_SELF'];
        }
        return $_SERVER['PHP_SELF']  . $url;
    }

    public static function init()
    {
        \Controller\Core\Front::Init();
    }
}

spl_autoload_register(
    function ($className) {
        $fileName = Index::getBaseDir($className) . '.php';
        require_once $fileName;
    }
);

Index::init();
