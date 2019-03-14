<?php

require("../../config-db.php");
require("../../config-globals.php");
require("../../functions.php");

// header('Access-Control-Allow-Origin: *');  
// header('Content-Type: application/json');

session_start();

$usuario = $_POST["usuario"];
$senhamd5 = md5($_POST["senha"]);

$pesquisa_usuario = $mydb->query("SELECT * FROM usuarios WHERE `usuario` = '$usuario' ");

if($pesquisa_usuario->num_rows > 0){
    
    //checa senha
    while ($row = $pesquisa_usuario->fetch_assoc()) {
        if($row["senha"] == $senhamd5){
    
        $_SESSION["id_usuario"] = $row["id"];
        $_SESSION["usuario"] = $row["usuario"];
        header("Location: ".$home);
            
        }else{
            header("Location: ".$login."?erro=Senha incorreta, por favor insira corretamente");
        }
    }
    
}else{
    header("Location: ".$login."?erro=Usuário não cadastrado.");
}

mysqli_close($mydb);

?>