<?php


use Bcchicr\Container\Container;
use Bcchicr\StudentList\Http\Factory\RequestFactory;
use Bcchicr\StudentList\Controller\StartPageController;
use Bcchicr\StudentList\Http\Response;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$request = $container->get(RequestFactory::class)->createRequestFromGlobals();

$uri = $request->getUri()->getPath();
if ($uri === '/') {
    $response = (new StartPageController)->index($request);
} else {
    $response = new Response(404, [], 'Not Found');
}

echo $response->getBody();

// xdebug_info();
