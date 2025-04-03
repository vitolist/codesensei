<?php

class Router
{
    private $controller;
    private $action;
    private $params;

    public function __construct($url)
    {
        $urlArray = explode('/', $url);

        // Remove the first element of the array if it is empty
        if ($urlArray[0] == '') {
            array_shift($urlArray);
        }

        // Set the controller
        $this->controller = isset($urlArray[0]) ? $urlArray[0] : 'landing';
        array_shift($urlArray);

        // Set the action
        $this->action = isset($urlArray[0]) ? $urlArray[0] : 'index';
        array_shift($urlArray);

        // Set the parameters
        $this->params = $urlArray;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }

    public static function redirect($url)
    {
        header('Location: '. $url);
        exit;
    }
}
