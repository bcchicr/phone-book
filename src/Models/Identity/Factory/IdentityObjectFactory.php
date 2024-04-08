<?php

namespace Bcchicr\Framework\Models\Identity\Factory;

use Bcchicr\Framework\Models\Identity\IdentityObject;

abstract class IdentityObjectFactory
{
    abstract public function getIdentityObject(): IdentityObject;
}
