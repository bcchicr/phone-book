<?php

namespace Bcchicr\StudentList\Models\Collection;

use Bcchicr\StudentList\Models\Factory\StudentDataFactory;
use Bcchicr\StudentList\Models\StudentData;

class StudentDataCollection extends Collection
{
    public function __construct(
        array $raw = [],
        ?StudentDataFactory $factory = null
    ) {
        parent::__construct($raw, $factory);
    }
    protected function targetClass(): string
    {
        return StudentData::class;
    }
}
