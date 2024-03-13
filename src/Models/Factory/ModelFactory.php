<?php

namespace Bcchicr\StudentList\Models\Factory;

use Bcchicr\StudentList\Models\Model;

abstract class ModelFactory
{
    abstract public function createObject(array $raw): Model;
}
