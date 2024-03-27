<?php
namespace Infrastructure;

use app\Http\Controllers\Api\CarroController;
use App\Router\StaticRouteGroup as Group;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->group('/carros', function (RouteCollectorProxy $group) {
            $group->get('/lista', [CarroController::class, 'lista']);
        });
    });

    $app->get('/swagger', function ($request, $response) use ($app) {
        $swaggerJson = file_get_contents(__DIR__ . '/swagger.json');

        $response->getBody()->write($swaggerJson);

        return $response->withHeader('Content-Type', 'application/json');
    });
};