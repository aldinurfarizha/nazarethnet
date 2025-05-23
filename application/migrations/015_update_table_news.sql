ALTER TABLE news
ADD COLUMN can_comment INT NULL DEFAULT 0,
ADD COLUMN can_reaction INT NULL DEFAULT 0;

CREATE TABLE IF NOT EXISTS `news_comments` (
    `news_comments_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `news_id` INT(11) NOT NULL,
    `comments` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    PRIMARY KEY (`news_comments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `news_reactions` (
    `news_reactions_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `news_id` INT(11) NOT NULL,
    `reaction_id` TEXT NOT NULL,
    `student_id` VARCHAR(50) NOT NULL,
    `admin_id` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    PRIMARY KEY (`news_reactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `reaction` (
    `reaction_id` INT(11) UNSIGNED AUTO_INCREMENT,
    `reaction_type` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`reaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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