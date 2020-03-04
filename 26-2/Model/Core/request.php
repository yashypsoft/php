<?php

class Request
{
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return false;
        }
        return true;
    }

    public function getPost($key = NULL, $returnValue = NULL)
    {   
        if (!$this->isPost()) {
            return NULL;
        }

        if ($key == NULL) {
            return $_POST;
        }

        if (array_key_exists($key, $_POST)) {
            return $_POST[$key];
        }

        return $returnValue;
    }

    public function getRequest($key = NULL, $returnValue = NULL)
    {
        // if ((!$this->isPost() &&!$this->isGet())) {
        //     return NULL;
        // }

        if ($key == NULL) {
            return $_REQUEST;
        }

        if (array_key_exists($key, $_REQUEST)) {
            return $_REQUEST[$key];
        }
        return $returnValue;
    }

    public function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            return false;
        }
        return true;
    }

    public function getGet($key = NULL, $returnValue = NULL)
    {
        if (!$this->isGet()) {
            return NULL;
        }

        if ($key == NULL) {
            return $_GET;
        }

        if (array_key_exists($key, $_GET)) {
            return $_GET[$key];
        }

        return $returnValue;
    }
}
