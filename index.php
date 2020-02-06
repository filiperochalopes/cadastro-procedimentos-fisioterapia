<?php

require ("functions.php");
require ("config-db.php");
require ("config-globals.php");

include "php/func/login_check.php";

include "php/struct/head.php";
include "php/struct/header.php";
?>
<body>
    
    <?php
    include "php/struct/body.php";
    ?>
    
    <div class="page">
    <?php
    include "php/struct/aside.php";
    ?> 
    <main>
    <h1>ESTATÍSTICA DA FISIOTERAPIA DO CEFAN <span><i class="fas fa-check-square"></i> FORMULÁRIO</span></h1>
    <form id="form_registro">

        <label for="fisioterapeuta">FISIOTERAPEUTA<span>*</span></label>
        <select id="fisioterapeuta" name="fisioterapeuta" required>
            <option value="" disabled selected>Profissional responsável pelo atendimento</option>
            <?=write_options_db("fisioterapeutas", "fisioterapeuta")?>
        </select>

        <label for="data">DATA <span>*</span></label>
        <input type="date" id="data" name="data" required/> <label for="data" class="inline side"><i class="far fa-calendar-alt"></i></label>

        <label for="tipoatendimento">TIPO DE ATENDIMENTO<span>*</span></label>
        <select id="tipoatendimento" name="tipoatendimento" required>
            <option value="" disabled selected>Selecione um tipo</option>
            <?=write_options(array(
                "Individual", "Grupo de Hidroterapia", "Pilates", "Grupo de Hidroterapia", "Grupo de Educação em Dor", "Grupo de Dor Lombar"
            ))?>
        </select>

        <label for="situacao_adm">SITUAÇÃO ADMINISTRATIVA<span>*</span></label>
        <select id="situacao_adm" name="situacao_adm" required>
            <option value="" disabled selected>Selecione uma situação</option>
            <?=write_options(array(
                "Militar da Ativa", "Militar Inativo", "Dependente Direto", "Dependente Indireto", "Pensionista", "Servidor Civil", "Não Cadastrado / Sem classificação"
            ))?>
        </select>

        <label for="posto_graduacao" class="condicional" data-condicional="posto_graduacao">POSTO/GRADUAÇÃO<span>*</span></label>
        <select id="posto_graduacao" name="posto_graduacao" class="condicional" data-condicional="posto_graduacao" required>
            <option value="" disabled selected>do paciente</option>
            <?=write_options(array(
                "AE", "VA", "CA", "CMG", "CF", "CC", "CT", "1T", "2T", "GM", "SO", "SG", "CB", "MN/SD"
            ))?>
        </select>                        
        
        <label for="nome_paciente">NOME COMPLETO DO PACIENTE <span>*</span></label>
        <input type="text" id="nome_paciente" name="nome_paciente" autocomplete="off" required/>
        <div class="hint" id="nome_paciente_hint" data-input-hint="nome_paciente">
            <ul>
            </ul>
        </div>

        <label for="nip_paciente" class="condicional" data-condicional="nip_paciente">NIP DO PACIENTE <span>*</span></label>
        <input type="number" id="nip_paciente" name="nip_paciente" class="condicional" data-condicional="nip_paciente" pattern="[0-9]{8}"/>

        <label for="nip_titular" data-condicional="nip_titular" class="condicional">NIP DO TITULAR <span>*</span></label>
        <input type="number" id="nip_titular" name="nip_titular" class="condicional" data-condicional="nip_titular" pattern="[0-9]{8}"/>

        <label for="cpf_titular" data-condicional="cpf_titular" class="condicional">CPF DO TITULAR <span>*</span></label>
        <input type="number" id="cpf_titular" name="cpf_titular" class="condicional" data-condicional="cpf_titular" pattern="[0-9]{11}"/>

        <label>ORIGEM <span>*</span></label>
        <?=write_radio("origem", array(
            ["origem_externo", "Externo"],
            ["origem_cefan", "CEFAN"]
        ))?>

        <label>PACIENTE COMPARECEU AO TRATAMENTO? <span>*</span></label>
        <?=write_radio("comparecimento", array(
            ["comparecimento_sim", "Sim"],
            ["comparecimento_nao", "Não"]
        ))?>

        <label for="tipo_falta" data-condicional="tipo_falta" class="condicional">TIPO DE FALTA<span>*</span></label>
        <select id="tipo_falta" name="tipo_falta" data-condicional="tipo_falta" class="condicional">
            <option value="" disabled selected>Selecione um tipo</option>
            <?=write_options(array(
                "Falta sem justificativa", "Desmarcação pelo profissional", "Desmarcação pelo paciente"
            ))?>
        </select>

        <label class="condicional" data-condicional="corpoquadro" >CORPO/QUADRO <span>*</span></label>
        <?=write_radio("corpoquadro", array(
            ["corpoquadro_cfn", "CFN"],
            ["corpoquadro_gola", "GOLA"]
        ), true)?>

        <label class="condicional" data-condicional="atleta" >ATLETA? <span>*</span></label>
        <?=write_radio("atleta", array(
            ["atleta_nao", "Não"],
            ["atleta_sim", "Sim"]
        ), true)?>

        <label for="modalidade" class="condicional" data-condicional="modalidade">MODALIDADE ESPORTIVA<span>*</span></label>
        <select id="modalidade" name="modalidade" class="condicional" data-condicional="modalidade" required>
            <option value="" disabled selected>Escolha uma opção</option>
            <?=write_options(array(
                "Futebol Feminino", "Levantamento de Peso", "Boxe", "Pentatlo Naval", "Atletismo", "Judô", "Taekwondo", "Luta Olímpica", "Outra"
            ))?>
        </select>

        <label for="outra_modalidade" class="condicional" data-condicional="outra_modalidade">Defina Outra: <span>*</span></label>
        <input type="text" id="outra_modalidade" name="outra_modalidade" class="condicional" data-condicional="outra_modalidade" required/>

        <?php
        for ($i = 1; $i <= 20; $i++) {
            $conditional = "class=\"condicional procedimento\" data-condicional=\"procedimento_$i\"";

            echo "
            <label for=\"procedimento_$i\" $conditional>PROCEDIMENTO $i<span>*</span></label>
            <select id=\"procedimento_$i\" name=\"procedimento_$i\" $conditional required>
                <option value=\"\" selected>Em branco</option>";
            write_options_db("procedimentos", "procedimento");
            echo "</select>";
        }
        ?>

        <button type="submit" id="adicionar_registro">Enviar</button>
       
    </form>
    </main> 
    <script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};handleClientLoad()"
    onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>           
    </div>
    <?php
    include "php/struct/footer.php";
    ?>