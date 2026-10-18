<?php
require_once __DIR__ . '/../../config/config.php';

$__newadmin_gc = (int) app_env('NEWADMIN_SESSION_LIFETIME', '28800');
if ($__newadmin_gc < 60) {
	$__newadmin_gc = 28800;
}
ini_set('session.gc_maxlifetime', (string) $__newadmin_gc);

$__secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
if (session_status() === PHP_SESSION_NONE) {
	session_set_cookie_params([
		'lifetime' => 0,
		'path' => '/',
		'domain' => '',
		'secure' => $__secure,
		'httponly' => true,
		'samesite' => 'Lax',
	]);
	session_name(app_env('NEWADMIN_SESSION_NAME', 'APP21_NEWADMIN'));
	session_cache_limiter('nocache');
	session_start();
}
unset($__newadmin_gc, $__secure);
@ob_start();

if (!defined('admin_email')) {
	define('admin_email', app_env('ADMIN_EMAIL', 'info@right2thrive.org'));
}
if (!defined('page_size')) {
	define('page_size', (int) app_env('NEWADMIN_PAGE_SIZE', '15'));
}
if (!defined('NEWADMIN_LMS_FILES_BASE')) {
	define('NEWADMIN_LMS_FILES_BASE', app_newadmin_learner_lms_prefix());
}

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

/** PHP 8 removed mysqli_result(); legacy admin pages still call it. */
if (!function_exists('mysqli_result')) {
	function mysqli_result($result, int $row, $field = 0)
	{
		if (!$result instanceof mysqli_result || $row < 0 || $row >= mysqli_num_rows($result)) {
			return null;
		}
		mysqli_data_seek($result, $row);
		$data = mysqli_fetch_array($result, MYSQLI_BOTH);
		if ($data === null) {
			return null;
		}
		if (is_int($field) || (is_string($field) && ctype_digit($field))) {
			return $data[(int) $field] ?? null;
		}
		return $data[$field] ?? null;
	}
}

function SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message)
{
	if (function_exists('app_sending_mail')) {
		return app_sending_mail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
	}
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= 'From: "' . str_replace('"', '', $fromname) . '" <' . $fromaddress . ">\r\n";
	return @mail($toaddress, $subject, $message, $headers);
}
