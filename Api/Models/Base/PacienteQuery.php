<?php

namespace Api\Models\Base;

use \Exception;
use \PDO;
use Api\Models\Paciente as ChildPaciente;
use Api\Models\PacienteQuery as ChildPacienteQuery;
use Api\Models\Map\PacienteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pacientes' table.
 *
 *
 *
 * @method     ChildPacienteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPacienteQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildPacienteQuery orderBySituacaoAdmistrativa($order = Criteria::ASC) Order by the situacao_administ column
 * @method     ChildPacienteQuery orderByPostoGraduacao($order = Criteria::ASC) Order by the posto_graduacao column
 * @method     ChildPacienteQuery orderByNip($order = Criteria::ASC) Order by the nip_paciente column
 * @method     ChildPacienteQuery orderByNipTitular($order = Criteria::ASC) Order by the nip_titular column
 * @method     ChildPacienteQuery orderByCpfTitular($order = Criteria::ASC) Order by the cpf_titular column
 * @method     ChildPacienteQuery orderByOrigem($order = Criteria::ASC) Order by the origem column
 * @method     ChildPacienteQuery orderByCorpoQuadro($order = Criteria::ASC) Order by the corpo_quadro column
 * @method     ChildPacienteQuery orderByAtleta($order = Criteria::ASC) Order by the atleta column
 * @method     ChildPacienteQuery orderByModalidade($order = Criteria::ASC) Order by the atleta_modalidade column
 * @method     ChildPacienteQuery orderByOutraModalidade($order = Criteria::ASC) Order by the outra_modalidade column
 *
 * @method     ChildPacienteQuery groupById() Group by the id column
 * @method     ChildPacienteQuery groupByNome() Group by the nome column
 * @method     ChildPacienteQuery groupBySituacaoAdmistrativa() Group by the situacao_administ column
 * @method     ChildPacienteQuery groupByPostoGraduacao() Group by the posto_graduacao column
 * @method     ChildPacienteQuery groupByNip() Group by the nip_paciente column
 * @method     ChildPacienteQuery groupByNipTitular() Group by the nip_titular column
 * @method     ChildPacienteQuery groupByCpfTitular() Group by the cpf_titular column
 * @method     ChildPacienteQuery groupByOrigem() Group by the origem column
 * @method     ChildPacienteQuery groupByCorpoQuadro() Group by the corpo_quadro column
 * @method     ChildPacienteQuery groupByAtleta() Group by the atleta column
 * @method     ChildPacienteQuery groupByModalidade() Group by the atleta_modalidade column
 * @method     ChildPacienteQuery groupByOutraModalidade() Group by the outra_modalidade column
 *
 * @method     ChildPacienteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPacienteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPacienteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPacienteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPacienteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPacienteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPacienteQuery leftJoinRegistro($relationAlias = null) Adds a LEFT JOIN clause to the query using the Registro relation
 * @method     ChildPacienteQuery rightJoinRegistro($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Registro relation
 * @method     ChildPacienteQuery innerJoinRegistro($relationAlias = null) Adds a INNER JOIN clause to the query using the Registro relation
 *
 * @method     ChildPacienteQuery joinWithRegistro($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Registro relation
 *
 * @method     ChildPacienteQuery leftJoinWithRegistro() Adds a LEFT JOIN clause and with to the query using the Registro relation
 * @method     ChildPacienteQuery rightJoinWithRegistro() Adds a RIGHT JOIN clause and with to the query using the Registro relation
 * @method     ChildPacienteQuery innerJoinWithRegistro() Adds a INNER JOIN clause and with to the query using the Registro relation
 *
 * @method     \Api\Models\RegistroQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPaciente|null findOne(?ConnectionInterface $con = null) Return the first ChildPaciente matching the query
 * @method     ChildPaciente findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPaciente matching the query, or a new ChildPaciente object populated from the query conditions when no match is found
 *
 * @method     ChildPaciente|null findOneById(int $id) Return the first ChildPaciente filtered by the id column
 * @method     ChildPaciente|null findOneByNome(string $nome) Return the first ChildPaciente filtered by the nome column
 * @method     ChildPaciente|null findOneBySituacaoAdmistrativa(string $situacao_administ) Return the first ChildPaciente filtered by the situacao_administ column
 * @method     ChildPaciente|null findOneByPostoGraduacao(string $posto_graduacao) Return the first ChildPaciente filtered by the posto_graduacao column
 * @method     ChildPaciente|null findOneByNip(string $nip_paciente) Return the first ChildPaciente filtered by the nip_paciente column
 * @method     ChildPaciente|null findOneByNipTitular(string $nip_titular) Return the first ChildPaciente filtered by the nip_titular column
 * @method     ChildPaciente|null findOneByCpfTitular(string $cpf_titular) Return the first ChildPaciente filtered by the cpf_titular column
 * @method     ChildPaciente|null findOneByOrigem(string $origem) Return the first ChildPaciente filtered by the origem column
 * @method     ChildPaciente|null findOneByCorpoQuadro(string $corpo_quadro) Return the first ChildPaciente filtered by the corpo_quadro column
 * @method     ChildPaciente|null findOneByAtleta(boolean $atleta) Return the first ChildPaciente filtered by the atleta column
 * @method     ChildPaciente|null findOneByModalidade(string $atleta_modalidade) Return the first ChildPaciente filtered by the atleta_modalidade column
 * @method     ChildPaciente|null findOneByOutraModalidade(string $outra_modalidade) Return the first ChildPaciente filtered by the outra_modalidade column *

 * @method     ChildPaciente requirePk($key, ?ConnectionInterface $con = null) Return the ChildPaciente by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOne(?ConnectionInterface $con = null) Return the first ChildPaciente matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPaciente requireOneById(int $id) Return the first ChildPaciente filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByNome(string $nome) Return the first ChildPaciente filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneBySituacaoAdmistrativa(string $situacao_administ) Return the first ChildPaciente filtered by the situacao_administ column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByPostoGraduacao(string $posto_graduacao) Return the first ChildPaciente filtered by the posto_graduacao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByNip(string $nip_paciente) Return the first ChildPaciente filtered by the nip_paciente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByNipTitular(string $nip_titular) Return the first ChildPaciente filtered by the nip_titular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByCpfTitular(string $cpf_titular) Return the first ChildPaciente filtered by the cpf_titular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByOrigem(string $origem) Return the first ChildPaciente filtered by the origem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByCorpoQuadro(string $corpo_quadro) Return the first ChildPaciente filtered by the corpo_quadro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByAtleta(boolean $atleta) Return the first ChildPaciente filtered by the atleta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByModalidade(string $atleta_modalidade) Return the first ChildPaciente filtered by the atleta_modalidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaciente requireOneByOutraModalidade(string $outra_modalidade) Return the first ChildPaciente filtered by the outra_modalidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPaciente[]|Collection find(?ConnectionInterface $con = null) Return ChildPaciente objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPaciente> find(?ConnectionInterface $con = null) Return ChildPaciente objects based on current ModelCriteria
 * @method     ChildPaciente[]|Collection findById(int $id) Return ChildPaciente objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildPaciente> findById(int $id) Return ChildPaciente objects filtered by the id column
 * @method     ChildPaciente[]|Collection findByNome(string $nome) Return ChildPaciente objects filtered by the nome column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByNome(string $nome) Return ChildPaciente objects filtered by the nome column
 * @method     ChildPaciente[]|Collection findBySituacaoAdmistrativa(string $situacao_administ) Return ChildPaciente objects filtered by the situacao_administ column
 * @psalm-method Collection&\Traversable<ChildPaciente> findBySituacaoAdmistrativa(string $situacao_administ) Return ChildPaciente objects filtered by the situacao_administ column
 * @method     ChildPaciente[]|Collection findByPostoGraduacao(string $posto_graduacao) Return ChildPaciente objects filtered by the posto_graduacao column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByPostoGraduacao(string $posto_graduacao) Return ChildPaciente objects filtered by the posto_graduacao column
 * @method     ChildPaciente[]|Collection findByNip(string $nip_paciente) Return ChildPaciente objects filtered by the nip_paciente column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByNip(string $nip_paciente) Return ChildPaciente objects filtered by the nip_paciente column
 * @method     ChildPaciente[]|Collection findByNipTitular(string $nip_titular) Return ChildPaciente objects filtered by the nip_titular column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByNipTitular(string $nip_titular) Return ChildPaciente objects filtered by the nip_titular column
 * @method     ChildPaciente[]|Collection findByCpfTitular(string $cpf_titular) Return ChildPaciente objects filtered by the cpf_titular column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByCpfTitular(string $cpf_titular) Return ChildPaciente objects filtered by the cpf_titular column
 * @method     ChildPaciente[]|Collection findByOrigem(string $origem) Return ChildPaciente objects filtered by the origem column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByOrigem(string $origem) Return ChildPaciente objects filtered by the origem column
 * @method     ChildPaciente[]|Collection findByCorpoQuadro(string $corpo_quadro) Return ChildPaciente objects filtered by the corpo_quadro column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByCorpoQuadro(string $corpo_quadro) Return ChildPaciente objects filtered by the corpo_quadro column
 * @method     ChildPaciente[]|Collection findByAtleta(boolean $atleta) Return ChildPaciente objects filtered by the atleta column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByAtleta(boolean $atleta) Return ChildPaciente objects filtered by the atleta column
 * @method     ChildPaciente[]|Collection findByModalidade(string $atleta_modalidade) Return ChildPaciente objects filtered by the atleta_modalidade column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByModalidade(string $atleta_modalidade) Return ChildPaciente objects filtered by the atleta_modalidade column
 * @method     ChildPaciente[]|Collection findByOutraModalidade(string $outra_modalidade) Return ChildPaciente objects filtered by the outra_modalidade column
 * @psalm-method Collection&\Traversable<ChildPaciente> findByOutraModalidade(string $outra_modalidade) Return ChildPaciente objects filtered by the outra_modalidade column
 * @method     ChildPaciente[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPaciente> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PacienteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Api\Models\Base\PacienteQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Api\\Models\\Paciente', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPacienteQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPacienteQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPacienteQuery) {
            return $criteria;
        }
        $query = new ChildPacienteQuery();
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
     * @return ChildPaciente|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PacienteTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PacienteTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPaciente A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, situacao_administ, posto_graduacao, nip_paciente, nip_titular, cpf_titular, origem, corpo_quadro, atleta, atleta_modalidade, outra_modalidade FROM pacientes WHERE id = :p0';
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
            /** @var ChildPaciente $obj */
            $obj = new ChildPaciente();
            $obj->hydrate($row);
            PacienteTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPaciente|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PacienteTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PacienteTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(PacienteTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PacienteTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nome column
     *
     * Example usage:
     * <code>
     * $query->filterByNome('fooValue');   // WHERE nome = 'fooValue'
     * $query->filterByNome('%fooValue%', Criteria::LIKE); // WHERE nome LIKE '%fooValue%'
     * $query->filterByNome(['foo', 'bar']); // WHERE nome IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nome The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNome($nome = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_NOME, $nome, $comparison);

        return $this;
    }

    /**
     * Filter the query on the situacao_administ column
     *
     * Example usage:
     * <code>
     * $query->filterBySituacaoAdmistrativa('fooValue');   // WHERE situacao_administ = 'fooValue'
     * $query->filterBySituacaoAdmistrativa('%fooValue%', Criteria::LIKE); // WHERE situacao_administ LIKE '%fooValue%'
     * $query->filterBySituacaoAdmistrativa(['foo', 'bar']); // WHERE situacao_administ IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $situacaoAdmistrativa The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySituacaoAdmistrativa($situacaoAdmistrativa = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($situacaoAdmistrativa)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_SITUACAO_ADMINIST, $situacaoAdmistrativa, $comparison);

        return $this;
    }

    /**
     * Filter the query on the posto_graduacao column
     *
     * Example usage:
     * <code>
     * $query->filterByPostoGraduacao('fooValue');   // WHERE posto_graduacao = 'fooValue'
     * $query->filterByPostoGraduacao('%fooValue%', Criteria::LIKE); // WHERE posto_graduacao LIKE '%fooValue%'
     * $query->filterByPostoGraduacao(['foo', 'bar']); // WHERE posto_graduacao IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $postoGraduacao The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPostoGraduacao($postoGraduacao = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postoGraduacao)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_POSTO_GRADUACAO, $postoGraduacao, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nip_paciente column
     *
     * Example usage:
     * <code>
     * $query->filterByNip('fooValue');   // WHERE nip_paciente = 'fooValue'
     * $query->filterByNip('%fooValue%', Criteria::LIKE); // WHERE nip_paciente LIKE '%fooValue%'
     * $query->filterByNip(['foo', 'bar']); // WHERE nip_paciente IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nip The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNip($nip = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nip)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_NIP_PACIENTE, $nip, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nip_titular column
     *
     * Example usage:
     * <code>
     * $query->filterByNipTitular('fooValue');   // WHERE nip_titular = 'fooValue'
     * $query->filterByNipTitular('%fooValue%', Criteria::LIKE); // WHERE nip_titular LIKE '%fooValue%'
     * $query->filterByNipTitular(['foo', 'bar']); // WHERE nip_titular IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nipTitular The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNipTitular($nipTitular = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nipTitular)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_NIP_TITULAR, $nipTitular, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cpf_titular column
     *
     * Example usage:
     * <code>
     * $query->filterByCpfTitular('fooValue');   // WHERE cpf_titular = 'fooValue'
     * $query->filterByCpfTitular('%fooValue%', Criteria::LIKE); // WHERE cpf_titular LIKE '%fooValue%'
     * $query->filterByCpfTitular(['foo', 'bar']); // WHERE cpf_titular IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cpfTitular The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCpfTitular($cpfTitular = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpfTitular)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_CPF_TITULAR, $cpfTitular, $comparison);

        return $this;
    }

    /**
     * Filter the query on the origem column
     *
     * Example usage:
     * <code>
     * $query->filterByOrigem('fooValue');   // WHERE origem = 'fooValue'
     * $query->filterByOrigem('%fooValue%', Criteria::LIKE); // WHERE origem LIKE '%fooValue%'
     * $query->filterByOrigem(['foo', 'bar']); // WHERE origem IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $origem The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrigem($origem = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($origem)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_ORIGEM, $origem, $comparison);

        return $this;
    }

    /**
     * Filter the query on the corpo_quadro column
     *
     * Example usage:
     * <code>
     * $query->filterByCorpoQuadro('fooValue');   // WHERE corpo_quadro = 'fooValue'
     * $query->filterByCorpoQuadro('%fooValue%', Criteria::LIKE); // WHERE corpo_quadro LIKE '%fooValue%'
     * $query->filterByCorpoQuadro(['foo', 'bar']); // WHERE corpo_quadro IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $corpoQuadro The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCorpoQuadro($corpoQuadro = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($corpoQuadro)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_CORPO_QUADRO, $corpoQuadro, $comparison);

        return $this;
    }

    /**
     * Filter the query on the atleta column
     *
     * Example usage:
     * <code>
     * $query->filterByAtleta(true); // WHERE atleta = true
     * $query->filterByAtleta('yes'); // WHERE atleta = true
     * </code>
     *
     * @param bool|string $atleta The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAtleta($atleta = null, ?string $comparison = null)
    {
        if (is_string($atleta)) {
            $atleta = in_array(strtolower($atleta), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(PacienteTableMap::COL_ATLETA, $atleta, $comparison);

        return $this;
    }

    /**
     * Filter the query on the atleta_modalidade column
     *
     * Example usage:
     * <code>
     * $query->filterByModalidade('fooValue');   // WHERE atleta_modalidade = 'fooValue'
     * $query->filterByModalidade('%fooValue%', Criteria::LIKE); // WHERE atleta_modalidade LIKE '%fooValue%'
     * $query->filterByModalidade(['foo', 'bar']); // WHERE atleta_modalidade IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $modalidade The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModalidade($modalidade = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modalidade)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_ATLETA_MODALIDADE, $modalidade, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outra_modalidade column
     *
     * Example usage:
     * <code>
     * $query->filterByOutraModalidade('fooValue');   // WHERE outra_modalidade = 'fooValue'
     * $query->filterByOutraModalidade('%fooValue%', Criteria::LIKE); // WHERE outra_modalidade LIKE '%fooValue%'
     * $query->filterByOutraModalidade(['foo', 'bar']); // WHERE outra_modalidade IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outraModalidade The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutraModalidade($outraModalidade = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outraModalidade)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacienteTableMap::COL_OUTRA_MODALIDADE, $outraModalidade, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Api\Models\Registro object
     *
     * @param \Api\Models\Registro|ObjectCollection $registro the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistro($registro, ?string $comparison = null)
    {
        if ($registro instanceof \Api\Models\Registro) {
            $this
                ->addUsingAlias(PacienteTableMap::COL_ID, $registro->getPacienteId(), $comparison);

            return $this;
        } elseif ($registro instanceof ObjectCollection) {
            $this
                ->useRegistroQuery()
                ->filterByPrimaryKeys($registro->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByRegistro() only accepts arguments of type \Api\Models\Registro or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Registro relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRegistro(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Registro');

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
            $this->addJoinObject($join, 'Registro');
        }

        return $this;
    }

    /**
     * Use the Registro relation Registro object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Api\Models\RegistroQuery A secondary query class using the current class as primary query
     */
    public function useRegistroQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRegistro($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Registro', '\Api\Models\RegistroQuery');
    }

    /**
     * Use the Registro relation Registro object
     *
     * @param callable(\Api\Models\RegistroQuery):\Api\Models\RegistroQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRegistroQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useRegistroQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Registro table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Api\Models\RegistroQuery The inner query object of the EXISTS statement
     */
    public function useRegistroExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Registro', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Registro table for a NOT EXISTS query.
     *
     * @see useRegistroExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Api\Models\RegistroQuery The inner query object of the NOT EXISTS statement
     */
    public function useRegistroNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Registro', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildPaciente $paciente Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($paciente = null)
    {
        if ($paciente) {
            $this->addUsingAlias(PacienteTableMap::COL_ID, $paciente->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pacientes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PacienteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PacienteTableMap::clearInstancePool();
            PacienteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PacienteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PacienteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PacienteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PacienteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
