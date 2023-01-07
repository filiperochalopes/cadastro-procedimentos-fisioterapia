<?php

include_once __DIR__.'/imports.php';

use Api\Models\PacienteQuery;

$pacientes_asc = PacienteQuery::create()->filterByDesabilitado(false)->orderByNome()->find();
$pacientes_disabled_asc = PacienteQuery::create()->filterByDesabilitado(true)->orderByNome()->find();

$template = $twig->load('pacientes.html');
echo $template->render([
    'pacientes_ativos' => $pacientes_asc,
    'pacientes_desabilitados' => $pacientes_disabled_asc,
]);
