<?php

namespace Bcchicr\Framework\Models\Identity\Factory;

use Bcchicr\Framework\Models\Identity\StudentDataIdentity;

class StudentDataIdentityFactory extends IdentityObjectFactory
{
    public function getIdentityObject(): StudentDataIdentity
    {
        return new StudentDataIdentity();
    }
}
