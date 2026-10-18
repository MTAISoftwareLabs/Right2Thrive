<?php
declare(strict_types=1);

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
require_once __DIR__ . '/../tmsnew/dompdf/autoload.inc.php';
require_once dirname(__DIR__, 2) . '/career_progress_lib.php';

use Dompdf\Dompdf;

$userId = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
if ($userId <= 0) {
	exit('Invalid user.');
}

$userRes = mysqli_query($conn, "SELECT vUserName FROM cpo_usermaster WHERE iUserId=" . $userId . " LIMIT 1");
if (!$userRes || mysqli_num_rows($userRes) === 0) {
	exit('User not found.');
}
$user = mysqli_fetch_assoc($userRes);
$token = career_get_plan_tokens($conn, $userId);

$assessRes = mysqli_query($conn, "SELECT * FROM career_assessments WHERE user_id=" . $userId . " LIMIT 1");
$assessment = ($assessRes && mysqli_num_rows($assessRes) > 0) ? mysqli_fetch_assoc($assessRes) : null;
$mileRes = mysqli_query($conn, "SELECT title,status,completed_at,target_date,token_value FROM career_plan_milestones WHERE user_id=" . $userId . " ORDER BY id ASC");
$logRes = mysqli_query($conn, "SELECT activity_description,skills_json,confidence_level,token_award,created_at FROM career_weekly_logs WHERE user_id=" . $userId . " ORDER BY id DESC LIMIT 25");
$disRes = mysqli_query($conn, "SELECT private_notes,summary,created_at FROM career_discovery_sessions WHERE user_id=" . $userId . " ORDER BY id DESC LIMIT 1");
$discovery = ($disRes && mysqli_num_rows($disRes) > 0) ? mysqli_fetch_assoc($disRes) : null;

$html = '<html><head><meta charset="UTF-8"><style>body{font-family:DejaVu Sans,sans-serif;font-size:12px;} table{width:100%;border-collapse:collapse;} th,td{border:1px solid #ccc;padding:6px;} h2,h3{margin:6px 0;}</style></head><body>';
$html .= '<h2>Career Path Progress Report</h2>';
$html .= '<p><strong>User:</strong> ' . htmlspecialchars((string) $user['vUserName']) . '<br><strong>Generated:</strong> ' . date('Y-m-d H:i') . '</p>';
$html .= '<p><strong>Employability Readiness Score:</strong> ' . $token['pct'] . '% (' . $token['earned'] . '/' . $token['total'] . ' tokens)</p>';
$usrProg = career_get_user_summary($conn, $userId);
if ($usrProg && career_coaching_stage2_columns_ready($conn)) {
	$pl = !empty($usrProg['career_pathway']) ? career_pathway_label((string) $usrProg['career_pathway']) : 'Not yet assigned';
	$s2 = !empty($usrProg['career_initial_coaching_completed']);
	$html .= '<p><strong>Career pathway:</strong> ' . htmlspecialchars($pl) . '<br /><strong>Stage 2 (initial coaching):</strong> ' . ($s2 ? 'Complete' : 'Pending') . '</p>';
	if (career_coaching_stage2_assessment_columns_ready($conn)) {
		$html .= '<h3>Stage 2 — Initial career coaching review</h3><table><tr><th>Field</th><th>Response</th></tr>';
		$html .= '<tr><td>Qualifications and experience</td><td>' . nl2br(htmlspecialchars((string) ($usrProg['career_stage2_qualifications_experience'] ?? ''))) . '</td></tr>';
		$html .= '<tr><td>Skills gaps</td><td>' . nl2br(htmlspecialchars((string) ($usrProg['career_stage2_skills_gaps'] ?? ''))) . '</td></tr>';
		$html .= '<tr><td>Confidence level</td><td>' . htmlspecialchars((string) ($usrProg['career_stage2_confidence_level'] ?? '')) . '/5</td></tr>';
		$html .= '<tr><td>Employment readiness</td><td>' . htmlspecialchars((string) ($usrProg['career_stage2_employment_readiness'] ?? '')) . '</td></tr>';
		$html .= '<tr><td>Clarity of career goals</td><td>' . htmlspecialchars((string) ($usrProg['career_stage2_goal_clarity'] ?? '')) . '</td></tr>';
		$html .= '<tr><td>Barriers</td><td>' . nl2br(htmlspecialchars((string) ($usrProg['career_stage2_barriers'] ?? ''))) . '</td></tr>';
		$html .= '</table>';
	}
}

