<?php

namespace Core\Routing\Route\Collection;

use Core\Routing\Route\Item\RouteItemInterface;

abstract class RouteCollectionAbstract implements RouteCollectionInterface
{
    protected $collection = [];


    public function add(RouteItemInterface $route)
    {
        $this->collection[] = $route;
    }


    public function get()
    {
        return $this->collection;
    }


    public function find($url, $method = 'GET')
    {
        $url = strtolower($url);

        return $this->findCollection(function ($item) use ($url, $method) {
            if ($item->getUri() == $url && $item->getMethod() == strtoupper($method)) {
                return $item;
            }
        });
    }

    protected function findCollection(callable $callable)
    {
        $result = null;
        foreach ($this->collection as $item) {
            $result = $callable($item);
            if ($result) {
                return $result;
            }
        }
    }
}