<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/generated-conf/config.php';

use Api\Models\FisioterapeutaQuery;

echo "Teste";

$fisioterapeutas = FisioterapeutaQuery::create()->find();

foreach($fisioterapeutas as $fisioterapeuta){
    echo "{$fisioterapeuta->getFisioterapeuta()}<br/>";
}