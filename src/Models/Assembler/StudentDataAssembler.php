<?php

namespace Bcchicr\Framework\Models\Assembler;

use PDO;
use Bcchicr\Framework\Models\Collection\StudentDataCollection;
use Bcchicr\Framework\Models\Factory\Persistance\StudentDataPersistanceFactory;
use Bcchicr\Framework\Models\Identity\IdentityObject;
use Bcchicr\Framework\Models\Identity\StudentDataIdentity;
use Bcchicr\Framework\Models\Model;
use Bcchicr\Framework\Models\StudentData;

class StudentDataAssembler extends ModelAssembler
{
    public function __construct(
        PDO $pdo,
        StudentDataPersistanceFactory $factory
    ) {
        parent::__construct(
            $pdo,
            $factory
        );
    }
    public function findOne(IdentityObject $idObj): ?StudentData
    {
        return parent::findOne($idObj);
    }
    public function findAll(): StudentDataCollection
    {

        return $this->find(new StudentDataIdentity());
    }
}
