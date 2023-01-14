<?php

use Api\Models\Fisioterapeuta;
use Api\Models\FisioterapeutaQuery;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/../../../config/env.php';

$app->post($baseUrlV1 . '/fisioterapeuta', function (Request $request, Response $response) {

    $body = $request->getParsedBody();
    $fisioterapeuta = new Fisioterapeuta();
    $fisioterapeuta->setNome($body['nome']);
    $fisioterapeuta->save();

    $response->getBody()->write(json_encode(array(
        "mensagem" => "Fisioterapeuta {$fisioterapeuta->getNome()} criado com sucesso.",
        "class" => "green"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});

$app->delete($baseUrlV1 . '/fisioterapeuta/{id}', function (Request $request, Response $response, array $args) {

    $fisioterapeuta = FisioterapeutaQuery::create()->findOneById($args['id']);
    $fisioterapeuta->setDesabilitado(1);
    $fisioterapeuta->save();

    $response->getBody()->write(json_encode(array(
        "mensagem" => "Fisioterapeuta {$fisioterapeuta->getNome()} desabilitado com sucesso. Atualize a página.",
        "class" => "green"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});

$app->put($baseUrlV1 . '/fisioterapeuta/{id}', function (Request $request, Response $response, array $args) {

    $fisioterapeuta = FisioterapeutaQuery::create()->findOneById($args['id']);
    $fisioterapeuta->setDesabilitado(0);
    $fisioterapeuta->save();

    $response->getBody()->write(json_encode(array(
        "mensagem" => "O fisioterapeuta {$fisioterapeuta->getNome()} foi recuperado com sucesso. Atualize a página.",
        "class" => "green"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});
