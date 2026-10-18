<?php
require_once __DIR__ . '/../../config/config.php';
app_define_tutorapp_tms_branding();

if (session_status() === PHP_SESSION_NONE) {
	session_cache_limiter('nocache');
	session_cache_expire(180);
	session_start();
}
include_once __DIR__ . '/../function.php';

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

if (isset($_SESSION['user_id'])) {
	$chksql = 'select vUserEmailId from cpo_usermaster where iUserType=1 and iUserStatus=1 and iUserId=' . $_SESSION['user_id'];
	$rschksql = runquery($chksql);
	$nos = $rschksql ? mysqli_num_rows($rschksql) : 0;
	if ($nos <> 1) {
		header('Location:../user_login.php');
		exit;
	}
} else {
	header('Location:../user_login.php');
	exit;
}
