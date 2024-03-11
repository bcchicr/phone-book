<?php

namespace Bcchicr\StudentList\Http\Router\Middleware;

use Bcchicr\StudentList\Http\Foundation\Factory\ResponseFactory;
use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Handler\RequestHandler;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Http\Middleware\Middleware;
use Bcchicr\StudentList\Http\Router\Route;
use Bcchicr\StudentList\Http\Router\Router;

class RouteMatcher implements Middleware
{
    public function __construct(
        private Router $router,
        private ResponseFactory $responseFactory
    ) {
    }
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (!$route = $this->router->match($request)) {
            return $handler->handle($request);
        }
        if (!$route->isAllowedMethod($request->getMethod())) {
            $method = $route->getMethod();
            return $this->responseFactory->createResponse(405)->withHeader('Allow', $method);
        }
        return $handler->handle($request->withAttribute(Route::class, $route));
    }
}
