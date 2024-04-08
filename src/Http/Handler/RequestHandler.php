<?php

namespace Bcchicr\Framework\Http\Handler;

use Bcchicr\Framework\Http\Foundation\Request;
use Bcchicr\Framework\Http\Foundation\Response;

interface RequestHandler
{
    public function handle(Request $request): Response;
}
