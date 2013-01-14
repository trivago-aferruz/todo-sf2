
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- task
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `task`;

CREATE TABLE `task`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(255) NOT NULL,
    `status_id` INTEGER,
    `priority_id` INTEGER,
    `reporter_id` INTEGER,
    `assignee_id` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `task_FI_1` (`status_id`),
    INDEX `task_FI_2` (`priority_id`),
    INDEX `task_FI_3` (`reporter_id`),
    INDEX `task_FI_4` (`assignee_id`),
    CONSTRAINT `task_FK_1`
        FOREIGN KEY (`status_id`)
        REFERENCES `status` (`id`),
    CONSTRAINT `task_FK_2`
        FOREIGN KEY (`priority_id`)
        REFERENCES `priority` (`id`),
    CONSTRAINT `task_FK_3`
        FOREIGN KEY (`reporter_id`)
        REFERENCES `user` (`id`),
    CONSTRAINT `task_FK_4`
        FOREIGN KEY (`assignee_id`)
        REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- priority
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `priority`;

CREATE TABLE `priority`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
