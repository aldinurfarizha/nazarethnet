ALTER TABLE news
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_file TEXT NULL DEFAULT NULL,
ADD COLUMN post_file_type TEXT NULL DEFAULT NULL,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL;

ALTER TABLE homework
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL;

ALTER TABLE forum
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL;

ALTER TABLE document
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL;

ALTER TABLE online_exam
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL,
ADD COLUMN post_file TEXT NULL DEFAULT NULL,
ADD COLUMN post_file_type TEXT NULL DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `news_comments` (
    `news_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `news_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`news_comments_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `news_reactions` (
    `news_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `news_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`news_reactions_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `homework_comments` (
    `homework_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `homework_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`homework_comments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `homework_reactions` (
    `homework_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `homework_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`homework_reactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `forum_comments` (
    `forum_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `forum_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`forum_comments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `forum_reactions` (
    `forum_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `forum_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`forum_reactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `document_comments` (
    `document_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `document_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`document_comments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `document_reactions` (
    `document_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `document_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`document_reactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `reaction` (
    `reaction_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `reaction_type` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`reaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `reaction` (`reaction_type`) VALUES
('👍'),
('❤️'),
('😂'),
('😮'),
('😢'),
('😡'),
('👏'),
('🔥'),
('🎉'),
('💯'); 