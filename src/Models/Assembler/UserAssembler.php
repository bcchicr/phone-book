<?php

namespace Bcchicr\StudentList\Models\Assembler;

use PDO;
use Bcchicr\StudentList\Models\Factory\Persistance\UserPersistanceFactory;

class UserAssembler extends ModelAssembler
{
    public function __construct(
        PDO $pdo,
        UserPersistanceFactory $factory
    ) {
        parent::__construct(
            $pdo,
            $factory
        );
    }
}
