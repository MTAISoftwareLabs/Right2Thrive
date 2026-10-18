<?php
session_start();
session_cache_expire(time() - 1);
session_cache_limiter('nocache');
require_once __DIR__ . '/../../config/config.php';
app_define_tutorapp_lms_branding();

include __DIR__ . '/../function.php';

$db = app_tutorapp_gsc_db();
$db_host = $db['host'];
$db_username = $db['username'];
$db_password = $db['password'];
$db_name = $db['database'];

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('Could not connect to Server' . mysqli_connect_error());
