<?php

namespace Bcchicr\StudentList\Models\Assembler;

use Bcchicr\StudentList\Models\Collection\UserCollection;
use PDO;
use Bcchicr\StudentList\Models\Factory\Persistance\UserPersistanceFactory;
use Bcchicr\StudentList\Models\Identity\IdentityObject;
use Bcchicr\StudentList\Models\Identity\UserIdentity;
use Bcchicr\StudentList\Models\Model;
use Bcchicr\StudentList\Models\User;
use InvalidArgumentException;

class UserAssembler extends ModelAssembler
{
    public function __construct(
        PDO $pdo,
        UserPersistanceFactory $factory,
        private StudentDataAssembler $studentDataAssembler
    ) {
        parent::__construct(
            $pdo,
            $factory
        );
    }
    public function findAll(): UserCollection
    {
        return $this->find(new UserIdentity());
    }
    public function findOne(IdentityObject $idObj): ?User
    {
        return parent::findOne($idObj);
    }
    public function upsert(Model $obj): void
    {
        if (!$obj instanceof User) {
            throw new InvalidArgumentException(sprintf(
                "Expected %s as argument. %s was given",
                User::class,
                get_debug_type($obj)
            ));
        }
        parent::upsert($obj);
        $studentData = $obj->getStudentData();
        $this->studentDataAssembler->upsert($studentData);
    }
}
