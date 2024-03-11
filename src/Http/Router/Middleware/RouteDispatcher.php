<?php

namespace Bcchicr\StudentList\Http\Router\Middleware;

use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Handler\RequestHandler;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Http\Middleware\Middleware;
use Bcchicr\StudentList\Http\Router\Route;
use RuntimeException;

class RouteDispatcher implements Middleware
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        $routeClass = Route::class;
        if (!$result = $request->getAttribute($routeClass)) {
            return $handler->handle($request);
        }
        if (!$result instanceof Route) {
            $resultType = get_debug_type($result);
            throw new RuntimeException("Expected $routeClass object to process. {$resultType} given");
        }
        $result = $result->getHandler();
        return $result($request);
    }
}
