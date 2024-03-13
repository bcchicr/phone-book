<?php

namespace Bcchicr\StudentList\Models\Factory\Selection;

use InvalidArgumentException;
use Bcchicr\StudentList\Models\Identity\IdentityObject;
use Bcchicr\StudentList\Models\Identity\StudentDataIdentity;

class StudentDataSelection extends SelectionFactory
{
    public function newSelection(IdentityObject $obj): array
    {
        if (!$obj instanceof StudentDataIdentity) {
            throw new InvalidArgumentException(sprintf(
                "Expected %s as argument. %s was given",
                StudentDataIdentity::class,
                get_debug_type($obj)
            ));
        }
        $fields = implode(',', $obj->getObjectFields());
        $core = "SELECT {$fields} FROM student_data";
        [$where, $values] = $this->buildWhere($obj);
        return [$core . " " . $where, $values];
    }
}
