<?php

use Bcchicr\Framework\App\Application;
use Bcchicr\Framework\Http\Router\Router;
use Bcchicr\Framework\Http\Controllers\RecordController;

$app = new Application(__DIR__);

// Routes
/**
 * @var Router
 */
$router = $app->get(Router::class);
$router->get('/', [RecordController::class, 'index']);
$router->post('/records/delete', [RecordController::class, 'delete']);

// $router->get('/register', [UserController::class, 'create']);
// $router->post('/register', [UserController::class, 'store']);

// $router->get('/login', [UserController::class, 'login']);
// $router->post('/login', [UserController::class, 'auth']);



return $app;
