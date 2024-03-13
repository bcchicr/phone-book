<?php

namespace Bcchicr\StudentList\Models\Collection;

use InvalidArgumentException;
use Bcchicr\StudentList\Models\Factory\ModelFactory;
use Bcchicr\StudentList\Models\Model;
use Bcchicr\StudentList\Models\ModelValidationTrait;
use Countable;
use Generator;
use IteratorAggregate;

abstract class Collection implements
    IteratorAggregate,
    Countable
{
    use ModelValidationTrait;

    protected int $total = 0;
    private int $pointer = 0;
    private array $objects = [];

    public function __construct(
        private array $raw = [],
        private ?ModelFactory $factory = null
    ) {
        $this->total = count($raw);
        if ($this->total > 0 && is_null($factory)) {
            throw new InvalidArgumentException("Expected factory for objects generation");
        }
    }
    public function add(Model $object): void
    {
        $this->validateModel($object);
        $this->objects[$this->total] = $object;
        $this->total++;
    }
    private function getRow(int $num): ?Model
    {
        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }
        if (isset($this->raw[$num])) {
            $object = $this->factory->createObject($this->raw[$num]);
            return $this->objects[$num] = $object;
        }
        return null;
    }
    private function getGenerator(): Generator
    {
        for ($i = 0; $i < $this->total; $i++) {
            yield $this->getRow($i);
        }
    }
    public function getIterator(): Generator
    {
        return $this->getGenerator();
    }
    public function count(): int
    {
        return $this->total;
    }
}
