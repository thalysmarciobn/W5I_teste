<?php

require_once '../vendor/autoload.php';

$container = require __DIR__ . '/../app/container.php';

$app = (require __DIR__ . '/../infrastructure/app.php')($container);
$app->run();