<?php

// require('models/perfil.php');
// require('models/guia.php');
require_once('config-db.php');

function get_convenio($id) {
    global $mydb;

    if($id != NULL){
        $pesquisaconvenios = $mydb->query("SELECT * FROM convenios WHERE id = ".$id);

        if($pesquisaconvenios->num_rows > 0){
            while ($row = $pesquisaconvenios->fetch_assoc()) {
                return $row["convenio"];
            }
        }else{
            return null;
        }
    }else{
        return null;
    }
}

function get_object_perfil($id) { //idusuario
    global $mydb;

    if($id != NULL){
        $pesquisainfo = $mydb->query("SELECT * FROM perfis WHERE usuario = ".$id);

        if($pesquisainfo->num_rows > 0){
            while ($row = $pesquisainfo->fetch_assoc()) {
                return new Perfil(
                    $row["id"],
                    $row["usuario"],
                    $row["nome"],
                    $row["funcao"],
                    $row["cpf"],
                    $row["email"],
                    $row["celular"],
                    $row["cep"],
                    $row["rua"],
                    $row["numero"],
                    $row["complemento"],
                    $row["bairro"],
                    $row["cidade"],
                    $row["estado"],
                    $row["cro"],
                    $row["especialidade"]
                );
            }
        }else{
            return null;
        }
    }else{
        return null;
    }
}

function checkPaciente($nome) {
    global $mydb;

    $pesquisapaciente = $mydb->query("SELECT * FROM pacientes WHERE nome = '$nome' ");
    return $pesquisapaciente->num_rows > 0;
}

function isFuncao($id, $funcao) {
    global $mydb;

    $pesquisaperfil = $mydb->query("SELECT * FROM perfis WHERE usuario = $id ");

    while($row = $pesquisaperfil->fetch_assoc()){
        return $row["funcao"] == $funcao;
    }
}

function num_clientes($especialidade) {
    global $mydb;

    $pesquisaclientes = $mydb->query("SELECT * FROM especialidades WHERE id = $especialidade");

    return $pesquisaclientes->num_rows;
}

/**
 * Renderiza de forma mais prática options dentro de um select
 * 
 * @param Array $array Lista de strings nomes que são apresentados nas opções
 * 
 * @return Void Renderiza Options de Select
 */
function write_options($array){
    array_map(function($item){
        echo "<option value=\"$item\">$item</option>";
    }, $array);
}


// ! Deprecated Deve ser trocada por write_options
function write_options_db($table, $col){
    global $mydb;
    
    $query = $mydb->query("SELECT * FROM $table ORDER BY $col ASC");
    while($row = $query->fetch_assoc()){
        echo "<option value='".$row[$col]."'>".$row[$col]."</option>";
    }
}

/**
 * Escreve a um input radio
 * 
 * @param String $name Name do elemento html, lembrando que têm que ser iguais para que só possa selecoinar um checkbox
 * @param Array $array Blocos de conteeúdo com id e label
 * @param String $conditional Adicionada a funcinoalidade de ser um radio condicional
 * 
 * @return String HTML Component
 */
function write_radio($name, $array, $conditional=false){

    $func = function($item) use ($name, $conditional){

        $conditional = $conditional ? "class=\"condicional\" data-condicional=\"$name\"" : null;

        echo "<div>";
        echo "<input type=\"radio\" name=\"$name\" id=\"$item[0]\" value=\"$item[1]\" $conditional /><label for=\"$item[0]\" $conditional >$item[1]</label>";
        echo "</div>";
    };

    array_map($func, $array);
    echo "<span class=\"clear\"></span>";
}

/**
 * Função com finalidade de realizar debug
 * 
 * @param String JSON decoded string
 */
function console_log($data){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}