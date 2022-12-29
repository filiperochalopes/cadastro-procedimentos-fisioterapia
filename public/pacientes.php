<?php

require ("functions.php");
require ("config-db.php");

include "php/func/login_check.php";

include "page/parts/head.php";
include "page/parts/header.php";
?>
<body>
    
    <?php
    include "page/parts/body.php";
    ?>
    
    <div class="page">
    <?php
    include "page/parts/aside.php";
    ?> 
    <main>
    <h1>ESTATÍSTICA DA FISIOTERAPIA DO CEFAN <span><i class="fas fa-user"></i> Pacientes</span></h1>
    <h3><i class="fas fa-trash-alt"></i> Clique para remover</h3>
    <table class="tablelist" id="table_pacientes">
        <tbody>
    <?php
    $pesquisapacientes = $mydb->query("SELECT * FROM pacientes ORDER BY nome ASC");
    while($row = $pesquisapacientes->fetch_assoc()){
        echo "<tr data-id=\"".$row["id"]."\"><td class=\"nome\">".$row["nome"]."</td><td><button class=\"options-bt del static\" data-del=\"".$row["id"]."\" data-confirm=\"".$row["nome"]."\"><i class=\"fas fa-trash-alt\"></i></button></td></tr>";
    }
    ?>
        </tbody>
    </table>
    </main>            
    </div>
    <?php
    include "page/parts/footer.php";
    ?>