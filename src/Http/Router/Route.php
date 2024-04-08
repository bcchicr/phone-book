<?php

namespace Bcchicr\Framework\Http\Router;

use Bcchicr\Framework\Http\Foundation\Request;
use Closure;

class Route
{
    private ?string $id = null;

    private string $path;
    private Closure $handler;
    private string $method;

    public function __construct(
        string $method,
        string $path,
        callable $handler
    ) {
        $this->handler = $handler(...);
        $this->method = $method;
        $this->path = $path;
    }
    public function match(Request $request): bool
    {
        $path = $request->getUri()->getPath();
        $method = $request->getMethod();
        return $method === $this->method && $path === $this->path;
    }
    public function getId(): string
    {
        if (!is_null($this->id)) {
            return $this->id;
        }
        return $this->id = $this->getMethod() . ':' . $this->getPath();
    }
    public function getMethod(): string
    {
        return $this->method;
    }
    public function getPath(): string
    {
        return $this->path;
    }
    public function getHandler(): array|callable
    {
        return $this->handler;
    }
    public function isAllowedMethod(string $method): bool
    {
        return $this->getMethod() === $method;
    }
}
