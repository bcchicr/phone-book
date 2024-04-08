<?php

namespace Bcchicr\Framework\Models\Collection;

use Bcchicr\Framework\Models\User;
use Bcchicr\Framework\Models\Factory\UserFactory;

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
