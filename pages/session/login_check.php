<?php

// header('Access-Control-Allow-Origin: *');  
// header('Content-Type: application/json');

session_start();

if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["usuario"])){ 
    // Usuário não logado! Redireciona para a página de login 
    header("Location: ".$login); 
    exit; 
}


?>