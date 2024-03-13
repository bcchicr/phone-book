<?php

namespace Bcchicr\StudentList\Models\Factory\Persistance;

use Bcchicr\StudentList\Models\Factory\ModelFactory;
use Bcchicr\StudentList\Models\Factory\Upsert\UpsertFactory;
use Bcchicr\StudentList\Models\Factory\Selection\SelectionFactory;
use Bcchicr\StudentList\Models\Collection\Factory\CollectionFactory;

abstract class PersistanceFactory
{
    abstract public function getModelFactory(): ModelFactory;
    abstract public function getSelectionFactory(): SelectionFactory;
    abstract public function getUpsertFactory(): UpsertFactory;
    abstract public function getCollectionFactory(): CollectionFactory;
}
