<?php

namespace Bcchicr\StudentList\Http\Middleware;

use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Http\Handler\RequestHandler;

interface Middleware
{
    public function process(Request $request, RequestHandler $handler): Response;
}
