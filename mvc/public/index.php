<?php

// require '../App/Controllers/Posts.php';
// require '../Core/Router.php';

//autoload
require_once  '../vendor/autoload.php';

// error and error handling
error_reporting(E_ALL);
set_error_handler('\Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/&id=2', ['controller' => 'Posts', 'action' => '&id=2']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'admin']);

// echo '<pre>';
// htmlspecialchars(print_r($router->getRoutes()), true);
// echo '</pre>';

$url = $_SERVER['QUERY_STRING'];

// if ($router->match($url)) {
//     echo '<pre>';
//     var_dump($router->getParams());
//     echo '</pre>';
// } else {
//     echo "404 page not found";
// }

$router->dispatch($url);
