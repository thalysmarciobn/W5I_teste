<?php
namespace Infrastructure;

use Slim\App;

return static function (App $app): void {
    $app->add(function ($request, $handler) use ($app) {
        $response = $handler->handle($request);

        $response = $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    });
};