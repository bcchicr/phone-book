<?php

namespace Bcchicr\Framework\Models\Factory;

use Bcchicr\Framework\Models\User;
use Bcchicr\Framework\Models\Watcher\IdentityWatcher;
use Bcchicr\Framework\Models\Assembler\StudentDataAssembler;
use Bcchicr\Framework\Models\Identity\Factory\StudentDataIdentityFactory;

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

        $studentIdentity =
            $this->studentDataIdentityFactory->getIdentityObject()
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
