<?php

namespace Bcchicr\StudentList\Http;


class Request
{
    private array $query = [];
    private array $cookies = [];
    private ?array $body;
    private array $server;

    private string $method;
    private Uri $uri;

    public function __construct(
        string $method,
        string|Uri $uri,
        ?array $body = null,
        array $server = []
    ) {
        $this->server = $server;
        if (!$uri instanceof Uri) {
            $uri = new Uri($uri);
        }
        $this->uri = $uri;
        $this->method = $method;
        $this->body = $body;
        parse_str($uri->getQuery(), $this->query);
    }

    public function getMethod(): string
    {
        return $this->method;
    }
    public function getUri(): Uri
    {
        return $this->uri;
    }
    public function getServerParams(): array
    {
        return $this->server;
    }
    public function getCookieParams(): array
    {
        return $this->cookies;
    }
    public function withCookieParams(array $cookies)
    {
        $new = clone $this;
        $new->cookies = $cookies;
        return $new;
    }
    public function getQuery(): array
    {
        return $this->query;
    }
    public function withQuery(array $query)
    {
        $new = clone $this;
        $new->query = $query;
        return $new;
    }
    public function getBody(): array
    {
        return $this->body;
    }
    public function withBody(?array $body)
    {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }
}
