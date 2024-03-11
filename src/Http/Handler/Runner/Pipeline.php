<?php

namespace Bcchicr\StudentList\Http\Handler\Runner;

use Bcchicr\StudentList\Http\Middleware\Middleware;
use RuntimeException;

class Pipeline
{
    /**
     * @var Middleware[]
     */
    private array $pipeline = [];

    public function pipe(Middleware $middleware): void
    {
        $this->pipeline[] = $middleware;
    }
    public function shift(): Middleware
    {
        if (empty($this->pipeline)) {
            throw new RuntimeException("Cannot shift middleware. Pipeline is empty.");
        }
        return array_shift($this->pipeline);
    }
}
