<?php
require_once dirname(__DIR__) . '/config/config.php';
app_define_main_branding();

@ini_set('display_errors', app_env('APP_DISPLAY_ERRORS', 'on'));
session_cache_expire(time() - 1);
session_cache_limiter('nocache');
date_default_timezone_set(app_env('APP_TIMEZONE', 'Europe/London'));
@ob_start();
if (!isset($_SESSION)) {
	session_start();
}
include_once __DIR__ . '/../function.php';

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

if (!isset($HTTP_SESSION_VARS['is_admin'])) {
	if (isset($_SESSION['user_id'])) {
		$chksql = 'select vUserEmailId from cpo_usermaster where iUserType=2 and iUserStatus=1 and iUserId=' . $_SESSION['user_id'];
		$rschksql = runquery($chksql);
		$nos = $rschksql ? mysqli_num_rows($rschksql) : 0;
		if ($nos <> 1) {
			header('Location:../user_login');
			exit;
		}
	} else {
		header('Location:../user_login');
		exit;
	}
}
function paginate($start, $limit, $total, $filePath, $otherParams)
{
	global $lang;
	$allPages = ceil($total / $limit);
	$currentPage = floor($start / $limit) + 1;
	$pagination = '';
	if ($allPages > 10) {
		$maxPages = ($allPages > 9) ? 9 : $allPages;
		if ($allPages > 9) {
			if ($currentPage >= 1 && $currentPage <= $allPages) {
				$pagination .= ($currentPage > 4) ? ' ... ' : ' ';
				$minPages = ($currentPage > 4) ? $currentPage : 5;
				$maxPages = ($currentPage < $allPages - 4) ? $currentPage : $allPages - 4;

				for ($i = $minPages - 4; $i < $maxPages + 5; $i++) {
					$pagination .= ($i == $currentPage) ? '[' . $i . '] ' : '<a href="' . $filePath . '?start=' . (($i - 1) * $limit) . $otherParams . '">' . $i . '</a> ';
				}
				$pagination .= ($currentPage < $allPages - 4) ? ' ... ' : ' ';
			} else {
				$pagination .= ' ... ';
			}
		}
	} else {
		for ($i = 1; $i < $allPages + 1; $i++) {
			$pagination .= ($i == $currentPage) ? '[' . $i . '] ' : '<a href="' . $filePath . '?start=' . (($i - 1) * $limit) . $otherParams . '">' . $i . '</a> ';
		}
	}

	if ($currentPage > 1) {
		$pagination = '[<a href="' . $filePath . '?start=0' . $otherParams . '">&lt;&lt;</a>] [<a href="' . $filePath . '?start=' . (($currentPage - 2) * $limit) . $otherParams . '">&lt;</a>] ' . $pagination;
	}

	if ($currentPage < $allPages) {
		$pagination .= ' [<a href="' . $filePath . '?start=' . ($currentPage * $limit) . $otherParams . '">&gt;</a>] [<a href="' . $filePath . '?start=' . (($allPages - 1) * $limit) . $otherParams . '">&gt;&gt;</a>]';
	}

	echo $pagination;
}
if (!isset($_SESSION['user_id'])) {
	header('Location: ../user_login');
} else {
	$user_id = $_SESSION['user_id'];
}
