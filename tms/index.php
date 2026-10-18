<?php
/**
 * Legacy URL /tms/ — forwards to the tutor dashboard in tutorapp/.
 */
require_once dirname(__DIR__) . '/dbConnection.php';

if (!isset($_SESSION['user_id']) || (int) $_SESSION['module'] !== 1) {
	header('Location: ../user_login.php');
	exit;
}

header('Location: ../' . app_tutor_tms_dashboard_href());
exit;
