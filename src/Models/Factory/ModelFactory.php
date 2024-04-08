<?php

namespace Bcchicr\Framework\Models\Factory;

use Bcchicr\Framework\Models\Model;

abstract class ModelFactory
{
    abstract public function createObject(array $raw): Model;
}
