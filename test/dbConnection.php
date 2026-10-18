<?php
require_once __DIR__ . '/../config/config.php';
app_define_main_branding();

ini_set('display_errors', app_env('APP_DISPLAY_ERRORS', 'on'));
session_cache_expire(time() - 1);
session_cache_limiter('nocache');
if (!isset($_SESSION)) {
	session_start();
}

mysqli_report(MYSQLI_REPORT_OFF);
$db = app_main_db();
$db_host = $db['host'];
$db_username = $db['username'];
$db_password = $db['password'];
$db_name = $db['database'];

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if (!$conn) {
	error_log('mysqli_connect: ' . mysqli_connect_error());
	http_response_code(503);
	header('Content-Type: text/plain; charset=UTF-8');
	exit('Database connection failed. Check DB_* in .env (see .env.example).');
}
mysqli_report(MYSQLI_REPORT_ERROR);

include_once __DIR__ . '/function.php';

function getConnection()
{
	global $conn;
	session_register('conn');
	$HTTP_SESSION_VARS['conn'] = $conn;
}
function runquery1($p_query)
{
	global $conn;
	$result = mysqli_query($conn, $p_query);
	return $result;
}
function runquery($p_query)
{
	global $conn;
	$result = mysqli_query($conn, $p_query);
	return $result;
}

function cleancode($str)
{
	$htmlfreecontent = strip_tags(html_entity_decode($str));
	$search = array('/[^a-z0-9 ]+/i', '/ +/');
	$replace = array('', '-');
	$output = preg_replace($search, $replace, $htmlfreecontent);
	return $output;
}
