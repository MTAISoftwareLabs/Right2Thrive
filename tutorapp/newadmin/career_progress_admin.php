<?php
declare(strict_types=1);

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
require_once dirname(__DIR__, 2) . '/career_progress_lib.php';
require_once dirname(__DIR__, 2) . '/career_stage3_lib.php';

$actingMentorRes = mysqli_query(
	$conn,
	"SELECT iUserId FROM cpo_usermaster WHERE iUserType=1 AND iUserStatus=1 ORDER BY iUserId ASC LIMIT 1"
);
$staffId = ($actingMentorRes && mysqli_num_rows($actingMentorRes) > 0)
	? (int) mysqli_fetch_assoc($actingMentorRes)['iUserId']
	: 0;

$mode = 'admin';
$selectedUser = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
$stage2Error = '';
$pcapFlash = isset($_GET['pcap_flash']) ? (string) $_GET['pcap_flash'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['pcap_action'])) {
		$pcapMsg = career_handle_stage3_coach_post($conn, $staffId, $mode);
		$redirectUser = (int) ($_POST['user_id'] ?? $selectedUser);
		if ($pcapMsg !== '' && $stage2Error === '') {
			header('Location: career_progress_admin.php?user_id=' . $redirectUser . '&pcap_flash=' . rawurlencode($pcapMsg));
			exit;
		}
		if ($pcapMsg !== '') {
			$pcapFlash = $pcapMsg;
		}
	}
	if (isset($_POST['save_pathway_stage2']) && career_coaching_stage2_columns_ready($conn) && career_coaching_stage2_assessment_columns_ready($conn)) {
		$uid = (int) $_POST['user_id'];
		$pathway = isset($_POST['career_pathway']) ? trim((string) $_POST['career_pathway']) : '';
		$allowed = array_keys(career_pathway_slugs());
		if ($uid > 0 && in_array($pathway, $allowed, true)) {
			$qual = trim((string) ($_POST['stage2_qualifications_experience'] ?? ''));
			$gaps = trim((string) ($_POST['stage2_skills_gaps'] ?? ''));
			$conf = (int) ($_POST['stage2_confidence_level'] ?? 0);
			$readiness = trim((string) ($_POST['stage2_employment_readiness'] ?? ''));
			$clarity = trim((string) ($_POST['stage2_goal_clarity'] ?? ''));
			$barriers = trim((string) ($_POST['stage2_barriers'] ?? ''));
			$allowedReadiness = array('not_ready', 'developing', 'ready_soon', 'job_ready');
			$allowedClarity = array('unclear', 'emerging', 'clear');
			$validStage2 = ($qual !== '' && $gaps !== '' && $barriers !== ''
				&& $conf >= 1 && $conf <= 5
				&& in_array($readiness, $allowedReadiness, true)
				&& in_array($clarity, $allowedClarity, true));
			if (!$validStage2) {
				$stage2Error = 'Please complete all Stage 2 assessment fields before marking Stage 2 complete.';
			} else {
				$pathEsc = mysqli_real_escape_string($conn, $pathway);
				$qualEsc = mysqli_real_escape_string($conn, $qual);
				$gapsEsc = mysqli_real_escape_string($conn, $gaps);
				$readEsc = mysqli_real_escape_string($conn, $readiness);
				$clarEsc = mysqli_real_escape_string($conn, $clarity);
				$barEsc = mysqli_real_escape_string($conn, $barriers);
				mysqli_query(
					$conn,
					"UPDATE cpo_usermaster SET
					career_pathway='" . $pathEsc . "',
					career_initial_coaching_completed=1,
					career_pathway_assigned_at=NOW(),
					career_stage2_qualifications_experience='" . $qualEsc . "',
					career_stage2_skills_gaps='" . $gapsEsc . "',
					career_stage2_confidence_level=" . $conf . ",
					career_stage2_employment_readiness='" . $readEsc . "',
					career_stage2_goal_clarity='" . $clarEsc . "',
					career_stage2_barriers='" . $barEsc . "'
					WHERE iUserId=" . $uid
				);
				$summaryRaw = trim((string) ($_POST['session_summary'] ?? ''));
				$privateRaw = trim((string) ($_POST['private_notes'] ?? ''));
				$label = career_pathway_label($pathway);
				$combined = 'Pathway allocated: ' . $label . '.';
				if ($summaryRaw !== '') {
					$combined .= "\n\n" . $summaryRaw;
				}
				if (($summaryRaw !== '' || $privateRaw !== '') && $staffId > 0) {
					$sumEsc = mysqli_real_escape_string($conn, $combined);
					$privEsc = mysqli_real_escape_string($conn, $privateRaw);
					mysqli_query(
						$conn,
						"INSERT INTO career_discovery_sessions (user_id,mentor_id,summary,private_notes,created_at)
						VALUES (" . $uid . "," . $staffId . ",'" . $sumEsc . "','" . $privEsc . "',NOW())"
					);
				}
			}
		}
	}
	if (isset($_POST['save_discovery'])) {
		$uid = (int) $_POST['user_id'];
		if ($staffId > 0) {
			$summary = mysqli_real_escape_string($conn, trim((string) $_POST['summary']));
			$private = mysqli_real_escape_string($conn, trim((string) $_POST['private_notes']));
			mysqli_query(
				$conn,
				"INSERT INTO career_discovery_sessions (user_id,mentor_id,summary,private_notes,created_at)
				VALUES (" . $uid . "," . $staffId . ",'" . $summary . "','" . $private . "',NOW())"
			);
		}
	}
	if (isset($_POST['create_milestone'])) {
		$uid = (int) $_POST['user_id'];
		$title = mysqli_real_escape_string($conn, trim((string) $_POST['title']));
		$desc = mysqli_real_escape_string($conn, trim((string) $_POST['description']));
		$target = mysqli_real_escape_string($conn, trim((string) $_POST['target_date']));
		$tok = (int) $_POST['token_value'];
		$ev = mysqli_real_escape_string($conn, trim((string) $_POST['required_evidence']));
		$mentorSql = $staffId > 0 ? (string) $staffId : 'NULL';
		mysqli_query(
			$conn,
			"INSERT INTO career_plans (user_id,mentor_id,title,created_at)
			SELECT " . $uid . "," . $mentorSql . ",'Career Plan',NOW()
			WHERE NOT EXISTS (SELECT 1 FROM career_plans WHERE user_id=" . $uid . ")"
		);
		$planRes = mysqli_query($conn, "SELECT id FROM career_plans WHERE user_id=" . $uid . " ORDER BY id DESC LIMIT 1");
		$plan = ($planRes && mysqli_num_rows($planRes) > 0) ? mysqli_fetch_assoc($planRes) : array('id' => 0);
		mysqli_query(
			$conn,
			"INSERT INTO career_plan_milestones (plan_id,user_id,title,description,target_date,token_value,required_evidence,status)
			VALUES (" . (int) $plan['id'] . "," . $uid . ",'" . $title . "','" . $desc . "','" . $target . "'," . $tok . ",'" . $ev . "','not_started')"
		);
	}
	if (isset($_POST['create_task'])) {
		$uid = (int) $_POST['user_id'];
		$mid = (int) $_POST['milestone_id'];
		$task = mysqli_real_escape_string($conn, trim((string) $_POST['task_title']));
		$start = mysqli_real_escape_string($conn, trim((string) $_POST['week_start']));
		$end = mysqli_real_escape_string($conn, trim((string) $_POST['week_end']));
		$tok = (int) $_POST['task_tokens'];
		mysqli_query(
			$conn,
			"INSERT INTO career_weekly_tasks (milestone_id,user_id,task_title,week_start,week_end,token_value,status)
			VALUES (" . $mid . "," . $uid . ",'" . $task . "','" . $start . "','" . $end . "'," . $tok . ",'not_started')"
		);
	}
	if (isset($_POST['log_for_user']) && $staffId > 0) {
		$uid = (int) $_POST['user_id'];
		$desc = mysqli_real_escape_string($conn, trim((string) $_POST['activity_description']));
		$skills = mysqli_real_escape_string($conn, trim((string) $_POST['skills']));
		$conf = (int) $_POST['confidence_level'];
		$notes = mysqli_real_escape_string($conn, trim((string) $_POST['staff_notes']));
		$tokens = (int) $_POST['token_award'];
		mysqli_query(
			$conn,
			"INSERT INTO career_weekly_logs (user_id,mentor_id,activity_description,skills_json,confidence_level,staff_notes,token_award,created_at)
			VALUES (" . $uid . "," . $staffId . ",'" . $desc . "','" . $skills . "'," . $conf . ",'" . $notes . "'," . $tokens . ",NOW())"
		);
		mysqli_query(
			$conn,
			"INSERT INTO career_token_ledger (user_id,source_type,source_id,tokens,notes,created_at)
			VALUES (" . $uid . ",'staff_log',NULL," . $tokens . ",'Logged by super admin',NOW())"
		);
	}
	if (isset($_POST['manual_assign'])) {
		$uid = (int) $_POST['user_id'];
		$mentorId = (int) $_POST['mentor_id'];
		mysqli_query(
			$conn,
			"UPDATE cpo_usermaster SET career_mentor_id=" . $mentorId . ", career_assessment_completed=1 WHERE iUserId=" . $uid
		);
		mysqli_query(
			$conn,
			"INSERT INTO career_mentor_assignments (user_id,mentor_id,assigned_at,assignment_method) VALUES (" . $uid . "," . $mentorId . ",NOW(),'manual_admin')"
		);
	}
	if (isset($_POST['save_template'])) {
		$title = mysqli_real_escape_string($conn, trim((string) $_POST['template_title']));
		$desc = mysqli_real_escape_string($conn, trim((string) $_POST['template_description']));
		$tok = (int) $_POST['template_tokens'];
		if ($title !== '') {
			mysqli_query(
				$conn,
				"INSERT INTO career_milestone_templates (title,description,default_tokens,is_active)
				VALUES ('" . $title . "','" . $desc . "'," . $tok . ",1)"
			);
		}
	}
	if (isset($_POST['legacy_delete'])) {
		$lid = (int) $_POST['legacy_id'];
		mysqli_query($conn, "UPDATE career_legacy_uploads SET delete_confirmed=1 WHERE id=" . $lid);
	}
	if ($stage2Error === '') {
		$redirectUser = $selectedUser;
		if (isset($_POST['user_id'])) {
			$redirectUser = (int) $_POST['user_id'];
		}
		header('Location: career_progress_admin.php?user_id=' . $redirectUser);
		exit;
	}
}

