<?php

namespace Bcchicr\StudentList\Models\Identity\Factory;

use Bcchicr\StudentList\Models\Identity\UserIdentity;

class UserIdentityFactory extends IdentityObjectFactory
{
    public function getIdentityObject(): UserIdentity
    {
        return new UserIdentity();
    }
}
