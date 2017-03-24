<?php

return [
    [
        'url' => '/',
        'controller' => 'App\Controllers\TaskController',
        'action' => 'index',
        'method' => 'get'
    ],
    [
        'url' => '/test',
//        'middleware' => [
//            'App\Middleware\HelloMiddleware'
//        ],
        'controller' => 'App\Controllers\MainController',
        'action' => 'index',
        'method' => 'get'
    ],
    [
        'url' => '/hello',
        'controller' => 'App\Controllers\MainController',
        'action' => 'hello'
    ],

    [
        'url' => '/registration',
        'controller' => 'App\Controllers\UserController',
        'action' => 'registration',
        'method' => 'get'
    ],
    [
        'url' => '/registration',
        'controller' => 'App\Controllers\UserController',
        'action' => 'createUser',
        'method' => 'post'
    ],

    [
        'url' => '/new-task',
        'middleware' => [
            'App\Middleware\Authorization'
        ],
        'controller' => 'App\Controllers\TaskController',
        'action' => 'newTask',
        'method' => 'get'
    ],
    [
        'url' => '/new-task',
        'controller' => 'App\Controllers\TaskController',
        'action' => 'createTask',
        'method' => 'post'
    ],

    [
        'url' => '/show',
        'controller' => 'App\Controllers\TaskController',
        'action' => 'show',
        'method' => 'get'
    ],
    [
        'url' => '/edit',
        'controller' => 'App\Controllers\TaskController',
        'action' => 'edit',
        'method' => 'get'
    ],

    [
        'url' => '/auth',
        'controller' => 'App\Controllers\UserController',
        'action' => 'auth',
        'method' => 'get'
    ],
    [
        'url' => '/login',
        'controller' => 'App\Controllers\UserController',
        'action' => 'login',
        'method' => 'post'
    ],
    [
        'url' => '/logout',
        'controller' => 'App\Controllers\UserController',
        'action' => 'logout',
        'method' => 'get'
    ]
];