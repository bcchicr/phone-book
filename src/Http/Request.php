<?php

namespace Bcchicr\StudentList\Http;

class Request
{

    private InputBag $get;
    private InputBag $post;
    private InputBag $cookies;
    private InputBag $server;

    private ?string $method = null;

    // private InputBag $server;


    private function __construct(
        array $get = [],
        array $post = [],
        array $cookies = [],
        array $server = [],
    ) {
        $this->get = new InputBag($get);
        $this->post = new InputBag($post);
        $this->cookies = new InputBag($cookies);
        $this->server = new InputBag($server);
    }

    public static function captureGlobals(): static
    {
        return new static($_GET, $_POST, $_COOKIE, $_SERVER);
    }

    public function getMethod(): string
    {
        if (!is_null($this->method)) {
            return $this->method;
        }
        $method = mb_strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
        return $this->method = $method;
    }
}
