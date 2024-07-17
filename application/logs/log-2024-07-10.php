<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-10 21:47:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND e.class_id =  AND e.section_id =  AND e.year = 2024 ORDER BY s.first_name AS' at line 1 - Invalid query: SELECT s.student_id, e.roll FROM student AS s INNER JOIN enroll AS e ON s.student_id = e.student_id INNER JOIN subject AS su ON su.section_id = e.section_id WHERE su.subject_id =  AND e.class_id =  AND e.section_id =  AND e.year = 2024 ORDER BY s.first_name ASC
ERROR - 2024-07-10 21:47:47 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 21:47:47 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 21:47:47 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 21:47:47 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 21:57:02 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 22:00:22 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 22:00:22 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 22:00:22 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 22:00:22 --> 404 Page Not Found: Public/uploads
ERROR - 2024-07-10 22:30:19 --> Severity: error --> Exception: Error refreshing the OAuth2 token, message: '{
  "error": "invalid_grant",
  "error_description": "Bad Request"
}' C:\xampp\htdocs\nazarethnet\public\GoogleSDK\src\Google\Auth\OAuth2.php 378
