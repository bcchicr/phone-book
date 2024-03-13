<?php

namespace Bcchicr\StudentList\Models\Factory;

use Bcchicr\StudentList\Models\Model;
use Bcchicr\StudentList\Models\StudentData;
use InvalidArgumentException;

class StudentDataUpsert extends UpsertFactory
{
    public function newUpdate(Model $obj): array
    {
        if (!$obj instanceof StudentData) {
            throw new InvalidArgumentException(sprintf("Expected %s as argument. %s was given", StudentData::class, get_debug_type($obj)));
        }
        $id = $obj->getId();
        $cond = null;
        $values['student_first_name'] = $obj->getFirstName();
        $values['student_last_name'] = $obj->getLastName();
        $values['student_sex'] = $obj->getSex();
        $values['student_birth_date'] = $obj->getBirthDate();
        $values['student_group'] = $obj->getGroup();
        $values['student_exam_points'] = $obj->getExamPoints();

        if (!is_null($id)) {
            $cond['student_id'] = $id;
        }
        return $this->buildStatement('student_data', $values, $cond);
    }
}
