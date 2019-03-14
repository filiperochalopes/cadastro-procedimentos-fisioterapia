<?php

require ("functions.php");
require ("config-db.php");

include "php/struct/head.php";
?>
<body>
    
    <?php
    include "php/struct/body.php";

    if(isset($_GET["erro"])){
        $erro = $_GET["erro"];
    }else{
        $erro = "";
    }

    ?>
    
    <div class="page">
    <main class="login">
    <h1>LOGIN <span>VOCÊ PRECISA ESTAR LOGADO PARA PODER ACESSAR O FORMULÁRIO</span></h1>
    <form id="form_registro" method="post" action="php/func/login.php">

        <label for="usuario">LOGIN<span>*</span></label>
        <input type="text" id="usuario" name="usuario" autocomplete="off" required/>

        <label for="senha">SENHA<span>*</span></label>
        <input type="password" id="senha" name="senha" autocomplete="off" required/>

        <span class="red"><?=$erro?></span>

        <button type="submit" id="login_entrar">Entrar</button>
       
    </form>
    <footer>
        <p>Desenvolvido por <a target="_blank" href="https://filipelopes.me">Filipe Lopes</a> &copy; 2019</p>
    </footer>
    </main>           
    </div>