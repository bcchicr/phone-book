<?php

use Bcchicr\StudentList\Http\Controllers\StartPageController;
use Bcchicr\StudentList\Http\Foundation\Factory\RequestFactory;
use Bcchicr\StudentList\Http\Handler\ResponseEmitter;
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

$emitter = new ResponseEmitter($response);
$emitter->emit();
exit();
