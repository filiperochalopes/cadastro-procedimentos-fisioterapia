<?php

session_start();

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/../generated-conf/config.php';
require __DIR__.'/../config/env.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');

if($phpenv == 'PRODUCTION'){
    $twig = new \Twig\Environment($loader, [
        'cache' => __DIR__.'/../twigcache',
    ]);
}else{
    $twig = new \Twig\Environment($loader);
}

// Verifica se está logado, senão retorna para página de login

if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["usuario"])){ 
    // Usuário não logado! Redireciona para a página de login 
    $template = $twig->load('login.html');
    echo $template->render();
}