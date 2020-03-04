<?php

namespace Controller\Core;
use Model\Core\Request;

class Front
{
    public static function Init()
    {
        $request = new Request();
        $controllerName = '\Controller\\' . ucfirst($request->getControllerName());

        if (!class_exists($controllerName)) {
            throw new \Exception("Class does not exists");
        }
        $controller = new $controllerName();

        $actionName = $request->getActionName() . 'Action';

        if (!method_exists($controller, $actionName)) {
            throw new \Exception("Method does not exists");
        }
        $controller->$actionName();
    }
}
