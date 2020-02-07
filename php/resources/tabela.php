<?php

require("../../config-db.php");
require("../../functions.php");
// require("./pacientes.php");

header('Access-Control-Allow-Origin: *');  
// header('Content-Type: application/json');

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

    $data =  $data["json"];

    $date = $data["data"];
    $data["data"] = date("d/m/Y", strtotime($date));

    // print_r($data);

    $sql = "INSERT INTO `tabela` (
        `id`, 
        `data`,
        `turno`,
        `fisioterapeuta`, 
        `nome_paciente`, 
        `tipo_atendimento`, 
        `situacao_administrativa`, 
        `nip_paciente`, 
        `nip_titular`, 
        `cpf_titular`, 
        `origem`, 
        `corpo_quadro`, 
        `posto_graduacao`, 
        `atleta`, 
        `modalidade`, 
        `outra_modalidade`,
        `comparecimento`,
        `tipo_falta`,
        `procedimento_1`,
        `procedimento_2`,
        `procedimento_3`,
        `procedimento_4`,
        `procedimento_5`,
        `procedimento_6`,
        `procedimento_7`,
        `procedimento_8`,
        `procedimento_9`,
        `procedimento_10`,
        `procedimento_11`,
        `procedimento_12`,
        `procedimento_13`,
        `procedimento_14`,
        `procedimento_15`,
        `procedimento_16`,
        `procedimento_17`,
        `procedimento_18`,
        `procedimento_19`,
        `procedimento_20`,
        `total_procedimentos`
        ) VALUES (
            NULL, 
            '".$data["data"]."', 
            '".$data["turno"]."', 
            '".$data["fisioterapeuta"]."', 
            '".$data["nome_paciente"]."', 
            '".$data["tipo_atendimento"]."', 
            '".$data["situacao_adm"]."', 
            '".$data["nip_paciente"]."', 
            '".$data["nip_titular"]."', 
            '".$data["cpf_titular"]."', 
            '".$data["origem"]."', 
            '".$data["corpoquadro"]."', 
            '".$data["posto_graducao"]."', 
            '".$data["atleta"]."', 
            '".$data["modalidade"]."', 
            '".$data["outra_modalidade"]."',
            '".$data["comparecimento"]."',
            '".$data["tipo_falta"]."',
            '".$data["procedimento_1"]."',
            '".$data["procedimento_2"]."',
            '".$data["procedimento_3"]."',
            '".$data["procedimento_4"]."',
            '".$data["procedimento_5"]."',
            '".$data["procedimento_6"]."',
            '".$data["procedimento_7"]."',
            '".$data["procedimento_8"]."',
            '".$data["procedimento_9"]."',
            '".$data["procedimento_10"]."',
            '".$data["procedimento_11"]."',
            '".$data["procedimento_12"]."',
            '".$data["procedimento_13"]."',
            '".$data["procedimento_14"]."',
            '".$data["procedimento_15"]."',
            '".$data["procedimento_16"]."',
            '".$data["procedimento_17"]."',
            '".$data["procedimento_18"]."',
            '".$data["procedimento_19"]."',
            '".$data["procedimento_20"]."',
            '".$data["total_procedimentos"]."'
        )";

    // echo $sql;

    $mydb->query($sql);

    exit(json_encode(array(
        "mensagem" => "Dados adicionados",
        "class" => "green"
    )));
}


mysqli_close($mydb);

?>