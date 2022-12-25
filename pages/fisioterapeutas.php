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
    <h1>ESTATÍSTICA DA FISIOTERAPIA DO CEFAN <span><i class="fas fa-user-nurse"></i> FISIOTERAPEUTAS</span></h1>
    <section>
        <h3><i class="fas fa-plus-circle"></i> Novo fisioterapeuta</h3>
        <form>
            <label for="nome">Nome <span>*</span></label>
            <input type="text" id="nome" name="nome" placeholder="do fisioterapeuta" required/>
            <button type="submit" id="adicionar_fisioterapeuta">Adicionar</button>
        </form>
    </section>
    <h3><i class="fas fa-trash-alt"></i> Clique para remover</h3>
    <table class="tablelist" id="table_fisioterapeuta">
        <tbody>
    <?php
    $pesquisafisioterapeutas = $mydb->query("SELECT * FROM fisioterapeutas ORDER BY fisioterapeuta ASC");
    while($row = $pesquisafisioterapeutas->fetch_assoc()){
        echo "<tr data-id=\"".$row["id"]."\"><td class=\"nome\">".$row["fisioterapeuta"]."</td><td><button class=\"options-bt del static\" data-del=\"".$row["id"]."\" data-confirm=\"".$row["fisioterapeuta"]."\"><i class=\"fas fa-trash-alt\"></i></button></td></tr>";
    }
    ?>
        </tbody>
    </table>
    </main>            
    </div>
    <?php
    include "page/parts/footer.php";
    ?>