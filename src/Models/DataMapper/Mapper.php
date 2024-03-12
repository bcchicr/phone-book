<?php

namespace Bcchicr\StudentList\Models\DataMapper;

use Bcchicr\StudentList\Models\Model;
use PDO;
use PDOStatement;

abstract class Mapper
{
    public function __construct(
        protected PDO $pdo
    ) {
    }
    public function find(int $id): ?Model
    {
        $selectStmt = $this->getSelectStmt();
        $selectStmt->execute([$id]);
        $row = $selectStmt->fetch();
        $selectStmt->closeCursor();

        if (!is_array($row)) {
            return null;
        }
        return $this->createObject($row);
    }
    public function createObject(array $rawData): Model
    {
        return $this->doCreateObject($rawData);
    }
    public function insert(Model $obj): void
    {
        $this->doInsert($obj);
    }
    abstract public function update(Model $obj): void;
    abstract protected function doCreateObject(array $rawData): Model;
    abstract protected function doInsert(Model $obj): void;
    abstract protected function getSelectStmt(): PDOStatement;
    abstract protected function targetClass(): string;
    abstract protected static function validateModel(Model $obj);
}
