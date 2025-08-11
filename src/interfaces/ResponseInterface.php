<?php

namespace Login\interfaces;

interface ResponseInterface
{
    public function setStatusCode(int $code): self;
    public function setBodyMessage(string $message): self;
    public function setResponseHeader(array $headers): self;
    public function setHeaders(string $name, string $value): self;
    public function getBodyMessage(): string|array;
    public function html(string $html): self;
    public function text(string $text): self;
    public function json(array $json): self;
    public function send(): void;
}
