<?php

namespace Api\Models\Base;

use \Exception;
use \PDO;
use Api\Models\Paciente as ChildPaciente;
use Api\Models\PacienteQuery as ChildPacienteQuery;
use Api\Models\Registro as ChildRegistro;
use Api\Models\RegistroQuery as ChildRegistroQuery;
use Api\Models\Map\PacienteTableMap;
use Api\Models\Map\RegistroTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'pacientes' table.
 *
 *
 *
 * @package    propel.generator.Api.Models.Base
 */
abstract class Paciente implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Api\\Models\\Map\\PacienteTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the nome field.
     *
     * @var        string
     */
    protected $nome;

    /**
     * The value for the situacao_administ field.
     *
     * @var        string|null
     */
    protected $situacao_administ;

    /**
     * The value for the posto_graduacao field.
     *
     * @var        string|null
     */
    protected $posto_graduacao;

    /**
     * The value for the nip_paciente field.
     *
     * @var        string|null
     */
    protected $nip_paciente;

    /**
     * The value for the nip_titular field.
     *
     * @var        string|null
     */
    protected $nip_titular;

    /**
     * The value for the cpf_titular field.
     *
     * @var        string|null
     */
    protected $cpf_titular;

    /**
     * The value for the origem field.
     *
     * @var        string|null
     */
    protected $origem;

    /**
     * The value for the corpo_quadro field.
     *
     * @var        string|null
     */
    protected $corpo_quadro;

    /**
     * The value for the atleta field.
     *
     * @var        boolean|null
     */
    protected $atleta;

    /**
     * The value for the atleta_modalidade field.
     *
     * @var        string|null
     */
    protected $atleta_modalidade;

    /**
     * The value for the outra_modalidade field.
     *
     * @var        string|null
     */
    protected $outra_modalidade;

    /**
     * The value for the disabled field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $disabled;

    /**
     * @var        ObjectCollection|ChildRegistro[] Collection to store aggregation of ChildRegistro objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildRegistro> Collection to store aggregation of ChildRegistro objects.
     */
    protected $collRegistros;
    protected $collRegistrosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRegistro[]
     * @phpstan-var ObjectCollection&\Traversable<ChildRegistro>
     */
    protected $registrosScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->disabled = false;
    }

    /**
     * Initializes internal state of Api\Models\Base\Paciente object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Paciente</code> instance.  If
     * <code>obj</code> is an instance of <code>Paciente</code>, delegates to
     * <code>equals(Paciente)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [nome] column value.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the [situacao_administ] column value.
     *
     * @return string|null
     */
    public function getSituacaoAdmistrativa()
    {
        return $this->situacao_administ;
    }

    /**
     * Get the [posto_graduacao] column value.
     *
     * @return string|null
     */
    public function getPostoGraduacao()
    {
        return $this->posto_graduacao;
    }

    /**
     * Get the [nip_paciente] column value.
     *
     * @return string|null
     */
    public function getNip()
    {
        return $this->nip_paciente;
    }

    /**
     * Get the [nip_titular] column value.
     *
     * @return string|null
     */
    public function getNipTitular()
    {
        return $this->nip_titular;
    }

    /**
     * Get the [cpf_titular] column value.
     *
     * @return string|null
     */
    public function getCpfTitular()
    {
        return $this->cpf_titular;
    }

    /**
     * Get the [origem] column value.
     *
     * @return string|null
     */
    public function getOrigem()
    {
        return $this->origem;
    }

    /**
     * Get the [corpo_quadro] column value.
     *
     * @return string|null
     */
    public function getCorpoQuadro()
    {
        return $this->corpo_quadro;
    }

    /**
     * Get the [atleta] column value.
     *
     * @return boolean|null
     */
    public function getAtleta()
    {
        return $this->atleta;
    }

    /**
     * Get the [atleta] column value.
     *
     * @return boolean|null
     */
    public function isAtleta()
    {
        return $this->getAtleta();
    }

    /**
     * Get the [atleta_modalidade] column value.
     *
     * @return string|null
     */
    public function getModalidade()
    {
        return $this->atleta_modalidade;
    }

    /**
     * Get the [outra_modalidade] column value.
     *
     * @return string|null
     */
    public function getOutraModalidade()
    {
        return $this->outra_modalidade;
    }

    /**
     * Get the [disabled] column value.
     *
     * @return boolean
     */
    public function getDesabilitado()
    {
        return $this->disabled;
    }

    /**
     * Get the [disabled] column value.
     *
     * @return boolean
     */
    public function isDesabilitado()
    {
        return $this->getDesabilitado();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PacienteTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nome] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[PacienteTableMap::COL_NOME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [situacao_administ] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSituacaoAdmistrativa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->situacao_administ !== $v) {
            $this->situacao_administ = $v;
            $this->modifiedColumns[PacienteTableMap::COL_SITUACAO_ADMINIST] = true;
        }

        return $this;
    }

    /**
     * Set the value of [posto_graduacao] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPostoGraduacao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->posto_graduacao !== $v) {
            $this->posto_graduacao = $v;
            $this->modifiedColumns[PacienteTableMap::COL_POSTO_GRADUACAO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nip_paciente] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNip($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nip_paciente !== $v) {
            $this->nip_paciente = $v;
            $this->modifiedColumns[PacienteTableMap::COL_NIP_PACIENTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nip_titular] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNipTitular($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nip_titular !== $v) {
            $this->nip_titular = $v;
            $this->modifiedColumns[PacienteTableMap::COL_NIP_TITULAR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cpf_titular] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCpfTitular($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cpf_titular !== $v) {
            $this->cpf_titular = $v;
            $this->modifiedColumns[PacienteTableMap::COL_CPF_TITULAR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [origem] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrigem($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->origem !== $v) {
            $this->origem = $v;
            $this->modifiedColumns[PacienteTableMap::COL_ORIGEM] = true;
        }

        return $this;
    }

    /**
     * Set the value of [corpo_quadro] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCorpoQuadro($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->corpo_quadro !== $v) {
            $this->corpo_quadro = $v;
            $this->modifiedColumns[PacienteTableMap::COL_CORPO_QUADRO] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [atleta] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setAtleta($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->atleta !== $v) {
            $this->atleta = $v;
            $this->modifiedColumns[PacienteTableMap::COL_ATLETA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [atleta_modalidade] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setModalidade($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->atleta_modalidade !== $v) {
            $this->atleta_modalidade = $v;
            $this->modifiedColumns[PacienteTableMap::COL_ATLETA_MODALIDADE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outra_modalidade] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutraModalidade($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outra_modalidade !== $v) {
            $this->outra_modalidade = $v;
            $this->modifiedColumns[PacienteTableMap::COL_OUTRA_MODALIDADE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [disabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setDesabilitado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->disabled !== $v) {
            $this->disabled = $v;
            $this->modifiedColumns[PacienteTableMap::COL_DISABLED] = true;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->disabled !== false) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PacienteTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PacienteTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PacienteTableMap::translateFieldName('SituacaoAdmistrativa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->situacao_administ = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PacienteTableMap::translateFieldName('PostoGraduacao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->posto_graduacao = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PacienteTableMap::translateFieldName('Nip', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nip_paciente = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PacienteTableMap::translateFieldName('NipTitular', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nip_titular = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PacienteTableMap::translateFieldName('CpfTitular', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cpf_titular = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PacienteTableMap::translateFieldName('Origem', TableMap::TYPE_PHPNAME, $indexType)];
            $this->origem = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PacienteTableMap::translateFieldName('CorpoQuadro', TableMap::TYPE_PHPNAME, $indexType)];
            $this->corpo_quadro = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PacienteTableMap::translateFieldName('Atleta', TableMap::TYPE_PHPNAME, $indexType)];
            $this->atleta = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PacienteTableMap::translateFieldName('Modalidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->atleta_modalidade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PacienteTableMap::translateFieldName('OutraModalidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outra_modalidade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PacienteTableMap::translateFieldName('Desabilitado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->disabled = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = PacienteTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Api\\Models\\Paciente'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PacienteTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPacienteQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collRegistros = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Paciente::setDeleted()
     * @see Paciente::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PacienteTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPacienteQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PacienteTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PacienteTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->registrosScheduledForDeletion !== null) {
                if (!$this->registrosScheduledForDeletion->isEmpty()) {
                    foreach ($this->registrosScheduledForDeletion as $registro) {
                        // need to save related object because we set the relation to null
                        $registro->save($con);
                    }
                    $this->registrosScheduledForDeletion = null;
                }
            }

            if ($this->collRegistros !== null) {
                foreach ($this->collRegistros as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[PacienteTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PacienteTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PacienteTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_SITUACAO_ADMINIST)) {
            $modifiedColumns[':p' . $index++]  = 'situacao_administ';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_POSTO_GRADUACAO)) {
            $modifiedColumns[':p' . $index++]  = 'posto_graduacao';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_NIP_PACIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'nip_paciente';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_NIP_TITULAR)) {
            $modifiedColumns[':p' . $index++]  = 'nip_titular';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_CPF_TITULAR)) {
            $modifiedColumns[':p' . $index++]  = 'cpf_titular';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_ORIGEM)) {
            $modifiedColumns[':p' . $index++]  = 'origem';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_CORPO_QUADRO)) {
            $modifiedColumns[':p' . $index++]  = 'corpo_quadro';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_ATLETA)) {
            $modifiedColumns[':p' . $index++]  = 'atleta';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_ATLETA_MODALIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'atleta_modalidade';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_OUTRA_MODALIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'outra_modalidade';
        }
        if ($this->isColumnModified(PacienteTableMap::COL_DISABLED)) {
            $modifiedColumns[':p' . $index++]  = 'disabled';
        }

        $sql = sprintf(
            'INSERT INTO pacientes (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'nome':
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'situacao_administ':
                        $stmt->bindValue($identifier, $this->situacao_administ, PDO::PARAM_STR);
                        break;
                    case 'posto_graduacao':
                        $stmt->bindValue($identifier, $this->posto_graduacao, PDO::PARAM_STR);
                        break;
                    case 'nip_paciente':
                        $stmt->bindValue($identifier, $this->nip_paciente, PDO::PARAM_STR);
                        break;
                    case 'nip_titular':
                        $stmt->bindValue($identifier, $this->nip_titular, PDO::PARAM_STR);
                        break;
                    case 'cpf_titular':
                        $stmt->bindValue($identifier, $this->cpf_titular, PDO::PARAM_STR);
                        break;
                    case 'origem':
                        $stmt->bindValue($identifier, $this->origem, PDO::PARAM_STR);
                        break;
                    case 'corpo_quadro':
                        $stmt->bindValue($identifier, $this->corpo_quadro, PDO::PARAM_STR);
                        break;
                    case 'atleta':
                        $stmt->bindValue($identifier, (int) $this->atleta, PDO::PARAM_INT);
                        break;
                    case 'atleta_modalidade':
                        $stmt->bindValue($identifier, $this->atleta_modalidade, PDO::PARAM_STR);
                        break;
                    case 'outra_modalidade':
                        $stmt->bindValue($identifier, $this->outra_modalidade, PDO::PARAM_STR);
                        break;
                    case 'disabled':
                        $stmt->bindValue($identifier, (int) $this->disabled, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PacienteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();

            case 1:
                return $this->getNome();

            case 2:
                return $this->getSituacaoAdmistrativa();

            case 3:
                return $this->getPostoGraduacao();

            case 4:
                return $this->getNip();

            case 5:
                return $this->getNipTitular();

            case 6:
                return $this->getCpfTitular();

            case 7:
                return $this->getOrigem();

            case 8:
                return $this->getCorpoQuadro();

            case 9:
                return $this->getAtleta();

            case 10:
                return $this->getModalidade();

            case 11:
                return $this->getOutraModalidade();

            case 12:
                return $this->getDesabilitado();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['Paciente'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Paciente'][$this->hashCode()] = true;
        $keys = PacienteTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNome(),
            $keys[2] => $this->getSituacaoAdmistrativa(),
            $keys[3] => $this->getPostoGraduacao(),
            $keys[4] => $this->getNip(),
            $keys[5] => $this->getNipTitular(),
            $keys[6] => $this->getCpfTitular(),
            $keys[7] => $this->getOrigem(),
            $keys[8] => $this->getCorpoQuadro(),
            $keys[9] => $this->getAtleta(),
            $keys[10] => $this->getModalidade(),
            $keys[11] => $this->getOutraModalidade(),
            $keys[12] => $this->getDesabilitado(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collRegistros) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'registros';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'registross';
                        break;
                    default:
                        $key = 'Registros';
                }

                $result[$key] = $this->collRegistros->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PacienteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setNome($value);
                break;
            case 2:
                $this->setSituacaoAdmistrativa($value);
                break;
            case 3:
                $this->setPostoGraduacao($value);
                break;
            case 4:
                $this->setNip($value);
                break;
            case 5:
                $this->setNipTitular($value);
                break;
            case 6:
                $this->setCpfTitular($value);
                break;
            case 7:
                $this->setOrigem($value);
                break;
            case 8:
                $this->setCorpoQuadro($value);
                break;
            case 9:
                $this->setAtleta($value);
                break;
            case 10:
                $this->setModalidade($value);
                break;
            case 11:
                $this->setOutraModalidade($value);
                break;
            case 12:
                $this->setDesabilitado($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PacienteTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNome($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSituacaoAdmistrativa($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPostoGraduacao($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNip($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNipTitular($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCpfTitular($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setOrigem($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCorpoQuadro($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAtleta($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setModalidade($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setOutraModalidade($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setDesabilitado($arr[$keys[12]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(PacienteTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PacienteTableMap::COL_ID)) {
            $criteria->add(PacienteTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_NOME)) {
            $criteria->add(PacienteTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_SITUACAO_ADMINIST)) {
            $criteria->add(PacienteTableMap::COL_SITUACAO_ADMINIST, $this->situacao_administ);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_POSTO_GRADUACAO)) {
            $criteria->add(PacienteTableMap::COL_POSTO_GRADUACAO, $this->posto_graduacao);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_NIP_PACIENTE)) {
            $criteria->add(PacienteTableMap::COL_NIP_PACIENTE, $this->nip_paciente);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_NIP_TITULAR)) {
            $criteria->add(PacienteTableMap::COL_NIP_TITULAR, $this->nip_titular);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_CPF_TITULAR)) {
            $criteria->add(PacienteTableMap::COL_CPF_TITULAR, $this->cpf_titular);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_ORIGEM)) {
            $criteria->add(PacienteTableMap::COL_ORIGEM, $this->origem);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_CORPO_QUADRO)) {
            $criteria->add(PacienteTableMap::COL_CORPO_QUADRO, $this->corpo_quadro);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_ATLETA)) {
            $criteria->add(PacienteTableMap::COL_ATLETA, $this->atleta);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_ATLETA_MODALIDADE)) {
            $criteria->add(PacienteTableMap::COL_ATLETA_MODALIDADE, $this->atleta_modalidade);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_OUTRA_MODALIDADE)) {
            $criteria->add(PacienteTableMap::COL_OUTRA_MODALIDADE, $this->outra_modalidade);
        }
        if ($this->isColumnModified(PacienteTableMap::COL_DISABLED)) {
            $criteria->add(PacienteTableMap::COL_DISABLED, $this->disabled);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildPacienteQuery::create();
        $criteria->add(PacienteTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Api\Models\Paciente (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setNome($this->getNome());
        $copyObj->setSituacaoAdmistrativa($this->getSituacaoAdmistrativa());
        $copyObj->setPostoGraduacao($this->getPostoGraduacao());
        $copyObj->setNip($this->getNip());
        $copyObj->setNipTitular($this->getNipTitular());
        $copyObj->setCpfTitular($this->getCpfTitular());
        $copyObj->setOrigem($this->getOrigem());
        $copyObj->setCorpoQuadro($this->getCorpoQuadro());
        $copyObj->setAtleta($this->getAtleta());
        $copyObj->setModalidade($this->getModalidade());
        $copyObj->setOutraModalidade($this->getOutraModalidade());
        $copyObj->setDesabilitado($this->getDesabilitado());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getRegistros() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRegistro($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Api\Models\Paciente Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('Registro' === $relationName) {
            $this->initRegistros();
            return;
        }
    }

    /**
     * Clears out the collRegistros collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addRegistros()
     */
    public function clearRegistros()
    {
        $this->collRegistros = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collRegistros collection loaded partially.
     *
     * @return void
     */
    public function resetPartialRegistros($v = true): void
    {
        $this->collRegistrosPartial = $v;
    }

    /**
     * Initializes the collRegistros collection.
     *
     * By default this just sets the collRegistros collection to an empty array (like clearcollRegistros());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRegistros(bool $overrideExisting = true): void
    {
        if (null !== $this->collRegistros && !$overrideExisting) {
            return;
        }

        $collectionClassName = RegistroTableMap::getTableMap()->getCollectionClassName();

        $this->collRegistros = new $collectionClassName;
        $this->collRegistros->setModel('\Api\Models\Registro');
    }

    /**
     * Gets an array of ChildRegistro objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPaciente is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRegistro[] List of ChildRegistro objects
     * @phpstan-return ObjectCollection&\Traversable<ChildRegistro> List of ChildRegistro objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getRegistros(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collRegistrosPartial && !$this->isNew();
        if (null === $this->collRegistros || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collRegistros) {
                    $this->initRegistros();
                } else {
                    $collectionClassName = RegistroTableMap::getTableMap()->getCollectionClassName();

                    $collRegistros = new $collectionClassName;
                    $collRegistros->setModel('\Api\Models\Registro');

                    return $collRegistros;
                }
            } else {
                $collRegistros = ChildRegistroQuery::create(null, $criteria)
                    ->filterByPaciente($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRegistrosPartial && count($collRegistros)) {
                        $this->initRegistros(false);

                        foreach ($collRegistros as $obj) {
                            if (false == $this->collRegistros->contains($obj)) {
                                $this->collRegistros->append($obj);
                            }
                        }

                        $this->collRegistrosPartial = true;
                    }

                    return $collRegistros;
                }

                if ($partial && $this->collRegistros) {
                    foreach ($this->collRegistros as $obj) {
                        if ($obj->isNew()) {
                            $collRegistros[] = $obj;
                        }
                    }
                }

                $this->collRegistros = $collRegistros;
                $this->collRegistrosPartial = false;
            }
        }

        return $this->collRegistros;
    }

    /**
     * Sets a collection of ChildRegistro objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $registros A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setRegistros(Collection $registros, ?ConnectionInterface $con = null)
    {
        /** @var ChildRegistro[] $registrosToDelete */
        $registrosToDelete = $this->getRegistros(new Criteria(), $con)->diff($registros);


        $this->registrosScheduledForDeletion = $registrosToDelete;

        foreach ($registrosToDelete as $registroRemoved) {
            $registroRemoved->setPaciente(null);
        }

        $this->collRegistros = null;
        foreach ($registros as $registro) {
            $this->addRegistro($registro);
        }

        $this->collRegistros = $registros;
        $this->collRegistrosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Registro objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Registro objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countRegistros(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collRegistrosPartial && !$this->isNew();
        if (null === $this->collRegistros || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRegistros) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRegistros());
            }

            $query = ChildRegistroQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPaciente($this)
                ->count($con);
        }

        return count($this->collRegistros);
    }

    /**
     * Method called to associate a ChildRegistro object to this object
     * through the ChildRegistro foreign key attribute.
     *
     * @param ChildRegistro $l ChildRegistro
     * @return $this The current object (for fluent API support)
     */
    public function addRegistro(ChildRegistro $l)
    {
        if ($this->collRegistros === null) {
            $this->initRegistros();
            $this->collRegistrosPartial = true;
        }

        if (!$this->collRegistros->contains($l)) {
            $this->doAddRegistro($l);

            if ($this->registrosScheduledForDeletion and $this->registrosScheduledForDeletion->contains($l)) {
                $this->registrosScheduledForDeletion->remove($this->registrosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildRegistro $registro The ChildRegistro object to add.
     */
    protected function doAddRegistro(ChildRegistro $registro): void
    {
        $this->collRegistros[]= $registro;
        $registro->setPaciente($this);
    }

    /**
     * @param ChildRegistro $registro The ChildRegistro object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeRegistro(ChildRegistro $registro)
    {
        if ($this->getRegistros()->contains($registro)) {
            $pos = $this->collRegistros->search($registro);
            $this->collRegistros->remove($pos);
            if (null === $this->registrosScheduledForDeletion) {
                $this->registrosScheduledForDeletion = clone $this->collRegistros;
                $this->registrosScheduledForDeletion->clear();
            }
            $this->registrosScheduledForDeletion[]= $registro;
            $registro->setPaciente(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Paciente is new, it will return
     * an empty collection; or if this Paciente has previously
     * been saved, it will retrieve related Registros from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Paciente.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRegistro[] List of ChildRegistro objects
     * @phpstan-return ObjectCollection&\Traversable<ChildRegistro}> List of ChildRegistro objects
     */
    public function getRegistrosJoinFisioterapeuta(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRegistroQuery::create(null, $criteria);
        $query->joinWith('Fisioterapeuta', $joinBehavior);

        return $this->getRegistros($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->id = null;
        $this->nome = null;
        $this->situacao_administ = null;
        $this->posto_graduacao = null;
        $this->nip_paciente = null;
        $this->nip_titular = null;
        $this->cpf_titular = null;
        $this->origem = null;
        $this->corpo_quadro = null;
        $this->atleta = null;
        $this->atleta_modalidade = null;
        $this->outra_modalidade = null;
        $this->disabled = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collRegistros) {
                foreach ($this->collRegistros as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collRegistros = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PacienteTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
