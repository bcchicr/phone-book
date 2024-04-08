<?php

namespace Bcchicr\Framework\Models\Collection\Factory;

use Bcchicr\Framework\Models\Collection\Collection;

abstract class CollectionFactory
{
    abstract public function getCollection(array $raw): Collection;
}
