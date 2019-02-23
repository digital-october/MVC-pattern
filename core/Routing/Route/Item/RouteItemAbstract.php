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
    protected $middleware;

    function __construct($url, $options = [])
    {
        $this->uri = strtolower($url);
        $this->method = isset($options['method']) ? strtoupper($options['method']) : 'GET';
        $this->params = isset($options['params']) ? $options['params'] : null;
        $this->controller = $options['controller'];
        $this->action = $options['action'];
        $this->middleware = isset($options['middleware']) ? $options['middleware'] : [];
    }

    public function runController()
    {
        if ($this->runMiddleware()) {
            $controller = new $this->controller();
            return Controller::exitHandler($controller->{$this->action}());
        }
    }

    protected function runMiddleware()
    {
        foreach ($this->middleware as $middleware) {
            $mid = new $middleware();
            if (!$mid->handle()) {
                return false;
            }
        }

        return true;
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