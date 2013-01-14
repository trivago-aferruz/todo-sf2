<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1358175997.
 * Generated on 2013-01-14 16:06:37 by aferruz
 */
class PropelMigration_1358175997
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `task` ADD CONSTRAINT `task_FK_1`
    FOREIGN KEY (`status_id`)
    REFERENCES `status` (`id`);

ALTER TABLE `task` ADD CONSTRAINT `task_FK_2`
    FOREIGN KEY (`priority_id`)
    REFERENCES `priority` (`id`);

ALTER TABLE `task` ADD CONSTRAINT `task_FK_3`
    FOREIGN KEY (`reporter_id`)
    REFERENCES `user` (`id`);

ALTER TABLE `task` ADD CONSTRAINT `task_FK_4`
    FOREIGN KEY (`assignee_id`)
    REFERENCES `user` (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `task` DROP FOREIGN KEY `task_FK_1`;

ALTER TABLE `task` DROP FOREIGN KEY `task_FK_2`;

ALTER TABLE `task` DROP FOREIGN KEY `task_FK_3`;

ALTER TABLE `task` DROP FOREIGN KEY `task_FK_4`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}