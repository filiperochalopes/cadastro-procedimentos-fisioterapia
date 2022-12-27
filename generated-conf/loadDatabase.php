<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\Models\\Map\\FisioterapeutaTableMap',
    1 => '\\Models\\Map\\PacienteTableMap',
    2 => '\\Models\\Map\\ProcedimentoTableMap',
    3 => '\\Models\\Map\\RegistroProcedimentoTableMap',
    4 => '\\Models\\Map\\RegistroTableMap',
    5 => '\\Models\\Map\\TabelaTableMap',
    6 => '\\Models\\Map\\UsuariosTableMap',
  ),
));
