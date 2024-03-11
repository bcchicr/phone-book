<?php

use Bcchicr\StudentList\Http\Controllers\StartPageController;
use Bcchicr\StudentList\Http\Foundation\Factory\RequestFactory;
use Bcchicr\StudentList\Http\Handler\Runner\Pipeline;
use Bcchicr\StudentList\Http\Handler\Runner\RequestRunner;
use Bcchicr\StudentList\Http\Router\Middleware\RouteDispatcher;
use Bcchicr\StudentList\Http\Router\Middleware\RouteMatcher;
use Bcchicr\StudentList\Http\Router\Router;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$request = $app(RequestFactory::class)->createRequestFromGlobals();

/**
 * @var Router
 */
$router = $app(Router::class);
$router->get('/', [StartPageController::class, 'index']);

$pipeline = new Pipeline();
$pipeline->pipe($app(RouteMatcher::class));
$pipeline->pipe($app(RouteDispatcher::class));

$runner = new RequestRunner($pipeline);
$response = $runner->handle($request);


//  new Router();

// $handler = 

if (headers_sent()) {
    throw new RuntimeException('Headers were already sent. The response could not be emitted');
}
$statusLine = sprintf(
    'HTTP/%s %s %s',
    $response->getProtocolVersion(),
    $response->getStatusCode(),
    $response->getReasonPhrase()
);
header($statusLine, true);
foreach ($response->getHeaders() as $name => $value) {
    $responseHeader = sprintf(
        '%s: %s',
        $name,
        $response->getHeaderLine($name)
    );
    header($responseHeader, false);
}
echo $response->getBody();
exit();
