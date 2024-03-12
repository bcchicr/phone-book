<?php

namespace Bcchicr\StudentList\Models;

class User extends Model
{
    private StudentData $studentData;

    public function __construct(
        int $id,
        private string $login,
        private string $email,
        private string $password
    ) {
        parent::__construct($id);
    }

    public function getLogin(): string
    {
        return $this->login;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getStudentData(): StudentData
    {
        return $this->studentData;
    }
}
