<?php

namespace Bcchicr\StudentList\Http;

use Bcchicr\StudentList\Http\Exception\BadRequestException;
use InvalidArgumentException;
use Stringable;

class InputBag extends ParameterBag
{
    public function offsetGet(mixed $offset): array|string|int|float|bool|null
    {
        $value = parent::offsetGet($offset);
        if (!$this->isCorrectValue($value)) {
            $valueType = get_debug_type($value);
            throw new BadRequestException("Input value {$offset} expected to be a scalar or an array, {$valueType} given");
        }
        return $value;
    }
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$this->isCorrectValue($value)) {
            $valueType = get_debug_type($value);
            throw new InvalidArgumentException("Expected a scalar or an array as 2nd argument, {$valueType} given");
        }
        parent::offsetSet($offset, $value);
    }
    private function isCorrectValue(mixed $value): bool
    {
        return
            is_null($value) ||
            is_scalar($value) ||
            is_array($value) ||
            $value instanceof Stringable;
    }
}
