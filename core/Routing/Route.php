<?php

namespace Core\Routing;

class Route
{

    public function get($uri, $action, array $middleware = [])
    {
        return $this->frame('get', $uri, $action, $middleware);
    }


    public function post($uri, $action, array $middleware = [])
    {
        return $this->frame('post', $uri, $action, $middleware);
    }


    public function put($uri, $action, array $middleware = [])
    {
        return $this->frame('put', $uri, $action, $middleware);
    }


    public function delete($uri, $action, array $middleware = [])
    {
        return $this->frame('delete', $uri, $action, $middleware);
    }


    private function frame($method, $uri, $action, $middleware)
    {
        $action = explode('@', $action);

        return [
            'uri' => $uri,
            'method' => $method,
            'controller' => 'App\Controllers\\'.$action[0],
            'action' => $action[1],
            'middleware' => $middleware,
        ];
    }
}