<?php

declare(strict_types=1);

namespace Login\app;

use Login\app\Request;
use Login\app\Response;
use Throwable;

class Router
{
    private const HTTP_METHODS = [
        'GET' => true,
        'POST' => true,
        'PUT' => true,
        'PATCH' => true,
        'DELETE' => true
    ];

    private array $routes = [];
    private Request $request;
    private Response $response;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
    }

    public function get(string $path, callable $handler)
    {
        return $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable $handler)
    {
        return $this->addRoute('POST', $path, $handler);
    }

    public function put(string $path, callable $handler)
    {
        return $this->addRoute('PUT', $path, $handler);
    }

    public function patch(string $path, callable $handler)
    {
        return $this->addRoute('PATCH', $path, $handler);
    }

    public function delete(string $path, callable $handler)
    {
        return $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute(string $method, string $path, callable $handler)
    {
        if (!isset(self::HTTP_METHODS[$method])) {
            throw new \InvalidArgumentException("Invalid HTTP method: {$method}");
        }

        $this->routes[$method][$path] = $handler;
        return $this;
    }

    public function executeHandler(callable $callback, Request $request, Response $response)
    {
        try {
            $result = call_user_func($callback, $request, $response);
            if ($result instanceof Response) {
                $result->send();
            } else if (is_string($result)) {
                $response->text($result)->send();
            } else if (is_array($result)) {
                $response->json($result)->send();
            } else if ($result === NULL) {
                $response->setStatusCode(200)->send();
            } else {
                throw new \InvalidArgumentException('Invalid response type');
            }
        } catch (\Throwable $th) {
            $response->setStatusCode(500)->text('Internal Server Error')->send();
        }
    }

    public function dispatch()
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();


        foreach ($this->routes[$method] ?? [] as $route => $callback) {
            $pattern = '#^' . preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route) . '$#';
            if (preg_match($pattern, $path, $matches)) {
                $params = [];
                foreach ($matches as $key => $value) {

                    if (!is_int($key)) {
                        $params[$key] = $value;
                    }
                }

                /*         //set the parameters of the url (id) */
                $this->request->setParams($params);

                $this->executeHandler($callback, $this->request, $this->response);

                return;
            }
        }
        $this->response->setStatusCode(404)->html('404 - Not found')->send();
    }
}
