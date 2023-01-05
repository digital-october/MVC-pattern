<?php

use Core\{
    Registry,
    View\View,
    Database\Database,
    Response\Response,
    Routing\RouteCollection,
};

$config = include __DIR__ . '/../config/database.php';
$db = new Database();
$db->connection($config['host'], $config['database'], $config['username'], $config['password']);

Registry::add([
    'view' => (new View())->init(),
    'response' => new Response(),
]);

$routeCollection = new RouteCollection();
$routeCollection->load(include __DIR__ . '/../app/routes.php');

$route = $routeCollection->find(explode('?', $_SERVER['REQUEST_URI'])[0], $_SERVER['REQUEST_METHOD']);

$route->runController();