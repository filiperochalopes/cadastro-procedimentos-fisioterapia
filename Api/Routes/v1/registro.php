<?php

use Api\Models\Paciente;
use Api\Models\PacienteQuery;
use Api\Models\ProcedimentoQuery;
use Api\Models\Registro;
use Api\Models\RegistroQuery;
use Propel\Runtime\Propel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/../../../config/env.php';

$app->post($baseUrlV1 . '/registro', function (Request $request, Response $response) {
    
    $d = $request->getParsedBody();
    
    $registro = new Registro();
    $registro->setData($d['data']);
    $registro->setTurno($d['turno']);
    $registro->setFisioterapeutaId($d['fisioterapeuta']);
    $registro->setComparecimento($d['comparecimento']);
    $registro->setTipoAtendimento($d['tipo_atendimento']);
    $registro->setTipoFalta(isset($d['tipo_falta']) ? $d['tipo_falta'] : null);
    
    // Lidando com paciente
    $paciente = PacienteQuery::create()->findOneByNome($d['nome_paciente']);

    if(!$paciente){
        // Cria novo paciente
        $paciente = new Paciente();
        $paciente->setSituacaoAdmistrativa(isset($d['situacao_adm']) ? $d['situacao_adm'] : null);
        $paciente->setPostoGraduacao(isset($d['posto_graduacao']) ? $d['posto_graduacao'] : null);
        $paciente->setNome(isset($d['nome_paciente']) ? $d['nome_paciente'] : null);
        $paciente->setNip(isset($d['nip_paciente']) ? $d['nip_paciente'] : null);
        $paciente->setNipTitular(isset($d['nip_titular']) ? $d['nip_titular'] : null);
        $paciente->setCpfTitular(isset($d['cpf_titular']) ? $d['cpf_titular'] : null);
        $paciente->setOrigem(isset($d['origem']) ? $d['origem'] : null);
        $paciente->setAtleta(isset($d['atleta']) ? $d['atleta'] : null);
        $paciente->setModalidade(isset($d['modalidade']) ? $d['modalidade'] : null);
        $paciente->setOutraModalidade(isset($d['outra_modalidade']) ? $d['outra_modalidade'] : null);
        $paciente->setCorpoQuadro(isset($d['corpoquadro']) ? $d['corpoquadro'] : null);
        $paciente->save();
    }
    $registro->setPacienteId($paciente->getId());
    
    // TODO Edição de Paciente

    // Lidando com procedimentos
    if(!empty($d['procedimentos'])){
        foreach($d['procedimentos'] as $nome_procedimento){
            if($nome_procedimento){
                $procedimento = ProcedimentoQuery::create()->findOneByNome($nome_procedimento);
                $registro->addProcedimento($procedimento);
            }
        }
    }

    // Salvando alterações
    $registro->save();
    
    $response->getBody()->write(json_encode(array(
        "mensagem" => "Registro cadastrado com sucesso!",
        "class" => "green"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});


$app->put($baseUrlV1 . '/registro/{id}', function (Request $request, Response $response, array $args) {
    // TODO Com mais urgência proteger endpoint
    
    // print_r($args['id']);
    
    $d = $request->getParsedBody();

    // print_r($d);

    // Lidando com procedimentos
    if(isset($d['Procedimentos']) and !empty($d['Procedimentos'])){
        $registro = RegistroQuery::create()->findOneById($args['id']);

        foreach($d['Procedimentos'] as $nome_procedimento){
            if($nome_procedimento){
                $procedimento = ProcedimentoQuery::create()->findOneByNome($nome_procedimento);
                $registro->addProcedimento($procedimento);
            }
        }

        $registro->save();
    }

    unset($d['Procedimentos']);

    RegistroQuery::create()->filterById($args['id'])->update([...$d]);

    $registro = RegistroQuery::create()->findOneById($args['id']);
    
    $response->getBody()->write(json_encode(array(
        "mensagem" => "O registro {$registro->getId()} foi atualizado com sucesso. Atualize a página.",
        "class" => "green"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});

$app->delete($baseUrlV1 . '/registro/{id}', function (Request $request, Response $response, array $args) {
    
    // print($args['id']);

    $pdo = Propel::getConnection();
    $sql = "DELETE FROM registro_procedimento WHERE registro_id=?;
    DELETE FROM registros WHERE id=?;";
    $pdo->prepare($sql)->execute([$args['id'],$args['id']]);

    $response->getBody()->write(json_encode(array(
        "mensagem" => "O registro {$args['id']} removido com sucesso. Atualize a página.",
        "class" => "green"
    )));

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});
