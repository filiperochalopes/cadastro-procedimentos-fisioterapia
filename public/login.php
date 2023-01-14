<?php

include_once __DIR__.'/imports.php';

if (isset($_GET["erro"])) {
    $error = $_GET["erro"];
} else {
    $error = "";
}

$template = $twig->load('login.html');
echo $template->render(['error' => $error]);
