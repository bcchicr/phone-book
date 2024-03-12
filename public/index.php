<?php

use Bcchicr\StudentList\Http\Kernel;
use Bcchicr\StudentList\Models\User;
use Bcchicr\StudentList\Models\DataMapper\UserMapper;
use Bcchicr\StudentList\Http\Foundation\Factory\RequestFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap.php';

/**
 * @var UserMapper
 */
$mapper = $app->get(UserMapper::class);
$user = new User(-1, 'login1', 'mail1', 'pass1');
$mapper->insert($user);
$user = $mapper->find($user->getId());


// $request = $app->get(RequestFactory::class)->createRequestFromGlobals();
// $app->get(Kernel::class)->handle($request);
exit();
