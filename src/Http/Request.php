<?php

namespace Bcchicr\StudentList\Http;


class Request extends Message
{

    private array $query = [];
    private array $cookies = [];
    private ?array $parsedBody;
    private array $server;

    private string $method;
    private Uri $uri;

    public function __construct(
        string $method,
        string|Uri $uri,
        array $headers = [],
        $body = null,
        string $version = '1.1',
        array $server = []
    ) {
        $this->server = $server;
        if (!$uri instanceof Uri) {
            $uri = new Uri($uri);
        }
        $this->uri = $uri;
        $this->method = $method;
        $this->setHeaders($headers);
        $this->protocol = $version;
        parse_str($uri->getQuery(), $this->query);
        if (!empty($body)) {
            $this->body = Stream::create($body);
        }
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
    public function getParsedBody(): ?array
    {
        return $this->parsedBody;
    }
    public function withParsedBody(?array $data): static
    {
        $new = clone $this;
        $new->parsedBody = $data;
        return $new;
    }
}
