<?php

namespace Bcchicr\StudentList\Http\Factory;

use Bcchicr\StudentList\Http\Uri;

class UriFactory
{
    public function createUri(string $uriString)
    {
        return new Uri($uriString);
    }
}
