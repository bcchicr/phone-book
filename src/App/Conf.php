<?php

namespace Bcchicr\Framework\App;

use RuntimeException;

class Conf
{
    private array $config;
    public function __construct(
        string $confPath
    ) {
        $config = parse_ini_file($confPath);
        if ($config === false) {
            throw new RuntimeException("Cannot parse ini file on path {$confPath}");
        }
        $this->config = $config;
    }
    public function has(string $name): bool
    {
        return isset($this->config[$name]);
    }
    public function get(string $name): string
    {
        if (!$this->has($name)) {
            throw new RuntimeException("Unable to find {$name} item");
        }
        return $this->config[$name];
    }
    public function set(string $name, string $value): void
    {
        $this->config[$name] = $value;
    }
}
