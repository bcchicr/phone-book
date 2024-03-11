<?php

use Bcchicr\StudentList\App\Application;
use Bcchicr\StudentList\Http\Router\Router;
use Bcchicr\StudentList\Http\Controllers\StartPageController;

$app = new Application();

$router = $app->get(Router::class);
// Routes
$router->get('/', [StartPageController::class, 'index']);

return $app;
