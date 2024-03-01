<?php

namespace Bcchicr\StudentList\Container;

use Bcchicr\StudentList\Container\Exceptions\ContainerException;
use Bcchicr\StudentList\Container\Exceptions\DefinitionException;
use Psr\Container\ContainerInterface;
use Bcchicr\StudentList\Container\Exceptions\NotFoundException;

class Container implements ContainerInterface
{
    /**
     * @var array<Definition>
     */
    private array $definitions = [];
    /**
     * @var array<object>
     */
    private array $instances = [];

    public function __construct()
    {
    }

    private function doGet(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new NotFoundException("Key {$id} is not defined");
        }

        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        $definition = $this->definitions[$id];
        if (!$definition->isResolvable()) {
            return $definition->getValue();
        }

        try {
            $instance = $definition->resolve($this);
        } catch (DefinitionException $e) {
            throw new ContainerException($e->getMessage());
        }

        if ($definition->isSingleton()) {
            $this->instances[$id] = $instance;
        }

        return $instance;
    }

    public function register(
        string $id,
        mixed $value,
        bool $isSingleton = true
    ): void {
        if ($this->has($id)) {
            unset($this->instances[$id]);
        }
        $this->definitions[$id] = new Definition($id, $value, $isSingleton);
    }

    public function get(string $id): mixed
    {
        return $this->doGet($id);
    }

    public function has(string $id): bool
    {
        return isset($this->definitions[$id]);
    }

    public function resolveDependencies(array $dependencies): array
    {
        $results = [];
        foreach ($dependencies as $dependency) {
            $results[] = $this->doGet($dependency);
        }
        return $results;
    }
}
