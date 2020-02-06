<?php

require '../Core/Router.php';

$router = new Router();

$router -> add('', ['controller' => 'Home', 'Action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'Action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'Action' => 'new']);
$router->add('posts/&id=2', ['controller' => 'Posts', 'Action' => '&id=2']);

$url = $_SERVER['QUERY_STRING'];
if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "404 page not found";
}
