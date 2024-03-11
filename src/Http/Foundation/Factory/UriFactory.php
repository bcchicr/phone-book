<?php

namespace Bcchicr\StudentList\Http\Foundation\Factory;

use Bcchicr\StudentList\Http\Foundation\Uri;

class UriFactory
{
    public function createUri(string $uriString)
    {
        return new Uri($uriString);
    }
}
