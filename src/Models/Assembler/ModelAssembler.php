<?php

namespace Bcchicr\StudentList\Models\Assembler;

use PDO;
use PDOStatement;
use Bcchicr\StudentList\Models\Model;
use Bcchicr\StudentList\Models\Collection\Collection;
use Bcchicr\StudentList\Models\Identity\IdentityObject;
use Bcchicr\StudentList\Models\Factory\Persistance\PersistanceFactory;

abstract class ModelAssembler
{
    private array $statements = [];
    private ?Collection $collection = null;

    public function __construct(
        private PDO $pdo,
        private PersistanceFactory $factory
    ) {
    }
    public function getStatement(string $str): PDOStatement
    {
        if (!isset($this->statements[$str])) {
            $this->statements[$str] = $this->pdo->prepare($str);
        }
        return $this->statements[$str];
    }
    public function findOne(IdentityObject $idObj): ?Model
    {
        $collection = $this->find($idObj);
        return $collection->getIterator()->current();
    }
    public function find(IdentityObject $idObj): Collection
    {
        if (!is_null($this->collection)) {
            return $this->collection;
        }
        [$selection, $values] = $this->factory->getSelectionFactory()->newSelection($idObj);
        $stmt = $this->getStatement($selection);
        $stmt->execute($values);
        $raw = $stmt->fetchAll();
        return $this->factory->getCollectionFactory()->getCollection($raw);
    }
    public function upsert(Model $obj): void
    {
        [$update, $values] = $this->factory->getUpsertFactory()->newUpdate($obj);
        $stmt = $this->getStatement($update);
        $stmt->execute($values);
        if (is_null($obj->getId())) {
            $obj->setId($this->pdo->lastInsertId());
        }
        $this->collection = null;
    }
}
