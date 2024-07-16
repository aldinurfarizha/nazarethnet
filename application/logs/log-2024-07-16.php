<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-16 08:54:03 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'eduappgt_app.message.message_id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT *
FROM `message`
WHERE `read_status` = 0
AND `reciever` = 'admin-2'
GROUP BY `message_thread_code`
ERROR - 2024-07-16 08:55:23 --> Query error: Unknown column 'is_active' in 'field list' - Invalid query: UPDATE `enroll` SET `class_id` = '2', `section_id` = '2', `roll` = 'COSMETOLOGIA', `is_active` = '1'
WHERE `enroll_id` = '3'
ERROR - 2024-07-16 09:04:58 --> 404 Page Not Found: Admin/student_profile_active_course
ERROR - 2024-07-16 10:14:39 --> Query error: Duplicate entry '0' for key 'PRIMARY' - Invalid query: INSERT INTO `student_subject` (`student_id`, `subject_id`) VALUES ('3', '43')
