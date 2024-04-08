<?php

namespace Bcchicr\Framework\Http\Middleware;

use Bcchicr\Framework\Http\Foundation\Request;
use Bcchicr\Framework\Http\Foundation\Response;
use Bcchicr\Framework\Http\Handler\RequestHandler;

interface Middleware
{
    public function process(Request $request, RequestHandler $handler): Response;
}
