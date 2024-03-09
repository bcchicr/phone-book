<?php

namespace Bcchicr\StudentList\Controller;

use Bcchicr\StudentList\Http\Request;
use Bcchicr\StudentList\Http\Response;

class StartPageController
{
    public function index(Request $request): Response
    {
        return new Response(body: 'This is start page!');
    }
}
