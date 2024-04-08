<?php

namespace Bcchicr\Framework\Models\Factory\Upsert;

use Bcchicr\Framework\Models\Model;
use Bcchicr\Framework\Models\User;
use InvalidArgumentException;

class UserUpsert extends UpsertFactory
{
    public function newUpdate(Model $obj): array
    {
        if (!$obj instanceof User) {
            throw new InvalidArgumentException(sprintf("Expected %s as argument. %s was given", User::class, get_debug_type($obj)));
        }
        $id = $obj->getId();
        $cond = null;
        $values['user_login'] = $obj->getLogin();
        $values['user_email'] = $obj->getEmail();
        $values['user_password'] = $obj->getPassword();

        if (!is_null($id)) {
            $cond['user_id'] = $id;
        }
        return $this->buildStatement('users', $values, $cond);
    }
}
