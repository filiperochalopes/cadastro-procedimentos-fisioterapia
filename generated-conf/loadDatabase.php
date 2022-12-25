<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\Models\\Map\\FisioterapeutasTableMap',
    1 => '\\Models\\Map\\PacientesTableMap',
    2 => '\\Models\\Map\\ProcedimentosTableMap',
    3 => '\\Models\\Map\\RegistrosTableMap',
    4 => '\\Models\\Map\\TabelaTableMap',
    5 => '\\Models\\Map\\UsuariosTableMap',
  ),
));
