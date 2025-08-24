<?php

require('../vendor/autoload.php');
include('../src/helpers/functions.php');

use Login\app\Router;
use Login\controller\UserController;
use Login\interfaces\RequestInterface as Request;
use Login\interfaces\ResponseInterface as Response;

$router = new Router;

$router->get('/', function (Request $request, Response $response) {
    return $response->html('<h1>Hello, World</h1>');
});

$router->get('/users', function (Request $request, Response $response) {
    return $response->html('<h1>From Users</h1>');
});

$router->get('/register', function (Request $request, Response $response) {
    $params = ["name" => "mia", "role" => "admin"];
    return $response->view("index", $params);
});

$router->post('/register', function (Request $request, Response $response) {
    $user = new UserController;
    return $user->create($request, $response);
});

$router->get('/users', function (Request $request, Response $response) {
    $user = new UserController;
    $user->index($request, $response);
});

$router->post('/post', function (Request $request, Response $response) {});

$router->get('/admin', function (Request $request, Response $response) {
    return ["user" => "admin"];
});

$router->get('/users/{id}', function (Request $request, Response $response) {
    $id = $request->getParams();
    return $response->json(["id" => $id['id']]);
});



$router->dispatch();
