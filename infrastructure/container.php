<?php
namespace Infrastructure;

use DI\ContainerBuilder;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . '/Entity'),
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'port' => '3306',
    'dbname' => 'locacao',
    'user' => 'root',
    'password' => '123tha123'
], $config);


$entityManagerFactory = new EntityManager($connection, $config);

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    EntityManager::class => $entityManagerFactory
]);

return $containerBuilder->build();