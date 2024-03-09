<?php

namespace Bcchicr\StudentList\App;

use Bcchicr\Container\Container;

class Application extends Container
{
    public function __invoke(string $id)
    {
        return $this->get($id);
    }
}
