<?php

namespace Bcchicr\StudentList\Models\DataMapper;

use Bcchicr\StudentList\Models\Model;
use Bcchicr\StudentList\Models\User;
use InvalidArgumentException;
use PDO;
use PDOStatement;

class UserMapper extends Mapper
{
    private PDOStatement $selectStmt;
    private PDOStatement $updateStmt;
    private PDOStatement $insertStmt;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->selectStmt = $this->pdo->prepare(
            "SELECT * FROM users
                WHERE user_id=?"
        );
        $this->updateStmt = $this->pdo->prepare(
            "UPDATE users SET
                user_login=?,
                user_email=?,
                user_password=?
            WHERE user_id=?"
        );
        $this->insertStmt = $this->pdo->prepare(
            "INSERT INTO users (
                user_login,
                user_email, 
                user_password
            ) VALUES (?, ?, ?)"
        );
    }
    protected function targetClass(): string
    {
        return User::class;
    }
    protected function doCreateObject(array $rawData): User
    {
        $obj = new User(
            $rawData['user_id'],
            $rawData['user_login'],
            $rawData['user_email'],
            $rawData['user_password']
        );
        return $obj;
    }
    /**
     * @param User $obj
     */
    protected function doInsert(Model $obj): void
    {
        self::validateModel($obj);
        $values = [
            $obj->getLogin(),
            $obj->getEmail(),
            $obj->getPassword()
        ];
        $this->insertStmt->execute($values);
        $id = $this->pdo->lastInsertId();
        $obj->setId($id);
    }
    /**
     * @param User $obj
     */
    public function update(Model $obj): void
    {
        self::validateModel($obj);
        $values = [
            $obj->getLogin(),
            $obj->getEmail(),
            $obj->getPassword(),
            $obj->getId()
        ];
        $this->updateStmt->execute($values);
    }
    public function getSelectStmt(): PDOStatement
    {
        return $this->selectStmt;
    }
    protected static function validateModel(Model $obj): void
    {
        if (!$obj instanceof User) {
            throw new InvalidArgumentException(sprintf(
                "Expected instance of %s as first argument. %s was given",
                User::class,
                get_debug_type($obj)
            ));
        }
    }
}
