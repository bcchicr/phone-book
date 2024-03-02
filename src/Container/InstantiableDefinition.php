<?php

namespace Bcchicr\StudentList\Container;

use ReflectionClass;
use ReflectionNamedType;
use Bcchicr\StudentList\Container\Exceptions\DefinitionBindingException;

class InstantiableDefinition implements Definition
{
    public function __construct(
        protected string $id,
        private ReflectionClass $reflection
    ) {
    }
    public function resolve(Container $container): mixed
    {
        $reflector = $this->reflection;
        $constructor = $reflector->getConstructor();
        if (empty($constructor)) {
            return $reflector->newInstance();
        }
        $constructParameters = $constructor->getParameters();
        if (empty($constructParameters)) {
            return $reflector->newInstance();
        }
        $dependencies = array_map(
            function ($param) use ($container) {
                $paramType = $param->getType();
                if (!$paramType instanceof ReflectionNamedType) {
                    throw new DefinitionBindingException("Cannot resolve dependency {$param->getName()} in class {$param->getDeclarationClass()->getName()}");
                }
                $instance = $container->get($paramType->getName());
                return $instance;
            },
            $constructParameters
        );
        return $reflector->newInstanceArgs($dependencies);
    }
}
