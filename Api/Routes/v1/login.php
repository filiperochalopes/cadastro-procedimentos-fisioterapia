<?php

use Api\Models\UsuariosQuery;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/../../../config/env.php';

$app->post($baseUrlV1 . '/login', function (Request $request, Response $response, array $args) {

    $usuario = $_POST["usuario"];
    $senhamd5 = md5($_POST["senha"]);

    $usuario = UsuariosQuery::create()->findOneByUsuario($usuario);

    if ($usuario) {

        if ($usuario->getSenha() == $senhamd5) {

            $_SESSION["id_usuario"] = $usuario->getId();
            $_SESSION["usuario"] = $usuario->getUsuario();

            $response->getBody()->write(json_encode([
                "msg" => "Sessão criada. Login Realizado com sucesso!"
            ]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        } else {
            return $response
                ->withHeader('Location', '/login?erro=' . urlencode('Senha incorreta, por favor insira corretamente'))
                ->withStatus(401);
        }
    } else {
        return $response
            ->withHeader('Location', '/login?erro=' . urlencode('Usuário não cadastrado'))
            ->withStatus(401);
    }
});
