<?php

include_once __DIR__.'/imports.php';

use Api\Models\FisioterapeutaQuery;

$fisioterapeutas_asc = FisioterapeutaQuery::create()->filterByDesabilitado(false)->orderByNome()->find();
$fisioterapeutas_disabled_asc = FisioterapeutaQuery::create()->filterByDesabilitado(true)->orderByNome()->find();

$template = $twig->load('fisioterapeutas.html');
echo $template->render([
    'fisioterapeutas_ativos' => $fisioterapeutas_asc,
    'fisioterapeutas_desabilitados' => $fisioterapeutas_disabled_asc,
]);
