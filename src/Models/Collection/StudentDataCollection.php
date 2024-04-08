<?php

namespace Bcchicr\Framework\Models\Collection;

use Bcchicr\Framework\Models\Factory\StudentDataFactory;
use Bcchicr\Framework\Models\StudentData;

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
