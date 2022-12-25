<?php

namespace Models\Map;

use Models\Pacientes;
use Models\PacientesQuery;
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
 * This class defines the structure of the 'pacientes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PacientesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Models.Map.PacientesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pacientes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Models\\Pacientes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Models.Pacientes';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'pacientes.id';

    /**
     * the column name for the nome field
     */
    public const COL_NOME = 'pacientes.nome';

    /**
     * the column name for the situacao_adm field
     */
    public const COL_SITUACAO_ADM = 'pacientes.situacao_adm';

    /**
     * the column name for the posto_graduacao field
     */
    public const COL_POSTO_GRADUACAO = 'pacientes.posto_graduacao';

    /**
     * the column name for the nip_paciente field
     */
    public const COL_NIP_PACIENTE = 'pacientes.nip_paciente';

    /**
     * the column name for the nip_titular field
     */
    public const COL_NIP_TITULAR = 'pacientes.nip_titular';

    /**
     * the column name for the cpf_titular field
     */
    public const COL_CPF_TITULAR = 'pacientes.cpf_titular';

    /**
     * the column name for the origem field
     */
    public const COL_ORIGEM = 'pacientes.origem';

    /**
     * the column name for the corpoquadro field
     */
    public const COL_CORPOQUADRO = 'pacientes.corpoquadro';

    /**
     * the column name for the atleta field
     */
    public const COL_ATLETA = 'pacientes.atleta';

    /**
     * the column name for the modalidade field
     */
    public const COL_MODALIDADE = 'pacientes.modalidade';

    /**
     * the column name for the outra_modalidade field
     */
    public const COL_OUTRA_MODALIDADE = 'pacientes.outra_modalidade';

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
        self::TYPE_PHPNAME       => ['Id', 'Nome', 'SituacaoAdm', 'PostoGraduacao', 'NipPaciente', 'NipTitular', 'CpfTitular', 'Origem', 'Corpoquadro', 'Atleta', 'Modalidade', 'OutraModalidade', ],
        self::TYPE_CAMELNAME     => ['id', 'nome', 'situacaoAdm', 'postoGraduacao', 'nipPaciente', 'nipTitular', 'cpfTitular', 'origem', 'corpoquadro', 'atleta', 'modalidade', 'outraModalidade', ],
        self::TYPE_COLNAME       => [PacientesTableMap::COL_ID, PacientesTableMap::COL_NOME, PacientesTableMap::COL_SITUACAO_ADM, PacientesTableMap::COL_POSTO_GRADUACAO, PacientesTableMap::COL_NIP_PACIENTE, PacientesTableMap::COL_NIP_TITULAR, PacientesTableMap::COL_CPF_TITULAR, PacientesTableMap::COL_ORIGEM, PacientesTableMap::COL_CORPOQUADRO, PacientesTableMap::COL_ATLETA, PacientesTableMap::COL_MODALIDADE, PacientesTableMap::COL_OUTRA_MODALIDADE, ],
        self::TYPE_FIELDNAME     => ['id', 'nome', 'situacao_adm', 'posto_graduacao', 'nip_paciente', 'nip_titular', 'cpf_titular', 'origem', 'corpoquadro', 'atleta', 'modalidade', 'outra_modalidade', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Nome' => 1, 'SituacaoAdm' => 2, 'PostoGraduacao' => 3, 'NipPaciente' => 4, 'NipTitular' => 5, 'CpfTitular' => 6, 'Origem' => 7, 'Corpoquadro' => 8, 'Atleta' => 9, 'Modalidade' => 10, 'OutraModalidade' => 11, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'nome' => 1, 'situacaoAdm' => 2, 'postoGraduacao' => 3, 'nipPaciente' => 4, 'nipTitular' => 5, 'cpfTitular' => 6, 'origem' => 7, 'corpoquadro' => 8, 'atleta' => 9, 'modalidade' => 10, 'outraModalidade' => 11, ],
        self::TYPE_COLNAME       => [PacientesTableMap::COL_ID => 0, PacientesTableMap::COL_NOME => 1, PacientesTableMap::COL_SITUACAO_ADM => 2, PacientesTableMap::COL_POSTO_GRADUACAO => 3, PacientesTableMap::COL_NIP_PACIENTE => 4, PacientesTableMap::COL_NIP_TITULAR => 5, PacientesTableMap::COL_CPF_TITULAR => 6, PacientesTableMap::COL_ORIGEM => 7, PacientesTableMap::COL_CORPOQUADRO => 8, PacientesTableMap::COL_ATLETA => 9, PacientesTableMap::COL_MODALIDADE => 10, PacientesTableMap::COL_OUTRA_MODALIDADE => 11, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'nome' => 1, 'situacao_adm' => 2, 'posto_graduacao' => 3, 'nip_paciente' => 4, 'nip_titular' => 5, 'cpf_titular' => 6, 'origem' => 7, 'corpoquadro' => 8, 'atleta' => 9, 'modalidade' => 10, 'outra_modalidade' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Pacientes.Id' => 'ID',
        'id' => 'ID',
        'pacientes.id' => 'ID',
        'PacientesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Nome' => 'NOME',
        'Pacientes.Nome' => 'NOME',
        'nome' => 'NOME',
        'pacientes.nome' => 'NOME',
        'PacientesTableMap::COL_NOME' => 'NOME',
        'COL_NOME' => 'NOME',
        'SituacaoAdm' => 'SITUACAO_ADM',
        'Pacientes.SituacaoAdm' => 'SITUACAO_ADM',
        'situacaoAdm' => 'SITUACAO_ADM',
        'pacientes.situacaoAdm' => 'SITUACAO_ADM',
        'PacientesTableMap::COL_SITUACAO_ADM' => 'SITUACAO_ADM',
        'COL_SITUACAO_ADM' => 'SITUACAO_ADM',
        'situacao_adm' => 'SITUACAO_ADM',
        'pacientes.situacao_adm' => 'SITUACAO_ADM',
        'PostoGraduacao' => 'POSTO_GRADUACAO',
        'Pacientes.PostoGraduacao' => 'POSTO_GRADUACAO',
        'postoGraduacao' => 'POSTO_GRADUACAO',
        'pacientes.postoGraduacao' => 'POSTO_GRADUACAO',
        'PacientesTableMap::COL_POSTO_GRADUACAO' => 'POSTO_GRADUACAO',
        'COL_POSTO_GRADUACAO' => 'POSTO_GRADUACAO',
        'posto_graduacao' => 'POSTO_GRADUACAO',
        'pacientes.posto_graduacao' => 'POSTO_GRADUACAO',
        'NipPaciente' => 'NIP_PACIENTE',
        'Pacientes.NipPaciente' => 'NIP_PACIENTE',
        'nipPaciente' => 'NIP_PACIENTE',
        'pacientes.nipPaciente' => 'NIP_PACIENTE',
        'PacientesTableMap::COL_NIP_PACIENTE' => 'NIP_PACIENTE',
        'COL_NIP_PACIENTE' => 'NIP_PACIENTE',
        'nip_paciente' => 'NIP_PACIENTE',
        'pacientes.nip_paciente' => 'NIP_PACIENTE',
        'NipTitular' => 'NIP_TITULAR',
        'Pacientes.NipTitular' => 'NIP_TITULAR',
        'nipTitular' => 'NIP_TITULAR',
        'pacientes.nipTitular' => 'NIP_TITULAR',
        'PacientesTableMap::COL_NIP_TITULAR' => 'NIP_TITULAR',
        'COL_NIP_TITULAR' => 'NIP_TITULAR',
        'nip_titular' => 'NIP_TITULAR',
        'pacientes.nip_titular' => 'NIP_TITULAR',
        'CpfTitular' => 'CPF_TITULAR',
        'Pacientes.CpfTitular' => 'CPF_TITULAR',
        'cpfTitular' => 'CPF_TITULAR',
        'pacientes.cpfTitular' => 'CPF_TITULAR',
        'PacientesTableMap::COL_CPF_TITULAR' => 'CPF_TITULAR',
        'COL_CPF_TITULAR' => 'CPF_TITULAR',
        'cpf_titular' => 'CPF_TITULAR',
        'pacientes.cpf_titular' => 'CPF_TITULAR',
        'Origem' => 'ORIGEM',
        'Pacientes.Origem' => 'ORIGEM',
        'origem' => 'ORIGEM',
        'pacientes.origem' => 'ORIGEM',
        'PacientesTableMap::COL_ORIGEM' => 'ORIGEM',
        'COL_ORIGEM' => 'ORIGEM',
        'Corpoquadro' => 'CORPOQUADRO',
        'Pacientes.Corpoquadro' => 'CORPOQUADRO',
        'corpoquadro' => 'CORPOQUADRO',
        'pacientes.corpoquadro' => 'CORPOQUADRO',
        'PacientesTableMap::COL_CORPOQUADRO' => 'CORPOQUADRO',
        'COL_CORPOQUADRO' => 'CORPOQUADRO',
        'Atleta' => 'ATLETA',
        'Pacientes.Atleta' => 'ATLETA',
        'atleta' => 'ATLETA',
        'pacientes.atleta' => 'ATLETA',
        'PacientesTableMap::COL_ATLETA' => 'ATLETA',
        'COL_ATLETA' => 'ATLETA',
        'Modalidade' => 'MODALIDADE',
        'Pacientes.Modalidade' => 'MODALIDADE',
        'modalidade' => 'MODALIDADE',
        'pacientes.modalidade' => 'MODALIDADE',
        'PacientesTableMap::COL_MODALIDADE' => 'MODALIDADE',
        'COL_MODALIDADE' => 'MODALIDADE',
        'OutraModalidade' => 'OUTRA_MODALIDADE',
        'Pacientes.OutraModalidade' => 'OUTRA_MODALIDADE',
        'outraModalidade' => 'OUTRA_MODALIDADE',
        'pacientes.outraModalidade' => 'OUTRA_MODALIDADE',
        'PacientesTableMap::COL_OUTRA_MODALIDADE' => 'OUTRA_MODALIDADE',
        'COL_OUTRA_MODALIDADE' => 'OUTRA_MODALIDADE',
        'outra_modalidade' => 'OUTRA_MODALIDADE',
        'pacientes.outra_modalidade' => 'OUTRA_MODALIDADE',
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
        $this->setName('pacientes');
        $this->setPhpName('Pacientes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Models\\Pacientes');
        $this->setPackage('Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nome', 'Nome', 'VARCHAR', true, 150, null);
        $this->addColumn('situacao_adm', 'SituacaoAdm', 'VARCHAR', true, 30, null);
        $this->addColumn('posto_graduacao', 'PostoGraduacao', 'VARCHAR', true, 10, null);
        $this->addColumn('nip_paciente', 'NipPaciente', 'INTEGER', true, 8, null);
        $this->addColumn('nip_titular', 'NipTitular', 'INTEGER', true, 8, null);
        $this->addColumn('cpf_titular', 'CpfTitular', 'BIGINT', true, 11, null);
        $this->addColumn('origem', 'Origem', 'VARCHAR', true, 20, null);
        $this->addColumn('corpoquadro', 'Corpoquadro', 'VARCHAR', true, 5, null);
        $this->addColumn('atleta', 'Atleta', 'VARCHAR', true, 3, null);
        $this->addColumn('modalidade', 'Modalidade', 'VARCHAR', true, 50, null);
        $this->addColumn('outra_modalidade', 'OutraModalidade', 'VARCHAR', true, 50, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        return $withPrefix ? PacientesTableMap::CLASS_DEFAULT : PacientesTableMap::OM_CLASS;
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
     * @return array (Pacientes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PacientesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PacientesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PacientesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PacientesTableMap::OM_CLASS;
            /** @var Pacientes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PacientesTableMap::addInstanceToPool($obj, $key);
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
            $key = PacientesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PacientesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Pacientes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PacientesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PacientesTableMap::COL_ID);
            $criteria->addSelectColumn(PacientesTableMap::COL_NOME);
            $criteria->addSelectColumn(PacientesTableMap::COL_SITUACAO_ADM);
            $criteria->addSelectColumn(PacientesTableMap::COL_POSTO_GRADUACAO);
            $criteria->addSelectColumn(PacientesTableMap::COL_NIP_PACIENTE);
            $criteria->addSelectColumn(PacientesTableMap::COL_NIP_TITULAR);
            $criteria->addSelectColumn(PacientesTableMap::COL_CPF_TITULAR);
            $criteria->addSelectColumn(PacientesTableMap::COL_ORIGEM);
            $criteria->addSelectColumn(PacientesTableMap::COL_CORPOQUADRO);
            $criteria->addSelectColumn(PacientesTableMap::COL_ATLETA);
            $criteria->addSelectColumn(PacientesTableMap::COL_MODALIDADE);
            $criteria->addSelectColumn(PacientesTableMap::COL_OUTRA_MODALIDADE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.nome');
            $criteria->addSelectColumn($alias . '.situacao_adm');
            $criteria->addSelectColumn($alias . '.posto_graduacao');
            $criteria->addSelectColumn($alias . '.nip_paciente');
            $criteria->addSelectColumn($alias . '.nip_titular');
            $criteria->addSelectColumn($alias . '.cpf_titular');
            $criteria->addSelectColumn($alias . '.origem');
            $criteria->addSelectColumn($alias . '.corpoquadro');
            $criteria->addSelectColumn($alias . '.atleta');
            $criteria->addSelectColumn($alias . '.modalidade');
            $criteria->addSelectColumn($alias . '.outra_modalidade');
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
            $criteria->removeSelectColumn(PacientesTableMap::COL_ID);
            $criteria->removeSelectColumn(PacientesTableMap::COL_NOME);
            $criteria->removeSelectColumn(PacientesTableMap::COL_SITUACAO_ADM);
            $criteria->removeSelectColumn(PacientesTableMap::COL_POSTO_GRADUACAO);
            $criteria->removeSelectColumn(PacientesTableMap::COL_NIP_PACIENTE);
            $criteria->removeSelectColumn(PacientesTableMap::COL_NIP_TITULAR);
            $criteria->removeSelectColumn(PacientesTableMap::COL_CPF_TITULAR);
            $criteria->removeSelectColumn(PacientesTableMap::COL_ORIGEM);
            $criteria->removeSelectColumn(PacientesTableMap::COL_CORPOQUADRO);
            $criteria->removeSelectColumn(PacientesTableMap::COL_ATLETA);
            $criteria->removeSelectColumn(PacientesTableMap::COL_MODALIDADE);
            $criteria->removeSelectColumn(PacientesTableMap::COL_OUTRA_MODALIDADE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.nome');
            $criteria->removeSelectColumn($alias . '.situacao_adm');
            $criteria->removeSelectColumn($alias . '.posto_graduacao');
            $criteria->removeSelectColumn($alias . '.nip_paciente');
            $criteria->removeSelectColumn($alias . '.nip_titular');
            $criteria->removeSelectColumn($alias . '.cpf_titular');
            $criteria->removeSelectColumn($alias . '.origem');
            $criteria->removeSelectColumn($alias . '.corpoquadro');
            $criteria->removeSelectColumn($alias . '.atleta');
            $criteria->removeSelectColumn($alias . '.modalidade');
            $criteria->removeSelectColumn($alias . '.outra_modalidade');
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
        return Propel::getServiceContainer()->getDatabaseMap(PacientesTableMap::DATABASE_NAME)->getTable(PacientesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Pacientes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Pacientes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PacientesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Models\Pacientes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PacientesTableMap::DATABASE_NAME);
            $criteria->add(PacientesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PacientesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PacientesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PacientesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pacientes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PacientesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Pacientes or Criteria object.
     *
     * @param mixed $criteria Criteria or Pacientes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PacientesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Pacientes object
        }

        if ($criteria->containsKey(PacientesTableMap::COL_ID) && $criteria->keyContainsValue(PacientesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PacientesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PacientesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
