<?php

namespace Bcchicr\StudentList\Http;

use ArrayObject;
use InvalidArgumentException;

class ParameterBag extends ArrayObject
{
    public function __construct(
        array $parameters = []
    ) {
        parent::__construct($parameters);
    }
    public function offsetSet(mixed $key, mixed $value): void
    {
        if (is_null($key)) {
            throw new InvalidArgumentException("Key cannot be null");
        }
        parent::offsetSet($key, $value);
    }
}
