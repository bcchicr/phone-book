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

$router->get('/records/create', [RecordController::class, 'create']);
$router->post('/records/store', [RecordController::class, 'store']);

$router->post('/records/delete', [RecordController::class, 'delete']);

return $app;
