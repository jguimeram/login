<?php

require('../vendor/autoload.php');
include('../src/helpers/functions.php');

use Login\app\Router;
use Login\controller\LoginController;
use Login\interfaces\RequestInterface as Request;
use Login\interfaces\ResponseInterface as Response;

$router = new Router;

$router->get('/', function (Request $request, Response $response) {
    return $response->view('index');
});

$router->get('/login/index', function (Request $request, Response $response) {
    $user = new LoginController;
    return $user->index($request, $response);
});

$router->post('/login/create', function (Request $request, Response $response) {
    $user = new LoginController;
    return $user->create($request, $response);
});

$router->dispatch();
