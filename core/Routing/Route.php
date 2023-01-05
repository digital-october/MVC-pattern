<?php

namespace Core\Routing;

use JetBrains\PhpStorm\ArrayShape;

class Route
{
    public function get(string $uri, string $action): array
    {
        return $this->frame('get', $uri, $action);
    }

    public function post(string $uri, string $action): array
    {
        return $this->frame('post', $uri, $action);
    }
    
    public function put(string $uri, string $action): array
    {
        return $this->frame('put', $uri, $action);
    }

    public function delete(string $uri, string $action): array
    {
        return $this->frame('delete', $uri, $action);
    }

    #[ArrayShape([
        'uri' => "string",
        'method' => "string",
        'controller' => "string",
        'action' => "string"
    ])]
    private function frame(string $method, string $uri, string $action): array
    {
        $action = explode('@', $action);

        return [
            'uri' => $uri,
            'method' => $method,
            'controller' => 'App\Controllers\\' . $action[0],
            'action' => $action[1],
        ];
    }
}