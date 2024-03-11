<?php

namespace Bcchicr\StudentList\Http\Handler\Runner;

use RuntimeException;
use InvalidArgumentException;
use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Http\Middleware\Middleware;
use Bcchicr\StudentList\Http\Handler\RequestHandler;

class RequestRunner implements RequestHandler
{
    public function __construct(
        private Pipeline $pipeline
    ) {
    }
    public function handle(Request $request): Response
    {
        $middleware = $this->pipeline->shift();
        return $middleware->process($request, $this);
    }
}
