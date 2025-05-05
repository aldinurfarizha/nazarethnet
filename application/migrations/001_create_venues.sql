CREATE TABLE IF NOT EXISTS `venues` (
    `venues_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `telephone` VARCHAR(20) NOT NULL,
    `longitude` VARCHAR(50) NOT NULL,
    `latitude` VARCHAR(50) NOT NULL,
    `direction` TEXT NOT NULL,
    PRIMARY KEY (`venues_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


