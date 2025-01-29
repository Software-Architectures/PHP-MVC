<?php

use App\Controllers\IndexController;
use App\Router;

require_once __DIR__.'/vendor/autoload.php';

$router = new Router();

$router->add('GET', '/', IndexController::class);

$router->dispatch();