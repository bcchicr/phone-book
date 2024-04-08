<?php

namespace Bcchicr\Framework\Http\Foundation\Factory;

use Bcchicr\Framework\Http\Foundation\Uri;

class UriFactory
{
    public function createUri(string $uriString)
    {
        return new Uri($uriString);
    }
}
