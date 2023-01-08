<?php

use Api\Models\PacienteQuery;
use Api\Models\ProcedimentoQuery;
use Api\Models\RegistroProcedimentoQuery;
use Api\Models\RegistroQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;

include_once __DIR__.'/imports.php';

$militares_sem_graduacao = PacienteQuery::create()->filterBySituacaoAdmistrativa(array('Militar da Ativa', 'Militar Inativo'))->filterByPostoGraduacao(array(null, ''))->find();

$atletas_sem_modalidade = PacienteQuery::create()->filterByAtleta(true)->filterByModalidade(array(null, ''))->find();

$registros_sem_turno = RegistroQuery::create()->filterByTurno(array(null, ''))->filterByData('2021-01-01', Criteria::GREATER_EQUAL)->find();

$faltas_sem_justificativa = RegistroQuery::create()->filterByComparecimento(false)->filterByTipoFalta(array(null, ''))->filterByData('2021-01-01', Criteria::GREATER_EQUAL)->find();

$comparecimentos_sem_procedimento = array();
$comparecimentos = RegistroQuery::create()->filterByComparecimento(true)->filterByData('2021-01-01', Criteria::GREATER_EQUAL)->find();
foreach ($comparecimentos as $comparecimento) {
    // Verifica se existe algum registro com o id dele
    if(RegistroProcedimentoQuery::create()->filterByRegistroId($comparecimento->getId())->count() <= 0){
        array_push($comparecimentos_sem_procedimento, $comparecimento);
    }
}

$procedimentos = ProcedimentoQuery::create()->find();

$pdo = Propel::getConnection();
$sql = "SELECT r1.paciente_id, r1.turno, r1.data, r1.comparecimento, r1.id FROM registros r1
INNER JOIN (SELECT *, COUNT(*) as count FROM registros GROUP BY paciente_id, turno, `data`, fisioterapeuta_id HAVING count > 1) r2
ON r1.data = r2.data AND r1.turno = r2.turno AND r1.paciente_id = r2.paciente_id AND r1.fisioterapeuta_id = r2.fisioterapeuta_id
WHERE r1.data >= '2022-01-01';";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
$duplicidades_registro = array();

foreach($resultset as $row){
  $registro = RegistroQuery::create()->findOneById($row['id']);
  array_push($duplicidades_registro, $registro);
}

// print_r($duplicidades_registro);

$template = $twig->load('inconsistencias.html');
echo $template->render([
    'militares_sem_graduacao' => $militares_sem_graduacao,
    'posto_graduacao_options' => [
    "AE", "VA", "CA", "CMG", "CF", "CC", "CT", "1T", "2T", "GM", "SO", "SG", "CB", "MN/SD"],
    'atletas_sem_modalidade' => $atletas_sem_modalidade,
    'registros_sem_turno' => $registros_sem_turno,
    'turnos_options' => ["Manhã", "Tarde"],
    'faltas_sem_justificativa' => $faltas_sem_justificativa,
    'comparecimentos_sem_procedimento' => $comparecimentos_sem_procedimento,
    'procedimentos' => $procedimentos,
    'duplicidades_registro' => $duplicidades_registro
]);
