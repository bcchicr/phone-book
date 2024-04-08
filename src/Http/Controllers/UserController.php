<?php

// namespace Bcchicr\Framework\Http\Controllers;

// use Bcchicr\Framework\Http\Controllers\Validator\UserValidator;
// use Bcchicr\Framework\Http\Foundation\Factory\ResponseFactory;
// use Bcchicr\Framework\Http\Foundation\RedirectResponse;
// use Bcchicr\Framework\Views\View;
// use Bcchicr\Framework\Http\Foundation\Request;
// use Bcchicr\Framework\Http\Foundation\Response;
// use Bcchicr\Framework\Models\Assembler\UserAssembler;
// use Bcchicr\Framework\Models\StudentData;
// use Bcchicr\Framework\Models\User;

// class UserController
// {
//     public function __construct(
//         private UserValidator $validator,
//         private UserAssembler $assembler,
//         private ResponseFactory $responseFactory
//     ) {
//     }

//     public function index(Request $request): Response
//     {
//         $users = $this->assembler->findAll();
//         $students = [];
//         foreach ($users as $user) {
//             $students[] = $user->getStudentData();
//         }

//         return $this->responseFactory->createResponse()
//             ->withBody(
//                 View::get('index.php', ['students' => $students])
//             );
//     }

//     public function login(Request $request): Response
//     {
//         return (new Response())->withBody(
//             View::get('login.php', ['test' => 'hello2'])
//         );
//     }
//     public function auth(Request $request): Response
//     {
//         return new RedirectResponse('/');
//     }
//     public function create(Request $request): Response
//     {
//         return $this->responseFactory->createResponse()
//             ->withBody(
//                 View::get('register.php')
//             );
//     }
//     public function store(Request $request): Response
//     {
//         $values = [];
//         $values['login'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'login',
//             "required|max-len:100|unique"
//         );
//         $values['email'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'email',
//             "required|max-len:255|regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/u|unique"
//         );
//         $values['password'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'password',
//             "required|min-len:8|max-len:255|unique"
//         );
//         $values['first-name'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'first-name',
//             "required|max-len:100|regex:/^[А-ЯЁ][A-ЯЁa-яё' -]*$/u"
//         );
//         $values['last-name'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'last-name',
//             "required|max-len:100|regex:/^[А-ЯЁ][A-ЯЁa-яё' -]*$/u"
//         );
//         $values['sex'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'sex',
//             "required|regex:/^[fm]$/u"
//         );
//         $values['birth-date'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'birth-date',
//             "required|date"
//         );
//         $values['points'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'points',
//             "required|int|min:0|max:300"
//         );
//         $values['group'] = $this->validator->validate(
//             $request->getParsedBody(),
//             'group',
//             "required|regex:/^[А-яЁа-яё0-9]{2,5}$/u"
//         );

//         $errors = $this->validator->getErrors();
//         if (count($errors) > 0) {
//             return $this->responseFactory->createResponse(400)
//                 ->withBody(View::get('register.php', [
//                     'errors' => $errors,
//                     'values' => $values
//                 ]));
//         }

//         $studentData = new StudentData(
//             null,
//             $values['first-name'],
//             $values['last-name'],
//             $values['sex'],
//             $values['birth-date'],
//             $values['group'],
//             $values['points']
//         );
//         $user = new User(
//             null,
//             $values['login'],
//             $values['email'],
//             $values['password'],
//             $studentData
//         );
//         $this->assembler->upsert($user);
//         return $this->responseFactory->createRedirectResponse('/');
//     }
// }
