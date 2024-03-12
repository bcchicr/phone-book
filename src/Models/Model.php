<?php

namespace Bcchicr\StudentList\Models;

abstract class Model
{
    public function __construct(
        private int $id
    ) {
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
