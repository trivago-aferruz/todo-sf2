<?php

namespace Todo\TodoBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Todo\TodoBundle\Model\Priority;
use Todo\TodoBundle\Model\Status;
use Todo\TodoBundle\Model\Task;
use Todo\TodoBundle\Model\TaskPeer;
use Todo\TodoBundle\Model\TaskQuery;
use Todo\TodoBundle\Model\User;

/**
 * @method TaskQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TaskQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method TaskQuery orderByStatusId($order = Criteria::ASC) Order by the status_id column
 * @method TaskQuery orderByPriorityId($order = Criteria::ASC) Order by the priority_id column
 * @method TaskQuery orderByReporterId($order = Criteria::ASC) Order by the reporter_id column
 * @method TaskQuery orderByAssigneeId($order = Criteria::ASC) Order by the assignee_id column
 * @method TaskQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method TaskQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method TaskQuery groupById() Group by the id column
 * @method TaskQuery groupByDescription() Group by the description column
 * @method TaskQuery groupByStatusId() Group by the status_id column
 * @method TaskQuery groupByPriorityId() Group by the priority_id column
 * @method TaskQuery groupByReporterId() Group by the reporter_id column
 * @method TaskQuery groupByAssigneeId() Group by the assignee_id column
 * @method TaskQuery groupByCreatedAt() Group by the created_at column
 * @method TaskQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method TaskQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TaskQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TaskQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TaskQuery leftJoinStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the Status relation
 * @method TaskQuery rightJoinStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Status relation
 * @method TaskQuery innerJoinStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the Status relation
 *
 * @method TaskQuery leftJoinPriority($relationAlias = null) Adds a LEFT JOIN clause to the query using the Priority relation
 * @method TaskQuery rightJoinPriority($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Priority relation
 * @method TaskQuery innerJoinPriority($relationAlias = null) Adds a INNER JOIN clause to the query using the Priority relation
 *
 * @method TaskQuery leftJoinreporter($relationAlias = null) Adds a LEFT JOIN clause to the query using the reporter relation
 * @method TaskQuery rightJoinreporter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the reporter relation
 * @method TaskQuery innerJoinreporter($relationAlias = null) Adds a INNER JOIN clause to the query using the reporter relation
 *
 * @method TaskQuery leftJoinassignee($relationAlias = null) Adds a LEFT JOIN clause to the query using the assignee relation
 * @method TaskQuery rightJoinassignee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the assignee relation
 * @method TaskQuery innerJoinassignee($relationAlias = null) Adds a INNER JOIN clause to the query using the assignee relation
 *
 * @method Task findOne(PropelPDO $con = null) Return the first Task matching the query
 * @method Task findOneOrCreate(PropelPDO $con = null) Return the first Task matching the query, or a new Task object populated from the query conditions when no match is found
 *
 * @method Task findOneByDescription(string $description) Return the first Task filtered by the description column
 * @method Task findOneByStatusId(int $status_id) Return the first Task filtered by the status_id column
 * @method Task findOneByPriorityId(int $priority_id) Return the first Task filtered by the priority_id column
 * @method Task findOneByReporterId(int $reporter_id) Return the first Task filtered by the reporter_id column
 * @method Task findOneByAssigneeId(int $assignee_id) Return the first Task filtered by the assignee_id column
 * @method Task findOneByCreatedAt(string $created_at) Return the first Task filtered by the created_at column
 * @method Task findOneByUpdatedAt(string $updated_at) Return the first Task filtered by the updated_at column
 *
 * @method array findById(int $id) Return Task objects filtered by the id column
 * @method array findByDescription(string $description) Return Task objects filtered by the description column
 * @method array findByStatusId(int $status_id) Return Task objects filtered by the status_id column
 * @method array findByPriorityId(int $priority_id) Return Task objects filtered by the priority_id column
 * @method array findByReporterId(int $reporter_id) Return Task objects filtered by the reporter_id column
 * @method array findByAssigneeId(int $assignee_id) Return Task objects filtered by the assignee_id column
 * @method array findByCreatedAt(string $created_at) Return Task objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Task objects filtered by the updated_at column
 */
