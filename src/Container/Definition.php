<?php

namespace Bcchicr\StudentList\Container;

use Bcchicr\StudentList\Container\Exceptions\DefinitionBindingException;
use Bcchicr\StudentList\Container\Exceptions\DefinitionException;
use ReflectionClass;
use ReflectionNamedType;
use Stringable;

class Definition
{
    public function __construct(
        private string $id,
        private mixed $value,
        private bool $isSingleton
    ) {
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function isSingleton(): bool
    {
        return $this->isSingleton;
    }

    public function resolve(Container $container): mixed
    {
        $concrete = $this->value;
        if ($this->isCallable()) {
            return call_user_func($concrete, $container);
        }

        if ($this->isInstantiable()) {
            $reflector = new ReflectionClass($this->value);
            $constructor = $reflector->getConstructor();
            $dependencies = array_map(
                function ($param) {
                    $paramType = $param->getType();
                    if (!$paramType instanceof ReflectionNamedType || $paramType->isBuiltin()) {
                        throw new DefinitionBindingException("Cannot resolve dependency {$param->getName()} in class {$param->getDeclarationClass()->getName()}");
                    }
                    return $paramType->getName();
                },
                $constructor->getParameters()
            );
            $instances = $container->resolveDependencies($dependencies);
            return $reflector->newInstanceArgs($instances);
        }

        throw new DefinitionException("Definition {$this->id} is not resolvable");
    }


    public function isResolvable(): bool
    {
        return $this->isCallable() || $this->isInstantiable();
    }

    private function isCallable(): bool
    {
        return is_callable($this->value);
    }

    private function isInstantiable(): bool
    {
        $concrete = $this->value;
        if (
            (is_string($concrete) || $concrete instanceof Stringable)
            && class_exists($concrete)
        ) {
            $reflector = new ReflectionClass($concrete);
            return $reflector->isInstantiable();
        }
        return false;
    }
}
