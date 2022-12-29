<?php

require_once __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/env.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');


if($phpenv == 'PRODUCTION'){
    $twig = new \Twig\Environment($loader, [
        'cache' => __DIR__.'/../twigcache',
    ]);
}else{
    $twig = new \Twig\Environment($loader);
}


// echo $twig->render('index', ['name' => 'Fabien']);