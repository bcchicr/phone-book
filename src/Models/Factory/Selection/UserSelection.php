<?php

namespace Bcchicr\StudentList\Models\Factory\Selection;

use InvalidArgumentException;
use Bcchicr\StudentList\Models\Identity\UserIdentity;
use Bcchicr\StudentList\Models\Identity\IdentityObject;

class UserSelection extends SelectionFactory
{
    public function newSelection(IdentityObject $obj): array
    {
        if (!$obj instanceof UserIdentity) {
            throw new InvalidArgumentException(sprintf("Expected %s as argument. %s was given", UserIdentity::class, get_debug_type($obj)));
        }
        $fields = implode(',', $obj->getObjectFields());
        $core = "SELECT {$fields} FROM users";
        [$where, $values] = $this->buildWhere($obj);
        return [$core . " " . $where, $values];
    }
}
