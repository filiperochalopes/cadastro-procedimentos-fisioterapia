<?php

include_once __DIR__ . '/imports.php';

use Api\Models\FisioterapeutaQuery;
use Api\Models\ProcedimentoQuery;

$fisioterapeutas = FisioterapeutaQuery::create()->findByDesabilitado(0);
$procedimentos = ProcedimentoQuery::create()->find();

$template = $twig->load('index.html');
echo $template->render([
    'fisioterapeutas' => $fisioterapeutas,
    'procedimentos' => $procedimentos,
    'turno_inputs' => [
        [
            'name' => 'turno',
            'id' => 'manha',
            'label' => 'Manhã',
        ],
        [
            'name' => 'turno',
            'id' => 'tarde',
            'label' => 'Tarde',
        ],
    ],
    'tipo_atendimento_options' => [
        "Individual", "Grupo"
    ],
    'situacao_administ_options' => [
        "Militar da Ativa", "Militar Inativo", "Dependente", "Pensionista", "Servidor Civil", "Não Cadastrado / Sem classificação"
    ],
    'posto_graduacao_options' => [
        "AE", "VA", "CA", "CMG", "CF", "CC", "CT", "1T", "2T", "GM", "SO", "SG", "CB", "MN/SD"
    ],
    'origem_inputs' => [
        [
            'name' => 'origem',
            'id' => 'origem_externo',
            'label' => 'Externo',
        ],
        [
            'name' => 'origem',
            'id' => 'origem_cefan',
            'label' => 'CEFAN',
        ],
    ],
    'comparecimento_inputs' => [
        [
            'name' => 'comparecimento',
            'id' => 'comparecimento_sim',
            'label' => 'Sim',
            'value' => 1,
        ],
        [
            'name' => 'comparecimento',
            'id' => 'comparecimento_nao',
            'label' => 'Não',
            'value' => '0'
        ],
    ],
    'tipo_falta_options' => [
        "Falta sem justificativa", "Desmarcação pelo profissional", "Desmarcação pelo paciente"
    ],
    'corpo_quadro_inputs' => [
        [
            'name' => 'corpoquadro',
            'id' => 'corpoquadro_cfn',
            'label' => 'CFN',
        ],
        [
            'name' => 'corpoquadro',
            'id' => 'corpoquadro_gola',
            'label' => 'GOLA',
        ],
    ],
    'atleta_inputs' => [
        [
            'name' => 'atleta',
            'id' => 'atleta_nao',
            'label' => 'Não',
            'value' => '0'
        ],
        [
            'name' => 'atleta',
            'id' => 'atleta_sim',
            'label' => 'Sim',
            'value' => 1,
        ],
    ],
    'atleta_modalidade_options' => [
        "Futebol Feminino", "Levantamento de Peso", "Boxe", "Pentatlo Naval", "Atletismo", "Judô", "Taekwondo", "Luta Olímpica", "Outra"
    ]
]);