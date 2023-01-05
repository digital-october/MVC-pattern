<?php

namespace Core\Controller;

use Core\Registry;

abstract class Controller
{
    /**
     * @param $response
     * @return int|null
     */
    public static function exitHandler($response): int|null
    {
        if (is_object($response) && get_class($response) == get_class(Registry::response())) {
            $response->exec();
            $response = $response->getBody();
        }

        if (is_string($response)) {
            echo $response;
            return 1;
        }

        if (is_array($response) || is_object($response)) {
            echo json_encode($response);
            return 1;
        }
    }
}