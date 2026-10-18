<?php

declare(strict_types=1);

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
require_once dirname(__DIR__, 2) . '/wellbeing_questionnaires_lib.php';

$tab = isset($_GET['tab']) && $_GET['tab'] === 'gad7' ? 'gad7' : 'phq9';
$selectedUser = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
$flash = '';
$flashType = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$recordId = isset($_POST['record_id']) ? (int) $_POST['record_id'] : 0;
	$redirectTab = isset($_POST['tab']) && $_POST['tab'] === 'gad7' ? 'gad7' : 'phq9';
	$redirectUser = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;

	if (isset($_POST['delete_phq9']) && $recordId > 0) {
		if (wellbeing_delete_phq9($conn, $recordId)) {
			$flash = 'PHQ-9 submission deleted.';
		} else {
			$flash = 'Could not delete PHQ-9 submission.';
			$flashType = 'danger';
		}
		$tab = 'phq9';
	} elseif (isset($_POST['delete_gad7']) && $recordId > 0) {
		if (wellbeing_delete_gad7($conn, $recordId)) {
			$flash = 'GAD-7 submission deleted.';
		} else {
			$flash = 'Could not delete GAD-7 submission.';
			$flashType = 'danger';
		}
		$tab = 'gad7';
	}

	$redirect = 'wellbeing_questionnaires_admin.php?tab=' . rawurlencode($tab);
	if ($redirectUser > 0) {
		$redirect .= '&user_id=' . $redirectUser;
	}
	if ($flash !== '') {
		$redirect .= '&flash=' . rawurlencode($flash) . '&flash_type=' . rawurlencode($flashType);
	}
	header('Location: ' . $redirect);
	exit;
}

if (isset($_GET['flash'])) {
	$flash = (string) $_GET['flash'];
	$flashType = isset($_GET['flash_type']) && $_GET['flash_type'] === 'danger' ? 'danger' : 'success';
}

$setupMessages = array();
$schemaError = '';
if (!wellbeing_schema_ready($conn)) {
	$setup = wellbeing_ensure_schema($conn);
	if ($setup['ok']) {
		$setupMessages = $setup['messages'];
	} else {
		$schemaError = implode(' ', $setup['messages']);
	}
}

$userFilter = $selectedUser > 0 ? $selectedUser : null;
$phq9Rows = false;
$gad7Rows = false;
if ($schemaError === '' && wellbeing_schema_ready($conn)) {
	$phq9Rows = mysqli_query($conn, wellbeing_phq9_list_sql($userFilter));
	$gad7Rows = mysqli_query($conn, wellbeing_gad7_list_sql($userFilter));
}
$learners = mysqli_query(
	$conn,
	"SELECT iUserId, vUserName FROM cpo_usermaster WHERE iUserType=2 ORDER BY vUserName ASC"
);

