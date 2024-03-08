<?php

namespace Bcchicr\StudentList\Http\Factory;

use Bcchicr\StudentList\Http\Uri;
use Bcchicr\StudentList\Http\Request;
use Bcchicr\StudentList\Http\Exception\InvalidArgumentException;

class RequestFactory
{
    public function __construct(
        private UriFactory $uriFactory
    ) {
    }
    private function createRequest(
        string $method,
        string|Uri $uri,
        array $server
    ) {
        return new Request(
            $method,
            $uri,
            [],
            $server
        );
    }
    public function createRequestFromGlobals(): Request
    {
        $server = $_SERVER;
        if (!isset($server['REQUEST_METHOD'])) {
            $server['REQUEST_METHOD'] = 'GET';
        }
        // $headers = $this->getHeadersFromServer($server);
        $post = $this->isFormDataReceived($server)
            ? $_POST
            : null;

        return $this->createRequestFromArrays(
            $server,
            $_COOKIE,
            $_GET,
            $post
        );
    }
    private function createRequestFromArrays(
        array $server,
        array $cookies = [],
        array $get = [],
        ?array $post = null
    ): Request {
        $method = $this->getMethodFromServer($server);
        $uri = $this->getUriFromServer($server);
        $request = $this->createRequest($method, $uri, $server);
        $request = $request
            ->withCookieParams($cookies)
            ->withQuery($get)
            ->withBody($post);
        return $request;
    }
    private function isFormDataReceived(array $server): bool
    {
        if (
            !$this->getMethodFromServer($server) === 'POST' ||
            !isset($server['CONTENT_TYPE'])
        ) {
            return false;
        }
        return array_reduce(
            explode(';', $server['CONTENT_TYPE']),
            function ($carry, $type) {
                $isFormType = in_array(
                    mb_strtolower(trim($type)),
                    ['application/x-www-form-urlencoded', 'multipart/form-data']
                );
                return $carry || $isFormType;
            },
            false
        );
    }
    private function getUriFromServer(array $server): Uri
    {
        $uri = $this->uriFactory->createUri('');

        if (isset($server['HTTP_X_FORWARDED_PROTO'])) {
            $uri = $uri->withScheme($server['HTTP_X_FORWARDED_PROTO']);
        } else {
            if (isset($server['REQUEST_SCHEME'])) {
                $uri = $uri->withScheme($server['REQUEST_SCHEME']);
            } elseif (isset($server['HTTPS'])) {
                $uri = $uri->withScheme('on' === $server['HTTPS'] ? 'https' : 'http');
            }
        }
        if ($uri->getScheme() === '') {
            $uri = $uri->withScheme('http');
        }

        if (isset($server['SERVER_PORT'])) {
            $uri = $uri->withPort($server['SERVER_PORT']);
        }

        if (isset($server['HTTP_HOST'])) {
            if (preg_match('/^(.+)\:(\d+)$/', $server['HTTP_HOST'], $matches) === 1) {
                $uri = $uri->withHost($matches[1])->withPort($matches[2]);
            } else {
                $uri = $uri->withHost($server['HTTP_HOST']);
            }
        } elseif (isset($server['SERVER_NAME'])) {
            $uri = $uri->withHost($server['SERVER_NAME']);
        }

        if (isset($server['REQUEST_URI'])) {
            $uri = $uri->withPath(explode('?', $server['REQUEST_URI'])[0]);
        }

        if (isset($server['QUERY_STRING'])) {
            $uri = $uri->withQuery($server['QUERY_STRING']);
        }

        return $uri;
    }
    private function getMethodFromServer(array $server): string
    {
        if (false === isset($server['REQUEST_METHOD'])) {
            throw new InvalidArgumentException('Cannot determine HTTP method');
        }

        return $server['REQUEST_METHOD'];
    }
    // private function getHeadersFromServer(array $server): array
    // {
    //     $headers = [];
    //     foreach ($server as $key => $value) {
    //         if (!$value) {
    //             continue;
    //         }
    //         if (strpos($key, 'HTTP_') === 0) {
    //             $name = strtr(mb_strtolower(mb_substr($key, 5)), '_', '-');
    //             $headers[$name] = $value;
    //             continue;
    //         }
    //         if (strpos($key, 'CONTENT_') === 0) {
    //             $name = strtr(mb_strtolower($key), '_', '-');
    //             $headers[$name] = $value;
    //             continue;
    //         }
    //     }
    //     return $headers;
    // }
}
