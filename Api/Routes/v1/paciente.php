<?php

use Api\Models\PacienteQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/../../../config/env.php';

$app->get($baseUrlV1 . '/paciente', function (Request $request, Response $response, array $args) {

    $q = $request->getQueryParams()['q'];

    // Pesquisando por termo no banco de dados para mostrar dica em input de pacientes para fins de preenchimento automático
    $pacientes = PacienteQuery::create()->filterByNome("%{$q}%", Criteria::LIKE)->limit(5)->find();

    $data = [];

    foreach($pacientes as $paciente){
        array_push($data, [
            "id" => $paciente->getId(),
            "nome" => $paciente->getNome()
        ]);
    }

    $payload = json_encode($data);

    $response->getBody()->write($payload);

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});

$app->delete($baseUrlV1 . '/paciente/:id', function (Request $request, Response $response, int $id) {

    $response->getBody()->write(json_encode(array(
        "mensagem" => "Um paciente não pode ser excluído. Id {$id}",
        "class" => "red"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});
