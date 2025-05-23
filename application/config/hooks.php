<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'][] = array('function' => 'redirect_ssl', 'filename' => 'ssl.php', 'filepath' => 'hooks');
$hook['post_controller_constructor'][] = array('function' => 'checker', 'filename' => 'check.php', 'filepath' => 'hooks');
$hook['post_controller_constructor'][] = array(
    'class'    => '',
    'function' => 'set_sql_mode',
    'filename' => 'SetSqlMode.php',
    'filepath' => 'hooks'
);
