<?php

namespace Bcchicr\StudentList\Models;

use InvalidArgumentException;

trait ModelValidationTrait
{
    abstract protected function targetClass(): string;
    private function validateModel(Model $obj): void
    {
        $class = $this->targetClass();
        if (!$obj instanceof $class) {
            throw new InvalidArgumentException(sprintf(
                "Expected instance of %s as first argument. %s was given",
                $class,
                get_debug_type($obj)
            ));
        }
    }
}
