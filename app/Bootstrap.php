<?php
namespace App;

use OpenApi\Generator;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

Generator::scan([__DIR__ . '/../app/Http/Controllers']);

return static function (ContainerInterface $container): App {
    $app = AppFactory::createFromContainer($container);
    (require __DIR__ . '/../infrastructure/middleware.php')($app);
    (require __DIR__ . '/../infrastructure/routes.php')($app);
    return $app;
};