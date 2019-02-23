<?php

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();


$config = include __DIR__.'/../config/database.php';
$db = new Core\Database\Database();
$db->connection($config['host'], $config['database'], $config['username'], $config['password']);


\Core\Registry::add([
    'view' => (new \Core\View\View())->init(),
    'response' => new \Core\Response\Response(),
]);


$routeCollection = new Core\Routing\RouteCollection();
$routeCollection->load(include __DIR__ . '/../app/routes.php');

$route = $routeCollection->find(explode('?', $_SERVER['REQUEST_URI'])[0], $_SERVER['REQUEST_METHOD']);

$route->runController();
