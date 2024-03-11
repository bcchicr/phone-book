<?php

namespace Bcchicr\StudentList\Http\Controllers;

use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;

class StartPageController
{
    public function index(Request $request): Response
    {
        return new Response(body: 'This is start page!');
    }
}
