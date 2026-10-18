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

/**$conn = mysql_connect($db_host, $db_username, $db_password) or die("Not connected");
$db = mysql_select_db($db_name, $conn) or die("Database not Selected");
$p_query = "select * from cpo_usermaster where vUserEmailId='demo@demo.com' and vUserPassword='demo' and iUserStatus=1";
$result = mysql_query($p_query, $conn);
foreach($result as $row) {
    print_r($row);
}

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die("Not connected: ".mysqli_connect_error());
$sqlchange = "select * from cpo_usermaster where vUserEmailId='demo@demo.com' and vUserPassword='demo' and iUserStatus=1";
$result = mysqli_query($conn, $sqlchange);
foreach($result as $row) {
    print_r($row);
}**/

$a = 4;
$b = 3;

function Sum()
{
	global $a, $b;
	return $a + $b;
}