abstract class BaseTaskQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTaskQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Todo\\TodoBundle\\Model\\Task', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TaskQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TaskQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TaskQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TaskQuery) {
            return $criteria;
        }
        $query = new TaskQuery();
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
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Task|Task[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TaskPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TaskPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Task A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Task A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `description`, `status_id`, `priority_id`, `reporter_id`, `assignee_id`, `created_at`, `updated_at` FROM `task` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Task();
            $obj->hydrate($row);
            TaskPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Task|Task[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Task[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TaskPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TaskPeer::ID, $keys, Criteria::IN);
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
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TaskPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TaskPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusId(1234); // WHERE status_id = 1234
     * $query->filterByStatusId(array(12, 34)); // WHERE status_id IN (12, 34)
     * $query->filterByStatusId(array('min' => 12)); // WHERE status_id > 12
     * </code>
     *
     * @see       filterByStatus()
     *
     * @param     mixed $statusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByStatusId($statusId = null, $comparison = null)
    {
        if (is_array($statusId)) {
            $useMinMax = false;
            if (isset($statusId['min'])) {
                $this->addUsingAlias(TaskPeer::STATUS_ID, $statusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusId['max'])) {
                $this->addUsingAlias(TaskPeer::STATUS_ID, $statusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaskPeer::STATUS_ID, $statusId, $comparison);
    }

    /**
     * Filter the query on the priority_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPriorityId(1234); // WHERE priority_id = 1234
     * $query->filterByPriorityId(array(12, 34)); // WHERE priority_id IN (12, 34)
     * $query->filterByPriorityId(array('min' => 12)); // WHERE priority_id > 12
     * </code>
     *
     * @see       filterByPriority()
     *
     * @param     mixed $priorityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByPriorityId($priorityId = null, $comparison = null)
    {
        if (is_array($priorityId)) {
            $useMinMax = false;
            if (isset($priorityId['min'])) {
                $this->addUsingAlias(TaskPeer::PRIORITY_ID, $priorityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priorityId['max'])) {
                $this->addUsingAlias(TaskPeer::PRIORITY_ID, $priorityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaskPeer::PRIORITY_ID, $priorityId, $comparison);
    }

    /**
     * Filter the query on the reporter_id column
     *
     * Example usage:
     * <code>
     * $query->filterByReporterId(1234); // WHERE reporter_id = 1234
     * $query->filterByReporterId(array(12, 34)); // WHERE reporter_id IN (12, 34)
     * $query->filterByReporterId(array('min' => 12)); // WHERE reporter_id > 12
     * </code>
     *
     * @see       filterByreporter()
     *
     * @param     mixed $reporterId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByReporterId($reporterId = null, $comparison = null)
    {
        if (is_array($reporterId)) {
            $useMinMax = false;
            if (isset($reporterId['min'])) {
                $this->addUsingAlias(TaskPeer::REPORTER_ID, $reporterId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reporterId['max'])) {
                $this->addUsingAlias(TaskPeer::REPORTER_ID, $reporterId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaskPeer::REPORTER_ID, $reporterId, $comparison);
    }

    /**
     * Filter the query on the assignee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAssigneeId(1234); // WHERE assignee_id = 1234
     * $query->filterByAssigneeId(array(12, 34)); // WHERE assignee_id IN (12, 34)
     * $query->filterByAssigneeId(array('min' => 12)); // WHERE assignee_id > 12
     * </code>
     *
     * @see       filterByassignee()
     *
     * @param     mixed $assigneeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByAssigneeId($assigneeId = null, $comparison = null)
    {
        if (is_array($assigneeId)) {
            $useMinMax = false;
            if (isset($assigneeId['min'])) {
                $this->addUsingAlias(TaskPeer::ASSIGNEE_ID, $assigneeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($assigneeId['max'])) {
                $this->addUsingAlias(TaskPeer::ASSIGNEE_ID, $assigneeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaskPeer::ASSIGNEE_ID, $assigneeId, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TaskPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TaskPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaskPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TaskPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TaskPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaskPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Status object
     *
     * @param   Status|PropelObjectCollection $status The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TaskQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByStatus($status, $comparison = null)
    {
        if ($status instanceof Status) {
            return $this
                ->addUsingAlias(TaskPeer::STATUS_ID, $status->getId(), $comparison);
        } elseif ($status instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TaskPeer::STATUS_ID, $status->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStatus() only accepts arguments of type Status or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Status relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function joinStatus($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Status');

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
            $this->addJoinObject($join, 'Status');
        }

        return $this;
    }

    /**
     * Use the Status relation Status object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Todo\TodoBundle\Model\StatusQuery A secondary query class using the current class as primary query
     */
    public function useStatusQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Status', '\Todo\TodoBundle\Model\StatusQuery');
    }

    /**
     * Filter the query by a related Priority object
     *
     * @param   Priority|PropelObjectCollection $priority The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TaskQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPriority($priority, $comparison = null)
    {
        if ($priority instanceof Priority) {
            return $this
                ->addUsingAlias(TaskPeer::PRIORITY_ID, $priority->getId(), $comparison);
        } elseif ($priority instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TaskPeer::PRIORITY_ID, $priority->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPriority() only accepts arguments of type Priority or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Priority relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function joinPriority($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Priority');

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
            $this->addJoinObject($join, 'Priority');
        }

        return $this;
    }

    /**
     * Use the Priority relation Priority object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Todo\TodoBundle\Model\PriorityQuery A secondary query class using the current class as primary query
     */
    public function usePriorityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPriority($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Priority', '\Todo\TodoBundle\Model\PriorityQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TaskQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByreporter($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(TaskPeer::REPORTER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TaskPeer::REPORTER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByreporter() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the reporter relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function joinreporter($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('reporter');

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
            $this->addJoinObject($join, 'reporter');
        }

        return $this;
    }

    /**
     * Use the reporter relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Todo\TodoBundle\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function usereporterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinreporter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'reporter', '\Todo\TodoBundle\Model\UserQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TaskQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByassignee($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(TaskPeer::ASSIGNEE_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TaskPeer::ASSIGNEE_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByassignee() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the assignee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function joinassignee($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('assignee');

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
            $this->addJoinObject($join, 'assignee');
        }

        return $this;
    }

    /**
     * Use the assignee relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Todo\TodoBundle\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useassigneeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinassignee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'assignee', '\Todo\TodoBundle\Model\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Task $task Object to remove from the list of results
     *
     * @return TaskQuery The current query, for fluid interface
     */
    public function prune($task = null)
    {
        if ($task) {
            $this->addUsingAlias(TaskPeer::ID, $task->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     TaskQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TaskPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     TaskQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TaskPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     TaskQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TaskPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     TaskQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TaskPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     TaskQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TaskPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     TaskQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TaskPeer::CREATED_AT);
    }
}
