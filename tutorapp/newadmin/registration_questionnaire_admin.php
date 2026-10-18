<?php

declare(strict_types=1);

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
require_once dirname(__DIR__, 2) . '/onboarding_lib.php';
require_once dirname(__DIR__, 2) . '/registration_questionnaire_lib.php';

$editId = isset($_GET['edit_id']) ? (int) $_GET['edit_id'] : 0;
$flash = '';
$flashType = 'success';
$setupMessages = array();
$schemaError = '';

$onboardingSetup = onboarding_ensure_schema($conn);
if (!$onboardingSetup['ok']) {
	$schemaError = implode(' ', $onboardingSetup['messages']);
} elseif ($onboardingSetup['messages'] !== array()) {
	$setupMessages = $onboardingSetup['messages'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $schemaError === '') {
	if (isset($_POST['save_settings'])) {
		$result = registration_questionnaire_save_settings(
			$conn,
			(string) ($_POST['form_title'] ?? ''),
			(string) ($_POST['form_subtitle'] ?? '')
		);
		$flash = $result['message'];
		$flashType = $result['ok'] ? 'success' : 'danger';
	} elseif (isset($_POST['save_field'])) {
		$result = registration_questionnaire_save_field(
			$conn,
			(int) ($_POST['field_id'] ?? 0),
			(string) ($_POST['label'] ?? ''),
			(int) ($_POST['sort_order'] ?? 1),
			isset($_POST['is_active']) ? 1 : 0,
			isset($_POST['is_required']) ? 1 : 0
		);
		$flash = $result['message'];
		$flashType = $result['ok'] ? 'success' : 'danger';
		$editId = 0;
	}
	header('Location: registration_questionnaire_admin.php?flash=' . rawurlencode($flash) . '&flash_type=' . rawurlencode($flashType));
	exit;
}

if (isset($_GET['flash'])) {
	$flash = (string) $_GET['flash'];
	$flashType = isset($_GET['flash_type']) && $_GET['flash_type'] === 'danger' ? 'danger' : 'success';
}

$settings = registration_questionnaire_settings($conn);
$fields = registration_questionnaire_list_fields($conn);
$editField = null;
if ($editId > 0) {
	foreach ($fields as $field) {
		if ((int) $field['id'] === $editId) {
			$editField = $field;
			break;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Registration questionnaire · Super admin</title>
	<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
	<link href="css/admin-layout.css" rel="stylesheet" type="text/css" />
	<style>
		.reg-q .btn { display: inline-block; padding: 0.35rem 0.75rem; margin: 0 0.35rem 0.35rem 0; background: #0d6efd; color: #fff; text-decoration: none; border: none; cursor: pointer; font-size: 0.9rem; }
		.reg-q .btn-secondary { background: #6c757d; }
		.reg-q .btn-success { background: #198754; }
		.reg-q .flash { padding: 0.5rem 0.75rem; margin-bottom: 1rem; }
		.reg-q .flash-success { background: #ecfdf5; border: 1px solid #86efac; }
		.reg-q .flash-danger { background: #fef2f2; border: 1px solid #fca5a5; }
		.reg-q table.data { width: 100%; border-collapse: collapse; font-size: 0.9rem; margin-bottom: 1rem; }
		.reg-q table.data th, .reg-q table.data td { border: 1px solid #ccc; padding: 6px 8px; vertical-align: top; }
		.reg-q table.data th { background: #f1f5f9; }
		.reg-q .card { border: 1px solid #cbd5e1; padding: 0.75rem 1rem; margin-bottom: 1rem; background: #fafafa; }
		.reg-q .card h3 { margin: 0 0 0.75rem; font-size: 1rem; }
		.reg-q input[type=text], .reg-q textarea, .reg-q input[type=number] { width: 100%; max-width: 520px; margin-bottom: 0.35rem; }
		.reg-q textarea { min-height: 4rem; }
		.reg-q .hint { font-size: 0.85rem; color: #475569; margin: 0.5rem 0 1rem; max-width: 52rem; }
		.reg-q .inactive { color: #94a3b8; }
	</style>
</head>
<body>
<?php include_once __DIR__ . '/top.php'; ?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="208" valign="top"><?php include_once __DIR__ . '/add.php'; ?></td>
		<td width="791" valign="top" class="reg-q bodytext" style="padding:12px;">
			<p class="schoolfont">Registration sign-up questionnaire · Super admin</p>
			<p>
				<a class="btn btn-secondary" href="pending_registrations.php">← Pending registrations</a>
			</p>
			<p class="hint">Manage the questions learners answer during registration (step 2 of sign-up). PHQ-9 and GAD-7 wellbeing screenings are managed separately. Field keys and form names are fixed in the system; you can change labels, order, required, and show/hide.</p>

			<?php if ($setupMessages !== array()): ?>
				<p class="flash flash-success">Setup: <?php echo htmlspecialchars(implode(' ', $setupMessages), ENT_QUOTES, 'UTF-8'); ?></p>
			<?php endif; ?>
			<?php if ($schemaError !== ''): ?>
				<p class="flash flash-danger"><?php echo htmlspecialchars($schemaError, ENT_QUOTES, 'UTF-8'); ?></p>
			<?php endif; ?>
			<?php if ($flash !== ''): ?>
				<p class="flash flash-<?php echo htmlspecialchars($flashType, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($flash, ENT_QUOTES, 'UTF-8'); ?></p>
			<?php endif; ?>

			<?php if ($schemaError === '' && $settings): ?>
			<div class="card">
				<h3>Registration form header</h3>
				<form method="post">
					<label><strong>Form title</strong></label><br />
					<input type="text" name="form_title" value="<?php echo htmlspecialchars((string) $settings['form_title'], ENT_QUOTES, 'UTF-8'); ?>" required /><br />
					<label><strong>Form subtitle / instructions</strong></label><br />
					<textarea name="form_subtitle"><?php echo htmlspecialchars((string) $settings['form_subtitle'], ENT_QUOTES, 'UTF-8'); ?></textarea><br />
					<button type="submit" class="btn btn-success" name="save_settings" value="1">Save form header</button>
				</form>
			</div>

			<div class="card">
				<h3>Registration questions</h3>
				<table class="data">
					<thead>
						<tr>
							<th>Order</th>
							<th>System key</th>
							<th>Question label</th>
							<th>Type</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($fields as $field): ?>
						<tr class="<?php echo (int) $field['is_active'] === 1 ? '' : 'inactive'; ?>">
							<td><?php echo (int) $field['sort_order']; ?></td>
							<td><code><?php echo htmlspecialchars((string) $field['field_key'], ENT_QUOTES, 'UTF-8'); ?></code></td>
							<td><?php echo htmlspecialchars((string) $field['label'], ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php echo htmlspecialchars((string) $field['input_type'], ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php echo (int) $field['is_active'] === 1 ? ((int) $field['is_required'] === 1 ? 'Required' : 'Optional') : 'Hidden'; ?></td>
							<td><a class="btn btn-secondary" href="registration_questionnaire_admin.php?edit_id=<?php echo (int) $field['id']; ?>">Edit</a></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<?php if ($editField): ?>
			<div class="card">
				<h3>Edit question · <?php echo htmlspecialchars((string) $editField['field_key'], ENT_QUOTES, 'UTF-8'); ?></h3>
				<form method="post">
					<input type="hidden" name="field_id" value="<?php echo (int) $editField['id']; ?>" />
					<p><strong>System field key:</strong> <code><?php echo htmlspecialchars((string) $editField['field_key'], ENT_QUOTES, 'UTF-8'); ?></code></p>
					<p><strong>Form name (backend):</strong> <code><?php echo htmlspecialchars((string) $editField['post_name'], ENT_QUOTES, 'UTF-8'); ?></code></p>
					<label><strong>Question label (shown to learner)</strong></label><br />
					<textarea name="label" required><?php echo htmlspecialchars((string) $editField['label'], ENT_QUOTES, 'UTF-8'); ?></textarea><br />
					<label><strong>Sort order</strong></label><br />
					<input type="number" name="sort_order" min="1" value="<?php echo (int) $editField['sort_order']; ?>" /><br />
					<label><input type="checkbox" name="is_active" value="1" <?php echo (int) $editField['is_active'] === 1 ? 'checked' : ''; ?> /> Show on registration form</label><br />
					<label><input type="checkbox" name="is_required" value="1" <?php echo (int) $editField['is_required'] === 1 ? 'checked' : ''; ?> /> Required</label><br /><br />
					<button type="submit" class="btn btn-success" name="save_field" value="1">Save question</button>
					<a class="btn btn-secondary" href="registration_questionnaire_admin.php">Cancel</a>
				</form>
			</div>
			<?php endif; ?>
			<?php endif; ?>
		</td>
	</tr>
</table>
</body>
</html>
