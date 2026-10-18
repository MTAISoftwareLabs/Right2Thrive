<?php
include 'dbConnection.php';
require_once dirname(__DIR__) . '/career_progress_lib.php';

$userId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 0;
if ($userId > 0) {
    career_bootstrap_user_profile($conn, $userId);
    $summary = career_get_user_summary($conn, $userId);
    if (!$summary || (int) $summary['career_assessment_completed'] === 0 || !empty($_SESSION['require_assessment'])) {
        header("Location: ../career_assessment.php");
        exit;
    }
}
header("Location: dashboard.php");
exit;
?>