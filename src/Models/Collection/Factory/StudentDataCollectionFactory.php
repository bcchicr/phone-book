<?php

namespace Bcchicr\Framework\Models\Collection\Factory;

use Bcchicr\Framework\Models\Factory\StudentDataFactory;
use Bcchicr\Framework\Models\Collection\StudentDataCollection;

class StudentDataCollectionFactory extends CollectionFactory
{
    public function __construct(
        private StudentDataFactory $factory
    ) {
    }
    public function getCollection(array $raw): StudentDataCollection
    {
        return new StudentDataCollection($raw, $this->factory);
    }
}
