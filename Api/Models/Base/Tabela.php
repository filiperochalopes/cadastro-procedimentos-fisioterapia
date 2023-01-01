<?php

namespace Api\Models\Base;

use \Exception;
use \PDO;
use Api\Models\TabelaQuery as ChildTabelaQuery;
use Api\Models\Map\TabelaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'tabela' table.
 *
 *
 *
 * @package    propel.generator.Api.Models.Base
 */
abstract class Tabela implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Api\\Models\\Map\\TabelaTableMap';


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
     * The value for the data field.
     *
     * @var        string|null
     */
    protected $data;

    /**
     * The value for the turno field.
     *
     * @var        string
     */
    protected $turno;

    /**
     * The value for the fisioterapeuta field.
     *
     * @var        string|null
     */
    protected $fisioterapeuta;

    /**
     * The value for the nome_paciente field.
     *
     * @var        string|null
     */
    protected $nome_paciente;

    /**
     * The value for the tipo_atendimento field.
     *
     * @var        string|null
     */
    protected $tipo_atendimento;

    /**
     * The value for the situacao_administrativa field.
     *
     * @var        string|null
     */
    protected $situacao_administrativa;

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
     * The value for the posto_graduacao field.
     *
     * @var        string|null
     */
    protected $posto_graduacao;

    /**
     * The value for the atleta field.
     *
     * @var        string|null
     */
    protected $atleta;

    /**
     * The value for the modalidade field.
     *
     * @var        string|null
     */
    protected $modalidade;

    /**
     * The value for the outra_modalidade field.
     *
     * @var        string|null
     */
    protected $outra_modalidade;

    /**
     * The value for the comparecimento field.
     *
     * @var        boolean|null
     */
    protected $comparecimento;

    /**
     * The value for the tipo_falta field.
     *
     * @var        string
     */
    protected $tipo_falta;

    /**
     * The value for the procedimento_1 field.
     *
     * @var        string|null
     */
    protected $procedimento_1;

    /**
     * The value for the procedimento_2 field.
     *
     * @var        string|null
     */
    protected $procedimento_2;

    /**
     * The value for the procedimento_3 field.
     *
     * @var        string|null
     */
    protected $procedimento_3;

    /**
     * The value for the procedimento_4 field.
     *
     * @var        string|null
     */
    protected $procedimento_4;

    /**
     * The value for the procedimento_5 field.
     *
     * @var        string|null
     */
    protected $procedimento_5;

    /**
     * The value for the procedimento_6 field.
     *
     * @var        string|null
     */
    protected $procedimento_6;

    /**
     * The value for the procedimento_7 field.
     *
     * @var        string|null
     */
    protected $procedimento_7;

    /**
     * The value for the procedimento_8 field.
     *
     * @var        string|null
     */
    protected $procedimento_8;

    /**
     * The value for the procedimento_9 field.
     *
     * @var        string|null
     */
    protected $procedimento_9;

    /**
     * The value for the procedimento_10 field.
     *
     * @var        string|null
     */
    protected $procedimento_10;

    /**
     * The value for the procedimento_11 field.
     *
     * @var        string|null
     */
    protected $procedimento_11;

    /**
     * The value for the procedimento_12 field.
     *
     * @var        string|null
     */
    protected $procedimento_12;

    /**
     * The value for the procedimento_13 field.
     *
     * @var        string|null
     */
    protected $procedimento_13;

    /**
     * The value for the procedimento_14 field.
     *
     * @var        string|null
     */
    protected $procedimento_14;

    /**
     * The value for the procedimento_15 field.
     *
     * @var        string|null
     */
    protected $procedimento_15;

    /**
     * The value for the procedimento_16 field.
     *
     * @var        string|null
     */
    protected $procedimento_16;

    /**
     * The value for the procedimento_17 field.
     *
     * @var        string|null
     */
    protected $procedimento_17;

    /**
     * The value for the procedimento_18 field.
     *
     * @var        string|null
     */
    protected $procedimento_18;

    /**
     * The value for the procedimento_19 field.
     *
     * @var        string|null
     */
    protected $procedimento_19;

    /**
     * The value for the procedimento_20 field.
     *
     * @var        string|null
     */
    protected $procedimento_20;

    /**
     * The value for the total_procedimentos field.
     *
     * @var        int|null
     */
    protected $total_procedimentos;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Api\Models\Base\Tabela object.
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
     * Compares this with another <code>Tabela</code> instance.  If
     * <code>obj</code> is an instance of <code>Tabela</code>, delegates to
     * <code>equals(Tabela)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [data] column value.
     *
     * @return string|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the [turno] column value.
     *
     * @return string
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Get the [fisioterapeuta] column value.
     *
     * @return string|null
     */
    public function getFisioterapeuta()
    {
        return $this->fisioterapeuta;
    }

    /**
     * Get the [nome_paciente] column value.
     *
     * @return string|null
     */
    public function getNomePaciente()
    {
        return $this->nome_paciente;
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
     * Get the [situacao_administrativa] column value.
     *
     * @return string|null
     */
    public function getSituacaoAdministrativa()
    {
        return $this->situacao_administrativa;
    }

    /**
     * Get the [nip_paciente] column value.
     *
     * @return string|null
     */
    public function getNipPaciente()
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
     * Get the [posto_graduacao] column value.
     *
     * @return string|null
     */
    public function getPostoGraduacao()
    {
        return $this->posto_graduacao;
    }

    /**
     * Get the [atleta] column value.
     *
     * @return string|null
     */
    public function getAtleta()
    {
        return $this->atleta;
    }

    /**
     * Get the [modalidade] column value.
     *
     * @return string|null
     */
    public function getModalidade()
    {
        return $this->modalidade;
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
     * Get the [comparecimento] column value.
     *
     * @return boolean|null
     */
    public function getComparecimento()
    {
        return $this->comparecimento;
    }

    /**
     * Get the [comparecimento] column value.
     *
     * @return boolean|null
     */
    public function isComparecimento()
    {
        return $this->getComparecimento();
    }

    /**
     * Get the [tipo_falta] column value.
     *
     * @return string
     */
    public function getTipoFalta()
    {
        return $this->tipo_falta;
    }

    /**
     * Get the [procedimento_1] column value.
     *
     * @return string|null
     */
    public function getProcedimento1()
    {
        return $this->procedimento_1;
    }

    /**
     * Get the [procedimento_2] column value.
     *
     * @return string|null
     */
    public function getProcedimento2()
    {
        return $this->procedimento_2;
    }

    /**
     * Get the [procedimento_3] column value.
     *
     * @return string|null
     */
    public function getProcedimento3()
    {
        return $this->procedimento_3;
    }

    /**
     * Get the [procedimento_4] column value.
     *
     * @return string|null
     */
    public function getProcedimento4()
    {
        return $this->procedimento_4;
    }

    /**
     * Get the [procedimento_5] column value.
     *
     * @return string|null
     */
    public function getProcedimento5()
    {
        return $this->procedimento_5;
    }

    /**
     * Get the [procedimento_6] column value.
     *
     * @return string|null
     */
    public function getProcedimento6()
    {
        return $this->procedimento_6;
    }

    /**
     * Get the [procedimento_7] column value.
     *
     * @return string|null
     */
    public function getProcedimento7()
    {
        return $this->procedimento_7;
    }

    /**
     * Get the [procedimento_8] column value.
     *
     * @return string|null
     */
    public function getProcedimento8()
    {
        return $this->procedimento_8;
    }

    /**
     * Get the [procedimento_9] column value.
     *
     * @return string|null
     */
    public function getProcedimento9()
    {
        return $this->procedimento_9;
    }

    /**
     * Get the [procedimento_10] column value.
     *
     * @return string|null
     */
    public function getProcedimento10()
    {
        return $this->procedimento_10;
    }

    /**
     * Get the [procedimento_11] column value.
     *
     * @return string|null
     */
    public function getProcedimento11()
    {
        return $this->procedimento_11;
    }

    /**
     * Get the [procedimento_12] column value.
     *
     * @return string|null
     */
    public function getProcedimento12()
    {
        return $this->procedimento_12;
    }

    /**
     * Get the [procedimento_13] column value.
     *
     * @return string|null
     */
    public function getProcedimento13()
    {
        return $this->procedimento_13;
    }

    /**
     * Get the [procedimento_14] column value.
     *
     * @return string|null
     */
    public function getProcedimento14()
    {
        return $this->procedimento_14;
    }

    /**
     * Get the [procedimento_15] column value.
     *
     * @return string|null
     */
    public function getProcedimento15()
    {
        return $this->procedimento_15;
    }

    /**
     * Get the [procedimento_16] column value.
     *
     * @return string|null
     */
    public function getProcedimento16()
    {
        return $this->procedimento_16;
    }

    /**
     * Get the [procedimento_17] column value.
     *
     * @return string|null
     */
    public function getProcedimento17()
    {
        return $this->procedimento_17;
    }

    /**
     * Get the [procedimento_18] column value.
     *
     * @return string|null
     */
    public function getProcedimento18()
    {
        return $this->procedimento_18;
    }

    /**
     * Get the [procedimento_19] column value.
     *
     * @return string|null
     */
    public function getProcedimento19()
    {
        return $this->procedimento_19;
    }

    /**
     * Get the [procedimento_20] column value.
     *
     * @return string|null
     */
    public function getProcedimento20()
    {
        return $this->procedimento_20;
    }

    /**
     * Get the [total_procedimentos] column value.
     *
     * @return int|null
     */
    public function getTotalProcedimentos()
    {
        return $this->total_procedimentos;
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
            $this->modifiedColumns[TabelaTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [data] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->data !== $v) {
            $this->data = $v;
            $this->modifiedColumns[TabelaTableMap::COL_DATA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [turno] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTurno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->turno !== $v) {
            $this->turno = $v;
            $this->modifiedColumns[TabelaTableMap::COL_TURNO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fisioterapeuta] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFisioterapeuta($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fisioterapeuta !== $v) {
            $this->fisioterapeuta = $v;
            $this->modifiedColumns[TabelaTableMap::COL_FISIOTERAPEUTA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nome_paciente] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNomePaciente($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome_paciente !== $v) {
            $this->nome_paciente = $v;
            $this->modifiedColumns[TabelaTableMap::COL_NOME_PACIENTE] = true;
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
            $this->modifiedColumns[TabelaTableMap::COL_TIPO_ATENDIMENTO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [situacao_administrativa] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSituacaoAdministrativa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->situacao_administrativa !== $v) {
            $this->situacao_administrativa = $v;
            $this->modifiedColumns[TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nip_paciente] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNipPaciente($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nip_paciente !== $v) {
            $this->nip_paciente = $v;
            $this->modifiedColumns[TabelaTableMap::COL_NIP_PACIENTE] = true;
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
            $this->modifiedColumns[TabelaTableMap::COL_NIP_TITULAR] = true;
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
            $this->modifiedColumns[TabelaTableMap::COL_CPF_TITULAR] = true;
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
            $this->modifiedColumns[TabelaTableMap::COL_ORIGEM] = true;
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
            $this->modifiedColumns[TabelaTableMap::COL_CORPO_QUADRO] = true;
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
            $this->modifiedColumns[TabelaTableMap::COL_POSTO_GRADUACAO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [atleta] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAtleta($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->atleta !== $v) {
            $this->atleta = $v;
            $this->modifiedColumns[TabelaTableMap::COL_ATLETA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [modalidade] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setModalidade($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->modalidade !== $v) {
            $this->modalidade = $v;
            $this->modifiedColumns[TabelaTableMap::COL_MODALIDADE] = true;
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
            $this->modifiedColumns[TabelaTableMap::COL_OUTRA_MODALIDADE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [comparecimento] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setComparecimento($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->comparecimento !== $v) {
            $this->comparecimento = $v;
            $this->modifiedColumns[TabelaTableMap::COL_COMPARECIMENTO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tipo_falta] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTipoFalta($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tipo_falta !== $v) {
            $this->tipo_falta = $v;
            $this->modifiedColumns[TabelaTableMap::COL_TIPO_FALTA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_1] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_1 !== $v) {
            $this->procedimento_1 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_1] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_2] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_2 !== $v) {
            $this->procedimento_2 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_2] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_3] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_3 !== $v) {
            $this->procedimento_3 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_3] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_4] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_4 !== $v) {
            $this->procedimento_4 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_4] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_5] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento5($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_5 !== $v) {
            $this->procedimento_5 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_5] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_6] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento6($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_6 !== $v) {
            $this->procedimento_6 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_6] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_7] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento7($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_7 !== $v) {
            $this->procedimento_7 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_7] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_8] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento8($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_8 !== $v) {
            $this->procedimento_8 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_8] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_9] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento9($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_9 !== $v) {
            $this->procedimento_9 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_9] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_10] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento10($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_10 !== $v) {
            $this->procedimento_10 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_10] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_11] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento11($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_11 !== $v) {
            $this->procedimento_11 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_11] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_12] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento12($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_12 !== $v) {
            $this->procedimento_12 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_12] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_13] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento13($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_13 !== $v) {
            $this->procedimento_13 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_13] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_14] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento14($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_14 !== $v) {
            $this->procedimento_14 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_14] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_15] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento15($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_15 !== $v) {
            $this->procedimento_15 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_15] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_16] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento16($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_16 !== $v) {
            $this->procedimento_16 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_16] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_17] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento17($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_17 !== $v) {
            $this->procedimento_17 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_17] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_18] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento18($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_18 !== $v) {
            $this->procedimento_18 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_18] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_19] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento19($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_19 !== $v) {
            $this->procedimento_19 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_19] = true;
        }

        return $this;
    }

    /**
     * Set the value of [procedimento_20] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProcedimento20($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->procedimento_20 !== $v) {
            $this->procedimento_20 = $v;
            $this->modifiedColumns[TabelaTableMap::COL_PROCEDIMENTO_20] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_procedimentos] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalProcedimentos($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->total_procedimentos !== $v) {
            $this->total_procedimentos = $v;
            $this->modifiedColumns[TabelaTableMap::COL_TOTAL_PROCEDIMENTOS] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TabelaTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TabelaTableMap::translateFieldName('Data', TableMap::TYPE_PHPNAME, $indexType)];
            $this->data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TabelaTableMap::translateFieldName('Turno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->turno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TabelaTableMap::translateFieldName('Fisioterapeuta', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fisioterapeuta = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : TabelaTableMap::translateFieldName('NomePaciente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome_paciente = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : TabelaTableMap::translateFieldName('TipoAtendimento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tipo_atendimento = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : TabelaTableMap::translateFieldName('SituacaoAdministrativa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->situacao_administrativa = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : TabelaTableMap::translateFieldName('NipPaciente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nip_paciente = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : TabelaTableMap::translateFieldName('NipTitular', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nip_titular = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : TabelaTableMap::translateFieldName('CpfTitular', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cpf_titular = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : TabelaTableMap::translateFieldName('Origem', TableMap::TYPE_PHPNAME, $indexType)];
            $this->origem = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : TabelaTableMap::translateFieldName('CorpoQuadro', TableMap::TYPE_PHPNAME, $indexType)];
            $this->corpo_quadro = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : TabelaTableMap::translateFieldName('PostoGraduacao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->posto_graduacao = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : TabelaTableMap::translateFieldName('Atleta', TableMap::TYPE_PHPNAME, $indexType)];
            $this->atleta = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : TabelaTableMap::translateFieldName('Modalidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->modalidade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : TabelaTableMap::translateFieldName('OutraModalidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outra_modalidade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : TabelaTableMap::translateFieldName('Comparecimento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comparecimento = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : TabelaTableMap::translateFieldName('TipoFalta', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tipo_falta = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : TabelaTableMap::translateFieldName('Procedimento1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : TabelaTableMap::translateFieldName('Procedimento2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : TabelaTableMap::translateFieldName('Procedimento3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_3 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : TabelaTableMap::translateFieldName('Procedimento4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_4 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : TabelaTableMap::translateFieldName('Procedimento5', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_5 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : TabelaTableMap::translateFieldName('Procedimento6', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_6 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : TabelaTableMap::translateFieldName('Procedimento7', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_7 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : TabelaTableMap::translateFieldName('Procedimento8', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_8 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : TabelaTableMap::translateFieldName('Procedimento9', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_9 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : TabelaTableMap::translateFieldName('Procedimento10', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_10 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : TabelaTableMap::translateFieldName('Procedimento11', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_11 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : TabelaTableMap::translateFieldName('Procedimento12', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_12 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : TabelaTableMap::translateFieldName('Procedimento13', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_13 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : TabelaTableMap::translateFieldName('Procedimento14', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_14 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : TabelaTableMap::translateFieldName('Procedimento15', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_15 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : TabelaTableMap::translateFieldName('Procedimento16', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_16 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : TabelaTableMap::translateFieldName('Procedimento17', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_17 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : TabelaTableMap::translateFieldName('Procedimento18', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_18 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : TabelaTableMap::translateFieldName('Procedimento19', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_19 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : TabelaTableMap::translateFieldName('Procedimento20', TableMap::TYPE_PHPNAME, $indexType)];
            $this->procedimento_20 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : TabelaTableMap::translateFieldName('TotalProcedimentos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_procedimentos = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 39; // 39 = TabelaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Api\\Models\\Tabela'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(TabelaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTabelaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Tabela::setDeleted()
     * @see Tabela::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TabelaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTabelaQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(TabelaTableMap::DATABASE_NAME);
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
                TabelaTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[TabelaTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TabelaTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TabelaTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'data';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_TURNO)) {
            $modifiedColumns[':p' . $index++]  = 'turno';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_FISIOTERAPEUTA)) {
            $modifiedColumns[':p' . $index++]  = 'fisioterapeuta';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_NOME_PACIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'nome_paciente';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_TIPO_ATENDIMENTO)) {
            $modifiedColumns[':p' . $index++]  = 'tipo_atendimento';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA)) {
            $modifiedColumns[':p' . $index++]  = 'situacao_administrativa';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_NIP_PACIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'nip_paciente';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_NIP_TITULAR)) {
            $modifiedColumns[':p' . $index++]  = 'nip_titular';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_CPF_TITULAR)) {
            $modifiedColumns[':p' . $index++]  = 'cpf_titular';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_ORIGEM)) {
            $modifiedColumns[':p' . $index++]  = 'origem';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_CORPO_QUADRO)) {
            $modifiedColumns[':p' . $index++]  = 'corpo_quadro';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_POSTO_GRADUACAO)) {
            $modifiedColumns[':p' . $index++]  = 'posto_graduacao';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_ATLETA)) {
            $modifiedColumns[':p' . $index++]  = 'atleta';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_MODALIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'modalidade';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_OUTRA_MODALIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'outra_modalidade';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_COMPARECIMENTO)) {
            $modifiedColumns[':p' . $index++]  = 'comparecimento';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_TIPO_FALTA)) {
            $modifiedColumns[':p' . $index++]  = 'tipo_falta';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_1)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_1';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_2)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_2';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_3)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_3';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_4)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_4';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_5)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_5';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_6)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_6';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_7)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_7';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_8)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_8';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_9)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_9';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_10)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_10';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_11)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_11';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_12)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_12';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_13)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_13';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_14)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_14';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_15)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_15';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_16)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_16';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_17)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_17';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_18)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_18';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_19)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_19';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_20)) {
            $modifiedColumns[':p' . $index++]  = 'procedimento_20';
        }
        if ($this->isColumnModified(TabelaTableMap::COL_TOTAL_PROCEDIMENTOS)) {
            $modifiedColumns[':p' . $index++]  = 'total_procedimentos';
        }

        $sql = sprintf(
            'INSERT INTO tabela (%s) VALUES (%s)',
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
                    case 'data':
                        $stmt->bindValue($identifier, $this->data, PDO::PARAM_STR);
                        break;
                    case 'turno':
                        $stmt->bindValue($identifier, $this->turno, PDO::PARAM_STR);
                        break;
                    case 'fisioterapeuta':
                        $stmt->bindValue($identifier, $this->fisioterapeuta, PDO::PARAM_STR);
                        break;
                    case 'nome_paciente':
                        $stmt->bindValue($identifier, $this->nome_paciente, PDO::PARAM_STR);
                        break;
                    case 'tipo_atendimento':
                        $stmt->bindValue($identifier, $this->tipo_atendimento, PDO::PARAM_STR);
                        break;
                    case 'situacao_administrativa':
                        $stmt->bindValue($identifier, $this->situacao_administrativa, PDO::PARAM_STR);
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
                    case 'posto_graduacao':
                        $stmt->bindValue($identifier, $this->posto_graduacao, PDO::PARAM_STR);
                        break;
                    case 'atleta':
                        $stmt->bindValue($identifier, $this->atleta, PDO::PARAM_STR);
                        break;
                    case 'modalidade':
                        $stmt->bindValue($identifier, $this->modalidade, PDO::PARAM_STR);
                        break;
                    case 'outra_modalidade':
                        $stmt->bindValue($identifier, $this->outra_modalidade, PDO::PARAM_STR);
                        break;
                    case 'comparecimento':
                        $stmt->bindValue($identifier, (int) $this->comparecimento, PDO::PARAM_INT);
                        break;
                    case 'tipo_falta':
                        $stmt->bindValue($identifier, $this->tipo_falta, PDO::PARAM_STR);
                        break;
                    case 'procedimento_1':
                        $stmt->bindValue($identifier, $this->procedimento_1, PDO::PARAM_STR);
                        break;
                    case 'procedimento_2':
                        $stmt->bindValue($identifier, $this->procedimento_2, PDO::PARAM_STR);
                        break;
                    case 'procedimento_3':
                        $stmt->bindValue($identifier, $this->procedimento_3, PDO::PARAM_STR);
                        break;
                    case 'procedimento_4':
                        $stmt->bindValue($identifier, $this->procedimento_4, PDO::PARAM_STR);
                        break;
                    case 'procedimento_5':
                        $stmt->bindValue($identifier, $this->procedimento_5, PDO::PARAM_STR);
                        break;
                    case 'procedimento_6':
                        $stmt->bindValue($identifier, $this->procedimento_6, PDO::PARAM_STR);
                        break;
                    case 'procedimento_7':
                        $stmt->bindValue($identifier, $this->procedimento_7, PDO::PARAM_STR);
                        break;
                    case 'procedimento_8':
                        $stmt->bindValue($identifier, $this->procedimento_8, PDO::PARAM_STR);
                        break;
                    case 'procedimento_9':
                        $stmt->bindValue($identifier, $this->procedimento_9, PDO::PARAM_STR);
                        break;
                    case 'procedimento_10':
                        $stmt->bindValue($identifier, $this->procedimento_10, PDO::PARAM_STR);
                        break;
                    case 'procedimento_11':
                        $stmt->bindValue($identifier, $this->procedimento_11, PDO::PARAM_STR);
                        break;
                    case 'procedimento_12':
                        $stmt->bindValue($identifier, $this->procedimento_12, PDO::PARAM_STR);
                        break;
                    case 'procedimento_13':
                        $stmt->bindValue($identifier, $this->procedimento_13, PDO::PARAM_STR);
                        break;
                    case 'procedimento_14':
                        $stmt->bindValue($identifier, $this->procedimento_14, PDO::PARAM_STR);
                        break;
                    case 'procedimento_15':
                        $stmt->bindValue($identifier, $this->procedimento_15, PDO::PARAM_STR);
                        break;
                    case 'procedimento_16':
                        $stmt->bindValue($identifier, $this->procedimento_16, PDO::PARAM_STR);
                        break;
                    case 'procedimento_17':
                        $stmt->bindValue($identifier, $this->procedimento_17, PDO::PARAM_STR);
                        break;
                    case 'procedimento_18':
                        $stmt->bindValue($identifier, $this->procedimento_18, PDO::PARAM_STR);
                        break;
                    case 'procedimento_19':
                        $stmt->bindValue($identifier, $this->procedimento_19, PDO::PARAM_STR);
                        break;
                    case 'procedimento_20':
                        $stmt->bindValue($identifier, $this->procedimento_20, PDO::PARAM_STR);
                        break;
                    case 'total_procedimentos':
                        $stmt->bindValue($identifier, $this->total_procedimentos, PDO::PARAM_INT);
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
        $pos = TabelaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getData();

            case 2:
                return $this->getTurno();

            case 3:
                return $this->getFisioterapeuta();

            case 4:
                return $this->getNomePaciente();

            case 5:
                return $this->getTipoAtendimento();

            case 6:
                return $this->getSituacaoAdministrativa();

            case 7:
                return $this->getNipPaciente();

            case 8:
                return $this->getNipTitular();

            case 9:
                return $this->getCpfTitular();

            case 10:
                return $this->getOrigem();

            case 11:
                return $this->getCorpoQuadro();

            case 12:
                return $this->getPostoGraduacao();

            case 13:
                return $this->getAtleta();

            case 14:
                return $this->getModalidade();

            case 15:
                return $this->getOutraModalidade();

            case 16:
                return $this->getComparecimento();

            case 17:
                return $this->getTipoFalta();

            case 18:
                return $this->getProcedimento1();

            case 19:
                return $this->getProcedimento2();

            case 20:
                return $this->getProcedimento3();

            case 21:
                return $this->getProcedimento4();

            case 22:
                return $this->getProcedimento5();

            case 23:
                return $this->getProcedimento6();

            case 24:
                return $this->getProcedimento7();

            case 25:
                return $this->getProcedimento8();

            case 26:
                return $this->getProcedimento9();

            case 27:
                return $this->getProcedimento10();

            case 28:
                return $this->getProcedimento11();

            case 29:
                return $this->getProcedimento12();

            case 30:
                return $this->getProcedimento13();

            case 31:
                return $this->getProcedimento14();

            case 32:
                return $this->getProcedimento15();

            case 33:
                return $this->getProcedimento16();

            case 34:
                return $this->getProcedimento17();

            case 35:
                return $this->getProcedimento18();

            case 36:
                return $this->getProcedimento19();

            case 37:
                return $this->getProcedimento20();

            case 38:
                return $this->getTotalProcedimentos();

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
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = []): array
    {
        if (isset($alreadyDumpedObjects['Tabela'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Tabela'][$this->hashCode()] = true;
        $keys = TabelaTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getData(),
            $keys[2] => $this->getTurno(),
            $keys[3] => $this->getFisioterapeuta(),
            $keys[4] => $this->getNomePaciente(),
            $keys[5] => $this->getTipoAtendimento(),
            $keys[6] => $this->getSituacaoAdministrativa(),
            $keys[7] => $this->getNipPaciente(),
            $keys[8] => $this->getNipTitular(),
            $keys[9] => $this->getCpfTitular(),
            $keys[10] => $this->getOrigem(),
            $keys[11] => $this->getCorpoQuadro(),
            $keys[12] => $this->getPostoGraduacao(),
            $keys[13] => $this->getAtleta(),
            $keys[14] => $this->getModalidade(),
            $keys[15] => $this->getOutraModalidade(),
            $keys[16] => $this->getComparecimento(),
            $keys[17] => $this->getTipoFalta(),
            $keys[18] => $this->getProcedimento1(),
            $keys[19] => $this->getProcedimento2(),
            $keys[20] => $this->getProcedimento3(),
            $keys[21] => $this->getProcedimento4(),
            $keys[22] => $this->getProcedimento5(),
            $keys[23] => $this->getProcedimento6(),
            $keys[24] => $this->getProcedimento7(),
            $keys[25] => $this->getProcedimento8(),
            $keys[26] => $this->getProcedimento9(),
            $keys[27] => $this->getProcedimento10(),
            $keys[28] => $this->getProcedimento11(),
            $keys[29] => $this->getProcedimento12(),
            $keys[30] => $this->getProcedimento13(),
            $keys[31] => $this->getProcedimento14(),
            $keys[32] => $this->getProcedimento15(),
            $keys[33] => $this->getProcedimento16(),
            $keys[34] => $this->getProcedimento17(),
            $keys[35] => $this->getProcedimento18(),
            $keys[36] => $this->getProcedimento19(),
            $keys[37] => $this->getProcedimento20(),
            $keys[38] => $this->getTotalProcedimentos(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
        $pos = TabelaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setData($value);
                break;
            case 2:
                $this->setTurno($value);
                break;
            case 3:
                $this->setFisioterapeuta($value);
                break;
            case 4:
                $this->setNomePaciente($value);
                break;
            case 5:
                $this->setTipoAtendimento($value);
                break;
            case 6:
                $this->setSituacaoAdministrativa($value);
                break;
            case 7:
                $this->setNipPaciente($value);
                break;
            case 8:
                $this->setNipTitular($value);
                break;
            case 9:
                $this->setCpfTitular($value);
                break;
            case 10:
                $this->setOrigem($value);
                break;
            case 11:
                $this->setCorpoQuadro($value);
                break;
            case 12:
                $this->setPostoGraduacao($value);
                break;
            case 13:
                $this->setAtleta($value);
                break;
            case 14:
                $this->setModalidade($value);
                break;
            case 15:
                $this->setOutraModalidade($value);
                break;
            case 16:
                $this->setComparecimento($value);
                break;
            case 17:
                $this->setTipoFalta($value);
                break;
            case 18:
                $this->setProcedimento1($value);
                break;
            case 19:
                $this->setProcedimento2($value);
                break;
            case 20:
                $this->setProcedimento3($value);
                break;
            case 21:
                $this->setProcedimento4($value);
                break;
            case 22:
                $this->setProcedimento5($value);
                break;
            case 23:
                $this->setProcedimento6($value);
                break;
            case 24:
                $this->setProcedimento7($value);
                break;
            case 25:
                $this->setProcedimento8($value);
                break;
            case 26:
                $this->setProcedimento9($value);
                break;
            case 27:
                $this->setProcedimento10($value);
                break;
            case 28:
                $this->setProcedimento11($value);
                break;
            case 29:
                $this->setProcedimento12($value);
                break;
            case 30:
                $this->setProcedimento13($value);
                break;
            case 31:
                $this->setProcedimento14($value);
                break;
            case 32:
                $this->setProcedimento15($value);
                break;
            case 33:
                $this->setProcedimento16($value);
                break;
            case 34:
                $this->setProcedimento17($value);
                break;
            case 35:
                $this->setProcedimento18($value);
                break;
            case 36:
                $this->setProcedimento19($value);
                break;
            case 37:
                $this->setProcedimento20($value);
                break;
            case 38:
                $this->setTotalProcedimentos($value);
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
        $keys = TabelaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setData($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTurno($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFisioterapeuta($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNomePaciente($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTipoAtendimento($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSituacaoAdministrativa($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNipPaciente($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setNipTitular($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCpfTitular($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOrigem($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCorpoQuadro($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPostoGraduacao($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setAtleta($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setModalidade($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setOutraModalidade($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setComparecimento($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setTipoFalta($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setProcedimento1($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setProcedimento2($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setProcedimento3($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setProcedimento4($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setProcedimento5($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setProcedimento6($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setProcedimento7($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setProcedimento8($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setProcedimento9($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setProcedimento10($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setProcedimento11($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setProcedimento12($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setProcedimento13($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setProcedimento14($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setProcedimento15($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setProcedimento16($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setProcedimento17($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setProcedimento18($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setProcedimento19($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setProcedimento20($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setTotalProcedimentos($arr[$keys[38]]);
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
        $criteria = new Criteria(TabelaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TabelaTableMap::COL_ID)) {
            $criteria->add(TabelaTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_DATA)) {
            $criteria->add(TabelaTableMap::COL_DATA, $this->data);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_TURNO)) {
            $criteria->add(TabelaTableMap::COL_TURNO, $this->turno);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_FISIOTERAPEUTA)) {
            $criteria->add(TabelaTableMap::COL_FISIOTERAPEUTA, $this->fisioterapeuta);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_NOME_PACIENTE)) {
            $criteria->add(TabelaTableMap::COL_NOME_PACIENTE, $this->nome_paciente);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_TIPO_ATENDIMENTO)) {
            $criteria->add(TabelaTableMap::COL_TIPO_ATENDIMENTO, $this->tipo_atendimento);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA)) {
            $criteria->add(TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA, $this->situacao_administrativa);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_NIP_PACIENTE)) {
            $criteria->add(TabelaTableMap::COL_NIP_PACIENTE, $this->nip_paciente);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_NIP_TITULAR)) {
            $criteria->add(TabelaTableMap::COL_NIP_TITULAR, $this->nip_titular);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_CPF_TITULAR)) {
            $criteria->add(TabelaTableMap::COL_CPF_TITULAR, $this->cpf_titular);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_ORIGEM)) {
            $criteria->add(TabelaTableMap::COL_ORIGEM, $this->origem);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_CORPO_QUADRO)) {
            $criteria->add(TabelaTableMap::COL_CORPO_QUADRO, $this->corpo_quadro);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_POSTO_GRADUACAO)) {
            $criteria->add(TabelaTableMap::COL_POSTO_GRADUACAO, $this->posto_graduacao);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_ATLETA)) {
            $criteria->add(TabelaTableMap::COL_ATLETA, $this->atleta);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_MODALIDADE)) {
            $criteria->add(TabelaTableMap::COL_MODALIDADE, $this->modalidade);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_OUTRA_MODALIDADE)) {
            $criteria->add(TabelaTableMap::COL_OUTRA_MODALIDADE, $this->outra_modalidade);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_COMPARECIMENTO)) {
            $criteria->add(TabelaTableMap::COL_COMPARECIMENTO, $this->comparecimento);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_TIPO_FALTA)) {
            $criteria->add(TabelaTableMap::COL_TIPO_FALTA, $this->tipo_falta);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_1)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_1, $this->procedimento_1);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_2)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_2, $this->procedimento_2);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_3)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_3, $this->procedimento_3);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_4)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_4, $this->procedimento_4);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_5)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_5, $this->procedimento_5);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_6)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_6, $this->procedimento_6);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_7)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_7, $this->procedimento_7);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_8)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_8, $this->procedimento_8);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_9)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_9, $this->procedimento_9);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_10)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_10, $this->procedimento_10);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_11)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_11, $this->procedimento_11);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_12)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_12, $this->procedimento_12);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_13)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_13, $this->procedimento_13);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_14)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_14, $this->procedimento_14);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_15)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_15, $this->procedimento_15);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_16)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_16, $this->procedimento_16);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_17)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_17, $this->procedimento_17);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_18)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_18, $this->procedimento_18);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_19)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_19, $this->procedimento_19);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_PROCEDIMENTO_20)) {
            $criteria->add(TabelaTableMap::COL_PROCEDIMENTO_20, $this->procedimento_20);
        }
        if ($this->isColumnModified(TabelaTableMap::COL_TOTAL_PROCEDIMENTOS)) {
            $criteria->add(TabelaTableMap::COL_TOTAL_PROCEDIMENTOS, $this->total_procedimentos);
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
        $criteria = ChildTabelaQuery::create();
        $criteria->add(TabelaTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \Api\Models\Tabela (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setData($this->getData());
        $copyObj->setTurno($this->getTurno());
        $copyObj->setFisioterapeuta($this->getFisioterapeuta());
        $copyObj->setNomePaciente($this->getNomePaciente());
        $copyObj->setTipoAtendimento($this->getTipoAtendimento());
        $copyObj->setSituacaoAdministrativa($this->getSituacaoAdministrativa());
        $copyObj->setNipPaciente($this->getNipPaciente());
        $copyObj->setNipTitular($this->getNipTitular());
        $copyObj->setCpfTitular($this->getCpfTitular());
        $copyObj->setOrigem($this->getOrigem());
        $copyObj->setCorpoQuadro($this->getCorpoQuadro());
        $copyObj->setPostoGraduacao($this->getPostoGraduacao());
        $copyObj->setAtleta($this->getAtleta());
        $copyObj->setModalidade($this->getModalidade());
        $copyObj->setOutraModalidade($this->getOutraModalidade());
        $copyObj->setComparecimento($this->getComparecimento());
        $copyObj->setTipoFalta($this->getTipoFalta());
        $copyObj->setProcedimento1($this->getProcedimento1());
        $copyObj->setProcedimento2($this->getProcedimento2());
        $copyObj->setProcedimento3($this->getProcedimento3());
        $copyObj->setProcedimento4($this->getProcedimento4());
        $copyObj->setProcedimento5($this->getProcedimento5());
        $copyObj->setProcedimento6($this->getProcedimento6());
        $copyObj->setProcedimento7($this->getProcedimento7());
        $copyObj->setProcedimento8($this->getProcedimento8());
        $copyObj->setProcedimento9($this->getProcedimento9());
        $copyObj->setProcedimento10($this->getProcedimento10());
        $copyObj->setProcedimento11($this->getProcedimento11());
        $copyObj->setProcedimento12($this->getProcedimento12());
        $copyObj->setProcedimento13($this->getProcedimento13());
        $copyObj->setProcedimento14($this->getProcedimento14());
        $copyObj->setProcedimento15($this->getProcedimento15());
        $copyObj->setProcedimento16($this->getProcedimento16());
        $copyObj->setProcedimento17($this->getProcedimento17());
        $copyObj->setProcedimento18($this->getProcedimento18());
        $copyObj->setProcedimento19($this->getProcedimento19());
        $copyObj->setProcedimento20($this->getProcedimento20());
        $copyObj->setTotalProcedimentos($this->getTotalProcedimentos());
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
     * @return \Api\Models\Tabela Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->id = null;
        $this->data = null;
        $this->turno = null;
        $this->fisioterapeuta = null;
        $this->nome_paciente = null;
        $this->tipo_atendimento = null;
        $this->situacao_administrativa = null;
        $this->nip_paciente = null;
        $this->nip_titular = null;
        $this->cpf_titular = null;
        $this->origem = null;
        $this->corpo_quadro = null;
        $this->posto_graduacao = null;
        $this->atleta = null;
        $this->modalidade = null;
        $this->outra_modalidade = null;
        $this->comparecimento = null;
        $this->tipo_falta = null;
        $this->procedimento_1 = null;
        $this->procedimento_2 = null;
        $this->procedimento_3 = null;
        $this->procedimento_4 = null;
        $this->procedimento_5 = null;
        $this->procedimento_6 = null;
        $this->procedimento_7 = null;
        $this->procedimento_8 = null;
        $this->procedimento_9 = null;
        $this->procedimento_10 = null;
        $this->procedimento_11 = null;
        $this->procedimento_12 = null;
        $this->procedimento_13 = null;
        $this->procedimento_14 = null;
        $this->procedimento_15 = null;
        $this->procedimento_16 = null;
        $this->procedimento_17 = null;
        $this->procedimento_18 = null;
        $this->procedimento_19 = null;
        $this->procedimento_20 = null;
        $this->total_procedimentos = null;
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
        } // if ($deep)

        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TabelaTableMap::DEFAULT_STRING_FORMAT);
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
