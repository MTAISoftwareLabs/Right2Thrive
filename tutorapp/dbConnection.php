<?php
require_once __DIR__ . '/../config/config.php';
app_define_tutorapp_core_branding();

session_cache_expire(time() - 1);
session_cache_limiter('nocache');
if (!isset($_SESSION)) {
	session_start();
}

include_once __DIR__ . '/function.php';

$db = app_tutorapp_db();
$db_host = $db['host'];
$db_username = $db['username'];
$db_password = $db['password'];
$db_name = $db['database'];

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('Not connected: ' . mysqli_connect_error());

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
