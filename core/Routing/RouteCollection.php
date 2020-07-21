<?php

namespace Core\Routing;

use Core\Routing\Route\Collection\RouteCollectionAbstract;

class RouteCollection extends RouteCollectionAbstract
{

    public function load(array $routes)
    {
        foreach ($routes as $route => $options) {
            $route = new RouteItem($options['uri'], $options);
            $this->add($route);
        }
    }


    public function getList()
    {
        return $this->collection;
    }
}