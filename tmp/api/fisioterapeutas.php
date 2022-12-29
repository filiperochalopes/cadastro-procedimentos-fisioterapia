<?php

require("../../config-db.php");

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

//
// POST
//

if($method == "POST"){

    $nome = $_POST["nome"];

    if($nome != ""){
        $pesquisanome = $mydb->query("SELECT * FROM fisioterapeutas WHERE fisioterapeuta = '$nome' ");
        if($pesquisanome->num_rows > 0){
            exit("{ 
                \"mensagem\" : \"fisioterapeuta já cadastrado!\", 
                \"class\" : \"red\" 
            }");
        }else{
            $sql = "INSERT INTO `fisioterapeutas` (
                `id`, 
                `fisioterapeuta`
            ) VALUES (
                NULL,  
                '$nome'
            );";

            $mydb->query($sql);
            $id = $mydb->insert_id;

            exit(json_encode(array(
                "mensagem" => "Fisioterapeuta cadastrado com sucesso",
                "class" => "green",
                "id" => $id
            )));
        }
    }else{
        exit(json_encode(array(
            "mensagem" => "Você precisa preencher com um nome",
            "class" => "red"
        )));
    }
}

//
// DELETE
//

if($method == "DELETE"){

    $data = array();
    parse_str(file_get_contents("php://input"), $data);
    // echo json_encode($data);

    $id =  $data["id"];
    // echo "{\"mensagem\" : \"$id\"}";

    $sql = "DELETE FROM fisioterapeutas WHERE id = $id";

    $mydb->query($sql);

    exit(json_encode(array(
        "mensagem" => "Fisioterapeuta removido",
        "class" => "red"
    )));
}


mysqli_close($mydb);

?>