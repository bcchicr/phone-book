<?php

namespace Bcchicr\StudentList\Models\Factory\Persistance;

use Bcchicr\StudentList\Models\Collection\Factory\StudentDataCollectionFactory;
use Bcchicr\StudentList\Models\Factory\Selection\StudentDataSelection;
use Bcchicr\StudentList\Models\Factory\StudentDataFactory;
use Bcchicr\StudentList\Models\Factory\Upsert\StudentDataUpsert;

class StudentDataPersistanceFactory extends PersistanceFactory
{
    public function __construct(
        private StudentDataFactory $studentDataFactory,
        private StudentDataCollectionFactory $studentDataCollectionFactory,
        private StudentDataSelection $studentDataSelection,
        private StudentDataUpsert $studentDataUpsert
    ) {
    }
    public function getModelFactory(): StudentDataFactory
    {
        return $this->studentDataFactory;
    }
    public function getCollectionFactory(): StudentDataCollectionFactory
    {
        return $this->studentDataCollectionFactory;
    }
    public function getSelectionFactory(): StudentDataSelection
    {
        return $this->studentDataSelection;
    }
    public function getUpsertFactory(): StudentDataUpsert
    {
        return $this->studentDataUpsert;
    }
}
