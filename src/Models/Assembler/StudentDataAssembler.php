<?php

namespace Bcchicr\StudentList\Models\Assembler;

use PDO;
use Bcchicr\StudentList\Models\Collection\StudentDataCollection;
use Bcchicr\StudentList\Models\Factory\Persistance\StudentDataPersistanceFactory;
use Bcchicr\StudentList\Models\Identity\IdentityObject;
use Bcchicr\StudentList\Models\Identity\StudentDataIdentity;
use Bcchicr\StudentList\Models\Model;
use Bcchicr\StudentList\Models\StudentData;

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
