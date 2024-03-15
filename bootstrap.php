<?php

use Bcchicr\StudentList\App\Application;
use Bcchicr\StudentList\Http\Router\Router;
use Bcchicr\StudentList\Http\Controllers\StartPageController;
use Bcchicr\StudentList\Http\Controllers\UserController;

$app = new Application(__DIR__);

// Routes
/**
 * @var Router
 */
$router = $app->get(Router::class);
$router->get('/', [StartPageController::class, 'index']);

$router->get('/register', [UserController::class, 'create']);
$router->post('/register', [UserController::class, 'store']);

$router->get('/login', [UserController::class, 'login']);
$router->post('/login', [UserController::class, 'auth']);



return $app;
