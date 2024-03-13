<?php

namespace Bcchicr\StudentList\Models\Factory\Persistance;

use Bcchicr\StudentList\Models\Collection\Factory\UserCollectionFactory;
use Bcchicr\StudentList\Models\Factory\Selection\UserSelection;
use Bcchicr\StudentList\Models\Factory\Upsert\UserUpsert;
use Bcchicr\StudentList\Models\Factory\UserFactory;

class UserPersistanceFactory extends PersistanceFactory
{
    public function __construct(
        private UserFactory $userFactory,
        private UserCollectionFactory $userCollectionFactory,
        private UserSelection $userSelection,
        private UserUpsert $userUpsert
    ) {
    }
    public function getModelFactory(): UserFactory
    {
        return $this->userFactory;
    }
    public function getCollectionFactory(): UserCollectionFactory
    {
        return $this->userCollectionFactory;
    }
    public function getSelectionFactory(): UserSelection
    {
        return $this->userSelection;
    }
    public function getUpsertFactory(): UserUpsert
    {
        return $this->userUpsert;
    }
}
