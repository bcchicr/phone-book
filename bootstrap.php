<?php

use Bcchicr\StudentList\App\Application;
use Bcchicr\StudentList\Http\Router\Router;
use Bcchicr\StudentList\Http\Controllers\StartPageController;

$app = new Application(__DIR__);

// Routes
/**
 * @var Router
 */
$router = $app->get(Router::class);
$router->get('/', [StartPageController::class, 'index']);

return $app;
