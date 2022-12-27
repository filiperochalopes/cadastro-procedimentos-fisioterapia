<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/generated-conf/config.php';

use Api\Models\FisioterapeutasQuery;

echo "Teste";

$fisioterapeutas = FisioterapeutasQuery::create()->find();

foreach($fisioterapeutas as $fisioterapeuta){
    echo "{$fisioterapeuta->getFisioterapeuta()}<br/>";
}