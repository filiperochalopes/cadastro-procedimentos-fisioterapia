<?php

namespace Api\Models\Base;

use \Exception;
use \PDO;
use Api\Models\Fisioterapeuta as ChildFisioterapeuta;
use Api\Models\FisioterapeutaQuery as ChildFisioterapeutaQuery;
use Api\Models\Map\FisioterapeutaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'fisioterapeutas' table.
 *
 *
 *
 * @method     ChildFisioterapeutaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFisioterapeutaQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildFisioterapeutaQuery orderByDesabilitado($order = Criteria::ASC) Order by the disabled column
 *
 * @method     ChildFisioterapeutaQuery groupById() Group by the id column
 * @method     ChildFisioterapeutaQuery groupByNome() Group by the nome column
 * @method     ChildFisioterapeutaQuery groupByDesabilitado() Group by the disabled column
 *
 * @method     ChildFisioterapeutaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFisioterapeutaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFisioterapeutaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFisioterapeutaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFisioterapeutaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFisioterapeutaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFisioterapeutaQuery leftJoinRegistro($relationAlias = null) Adds a LEFT JOIN clause to the query using the Registro relation
 * @method     ChildFisioterapeutaQuery rightJoinRegistro($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Registro relation
 * @method     ChildFisioterapeutaQuery innerJoinRegistro($relationAlias = null) Adds a INNER JOIN clause to the query using the Registro relation
 *
 * @method     ChildFisioterapeutaQuery joinWithRegistro($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Registro relation
 *
 * @method     ChildFisioterapeutaQuery leftJoinWithRegistro() Adds a LEFT JOIN clause and with to the query using the Registro relation
 * @method     ChildFisioterapeutaQuery rightJoinWithRegistro() Adds a RIGHT JOIN clause and with to the query using the Registro relation
 * @method     ChildFisioterapeutaQuery innerJoinWithRegistro() Adds a INNER JOIN clause and with to the query using the Registro relation
 *
 * @method     \Api\Models\RegistroQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFisioterapeuta|null findOne(?ConnectionInterface $con = null) Return the first ChildFisioterapeuta matching the query
 * @method     ChildFisioterapeuta findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildFisioterapeuta matching the query, or a new ChildFisioterapeuta object populated from the query conditions when no match is found
 *
 * @method     ChildFisioterapeuta|null findOneById(int $id) Return the first ChildFisioterapeuta filtered by the id column
 * @method     ChildFisioterapeuta|null findOneByNome(string $nome) Return the first ChildFisioterapeuta filtered by the nome column
 * @method     ChildFisioterapeuta|null findOneByDesabilitado(boolean $disabled) Return the first ChildFisioterapeuta filtered by the disabled column *

 * @method     ChildFisioterapeuta requirePk($key, ?ConnectionInterface $con = null) Return the ChildFisioterapeuta by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFisioterapeuta requireOne(?ConnectionInterface $con = null) Return the first ChildFisioterapeuta matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFisioterapeuta requireOneById(int $id) Return the first ChildFisioterapeuta filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFisioterapeuta requireOneByNome(string $nome) Return the first ChildFisioterapeuta filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFisioterapeuta requireOneByDesabilitado(boolean $disabled) Return the first ChildFisioterapeuta filtered by the disabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFisioterapeuta[]|Collection find(?ConnectionInterface $con = null) Return ChildFisioterapeuta objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildFisioterapeuta> find(?ConnectionInterface $con = null) Return ChildFisioterapeuta objects based on current ModelCriteria
 * @method     ChildFisioterapeuta[]|Collection findById(int $id) Return ChildFisioterapeuta objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildFisioterapeuta> findById(int $id) Return ChildFisioterapeuta objects filtered by the id column
 * @method     ChildFisioterapeuta[]|Collection findByNome(string $nome) Return ChildFisioterapeuta objects filtered by the nome column
 * @psalm-method Collection&\Traversable<ChildFisioterapeuta> findByNome(string $nome) Return ChildFisioterapeuta objects filtered by the nome column
 * @method     ChildFisioterapeuta[]|Collection findByDesabilitado(boolean $disabled) Return ChildFisioterapeuta objects filtered by the disabled column
 * @psalm-method Collection&\Traversable<ChildFisioterapeuta> findByDesabilitado(boolean $disabled) Return ChildFisioterapeuta objects filtered by the disabled column
 * @method     ChildFisioterapeuta[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildFisioterapeuta> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FisioterapeutaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Api\Models\Base\FisioterapeutaQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Api\\Models\\Fisioterapeuta', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFisioterapeutaQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFisioterapeutaQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildFisioterapeutaQuery) {
            return $criteria;
        }
        $query = new ChildFisioterapeutaQuery();
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
     * @return ChildFisioterapeuta|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FisioterapeutaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FisioterapeutaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFisioterapeuta A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, disabled FROM fisioterapeutas WHERE id = :p0';
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
            /** @var ChildFisioterapeuta $obj */
            $obj = new ChildFisioterapeuta();
            $obj->hydrate($row);
            FisioterapeutaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFisioterapeuta|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(FisioterapeutaTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(FisioterapeutaTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(FisioterapeutaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FisioterapeutaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FisioterapeutaTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(FisioterapeutaTableMap::COL_NOME, $nome, $comparison);

        return $this;
    }

    /**
     * Filter the query on the disabled column
     *
     * Example usage:
     * <code>
     * $query->filterByDesabilitado(true); // WHERE disabled = true
     * $query->filterByDesabilitado('yes'); // WHERE disabled = true
     * </code>
     *
     * @param bool|string $desabilitado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesabilitado($desabilitado = null, ?string $comparison = null)
    {
        if (is_string($desabilitado)) {
            $desabilitado = in_array(strtolower($desabilitado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(FisioterapeutaTableMap::COL_DISABLED, $desabilitado, $comparison);

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
                ->addUsingAlias(FisioterapeutaTableMap::COL_ID, $registro->getFisioterapeutaId(), $comparison);

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
     * @param ChildFisioterapeuta $fisioterapeuta Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($fisioterapeuta = null)
    {
        if ($fisioterapeuta) {
            $this->addUsingAlias(FisioterapeutaTableMap::COL_ID, $fisioterapeuta->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fisioterapeutas table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FisioterapeutaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FisioterapeutaTableMap::clearInstancePool();
            FisioterapeutaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FisioterapeutaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FisioterapeutaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FisioterapeutaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FisioterapeutaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
