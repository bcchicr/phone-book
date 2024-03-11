<?php

use Bcchicr\StudentList\Http\Controllers\StartPageController;
use Bcchicr\StudentList\Http\Foundation\Factory\RequestFactory;
use Bcchicr\StudentList\Http\Handler\ResponseEmitter;
use Bcchicr\StudentList\Http\Handler\Runner\Pipeline;
use Bcchicr\StudentList\Http\Handler\Runner\RequestRunner;
use Bcchicr\StudentList\Http\Router\Middleware\RouteDispatcher;
use Bcchicr\StudentList\Http\Router\Middleware\RouteMatcher;
use Bcchicr\StudentList\Http\Router\Router;

// Автозагрузка классов
require __DIR__ . '/../vendor/autoload.php';

// Чтение конфига, подключение к базе
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Чтение http-запроса 
$request = $app(RequestFactory::class)->createRequestFromGlobals();

// Объявление маршрутов
$router = $app(Router::class);
$router->get('/', [StartPageController::class, 'index']);

// Подключение посредников в цепочку обработки
$pipeline = new Pipeline();
$pipeline->pipe($app(RouteMatcher::class));
$pipeline->pipe($app(RouteDispatcher::class));

// Обработка http-запроса, получение http-ответа
$runner = new RequestRunner($pipeline);
$response = $runner->handle($request);

// Отправка http-ответа клиенту
$emitter = new ResponseEmitter($response);
$emitter->emit();

// Завершение процесса
exit();
