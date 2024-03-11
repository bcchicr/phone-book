<?php

namespace Bcchicr\StudentList\Http\Middleware\Resolver;

use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Handler\RequestHandler;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Http\Middleware\Middleware;
use Closure;
use InvalidArgumentException;
use RuntimeException;

class Resolver
{
    public function resolve(mixed $handler): Middleware
    {
        if ($handler instanceof Middleware) {
            return $handler;
        }
        if (is_callable($handler)) {
            return $this->getMiddlewareFromCallable($handler);
        }
        $handlerType = $handler;
        throw new InvalidArgumentException("Cannot resolve handler. It has unknown type {$handlerType}");
    }
    private function getMiddlewareFromCallable(callable $handler)
    {
        return new class($handler) implements Middleware
        {
            private Closure $handler;
            public function __construct(callable $handler)
            {
                $this->handler = $handler(...);
            }
            public function process(Request $request, RequestHandler $handler): Response
            {
                $response = ($this->handler)($request, $handler);
                if (!$response instanceof Response) {
                    $responseType = get_debug_type($response);
                    throw new RuntimeException("Expected handler to return Response. {$responseType} was given");
                }
                return $response;
            }
        };
    }
}
