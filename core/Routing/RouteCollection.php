<?php

namespace Core\Routing;

use Core\Routing\Route\Collection\RouteCollectionAbstract;

class RouteCollection extends RouteCollectionAbstract
{
    public function load(array $routes)
    {
        foreach ($routes as $route => $options){
            $route = new RouteItem($options['url'], $options);
            $this->add($route);
        }
    }

    public function list(){
    	return $this->collection;
    }
}