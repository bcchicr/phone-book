<?php

namespace Bcchicr\Framework\Http\Handler\Runner;

use Bcchicr\Framework\Http\Foundation\Request;
use Bcchicr\Framework\Http\Foundation\Response;
use Bcchicr\Framework\Http\Handler\RequestHandler;

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
