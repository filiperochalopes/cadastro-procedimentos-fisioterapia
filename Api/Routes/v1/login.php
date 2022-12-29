<?php

use Api\Models\UsuariosQuery;

require_once __DIR__ . '/../../../config/env.php';

$app->post($baseUrlV1 . '/login', function (Request $request, Response $response, array $args) {

    session_start();

    $usuario = $_POST["usuario"];
    $senhamd5 = md5($_POST["senha"]);

    $usuario = UsuariosQuery::create()->findOneByUsuario($usuario);

    if ($usuario) {

        if ($usuario->getSenha() == $senhamd5) {

            $_SESSION["id_usuario"] = $usuario->getId();
            $_SESSION["usuario"] = $usuario->getUsuario();

            $response
                ->withHeader('Location', '/')
                ->withStatus(302);
        } else {
            $response
                ->withHeader('Location', '/login?erro=Senha incorreta, por favor insira corretamente')
                ->withStatus(302);
        }
    } else {
        $response
            ->withHeader('Location', '/login?erro=Usuário não cadastrado')
            ->withStatus(302);
    }

    return $response;
});
