<?php

include_once __DIR__.'/imports.php';

$template = $twig->load('inconsistencias.html');
echo $template->render();
