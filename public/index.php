<?php

require '../vendor/autoload.php';

include '../app/Controllers/CarroController.php';

use App\Controllers\CarroController;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/lista', [CarroController::class, 'lista']);

$app->run();