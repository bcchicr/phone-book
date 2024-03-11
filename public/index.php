<?php

use Bcchicr\StudentList\Http\Kernel;
use Bcchicr\StudentList\Http\Handler\ResponseEmitter;
use Bcchicr\StudentList\Http\Foundation\Factory\RequestFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap.php';

$request = $app(RequestFactory::class)->createRequestFromGlobals();
$kernel = $app(Kernel::class);

$kernel->handle($request);

exit();
