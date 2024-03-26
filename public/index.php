<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

/**
 * @OA\Info(title="API Locação", version="0.1")
 */


/**
 * @SWG\Get(
 *     path="/carros",
 *     summary="Lista todos os carros",
 *     @SWG\Response(response=200, description="Sucesso")
 * )
 */
$app->get('/carros', function (Request $request, Response $response, $args) {
    return $response;
});

$app->run();