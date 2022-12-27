<?php

namespace Models\Base;

use \Exception;
use \PDO;
use Models\Usuarios as ChildUsuarios;
use Models\UsuariosQuery as ChildUsuariosQuery;
use Models\Map\UsuariosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'usuarios' table.
 *
 *
 *
 * @method     ChildUsuariosQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsuariosQuery orderByUsuario($order = Criteria::ASC) Order by the usuario column
 * @method     ChildUsuariosQuery orderBySenha($order = Criteria::ASC) Order by the senha column
 *
 * @method     ChildUsuariosQuery groupById() Group by the id column
 * @method     ChildUsuariosQuery groupByUsuario() Group by the usuario column
 * @method     ChildUsuariosQuery groupBySenha() Group by the senha column
 *
 * @method     ChildUsuariosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsuariosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsuariosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsuariosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsuariosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsuariosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsuarios|null findOne(?ConnectionInterface $con = null) Return the first ChildUsuarios matching the query
 * @method     ChildUsuarios findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsuarios matching the query, or a new ChildUsuarios object populated from the query conditions when no match is found
 *
 * @method     ChildUsuarios|null findOneById(int $id) Return the first ChildUsuarios filtered by the id column
 * @method     ChildUsuarios|null findOneByUsuario(string $usuario) Return the first ChildUsuarios filtered by the usuario column
 * @method     ChildUsuarios|null findOneBySenha(string $senha) Return the first ChildUsuarios filtered by the senha column *

 * @method     ChildUsuarios requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsuarios by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOne(?ConnectionInterface $con = null) Return the first ChildUsuarios matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuarios requireOneById(int $id) Return the first ChildUsuarios filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByUsuario(string $usuario) Return the first ChildUsuarios filtered by the usuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneBySenha(string $senha) Return the first ChildUsuarios filtered by the senha column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuarios[]|Collection find(?ConnectionInterface $con = null) Return ChildUsuarios objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsuarios> find(?ConnectionInterface $con = null) Return ChildUsuarios objects based on current ModelCriteria
 * @method     ChildUsuarios[]|Collection findById(int $id) Return ChildUsuarios objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsuarios> findById(int $id) Return ChildUsuarios objects filtered by the id column
 * @method     ChildUsuarios[]|Collection findByUsuario(string $usuario) Return ChildUsuarios objects filtered by the usuario column
 * @psalm-method Collection&\Traversable<ChildUsuarios> findByUsuario(string $usuario) Return ChildUsuarios objects filtered by the usuario column
 * @method     ChildUsuarios[]|Collection findBySenha(string $senha) Return ChildUsuarios objects filtered by the senha column
 * @psalm-method Collection&\Traversable<ChildUsuarios> findBySenha(string $senha) Return ChildUsuarios objects filtered by the senha column
 * @method     ChildUsuarios[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsuarios> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsuariosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Base\UsuariosQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Models\\Usuarios', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsuariosQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsuariosQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsuariosQuery) {
            return $criteria;
        }
        $query = new ChildUsuariosQuery();
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
     * @return ChildUsuarios|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuariosTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsuariosTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsuarios A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, usuario, senha FROM usuarios WHERE id = :p0';
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
            /** @var ChildUsuarios $obj */
            $obj = new ChildUsuarios();
            $obj->hydrate($row);
            UsuariosTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsuarios|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UsuariosTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UsuariosTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UsuariosTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsuariosTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsuariosTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the usuario column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuario('fooValue');   // WHERE usuario = 'fooValue'
     * $query->filterByUsuario('%fooValue%', Criteria::LIKE); // WHERE usuario LIKE '%fooValue%'
     * $query->filterByUsuario(['foo', 'bar']); // WHERE usuario IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $usuario The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsuario($usuario = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuario)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsuariosTableMap::COL_USUARIO, $usuario, $comparison);

        return $this;
    }

    /**
     * Filter the query on the senha column
     *
     * Example usage:
     * <code>
     * $query->filterBySenha('fooValue');   // WHERE senha = 'fooValue'
     * $query->filterBySenha('%fooValue%', Criteria::LIKE); // WHERE senha LIKE '%fooValue%'
     * $query->filterBySenha(['foo', 'bar']); // WHERE senha IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $senha The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySenha($senha = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($senha)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsuariosTableMap::COL_SENHA, $senha, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUsuarios $usuarios Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($usuarios = null)
    {
        if ($usuarios) {
            $this->addUsingAlias(UsuariosTableMap::COL_ID, $usuarios->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the usuarios table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuariosTableMap::clearInstancePool();
            UsuariosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsuariosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsuariosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsuariosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
