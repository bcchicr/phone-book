<?php

namespace Bcchicr\StudentList\Container;

use ArrayAccess;
use Bcchicr\StudentList\Traits\Singleton;
use Bcchicr\StudentList\Traits\ArrayAccessible;

class Container implements ArrayAccess
{
    use ArrayAccessible;
    use Singleton;
}
