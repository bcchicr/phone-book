<?php

namespace Bcchicr\StudentList\Models\Collection\Factory;

use Bcchicr\StudentList\Models\Collection\Collection;

abstract class CollectionFactory
{
    abstract public function getCollection(array $raw): Collection;
}
