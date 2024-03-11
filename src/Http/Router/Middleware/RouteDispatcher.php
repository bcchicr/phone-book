<?php

namespace Bcchicr\StudentList\Http\Router\Middleware;

use RuntimeException;
use Bcchicr\StudentList\Http\Router\Route;
use Bcchicr\StudentList\Http\Foundation\Stream;
use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Http\Middleware\Middleware;
use Bcchicr\StudentList\Http\Handler\RequestHandler;
use Bcchicr\StudentList\Http\Middleware\Resolver\Resolver;
use Bcchicr\StudentList\Http\Foundation\Factory\ResponseFactory;

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
            return $this->responseFactory->createResponse(404)->withBody(Stream::create('Not Found'));
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
