<?php

$dbhost = getenv('DB_HOST') ?: 'localhost';
$dbuser = getenv('DB_USER') ?: 'root';
$dbpass = getenv('DB_PASS') ?: 'Generaltech';
$dbname = getenv('DB_NAME') ?: 'fisioterapia';
$phpenv = getenv('PHP_ENV') ?: 'DEVELOPMENT';

$baseUrlV1 = '/api/v1';