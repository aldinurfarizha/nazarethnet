CREATE TABLE IF NOT EXISTS `conferences` (
    `conferences_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `venues_id` int(11) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`conferences_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `conferences`
ADD `status` ENUM('ACTIVE', 'INACTIVE') NOT NULL DEFAULT 'ACTIVE' AFTER `name`;
