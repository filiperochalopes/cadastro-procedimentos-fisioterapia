<?php

$dbhost = getenv('DB_HOST') ?: 'localhost';
$dbuser = getenv('DB_USER') ?: 'root';
$dbpass = getenv('DB_PASS') ?: 'Generaltech';
$dbname = getenv('DB_NAME') ?: 'fisioterapia';

use Opis\Database\Connection;
use Opis\ORM\EntityManager;

$connection = new Connection(
    'mysqlnd:host='.$dbhost.';dbname='.$dbname,
    $dbuser,
    $dbpass
);

$orm = new EntityManager($connection);
$connection->logQueries();