<?php

$route = new \Core\Routing\Route();

return [

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register routes for your application.
    |
    */

    $route->get('/', 'HomeController@index'),

];