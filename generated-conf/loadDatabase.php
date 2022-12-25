<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\Api\\Models\\Map\\FisioterapeutasTableMap',
    1 => '\\Api\\Models\\Map\\PacientesTableMap',
    2 => '\\Api\\Models\\Map\\ProcedimentosTableMap',
    3 => '\\Api\\Models\\Map\\RegistrosTableMap',
    4 => '\\Api\\Models\\Map\\TabelaTableMap',
    5 => '\\Api\\Models\\Map\\UsuariosTableMap',
  ),
));
