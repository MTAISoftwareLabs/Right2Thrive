<?php
require_once __DIR__ . '/config/config.php';
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

if (!function_exists('getConnection')) {
	function getConnection()
	{
		global $conn;
		$_SESSION['conn'] = $conn;
	}
}

if (!function_exists('runquery1')) {
	function runquery1($p_query)
	{
		global $conn;
		return mysqli_query($conn, $p_query);
	}
}

if (!function_exists('runquery')) {
	function runquery($p_query)
	{
		global $conn;
		return mysqli_query($conn, $p_query);
	}
}

if (!function_exists('cleancode')) {
	function cleancode($str)
	{
		$htmlfreecontent = strip_tags(html_entity_decode($str));
		$search = array('/[^a-z0-9 ]+/i', '/ +/');
		$replace = array('', '-');
		return preg_replace($search, $replace, $htmlfreecontent);
	}
}
