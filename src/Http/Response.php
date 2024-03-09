<?php

namespace Bcchicr\StudentList\Http;

use InvalidArgumentException;


class Response extends Message
{
    private const PHRASES = [
        100 => 'Continue', 101 => 'Switching Protocols', 102 => 'Processing',
        200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information', 204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 207 => 'Multi-status', 208 => 'Already Reported',
        300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other', 304 => 'Not Modified', 305 => 'Use Proxy', 306 => 'Switch Proxy', 307 => 'Temporary Redirect',
        400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable', 407 => 'Proxy Authentication Required', 408 => 'Request Time-out', 409 => 'Conflict', 410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large', 414 => 'Request-URI Too Large', 415 => 'Unsupported Media Type', 416 => 'Requested range not satisfiable', 417 => 'Expectation Failed', 418 => 'I\'m a teapot', 422 => 'Unprocessable Entity', 423 => 'Locked', 424 => 'Failed Dependency', 425 => 'Unordered Collection', 426 => 'Upgrade Required', 428 => 'Precondition Required', 429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large', 451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Time-out', 505 => 'HTTP Version not supported', 506 => 'Variant Also Negotiates', 507 => 'Insufficient Storage', 508 => 'Loop Detected', 511 => 'Network Authentication Required'
    ];

    private int $statusCode;
    private string $reasonPhrase;

    public function __construct(
        int $status = 200,
        array $headers = [],
        ?string $body = null,
        string $version = '1.1',
        string $reason = ''
    ) {
        $this->statusCode = $status;
        $this->body = $body;
        $this->setHeaders($headers);
        $this->protocol = $version;
        $this->reasonPhrase =
            ($reason === '' && isset(self::PHRASES[$status]))
            ? self::PHRASES[$status]
            : $reason;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }
    public function withStatus(int $code, string $reasonPhrase = ''): static
    {
        if ($code < 100 || 599 < $code) {
            throw new InvalidArgumentException("Expected status code to be an integer between 100 and 599. A status code {$code} was given");
        }
        $new = clone $this;
        $new->statusCode = $code;
        $new->reasonPhrase =
            ($reasonPhrase === '' && isset(self::PHRASES[$code]))
            ? self::PHRASES[$code]
            : $reasonPhrase;
        return $new;
    }
}
