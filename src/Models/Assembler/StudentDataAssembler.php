<?php

namespace Bcchicr\StudentList\Models\Assembler;

use PDO;
use Bcchicr\StudentList\Models\Factory\StudentDataUpsert;
use Bcchicr\StudentList\Models\Factory\StudentDataFactory;
use Bcchicr\StudentList\Models\Factory\StudentDataSelection;
use Bcchicr\StudentList\Models\Collection\Factory\StudentDataCollectionFactory;

class StudentDataAssembler extends ModelAssembler
{
    public function __construct(
        PDO $pdo,
        StudentDataFactory $modelFactory,
        StudentDataSelection $selectionFactory,
        StudentDataUpsert $upsertFactory,
        StudentDataCollectionFactory $collectionFactory,
    ) {
        parent::__construct(
            $pdo,
            $modelFactory,
            $selectionFactory,
            $upsertFactory,
            $collectionFactory,
        );
    }
}
