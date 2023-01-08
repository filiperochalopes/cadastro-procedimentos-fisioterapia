<?php

include_once __DIR__.'/imports.php';

$json = file_get_contents('versions.json');
$json = str_replace("\\n", "<br/>", $json);
$data = json_decode($json);

$template = $twig->load('versao.html');
echo $template->render(['versions' => $data]);
