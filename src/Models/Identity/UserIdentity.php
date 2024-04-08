<?php

namespace Bcchicr\Framework\Models\Identity;

class UserIdentity extends IdentityObject
{
    public function __construct(?string $field = null)
    {
        parent::__construct(
            $field,
            [
                'user_id',
                'user_login',
                'user_email',
                'user_password'
            ]
        );
    }
}
