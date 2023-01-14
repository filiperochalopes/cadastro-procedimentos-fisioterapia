<?php

namespace Api\Models\Base;

use \Exception;
use \PDO;
use Api\Models\RegistroProcedimento as ChildRegistroProcedimento;
use Api\Models\RegistroProcedimentoQuery as ChildRegistroProcedimentoQuery;
use Api\Models\Map\RegistroProcedimentoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'registro_procedimento' table.
 *
 *
 *
 * @method     ChildRegistroProcedimentoQuery orderByRegistroId($order = Criteria::ASC) Order by the registro_id column
 * @method     ChildRegistroProcedimentoQuery orderByProcedimentoId($order = Criteria::ASC) Order by the procedimento_id column
 *
 * @method     ChildRegistroProcedimentoQuery groupByRegistroId() Group by the registro_id column
 * @method     ChildRegistroProcedimentoQuery groupByProcedimentoId() Group by the procedimento_id column
 *
 * @method     ChildRegistroProcedimentoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegistroProcedimentoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegistroProcedimentoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegistroProcedimentoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRegistroProcedimentoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRegistroProcedimentoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRegistroProcedimentoQuery leftJoinRegistro($relationAlias = null) Adds a LEFT JOIN clause to the query using the Registro relation
 * @method     ChildRegistroProcedimentoQuery rightJoinRegistro($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Registro relation
 * @method     ChildRegistroProcedimentoQuery innerJoinRegistro($relationAlias = null) Adds a INNER JOIN clause to the query using the Registro relation
 *
 * @method     ChildRegistroProcedimentoQuery joinWithRegistro($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Registro relation
 *
 * @method     ChildRegistroProcedimentoQuery leftJoinWithRegistro() Adds a LEFT JOIN clause and with to the query using the Registro relation
 * @method     ChildRegistroProcedimentoQuery rightJoinWithRegistro() Adds a RIGHT JOIN clause and with to the query using the Registro relation
 * @method     ChildRegistroProcedimentoQuery innerJoinWithRegistro() Adds a INNER JOIN clause and with to the query using the Registro relation
 *
 * @method     ChildRegistroProcedimentoQuery leftJoinProcedimento($relationAlias = null) Adds a LEFT JOIN clause to the query using the Procedimento relation
 * @method     ChildRegistroProcedimentoQuery rightJoinProcedimento($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Procedimento relation
 * @method     ChildRegistroProcedimentoQuery innerJoinProcedimento($relationAlias = null) Adds a INNER JOIN clause to the query using the Procedimento relation
 *
 * @method     ChildRegistroProcedimentoQuery joinWithProcedimento($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Procedimento relation
 *
 * @method     ChildRegistroProcedimentoQuery leftJoinWithProcedimento() Adds a LEFT JOIN clause and with to the query using the Procedimento relation
 * @method     ChildRegistroProcedimentoQuery rightJoinWithProcedimento() Adds a RIGHT JOIN clause and with to the query using the Procedimento relation
 * @method     ChildRegistroProcedimentoQuery innerJoinWithProcedimento() Adds a INNER JOIN clause and with to the query using the Procedimento relation
 *
 * @method     \Api\Models\RegistroQuery|\Api\Models\ProcedimentoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegistroProcedimento|null findOne(?ConnectionInterface $con = null) Return the first ChildRegistroProcedimento matching the query
 * @method     ChildRegistroProcedimento findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRegistroProcedimento matching the query, or a new ChildRegistroProcedimento object populated from the query conditions when no match is found
 *
 * @method     ChildRegistroProcedimento|null findOneByRegistroId(int $registro_id) Return the first ChildRegistroProcedimento filtered by the registro_id column
 * @method     ChildRegistroProcedimento|null findOneByProcedimentoId(int $procedimento_id) Return the first ChildRegistroProcedimento filtered by the procedimento_id column *

 * @method     ChildRegistroProcedimento requirePk($key, ?ConnectionInterface $con = null) Return the ChildRegistroProcedimento by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistroProcedimento requireOne(?ConnectionInterface $con = null) Return the first ChildRegistroProcedimento matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistroProcedimento requireOneByRegistroId(int $registro_id) Return the first ChildRegistroProcedimento filtered by the registro_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistroProcedimento requireOneByProcedimentoId(int $procedimento_id) Return the first ChildRegistroProcedimento filtered by the procedimento_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistroProcedimento[]|Collection find(?ConnectionInterface $con = null) Return ChildRegistroProcedimento objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRegistroProcedimento> find(?ConnectionInterface $con = null) Return ChildRegistroProcedimento objects based on current ModelCriteria
 * @method     ChildRegistroProcedimento[]|Collection findByRegistroId(int $registro_id) Return ChildRegistroProcedimento objects filtered by the registro_id column
 * @psalm-method Collection&\Traversable<ChildRegistroProcedimento> findByRegistroId(int $registro_id) Return ChildRegistroProcedimento objects filtered by the registro_id column
 * @method     ChildRegistroProcedimento[]|Collection findByProcedimentoId(int $procedimento_id) Return ChildRegistroProcedimento objects filtered by the procedimento_id column
 * @psalm-method Collection&\Traversable<ChildRegistroProcedimento> findByProcedimentoId(int $procedimento_id) Return ChildRegistroProcedimento objects filtered by the procedimento_id column
 * @method     ChildRegistroProcedimento[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRegistroProcedimento> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RegistroProcedimentoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Api\Models\Base\RegistroProcedimentoQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Api\\Models\\RegistroProcedimento', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegistroProcedimentoQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegistroProcedimentoQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRegistroProcedimentoQuery) {
            return $criteria;
        }
        $query = new ChildRegistroProcedimentoQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$registro_id, $procedimento_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRegistroProcedimento|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegistroProcedimentoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RegistroProcedimentoTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildRegistroProcedimento A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT registro_id, procedimento_id FROM registro_procedimento WHERE registro_id = :p0 AND procedimento_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRegistroProcedimento $obj */
            $obj = new ChildRegistroProcedimento();
            $obj->hydrate($row);
            RegistroProcedimentoTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildRegistroProcedimento|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
        $this->addUsingAlias(RegistroProcedimentoTableMap::COL_REGISTRO_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, $key[1], Criteria::EQUAL);

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
        if (empty($keys)) {
            $this->add(null, '1<>1', Criteria::CUSTOM);

            return $this;
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(RegistroProcedimentoTableMap::COL_REGISTRO_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the registro_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistroId(1234); // WHERE registro_id = 1234
     * $query->filterByRegistroId(array(12, 34)); // WHERE registro_id IN (12, 34)
     * $query->filterByRegistroId(array('min' => 12)); // WHERE registro_id > 12
     * </code>
     *
     * @see       filterByRegistro()
     *
     * @param mixed $registroId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistroId($registroId = null, ?string $comparison = null)
    {
        if (is_array($registroId)) {
            $useMinMax = false;
            if (isset($registroId['min'])) {
                $this->addUsingAlias(RegistroProcedimentoTableMap::COL_REGISTRO_ID, $registroId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registroId['max'])) {
                $this->addUsingAlias(RegistroProcedimentoTableMap::COL_REGISTRO_ID, $registroId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroProcedimentoTableMap::COL_REGISTRO_ID, $registroId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimentoId(1234); // WHERE procedimento_id = 1234
     * $query->filterByProcedimentoId(array(12, 34)); // WHERE procedimento_id IN (12, 34)
     * $query->filterByProcedimentoId(array('min' => 12)); // WHERE procedimento_id > 12
     * </code>
     *
     * @see       filterByProcedimento()
     *
     * @param mixed $procedimentoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimentoId($procedimentoId = null, ?string $comparison = null)
    {
        if (is_array($procedimentoId)) {
            $useMinMax = false;
            if (isset($procedimentoId['min'])) {
                $this->addUsingAlias(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, $procedimentoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($procedimentoId['max'])) {
                $this->addUsingAlias(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, $procedimentoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, $procedimentoId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Api\Models\Registro object
     *
     * @param \Api\Models\Registro|ObjectCollection $registro The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistro($registro, ?string $comparison = null)
    {
        if ($registro instanceof \Api\Models\Registro) {
            return $this
                ->addUsingAlias(RegistroProcedimentoTableMap::COL_REGISTRO_ID, $registro->getId(), $comparison);
        } elseif ($registro instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(RegistroProcedimentoTableMap::COL_REGISTRO_ID, $registro->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
    public function joinRegistro(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useRegistroQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \Api\Models\Procedimento object
     *
     * @param \Api\Models\Procedimento|ObjectCollection $procedimento The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento($procedimento, ?string $comparison = null)
    {
        if ($procedimento instanceof \Api\Models\Procedimento) {
            return $this
                ->addUsingAlias(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, $procedimento->getId(), $comparison);
        } elseif ($procedimento instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID, $procedimento->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProcedimento() only accepts arguments of type \Api\Models\Procedimento or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Procedimento relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProcedimento(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Procedimento');

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
            $this->addJoinObject($join, 'Procedimento');
        }

        return $this;
    }

    /**
     * Use the Procedimento relation Procedimento object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Api\Models\ProcedimentoQuery A secondary query class using the current class as primary query
     */
    public function useProcedimentoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProcedimento($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Procedimento', '\Api\Models\ProcedimentoQuery');
    }

    /**
     * Use the Procedimento relation Procedimento object
     *
     * @param callable(\Api\Models\ProcedimentoQuery):\Api\Models\ProcedimentoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProcedimentoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProcedimentoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Procedimento table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Api\Models\ProcedimentoQuery The inner query object of the EXISTS statement
     */
    public function useProcedimentoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Procedimento', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Procedimento table for a NOT EXISTS query.
     *
     * @see useProcedimentoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Api\Models\ProcedimentoQuery The inner query object of the NOT EXISTS statement
     */
    public function useProcedimentoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Procedimento', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildRegistroProcedimento $registroProcedimento Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($registroProcedimento = null)
    {
        if ($registroProcedimento) {
            $this->addCond('pruneCond0', $this->getAliasedColName(RegistroProcedimentoTableMap::COL_REGISTRO_ID), $registroProcedimento->getRegistroId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(RegistroProcedimentoTableMap::COL_PROCEDIMENTO_ID), $registroProcedimento->getProcedimentoId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the registro_procedimento table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroProcedimentoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RegistroProcedimentoTableMap::clearInstancePool();
            RegistroProcedimentoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistroProcedimentoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RegistroProcedimentoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RegistroProcedimentoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RegistroProcedimentoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
