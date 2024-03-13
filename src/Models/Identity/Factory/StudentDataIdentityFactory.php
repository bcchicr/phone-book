<?php

namespace Bcchicr\StudentList\Models\Identity\Factory;

use Bcchicr\StudentList\Models\Identity\StudentDataIdentity;

class StudentDataIdentityFactory extends IdentityObjectFactory
{
    public function getIdentityObject(): StudentDataIdentity
    {
        return new StudentDataIdentity();
    }
}
