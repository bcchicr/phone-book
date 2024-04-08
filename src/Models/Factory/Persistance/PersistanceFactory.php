<?php

namespace Bcchicr\Framework\Models\Factory\Persistance;

use Bcchicr\Framework\Models\Factory\ModelFactory;
use Bcchicr\Framework\Models\Factory\Upsert\UpsertFactory;
use Bcchicr\Framework\Models\Factory\Selection\SelectionFactory;
use Bcchicr\Framework\Models\Collection\Factory\CollectionFactory;

abstract class PersistanceFactory
{
    abstract public function getModelFactory(): ModelFactory;
    abstract public function getSelectionFactory(): SelectionFactory;
    abstract public function getUpsertFactory(): UpsertFactory;
    abstract public function getCollectionFactory(): CollectionFactory;
}
