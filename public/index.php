<?php

require('../vendor/autoload.php');
include('../src/helpers/functions.php');

use Login\app\Router;
use Login\interfaces\RequestInterface as Request;
use Login\interfaces\ResponseInterface as Response;

$router = new Router;

$router->get('/', function (Request $request, Response $response) {
    return $response->html('<h1>Hello, World</h1>');
});

$router->get('/users', function (Request $request, Response $response) {
    return $response->html('<h1>From Users</h1>');
});

$router->get('/admin', function (Request $request, Response $response) {
    return ["user" => "admin"];
});

$router->get('/users/{id}', function (Request $request, Response $response) {
    return $response->json(["id" => "5"]);
});



$router->dispatch();
