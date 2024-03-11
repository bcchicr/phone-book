<?php

namespace Bcchicr\StudentList\Http;

use Bcchicr\StudentList\App\Application;
use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Http\Handler\RequestHandler;
use Bcchicr\StudentList\Http\Handler\ResponseEmitter;
use Bcchicr\StudentList\Http\Handler\Runner\Pipeline;
use Bcchicr\StudentList\Http\Handler\Runner\RequestRunner;
use Bcchicr\StudentList\Http\Router\Middleware\RouteMatcher;
use Bcchicr\StudentList\Http\Router\Middleware\RouteDispatcher;

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