if ($assessment) {
	$html .= '<h3>Stage 1 — Initial assessment</h3><table><tr><th>Field</th><th>Response</th></tr>';
	$html .= '<tr><td>Current status</td><td>' . htmlspecialchars((string) $assessment['current_status']) . '</td></tr>';
	if (!empty($assessment['qualifications_text'])) {
		$html .= '<tr><td>Qualifications</td><td>' . nl2br(htmlspecialchars((string) $assessment['qualifications_text'])) . '</td></tr>';
	}
	$html .= '<tr><td>Skills (on file)</td><td>' . htmlspecialchars((string) $assessment['skills_json']) . '</td></tr>';
	if (!empty($assessment['career_interests'])) {
		$html .= '<tr><td>Career interests</td><td>' . nl2br(htmlspecialchars((string) $assessment['career_interests'])) . '</td></tr>';
	}
	if (!empty($assessment['employment_goals'])) {
		$html .= '<tr><td>Employment goals</td><td>' . nl2br(htmlspecialchars((string) $assessment['employment_goals'])) . '</td></tr>';
	}
	$html .= '<tr><td>Barriers</td><td>' . htmlspecialchars((string) $assessment['barriers_json']) . '</td></tr>';
	$html .= '</table>';
}

$html .= '<h3>Starting vs Current Skills</h3>';
$startSkills = $assessment ? htmlspecialchars((string) $assessment['skills_json']) : 'N/A';
$currentSkillsRes = mysqli_query($conn, "SELECT skills_json FROM career_weekly_logs WHERE user_id=" . $userId . " AND skills_json<>'' ORDER BY id DESC LIMIT 1");
$currentSkills = ($currentSkillsRes && mysqli_num_rows($currentSkillsRes) > 0) ? htmlspecialchars((string) mysqli_fetch_assoc($currentSkillsRes)['skills_json']) : 'N/A';
$html .= '<table><tr><th>Starting skills</th><th>Current skills</th></tr><tr><td>' . $startSkills . '</td><td>' . $currentSkills . '</td></tr></table>';

$html .= '<h3>Completed Milestones</h3><table><tr><th>Milestone</th><th>Status</th><th>Target Date</th><th>Completed</th><th>Tokens</th></tr>';
if ($mileRes) {
	while ($m = mysqli_fetch_assoc($mileRes)) {
		$html .= '<tr><td>' . htmlspecialchars((string) $m['title']) . '</td><td>' . htmlspecialchars((string) $m['status']) . '</td><td>' . htmlspecialchars((string) $m['target_date']) . '</td><td>' . htmlspecialchars((string) $m['completed_at']) . '</td><td>' . (int) $m['token_value'] . '</td></tr>';
	}
}
$html .= '</table>';

$html .= '<h3>Token Earnings (Recent Activities)</h3><table><tr><th>Date</th><th>Activity</th><th>Skills</th><th>Confidence</th><th>Tokens</th></tr>';
if ($logRes) {
	while ($l = mysqli_fetch_assoc($logRes)) {
		$html .= '<tr><td>' . htmlspecialchars((string) $l['created_at']) . '</td><td>' . htmlspecialchars((string) $l['activity_description']) . '</td><td>' . htmlspecialchars((string) $l['skills_json']) . '</td><td>' . (int) $l['confidence_level'] . '/5</td><td>' . (int) $l['token_award'] . '</td></tr>';
	}
}
$html .= '</table>';

$html .= '<h3>Mentor Notes Summary</h3>';
$html .= '<p>' . ($discovery ? nl2br(htmlspecialchars((string) ($discovery['summary'] . "\n\n" . $discovery['private_notes']))) : 'No mentor notes available.') . '</p>';
$html .= '</body></html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('CareerProgress-' . preg_replace('/\s+/', '-', (string) $user['vUserName']) . '.pdf');
