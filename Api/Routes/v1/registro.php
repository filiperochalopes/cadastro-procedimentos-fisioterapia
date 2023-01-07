<?php

use Api\Models\Registro;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/../../../config/env.php';

$app->post($baseUrlV1 . '/registro', function (Request $request, Response $response, array $args) {

    print_r($request->getParsedBody());
    print_r($args);

    $data = array('name' => 'Rob', 'age' => 40);
    $payload = json_encode($data);

    $response->getBody()->write($payload);
    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});
