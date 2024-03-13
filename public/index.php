<?php

use Bcchicr\StudentList\Http\Kernel;
use Bcchicr\StudentList\Models\User;
use Bcchicr\StudentList\Models\DataMapper\UserMapper;
use Bcchicr\StudentList\Http\Foundation\Factory\RequestFactory;
use Bcchicr\StudentList\Models\DataMapper\StudentDataMapper;
use Bcchicr\StudentList\Models\StudentData;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap.php';

/**
 * @var UserMapper
 */
$userMapper = $app->get(UserMapper::class);
/**
 * @var UserMapper
 */
// $studentDataMapper = $app->get(StudentDataMapper::class);
// $studentData = new StudentData(-1, 'name3', 'name4', 'f', new DateTime(), 'g200', 200);
// $user = new User(-1, 'login2', 'mail2', 'pass2', $studentData);
// $userMapper->insert($user);
// $studentDataMapper->insert($studentData);
$users = $userMapper->findAll();

foreach ($users as $user) {
    var_dump($user);
}



// $request = $app->get(RequestFactory::class)->createRequestFromGlobals();
// $app->get(Kernel::class)->handle($request);
exit();
