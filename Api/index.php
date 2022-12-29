<?php

session_start();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../generated-conf/config.php';
require_once __DIR__ . '/../config/env.php';

$app = AppFactory::create();

$app->get($baseUrlV1.'/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

require __DIR__.'/./Routes/v1/index.php';

$app->run();