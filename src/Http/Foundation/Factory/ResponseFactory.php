<?php

namespace Bcchicr\Framework\Http\Foundation\Factory;

use Bcchicr\Framework\Http\Foundation\RedirectResponse;
use Bcchicr\Framework\Http\Foundation\Response;

class ResponseFactory
{
    public function createResponse(string $body = null, int $status = 200, string $reasonPhrase = ''): Response
    {
        return new Response(body: $body, status: $status, reason: $reasonPhrase);
    }
    public function createRedirectResponse(string $url): RedirectResponse
    {
        return new RedirectResponse($url);
    }
}
