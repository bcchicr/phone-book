<?php

namespace Bcchicr\StudentList\Traits;

trait ArrayAccessible
{
    private array $container = [];

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->offsetExists($offset)
            ? $this->container[$offset]
            : null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->container[$offset]);
        }
    }
}
