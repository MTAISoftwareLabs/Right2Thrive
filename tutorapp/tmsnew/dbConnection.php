<?php
require_once __DIR__ . '/../../config/config.php';
app_define_tutorapp_tms_branding();
/** Templates use $sitename; branding defines constant sitename */
$sitename = sitename;

session_start();
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

$arrLocations = array();
$arrLocations[] = 'City of London';
$arrLocations[] = 'London Borough of Barking and Dagenham';
$arrLocations[] = 'London Borough of Barnet';
$arrLocations[] = 'London Borough of Bexley';
$arrLocations[] = 'London Borough of Brent';
$arrLocations[] = 'London Borough of Bromley';
$arrLocations[] = 'London Borough of Camden';
$arrLocations[] = 'London Borough of Croydon';
$arrLocations[] = 'London Borough of Ealing';
$arrLocations[] = 'London Borough of Enfield';
$arrLocations[] = 'London Borough of Greenwich';
$arrLocations[] = 'London Borough of Hackney';
$arrLocations[] = 'London Borough of Hammersmith & Fulham';
$arrLocations[] = 'London Borough of Haringey';
$arrLocations[] = 'London Borough of Harrow';
$arrLocations[] = 'London Borough of Havering';
$arrLocations[] = 'London Borough of Hillingdon';
$arrLocations[] = 'London Borough of Hounslow';
$arrLocations[] = 'London Borough of Islington';
$arrLocations[] = 'Royal Borough of Kensington & Chelsea';
$arrLocations[] = 'Royal Borough of Kingston upon Thames';
$arrLocations[] = 'London Borough of Lambeth';
$arrLocations[] = 'London Borough of Lewisham';
$arrLocations[] = 'London borough of Merton';
$arrLocations[] = 'London Borough of Newham';
$arrLocations[] = 'London Borough of Redbridge';
$arrLocations[] = 'London Borough of Richmond upon Thames';
$arrLocations[] = 'London Borough of Southwark';
$arrLocations[] = 'London Borough of Sutton';
$arrLocations[] = 'London Borough of Tower Hamlets';
$arrLocations[] = 'London Borough of Waltham Forest';
$arrLocations[] = 'London Borough of Wandsworth';
$arrLocations[] = 'City of Westminster';
