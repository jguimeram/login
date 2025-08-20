<?php

declare(strict_types=1);

namespace Login\app;

use Login\interfaces\ResponseInterface;

class Response implements ResponseInterface
{

    const DEFAULT_STATUS_CODE = 200;
    private int $code = self::DEFAULT_STATUS_CODE;
    private string|array $message = "";
    private array $headers = [];
    private const HEADER_CONTENT_TYPE = 'Content-Type';
    private const MIME_JSON = 'application/json; charset=utf-8';
    private const MIME_HTML = 'text/html; charset=utf-8';
    private const MIME_TEXT = 'text/plain; charset=utf-8';

    public function setStatusCode(int $code = self::DEFAULT_STATUS_CODE): self
    {
        $this->code = $code;
        return $this;
    }

    public function setBodyMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setResponseHeader(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function setHeaders(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function getBodyMessage(): string
    {
        return $this->message;
    }

    public function text(string $msg): self
    {
        $this->setHeaders(self::HEADER_CONTENT_TYPE, self::MIME_TEXT);
        $this->setBodyMessage($msg);
        return $this;
    }

    public function html(string $msg): self
    {
        $this->setHeaders(self::HEADER_CONTENT_TYPE, self::MIME_HTML);
        $this->setBodyMessage($msg);
        return $this;
    }

    public function json(array $json): self
    {
        $this->setHeaders(self::HEADER_CONTENT_TYPE, self::MIME_JSON);
        $this->setBodyMessage(json_encode($json));
        return $this;
    }

    public function view(?string $file, mixed $params): self
    {
        $render = new Render;
        $view = $render->load($file, $params);
        $this->setHeaders(self::HEADER_CONTENT_TYPE, self::MIME_HTML);
        $this->setBodyMessage($view);
        return $this;
    }

    public function send(): void
    {

        http_response_code($this->code);
        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
        echo $this->message;
    }
}
