<?php

namespace Todo\TodoBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user' table.
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
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Todo.TodoBundle.Model.map.UserTableMap';

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
        $this->setName('user');
        $this->setPhpName('User');
        $this->setClassname('Todo\\TodoBundle\\Model\\User');
        $this->setPackage('src.Todo.TodoBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->getColumn('name', false)->setPrimaryString(true);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TaskRelatedByReporterId', 'Todo\\TodoBundle\\Model\\Task', RelationMap::ONE_TO_MANY, array('id' => 'reporter_id', ), null, null, 'TasksRelatedByReporterId');
        $this->addRelation('TaskRelatedByAssigneeId', 'Todo\\TodoBundle\\Model\\Task', RelationMap::ONE_TO_MANY, array('id' => 'assignee_id', ), null, null, 'TasksRelatedByAssigneeId');
    } // buildRelations()

} // UserTableMap
