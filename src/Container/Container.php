<?php

namespace Bcchicr\StudentList\Container;

use Bcchicr\StudentList\Container\Exceptions\ContainerException;
use Bcchicr\StudentList\Container\Exceptions\ContainerNotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionClass;

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

    public function get(string $id): mixed
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }
        $definition =
            $this->has($id)
            ? $this->definitions[$id]
            : $this->getInstantiableDefinition($id);
        $instance = $definition->resolve($this);
        $this->instances[$id] = $instance;
        return $instance;
    }

    public function has(string $id): bool
    {
        return isset($this->definitions[$id]);
    }

    public function register(
        string $id,
        callable $value,
    ): void {
        if ($this->has($id)) {
            unset($this->instances[$id]);
        }
        $this->definitions[$id] = new CallableDefinition($id, $value);
    }

    private function getInstantiableDefinition(string $id): InstantiableDefinition
    {
        if (!class_exists($id)) {
            throw new ContainerNotFoundException("Undefined dependency {$id}");
        }
        $reflection = new ReflectionClass($id);
        if (!$reflection->isInstantiable()) {
            throw new ContainerException("Class {$id} is not instantiable");
        }
        return new InstantiableDefinition($id, $reflection);
    }
}
