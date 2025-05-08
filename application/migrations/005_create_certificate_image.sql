CREATE TABLE IF NOT EXISTS `certificate_image` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT,
    `image` TEXT NOT NULL,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sisipkan 1 data awal jika belum ada
INSERT INTO `certificate_image` (`id`, `image`) 
SELECT 1, 'default.png'
FROM DUAL
WHERE NOT EXISTS (
    SELECT 1 FROM `certificate_image` WHERE `id` = 1
);
