<?php

require("../../config-db.php");

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];


//
// GET
//

if($method == "GET"){

    $nome =  $_GET["nome"];

    $sql = "SELECT * FROM pacientes WHERE nome LIKE '%$nome%' ORDER BY nome ASC LIMIT 5";

    $pesquisapacientes = $mydb->query($sql);

    $array = array();

    while ($row = $pesquisapacientes->fetch_assoc()) {
        array_push($array, $row);
    }

    exit(json_encode($array));
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

    $sql = "DELETE FROM pacientes WHERE id = $id";

    $mydb->query($sql);

    exit(json_encode(array(
        "mensagem" => "Paciente removido",
        "class" => "red"
    )));
}


mysqli_close($mydb);

?>