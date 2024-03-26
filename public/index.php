<?php

require_once '../vendor/autoload.php';
require_once '../app/Bootstrap.php';

use App\Controllers\CarroController;
use Slim\Factory\AppFactory;






$app = AppFactory::create();

$app->get('/lista', [CarroController::class, 'lista']);

$app->run();