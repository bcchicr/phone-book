<?php


use Bcchicr\Container\Container;
use Bcchicr\StudentList\Http\Factory\RequestFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$request = $container->get(RequestFactory::class)->createRequestFromGlobals();

echo $request->getUri();
// xdebug_info();
