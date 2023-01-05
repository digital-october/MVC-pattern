<?php

namespace Core\Routing;

use Core\Routing\Route\Collection\RouteCollectionAbstract;

class RouteCollection extends RouteCollectionAbstract
{
    public function load(array $routes): void
    {
        foreach ($routes as $route => $options) {
            $route = new RouteItem($options['uri'], $options);
            $this->add($route);
        }
    }

    public function getList(): array
    {
        return $this->collection;
    }
}