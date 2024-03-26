<?php
use App\Http\Action;
use App\Router\StaticRouteGroup as Group;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/carros', new Group(static function (RouteCollectorProxy $group): void {
        $group->get('/lista', Action\Carros\ListaCarros::class);
    }));
};