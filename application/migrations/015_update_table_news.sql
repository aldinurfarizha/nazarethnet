ALTER TABLE news
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_file TEXT NULL DEFAULT NULL,
ADD COLUMN post_file_type TEXT NULL DEFAULT NULL,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL;

ALTER TABLE homework
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_file TEXT NULL DEFAULT NULL,
ADD COLUMN post_file_type TEXT NULL DEFAULT NULL,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL;

ALTER TABLE forum
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_file TEXT NULL DEFAULT NULL,
ADD COLUMN post_file_type TEXT NULL DEFAULT NULL,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL;

ALTER TABLE document
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN post_file TEXT NULL DEFAULT NULL,
ADD COLUMN post_file_type TEXT NULL DEFAULT NULL,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL;

ALTER TABLE online_exam
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL,
ADD COLUMN post_file TEXT NULL DEFAULT NULL,
ADD COLUMN post_file_type TEXT NULL DEFAULT NULL;

ALTER TABLE polls
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0,
ADD COLUMN post_content LONGTEXT NULL DEFAULT NULL,
ADD COLUMN post_file TEXT NULL DEFAULT NULL,
ADD COLUMN post_file_type TEXT NULL DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `news_comments` (
    `news_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `news_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` INT(11) NOT NULL DEFAULT 0,
    `admin_id` INT(11) NOT NULL DEFAULT 0,
    `teacher_id` INT(11) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`news_comments_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `news_reactions` (
    `news_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `news_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` INT(11) NOT NULL DEFAULT 0,
    `admin_id` INT(11) NOT NULL DEFAULT 0,
    `teacher_id` INT(11) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`news_reactions_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `homework_comments` (
    `homework_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `homework_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` INT(11) NOT NULL DEFAULT 0,
    `admin_id` INT(11) NOT NULL DEFAULT 0,
    `teacher_id` INT(11) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`homework_comments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `homework_reactions` (
    `homework_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `homework_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` INT(11) NOT NULL DEFAULT 0,
    `admin_id` INT(11) NOT NULL DEFAULT 0,
    `teacher_id` INT(11) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`homework_reactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `forum_comments` (
    `forum_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `forum_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` INT(11) NOT NULL DEFAULT 0,
    `admin_id` INT(11) NOT NULL DEFAULT 0,
    `teacher_id` INT(11) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`forum_comments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `forum_reactions` (
    `forum_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `forum_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` INT(11) NOT NULL DEFAULT 0,
    `admin_id` INT(11) NOT NULL DEFAULT 0,
    `teacher_id` INT(11) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`forum_reactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `document_comments` (
    `document_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `document_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` INT(11) NOT NULL DEFAULT 0,
    `admin_id` INT(11) NOT NULL DEFAULT 0,
    `teacher_id` INT(11) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`document_comments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `document_reactions` (
    `document_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `document_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` INT(11) NOT NULL DEFAULT 0,
    `admin_id` INT(11) NOT NULL DEFAULT 0,
    `teacher_id` INT(11) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`document_reactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `document_reactions` ADD INDEX `idx_document_id` (`document_id`);
ALTER TABLE `forum_reactions` ADD INDEX `idx_forum_id` (`forum_id`);
ALTER TABLE `homework_reactions` ADD INDEX `idx_homework_id` (`homework_id`);
ALTER TABLE `news_reactions` ADD INDEX `idx_news_id` (`news_id`);

ALTER TABLE `document_comments` ADD INDEX `idx_document_id` (`document_id`);
ALTER TABLE `forum_comments` ADD INDEX `idx_forum_id` (`forum_id`);
ALTER TABLE `homework_comments` ADD INDEX `idx_homework_id` (`homework_id`);
ALTER TABLE `news_comments` ADD INDEX `idx_news_id` (`news_id`);

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

ALTER TABLE `news` DROP COLUMN `post_content`;
ALTER TABLE `news` ADD COLUMN `post_content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;

ALTER TABLE `homework` DROP COLUMN `post_content`;
ALTER TABLE `homework` ADD COLUMN `post_content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;

ALTER TABLE `forum` DROP COLUMN `post_content`;
ALTER TABLE `forum` ADD COLUMN `post_content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;

ALTER TABLE `document` DROP COLUMN `post_content`;
ALTER TABLE `document` ADD COLUMN `post_content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;

ALTER TABLE `online_exam` DROP COLUMN `post_content`;
ALTER TABLE `online_exam` ADD COLUMN `post_content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;

ALTER TABLE `polls` DROP COLUMN `post_content`;
ALTER TABLE `polls` ADD COLUMN `post_content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
