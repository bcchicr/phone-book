<?php

namespace Bcchicr\StudentList\Models\Collection;

use Bcchicr\StudentList\Models\User;
use Bcchicr\StudentList\Models\Factory\UserFactory;

class UserCollection extends Collection
{
    public function __construct(
        array $raw = [],
        ?UserFactory $factory = null
    ) {
        parent::__construct($raw, $factory);
    }
    protected function targetClass(): string
    {
        return User::class;
    }
}
