<?php

namespace Bcchicr\StudentList\Models;

use SplObserver;
use SplSubject;

abstract class Model
{
    public function __construct(
        private ?int $id = null,
    ) {
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
