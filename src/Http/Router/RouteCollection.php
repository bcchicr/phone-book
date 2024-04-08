<?php

namespace Bcchicr\Framework\Http\Router;

use Bcchicr\Framework\Http\Foundation\Request;

class RouteCollection
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    public function setRoute(Route $route)
    {
        $id = $route->getId();
        $this->routes[$id] = $route;
    }
    public function match(Request $request): ?Route
    {
        foreach ($this->routes as $route) {
            if (!$route->match($request)) {
                continue;
            }
            return $route;
        }
        return null;
    }
}
