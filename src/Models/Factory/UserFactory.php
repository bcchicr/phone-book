<?php

namespace Bcchicr\StudentList\Models\Factory;

use Bcchicr\StudentList\Models\User;
use Bcchicr\StudentList\Models\Watcher\IdentityWatcher;
use Bcchicr\StudentList\Models\Assembler\StudentDataAssembler;
use Bcchicr\StudentList\Models\Identity\Factory\StudentDataIdentityFactory;

class UserFactory extends ModelFactory
{
    public function __construct(
        private StudentDataAssembler $studentDataAssembler,
        private StudentDataIdentityFactory $studentDataIdentityFactory,
        private IdentityWatcher $identityWatcher
    ) {
    }
    public function createObject(array $raw): User
    {
        $object = $this->identityWatcher->get(User::class, $raw['user_id']);
        if (!is_null($object)) {
            return $object;
        }

        $studentIdentity = $this->studentDataIdentityFactory->getIdentityObject()
            ->field('student_id')
            ->eq($raw['user_id']);
        $studentData = $this->studentDataAssembler->findOne($studentIdentity);
        $object = new User(
            $raw['user_id'],
            $raw['user_login'],
            $raw['user_email'],
            $raw['user_password'],
            $studentData,
        );
        $this->identityWatcher->add($object);
        return $object;
    }
}
