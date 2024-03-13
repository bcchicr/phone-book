<?php

namespace Bcchicr\StudentList\Models;

use DateTime;

class StudentData extends Model
{
    public function __construct(
        int $id,
        private string $firstName,
        private string $lastName,
        private string $sex,
        private DateTime $birthDate,
        private string $group,
        private int $examPoints,
    ) {
        parent::__construct($id);
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
}
