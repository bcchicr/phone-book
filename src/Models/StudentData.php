<?php

namespace Bcchicr\Framework\Models;

use DateTime;

class StudentData extends Model
{
    private DateTime|string $birthDate;

    public function __construct(
        ?int $id,
        private string $firstName,
        private string $lastName,
        private string $sex,
        $birthDate,
        private string $group,
        private int $examPoints,
    ) {
        parent::__construct($id);
        if (is_string($birthDate)) {
            $birthDate = new DateTime($birthDate);
        }
        $this->birthDate = $birthDate;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function getSex(): string
    {
        return $this->sex;
    }
    public function getGroup(): string
    {
        return $this->group;
    }
    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }
    public function getExamPoints(): int
    {
        return $this->examPoints;
    }
    public function setExamPoints(int $points): void
    {
        $this->examPoints = $points;
    }
}