$phq9Count = ($phq9Rows instanceof mysqli_result) ? mysqli_num_rows($phq9Rows) : 0;
$gad7Count = ($gad7Rows instanceof mysqli_result) ? mysqli_num_rows($gad7Rows) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>PHQ-9 &amp; GAD-7 · Super admin</title>
	<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
	<link href="css/admin-layout.css" rel="stylesheet" type="text/css" />
	<style>
		.wellbeing-admin .btn { display: inline-block; padding: 0.35rem 0.75rem; margin: 0 0.35rem 0.35rem 0; background: #0d6efd; color: #fff; text-decoration: none; border: none; cursor: pointer; font-size: 0.9rem; }
		.wellbeing-admin .btn-secondary { background: #6c757d; }
		.wellbeing-admin .btn-success { background: #198754; }
		.wellbeing-admin .btn-danger { background: #dc3545; }
		.wellbeing-admin .btn-outline { background: #fff; color: #0d6efd; border: 1px solid #0d6efd; }
		.wellbeing-admin .flash { padding: 0.5rem 0.75rem; margin-bottom: 1rem; }
		.wellbeing-admin .flash-success { background: #ecfdf5; border: 1px solid #86efac; }
		.wellbeing-admin .flash-danger { background: #fef2f2; border: 1px solid #fca5a5; }
		.wellbeing-admin table.data { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
		.wellbeing-admin table.data th, .wellbeing-admin table.data td { border: 1px solid #ccc; padding: 6px 8px; vertical-align: top; }
		.wellbeing-admin table.data th { background: #f1f5f9; }
		.wellbeing-admin .inline-form { display: inline; }
		.wellbeing-admin .tabs { margin: 1rem 0; }
		.wellbeing-admin .tabs a { display: inline-block; padding: 0.45rem 0.9rem; margin-right: 0.35rem; border: 1px solid #cbd5e1; text-decoration: none; color: #334155; background: #f8fafc; }
		.wellbeing-admin .tabs a.active { background: #0d6efd; border-color: #0d6efd; color: #fff; }
		.wellbeing-admin .filter-row { margin: 0.75rem 0 1rem; }
		.wellbeing-admin .filter-row select { min-width: 220px; padding: 0.25rem; }
		.wellbeing-admin .hint { font-size: 0.85rem; color: #475569; margin: 0.5rem 0 1rem; max-width: 52rem; }
		.wellbeing-admin .score-high { color: #b45309; font-weight: 600; }
		.wellbeing-admin .score-severe { color: #b91c1c; font-weight: 600; }
		#wellbeing-modal { display: none; position: fixed; z-index: 1000; inset: 0; background: rgba(15, 23, 42, 0.55); padding: 2rem 1rem; overflow: auto; }
		#wellbeing-modal .modal-panel { max-width: 960px; margin: 0 auto; background: #fff; border: 1px solid #cbd5e1; box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
		#wellbeing-modal .modal-header, #wellbeing-modal .modal-footer { padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0; }
		#wellbeing-modal .modal-footer { border-bottom: 0; border-top: 1px solid #e2e8f0; }
		#wellbeing-modal .modal-body { padding: 1rem; overflow-x: auto; }
	</style>
</head>
<body>
<?php include_once __DIR__ . '/top.php'; ?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="208" valign="top"><?php include_once __DIR__ . '/add.php'; ?></td>
		<td width="791" valign="top" class="wellbeing-admin bodytext" style="padding:12px;">
			<p class="schoolfont">PHQ-9 &amp; GAD-7 patient questionnaires · Super admin</p>
			<p>
				<a class="btn btn-secondary" href="main.php">← Admin home</a>
				<a class="btn btn-secondary" href="career_progress_admin.php">Career Progress Monitor</a>
				<a class="btn btn-secondary" href="registration_questionnaire_admin.php">Edit registration questionnaire</a>
				<a class="btn btn-outline" target="_blank" rel="noopener" href="../tmsnew/phq9.php">Open tutor PHQ-9 view</a>
				<a class="btn btn-outline" target="_blank" rel="noopener" href="../tmsnew/gad7.php">Open tutor GAD-7 view</a>
			</p>
			<p class="hint">Review learner wellbeing screening submissions. Use <strong>View</strong> for a quick preview, <strong>PDF</strong> to download, or <strong>Delete</strong> to remove a mistaken entry.</p>

			<?php if ($setupMessages !== array()): ?>
				<p class="flash flash-success">Database setup completed: <?php echo htmlspecialchars(implode(' ', $setupMessages), ENT_QUOTES, 'UTF-8'); ?></p>
			<?php endif; ?>

			<?php if ($schemaError !== ''): ?>
				<p class="flash flash-danger">
					<strong>Setup required:</strong>
					<?php echo htmlspecialchars($schemaError, ENT_QUOTES, 'UTF-8'); ?>
				</p>
			<?php endif; ?>

			<?php if ($flash !== ''): ?>
				<p class="flash flash-<?php echo htmlspecialchars($flashType, ENT_QUOTES, 'UTF-8'); ?>">
					<?php echo htmlspecialchars($flash, ENT_QUOTES, 'UTF-8'); ?>
				</p>
			<?php endif; ?>

			<?php if ($schemaError === ''): ?>
			<form method="get" class="filter-row">
				<label for="user_id"><strong>Filter by learner</strong></label><br />
				<select name="user_id" id="user_id" onchange="this.form.submit()">
					<option value="0">All learners</option>
					<?php
					if ($learners instanceof mysqli_result) {
						while ($learner = mysqli_fetch_assoc($learners)) {
							$lid = (int) $learner['iUserId'];
							$sel = $lid === $selectedUser ? ' selected' : '';
							echo '<option value="' . $lid . '"' . $sel . '>' . htmlspecialchars((string) $learner['vUserName'], ENT_QUOTES, 'UTF-8') . '</option>';
						}
					}
					?>
				</select>
				<input type="hidden" name="tab" value="<?php echo htmlspecialchars($tab, ENT_QUOTES, 'UTF-8'); ?>" />
				<noscript><button type="submit" class="btn btn-secondary">Apply</button></noscript>
				<?php if ($selectedUser > 0): ?>
					<a class="btn btn-secondary" href="wellbeing_questionnaires_admin.php?tab=<?php echo htmlspecialchars($tab, ENT_QUOTES, 'UTF-8'); ?>">Clear filter</a>
				<?php endif; ?>
			</form>

			<div class="tabs">
				<a href="wellbeing_questionnaires_admin.php?tab=phq9<?php echo $selectedUser > 0 ? '&user_id=' . $selectedUser : ''; ?>" class="<?php echo $tab === 'phq9' ? 'active' : ''; ?>">PHQ-9 (<?php echo (int) $phq9Count; ?>)</a>
				<a href="wellbeing_questionnaires_admin.php?tab=gad7<?php echo $selectedUser > 0 ? '&user_id=' . $selectedUser : ''; ?>" class="<?php echo $tab === 'gad7' ? 'active' : ''; ?>">GAD-7 (<?php echo (int) $gad7Count; ?>)</a>
			</div>

			<?php if ($tab === 'phq9'): ?>
				<h3>PHQ-9 — depression screening</h3>
				<?php if ($phq9Count === 0): ?>
					<p><strong>No PHQ-9 submissions<?php echo $selectedUser > 0 ? ' for this learner' : ''; ?>.</strong></p>
				<?php else: ?>
					<table class="data">
						<thead>
							<tr>
								<th>Learner</th>
								<th>Score</th>
								<th>Interpretation</th>
								<th>Submitted</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php while ($row = mysqli_fetch_assoc($phq9Rows)):
							$id = (int) $row['id'];
							$total = (int) $row['total'];
							$remarks = wellbeing_phq9_remarks($total);
							$scoreClass = $total > 14 ? 'score-severe' : ($total > 4 ? 'score-high' : '');
							?>
							<tr>
								<td><?php echo htmlspecialchars((string) ($row['vUserName'] ?? 'Unknown'), ENT_QUOTES, 'UTF-8'); ?></td>
								<td class="<?php echo $scoreClass; ?>"><?php echo $total; ?></td>
								<td><?php echo htmlspecialchars($remarks, ENT_QUOTES, 'UTF-8'); ?></td>
								<td><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime((string) $row['submit_date'])), ENT_QUOTES, 'UTF-8'); ?></td>
								<td>
									<button type="button" class="btn btn-success js-view" data-type="phq9" data-id="<?php echo $id; ?>">View</button>
									<a class="btn btn-secondary" target="_blank" rel="noopener" href="../tmsnew/get_phq9.php?id=<?php echo $id; ?>">PDF</a>
									<form method="post" class="inline-form" onsubmit="return confirm('Delete this PHQ-9 submission permanently?');">
										<input type="hidden" name="record_id" value="<?php echo $id; ?>" />
										<input type="hidden" name="tab" value="phq9" />
										<input type="hidden" name="user_id" value="<?php echo (int) $selectedUser; ?>" />
										<button type="submit" class="btn btn-danger" name="delete_phq9" value="1">Delete</button>
									</form>
								</td>
							</tr>
						<?php endwhile; ?>
						</tbody>
					</table>
				<?php endif; ?>
			<?php else: ?>
				<h3>GAD-7 — anxiety screening</h3>
				<?php if ($gad7Count === 0): ?>
					<p><strong>No GAD-7 submissions<?php echo $selectedUser > 0 ? ' for this learner' : ''; ?>.</strong></p>
				<?php else: ?>
					<table class="data">
						<thead>
							<tr>
								<th>Learner</th>
								<th>Score</th>
								<th>Anxiety level</th>
								<th>Submitted</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php while ($row = mysqli_fetch_assoc($gad7Rows)):
							$id = (int) $row['id'];
							$total = (int) $row['total'];
							$label = wellbeing_gad7_label($total);
							$scoreClass = $total >= 15 ? 'score-severe' : ($total >= 10 ? 'score-high' : '');
							?>
							<tr>
								<td><?php echo htmlspecialchars((string) ($row['vUserName'] ?? 'Unknown'), ENT_QUOTES, 'UTF-8'); ?></td>
								<td class="<?php echo $scoreClass; ?>"><?php echo $total; ?></td>
								<td><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></td>
								<td><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime((string) $row['submit_date'])), ENT_QUOTES, 'UTF-8'); ?></td>
								<td>
									<button type="button" class="btn btn-success js-view" data-type="gad7" data-id="<?php echo $id; ?>">View</button>
									<a class="btn btn-secondary" target="_blank" rel="noopener" href="../tmsnew/get_gad7.php?id=<?php echo $id; ?>">PDF</a>
									<form method="post" class="inline-form" onsubmit="return confirm('Delete this GAD-7 submission permanently?');">
										<input type="hidden" name="record_id" value="<?php echo $id; ?>" />
										<input type="hidden" name="tab" value="gad7" />
										<input type="hidden" name="user_id" value="<?php echo (int) $selectedUser; ?>" />
										<button type="submit" class="btn btn-danger" name="delete_gad7" value="1">Delete</button>
									</form>
								</td>
							</tr>
						<?php endwhile; ?>
						</tbody>
					</table>
				<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
		</td>
	</tr>
</table>

<div id="wellbeing-modal" role="dialog" aria-modal="true" aria-labelledby="wellbeing-modal-title">
	<div class="modal-panel">
		<div class="modal-header">
			<strong id="wellbeing-modal-title">Questionnaire preview</strong>
		</div>
		<div class="modal-body" id="wellbeing-modal-body"></div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" id="wellbeing-modal-close">Close</button>
		</div>
	</div>
</div>

<script>
(function () {
	var modal = document.getElementById('wellbeing-modal');
	var body = document.getElementById('wellbeing-modal-body');
	var title = document.getElementById('wellbeing-modal-title');
	var closeBtn = document.getElementById('wellbeing-modal-close');

	function closeModal() {
		modal.style.display = 'none';
		body.innerHTML = '';
	}

	closeBtn.addEventListener('click', closeModal);
	modal.addEventListener('click', function (e) {
		if (e.target === modal) {
			closeModal();
		}
	});
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			closeModal();
		}
	});

	document.querySelectorAll('.js-view').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var type = btn.getAttribute('data-type');
			var id = btn.getAttribute('data-id');
			var endpoint = type === 'gad7' ? '../tmsnew/get_gad7.php' : '../tmsnew/get_phq9.php';
			title.textContent = type === 'gad7' ? 'GAD-7 preview' : 'PHQ-9 preview';
			body.innerHTML = '<p>Loading…</p>';
			modal.style.display = 'block';
			fetch(endpoint + '?id=' + encodeURIComponent(id) + '&view=modal')
				.then(function (res) { return res.text(); })
				.then(function (html) { body.innerHTML = html; })
				.catch(function () { body.innerHTML = '<p>Could not load preview.</p>'; });
		});
	});
})();
</script>
</body>
</html>
