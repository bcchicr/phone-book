<?php

namespace Bcchicr\Framework\Models\Identity\Factory;

use Bcchicr\Framework\Models\Identity\UserIdentity;

class UserIdentityFactory extends IdentityObjectFactory
{
    public function getIdentityObject(): UserIdentity
    {
        return new UserIdentity();
    }
}
