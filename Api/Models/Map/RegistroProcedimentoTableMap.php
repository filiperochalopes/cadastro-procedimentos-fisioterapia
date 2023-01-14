<?php

namespace Api\Models\Map;

use Api\Models\RegistroProcedimento;
use Api\Models\RegistroProcedimentoQuery;
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
 * This class defines the structure of the 'registro_procedimento' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RegistroProcedimentoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Api.Models.Map.RegistroProcedimentoTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'registro_procedimento';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Api\\Models\\RegistroProcedimento';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Api.Models.RegistroProcedimento';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 2;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 2;

    /**
     * the column name for the registro_id field
     */
    public const COL_REGISTRO_ID = 'registro_procedimento.registro_id';

    /**
     * the column name for the procedimento_id field
     */
    public const COL_PROCEDIMENTO_ID = 'registro_procedimento.procedimento_id';

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
        self::TYPE_PHPNAME       => ['RegistroId', 'ProcedimentoId', ],
        self::TYPE_CAMELNAME     => ['registroId', 'procedimentoId', ],
        self::TYPE_COLNAME       => [RegistroProcedimentoTableMap::COL_REGISTRO_ID, RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, ],
        self::TYPE_FIELDNAME     => ['registro_id', 'procedimento_id', ],
        self::TYPE_NUM           => [0, 1, ]
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
        self::TYPE_PHPNAME       => ['RegistroId' => 0, 'ProcedimentoId' => 1, ],
        self::TYPE_CAMELNAME     => ['registroId' => 0, 'procedimentoId' => 1, ],
        self::TYPE_COLNAME       => [RegistroProcedimentoTableMap::COL_REGISTRO_ID => 0, RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID => 1, ],
        self::TYPE_FIELDNAME     => ['registro_id' => 0, 'procedimento_id' => 1, ],
        self::TYPE_NUM           => [0, 1, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'RegistroId' => 'REGISTRO_ID',
        'RegistroProcedimento.RegistroId' => 'REGISTRO_ID',
        'registroId' => 'REGISTRO_ID',
        'registroProcedimento.registroId' => 'REGISTRO_ID',
        'RegistroProcedimentoTableMap::COL_REGISTRO_ID' => 'REGISTRO_ID',
        'COL_REGISTRO_ID' => 'REGISTRO_ID',
        'registro_id' => 'REGISTRO_ID',
        'registro_procedimento.registro_id' => 'REGISTRO_ID',
        'ProcedimentoId' => 'PROCEDIMENTO_ID',
        'RegistroProcedimento.ProcedimentoId' => 'PROCEDIMENTO_ID',
        'procedimentoId' => 'PROCEDIMENTO_ID',
        'registroProcedimento.procedimentoId' => 'PROCEDIMENTO_ID',
        'RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID' => 'PROCEDIMENTO_ID',
        'COL_PROCEDIMENTO_ID' => 'PROCEDIMENTO_ID',
        'procedimento_id' => 'PROCEDIMENTO_ID',
        'registro_procedimento.procedimento_id' => 'PROCEDIMENTO_ID',
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
        $this->setName('registro_procedimento');
        $this->setPhpName('RegistroProcedimento');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Api\\Models\\RegistroProcedimento');
        $this->setPackage('Api.Models');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('registro_id', 'RegistroId', 'INTEGER' , 'registros', 'id', true, null, null);
        $this->addForeignPrimaryKey('procedimento_id', 'ProcedimentoId', 'INTEGER' , 'procedimentos', 'id', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Registro', '\\Api\\Models\\Registro', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':registro_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Procedimento', '\\Api\\Models\\Procedimento', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':procedimento_id',
    1 => ':id',
  ),
), null, null, null, false);
    }

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Api\Models\RegistroProcedimento $obj A \Api\Models\RegistroProcedimento object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(RegistroProcedimento $obj, ?string $key = null): void
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getRegistroId() || is_scalar($obj->getRegistroId()) || is_callable([$obj->getRegistroId(), '__toString']) ? (string) $obj->getRegistroId() : $obj->getRegistroId()), (null === $obj->getProcedimentoId() || is_scalar($obj->getProcedimentoId()) || is_callable([$obj->getProcedimentoId(), '__toString']) ? (string) $obj->getProcedimentoId() : $obj->getProcedimentoId())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Api\Models\RegistroProcedimento object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Api\Models\RegistroProcedimento) {
                $key = serialize([(null === $value->getRegistroId() || is_scalar($value->getRegistroId()) || is_callable([$value->getRegistroId(), '__toString']) ? (string) $value->getRegistroId() : $value->getRegistroId()), (null === $value->getProcedimentoId() || is_scalar($value->getProcedimentoId()) || is_callable([$value->getProcedimentoId(), '__toString']) ? (string) $value->getProcedimentoId() : $value->getProcedimentoId())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Api\Models\RegistroProcedimento object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistroId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('ProcedimentoId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistroId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistroId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistroId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistroId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistroId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('ProcedimentoId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('ProcedimentoId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('ProcedimentoId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('ProcedimentoId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('ProcedimentoId', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('RegistroId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('ProcedimentoId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? RegistroProcedimentoTableMap::CLASS_DEFAULT : RegistroProcedimentoTableMap::OM_CLASS;
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
     * @return array (RegistroProcedimento object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RegistroProcedimentoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RegistroProcedimentoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RegistroProcedimentoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RegistroProcedimentoTableMap::OM_CLASS;
            /** @var RegistroProcedimento $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RegistroProcedimentoTableMap::addInstanceToPool($obj, $key);
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
            $key = RegistroProcedimentoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RegistroProcedimentoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RegistroProcedimento $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RegistroProcedimentoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RegistroProcedimentoTableMap::COL_REGISTRO_ID);
            $criteria->addSelectColumn(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID);
        } else {
            $criteria->addSelectColumn($alias . '.registro_id');
            $criteria->addSelectColumn($alias . '.procedimento_id');
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
            $criteria->removeSelectColumn(RegistroProcedimentoTableMap::COL_REGISTRO_ID);
            $criteria->removeSelectColumn(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.registro_id');
            $criteria->removeSelectColumn($alias . '.procedimento_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(RegistroProcedimentoTableMap::DATABASE_NAME)->getTable(RegistroProcedimentoTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a RegistroProcedimento or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or RegistroProcedimento object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroProcedimentoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Api\Models\RegistroProcedimento) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RegistroProcedimentoTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(RegistroProcedimentoTableMap::COL_REGISTRO_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = RegistroProcedimentoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RegistroProcedimentoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RegistroProcedimentoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the registro_procedimento table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RegistroProcedimentoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RegistroProcedimento or Criteria object.
     *
     * @param mixed $criteria Criteria or RegistroProcedimento object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroProcedimentoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RegistroProcedimento object
        }


        // Set the correct dbName
        $query = RegistroProcedimentoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
