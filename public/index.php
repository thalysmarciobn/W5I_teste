<?php
use Doctrine\ORM\EntityManager;

require_once '../vendor/autoload.php';

$container = require __DIR__ . '/../infrastructure/container.php';

$app = (require __DIR__ . '/../app/Bootstrap.php')($container);

$container = $app->getContainer();
$entityManager = $container->get(EntityManager::class);

$app->run();