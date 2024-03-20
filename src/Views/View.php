<?php

namespace Bcchicr\StudentList\Views;

use Bcchicr\StudentList\Http\Foundation\Stream;

class View
{
    private const TEMPLATES_PATH = __DIR__ . '/../../resources/views/';

    public static function get(string $name, array $vars = []): Stream
    {
        extract($vars);

        ob_start();
        include self::TEMPLATES_PATH . $name;
        return Stream::create(ob_get_clean());
    }
}
