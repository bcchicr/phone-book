<?php

namespace Bcchicr\StudentList\Http\Controllers;

use Bcchicr\StudentList\Http\Controllers\Validator\UserValidator;
use Bcchicr\StudentList\Http\Foundation\Factory\ResponseFactory;
use Bcchicr\StudentList\Http\Foundation\RedirectResponse;
use Bcchicr\StudentList\Views\View;
use Bcchicr\StudentList\Http\Foundation\Request;
use Bcchicr\StudentList\Http\Foundation\Response;
use Bcchicr\StudentList\Models\Assembler\UserAssembler;
use Bcchicr\StudentList\Models\StudentData;
use Bcchicr\StudentList\Models\User;

class UserController
{
    public function __construct(
        private UserValidator $validator,
        private UserAssembler $assembler,
        private ResponseFactory $responseFactory
    ) {
    }

    public function index(Request $request): Response
    {
        $users = $this->assembler->findAll();
        $students = [];
        foreach ($users as $user) {
            $students[] = $user->getStudentData();
        }

        return $this->responseFactory->createResponse()
            ->withBody(
                View::get('index.php', ['students' => $students])
            );
    }

    public function login(Request $request): Response
    {
        return (new Response())->withBody(
            View::get('login.php', ['test' => 'hello2'])
        );
    }
    public function auth(Request $request): Response
    {
        return new RedirectResponse('/');
    }
    public function create(Request $request): Response
    {
        return $this->responseFactory->createResponse()
            ->withBody(
                View::get('register.php')
            );
    }
    public function store(Request $request): Response
    {
        $login = $this->validator->validate(
            $request->getParsedBody(),
            'login',
            "required|max-len:100|unique"
        );
        $email = $this->validator->validate(
            $request->getParsedBody(),
            'email',
            "required|max-len:255|regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/u|unique"
        );
        $password = $this->validator->validate(
            $request->getParsedBody(),
            'password',
            "required|max-len:255|unique"
        );
        $firstName = $this->validator->validate(
            $request->getParsedBody(),
            'first-name',
            "required|max-len:100|regex:/^[А-ЯЁ][A-ЯЁa-яё' -]*$/u"
        );
        $lastName = $this->validator->validate(
            $request->getParsedBody(),
            'last-name',
            "required|max-len:100|regex:/^[А-ЯЁ][A-ЯЁa-яё' -]*$/u"
        );
        $sex = $this->validator->validate(
            $request->getParsedBody(),
            'sex',
            "required|regex:/^[fm]$/u"
        );
        $birthDate = $this->validator->validate(
            $request->getParsedBody(),
            'birth-date',
            "required|date"
        );
        $points = $this->validator->validate(
            $request->getParsedBody(),
            'points',
            "required|int|min:0|max:300"
        );
        $group = $this->validator->validate(
            $request->getParsedBody(),
            'group',
            "required|regex:/^[А-яЁа-яё0-9]{2,5}$/u"
        );

        $errors = $this->validator->getErrors();
        if (count($errors) > 0) {
            return $this->responseFactory->createResponse(400)
                ->withBody(View::get('register.php', ['errors' => $errors]));
        }

        $studentData = new StudentData(null, $firstName, $lastName, $sex, $birthDate, $group, $points);
        $user = new User(null, $login, $email, $password, $studentData);
        $this->assembler->upsert($user);
        return $this->responseFactory->createRedirectResponse('/');
    }
}
