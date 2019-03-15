<?php

require("../../config-db.php");
require("../../functions.php");
// require("./pacientes.php");

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json');

error_reporting(E_ALL ^ E_NOTICE);

$method = $_SERVER['REQUEST_METHOD'];

// Na verdade é uma mistura de REGISTROS, quando adicionado algum registro ele tem que verificar se
// - Procedimentos já existe hoje com essa mesma pessoa
// - Paciente já existe, senão cadastrar
// - Enviar 

//
// POST
//

// echo "{\"mensagem\" : \"$method\"}";

if($method == "POST"){
    
    $data = array();
    parse_str(file_get_contents("php://input"), $data);

    $paciente =  $data["nome_paciente"];
    $procedimentos = array();
    // $date = date("Y-m-d");
    $date = $data["data"];

    for($i = 1; $i <= 20; $i++){
        if($data["procedimento_".$i]){
            array_push($procedimentos, $data["procedimento_".$i]);
        }
    }

    // $array1 = ["oi", "ola"];
    // $array2 = ["ola", "oi"];
    // var_dump((bool) $array1==$array2);

    $pesquisaregistros = $mydb->query("SELECT * FROM registros WHERE data = '$date' ");
    if($pesquisaregistros->num_rows){
        //Verifica se existe algum com mesma pessoa, depoi o mais demorado que são a verificação de procedimentos
        while($row = $pesquisaregistros->fetch_assoc()){
            if($paciente == $row["paciente"]){
                $procedimentos_paciente = json_decode($row["procedimentos"]);
                if(!array_diff($procedimentos, $procedimentos_paciente)){
                    exit("{ 
                        \"mensagem\" : \"Procedimentos já cadastrados hoje para esse paciente\", 
                        \"class\" : \"red\" 
                    }");
                }
            }
        }
    }

    //Cadastro procedimento na lista de já realizados
    $sql = "INSERT INTO `registros` (
        `id`, 
        `paciente`, 
        `procedimentos`, 
        `data`
        ) VALUES (
            NULL,
            '$paciente',
            '".json_encode($procedimentos)."',
            '$date'
        )";

        // echo $sql;

    $mydb->query($sql);

    $pesquisapaciente = $mydb->query("SELECT * FROM pacientes WHERE nome = '$paciente' ");
    if(!$pesquisapaciente->num_rows){
        //Cadastra paciente

        $nip_paciente = $data["nip_paciente"] ? $data["nip_paciente"] : 0;
        $nip_titular = $data["nip_titular"] ? $data["nip_titular"] : 0;
        $cpf_titular = $data["cpf_titular"] ? $data["cpf_titular"] : 0;

        $sql = "INSERT INTO `pacientes` (
            `id`, 
            `nome`, 
            `situacao_adm`, 
            `posto_graduacao`, 
            `nip_paciente`, 
            `nip_titular`, 
            `cpf_titular`, 
            `origem`, 
            `corpoquadro`, 
            `atleta`, 
            `modalidade`, 
            `outra_modalidade`
            ) VALUES (
                NULL, 
                '$paciente', 
                '".$data["situacao_adm"]."', 
                '".$data["posto_graduacao"]."', 
                '$nip_paciente', 
                '$nip_titular', 
                '$cpf_titular',
                '".$data["origem"]."', 
                '".$data["corpoquadro"]."', 
                '".$data["atleta"]."', 
                '".$data["modalidade"]."', 
                '".$data["outra_modalidade"]."'
            )";
        
        $mydb->query($sql);
    }

    echo json_encode($data);

    //Adicionar na planilha do GOOGLE
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