<?php

namespace Bcchicr\StudentList\Http;

use InvalidArgumentException;

class Uri
{
    private const CHAR_UNRESERVED = 'a-zA-Z0-9_\-\.~';
    private const CHAR_SUB_DELIMS = '!\$&\'\(\)\*\+,;=';

    private const STANDARD_PORTS = [
        'http' => 80,
        'https' => 443
    ];

    private string $scheme;
    private string $userInfo;
    private string $host;
    private ?int $port;
    private string $path;
    private string $query;
    private string $fragment;

    public function __construct(string $uri)
    {
        $parts = parse_url($uri);
        if (false === $parts) {
            throw new InvalidArgumentException("Unable to parse URI: {$uri}");
        }

        $this->scheme =
            isset($parts['scheme'])
            ? mb_strtolower($parts['scheme'])
            : '';
        $this->userInfo = $parts['user'] ?? '';
        if (isset($parts['pass'])) {
            $this->userInfo .= ':' . $parts['pass'];
        }
        $this->host =
            isset($parts['host'])
            ? mb_strtolower($parts['host'])
            : '';
        $this->port =
            isset($parts['port'])
            ? $this->filterPort($this->scheme, $parts['port'])
            : null;
        $this->path =
            isset($parts['path'])
            ? $this->filterPath($this->getAuthority(), $parts['path'])
            : '';
        $this->query =
            isset($parts['query'])
            ? $this->urlEncode($parts['query'])
            : '';
        $this->fragment =
            isset($parts['fragment'])
            ? $this->urlEncode($parts['fragment'])
            : '';
    }
    public function __toString(): string
    {
        $uri = '';
        $scheme = $this->getScheme();
        if ($scheme !== '') {
            $uri .= $scheme . ':';
        }
        $authority = $this->getAuthority();
        if ($authority !== '') {
            $uri .= '//' . $authority;
        }
        $uri .= $this->getPath();
        $query = $this->getQuery();
        if ($query !== '') {
            $uri .= '?' . $query;
        }
        $fragment = $this->getFragment();
        if ($fragment !== '') {
            $uri .= '#' . $fragment;
        }
        return $uri;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }
    public function withScheme(string $scheme): static
    {
        $scheme = mb_strtolower($scheme);
        if ($scheme === $this->scheme) {
            return $this;
        }
        $new = clone $this;
        $new->scheme = $scheme;
        return $new;
    }
    public function getAuthority(): string
    {
        $authority = $this->host;
        if ($authority === '') {
            return '';
        }
        if ($this->userInfo !== '') {
            $authority = $this->userInfo . '@' . $authority;
        }
        if (!is_null($this->port)) {
            $authority .= ':' . $this->port;
        }

        return $authority;
    }
    public function getUserInfo(): string
    {
        return $this->userInfo;
    }
    public function withUserInfo(string $user, ?string $password = null): static
    {
        $userInfo = $user;
        if ($userInfo !== '' && $password !== null) {
            $userInfo .= ':' . $password;
        }
        if ($userInfo === $this->userInfo) {
            return $this;
        }
        $new = clone $this;
        $new->userInfo = $userInfo;
        return $new;
    }
    public function getHost(): string
    {
        return $this->host;
    }
    public function withHost(string $host): static
    {
        $host = mb_strtolower($host);
        if ($host === $this->host) {
            return $this;
        }
        $new = clone $this;
        $new->host = $host;
        return $new;
    }
    public function getPort(): ?int
    {
        return $this->port;
    }
    public function withPort(?int $port): static
    {
        if ($port !== null) {
            $port = $this->filterPort($this->scheme, $port);
        }
        if ($port === $this->port) {
            return $this;
        }
        $new = clone $this;
        $new->port = $port;
        return $new;
    }
    public function getPath(): string
    {
        return $this->path;
    }
    public function withPath(string $path): static
    {
        $path = $this->filterPath($this->getAuthority(), $path);
        if ($path === $this->path) {
            return $this;
        }
        $new = clone $this;
        $new->path = $path;
        return $new;
    }
    public function getQuery(): string
    {
        return $this->query;
    }
    public function withQuery(string $query): static
    {
        $query = $this->urlEncode($query);
        if ($query === $this->query) {
            return $this;
        }
        $new = clone $this;
        $new->query = $query;
        return $new;
    }
    public function getFragment(): string
    {
        return $this->fragment;
    }
    public function withFragment(string $fragment): static
    {
        $fragment = $this->urlEncode($fragment);
        if ($fragment === $this->fragment) {
            return $this;
        }
        $new = clone $this;
        $new->fragment = $fragment;
        return $new;
    }
    private function filterPath(string $authority, string $path): string
    {
        if ($path === '') {
            return '';
        }
        if ($authority !== '') {
            if (mb_substr($path, 0, 1) !== '/') {
                $path = '/' . $path;
            }
        }
        if (
            mb_strlen($path) > 0 &&
            mb_substr($path, 1, 1) === '/'
        ) {
            $path = '/' . ltrim($path, '/');
        }
        return $this->urlEncode($path);
    }
    private function urlEncode(string $path)
    {
        return preg_replace_callback(
            '/(?:[^' . self::CHAR_UNRESERVED . self::CHAR_SUB_DELIMS . '%:@\/]++|%(?![A-Fa-f0-9]{2}))/',
            [$this, 'rawurlencodeMatchZero'],
            $path
        );
    }
    private function rawurlencodeMatchZero(array $match): string
    {
        return rawurlencode($match[0]);
    }
    private function filterPort(string $scheme, int $port): ?int
    {
        if ($port < 0 || 65535 < $port) {
            throw new InvalidArgumentException("Invalid port {$port}. Port must be between 0 and 65535");
        }
        return
            $this->isStandardPort($scheme, $port)
            ? null
            : $port;
    }
    private function isStandardPort(string $scheme, int $port): bool
    {
        return isset(self::STANDARD_PORTS[$scheme]) &&
            $port === self::STANDARD_PORTS[$scheme];
    }
}
