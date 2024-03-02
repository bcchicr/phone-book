<?php

namespace Bcchicr\StudentList\Container;

class CallableDefinition implements Definition
{
    public function __construct(
        protected string $id,
        protected mixed $value,
    ) {
    }
    public function resolve(Container $container): mixed
    {
        return call_user_func($this->value, $container);
    }
}
