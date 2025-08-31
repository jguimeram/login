<?php

namespace Login\controller;

use Login\interfaces\RequestInterface as Request;
use Login\interfaces\ResponseInterface as Response;

class LoginController
{
    public function index(Request $request, Response $response)
    {
        $response->view('login/index');
    }

    public function create(Request $request, Response $response)
    {
        var_dump($_POST);
    }

    public function update($request, $response) {}

    public function delete($request, $response) {}
}
