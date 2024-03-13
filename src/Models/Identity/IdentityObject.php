<?php

namespace Bcchicr\StudentList\Models\Identity;

use InvalidArgumentException;
use RuntimeException;

abstract class IdentityObject
{
    protected ?Field $currentField = null;
    protected array $fields = [];
    private array $enforce = [];

    public function __construct(
        ?string $field = null,
        ?array $enforce = null
    ) {
        if (!is_null($enforce)) {
            $this->enforce = $enforce;
        }
        if (!is_null($field)) {
            $this->field($field);
        }
    }
    public function getObjectFields(): array
    {
        return $this->enforce;
    }
    public function field(string $fieldName): static
    {
        if (!$this->isVoid() && $this->currentField->isIncomplete()) {
            throw new RuntimeException("Field is incomplete");
        }
        $this->enforceField($fieldName);
        if (isset($this->fields[$fieldName])) {
            $this->currentField = $this->fields[$fieldName];
        } else {
            $this->currentField = new Field($fieldName);
            $this->fields[$fieldName] = $this->currentField;
        }
        return $this;
    }
    public function isVoid(): bool
    {
        return empty($this->fields);
    }
    public function enforceField(string $fieldName): void
    {
        if (
            !in_array($fieldName, $this->enforce) &&
            !empty($this->enforce)
        ) {
            $forceList = implode(', ', $this->enforce);
            throw new InvalidArgumentException("Expected one of ({$forceList} as field name. {$fieldName} was given)");
        }
    }
    public function eq(mixed $value): static
    {
        return $this->operator("=", $value);
    }
    public function lt(mixed $value): static
    {
        return $this->operator("<", $value);
    }
    public function le(mixed $value): static
    {
        return $this->operator("<=", $value);
    }
    public function gt(mixed $value): static
    {
        return $this->operator(">", $value);
    }
    public function ge(mixed $value): static
    {
        return $this->operator(">=", $value);
    }
    private function operator(string $symbol, mixed $value): static
    {
        if ($this->isVoid()) {
            throw new RuntimeException("Field is undefined");
        }
        $this->currentField->addCondition($symbol, $value);
        return $this;
    }
    public function getComps(): array
    {
        $ret = [];
        foreach ($this->fields as $field) {
            $ret =  array_merge($ret, $field->getComps());
        }
        return $ret;
    }
}
