<?php

namespace Bcchicr\StudentList\Models\DataMapper;

use Bcchicr\StudentList\Models\Model;
use Bcchicr\StudentList\Models\StudentData;
use InvalidArgumentException;
use PDO;
use PDOStatement;

class StudentDataMapper extends Mapper
{
    private PDOStatement $selectStmt;
    private PDOStatement $updateStmt;
    private PDOStatement $insertStmt;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->selectStmt = $this->pdo->prepare(
            "SELECT * FROM student_data
                WHERE student_id=?;"
        );
        $this->updateStmt = $this->pdo->prepare(
            "UPDATE student_data SET 
                student_first_name=?, 
                student_last_name=?, 
                student_sex=?, 
                student_birth_date=?, 
                student_group=?, 
                student_exam_points=? 
            WHERE student_id=?;"
        );
        $this->insertStmt = $this->pdo->prepare(
            "INSERT INTO student_data (
                student_first_name,
                student_last_name, 
                student_sex, 
                student_birth_date, 
                student_group, 
                student_exam_points
                ) VALUES (?, ?, ?, ?, ?, ?);"
        );
    }
    protected function targetClass(): string
    {
        return StudentData::class;
    }
    protected function doCreateObject(array $rawData): StudentData
    {
        $obj = new StudentData(
            $rawData['student_id'],
            $rawData['student_first_name'],
            $rawData['student_last_name'],
            $rawData['student_sex'],
            $rawData['student_birth_date'],
            $rawData['student_group'],
            $rawData['student_exam_points']
        );
        return $obj;
    }
    /**
     * @param StudentData $obj
     */
    protected function doInsert(Model $obj): void
    {
        self::validateModel($obj);
        $values = [
            $obj->getFirstName(),
            $obj->getLastName(),
            $obj->getSex(),
            $obj->getBirthDate(),
            $obj->getGroup(),
            $obj->getExamPoints()
        ];
        $this->insertStmt->execute($values);
        $id = $this->pdo->lastInsertId();
        $obj->setId($id);
    }
    /**
     * @param StudentData $obj
     */
    public function update(Model $obj): void
    {
        self::validateModel($obj);
        $values = [
            $obj->getFirstName(),
            $obj->getLastName(),
            $obj->getSex(),
            $obj->getBirthDate(),
            $obj->getGroup(),
            $obj->getExamPoints()
        ];
        $this->updateStmt->execute($values);
    }
    public function getSelectStmt(): PDOStatement
    {
        return $this->selectStmt;
    }
    protected static function validateModel(Model $obj): void
    {
        if (!$obj instanceof StudentData) {
            throw new InvalidArgumentException(sprintf(
                "Expected instance of %s as first argument. %s was given",
                StudentData::class,
                get_debug_type($obj)
            ));
        }
    }
}
