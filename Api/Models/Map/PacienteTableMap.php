<?php

namespace Api\Models\Map;

use Api\Models\Paciente;
use Api\Models\PacienteQuery;
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
class PacienteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Api.Models.Map.PacienteTableMap';

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
    public const OM_CLASS = '\\Api\\Models\\Paciente';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Api.Models.Paciente';

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
     * the column name for the situacao_administ field
     */
    public const COL_SITUACAO_ADMINIST = 'pacientes.situacao_administ';

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
     * the column name for the corpo_quadro field
     */
    public const COL_CORPO_QUADRO = 'pacientes.corpo_quadro';

    /**
     * the column name for the atleta field
     */
    public const COL_ATLETA = 'pacientes.atleta';

    /**
     * the column name for the atleta_modalidade field
     */
    public const COL_ATLETA_MODALIDADE = 'pacientes.atleta_modalidade';

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
        self::TYPE_PHPNAME       => ['Id', 'Nome', 'SituacaoAdmistrativa', 'PostoGraduacao', 'Nip', 'NipTitular', 'CpfTitular', 'Origem', 'CorpoQuadro', 'Atleta', 'Modalidade', 'OutraModalidade', ],
        self::TYPE_CAMELNAME     => ['id', 'nome', 'situacaoAdmistrativa', 'postoGraduacao', 'nip', 'nipTitular', 'cpfTitular', 'origem', 'corpoQuadro', 'atleta', 'modalidade', 'outraModalidade', ],
        self::TYPE_COLNAME       => [PacienteTableMap::COL_ID, PacienteTableMap::COL_NOME, PacienteTableMap::COL_SITUACAO_ADMINIST, PacienteTableMap::COL_POSTO_GRADUACAO, PacienteTableMap::COL_NIP_PACIENTE, PacienteTableMap::COL_NIP_TITULAR, PacienteTableMap::COL_CPF_TITULAR, PacienteTableMap::COL_ORIGEM, PacienteTableMap::COL_CORPO_QUADRO, PacienteTableMap::COL_ATLETA, PacienteTableMap::COL_ATLETA_MODALIDADE, PacienteTableMap::COL_OUTRA_MODALIDADE, ],
        self::TYPE_FIELDNAME     => ['id', 'nome', 'situacao_administ', 'posto_graduacao', 'nip_paciente', 'nip_titular', 'cpf_titular', 'origem', 'corpo_quadro', 'atleta', 'atleta_modalidade', 'outra_modalidade', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Nome' => 1, 'SituacaoAdmistrativa' => 2, 'PostoGraduacao' => 3, 'Nip' => 4, 'NipTitular' => 5, 'CpfTitular' => 6, 'Origem' => 7, 'CorpoQuadro' => 8, 'Atleta' => 9, 'Modalidade' => 10, 'OutraModalidade' => 11, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'nome' => 1, 'situacaoAdmistrativa' => 2, 'postoGraduacao' => 3, 'nip' => 4, 'nipTitular' => 5, 'cpfTitular' => 6, 'origem' => 7, 'corpoQuadro' => 8, 'atleta' => 9, 'modalidade' => 10, 'outraModalidade' => 11, ],
        self::TYPE_COLNAME       => [PacienteTableMap::COL_ID => 0, PacienteTableMap::COL_NOME => 1, PacienteTableMap::COL_SITUACAO_ADMINIST => 2, PacienteTableMap::COL_POSTO_GRADUACAO => 3, PacienteTableMap::COL_NIP_PACIENTE => 4, PacienteTableMap::COL_NIP_TITULAR => 5, PacienteTableMap::COL_CPF_TITULAR => 6, PacienteTableMap::COL_ORIGEM => 7, PacienteTableMap::COL_CORPO_QUADRO => 8, PacienteTableMap::COL_ATLETA => 9, PacienteTableMap::COL_ATLETA_MODALIDADE => 10, PacienteTableMap::COL_OUTRA_MODALIDADE => 11, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'nome' => 1, 'situacao_administ' => 2, 'posto_graduacao' => 3, 'nip_paciente' => 4, 'nip_titular' => 5, 'cpf_titular' => 6, 'origem' => 7, 'corpo_quadro' => 8, 'atleta' => 9, 'atleta_modalidade' => 10, 'outra_modalidade' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Paciente.Id' => 'ID',
        'id' => 'ID',
        'paciente.id' => 'ID',
        'PacienteTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'pacientes.id' => 'ID',
        'Nome' => 'NOME',
        'Paciente.Nome' => 'NOME',
        'nome' => 'NOME',
        'paciente.nome' => 'NOME',
        'PacienteTableMap::COL_NOME' => 'NOME',
        'COL_NOME' => 'NOME',
        'pacientes.nome' => 'NOME',
        'SituacaoAdmistrativa' => 'SITUACAO_ADMINIST',
        'Paciente.SituacaoAdmistrativa' => 'SITUACAO_ADMINIST',
        'situacaoAdmistrativa' => 'SITUACAO_ADMINIST',
        'paciente.situacaoAdmistrativa' => 'SITUACAO_ADMINIST',
        'PacienteTableMap::COL_SITUACAO_ADMINIST' => 'SITUACAO_ADMINIST',
        'COL_SITUACAO_ADMINIST' => 'SITUACAO_ADMINIST',
        'situacao_administ' => 'SITUACAO_ADMINIST',
        'pacientes.situacao_administ' => 'SITUACAO_ADMINIST',
        'PostoGraduacao' => 'POSTO_GRADUACAO',
        'Paciente.PostoGraduacao' => 'POSTO_GRADUACAO',
        'postoGraduacao' => 'POSTO_GRADUACAO',
        'paciente.postoGraduacao' => 'POSTO_GRADUACAO',
        'PacienteTableMap::COL_POSTO_GRADUACAO' => 'POSTO_GRADUACAO',
        'COL_POSTO_GRADUACAO' => 'POSTO_GRADUACAO',
        'posto_graduacao' => 'POSTO_GRADUACAO',
        'pacientes.posto_graduacao' => 'POSTO_GRADUACAO',
        'Nip' => 'NIP_PACIENTE',
        'Paciente.Nip' => 'NIP_PACIENTE',
        'nip' => 'NIP_PACIENTE',
        'paciente.nip' => 'NIP_PACIENTE',
        'PacienteTableMap::COL_NIP_PACIENTE' => 'NIP_PACIENTE',
        'COL_NIP_PACIENTE' => 'NIP_PACIENTE',
        'nip_paciente' => 'NIP_PACIENTE',
        'pacientes.nip_paciente' => 'NIP_PACIENTE',
        'NipTitular' => 'NIP_TITULAR',
        'Paciente.NipTitular' => 'NIP_TITULAR',
        'nipTitular' => 'NIP_TITULAR',
        'paciente.nipTitular' => 'NIP_TITULAR',
        'PacienteTableMap::COL_NIP_TITULAR' => 'NIP_TITULAR',
        'COL_NIP_TITULAR' => 'NIP_TITULAR',
        'nip_titular' => 'NIP_TITULAR',
        'pacientes.nip_titular' => 'NIP_TITULAR',
        'CpfTitular' => 'CPF_TITULAR',
        'Paciente.CpfTitular' => 'CPF_TITULAR',
        'cpfTitular' => 'CPF_TITULAR',
        'paciente.cpfTitular' => 'CPF_TITULAR',
        'PacienteTableMap::COL_CPF_TITULAR' => 'CPF_TITULAR',
        'COL_CPF_TITULAR' => 'CPF_TITULAR',
        'cpf_titular' => 'CPF_TITULAR',
        'pacientes.cpf_titular' => 'CPF_TITULAR',
        'Origem' => 'ORIGEM',
        'Paciente.Origem' => 'ORIGEM',
        'origem' => 'ORIGEM',
        'paciente.origem' => 'ORIGEM',
        'PacienteTableMap::COL_ORIGEM' => 'ORIGEM',
        'COL_ORIGEM' => 'ORIGEM',
        'pacientes.origem' => 'ORIGEM',
        'CorpoQuadro' => 'CORPO_QUADRO',
        'Paciente.CorpoQuadro' => 'CORPO_QUADRO',
        'corpoQuadro' => 'CORPO_QUADRO',
        'paciente.corpoQuadro' => 'CORPO_QUADRO',
        'PacienteTableMap::COL_CORPO_QUADRO' => 'CORPO_QUADRO',
        'COL_CORPO_QUADRO' => 'CORPO_QUADRO',
        'corpo_quadro' => 'CORPO_QUADRO',
        'pacientes.corpo_quadro' => 'CORPO_QUADRO',
        'Atleta' => 'ATLETA',
        'Paciente.Atleta' => 'ATLETA',
        'atleta' => 'ATLETA',
        'paciente.atleta' => 'ATLETA',
        'PacienteTableMap::COL_ATLETA' => 'ATLETA',
        'COL_ATLETA' => 'ATLETA',
        'pacientes.atleta' => 'ATLETA',
        'Modalidade' => 'ATLETA_MODALIDADE',
        'Paciente.Modalidade' => 'ATLETA_MODALIDADE',
        'modalidade' => 'ATLETA_MODALIDADE',
        'paciente.modalidade' => 'ATLETA_MODALIDADE',
        'PacienteTableMap::COL_ATLETA_MODALIDADE' => 'ATLETA_MODALIDADE',
        'COL_ATLETA_MODALIDADE' => 'ATLETA_MODALIDADE',
        'atleta_modalidade' => 'ATLETA_MODALIDADE',
        'pacientes.atleta_modalidade' => 'ATLETA_MODALIDADE',
        'OutraModalidade' => 'OUTRA_MODALIDADE',
        'Paciente.OutraModalidade' => 'OUTRA_MODALIDADE',
        'outraModalidade' => 'OUTRA_MODALIDADE',
        'paciente.outraModalidade' => 'OUTRA_MODALIDADE',
        'PacienteTableMap::COL_OUTRA_MODALIDADE' => 'OUTRA_MODALIDADE',
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
        $this->setPhpName('Paciente');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Api\\Models\\Paciente');
        $this->setPackage('Api.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nome', 'Nome', 'VARCHAR', true, 150, null);
        $this->addColumn('situacao_administ', 'SituacaoAdmistrativa', 'VARCHAR', false, 30, null);
        $this->addColumn('posto_graduacao', 'PostoGraduacao', 'VARCHAR', false, 10, null);
        $this->addColumn('nip_paciente', 'Nip', 'VARCHAR', false, 8, null);
        $this->addColumn('nip_titular', 'NipTitular', 'VARCHAR', false, 8, null);
        $this->addColumn('cpf_titular', 'CpfTitular', 'VARCHAR', false, 11, null);
        $this->addColumn('origem', 'Origem', 'VARCHAR', false, 20, null);
        $this->addColumn('corpo_quadro', 'CorpoQuadro', 'VARCHAR', false, 5, null);
        $this->addColumn('atleta', 'Atleta', 'BOOLEAN', false, 1, null);
        $this->addColumn('atleta_modalidade', 'Modalidade', 'VARCHAR', false, 50, null);
        $this->addColumn('outra_modalidade', 'OutraModalidade', 'VARCHAR', false, 50, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Registro', '\\Api\\Models\\Registro', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':paciente_id',
    1 => ':id',
  ),
), null, null, 'Registros', false);
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
        return $withPrefix ? PacienteTableMap::CLASS_DEFAULT : PacienteTableMap::OM_CLASS;
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
     * @return array (Paciente object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PacienteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PacienteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PacienteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PacienteTableMap::OM_CLASS;
            /** @var Paciente $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PacienteTableMap::addInstanceToPool($obj, $key);
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
            $key = PacienteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PacienteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Paciente $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PacienteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PacienteTableMap::COL_ID);
            $criteria->addSelectColumn(PacienteTableMap::COL_NOME);
            $criteria->addSelectColumn(PacienteTableMap::COL_SITUACAO_ADMINIST);
            $criteria->addSelectColumn(PacienteTableMap::COL_POSTO_GRADUACAO);
            $criteria->addSelectColumn(PacienteTableMap::COL_NIP_PACIENTE);
            $criteria->addSelectColumn(PacienteTableMap::COL_NIP_TITULAR);
            $criteria->addSelectColumn(PacienteTableMap::COL_CPF_TITULAR);
            $criteria->addSelectColumn(PacienteTableMap::COL_ORIGEM);
            $criteria->addSelectColumn(PacienteTableMap::COL_CORPO_QUADRO);
            $criteria->addSelectColumn(PacienteTableMap::COL_ATLETA);
            $criteria->addSelectColumn(PacienteTableMap::COL_ATLETA_MODALIDADE);
            $criteria->addSelectColumn(PacienteTableMap::COL_OUTRA_MODALIDADE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.nome');
            $criteria->addSelectColumn($alias . '.situacao_administ');
            $criteria->addSelectColumn($alias . '.posto_graduacao');
            $criteria->addSelectColumn($alias . '.nip_paciente');
            $criteria->addSelectColumn($alias . '.nip_titular');
            $criteria->addSelectColumn($alias . '.cpf_titular');
            $criteria->addSelectColumn($alias . '.origem');
            $criteria->addSelectColumn($alias . '.corpo_quadro');
            $criteria->addSelectColumn($alias . '.atleta');
            $criteria->addSelectColumn($alias . '.atleta_modalidade');
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
            $criteria->removeSelectColumn(PacienteTableMap::COL_ID);
            $criteria->removeSelectColumn(PacienteTableMap::COL_NOME);
            $criteria->removeSelectColumn(PacienteTableMap::COL_SITUACAO_ADMINIST);
            $criteria->removeSelectColumn(PacienteTableMap::COL_POSTO_GRADUACAO);
            $criteria->removeSelectColumn(PacienteTableMap::COL_NIP_PACIENTE);
            $criteria->removeSelectColumn(PacienteTableMap::COL_NIP_TITULAR);
            $criteria->removeSelectColumn(PacienteTableMap::COL_CPF_TITULAR);
            $criteria->removeSelectColumn(PacienteTableMap::COL_ORIGEM);
            $criteria->removeSelectColumn(PacienteTableMap::COL_CORPO_QUADRO);
            $criteria->removeSelectColumn(PacienteTableMap::COL_ATLETA);
            $criteria->removeSelectColumn(PacienteTableMap::COL_ATLETA_MODALIDADE);
            $criteria->removeSelectColumn(PacienteTableMap::COL_OUTRA_MODALIDADE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.nome');
            $criteria->removeSelectColumn($alias . '.situacao_administ');
            $criteria->removeSelectColumn($alias . '.posto_graduacao');
            $criteria->removeSelectColumn($alias . '.nip_paciente');
            $criteria->removeSelectColumn($alias . '.nip_titular');
            $criteria->removeSelectColumn($alias . '.cpf_titular');
            $criteria->removeSelectColumn($alias . '.origem');
            $criteria->removeSelectColumn($alias . '.corpo_quadro');
            $criteria->removeSelectColumn($alias . '.atleta');
            $criteria->removeSelectColumn($alias . '.atleta_modalidade');
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
        return Propel::getServiceContainer()->getDatabaseMap(PacienteTableMap::DATABASE_NAME)->getTable(PacienteTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Paciente or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Paciente object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PacienteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Api\Models\Paciente) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PacienteTableMap::DATABASE_NAME);
            $criteria->add(PacienteTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PacienteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PacienteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PacienteTableMap::removeInstanceFromPool($singleval);
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
        return PacienteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Paciente or Criteria object.
     *
     * @param mixed $criteria Criteria or Paciente object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PacienteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Paciente object
        }

        if ($criteria->containsKey(PacienteTableMap::COL_ID) && $criteria->keyContainsValue(PacienteTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PacienteTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PacienteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
