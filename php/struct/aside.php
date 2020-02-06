<?php
require_once("config-globals.php");
?>

<aside>
    <button class="rounded large" id="menu" ><i class="fas fa-bars"></i></button>
    <ul>
        <li class="link" data-link="<?=$domain?>"><button class="rounded large"><i class="fas fa-check-square"></i></button><span>Atendimento</span></li>
        <li class="link" data-link="pacientes"><button class="rounded large"><i class="fas fa-user"></i></button><span>Pacientes</span></li>
        <li class="link" data-link="fisioterapeutas"><button class="rounded large"><i class="fas fa-user-nurse"></i></button><span>Profissionais</span></li>
    </ul>
</aside>