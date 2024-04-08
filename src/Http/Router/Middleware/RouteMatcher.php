<?php

namespace Bcchicr\Framework\Http\Router\Middleware;

use Bcchicr\Framework\Http\Foundation\Factory\ResponseFactory;
use Bcchicr\Framework\Http\Foundation\Request;
use Bcchicr\Framework\Http\Handler\RequestHandler;
use Bcchicr\Framework\Http\Foundation\Response;
use Bcchicr\Framework\Http\Middleware\Middleware;
use Bcchicr\Framework\Http\Router\Route;
use Bcchicr\Framework\Http\Router\Router;

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
