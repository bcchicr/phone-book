<?php

namespace Bcchicr\StudentList\Http\Router;

use Bcchicr\StudentList\Http\Foundation\Request;
use InvalidArgumentException;
use ReflectionClass;

class Router
{
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    public function __construct(
        private RouteCollection $routes
    ) {
    }
    public function getRoutes(): RouteCollection
    {
        return $this->routes;
    }
    public function get(string $path, array $handler): void
    {
        $this->register(self::METHOD_GET, $path, $handler);
    }
    public function post(string $path, array $handler): void
    {
        $this->register(self::METHOD_POST, $path, $handler);
    }
    public function match(Request $request): ?Route
    {
        return $this->routes->match($request);
    }

    private function register(
        string $method,
        string $path,
        array|callable $handler,
    ): void {
        if (!is_callable($handler)) {
            self::checkHandlerArray($handler);
            [$controllerName, $functionName] = $handler;
            $handler = [new $controllerName(), $functionName];
        }
        $route = new Route($method, $path, $handler);
        $this->routes->setRoute($route);
    }

    private static function checkHandlerArray(array $handler): void
    {
        $count = count($handler);
        if ($count !== 2) {
            throw new InvalidArgumentException("Expected handler array to contain 2 elements. {$count} elements array given");
        }
        [$controller, $method] = $handler;

        if (!is_string($controller)) {
            $type = get_debug_type($controller);
            throw new InvalidArgumentException("Expected first handler array element to be a string. {$type} given");
        }
        if (!is_string($method)) {
            $type = get_debug_type($controller);
            throw new InvalidArgumentException("Expected second handler array element to be a string. {$type} given");
        }
        if (!class_exists($controller)) {
            throw new InvalidArgumentException("Unknown controller {$controller}");
        }

        $controllerRef = new ReflectionClass($controller);
        if (!$controllerRef->hasMethod($method)) {
            throw new InvalidArgumentException("Controller {$controller} doesn't have method {$method}");
        }
        $methodRef = $controllerRef->getMethod($method);
        if (!$controllerRef->isInstantiable()) {
            if (!$methodRef->isStatic()) {
                throw new InvalidArgumentException("Controller {$controller} is not instantiable, and it cannot handle non-static method {$method}");
            }
        }
    }
}
