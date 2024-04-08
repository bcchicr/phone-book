<?php

namespace Bcchicr\Framework\Models\Identity;

class Field
{
    protected array $comps = [];
    public function __construct(
        protected string $name
    ) {
    }
    public function addCondition(string $operator, mixed $value): void
    {
        $this->comps[] = [
            'name' => $this->name,
            'operator' => $operator,
            'value' => $value
        ];
    }
    public function getComps(): array
    {
        return $this->comps;
    }
    public function isIncomplete(): bool
    {
        return empty($this->comps);
    }
}
