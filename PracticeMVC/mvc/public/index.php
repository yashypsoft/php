<?php

//autoload
session_start();
require_once  '../vendor/autoload.php';

// error and error handling
error_reporting(E_ALL);
set_error_handler('\Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'show' ,'urlkey'=>'home']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/&id=2', ['controller' => 'Posts', 'action' => '&id=2']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'admin']);
$router->add('admin/{controller}/{id:\d+}/{action}', ['namespace' => 'admin']);
$router->add('admin/{controller}/{action}/{urlkey}', ['namespace' => 'admin']);
$router->add('{controller}/{action}/{urlkey}');





$url = $_SERVER['QUERY_STRING'];



$router->dispatch($url);
