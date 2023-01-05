<?php

namespace Core\Routing\Route\Item;

use Core\Controller\Controller;

abstract class RouteItemAbstract implements RouteItemInterface
{
    protected $uri;
    protected $method;
    protected $controller;
    protected $action;
    protected $params;

    function __construct($url, $options = [])
    {
        $this->uri = strtolower($url);
        $this->method = isset($options['method']) ? strtoupper($options['method']) : 'GET';
        $this->params = $options['params'] ?? null;
        $this->controller = $options['controller'];
        $this->action = $options['action'];
    }

    public function runController()
    {
        $controller = new $this->controller();
        return Controller::exitHandler($controller->{$this->action}(1));
    }


    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }


}