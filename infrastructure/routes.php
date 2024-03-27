<?php
namespace Infrastructure;

use App\Http\Action;
use app\Http\Controllers\Api\CarroController;
use App\Router\StaticRouteGroup as Group;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

/**
 * @OA\Info(title="My First API aaaaaaaaaaaaaa", version="0.1")
 */
return function (App $app) {
    $app->group('/carros', new Group(static function (RouteCollectorProxy $group): void {
        $group->get('/lista', [CarroController::class, 'lista']);
    }));
};