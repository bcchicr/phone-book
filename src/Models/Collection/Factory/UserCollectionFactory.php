<?php

namespace Bcchicr\StudentList\Models\Collection\Factory;

use Bcchicr\StudentList\Models\Factory\UserFactory;
use Bcchicr\StudentList\Models\Collection\UserCollection;

class UserCollectionFactory extends CollectionFactory
{
    public function __construct(
        private UserFactory $factory
    ) {
    }
    public function getCollection(array $raw): UserCollection
    {
        return new UserCollection($raw, $this->factory);
    }
}
