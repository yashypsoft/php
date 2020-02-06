<?php
class Router
{
    protected $routes = [];
    protected $params = [];


    public function add($routes, $params)
    {
        $this->routes[$routes] = $params;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    public function getParams()
    {
        return $this->params;
    }
}
