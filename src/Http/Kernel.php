<?php

namespace Bcchicr\Framework\Http;

use Bcchicr\Framework\App\Application;
use Bcchicr\Framework\Http\Foundation\Request;
use Bcchicr\Framework\Http\Foundation\Response;
use Bcchicr\Framework\Http\Handler\RequestHandler;
use Bcchicr\Framework\Http\Handler\ResponseEmitter;
use Bcchicr\Framework\Http\Handler\Runner\Pipeline;
use Bcchicr\Framework\Http\Handler\Runner\RequestRunner;
use Bcchicr\Framework\Http\Router\Middleware\RouteMatcher;
use Bcchicr\Framework\Http\Router\Middleware\RouteDispatcher;

class Kernel
{
    public function __construct(
        private Application $app
    ) {
    }
    public function handle(Request $request): void
    {
        $pipeline = new Pipeline();
        $pipeline->pipe($this->app->get(RouteMatcher::class));
        $pipeline->pipe($this->app->get(RouteDispatcher::class));

        $runner = new RequestRunner($pipeline);
        $response = $runner->handle($request);

        $emitter = new ResponseEmitter($response);
        $emitter->emit();
    }
}
