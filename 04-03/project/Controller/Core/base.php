<?php

namespace Controller\Core;

use Model\Core\Request;

abstract class Base
{
    protected $request = NULL;
    public function redirect($controller, $action = null)
    {
        if ($action == null) {
            header("Location:" . \Index::getBaseUrl() . '?c=' . $controller);
        }
        header("Location:" . \Index::getBaseUrl() . '?c=' . $controller . '&a=' . $action);
    }

    public function getBaseUrl()
    {
        return \Index::getBaseUrl();
    }

    public function setRequest()
    {
        $this->request = new Request();
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getUrl($action = null, $controller = null, $params = [])
    {
        $parameter = [
            'c' => $controller,
            'a' => $action
        ];

        if ($action == null) {
            $parameter['a'] = $this->getRequest()->getActionName();
        }

        if ($controller == null) {
            $parameter['c'] = $this->getRequest()->getControllerName();
        }

        $parameter = array_merge($parameter, array_filter($params));
        return $this->getBaseUrl() . '?' . http_build_query($parameter);
    }
}