$pathwayCols = career_coaching_stage2_columns_ready($conn)
	? ',u.career_pathway,COALESCE(u.career_initial_coaching_completed,0) AS career_initial_coaching_completed'
	: '';
$users = mysqli_query(
	$conn,
	"SELECT u.iUserId,u.vUserName,u.vUserEmailId,u.career_mentor_id,u.career_assessment_completed" . $pathwayCols . ",
	(SELECT COALESCE(SUM(tokens),0) FROM career_token_ledger tl WHERE tl.user_id=u.iUserId) AS tokens
	FROM cpo_usermaster u
	WHERE u.iUserType=2 AND u.iUserStatus=1
	ORDER BY u.iUserId DESC"
);

$selectedData = null;
$selectedAssessment = null;
if ($selectedUser > 0) {
	$uRes = mysqli_query($conn, "SELECT * FROM cpo_usermaster WHERE iUserId=" . $selectedUser . " LIMIT 1");
	$selectedData = ($uRes && mysqli_num_rows($uRes) > 0) ? mysqli_fetch_assoc($uRes) : null;
	$aRes = mysqli_query($conn, "SELECT * FROM career_assessments WHERE user_id=" . $selectedUser . " LIMIT 1");
	$selectedAssessment = ($aRes && mysqli_num_rows($aRes) > 0) ? mysqli_fetch_assoc($aRes) : null;
}
$templates = mysqli_query($conn, "SELECT * FROM career_milestone_templates WHERE is_active=1 ORDER BY id ASC");
$milestones = $selectedUser > 0
	? mysqli_query($conn, "SELECT * FROM career_plan_milestones WHERE user_id=" . $selectedUser . " ORDER BY id DESC")
	: null;
