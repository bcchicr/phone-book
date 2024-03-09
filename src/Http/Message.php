<?php

namespace Bcchicr\StudentList\Http;

use InvalidArgumentException;

abstract class Message
{
    protected array $headers = [];
    protected array $originalHeaderNames = [];
    protected string $protocol = '1.1';
    protected ?Stream $body = null;

    public function getProtocolVersion(): string
    {
        return $this->protocol;
    }
    public function withProtocolVersion(string $version)
    {
        if ($this->protocol === $version) {
            return $this;
        }

        $new = clone $this;
        $new->protocol = $version;
        return $new;
    }
    public function getHeaders(): array
    {
        return $this->headers;
    }
    public function hasHeader(string $name): bool
    {
        return isset($this->originalHeaderNames[mb_strtolower($name)]);
    }
    public function getHeader(string $name): array
    {
        $name = mb_strtolower($name);
        if (!isset($this->originalHeaderNames[$name])) {
            return [];
        }
        $name = $this->originalHeaderNames[$name];
        return $this->headers[$name];
    }
    public function getHeaderLine(string $name): string
    {
        return implode(', ', $this->getHeader($name));
    }
    public function withHeader(string $name, $value): static
    {
        $value = $this->CheckAndNormalizeHeader($name, $value);
        $lowerCasedName = mb_strtolower($name);

        $new = clone $this;
        if (isset($new->originalHeaderNames[$lowerCasedName])) {
            $originalName = $new->originalHeaderNames[$lowerCasedName];
            unset($new->headers[$originalName]);
        }
        $new->originalHeaderNames[$lowerCasedName] = $name;
        $new->headers[$name] = $value;
        return $new;
    }
    public function withAddedHeader(string $name, $value): static
    {
        $new = clone $this;
        $new->setHeaders([$name => $value]);
        return $new;
    }
    public function withoutHeader(string $name): static
    {
        $lowerCasedName = mb_strtolower($name);
        if (!isset($this->originalHeaderNames[$lowerCasedName])) {
            return $this;
        }
        $originalName = $this->originalHeaderNames[$lowerCasedName];
        $new = clone $this;
        unset($new->headers[$originalName]);
        unset($new->originalHeaderNames[$lowerCasedName]);
        return $new;
    }
    public function getBody(): ?Stream
    {
        return $this->body;
    }
    public function withBody(?Stream $body): static
    {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }
    protected function setHeaders(array $headers): void
    {
        foreach ($headers as $headerName => $headerValue) {
            $headerValue = $this->CheckAndNormalizeHeader($headerName, $headerValue);
            $lowerCasedName = mb_strtolower($headerName);

            if (isset($this->originalHeaderNames[$lowerCasedName])) {
                $headerName = $this->originalHeaderNames[$lowerCasedName];

                $this->headers[$headerName] = \array_merge(
                    $this->headers[$headerName],
                    $headerValue
                );
            } else {
                $this->originalHeaderNames[$lowerCasedName] = $headerName;
                $this->headers[$headerName] = $headerValue;
            }
        }
    }
    private function CheckAndNormalizeHeader(string $name, $value): array
    {
        if (preg_match("/^[!#$%&'*+.^_`|~0-9A-Za-z-]+$/D", $name) !== 1) {
            throw new InvalidArgumentException('Header name must be an RFC 7230 compatible string');
        }
        if (!is_array($value)) {
            return [$this->getHeaderValueFromString($value)];
        }
        if (empty($value)) {
            throw new InvalidArgumentException('Header value must be a string or an array of strings. Empty array given');
        }
        return array_map($this->getHeaderValueFromString(...), $value);
    }
    private function getHeaderValueFromString(string $string)
    {
        if (
            preg_match("/^[ \t\x21-\x7E\x80-\xFF]*$/", $string) !== 1
        ) {
            throw new InvalidArgumentException('Header value must be an RFC 7230 compatible string');
        }
        return trim($string, " \t");
    }
}
