<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('default', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle('default');
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=db;port=3306;dbname=fisiocefan',
  'user' => 'thiago',
  'password' => 'securePass',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$serviceContainer->setConnectionManager($manager);
$serviceContainer->setDefaultDatasource('default');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => '/var/log/propel.log',
  'level' => 300,
));
require_once __DIR__ . '/./loadDatabase.php';
