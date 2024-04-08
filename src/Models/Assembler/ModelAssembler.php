<?php

namespace Bcchicr\Framework\Models\Assembler;

use PDO;
use PDOStatement;
use Bcchicr\Framework\Models\Model;
use Bcchicr\Framework\Models\Collection\Collection;
use Bcchicr\Framework\Models\Identity\IdentityObject;
use Bcchicr\Framework\Models\Factory\Persistance\PersistanceFactory;

abstract class ModelAssembler
{
    private array $statements = [];

    public function __construct(
        private PDO $pdo,
        private PersistanceFactory $factory
    ) {
    }
    private function getStatement(string $str): PDOStatement
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
        [$selection, $values] = $this->factory->getSelectionFactory()->newSelection($idObj);
        $stmt = $this->getStatement($selection);
        $stmt->execute($values);
        $raw = $stmt->fetchAll();
        return $this->factory->getCollectionFactory()->getCollection($raw);
    }
    abstract public function findAll(): Collection;
    public function upsert(Model $obj): void
    {
        [$update, $values] = $this->factory->getUpsertFactory()->newUpdate($obj);
        $stmt = $this->getStatement($update);
        $stmt->execute($values);
        if (is_null($obj->getId())) {
            $obj->setId($this->pdo->lastInsertId());
        }
    }
}
