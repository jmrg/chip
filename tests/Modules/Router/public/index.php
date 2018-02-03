<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Chip\Modules\Router\RouterConfig;

try {
    $config = (new RouterConfig())
        ->setNamespace("\\Test\\Controller")
        ->attachRouterFiles([
            realpath(__DIR__ . '/../endpoints/api.php'),
            realpath(__DIR__ . '/../endpoints/web.php')
        ]);
} catch (Exception $e) {
    die ("Error: " . $e->getMessage());
}

$r = \Chip\Modules\Router\Router::up($config);
$r->dispatch();
