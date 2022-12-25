<?php

namespace Models\Base;

use \Exception;
use \PDO;
use Models\Pacientes as ChildPacientes;
use Models\PacientesQuery as ChildPacientesQuery;
use Models\Map\PacientesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pacientes' table.
 *
 *
 *
 * @method     ChildPacientesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPacientesQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildPacientesQuery orderBySituacaoAdm($order = Criteria::ASC) Order by the situacao_adm column
 * @method     ChildPacientesQuery orderByPostoGraduacao($order = Criteria::ASC) Order by the posto_graduacao column
 * @method     ChildPacientesQuery orderByNipPaciente($order = Criteria::ASC) Order by the nip_paciente column
 * @method     ChildPacientesQuery orderByNipTitular($order = Criteria::ASC) Order by the nip_titular column
 * @method     ChildPacientesQuery orderByCpfTitular($order = Criteria::ASC) Order by the cpf_titular column
 * @method     ChildPacientesQuery orderByOrigem($order = Criteria::ASC) Order by the origem column
 * @method     ChildPacientesQuery orderByCorpoquadro($order = Criteria::ASC) Order by the corpoquadro column
 * @method     ChildPacientesQuery orderByAtleta($order = Criteria::ASC) Order by the atleta column
 * @method     ChildPacientesQuery orderByModalidade($order = Criteria::ASC) Order by the modalidade column
 * @method     ChildPacientesQuery orderByOutraModalidade($order = Criteria::ASC) Order by the outra_modalidade column
 *
 * @method     ChildPacientesQuery groupById() Group by the id column
 * @method     ChildPacientesQuery groupByNome() Group by the nome column
 * @method     ChildPacientesQuery groupBySituacaoAdm() Group by the situacao_adm column
 * @method     ChildPacientesQuery groupByPostoGraduacao() Group by the posto_graduacao column
 * @method     ChildPacientesQuery groupByNipPaciente() Group by the nip_paciente column
 * @method     ChildPacientesQuery groupByNipTitular() Group by the nip_titular column
 * @method     ChildPacientesQuery groupByCpfTitular() Group by the cpf_titular column
 * @method     ChildPacientesQuery groupByOrigem() Group by the origem column
 * @method     ChildPacientesQuery groupByCorpoquadro() Group by the corpoquadro column
 * @method     ChildPacientesQuery groupByAtleta() Group by the atleta column
 * @method     ChildPacientesQuery groupByModalidade() Group by the modalidade column
 * @method     ChildPacientesQuery groupByOutraModalidade() Group by the outra_modalidade column
 *
 * @method     ChildPacientesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPacientesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPacientesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPacientesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPacientesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPacientesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPacientes|null findOne(?ConnectionInterface $con = null) Return the first ChildPacientes matching the query
 * @method     ChildPacientes findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPacientes matching the query, or a new ChildPacientes object populated from the query conditions when no match is found
 *
 * @method     ChildPacientes|null findOneById(int $id) Return the first ChildPacientes filtered by the id column
 * @method     ChildPacientes|null findOneByNome(string $nome) Return the first ChildPacientes filtered by the nome column
 * @method     ChildPacientes|null findOneBySituacaoAdm(string $situacao_adm) Return the first ChildPacientes filtered by the situacao_adm column
 * @method     ChildPacientes|null findOneByPostoGraduacao(string $posto_graduacao) Return the first ChildPacientes filtered by the posto_graduacao column
 * @method     ChildPacientes|null findOneByNipPaciente(int $nip_paciente) Return the first ChildPacientes filtered by the nip_paciente column
 * @method     ChildPacientes|null findOneByNipTitular(int $nip_titular) Return the first ChildPacientes filtered by the nip_titular column
 * @method     ChildPacientes|null findOneByCpfTitular(string $cpf_titular) Return the first ChildPacientes filtered by the cpf_titular column
 * @method     ChildPacientes|null findOneByOrigem(string $origem) Return the first ChildPacientes filtered by the origem column
 * @method     ChildPacientes|null findOneByCorpoquadro(string $corpoquadro) Return the first ChildPacientes filtered by the corpoquadro column
 * @method     ChildPacientes|null findOneByAtleta(string $atleta) Return the first ChildPacientes filtered by the atleta column
 * @method     ChildPacientes|null findOneByModalidade(string $modalidade) Return the first ChildPacientes filtered by the modalidade column
 * @method     ChildPacientes|null findOneByOutraModalidade(string $outra_modalidade) Return the first ChildPacientes filtered by the outra_modalidade column *

 * @method     ChildPacientes requirePk($key, ?ConnectionInterface $con = null) Return the ChildPacientes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOne(?ConnectionInterface $con = null) Return the first ChildPacientes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPacientes requireOneById(int $id) Return the first ChildPacientes filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByNome(string $nome) Return the first ChildPacientes filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneBySituacaoAdm(string $situacao_adm) Return the first ChildPacientes filtered by the situacao_adm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByPostoGraduacao(string $posto_graduacao) Return the first ChildPacientes filtered by the posto_graduacao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByNipPaciente(int $nip_paciente) Return the first ChildPacientes filtered by the nip_paciente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByNipTitular(int $nip_titular) Return the first ChildPacientes filtered by the nip_titular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByCpfTitular(string $cpf_titular) Return the first ChildPacientes filtered by the cpf_titular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByOrigem(string $origem) Return the first ChildPacientes filtered by the origem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByCorpoquadro(string $corpoquadro) Return the first ChildPacientes filtered by the corpoquadro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByAtleta(string $atleta) Return the first ChildPacientes filtered by the atleta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByModalidade(string $modalidade) Return the first ChildPacientes filtered by the modalidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPacientes requireOneByOutraModalidade(string $outra_modalidade) Return the first ChildPacientes filtered by the outra_modalidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPacientes[]|Collection find(?ConnectionInterface $con = null) Return ChildPacientes objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPacientes> find(?ConnectionInterface $con = null) Return ChildPacientes objects based on current ModelCriteria
 * @method     ChildPacientes[]|Collection findById(int $id) Return ChildPacientes objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildPacientes> findById(int $id) Return ChildPacientes objects filtered by the id column
 * @method     ChildPacientes[]|Collection findByNome(string $nome) Return ChildPacientes objects filtered by the nome column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByNome(string $nome) Return ChildPacientes objects filtered by the nome column
 * @method     ChildPacientes[]|Collection findBySituacaoAdm(string $situacao_adm) Return ChildPacientes objects filtered by the situacao_adm column
 * @psalm-method Collection&\Traversable<ChildPacientes> findBySituacaoAdm(string $situacao_adm) Return ChildPacientes objects filtered by the situacao_adm column
 * @method     ChildPacientes[]|Collection findByPostoGraduacao(string $posto_graduacao) Return ChildPacientes objects filtered by the posto_graduacao column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByPostoGraduacao(string $posto_graduacao) Return ChildPacientes objects filtered by the posto_graduacao column
 * @method     ChildPacientes[]|Collection findByNipPaciente(int $nip_paciente) Return ChildPacientes objects filtered by the nip_paciente column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByNipPaciente(int $nip_paciente) Return ChildPacientes objects filtered by the nip_paciente column
 * @method     ChildPacientes[]|Collection findByNipTitular(int $nip_titular) Return ChildPacientes objects filtered by the nip_titular column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByNipTitular(int $nip_titular) Return ChildPacientes objects filtered by the nip_titular column
 * @method     ChildPacientes[]|Collection findByCpfTitular(string $cpf_titular) Return ChildPacientes objects filtered by the cpf_titular column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByCpfTitular(string $cpf_titular) Return ChildPacientes objects filtered by the cpf_titular column
 * @method     ChildPacientes[]|Collection findByOrigem(string $origem) Return ChildPacientes objects filtered by the origem column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByOrigem(string $origem) Return ChildPacientes objects filtered by the origem column
 * @method     ChildPacientes[]|Collection findByCorpoquadro(string $corpoquadro) Return ChildPacientes objects filtered by the corpoquadro column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByCorpoquadro(string $corpoquadro) Return ChildPacientes objects filtered by the corpoquadro column
 * @method     ChildPacientes[]|Collection findByAtleta(string $atleta) Return ChildPacientes objects filtered by the atleta column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByAtleta(string $atleta) Return ChildPacientes objects filtered by the atleta column
 * @method     ChildPacientes[]|Collection findByModalidade(string $modalidade) Return ChildPacientes objects filtered by the modalidade column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByModalidade(string $modalidade) Return ChildPacientes objects filtered by the modalidade column
 * @method     ChildPacientes[]|Collection findByOutraModalidade(string $outra_modalidade) Return ChildPacientes objects filtered by the outra_modalidade column
 * @psalm-method Collection&\Traversable<ChildPacientes> findByOutraModalidade(string $outra_modalidade) Return ChildPacientes objects filtered by the outra_modalidade column
 * @method     ChildPacientes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPacientes> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PacientesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Base\PacientesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Models\\Pacientes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPacientesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPacientesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPacientesQuery) {
            return $criteria;
        }
        $query = new ChildPacientesQuery();
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
     * @return ChildPacientes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PacientesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PacientesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPacientes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, situacao_adm, posto_graduacao, nip_paciente, nip_titular, cpf_titular, origem, corpoquadro, atleta, modalidade, outra_modalidade FROM pacientes WHERE id = :p0';
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
            /** @var ChildPacientes $obj */
            $obj = new ChildPacientes();
            $obj->hydrate($row);
            PacientesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPacientes|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PacientesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PacientesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(PacientesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PacientesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacientesTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(PacientesTableMap::COL_NOME, $nome, $comparison);

        return $this;
    }

    /**
     * Filter the query on the situacao_adm column
     *
     * Example usage:
     * <code>
     * $query->filterBySituacaoAdm('fooValue');   // WHERE situacao_adm = 'fooValue'
     * $query->filterBySituacaoAdm('%fooValue%', Criteria::LIKE); // WHERE situacao_adm LIKE '%fooValue%'
     * $query->filterBySituacaoAdm(['foo', 'bar']); // WHERE situacao_adm IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $situacaoAdm The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySituacaoAdm($situacaoAdm = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($situacaoAdm)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacientesTableMap::COL_SITUACAO_ADM, $situacaoAdm, $comparison);

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

        $this->addUsingAlias(PacientesTableMap::COL_POSTO_GRADUACAO, $postoGraduacao, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nip_paciente column
     *
     * Example usage:
     * <code>
     * $query->filterByNipPaciente(1234); // WHERE nip_paciente = 1234
     * $query->filterByNipPaciente(array(12, 34)); // WHERE nip_paciente IN (12, 34)
     * $query->filterByNipPaciente(array('min' => 12)); // WHERE nip_paciente > 12
     * </code>
     *
     * @param mixed $nipPaciente The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNipPaciente($nipPaciente = null, ?string $comparison = null)
    {
        if (is_array($nipPaciente)) {
            $useMinMax = false;
            if (isset($nipPaciente['min'])) {
                $this->addUsingAlias(PacientesTableMap::COL_NIP_PACIENTE, $nipPaciente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nipPaciente['max'])) {
                $this->addUsingAlias(PacientesTableMap::COL_NIP_PACIENTE, $nipPaciente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacientesTableMap::COL_NIP_PACIENTE, $nipPaciente, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nip_titular column
     *
     * Example usage:
     * <code>
     * $query->filterByNipTitular(1234); // WHERE nip_titular = 1234
     * $query->filterByNipTitular(array(12, 34)); // WHERE nip_titular IN (12, 34)
     * $query->filterByNipTitular(array('min' => 12)); // WHERE nip_titular > 12
     * </code>
     *
     * @param mixed $nipTitular The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNipTitular($nipTitular = null, ?string $comparison = null)
    {
        if (is_array($nipTitular)) {
            $useMinMax = false;
            if (isset($nipTitular['min'])) {
                $this->addUsingAlias(PacientesTableMap::COL_NIP_TITULAR, $nipTitular['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nipTitular['max'])) {
                $this->addUsingAlias(PacientesTableMap::COL_NIP_TITULAR, $nipTitular['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacientesTableMap::COL_NIP_TITULAR, $nipTitular, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cpf_titular column
     *
     * Example usage:
     * <code>
     * $query->filterByCpfTitular(1234); // WHERE cpf_titular = 1234
     * $query->filterByCpfTitular(array(12, 34)); // WHERE cpf_titular IN (12, 34)
     * $query->filterByCpfTitular(array('min' => 12)); // WHERE cpf_titular > 12
     * </code>
     *
     * @param mixed $cpfTitular The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCpfTitular($cpfTitular = null, ?string $comparison = null)
    {
        if (is_array($cpfTitular)) {
            $useMinMax = false;
            if (isset($cpfTitular['min'])) {
                $this->addUsingAlias(PacientesTableMap::COL_CPF_TITULAR, $cpfTitular['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cpfTitular['max'])) {
                $this->addUsingAlias(PacientesTableMap::COL_CPF_TITULAR, $cpfTitular['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacientesTableMap::COL_CPF_TITULAR, $cpfTitular, $comparison);

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

        $this->addUsingAlias(PacientesTableMap::COL_ORIGEM, $origem, $comparison);

        return $this;
    }

    /**
     * Filter the query on the corpoquadro column
     *
     * Example usage:
     * <code>
     * $query->filterByCorpoquadro('fooValue');   // WHERE corpoquadro = 'fooValue'
     * $query->filterByCorpoquadro('%fooValue%', Criteria::LIKE); // WHERE corpoquadro LIKE '%fooValue%'
     * $query->filterByCorpoquadro(['foo', 'bar']); // WHERE corpoquadro IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $corpoquadro The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCorpoquadro($corpoquadro = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($corpoquadro)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacientesTableMap::COL_CORPOQUADRO, $corpoquadro, $comparison);

        return $this;
    }

    /**
     * Filter the query on the atleta column
     *
     * Example usage:
     * <code>
     * $query->filterByAtleta('fooValue');   // WHERE atleta = 'fooValue'
     * $query->filterByAtleta('%fooValue%', Criteria::LIKE); // WHERE atleta LIKE '%fooValue%'
     * $query->filterByAtleta(['foo', 'bar']); // WHERE atleta IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $atleta The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAtleta($atleta = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($atleta)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PacientesTableMap::COL_ATLETA, $atleta, $comparison);

        return $this;
    }

    /**
     * Filter the query on the modalidade column
     *
     * Example usage:
     * <code>
     * $query->filterByModalidade('fooValue');   // WHERE modalidade = 'fooValue'
     * $query->filterByModalidade('%fooValue%', Criteria::LIKE); // WHERE modalidade LIKE '%fooValue%'
     * $query->filterByModalidade(['foo', 'bar']); // WHERE modalidade IN ('foo', 'bar')
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

        $this->addUsingAlias(PacientesTableMap::COL_MODALIDADE, $modalidade, $comparison);

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

        $this->addUsingAlias(PacientesTableMap::COL_OUTRA_MODALIDADE, $outraModalidade, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPacientes $pacientes Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pacientes = null)
    {
        if ($pacientes) {
            $this->addUsingAlias(PacientesTableMap::COL_ID, $pacientes->getId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(PacientesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PacientesTableMap::clearInstancePool();
            PacientesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PacientesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PacientesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PacientesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PacientesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
