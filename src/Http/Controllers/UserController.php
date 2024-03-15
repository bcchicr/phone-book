<?php

namespace Bcchicr\StudentList\Http\Controllers;

use Bcchicr\StudentList\Http\Foundation\RedirectResponse;
use Bcchicr\StudentList\Views\View;
use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;

class UserController
{
    public function login(Request $request): Response
    {
        return (new Response())->withBody(
            View::get('login.php', ['test' => 'hello2'])
        );
    }
    public function create(Request $request): Response
    {
        return (new Response())->withBody(
            View::get('register.php', ['test' => 'hello2'])
        );
    }
    public function store(Request $request): Response
    {
        return new RedirectResponse('/');
    }
    public function auth(Request $request): Response
    {
        return new RedirectResponse('/');
    }
}
