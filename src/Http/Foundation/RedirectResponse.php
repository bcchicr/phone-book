<?php

namespace Bcchicr\Framework\Http\Foundation;

class RedirectResponse extends Response
{
    public function __construct(
        string $url,
        int $status = 302,
        array $headers = []
    ) {
        $this->setHeaders(['Location' => [$url]]);
        parent::__construct($status, $headers);
    }
}
