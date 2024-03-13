<?php

namespace Bcchicr\StudentList\Models\Assembler;

use PDO;
use Bcchicr\StudentList\Models\Factory\Persistance\StudentDataPersistanceFactory;

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
}
