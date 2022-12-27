<?php

namespace Api\Models\Map;

use Api\Models\Registro;
use Api\Models\RegistroQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'registros' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RegistroTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Api.Models.Map.RegistroTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'registros';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Api\\Models\\Registro';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Api.Models.Registro';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'registros.id';

    /**
     * the column name for the paciente field
     */
    public const COL_PACIENTE = 'registros.paciente';

    /**
     * the column name for the procedimentos field
     */
    public const COL_PROCEDIMENTOS = 'registros.procedimentos';

    /**
     * the column name for the fisioterapeuta_id field
     */
    public const COL_FISIOTERAPEUTA_ID = 'registros.fisioterapeuta_id';

    /**
     * the column name for the paciente_id field
     */
    public const COL_PACIENTE_ID = 'registros.paciente_id';

    /**
     * the column name for the tipo_atendimento field
     */
    public const COL_TIPO_ATENDIMENTO = 'registros.tipo_atendimento';

    /**
     * the column name for the comparecimento field
     */
    public const COL_COMPARECIMENTO = 'registros.comparecimento';

    /**
     * the column name for the tipo_falta field
     */
    public const COL_TIPO_FALTA = 'registros.tipo_falta';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'registros.data';

    /**
     * the column name for the turno field
     */
    public const COL_TURNO = 'registros.turno';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Id', 'PacienteDeprecated', 'Procedimentos', 'FisioterapeutaId', 'PacienteId', 'TipoAtendimento', 'Comparecimento', 'TipoFalta', 'Data', 'Turno', ],
        self::TYPE_CAMELNAME     => ['id', 'pacienteDeprecated', 'procedimentos', 'fisioterapeutaId', 'pacienteId', 'tipoAtendimento', 'comparecimento', 'tipoFalta', 'data', 'turno', ],
        self::TYPE_COLNAME       => [RegistroTableMap::COL_ID, RegistroTableMap::COL_PACIENTE, RegistroTableMap::COL_PROCEDIMENTOS, RegistroTableMap::COL_FISIOTERAPEUTA_ID, RegistroTableMap::COL_PACIENTE_ID, RegistroTableMap::COL_TIPO_ATENDIMENTO, RegistroTableMap::COL_COMPARECIMENTO, RegistroTableMap::COL_TIPO_FALTA, RegistroTableMap::COL_DATA, RegistroTableMap::COL_TURNO, ],
        self::TYPE_FIELDNAME     => ['id', 'paciente', 'procedimentos', 'fisioterapeuta_id', 'paciente_id', 'tipo_atendimento', 'comparecimento', 'tipo_falta', 'data', 'turno', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Id' => 0, 'PacienteDeprecated' => 1, 'Procedimentos' => 2, 'FisioterapeutaId' => 3, 'PacienteId' => 4, 'TipoAtendimento' => 5, 'Comparecimento' => 6, 'TipoFalta' => 7, 'Data' => 8, 'Turno' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'pacienteDeprecated' => 1, 'procedimentos' => 2, 'fisioterapeutaId' => 3, 'pacienteId' => 4, 'tipoAtendimento' => 5, 'comparecimento' => 6, 'tipoFalta' => 7, 'data' => 8, 'turno' => 9, ],
        self::TYPE_COLNAME       => [RegistroTableMap::COL_ID => 0, RegistroTableMap::COL_PACIENTE => 1, RegistroTableMap::COL_PROCEDIMENTOS => 2, RegistroTableMap::COL_FISIOTERAPEUTA_ID => 3, RegistroTableMap::COL_PACIENTE_ID => 4, RegistroTableMap::COL_TIPO_ATENDIMENTO => 5, RegistroTableMap::COL_COMPARECIMENTO => 6, RegistroTableMap::COL_TIPO_FALTA => 7, RegistroTableMap::COL_DATA => 8, RegistroTableMap::COL_TURNO => 9, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'paciente' => 1, 'procedimentos' => 2, 'fisioterapeuta_id' => 3, 'paciente_id' => 4, 'tipo_atendimento' => 5, 'comparecimento' => 6, 'tipo_falta' => 7, 'data' => 8, 'turno' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Registro.Id' => 'ID',
        'id' => 'ID',
        'registro.id' => 'ID',
        'RegistroTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'registros.id' => 'ID',
        'PacienteDeprecated' => 'PACIENTE',
        'Registro.PacienteDeprecated' => 'PACIENTE',
        'pacienteDeprecated' => 'PACIENTE',
        'registro.pacienteDeprecated' => 'PACIENTE',
        'RegistroTableMap::COL_PACIENTE' => 'PACIENTE',
        'COL_PACIENTE' => 'PACIENTE',
        'paciente' => 'PACIENTE',
        'registros.paciente' => 'PACIENTE',
        'Procedimentos' => 'PROCEDIMENTOS',
        'Registro.Procedimentos' => 'PROCEDIMENTOS',
        'procedimentos' => 'PROCEDIMENTOS',
        'registro.procedimentos' => 'PROCEDIMENTOS',
        'RegistroTableMap::COL_PROCEDIMENTOS' => 'PROCEDIMENTOS',
        'COL_PROCEDIMENTOS' => 'PROCEDIMENTOS',
        'registros.procedimentos' => 'PROCEDIMENTOS',
        'FisioterapeutaId' => 'FISIOTERAPEUTA_ID',
        'Registro.FisioterapeutaId' => 'FISIOTERAPEUTA_ID',
        'fisioterapeutaId' => 'FISIOTERAPEUTA_ID',
        'registro.fisioterapeutaId' => 'FISIOTERAPEUTA_ID',
        'RegistroTableMap::COL_FISIOTERAPEUTA_ID' => 'FISIOTERAPEUTA_ID',
        'COL_FISIOTERAPEUTA_ID' => 'FISIOTERAPEUTA_ID',
        'fisioterapeuta_id' => 'FISIOTERAPEUTA_ID',
        'registros.fisioterapeuta_id' => 'FISIOTERAPEUTA_ID',
        'PacienteId' => 'PACIENTE_ID',
        'Registro.PacienteId' => 'PACIENTE_ID',
        'pacienteId' => 'PACIENTE_ID',
        'registro.pacienteId' => 'PACIENTE_ID',
        'RegistroTableMap::COL_PACIENTE_ID' => 'PACIENTE_ID',
        'COL_PACIENTE_ID' => 'PACIENTE_ID',
        'paciente_id' => 'PACIENTE_ID',
        'registros.paciente_id' => 'PACIENTE_ID',
        'TipoAtendimento' => 'TIPO_ATENDIMENTO',
        'Registro.TipoAtendimento' => 'TIPO_ATENDIMENTO',
        'tipoAtendimento' => 'TIPO_ATENDIMENTO',
        'registro.tipoAtendimento' => 'TIPO_ATENDIMENTO',
        'RegistroTableMap::COL_TIPO_ATENDIMENTO' => 'TIPO_ATENDIMENTO',
        'COL_TIPO_ATENDIMENTO' => 'TIPO_ATENDIMENTO',
        'tipo_atendimento' => 'TIPO_ATENDIMENTO',
        'registros.tipo_atendimento' => 'TIPO_ATENDIMENTO',
        'Comparecimento' => 'COMPARECIMENTO',
        'Registro.Comparecimento' => 'COMPARECIMENTO',
        'comparecimento' => 'COMPARECIMENTO',
        'registro.comparecimento' => 'COMPARECIMENTO',
        'RegistroTableMap::COL_COMPARECIMENTO' => 'COMPARECIMENTO',
        'COL_COMPARECIMENTO' => 'COMPARECIMENTO',
        'registros.comparecimento' => 'COMPARECIMENTO',
        'TipoFalta' => 'TIPO_FALTA',
        'Registro.TipoFalta' => 'TIPO_FALTA',
        'tipoFalta' => 'TIPO_FALTA',
        'registro.tipoFalta' => 'TIPO_FALTA',
        'RegistroTableMap::COL_TIPO_FALTA' => 'TIPO_FALTA',
        'COL_TIPO_FALTA' => 'TIPO_FALTA',
        'tipo_falta' => 'TIPO_FALTA',
        'registros.tipo_falta' => 'TIPO_FALTA',
        'Data' => 'DATA',
        'Registro.Data' => 'DATA',
        'data' => 'DATA',
        'registro.data' => 'DATA',
        'RegistroTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'registros.data' => 'DATA',
        'Turno' => 'TURNO',
        'Registro.Turno' => 'TURNO',
        'turno' => 'TURNO',
        'registro.turno' => 'TURNO',
        'RegistroTableMap::COL_TURNO' => 'TURNO',
        'COL_TURNO' => 'TURNO',
        'registros.turno' => 'TURNO',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('registros');
        $this->setPhpName('Registro');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Api\\Models\\Registro');
        $this->setPackage('Api.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('paciente', 'PacienteDeprecated', 'VARCHAR', false, 150, null);
        $this->addColumn('procedimentos', 'Procedimentos', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('fisioterapeuta_id', 'FisioterapeutaId', 'INTEGER', 'fisioterapeutas', 'id', false, null, null);
        $this->addForeignKey('paciente_id', 'PacienteId', 'INTEGER', 'pacientes', 'id', false, null, null);
        $this->addColumn('tipo_atendimento', 'TipoAtendimento', 'VARCHAR', false, 21, null);
        $this->addColumn('comparecimento', 'Comparecimento', 'VARCHAR', false, 3, null);
        $this->addColumn('tipo_falta', 'TipoFalta', 'VARCHAR', false, 40, null);
        $this->addColumn('data', 'Data', 'DATE', false, null, null);
        $this->addColumn('turno', 'Turno', 'VARCHAR', false, 5, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Fisioterapeuta', '\\Api\\Models\\Fisioterapeuta', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fisioterapeuta_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Paciente', '\\Api\\Models\\Paciente', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':paciente_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('RegistroProcedimento', '\\Api\\Models\\RegistroProcedimento', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':registro_id',
    1 => ':id',
  ),
), null, null, 'RegistroProcedimentos', false);
        $this->addRelation('Procedimento', '\\Api\\Models\\Procedimento', RelationMap::MANY_TO_MANY, array(), null, null, 'Procedimentos');
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? RegistroTableMap::CLASS_DEFAULT : RegistroTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Registro object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RegistroTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RegistroTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RegistroTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RegistroTableMap::OM_CLASS;
            /** @var Registro $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RegistroTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = RegistroTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RegistroTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Registro $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RegistroTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(RegistroTableMap::COL_ID);
            $criteria->addSelectColumn(RegistroTableMap::COL_PACIENTE);
            $criteria->addSelectColumn(RegistroTableMap::COL_PROCEDIMENTOS);
            $criteria->addSelectColumn(RegistroTableMap::COL_FISIOTERAPEUTA_ID);
            $criteria->addSelectColumn(RegistroTableMap::COL_PACIENTE_ID);
            $criteria->addSelectColumn(RegistroTableMap::COL_TIPO_ATENDIMENTO);
            $criteria->addSelectColumn(RegistroTableMap::COL_COMPARECIMENTO);
            $criteria->addSelectColumn(RegistroTableMap::COL_TIPO_FALTA);
            $criteria->addSelectColumn(RegistroTableMap::COL_DATA);
            $criteria->addSelectColumn(RegistroTableMap::COL_TURNO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.paciente');
            $criteria->addSelectColumn($alias . '.procedimentos');
            $criteria->addSelectColumn($alias . '.fisioterapeuta_id');
            $criteria->addSelectColumn($alias . '.paciente_id');
            $criteria->addSelectColumn($alias . '.tipo_atendimento');
            $criteria->addSelectColumn($alias . '.comparecimento');
            $criteria->addSelectColumn($alias . '.tipo_falta');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.turno');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(RegistroTableMap::COL_ID);
            $criteria->removeSelectColumn(RegistroTableMap::COL_PACIENTE);
            $criteria->removeSelectColumn(RegistroTableMap::COL_PROCEDIMENTOS);
            $criteria->removeSelectColumn(RegistroTableMap::COL_FISIOTERAPEUTA_ID);
            $criteria->removeSelectColumn(RegistroTableMap::COL_PACIENTE_ID);
            $criteria->removeSelectColumn(RegistroTableMap::COL_TIPO_ATENDIMENTO);
            $criteria->removeSelectColumn(RegistroTableMap::COL_COMPARECIMENTO);
            $criteria->removeSelectColumn(RegistroTableMap::COL_TIPO_FALTA);
            $criteria->removeSelectColumn(RegistroTableMap::COL_DATA);
            $criteria->removeSelectColumn(RegistroTableMap::COL_TURNO);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.paciente');
            $criteria->removeSelectColumn($alias . '.procedimentos');
            $criteria->removeSelectColumn($alias . '.fisioterapeuta_id');
            $criteria->removeSelectColumn($alias . '.paciente_id');
            $criteria->removeSelectColumn($alias . '.tipo_atendimento');
            $criteria->removeSelectColumn($alias . '.comparecimento');
            $criteria->removeSelectColumn($alias . '.tipo_falta');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.turno');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(RegistroTableMap::DATABASE_NAME)->getTable(RegistroTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Registro or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Registro object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Api\Models\Registro) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RegistroTableMap::DATABASE_NAME);
            $criteria->add(RegistroTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = RegistroQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RegistroTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RegistroTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the registros table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RegistroQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Registro or Criteria object.
     *
     * @param mixed $criteria Criteria or Registro object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Registro object
        }

        if ($criteria->containsKey(RegistroTableMap::COL_ID) && $criteria->keyContainsValue(RegistroTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RegistroTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = RegistroQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
