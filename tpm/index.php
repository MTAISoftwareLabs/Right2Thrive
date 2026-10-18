<?php
/**
 * Legacy URL /tpm/ — forwards to the TPM area in tutorapp/.
 */
require_once dirname(__DIR__) . '/dbConnection.php';

if (!isset($_SESSION['user_id']) || (int) $_SESSION['module'] !== 4) {
	header('Location: ../user_login.php');
	exit;
}

header('Location: ../' . app_tutor_tpm_dashboard_href());
exit;
