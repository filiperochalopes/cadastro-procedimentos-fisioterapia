<?php

namespace Api\Models\Base;

use \DateTime;
use \Exception;
use \PDO;
use Api\Models\Fisioterapeuta as ChildFisioterapeuta;
use Api\Models\FisioterapeutaQuery as ChildFisioterapeutaQuery;
use Api\Models\Paciente as ChildPaciente;
use Api\Models\PacienteQuery as ChildPacienteQuery;
use Api\Models\Procedimento as ChildProcedimento;
use Api\Models\ProcedimentoQuery as ChildProcedimentoQuery;
use Api\Models\Registro as ChildRegistro;
use Api\Models\RegistroProcedimento as ChildRegistroProcedimento;
use Api\Models\RegistroProcedimentoQuery as ChildRegistroProcedimentoQuery;
use Api\Models\RegistroQuery as ChildRegistroQuery;
use Api\Models\Map\RegistroProcedimentoTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'registros' table.
 *
 *
 *
 * @package    propel.generator.Api.Models.Base
 */
abstract class Registro implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Api\\Models\\Map\\RegistroTableMap';


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
     * The value for the paciente field.
     *
     * @var        string|null
     */
    protected $paciente;

    /**
     * The value for the procedimentos field.
     *
     * @var        string|null
     */
    protected $procedimentos;

    /**
     * The value for the fisioterapeuta_id field.
     *
     * @var        int|null
     */
    protected $fisioterapeuta_id;

    /**
     * The value for the paciente_id field.
     *
     * @var        int|null
     */
    protected $paciente_id;

    /**
     * The value for the tipo_atendimento field.
     *
     * @var        string|null
     */
    protected $tipo_atendimento;

    /**
     * The value for the comparecimento field.
     *
     * @var        string|null
     */
    protected $comparecimento;

    /**
     * The value for the tipo_falta field.
     *
     * @var        string|null
     */
    protected $tipo_falta;

    /**
     * The value for the data field.
     *
     * @var        DateTime|null
     */
    protected $data;

    /**
     * The value for the turno field.
     *
     * @var        string|null
     */
    protected $turno;

    /**
     * @var        ChildFisioterapeuta
     */
    protected $aFisioterapeuta;

    /**
     * @var        ChildPaciente
     */
    protected $aPaciente;

    /**
     * @var        ObjectCollection|ChildRegistroProcedimento[] Collection to store aggregation of ChildRegistroProcedimento objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildRegistroProcedimento> Collection to store aggregation of ChildRegistroProcedimento objects.
     */
    protected $collRegistroProcedimentos;
    protected $collRegistroProcedimentosPartial;

    /**
     * @var        ObjectCollection|ChildProcedimento[] Cross Collection to store aggregation of ChildProcedimento objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProcedimento> Cross Collection to store aggregation of ChildProcedimento objects.
     */
    protected $collProcedimentos;

    /**
     * @var bool
     */
    protected $collProcedimentosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProcedimento[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProcedimento>
     */
    protected $procedimentosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRegistroProcedimento[]
     * @phpstan-var ObjectCollection&\Traversable<ChildRegistroProcedimento>
     */
    protected $registroProcedimentosScheduledForDeletion = null;

    /**
     * Initializes internal state of Api\Models\Base\Registro object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>Registro</code> instance.  If
     * <code>obj</code> is an instance of <code>Registro</code>, delegates to
     * <code>equals(Registro)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [paciente] column value.
     *
     * @return string|null
     */
    public function getPacienteDeprecated()
    {
        return $this->paciente;
    }

    /**
     * Get the [procedimentos] column value.
     *
     * @return string|null
     */
    public function getProcedimentos()
    {
        return $this->procedimentos;
    }

    /**
     * Get the [fisioterapeuta_id] column value.
     *
     * @return int|null
     */
    public function getFisioterapeutaId()
    {
        return $this->fisioterapeuta_id;
    }

    /**
     * Get the [paciente_id] column value.
     *
     * @return int|null
     */
    public function getPacienteId()
    {
        return $this->paciente_id;
    }

    /**
     * Get the [tipo_atendimento] column value.
     *
     * @return string|null
     */
    public function getTipoAtendimento()
    {
        return $this->tipo_atendimento;
    }

    /**
     * Get the [comparecimento] column value.
     *
     * @return string|null
     */
    public function getComparecimento()
    {
        return $this->comparecimento;
    }

    /**
     * Get the [tipo_falta] column value.
     *
     * @return string|null
     */
    public function getTipoFalta()
    {
        return $this->tipo_falta;
    }

    /**
     * Get the [optionally formatted] temporal [data] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getData($format = null)
    {
        if ($format === null) {
            return $this->data;
        } else {
            return $this->data instanceof \DateTimeInterface ? $this->data->format($format) : null;
        }
    }

    /**
     * Get the [turno] column value.
     *
     * @return string|null
     */
    public function getTurno()
    {
        return $this->turno;
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
            $this->modifiedColumns[RegistroTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [paciente] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPacienteDeprecated($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->paciente !== $v) {
            $this->paciente = $v;
            $this->modifiedColumns[RegistroTableMap::COL_PACIENTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimentos] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimentos($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimentos !== $v) {
            $this->procedimentos = $v;
            $this->modifiedColumns[RegistroTableMap::COL_PROCEDIMENTOS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fisioterapeuta_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFisioterapeutaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fisioterapeuta_id !== $v) {
            $this->fisioterapeuta_id = $v;
            $this->modifiedColumns[RegistroTableMap::COL_FISIOTERAPEUTA_ID] = true;
        }

        if ($this->aFisioterapeuta !== null && $this->aFisioterapeuta->getId() !== $v) {
            $this->aFisioterapeuta = null;
        }

        return $this;
    }

    /**
     * Set the value of [paciente_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPacienteId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->paciente_id !== $v) {
            $this->paciente_id = $v;
            $this->modifiedColumns[RegistroTableMap::COL_PACIENTE_ID] = true;
        }

        if ($this->aPaciente !== null && $this->aPaciente->getId() !== $v) {
            $this->aPaciente = null;
        }

        return $this;
    }

    /**
     * Set the value of [tipo_atendimento] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTipoAtendimento($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tipo_atendimento !== $v) {
            $this->tipo_atendimento = $v;
            $this->modifiedColumns[RegistroTableMap::COL_TIPO_ATENDIMENTO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [comparecimento] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setComparecimento($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comparecimento !== $v) {
            $this->comparecimento = $v;
            $this->modifiedColumns[RegistroTableMap::COL_COMPARECIMENTO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tipo_falta] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTipoFalta($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tipo_falta !== $v) {
            $this->tipo_falta = $v;
            $this->modifiedColumns[RegistroTableMap::COL_TIPO_FALTA] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [data] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setData($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->data !== null || $dt !== null) {
            if ($this->data === null || $dt === null || $dt->format("Y-m-d") !== $this->data->format("Y-m-d")) {
                $this->data = $dt === null ? null : clone $dt;
                $this->modifiedColumns[RegistroTableMap::COL_DATA] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [turno] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTurno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->turno !== $v) {
            $this->turno = $v;
            $this->modifiedColumns[RegistroTableMap::COL_TURNO] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RegistroTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RegistroTableMap::translateFieldName('PacienteDeprecated', TableMap::TYPE_PHPNAME, $indexType)];
            $this->paciente = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RegistroTableMap::translateFieldName('Procedimentos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimentos = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RegistroTableMap::translateFieldName('FisioterapeutaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fisioterapeuta_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RegistroTableMap::translateFieldName('PacienteId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->paciente_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RegistroTableMap::translateFieldName('TipoAtendimento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tipo_atendimento = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RegistroTableMap::translateFieldName('Comparecimento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comparecimento = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RegistroTableMap::translateFieldName('TipoFalta', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tipo_falta = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : RegistroTableMap::translateFieldName('Data', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->data = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : RegistroTableMap::translateFieldName('Turno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->turno = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = RegistroTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Api\\Models\\Registro'), 0, $e);
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
        if ($this->aFisioterapeuta !== null && $this->fisioterapeuta_id !== $this->aFisioterapeuta->getId()) {
            $this->aFisioterapeuta = null;
        }
        if ($this->aPaciente !== null && $this->paciente_id !== $this->aPaciente->getId()) {
            $this->aPaciente = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(RegistroTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildRegistroQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFisioterapeuta = null;
            $this->aPaciente = null;
            $this->collRegistroProcedimentos = null;

            $this->collProcedimentos = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Registro::setDeleted()
     * @see Registro::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildRegistroQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroTableMap::DATABASE_NAME);
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
                RegistroTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aFisioterapeuta !== null) {
                if ($this->aFisioterapeuta->isModified() || $this->aFisioterapeuta->isNew()) {
                    $affectedRows += $this->aFisioterapeuta->save($con);
                }
                $this->setFisioterapeuta($this->aFisioterapeuta);
            }

            if ($this->aPaciente !== null) {
                if ($this->aPaciente->isModified() || $this->aPaciente->isNew()) {
                    $affectedRows += $this->aPaciente->save($con);
                }
                $this->setPaciente($this->aPaciente);
            }

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

            if ($this->procedimentosScheduledForDeletion !== null) {
                if (!$this->procedimentosScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->procedimentosScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \Api\Models\RegistroProcedimentoQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->procedimentosScheduledForDeletion = null;
                }

            }

            if ($this->collProcedimentos) {
                foreach ($this->collProcedimentos as $procedimento) {
                    if (!$procedimento->isDeleted() && ($procedimento->isNew() || $procedimento->isModified())) {
                        $procedimento->save($con);
                    }
                }
            }


            if ($this->registroProcedimentosScheduledForDeletion !== null) {
                if (!$this->registroProcedimentosScheduledForDeletion->isEmpty()) {
                    \Api\Models\RegistroProcedimentoQuery::create()
                        ->filterByPrimaryKeys($this->registroProcedimentosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->registroProcedimentosScheduledForDeletion = null;
                }
            }

            if ($this->collRegistroProcedimentos !== null) {
                foreach ($this->collRegistroProcedimentos as $referrerFK) {
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

        $this->modifiedColumns[RegistroTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RegistroTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RegistroTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_PACIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'paciente';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_PROCEDIMENTOS)) {
            $modifiedColumns[':p' . $index++]  = 'procedimentos';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_FISIOTERAPEUTA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'fisioterapeuta_id';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_PACIENTE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'paciente_id';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_TIPO_ATENDIMENTO)) {
            $modifiedColumns[':p' . $index++]  = 'tipo_atendimento';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_COMPARECIMENTO)) {
            $modifiedColumns[':p' . $index++]  = 'comparecimento';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_TIPO_FALTA)) {
            $modifiedColumns[':p' . $index++]  = 'tipo_falta';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'data';
        }
        if ($this->isColumnModified(RegistroTableMap::COL_TURNO)) {
            $modifiedColumns[':p' . $index++]  = 'turno';
        }

        $sql = sprintf(
            'INSERT INTO registros (%s) VALUES (%s)',
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
                    case 'paciente':
                        $stmt->bindValue($identifier, $this->paciente, PDO::PARAM_STR);
                        break;
                    case 'procedimentos':
                        $stmt->bindValue($identifier, $this->procedimentos, PDO::PARAM_STR);
                        break;
                    case 'fisioterapeuta_id':
                        $stmt->bindValue($identifier, $this->fisioterapeuta_id, PDO::PARAM_INT);
                        break;
                    case 'paciente_id':
                        $stmt->bindValue($identifier, $this->paciente_id, PDO::PARAM_INT);
                        break;
                    case 'tipo_atendimento':
                        $stmt->bindValue($identifier, $this->tipo_atendimento, PDO::PARAM_STR);
                        break;
                    case 'comparecimento':
                        $stmt->bindValue($identifier, $this->comparecimento, PDO::PARAM_STR);
                        break;
                    case 'tipo_falta':
                        $stmt->bindValue($identifier, $this->tipo_falta, PDO::PARAM_STR);
                        break;
                    case 'data':
                        $stmt->bindValue($identifier, $this->data ? $this->data->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'turno':
                        $stmt->bindValue($identifier, $this->turno, PDO::PARAM_STR);
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
        $pos = RegistroTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPacienteDeprecated();

            case 2:
                return $this->getProcedimentos();

            case 3:
                return $this->getFisioterapeutaId();

            case 4:
                return $this->getPacienteId();

            case 5:
                return $this->getTipoAtendimento();

            case 6:
                return $this->getComparecimento();

            case 7:
                return $this->getTipoFalta();

            case 8:
                return $this->getData();

            case 9:
                return $this->getTurno();

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
        if (isset($alreadyDumpedObjects['Registro'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Registro'][$this->hashCode()] = true;
        $keys = RegistroTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPacienteDeprecated(),
            $keys[2] => $this->getProcedimentos(),
            $keys[3] => $this->getFisioterapeutaId(),
            $keys[4] => $this->getPacienteId(),
            $keys[5] => $this->getTipoAtendimento(),
            $keys[6] => $this->getComparecimento(),
            $keys[7] => $this->getTipoFalta(),
            $keys[8] => $this->getData(),
            $keys[9] => $this->getTurno(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aFisioterapeuta) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'fisioterapeuta';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'fisioterapeutas';
                        break;
                    default:
                        $key = 'Fisioterapeuta';
                }

                $result[$key] = $this->aFisioterapeuta->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPaciente) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'paciente';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pacientes';
                        break;
                    default:
                        $key = 'Paciente';
                }

                $result[$key] = $this->aPaciente->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collRegistroProcedimentos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'registroProcedimentos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'registro_procedimentos';
                        break;
                    default:
                        $key = 'RegistroProcedimentos';
                }

                $result[$key] = $this->collRegistroProcedimentos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = RegistroTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setPacienteDeprecated($value);
                break;
            case 2:
                $this->setProcedimentos($value);
                break;
            case 3:
                $this->setFisioterapeutaId($value);
                break;
            case 4:
                $this->setPacienteId($value);
                break;
            case 5:
                $this->setTipoAtendimento($value);
                break;
            case 6:
                $this->setComparecimento($value);
                break;
            case 7:
                $this->setTipoFalta($value);
                break;
            case 8:
                $this->setData($value);
                break;
            case 9:
                $this->setTurno($value);
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
        $keys = RegistroTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPacienteDeprecated($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setProcedimentos($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFisioterapeutaId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPacienteId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTipoAtendimento($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setComparecimento($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTipoFalta($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setData($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setTurno($arr[$keys[9]]);
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
        $criteria = new Criteria(RegistroTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RegistroTableMap::COL_ID)) {
            $criteria->add(RegistroTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_PACIENTE)) {
            $criteria->add(RegistroTableMap::COL_PACIENTE, $this->paciente);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_PROCEDIMENTOS)) {
            $criteria->add(RegistroTableMap::COL_PROCEDIMENTOS, $this->procedimentos);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_FISIOTERAPEUTA_ID)) {
            $criteria->add(RegistroTableMap::COL_FISIOTERAPEUTA_ID, $this->fisioterapeuta_id);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_PACIENTE_ID)) {
            $criteria->add(RegistroTableMap::COL_PACIENTE_ID, $this->paciente_id);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_TIPO_ATENDIMENTO)) {
            $criteria->add(RegistroTableMap::COL_TIPO_ATENDIMENTO, $this->tipo_atendimento);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_COMPARECIMENTO)) {
            $criteria->add(RegistroTableMap::COL_COMPARECIMENTO, $this->comparecimento);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_TIPO_FALTA)) {
            $criteria->add(RegistroTableMap::COL_TIPO_FALTA, $this->tipo_falta);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_DATA)) {
            $criteria->add(RegistroTableMap::COL_DATA, $this->data);
        }
        if ($this->isColumnModified(RegistroTableMap::COL_TURNO)) {
            $criteria->add(RegistroTableMap::COL_TURNO, $this->turno);
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
        $criteria = ChildRegistroQuery::create();
        $criteria->add(RegistroTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \Api\Models\Registro (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setPacienteDeprecated($this->getPacienteDeprecated());
        $copyObj->setProcedimentos($this->getProcedimentos());
        $copyObj->setFisioterapeutaId($this->getFisioterapeutaId());
        $copyObj->setPacienteId($this->getPacienteId());
        $copyObj->setTipoAtendimento($this->getTipoAtendimento());
        $copyObj->setComparecimento($this->getComparecimento());
        $copyObj->setTipoFalta($this->getTipoFalta());
        $copyObj->setData($this->getData());
        $copyObj->setTurno($this->getTurno());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getRegistroProcedimentos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRegistroProcedimento($relObj->copy($deepCopy));
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
     * @return \Api\Models\Registro Clone of current object.
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
     * Declares an association between this object and a ChildFisioterapeuta object.
     *
     * @param ChildFisioterapeuta|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setFisioterapeuta(ChildFisioterapeuta $v = null)
    {
        if ($v === null) {
            $this->setFisioterapeutaId(NULL);
        } else {
            $this->setFisioterapeutaId($v->getId());
        }

        $this->aFisioterapeuta = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFisioterapeuta object, it will not be re-added.
        if ($v !== null) {
            $v->addRegistro($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFisioterapeuta object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildFisioterapeuta|null The associated ChildFisioterapeuta object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getFisioterapeuta(?ConnectionInterface $con = null)
    {
        if ($this->aFisioterapeuta === null && ($this->fisioterapeuta_id != 0)) {
            $this->aFisioterapeuta = ChildFisioterapeutaQuery::create()->findPk($this->fisioterapeuta_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFisioterapeuta->addRegistros($this);
             */
        }

        return $this->aFisioterapeuta;
    }

    /**
     * Declares an association between this object and a ChildPaciente object.
     *
     * @param ChildPaciente|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPaciente(ChildPaciente $v = null)
    {
        if ($v === null) {
            $this->setPacienteId(NULL);
        } else {
            $this->setPacienteId($v->getId());
        }

        $this->aPaciente = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPaciente object, it will not be re-added.
        if ($v !== null) {
            $v->addRegistro($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPaciente object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildPaciente|null The associated ChildPaciente object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPaciente(?ConnectionInterface $con = null)
    {
        if ($this->aPaciente === null && ($this->paciente_id != 0)) {
            $this->aPaciente = ChildPacienteQuery::create()->findPk($this->paciente_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPaciente->addRegistros($this);
             */
        }

        return $this->aPaciente;
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
        if ('RegistroProcedimento' === $relationName) {
            $this->initRegistroProcedimentos();
            return;
        }
    }

    /**
     * Clears out the collRegistroProcedimentos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addRegistroProcedimentos()
     */
    public function clearRegistroProcedimentos()
    {
        $this->collRegistroProcedimentos = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collRegistroProcedimentos collection loaded partially.
     *
     * @return void
     */
    public function resetPartialRegistroProcedimentos($v = true): void
    {
        $this->collRegistroProcedimentosPartial = $v;
    }

    /**
     * Initializes the collRegistroProcedimentos collection.
     *
     * By default this just sets the collRegistroProcedimentos collection to an empty array (like clearcollRegistroProcedimentos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRegistroProcedimentos(bool $overrideExisting = true): void
    {
        if (null !== $this->collRegistroProcedimentos && !$overrideExisting) {
            return;
        }

        $collectionClassName = RegistroProcedimentoTableMap::getTableMap()->getCollectionClassName();

        $this->collRegistroProcedimentos = new $collectionClassName;
        $this->collRegistroProcedimentos->setModel('\Api\Models\RegistroProcedimento');
    }

    /**
     * Gets an array of ChildRegistroProcedimento objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRegistro is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRegistroProcedimento[] List of ChildRegistroProcedimento objects
     * @phpstan-return ObjectCollection&\Traversable<ChildRegistroProcedimento> List of ChildRegistroProcedimento objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getRegistroProcedimentos(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collRegistroProcedimentosPartial && !$this->isNew();
        if (null === $this->collRegistroProcedimentos || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collRegistroProcedimentos) {
                    $this->initRegistroProcedimentos();
                } else {
                    $collectionClassName = RegistroProcedimentoTableMap::getTableMap()->getCollectionClassName();

                    $collRegistroProcedimentos = new $collectionClassName;
                    $collRegistroProcedimentos->setModel('\Api\Models\RegistroProcedimento');

                    return $collRegistroProcedimentos;
                }
            } else {
                $collRegistroProcedimentos = ChildRegistroProcedimentoQuery::create(null, $criteria)
                    ->filterByRegistro($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRegistroProcedimentosPartial && count($collRegistroProcedimentos)) {
                        $this->initRegistroProcedimentos(false);

                        foreach ($collRegistroProcedimentos as $obj) {
                            if (false == $this->collRegistroProcedimentos->contains($obj)) {
                                $this->collRegistroProcedimentos->append($obj);
                            }
                        }

                        $this->collRegistroProcedimentosPartial = true;
                    }

                    return $collRegistroProcedimentos;
                }

                if ($partial && $this->collRegistroProcedimentos) {
                    foreach ($this->collRegistroProcedimentos as $obj) {
                        if ($obj->isNew()) {
                            $collRegistroProcedimentos[] = $obj;
                        }
                    }
                }

                $this->collRegistroProcedimentos = $collRegistroProcedimentos;
                $this->collRegistroProcedimentosPartial = false;
            }
        }

        return $this->collRegistroProcedimentos;
    }

    /**
     * Sets a collection of ChildRegistroProcedimento objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $registroProcedimentos A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setRegistroProcedimentos(Collection $registroProcedimentos, ?ConnectionInterface $con = null)
    {
        /** @var ChildRegistroProcedimento[] $registroProcedimentosToDelete */
        $registroProcedimentosToDelete = $this->getRegistroProcedimentos(new Criteria(), $con)->diff($registroProcedimentos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->registroProcedimentosScheduledForDeletion = clone $registroProcedimentosToDelete;

        foreach ($registroProcedimentosToDelete as $registroProcedimentoRemoved) {
            $registroProcedimentoRemoved->setRegistro(null);
        }

        $this->collRegistroProcedimentos = null;
        foreach ($registroProcedimentos as $registroProcedimento) {
            $this->addRegistroProcedimento($registroProcedimento);
        }

        $this->collRegistroProcedimentos = $registroProcedimentos;
        $this->collRegistroProcedimentosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RegistroProcedimento objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related RegistroProcedimento objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countRegistroProcedimentos(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collRegistroProcedimentosPartial && !$this->isNew();
        if (null === $this->collRegistroProcedimentos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRegistroProcedimentos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRegistroProcedimentos());
            }

            $query = ChildRegistroProcedimentoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRegistro($this)
                ->count($con);
        }

        return count($this->collRegistroProcedimentos);
    }

    /**
     * Method called to associate a ChildRegistroProcedimento object to this object
     * through the ChildRegistroProcedimento foreign key attribute.
     *
     * @param ChildRegistroProcedimento $l ChildRegistroProcedimento
     * @return $this The current object (for fluent API support)
     */
    public function addRegistroProcedimento(ChildRegistroProcedimento $l)
    {
        if ($this->collRegistroProcedimentos === null) {
            $this->initRegistroProcedimentos();
            $this->collRegistroProcedimentosPartial = true;
        }

        if (!$this->collRegistroProcedimentos->contains($l)) {
            $this->doAddRegistroProcedimento($l);

            if ($this->registroProcedimentosScheduledForDeletion and $this->registroProcedimentosScheduledForDeletion->contains($l)) {
                $this->registroProcedimentosScheduledForDeletion->remove($this->registroProcedimentosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildRegistroProcedimento $registroProcedimento The ChildRegistroProcedimento object to add.
     */
    protected function doAddRegistroProcedimento(ChildRegistroProcedimento $registroProcedimento): void
    {
        $this->collRegistroProcedimentos[]= $registroProcedimento;
        $registroProcedimento->setRegistro($this);
    }

    /**
     * @param ChildRegistroProcedimento $registroProcedimento The ChildRegistroProcedimento object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeRegistroProcedimento(ChildRegistroProcedimento $registroProcedimento)
    {
        if ($this->getRegistroProcedimentos()->contains($registroProcedimento)) {
            $pos = $this->collRegistroProcedimentos->search($registroProcedimento);
            $this->collRegistroProcedimentos->remove($pos);
            if (null === $this->registroProcedimentosScheduledForDeletion) {
                $this->registroProcedimentosScheduledForDeletion = clone $this->collRegistroProcedimentos;
                $this->registroProcedimentosScheduledForDeletion->clear();
            }
            $this->registroProcedimentosScheduledForDeletion[]= clone $registroProcedimento;
            $registroProcedimento->setRegistro(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Registro is new, it will return
     * an empty collection; or if this Registro has previously
     * been saved, it will retrieve related RegistroProcedimentos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Registro.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRegistroProcedimento[] List of ChildRegistroProcedimento objects
     * @phpstan-return ObjectCollection&\Traversable<ChildRegistroProcedimento}> List of ChildRegistroProcedimento objects
     */
    public function getRegistroProcedimentosJoinProcedimento(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRegistroProcedimentoQuery::create(null, $criteria);
        $query->joinWith('Procedimento', $joinBehavior);

        return $this->getRegistroProcedimentos($query, $con);
    }

    /**
     * Clears out the collProcedimentos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProcedimentos()
     */
    public function clearProcedimentos()
    {
        $this->collProcedimentos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collProcedimentos crossRef collection.
     *
     * By default this just sets the collProcedimentos collection to an empty collection (like clearProcedimentos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initProcedimentos()
    {
        $collectionClassName = RegistroProcedimentoTableMap::getTableMap()->getCollectionClassName();

        $this->collProcedimentos = new $collectionClassName;
        $this->collProcedimentosPartial = true;
        $this->collProcedimentos->setModel('\Api\Models\Procedimento');
    }

    /**
     * Checks if the collProcedimentos collection is loaded.
     *
     * @return bool
     */
    public function isProcedimentosLoaded(): bool
    {
        return null !== $this->collProcedimentos;
    }

    /**
     * Gets a collection of ChildProcedimento objects related by a many-to-many relationship
     * to the current object by way of the registro_procedimento cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRegistro is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildProcedimento[] List of ChildProcedimento objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProcedimento> List of ChildProcedimento objects
     */
    public function getProcedimentos(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProcedimentosPartial && !$this->isNew();
        if (null === $this->collProcedimentos || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProcedimentos) {
                    $this->initProcedimentos();
                }
            } else {

                $query = ChildProcedimentoQuery::create(null, $criteria)
                    ->filterByRegistro($this);
                $collProcedimentos = $query->find($con);
                if (null !== $criteria) {
                    return $collProcedimentos;
                }

                if ($partial && $this->collProcedimentos) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collProcedimentos as $obj) {
                        if (!$collProcedimentos->contains($obj)) {
                            $collProcedimentos[] = $obj;
                        }
                    }
                }

                $this->collProcedimentos = $collProcedimentos;
                $this->collProcedimentosPartial = false;
            }
        }

        return $this->collProcedimentos;
    }

    /**
     * Sets a collection of Procedimento objects related by a many-to-many relationship
     * to the current object by way of the registro_procedimento cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $procedimentos A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimentos(Collection $procedimentos, ?ConnectionInterface $con = null)
    {
        $this->clearProcedimentos();
        $currentProcedimentos = $this->getProcedimentos();

        $procedimentosScheduledForDeletion = $currentProcedimentos->diff($procedimentos);

        foreach ($procedimentosScheduledForDeletion as $toDelete) {
            $this->removeProcedimento($toDelete);
        }

        foreach ($procedimentos as $procedimento) {
            if (!$currentProcedimentos->contains($procedimento)) {
                $this->doAddProcedimento($procedimento);
            }
        }

        $this->collProcedimentosPartial = false;
        $this->collProcedimentos = $procedimentos;

        return $this;
    }

    /**
     * Gets the number of Procedimento objects related by a many-to-many relationship
     * to the current object by way of the registro_procedimento cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related Procedimento objects
     */
    public function countProcedimentos(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProcedimentosPartial && !$this->isNew();
        if (null === $this->collProcedimentos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProcedimentos) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getProcedimentos());
                }

                $query = ChildProcedimentoQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByRegistro($this)
                    ->count($con);
            }
        } else {
            return count($this->collProcedimentos);
        }
    }

    /**
     * Associate a ChildProcedimento to this object
     * through the registro_procedimento cross reference table.
     *
     * @param ChildProcedimento $procedimento
     * @return ChildRegistro The current object (for fluent API support)
     */
    public function addProcedimento(ChildProcedimento $procedimento)
    {
        if ($this->collProcedimentos === null) {
            $this->initProcedimentos();
        }

        if (!$this->getProcedimentos()->contains($procedimento)) {
            // only add it if the **same** object is not already associated
            $this->collProcedimentos->push($procedimento);
            $this->doAddProcedimento($procedimento);
        }

        return $this;
    }

    /**
     *
     * @param ChildProcedimento $procedimento
     */
    protected function doAddProcedimento(ChildProcedimento $procedimento)
    {
        $registroProcedimento = new ChildRegistroProcedimento();

        $registroProcedimento->setProcedimento($procedimento);

        $registroProcedimento->setRegistro($this);

        $this->addRegistroProcedimento($registroProcedimento);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$procedimento->isRegistrosLoaded()) {
            $procedimento->initRegistros();
            $procedimento->getRegistros()->push($this);
        } elseif (!$procedimento->getRegistros()->contains($this)) {
            $procedimento->getRegistros()->push($this);
        }

    }

    /**
     * Remove procedimento of this object
     * through the registro_procedimento cross reference table.
     *
     * @param ChildProcedimento $procedimento
     * @return ChildRegistro The current object (for fluent API support)
     */
    public function removeProcedimento(ChildProcedimento $procedimento)
    {
        if ($this->getProcedimentos()->contains($procedimento)) {
            $registroProcedimento = new ChildRegistroProcedimento();
            $registroProcedimento->setProcedimento($procedimento);
            if ($procedimento->isRegistrosLoaded()) {
                //remove the back reference if available
                $procedimento->getRegistros()->removeObject($this);
            }

            $registroProcedimento->setRegistro($this);
            $this->removeRegistroProcedimento(clone $registroProcedimento);
            $registroProcedimento->clear();

            $this->collProcedimentos->remove($this->collProcedimentos->search($procedimento));

            if (null === $this->procedimentosScheduledForDeletion) {
                $this->procedimentosScheduledForDeletion = clone $this->collProcedimentos;
                $this->procedimentosScheduledForDeletion->clear();
            }

            $this->procedimentosScheduledForDeletion->push($procedimento);
        }


        return $this;
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
        if (null !== $this->aFisioterapeuta) {
            $this->aFisioterapeuta->removeRegistro($this);
        }
        if (null !== $this->aPaciente) {
            $this->aPaciente->removeRegistro($this);
        }
        $this->id = null;
        $this->paciente = null;
        $this->procedimentos = null;
        $this->fisioterapeuta_id = null;
        $this->paciente_id = null;
        $this->tipo_atendimento = null;
        $this->comparecimento = null;
        $this->tipo_falta = null;
        $this->data = null;
        $this->turno = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
            if ($this->collRegistroProcedimentos) {
                foreach ($this->collRegistroProcedimentos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProcedimentos) {
                foreach ($this->collProcedimentos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collRegistroProcedimentos = null;
        $this->collProcedimentos = null;
        $this->aFisioterapeuta = null;
        $this->aPaciente = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RegistroTableMap::DEFAULT_STRING_FORMAT);
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
