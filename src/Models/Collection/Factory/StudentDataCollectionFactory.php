<?php

namespace Bcchicr\StudentList\Models\Collection\Factory;

use Bcchicr\StudentList\Models\Factory\StudentDataFactory;
use Bcchicr\StudentList\Models\Collection\StudentDataCollection;

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
