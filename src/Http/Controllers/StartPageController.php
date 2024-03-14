<?php

namespace Bcchicr\StudentList\Http\Controllers;

use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Views\View;

class StartPageController
{
    public function index(Request $request): Response
    {
        return (new Response())->withBody(
            View::get('index.php', ['test' => 'hello2'])
        );
    }
}
