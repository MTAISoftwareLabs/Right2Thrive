<?php
require_once __DIR__ . '/dbConnection.php';

$alogin = isset($_POST['alogin']) ? (string) $_POST['alogin'] : '';
$apassword = isset($_POST['apassword']) ? (string) $_POST['apassword'] : '';
$alogin_esc = mysqli_real_escape_string($conn, $alogin);
$apassword_esc = mysqli_real_escape_string($conn, $apassword);
$sql = "select adminid from admin where adminlogin='" . $alogin_esc . "' and adminpass='" . $apassword_esc . "'";
$num = 0;
$query = runquery($sql);
if ($query) {
	$num = mysqli_num_rows($query);
}

if ($num === 0) {
	header('Location: index.htm');
	exit;
}

$result_arr = mysqli_fetch_array($query);
session_regenerate_id(true);
$_SESSION['user_id'] = $result_arr['adminid'];
$_SESSION['is_admin'] = 1;
header('Location: main.php');
exit;
