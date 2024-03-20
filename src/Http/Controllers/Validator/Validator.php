<?php

namespace Bcchicr\StudentList\Http\Controllers\Validator;

use DateTime;

class Validator
{
    protected array $errors = [];
    public function validate(array $fields, string $fieldName, string $rules): string
    {
        $field = $fields[$fieldName];

        $rules = $this->getRules($rules);

        foreach ($rules as $rule) {
            $ruleName = $rule[0];
            $ruleArg = $rule[1] ?? null;
            $this->$ruleName($fieldName, $field, $ruleArg);
        }

        return $field;
    }
    private function required(string $fieldName, string $field): void
    {
        if (empty($field)) {
            $this->addError($fieldName, "{$fieldName} не может быть пустым.");
        }
    }
    private function maxLen(string $fieldName, string $field, int $len)
    {
        if (mb_strlen($field) > $len) {
            $this->addError($fieldName, "{$fieldName} должен быть короче {$len} символов.");
        }
    }
    private function regex(string $fieldName, string $field, string $regex)
    {
        if (preg_match($regex, $field) === false) {
            $this->addError($fieldName, "{$fieldName} имеет некорректный формат.");
        }
    }
    private function date(string $fieldName, string $field)
    {
        if (strtotime($field) === false) {
            $this->addError($fieldName, "{$fieldName} должен быть датой.");
        }
    }
    private function int(string $fieldName, mixed $field)
    {
        if (!preg_match('/^[-]?[0-9]+$/', $field)) {
            $this->addError($fieldName, "{$fieldName} должен быть целым числом.");
        }
    }
    private function min(string $fieldName, string $field, mixed $value)
    {
        if ($field < $value) {
            $this->addError($fieldName, "{$fieldName} должен быть больше $value.");
        }
    }
    private function max(string $fieldName, string $field, mixed $value)
    {
        if ($field > $value) {
            $this->addError($fieldName, "{$fieldName} должен быть меньше $value.");
        }
    }
    protected function addError(string $fieldName, string $message)
    {
        $this->errors[$fieldName][] = $message;
    }
    private function getRules(string $ruleString): array
    {
        $rules = explode('|', $ruleString);
        $rules = array_map(
            function ($item) {
                $rule = explode(':', $item);
                $rule[0] = preg_replace_callback(
                    '/-([a-z])/u',
                    fn ($matches) => strtoupper($matches[1]),
                    $rule[0]
                );
                return $rule;
            },
            $rules
        );
        return $rules;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
}
