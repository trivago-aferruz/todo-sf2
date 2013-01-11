<?php

namespace Todo\TodoBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'task' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Todo.TodoBundle.Model.map
 */
class TaskTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Todo.TodoBundle.Model.map.TaskTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('task');
        $this->setPhpName('Task');
        $this->setClassname('Todo\\TodoBundle\\Model\\Task');
        $this->setPackage('src.Todo.TodoBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addForeignKey('status_id', 'StatusId', 'INTEGER', 'status', 'id', false, null, null);
        $this->addForeignKey('priority_id', 'PriorityId', 'INTEGER', 'priority', 'id', false, null, null);
        $this->addForeignKey('reporter_id', 'ReporterId', 'INTEGER', 'user', 'id', false, null, null);
        $this->addForeignKey('assignee_id', 'AssigneeId', 'INTEGER', 'user', 'id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Status', 'Todo\\TodoBundle\\Model\\Status', RelationMap::MANY_TO_ONE, array('status_id' => 'id', ), null, null);
        $this->addRelation('Priority', 'Todo\\TodoBundle\\Model\\Priority', RelationMap::MANY_TO_ONE, array('priority_id' => 'id', ), null, null);
        $this->addRelation('reporter', 'Todo\\TodoBundle\\Model\\User', RelationMap::MANY_TO_ONE, array('reporter_id' => 'id', ), null, null);
        $this->addRelation('assignee', 'Todo\\TodoBundle\\Model\\User', RelationMap::MANY_TO_ONE, array('assignee_id' => 'id', ), null, null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // TaskTableMap
