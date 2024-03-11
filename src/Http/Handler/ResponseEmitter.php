<?php

namespace Bcchicr\StudentList\Http\Handler;

use RuntimeException;
use Bcchicr\StudentList\Http\Foundation\Response;

class ResponseEmitter
{
    public function __construct(
        private Response $response
    ) {
    }
    public function emit(): void
    {
        self::assertNoPreviousOutput();
        $this->emitHeaders();
        $this->emitStatusLine();
        $this->emitBody();
    }
    private function emitBody(): void
    {
        $body = $this->response->getBody();
        if (is_null($body)) {
            return;
        }
        echo $body;
        return;
    }
    private function emitStatusLine(): void
    {
        $statusCode = $this->response->getStatusCode();
        $reasonPhrase = $this->response->getReasonPhrase();

        $status = $statusCode;
        if ($reasonPhrase !== '') {
            $status .= ' ' . $reasonPhrase;
        }
        $protocolVersion = $this->response->getProtocolVersion();
        header(
            sprintf('HTTP/%s %s', $protocolVersion, $status),
            true,
            $statusCode
        );
    }
    private function emitHeaders(): void
    {
        $statusCode = $this->response->getStatusCode();
        foreach ($this->response->getHeaders() as $headerName => $headerValues) {
            $name = ucwords($headerName);
            $first = $name !== 'Set-Cookie';
            foreach ($headerValues as $headerValue) {
                header(sprintf(
                    '%s: %s',
                    $headerName,
                    $headerValue
                ), $first, $statusCode);
                $first = false;
            }
        }
    }
    private static function assertNoPreviousOutput(): void
    {
        if (headers_sent()) {
            throw new RuntimeException('Headers were already sent. The response could not be emitted');
        }
        if (ob_get_level() > 0 && ob_get_length() > 0) {
            throw new RuntimeException('Output was already sent. The response could not be emitted');
        }
    }
}
