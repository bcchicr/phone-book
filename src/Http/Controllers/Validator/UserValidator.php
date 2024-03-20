<?php

namespace Bcchicr\StudentList\Http\Controllers\Validator;

use Bcchicr\StudentList\Models\Assembler\UserAssembler;
use Bcchicr\StudentList\Models\Identity\UserIdentity;

class UserValidator extends Validator
{
    public function __construct(
        private UserAssembler $assembler
    ) {
    }
    protected function unique(string $fieldName, string $field)
    {
        $fieldName = strtr($fieldName, '-', '_');
        $fieldName = 'user_' . $fieldName;
        $identity = (new UserIdentity())->field($fieldName)->eq($field);
        $collection = $this->assembler->find($identity);

        if (count($collection) > 0) {
            $this->addError($fieldName, "Такой {$fieldName} уже присутствует в системе.");
        }
    }
}
