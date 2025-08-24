<?php

namespace Login\controller;

use Login\interfaces\RequestInterface as Request;
use Login\interfaces\ResponseInterface as Response;

class UserController
{
    public function index(Request $request, Response $response)
    {
        $params = ["name" => "cris", "role" => "admin"];
        return $response->view("index", $params);
    }

    public function create(Request $request, Response $response)
    {
        $method = $request->getMethod();
        if ($method !== 'POST') $response->setStatusCode(405)->text('Bad Request');
    }
}
