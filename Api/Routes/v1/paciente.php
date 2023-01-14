<?php

use Api\Models\PacienteQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/../../../config/env.php';

$app->get($baseUrlV1 . '/paciente', function (Request $request, Response $response) {

    $q = $request->getQueryParams()['q'];

    // Pesquisando por termo no banco de dados para mostrar dica em input de pacientes para fins de preenchimento automático
    $pacientes = PacienteQuery::create()->filterByNome("%{$q}%", Criteria::LIKE)->limit(5)->find();

    $data = [];

    foreach($pacientes as $paciente){
        array_push($data, json_decode($paciente->toJSON()));
    }

    $response->getBody()->write(json_encode($data));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});

$app->delete($baseUrlV1 . '/paciente/{id}', function (Request $request, Response $response, array $args) {

    $paciente = PacienteQuery::create()->findOneById($args['id']);
    $paciente->setDesabilitado(1);
    $paciente->save();

    $response->getBody()->write(json_encode(array(
        "mensagem" => "Paciente {$paciente->getNome()} desabilitado com sucesso. Atualize a página.",
        "class" => "green"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});

$app->put($baseUrlV1 . '/paciente/{id}', function (Request $request, Response $response, array $args) {
    // TODO Com mais urgência proteger endpoint
    
    // print_r($args['id']);
    
    $d = $request->getParsedBody();

    // print_r($d);

    PacienteQuery::create()->filterById($args['id'])->update([...$d]);

    $paciente = PacienteQuery::create()->findOneById($args['id']);
    
    $response->getBody()->write(json_encode(array(
        "mensagem" => "O paciente {$paciente->getNome()} foi atualizado com sucesso. Atualize a página.",
        "class" => "green"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});
