<?php

use Bcchicr\Framework\Http\Kernel;
use Bcchicr\Framework\Http\Foundation\Factory\RequestFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap.php';

$request = $app->get(RequestFactory::class)->createRequestFromGlobals();
$app->get(Kernel::class)->handle($request);

exit();
