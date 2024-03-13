<?php

namespace Bcchicr\StudentList\Models\Assembler;

use PDO;
use Bcchicr\StudentList\Models\Factory\UserUpsert;
use Bcchicr\StudentList\Models\Factory\UserFactory;
use Bcchicr\StudentList\Models\Factory\UserSelection;
use Bcchicr\StudentList\Models\Collection\Factory\UserCollectionFactory;

class UserAssembler extends ModelAssembler
{
    public function __construct(
        PDO $pdo,
        UserFactory $modelFactory,
        UserSelection $selectionFactory,
        UserUpsert $upsertFactory,
        UserCollectionFactory $collectionFactory,
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
