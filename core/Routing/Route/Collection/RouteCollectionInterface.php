<?php

namespace Core\Routing\Route\Collection;

use Core\Routing\Route\Item\RouteItemInterface;

interface RouteCollectionInterface
{
    public function get();

    public function add(RouteItemInterface $route);
}