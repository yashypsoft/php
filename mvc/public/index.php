<?php

// require '../App/Controllers/Posts.php';
// require '../Core/Router.php';

//autoload
require_once  '../vendor/autoload.php';

// //auto load function
// spl_autoload_register(
//     function ($class) {
//         $root = dirname(__DIR__);
//         $file = $root . '/' . str_replace('//', '/', $class) . '.php';
//         if (is_readable($file)) {
//             require $file;
//         }
//     }
// );

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
