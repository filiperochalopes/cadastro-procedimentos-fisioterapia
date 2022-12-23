<?php

phpinfo();

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/database.php';
require __DIR__.'/../api/Models/Fisioterapeuta.php';

use \App\Fisioterapeuta;

$fisioterapeutas = $orm(Fisioterapeuta::class)->all();
echo $fisioterapeutas;