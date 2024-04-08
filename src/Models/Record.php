<?php

namespace Bcchicr\Framework\Models;

final class Record
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $phoneNumber
    ) {
    }
}
