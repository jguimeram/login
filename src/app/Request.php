<?php

declare(strict_types=1);

namespace Login\app;

use Login\interfaces\RequestInterface;


class Request implements RequestInterface
{

    private string $method;
    private string $path;
    private array $params = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $this->normalize($_SERVER['REQUEST_URI']);
    }

    private function normalize(string $path): string
    {
        if ($path === "/") return $path;
        $trimmed = rtrim($path, "/");
        $parsed = parse_url($trimmed, PHP_URL_PATH);
        return strtolower($parsed);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
