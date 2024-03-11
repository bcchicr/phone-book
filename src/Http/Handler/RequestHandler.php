<?php

namespace Bcchicr\StudentList\Http\Handler;

use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;

interface RequestHandler
{
    public function handle(Request $request): Response;
}
