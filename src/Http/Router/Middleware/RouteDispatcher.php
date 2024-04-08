<?php

namespace Bcchicr\Framework\Http\Router\Middleware;

use RuntimeException;
use Bcchicr\Framework\Http\Router\Route;
use Bcchicr\Framework\Http\Foundation\Stream;
use Bcchicr\Framework\Http\Foundation\Request;
use Bcchicr\Framework\Http\Foundation\Response;
use Bcchicr\Framework\Http\Middleware\Middleware;
use Bcchicr\Framework\Http\Handler\RequestHandler;
use Bcchicr\Framework\Http\Middleware\Resolver\Resolver;
use Bcchicr\Framework\Http\Foundation\Factory\ResponseFactory;

class RouteDispatcher implements Middleware
{
    public function __construct(
        private Resolver $resolver,
        private ResponseFactory $responseFactory
    ) {
    }
    public function process(Request $request, RequestHandler $handler): Response
    {
        $routeClass = Route::class;
        if (!$result = $request->getAttribute($routeClass)) {
            return $this->responseFactory->createResponse(404);
        }
        if (!$result instanceof Route) {
            $resultType = get_debug_type($result);
            throw new RuntimeException("Expected $routeClass object to process. {$resultType} given");
        }
        $result = $result->getHandler();
        $middleware = $this->resolver->resolve($result);
        return $middleware->process($request, $handler);
    }
}
