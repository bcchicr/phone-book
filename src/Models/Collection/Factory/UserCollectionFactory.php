<?php

namespace Bcchicr\Framework\Models\Collection\Factory;

use Bcchicr\Framework\Models\Factory\UserFactory;
use Bcchicr\Framework\Models\Collection\UserCollection;

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