$mentors = mysqli_query(
	$conn,
	"SELECT iUserId,vUserName FROM cpo_usermaster WHERE iUserType=1 AND iUserStatus=1 ORDER BY vUserName ASC"
);
$unassignedRes = mysqli_query(
	$conn,
	"SELECT COUNT(*) c FROM cpo_usermaster WHERE iUserType=2 AND iUserStatus=1 AND (career_mentor_id IS NULL OR career_assessment_completed=0)"
);
$unassigned = ($unassignedRes && mysqli_num_rows($unassignedRes) > 0)
	? (int) mysqli_fetch_assoc($unassignedRes)['c']
	: 0;
$legacy = mysqli_query($conn, "SELECT * FROM career_legacy_uploads ORDER BY id DESC LIMIT 200");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Super admin · Career Progress Monitor</title>
	<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
	<link href="css/admin-layout.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
	<style>
		.career-admin h2 { font-size: 1.1rem; margin: 0 0 0.5rem; }
		.career-admin .card { border: 1px solid #ccc; margin-bottom: 1rem; padding: 0.75rem 1rem; background: #fafafa; }
		.career-admin .card h3 { margin: 0 0 0.5rem; font-size: 1rem; }
		.career-admin input[type=text], .career-admin input[type=date], .career-admin input[type=number], .career-admin select, .career-admin textarea { width: 100%; max-width: 520px; margin-bottom: 0.35rem; }
		.career-admin textarea { min-height: 4rem; }
		.career-admin .learner-list { max-height: 420px; overflow-y: auto; list-style: none; padding: 0; margin: 0; }
		.career-admin .learner-list li { padding: 0.35rem 0; border-bottom: 1px solid #e0e0e0; }
		.career-admin table.data { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
		.career-admin table.data th, .career-admin table.data td { border: 1px solid #ccc; padding: 4px 6px; }
		.career-admin .warn { background: #fff3cd; padding: 0.5rem 0.75rem; margin-bottom: 1rem; border: 1px solid #ffc107; }
		.career-admin .btn { display: inline-block; padding: 0.35rem 0.75rem; margin-right: 0.35rem; margin-bottom: 0.35rem; background: #0d6efd; color: #fff; text-decoration: none; border: none; cursor: pointer; font-size: 0.9rem; }
		.career-admin .btn-secondary { background: #6c757d; }
		.career-admin .btn-success { background: #198754; }
		.career-admin .btn-warning { background: #ffc107; color: #000; }
		.career-admin .btn-danger { background: #dc3545; }
	</style>
</head>
<body>
<?php include_once __DIR__ . '/top.php'; ?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="208" valign="top"><?php include_once __DIR__ . '/add.php'; ?></td>
		<td width="791" valign="top" class="career-admin bodytext" style="padding:12px;">
			<p class="schoolfont">Career Progress Monitor · Super admin</p>
			<p><a class="btn btn-secondary" href="main.php">← Admin home</a>
				<a class="btn btn-secondary" target="_blank" rel="noopener" href="../tmsnew/career_progress.php?mode=mentor">Open tutor (mentor) view</a></p>

			<?php if ($staffId === 0) { ?>
				<div class="warn"><strong>Note:</strong> No active tutor account was found in <code>cpo_usermaster</code> (<code>iUserType=1</code>). Add a tutor first. Discovery notes and “log on behalf” require a tutor row for attribution.</div>
			<?php } ?>

			<div class="warn"><strong>Unassigned learners</strong> (no mentor or onboarding incomplete): <strong><?php echo $unassigned; ?></strong></div>

			<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
				<td width="38%" valign="top">
					<div class="card">
						<h3>All learners</h3>
						<ul class="learner-list">
							<?php
							if ($users) {
								while ($u = mysqli_fetch_assoc($users)) {
									$active = ((int) $u['iUserId'] === $selectedUser) ? ' <strong>●</strong>' : '';
									echo '<li><a href="career_progress_admin.php?user_id=' . (int) $u['iUserId'] . '">' . htmlspecialchars((string) $u['vUserName']) . '</a>' . $active;
									echo ' <span style="color:#666;">(' . (int) $u['tokens'] . ' tokens)</span>';
									if (career_coaching_stage2_columns_ready($conn)) {
										$pw = isset($u['career_pathway']) ? (string) $u['career_pathway'] : '';
										$s2 = isset($u['career_initial_coaching_completed']) ? (int) $u['career_initial_coaching_completed'] : 0;
										$pl = $pw !== '' ? career_pathway_label($pw) : '';
										echo '<br /><span style="color:#888;font-size:0.85em;">' . htmlspecialchars($s2 && $pl !== '' ? $pl : ($s2 ? 'Stage 2 done' : 'Stage 2 pending')) . '</span>';
									}
									echo '</li>';
								}
							}
							?>
						</ul>
					</div>
				</td>
				<td width="62%" valign="top">
					<?php if ($selectedData) { ?>
						<div class="card">
							<h3><?php echo htmlspecialchars((string) $selectedData['vUserName']); ?> — Stage 2: coaching &amp; pathway</h3>
							<p>
								<a class="btn btn-secondary" target="_blank" rel="noopener" href="get_career_progress_report.php?user_id=<?php echo (int) $selectedData['iUserId']; ?>">Export PDF</a>
							</p>
							<?php
							$learnerIdCharts = (int) $selectedData['iUserId'];
							$mentorCanViewCharts = true;
							include dirname(__DIR__) . '/tmsnew/career_mentor_progress_panel.php';
							?>
							<?php if ($selectedAssessment) { ?>
								<div style="background:#fff;border:1px solid #ddd;padding:8px;margin-bottom:8px;">
									<strong>Assessment</strong><br />
									Status: <?php echo htmlspecialchars((string) $selectedAssessment['current_status']); ?><br />
									<?php if (!empty($selectedAssessment['qualifications_text'])) { ?>
									Qualifications: <?php echo nl2br(htmlspecialchars((string) $selectedAssessment['qualifications_text'])); ?><br />
									<?php } ?>
									Skills: <?php echo htmlspecialchars((string) $selectedAssessment['skills_json']); ?><br />
									<?php if (!empty($selectedAssessment['career_interests'])) { ?>
									Career interests: <?php echo nl2br(htmlspecialchars((string) $selectedAssessment['career_interests'])); ?><br />
									<?php } ?>
									<?php if (!empty($selectedAssessment['employment_goals'])) { ?>
									Employment goals: <?php echo nl2br(htmlspecialchars((string) $selectedAssessment['employment_goals'])); ?><br />
									<?php } ?>
									Barriers: <?php echo htmlspecialchars((string) $selectedAssessment['barriers_json']); ?>
								</div>
							<?php } ?>
							<p class="small text-muted" style="margin-bottom:8px;">Session review: qualifications/experience, skills gaps, confidence, employment readiness, career goals, barriers.</p>
							<?php
							if (career_coaching_stage2_columns_ready($conn) && career_coaching_stage2_assessment_columns_ready($conn)) {
								$curPw = isset($selectedData['career_pathway']) ? (string) $selectedData['career_pathway'] : '';
								$curLbl = $curPw !== '' ? career_pathway_label($curPw) : '';
								$s2done = !empty($selectedData['career_initial_coaching_completed']);
								$s2Qual = isset($selectedData['career_stage2_qualifications_experience']) ? (string) $selectedData['career_stage2_qualifications_experience'] : '';
								$s2Gaps = isset($selectedData['career_stage2_skills_gaps']) ? (string) $selectedData['career_stage2_skills_gaps'] : '';
								$s2Conf = isset($selectedData['career_stage2_confidence_level']) ? (int) $selectedData['career_stage2_confidence_level'] : 3;
								$s2Read = isset($selectedData['career_stage2_employment_readiness']) ? (string) $selectedData['career_stage2_employment_readiness'] : '';
								$s2Clar = isset($selectedData['career_stage2_goal_clarity']) ? (string) $selectedData['career_stage2_goal_clarity'] : '';
								$s2Bar = isset($selectedData['career_stage2_barriers']) ? (string) $selectedData['career_stage2_barriers'] : '';
								if ($s2done && $curLbl !== '') {
									echo '<div class="warn" style="background:#d1e7dd;border-color:#198754;"><strong>Current pathway:</strong> ' . htmlspecialchars($curLbl) . '</div>';
								}
								if ($stage2Error !== '') {
									echo '<div class="warn" style="background:#f8d7da;border-color:#dc3545;color:#842029;">' . htmlspecialchars($stage2Error) . '</div>';
								}
								?>
							<form method="post">
								<input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>" />
								<label>Qualifications and experience (Stage 2 review)</label><br />
								<textarea name="stage2_qualifications_experience" required><?php echo htmlspecialchars($s2Qual); ?></textarea><br />
								<label>Skills gaps</label><br />
								<textarea name="stage2_skills_gaps" required><?php echo htmlspecialchars($s2Gaps); ?></textarea><br />
								<label>Confidence level (1-5)</label><br />
								<select name="stage2_confidence_level" required style="max-width:180px;">
									<?php for ($i = 1; $i <= 5; $i++) { ?>
										<option value="<?php echo $i; ?>"<?php echo ($s2Conf === $i) ? ' selected' : ''; ?>><?php echo $i; ?></option>
									<?php } ?>
								</select><br />
								<label>Employment readiness</label><br />
								<select name="stage2_employment_readiness" required style="max-width:280px;">
									<option value="">Select readiness</option>
									<option value="not_ready"<?php echo ($s2Read === 'not_ready') ? ' selected' : ''; ?>>Not ready</option>
									<option value="developing"<?php echo ($s2Read === 'developing') ? ' selected' : ''; ?>>Developing</option>
									<option value="ready_soon"<?php echo ($s2Read === 'ready_soon') ? ' selected' : ''; ?>>Ready soon</option>
									<option value="job_ready"<?php echo ($s2Read === 'job_ready') ? ' selected' : ''; ?>>Job ready</option>
								</select><br />
								<label>Clarity of career goals</label><br />
								<select name="stage2_goal_clarity" required style="max-width:280px;">
									<option value="">Select clarity</option>
									<option value="unclear"<?php echo ($s2Clar === 'unclear') ? ' selected' : ''; ?>>Unclear</option>
									<option value="emerging"<?php echo ($s2Clar === 'emerging') ? ' selected' : ''; ?>>Emerging</option>
									<option value="clear"<?php echo ($s2Clar === 'clear') ? ' selected' : ''; ?>>Clear</option>
								</select><br />
								<label>Barriers (confidence, childcare, transport, wellbeing)</label><br />
								<textarea name="stage2_barriers" required><?php echo htmlspecialchars($s2Bar); ?></textarea><br />
								<label>Assign pathway</label><br />
								<select name="career_pathway" required style="max-width:360px;">
									<option value="">Select pathway</option>
									<?php foreach (career_pathway_slugs() as $slug => $plabel) { ?>
										<option value="<?php echo htmlspecialchars($slug); ?>"<?php echo ($curPw === $slug) ? ' selected' : ''; ?>><?php echo htmlspecialchars($plabel); ?></option>
									<?php } ?>
								</select><br />
								<textarea name="session_summary" placeholder="Session summary (optional)"></textarea><br />
								<textarea name="private_notes" placeholder="Private notes (optional)"></textarea><br />
								<button class="btn btn-success" type="submit" name="save_pathway_stage2" value="1">Save pathway &amp; mark Stage 2 complete</button>
							</form>
							<?php } else { ?>
								<div class="warn">Run root <code>migrate_career_tables.php</code> to enable full Stage 2 assessment and pathways.</div>
							<?php } ?>
						</div>

						<div class="card">
													<?php
						if ($selectedData) {
							$learnerId = (int) $selectedData['iUserId'];
							$summary = career_get_user_summary($conn, $learnerId);
							include dirname(__DIR__) . '/tmsnew/career_stage3_coach_panel.php';
						}
						?>
<h3>Additional session notes</h3>
							<form method="post">
								<input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>" />
								<textarea name="summary" placeholder="Summary (follow-up)" <?php echo $staffId ? '' : 'disabled'; ?>></textarea><br />
								<textarea name="private_notes" placeholder="Private notes" <?php echo $staffId ? '' : 'disabled'; ?>></textarea><br />
								<button class="btn" type="submit" name="save_discovery" value="1" <?php echo $staffId ? '' : 'disabled'; ?>>Save session note</button>
							</form>
						</div>

						<div class="card">
							<h3>Manual mentor assignment</h3>
							<form method="post">
								<input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>" />
								<select name="mentor_id" required>
									<option value="">Select tutor</option>
									<?php
									$currentMentorId = isset($selectedData['career_mentor_id']) ? (int) $selectedData['career_mentor_id'] : 0;
									if ($mentors) {
										while ($m = mysqli_fetch_assoc($mentors)) {
											$mid = (int) $m['iUserId'];
											$sel = ($currentMentorId === $mid) ? ' selected' : '';
											echo '<option value="' . $mid . '"' . $sel . '>' . htmlspecialchars((string) $m['vUserName']) . '</option>';
										}
									}
									?>
								</select><br />
								<button class="btn btn-warning" type="submit" name="manual_assign" value="1">Assign tutor</button>
							</form>
						</div>

						<div class="card">
							<h3>Milestone</h3>
							<form method="post">
								<input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>" />
								<select onchange="document.getElementById('m-title').value=this.value;">
									<option value="">Template (optional)</option>
									<?php
									if ($templates) {
										mysqli_data_seek($templates, 0);
										while ($tmp = mysqli_fetch_assoc($templates)) {
											echo '<option value="' . htmlspecialchars((string) $tmp['title']) . '">' . htmlspecialchars((string) $tmp['title']) . '</option>';
										}
									}
									?>
								</select><br />
								<input id="m-title" name="title" placeholder="Title" required /><br />
								<textarea name="description" placeholder="Description"></textarea><br />
								<input type="date" name="target_date" /><br />
								<input type="number" name="token_value" min="1" max="10" value="3" /><br />
								<input name="required_evidence" placeholder="Evidence (optional)" /><br />
								<button class="btn btn-success" type="submit" name="create_milestone" value="1">Add milestone</button>
							</form>
						</div>

						<div class="card">
							<h3>Weekly task</h3>
							<form method="post">
								<input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>" />
								<select name="milestone_id" required>
									<option value="">Milestone</option>
									<?php
									if ($milestones) {
										while ($m = mysqli_fetch_assoc($milestones)) {
											echo '<option value="' . (int) $m['id'] . '">' . htmlspecialchars((string) $m['title']) . '</option>';
										}
									}
									?>
								</select><br />
								<input name="task_title" placeholder="Task title" required /><br />
								<input type="date" name="week_start" required /> — <input type="date" name="week_end" required /><br />
								<input type="number" name="task_tokens" min="1" max="10" value="1" /><br />
								<button class="btn btn-success" type="submit" name="create_task" value="1">Add task</button>
							</form>
						</div>

						<div class="card">
							<h3>Log activity (on behalf of learner)</h3>
							<form method="post">
								<input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>" />
								<textarea name="activity_description" required <?php echo $staffId ? '' : 'disabled'; ?>></textarea><br />
								<input name="skills" placeholder="Skills" <?php echo $staffId ? '' : 'disabled'; ?> /><br />
								<select name="confidence_level" <?php echo $staffId ? '' : 'disabled'; ?>>
									<?php for ($i = 1; $i <= 5; $i++) {
										echo '<option value="' . $i . '"' . ($i === 3 ? ' selected' : '') . '>' . $i . '</option>';
									} ?>
								</select><br />
								<textarea name="staff_notes" placeholder="Staff notes" <?php echo $staffId ? '' : 'disabled'; ?>></textarea><br />
								<input type="number" name="token_award" min="1" max="10" value="1" <?php echo $staffId ? '' : 'disabled'; ?> /><br />
								<button class="btn" type="submit" name="log_for_user" value="1" <?php echo $staffId ? '' : 'disabled'; ?>>Save log</button>
							</form>
						</div>
					<?php } else { ?>
						<p>Select a learner on the left.</p>
					<?php } ?>
				</td>
			</tr></table>

			<div class="card" id="templates">
				<h3>Milestone templates &amp; export</h3>
				<p><a class="btn btn-secondary" href="career_progress_export.php" target="_blank" rel="noopener">Export all career data (CSV)</a></p>
				<form method="post">
					<input name="template_title" placeholder="Template title" required />
					<input name="template_description" placeholder="Description" />
					<input type="number" name="template_tokens" min="1" max="10" value="3" />
					<button class="btn btn-success" type="submit" name="save_template" value="1">Save template</button>
				</form>
			</div>

			<div class="card" id="legacy-archive">
				<h3>Legacy upload archive (replaces old “uploaded files” admin)</h3>
				<table class="data">
					<tr><th>ID</th><th>User</th><th>File</th><th>Archive path</th><th>Expires</th><th>Delete confirm</th></tr>
					<?php
					if ($legacy) {
						while ($l = mysqli_fetch_assoc($legacy)) {
							echo '<tr><td>' . (int) $l['id'] . '</td><td>' . (int) $l['user_id'] . '</td><td>' . htmlspecialchars((string) $l['file_name']) . '</td>';
							echo '<td>' . htmlspecialchars((string) $l['archive_path']) . '</td><td>' . htmlspecialchars((string) $l['expires_at']) . '</td><td>';
							if ((int) $l['delete_confirmed'] === 1) {
								echo 'Confirmed';
							} else {
								echo '<form method="post" style="display:inline" onsubmit="return confirm(\'Confirm delete flag for this row?\');">';
								echo '<input type="hidden" name="legacy_id" value="' . (int) $l['id'] . '" />';
								echo '<input type="hidden" name="user_id" value="' . (int) $selectedUser . '" />';
								echo '<button class="btn btn-danger" type="submit" name="legacy_delete" value="1">Confirm</button></form>';
							}
							echo '</td></tr>';
						}
					}
					?>
				</table>
			</div>
		</td>
	</tr>
</table>
</body>
</html>
