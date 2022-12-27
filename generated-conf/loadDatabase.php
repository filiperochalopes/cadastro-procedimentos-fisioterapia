<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\Api\\Models\\Map\\FisioterapeutaTableMap',
    1 => '\\Api\\Models\\Map\\PacienteTableMap',
    2 => '\\Api\\Models\\Map\\ProcedimentoTableMap',
    3 => '\\Api\\Models\\Map\\RegistroProcedimentoTableMap',
    4 => '\\Api\\Models\\Map\\RegistroTableMap',
    5 => '\\Api\\Models\\Map\\TabelaTableMap',
    6 => '\\Api\\Models\\Map\\UsuariosTableMap',
  ),
));
