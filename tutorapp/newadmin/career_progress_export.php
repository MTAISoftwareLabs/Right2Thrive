<?php
declare(strict_types=1);

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
require_once dirname(__DIR__, 2) . '/career_progress_lib.php';

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="career_progress_export.csv"');

$out = fopen('php://output', 'w');
$head = array('user_id', 'user_name', 'mentor_id', 'assessment_completed', 'tokens_earned', 'milestones_total', 'tasks_total', 'tasks_completed');
$pwSql = '';
if (career_coaching_stage2_columns_ready($conn)) {
	$head[] = 'career_pathway';
	$head[] = 'stage2_initial_coaching_complete';
	if (career_coaching_stage2_assessment_columns_ready($conn)) {
		$head[] = 'stage2_qualifications_experience';
		$head[] = 'stage2_skills_gaps';
		$head[] = 'stage2_confidence_level';
		$head[] = 'stage2_employment_readiness';
		$head[] = 'stage2_goal_clarity';
		$head[] = 'stage2_barriers';
	}
	$pwSql = ', u.career_pathway, COALESCE(u.career_initial_coaching_completed,0) AS stage2_initial_coaching_complete';
	if (career_coaching_stage2_assessment_columns_ready($conn)) {
		$pwSql .= ', u.career_stage2_qualifications_experience, u.career_stage2_skills_gaps, u.career_stage2_confidence_level, u.career_stage2_employment_readiness, u.career_stage2_goal_clarity, u.career_stage2_barriers';
	}
}
fputcsv($out, $head);

$sql = "SELECT u.iUserId, u.vUserName, u.career_mentor_id, COALESCE(u.career_assessment_completed,0) AS assessment_completed,
    (SELECT COALESCE(SUM(tokens),0) FROM career_token_ledger tl WHERE tl.user_id=u.iUserId) AS tokens_earned,
    (SELECT COUNT(*) FROM career_plan_milestones m WHERE m.user_id=u.iUserId) AS milestones_total,
    (SELECT COUNT(*) FROM career_weekly_tasks t WHERE t.user_id=u.iUserId) AS tasks_total,
    (SELECT COUNT(*) FROM career_weekly_tasks t2 WHERE t2.user_id=u.iUserId AND t2.status='completed') AS tasks_completed" . $pwSql . "
    FROM cpo_usermaster u
    WHERE u.iUserType=2
    ORDER BY u.iUserId ASC";
$res = mysqli_query($conn, $sql);
if ($res) {
	while ($row = mysqli_fetch_assoc($res)) {
		fputcsv($out, $row);
	}
}
fclose($out);
exit;
