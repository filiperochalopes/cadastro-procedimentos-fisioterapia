<?php

namespace Api\Models\Base;

use \Exception;
use \PDO;
use Api\Models\Registro as ChildRegistro;
use Api\Models\RegistroQuery as ChildRegistroQuery;
use Api\Models\Map\RegistroTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'registros' table.
 *
 *
 *
 * @method     ChildRegistroQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRegistroQuery orderByFisioterapeutaId($order = Criteria::ASC) Order by the fisioterapeuta_id column
 * @method     ChildRegistroQuery orderByPacienteId($order = Criteria::ASC) Order by the paciente_id column
 * @method     ChildRegistroQuery orderByTipoAtendimento($order = Criteria::ASC) Order by the tipo_atendimento column
 * @method     ChildRegistroQuery orderByComparecimento($order = Criteria::ASC) Order by the comparecimento column
 * @method     ChildRegistroQuery orderByTipoFalta($order = Criteria::ASC) Order by the tipo_falta column
 * @method     ChildRegistroQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ChildRegistroQuery orderByTurno($order = Criteria::ASC) Order by the turno column
 *
 * @method     ChildRegistroQuery groupById() Group by the id column
 * @method     ChildRegistroQuery groupByFisioterapeutaId() Group by the fisioterapeuta_id column
 * @method     ChildRegistroQuery groupByPacienteId() Group by the paciente_id column
 * @method     ChildRegistroQuery groupByTipoAtendimento() Group by the tipo_atendimento column
 * @method     ChildRegistroQuery groupByComparecimento() Group by the comparecimento column
 * @method     ChildRegistroQuery groupByTipoFalta() Group by the tipo_falta column
 * @method     ChildRegistroQuery groupByData() Group by the data column
 * @method     ChildRegistroQuery groupByTurno() Group by the turno column
 *
 * @method     ChildRegistroQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegistroQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegistroQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegistroQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRegistroQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRegistroQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRegistroQuery leftJoinFisioterapeuta($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fisioterapeuta relation
 * @method     ChildRegistroQuery rightJoinFisioterapeuta($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fisioterapeuta relation
 * @method     ChildRegistroQuery innerJoinFisioterapeuta($relationAlias = null) Adds a INNER JOIN clause to the query using the Fisioterapeuta relation
 *
 * @method     ChildRegistroQuery joinWithFisioterapeuta($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fisioterapeuta relation
 *
 * @method     ChildRegistroQuery leftJoinWithFisioterapeuta() Adds a LEFT JOIN clause and with to the query using the Fisioterapeuta relation
 * @method     ChildRegistroQuery rightJoinWithFisioterapeuta() Adds a RIGHT JOIN clause and with to the query using the Fisioterapeuta relation
 * @method     ChildRegistroQuery innerJoinWithFisioterapeuta() Adds a INNER JOIN clause and with to the query using the Fisioterapeuta relation
 *
 * @method     ChildRegistroQuery leftJoinPaciente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Paciente relation
 * @method     ChildRegistroQuery rightJoinPaciente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Paciente relation
 * @method     ChildRegistroQuery innerJoinPaciente($relationAlias = null) Adds a INNER JOIN clause to the query using the Paciente relation
 *
 * @method     ChildRegistroQuery joinWithPaciente($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Paciente relation
 *
 * @method     ChildRegistroQuery leftJoinWithPaciente() Adds a LEFT JOIN clause and with to the query using the Paciente relation
 * @method     ChildRegistroQuery rightJoinWithPaciente() Adds a RIGHT JOIN clause and with to the query using the Paciente relation
 * @method     ChildRegistroQuery innerJoinWithPaciente() Adds a INNER JOIN clause and with to the query using the Paciente relation
 *
 * @method     ChildRegistroQuery leftJoinRegistroProcedimento($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistroProcedimento relation
 * @method     ChildRegistroQuery rightJoinRegistroProcedimento($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistroProcedimento relation
 * @method     ChildRegistroQuery innerJoinRegistroProcedimento($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistroProcedimento relation
 *
 * @method     ChildRegistroQuery joinWithRegistroProcedimento($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistroProcedimento relation
 *
 * @method     ChildRegistroQuery leftJoinWithRegistroProcedimento() Adds a LEFT JOIN clause and with to the query using the RegistroProcedimento relation
 * @method     ChildRegistroQuery rightJoinWithRegistroProcedimento() Adds a RIGHT JOIN clause and with to the query using the RegistroProcedimento relation
 * @method     ChildRegistroQuery innerJoinWithRegistroProcedimento() Adds a INNER JOIN clause and with to the query using the RegistroProcedimento relation
 *
 * @method     \Api\Models\FisioterapeutaQuery|\Api\Models\PacienteQuery|\Api\Models\RegistroProcedimentoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegistro|null findOne(?ConnectionInterface $con = null) Return the first ChildRegistro matching the query
 * @method     ChildRegistro findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRegistro matching the query, or a new ChildRegistro object populated from the query conditions when no match is found
 *
 * @method     ChildRegistro|null findOneById(int $id) Return the first ChildRegistro filtered by the id column
 * @method     ChildRegistro|null findOneByFisioterapeutaId(int $fisioterapeuta_id) Return the first ChildRegistro filtered by the fisioterapeuta_id column
 * @method     ChildRegistro|null findOneByPacienteId(int $paciente_id) Return the first ChildRegistro filtered by the paciente_id column
 * @method     ChildRegistro|null findOneByTipoAtendimento(string $tipo_atendimento) Return the first ChildRegistro filtered by the tipo_atendimento column
 * @method     ChildRegistro|null findOneByComparecimento(boolean $comparecimento) Return the first ChildRegistro filtered by the comparecimento column
 * @method     ChildRegistro|null findOneByTipoFalta(string $tipo_falta) Return the first ChildRegistro filtered by the tipo_falta column
 * @method     ChildRegistro|null findOneByData(string $data) Return the first ChildRegistro filtered by the data column
 * @method     ChildRegistro|null findOneByTurno(string $turno) Return the first ChildRegistro filtered by the turno column *

 * @method     ChildRegistro requirePk($key, ?ConnectionInterface $con = null) Return the ChildRegistro by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistro requireOne(?ConnectionInterface $con = null) Return the first ChildRegistro matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistro requireOneById(int $id) Return the first ChildRegistro filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistro requireOneByFisioterapeutaId(int $fisioterapeuta_id) Return the first ChildRegistro filtered by the fisioterapeuta_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistro requireOneByPacienteId(int $paciente_id) Return the first ChildRegistro filtered by the paciente_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistro requireOneByTipoAtendimento(string $tipo_atendimento) Return the first ChildRegistro filtered by the tipo_atendimento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistro requireOneByComparecimento(boolean $comparecimento) Return the first ChildRegistro filtered by the comparecimento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistro requireOneByTipoFalta(string $tipo_falta) Return the first ChildRegistro filtered by the tipo_falta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistro requireOneByData(string $data) Return the first ChildRegistro filtered by the data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistro requireOneByTurno(string $turno) Return the first ChildRegistro filtered by the turno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistro[]|Collection find(?ConnectionInterface $con = null) Return ChildRegistro objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRegistro> find(?ConnectionInterface $con = null) Return ChildRegistro objects based on current ModelCriteria
 * @method     ChildRegistro[]|Collection findById(int $id) Return ChildRegistro objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildRegistro> findById(int $id) Return ChildRegistro objects filtered by the id column
 * @method     ChildRegistro[]|Collection findByFisioterapeutaId(int $fisioterapeuta_id) Return ChildRegistro objects filtered by the fisioterapeuta_id column
 * @psalm-method Collection&\Traversable<ChildRegistro> findByFisioterapeutaId(int $fisioterapeuta_id) Return ChildRegistro objects filtered by the fisioterapeuta_id column
 * @method     ChildRegistro[]|Collection findByPacienteId(int $paciente_id) Return ChildRegistro objects filtered by the paciente_id column
 * @psalm-method Collection&\Traversable<ChildRegistro> findByPacienteId(int $paciente_id) Return ChildRegistro objects filtered by the paciente_id column
 * @method     ChildRegistro[]|Collection findByTipoAtendimento(string $tipo_atendimento) Return ChildRegistro objects filtered by the tipo_atendimento column
 * @psalm-method Collection&\Traversable<ChildRegistro> findByTipoAtendimento(string $tipo_atendimento) Return ChildRegistro objects filtered by the tipo_atendimento column
 * @method     ChildRegistro[]|Collection findByComparecimento(boolean $comparecimento) Return ChildRegistro objects filtered by the comparecimento column
 * @psalm-method Collection&\Traversable<ChildRegistro> findByComparecimento(boolean $comparecimento) Return ChildRegistro objects filtered by the comparecimento column
 * @method     ChildRegistro[]|Collection findByTipoFalta(string $tipo_falta) Return ChildRegistro objects filtered by the tipo_falta column
 * @psalm-method Collection&\Traversable<ChildRegistro> findByTipoFalta(string $tipo_falta) Return ChildRegistro objects filtered by the tipo_falta column
 * @method     ChildRegistro[]|Collection findByData(string $data) Return ChildRegistro objects filtered by the data column
 * @psalm-method Collection&\Traversable<ChildRegistro> findByData(string $data) Return ChildRegistro objects filtered by the data column
 * @method     ChildRegistro[]|Collection findByTurno(string $turno) Return ChildRegistro objects filtered by the turno column
 * @psalm-method Collection&\Traversable<ChildRegistro> findByTurno(string $turno) Return ChildRegistro objects filtered by the turno column
 * @method     ChildRegistro[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRegistro> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RegistroQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Api\Models\Base\RegistroQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Api\\Models\\Registro', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegistroQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegistroQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRegistroQuery) {
            return $criteria;
        }
        $query = new ChildRegistroQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRegistro|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegistroTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RegistroTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistro A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, fisioterapeuta_id, paciente_id, tipo_atendimento, comparecimento, tipo_falta, data, turno FROM registros WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRegistro $obj */
            $obj = new ChildRegistro();
            $obj->hydrate($row);
            RegistroTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildRegistro|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(RegistroTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(RegistroTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RegistroTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RegistroTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fisioterapeuta_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFisioterapeutaId(1234); // WHERE fisioterapeuta_id = 1234
     * $query->filterByFisioterapeutaId(array(12, 34)); // WHERE fisioterapeuta_id IN (12, 34)
     * $query->filterByFisioterapeutaId(array('min' => 12)); // WHERE fisioterapeuta_id > 12
     * </code>
     *
     * @see       filterByFisioterapeuta()
     *
     * @param mixed $fisioterapeutaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFisioterapeutaId($fisioterapeutaId = null, ?string $comparison = null)
    {
        if (is_array($fisioterapeutaId)) {
            $useMinMax = false;
            if (isset($fisioterapeutaId['min'])) {
                $this->addUsingAlias(RegistroTableMap::COL_FISIOTERAPEUTA_ID, $fisioterapeutaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fisioterapeutaId['max'])) {
                $this->addUsingAlias(RegistroTableMap::COL_FISIOTERAPEUTA_ID, $fisioterapeutaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroTableMap::COL_FISIOTERAPEUTA_ID, $fisioterapeutaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the paciente_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPacienteId(1234); // WHERE paciente_id = 1234
     * $query->filterByPacienteId(array(12, 34)); // WHERE paciente_id IN (12, 34)
     * $query->filterByPacienteId(array('min' => 12)); // WHERE paciente_id > 12
     * </code>
     *
     * @see       filterByPaciente()
     *
     * @param mixed $pacienteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPacienteId($pacienteId = null, ?string $comparison = null)
    {
        if (is_array($pacienteId)) {
            $useMinMax = false;
            if (isset($pacienteId['min'])) {
                $this->addUsingAlias(RegistroTableMap::COL_PACIENTE_ID, $pacienteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacienteId['max'])) {
                $this->addUsingAlias(RegistroTableMap::COL_PACIENTE_ID, $pacienteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroTableMap::COL_PACIENTE_ID, $pacienteId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tipo_atendimento column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoAtendimento('fooValue');   // WHERE tipo_atendimento = 'fooValue'
     * $query->filterByTipoAtendimento('%fooValue%', Criteria::LIKE); // WHERE tipo_atendimento LIKE '%fooValue%'
     * $query->filterByTipoAtendimento(['foo', 'bar']); // WHERE tipo_atendimento IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tipoAtendimento The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTipoAtendimento($tipoAtendimento = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoAtendimento)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroTableMap::COL_TIPO_ATENDIMENTO, $tipoAtendimento, $comparison);

        return $this;
    }

    /**
     * Filter the query on the comparecimento column
     *
     * Example usage:
     * <code>
     * $query->filterByComparecimento(true); // WHERE comparecimento = true
     * $query->filterByComparecimento('yes'); // WHERE comparecimento = true
     * </code>
     *
     * @param bool|string $comparecimento The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComparecimento($comparecimento = null, ?string $comparison = null)
    {
        if (is_string($comparecimento)) {
            $comparecimento = in_array(strtolower($comparecimento), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(RegistroTableMap::COL_COMPARECIMENTO, $comparecimento, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tipo_falta column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoFalta('fooValue');   // WHERE tipo_falta = 'fooValue'
     * $query->filterByTipoFalta('%fooValue%', Criteria::LIKE); // WHERE tipo_falta LIKE '%fooValue%'
     * $query->filterByTipoFalta(['foo', 'bar']); // WHERE tipo_falta IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tipoFalta The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTipoFalta($tipoFalta = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoFalta)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroTableMap::COL_TIPO_FALTA, $tipoFalta, $comparison);

        return $this;
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('2011-03-14'); // WHERE data = '2011-03-14'
     * $query->filterByData('now'); // WHERE data = '2011-03-14'
     * $query->filterByData(array('max' => 'yesterday')); // WHERE data > '2011-03-13'
     * </code>
     *
     * @param mixed $data The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByData($data = null, ?string $comparison = null)
    {
        if (is_array($data)) {
            $useMinMax = false;
            if (isset($data['min'])) {
                $this->addUsingAlias(RegistroTableMap::COL_DATA, $data['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($data['max'])) {
                $this->addUsingAlias(RegistroTableMap::COL_DATA, $data['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroTableMap::COL_DATA, $data, $comparison);

        return $this;
    }

    /**
     * Filter the query on the turno column
     *
     * Example usage:
     * <code>
     * $query->filterByTurno('fooValue');   // WHERE turno = 'fooValue'
     * $query->filterByTurno('%fooValue%', Criteria::LIKE); // WHERE turno LIKE '%fooValue%'
     * $query->filterByTurno(['foo', 'bar']); // WHERE turno IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $turno The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTurno($turno = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($turno)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroTableMap::COL_TURNO, $turno, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Api\Models\Fisioterapeuta object
     *
     * @param \Api\Models\Fisioterapeuta|ObjectCollection $fisioterapeuta The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFisioterapeuta($fisioterapeuta, ?string $comparison = null)
    {
        if ($fisioterapeuta instanceof \Api\Models\Fisioterapeuta) {
            return $this
                ->addUsingAlias(RegistroTableMap::COL_FISIOTERAPEUTA_ID, $fisioterapeuta->getId(), $comparison);
        } elseif ($fisioterapeuta instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(RegistroTableMap::COL_FISIOTERAPEUTA_ID, $fisioterapeuta->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByFisioterapeuta() only accepts arguments of type \Api\Models\Fisioterapeuta or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fisioterapeuta relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFisioterapeuta(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fisioterapeuta');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Fisioterapeuta');
        }

        return $this;
    }

    /**
     * Use the Fisioterapeuta relation Fisioterapeuta object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Api\Models\FisioterapeutaQuery A secondary query class using the current class as primary query
     */
    public function useFisioterapeutaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFisioterapeuta($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fisioterapeuta', '\Api\Models\FisioterapeutaQuery');
    }

    /**
     * Use the Fisioterapeuta relation Fisioterapeuta object
     *
     * @param callable(\Api\Models\FisioterapeutaQuery):\Api\Models\FisioterapeutaQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFisioterapeutaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFisioterapeutaQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Fisioterapeuta table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Api\Models\FisioterapeutaQuery The inner query object of the EXISTS statement
     */
    public function useFisioterapeutaExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Fisioterapeuta', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Fisioterapeuta table for a NOT EXISTS query.
     *
     * @see useFisioterapeutaExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Api\Models\FisioterapeutaQuery The inner query object of the NOT EXISTS statement
     */
    public function useFisioterapeutaNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Fisioterapeuta', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Api\Models\Paciente object
     *
     * @param \Api\Models\Paciente|ObjectCollection $paciente The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaciente($paciente, ?string $comparison = null)
    {
        if ($paciente instanceof \Api\Models\Paciente) {
            return $this
                ->addUsingAlias(RegistroTableMap::COL_PACIENTE_ID, $paciente->getId(), $comparison);
        } elseif ($paciente instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(RegistroTableMap::COL_PACIENTE_ID, $paciente->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPaciente() only accepts arguments of type \Api\Models\Paciente or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Paciente relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPaciente(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Paciente');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Paciente');
        }

        return $this;
    }

    /**
     * Use the Paciente relation Paciente object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Api\Models\PacienteQuery A secondary query class using the current class as primary query
     */
    public function usePacienteQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPaciente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Paciente', '\Api\Models\PacienteQuery');
    }

    /**
     * Use the Paciente relation Paciente object
     *
     * @param callable(\Api\Models\PacienteQuery):\Api\Models\PacienteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPacienteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePacienteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Paciente table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Api\Models\PacienteQuery The inner query object of the EXISTS statement
     */
    public function usePacienteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Paciente', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Paciente table for a NOT EXISTS query.
     *
     * @see usePacienteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Api\Models\PacienteQuery The inner query object of the NOT EXISTS statement
     */
    public function usePacienteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Paciente', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Api\Models\RegistroProcedimento object
     *
     * @param \Api\Models\RegistroProcedimento|ObjectCollection $registroProcedimento the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistroProcedimento($registroProcedimento, ?string $comparison = null)
    {
        if ($registroProcedimento instanceof \Api\Models\RegistroProcedimento) {
            $this
                ->addUsingAlias(RegistroTableMap::COL_ID, $registroProcedimento->getRegistroId(), $comparison);

            return $this;
        } elseif ($registroProcedimento instanceof ObjectCollection) {
            $this
                ->useRegistroProcedimentoQuery()
                ->filterByPrimaryKeys($registroProcedimento->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByRegistroProcedimento() only accepts arguments of type \Api\Models\RegistroProcedimento or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistroProcedimento relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRegistroProcedimento(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistroProcedimento');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'RegistroProcedimento');
        }

        return $this;
    }

    /**
     * Use the RegistroProcedimento relation RegistroProcedimento object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Api\Models\RegistroProcedimentoQuery A secondary query class using the current class as primary query
     */
    public function useRegistroProcedimentoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistroProcedimento($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistroProcedimento', '\Api\Models\RegistroProcedimentoQuery');
    }

    /**
     * Use the RegistroProcedimento relation RegistroProcedimento object
     *
     * @param callable(\Api\Models\RegistroProcedimentoQuery):\Api\Models\RegistroProcedimentoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRegistroProcedimentoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useRegistroProcedimentoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to RegistroProcedimento table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Api\Models\RegistroProcedimentoQuery The inner query object of the EXISTS statement
     */
    public function useRegistroProcedimentoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('RegistroProcedimento', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to RegistroProcedimento table for a NOT EXISTS query.
     *
     * @see useRegistroProcedimentoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Api\Models\RegistroProcedimentoQuery The inner query object of the NOT EXISTS statement
     */
    public function useRegistroProcedimentoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('RegistroProcedimento', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related Procedimento object
     * using the registro_procedimento table as cross reference
     *
     * @param Procedimento $procedimento the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento($procedimento, string $comparison = Criteria::EQUAL)
    {
        $this
            ->useRegistroProcedimentoQuery()
            ->filterByProcedimento($procedimento, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildRegistro $registro Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($registro = null)
    {
        if ($registro) {
            $this->addUsingAlias(RegistroTableMap::COL_ID, $registro->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the registros table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RegistroTableMap::clearInstancePool();
            RegistroTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RegistroTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RegistroTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RegistroTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
