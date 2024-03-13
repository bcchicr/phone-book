<?php

namespace Bcchicr\StudentList\Models\Identity;

class StudentDataIdentity extends IdentityObject
{
    public function __construct(
        ?string $field = null
    ) {
        parent::__construct(
            $field,
            [
                'student_id',
                'student_first_name',
                'student_last_name',
                'student_sex',
                'student_birth_date',
                'student_group',
                'student_exam_points'
            ]
        );
    }
}
