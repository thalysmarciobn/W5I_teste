<?php
namespace Infrastructure;

use app\Http\Controllers\Api\CarroController;
use App\Http\Controllers\Api\CategoriaController;
use App\Router\StaticRouteGroup as Group;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->group('/categorias', function (RouteCollectorProxy $group) {
            $group->get('/lista', [CategoriaController::class, 'lista']);
            $group->delete('/remover', [CategoriaController::class, 'remover']);
        });

        $group->group('/carros', function (RouteCollectorProxy $group) {
            $group->get('/lista', [CarroController::class, 'lista']);
            $group->get('/modelos', [CarroController::class, 'modelos']);
        });
    });

    $app->get('/swagger', function ($request, $response) use ($app) {
        $swaggerJson = file_get_contents(__DIR__ . '/swagger.json');

        $response->getBody()->write($swaggerJson);

        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->options('/{routes:.+}', function ($request, $response) {
        return $response;
    });
};