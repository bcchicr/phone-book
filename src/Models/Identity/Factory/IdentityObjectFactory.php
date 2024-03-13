<?php

namespace Bcchicr\StudentList\Models\Identity\Factory;

use Bcchicr\StudentList\Models\Identity\IdentityObject;

abstract class IdentityObjectFactory
{
    abstract public function getIdentityObject(): IdentityObject;
}
