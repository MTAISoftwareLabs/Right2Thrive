<?php

declare(strict_types=1);

require_once __DIR__ . '/career_progress_lib.php';

function registration_questionnaire_table_usable($conn, string $table): bool
{
	if (!career_table_exists($conn, $table)) {
		return false;
	}
	$safe = mysqli_real_escape_string($conn, $table);
	try {
		return mysqli_query($conn, 'SELECT 1 FROM `' . $safe . '` LIMIT 1') !== false;
	} catch (Throwable $e) {
		return false;
	}
}

function registration_questionnaire_schema_ready($conn): bool
{
	return registration_questionnaire_table_usable($conn, 'registration_questionnaire_settings')
		&& registration_questionnaire_table_usable($conn, 'registration_questionnaire_fields');
}

function registration_questionnaire_create_tables($conn): bool
{
	$sql1 = "CREATE TABLE IF NOT EXISTS registration_questionnaire_settings (
		id INT AUTO_INCREMENT PRIMARY KEY,
		form_title VARCHAR(255) NOT NULL DEFAULT 'Complete your sign-up questionnaire',
		form_subtitle TEXT NOT NULL,
		updated_at DATETIME NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
	$sql2 = "CREATE TABLE IF NOT EXISTS registration_questionnaire_fields (
		id INT AUTO_INCREMENT PRIMARY KEY,
		field_key VARCHAR(64) NOT NULL,
		post_name VARCHAR(64) NOT NULL,
		db_column VARCHAR(64) NULL DEFAULT NULL,
		label TEXT NOT NULL,
		input_type VARCHAR(32) NOT NULL DEFAULT 'textarea',
		sort_order INT NOT NULL DEFAULT 0,
		is_active TINYINT(1) NOT NULL DEFAULT 1,
		is_required TINYINT(1) NOT NULL DEFAULT 0,
		depends_on_field_key VARCHAR(64) NULL DEFAULT NULL,
		depends_on_value VARCHAR(16) NULL DEFAULT NULL,
		updated_at DATETIME NULL,
		UNIQUE KEY uq_rq_field_key (field_key),
		UNIQUE KEY uq_rq_post_name (post_name),
		KEY idx_rq_sort (sort_order)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
	return (bool) mysqli_query($conn, $sql1) && (bool) mysqli_query($conn, $sql2);
}

/**
 * @return array{ok:bool,messages:array<int,string>}
 */
function registration_questionnaire_ensure_schema($conn): array
{
	$messages = array();
	if (!registration_questionnaire_table_usable($conn, 'registration_questionnaire_settings')
		|| !registration_questionnaire_table_usable($conn, 'registration_questionnaire_fields')) {
		if (!registration_questionnaire_create_tables($conn)) {
			return array('ok' => false, 'messages' => array('Could not create registration questionnaire tables: ' . mysqli_error($conn)));
		}
		$messages[] = 'Created registration questionnaire tables.';
	}
	$seed = registration_questionnaire_seed_defaults($conn);
	if (!$seed['ok']) {
		return $seed;
	}
	return array('ok' => true, 'messages' => array_merge($messages, $seed['messages']));
}

/**
 * @return array<int,array<string,mixed>>
 */
function registration_questionnaire_default_fields(): array
{
	return array(
		array('field_key' => 'in_work', 'post_name' => 'rnde', 'db_column' => 'iUserEmployed', 'label' => 'Are you in work?', 'input_type' => 'radio_yes_no', 'sort_order' => 1, 'is_required' => 1),
		array('field_key' => 'qualifications_held', 'post_name' => 'TXqua_achieved', 'db_column' => 'TUserQualification', 'label' => 'What qualifications (if any) do you have?', 'input_type' => 'textarea', 'sort_order' => 2, 'is_required' => 0),
		array('field_key' => 'employment_detail', 'post_name' => 'TXlong_employed', 'db_column' => 'vUserEmployedReason', 'label' => 'If yes, what is your job? OR If no, how long have you been out of work?', 'input_type' => 'textarea', 'sort_order' => 3, 'is_required' => 0),
		array('field_key' => 'career_interests', 'post_name' => 'TXcareer_ocuu', 'db_column' => 'TUserCareerOccupation', 'label' => 'What career interests you?', 'input_type' => 'textarea', 'sort_order' => 4, 'is_required' => 0),
		array('field_key' => 'qualifications_wanted', 'post_name' => 'TXqua_likeachieved', 'db_column' => 'TUserAchive', 'label' => 'What qualifications do you want to gain?', 'input_type' => 'textarea', 'sort_order' => 5, 'is_required' => 0),
		array('field_key' => 'skills', 'post_name' => 'TXskill_achieved', 'db_column' => 'TUserSkills', 'label' => 'What skills do you have?', 'input_type' => 'textarea', 'sort_order' => 6, 'is_required' => 0),
		array('field_key' => 'hobbies', 'post_name' => 'TXhobbies', 'db_column' => 'TUserHobbies', 'label' => 'What are your hobbies?', 'input_type' => 'textarea', 'sort_order' => 7, 'is_required' => 0),
		array('field_key' => 'has_disability', 'post_name' => 'rnddis', 'db_column' => 'iUserDisability', 'label' => 'Do you have a disability?', 'input_type' => 'radio_yes_no', 'sort_order' => 8, 'is_required' => 0),
		array('field_key' => 'disability_detail', 'post_name' => 'TXdisability', 'db_column' => 'TUserDisabilityReason', 'label' => 'If yes, please explain.', 'input_type' => 'textarea', 'sort_order' => 9, 'is_required' => 0, 'depends_on_field_key' => 'has_disability', 'depends_on_value' => '1'),
	);
}

/**
 * @return array{ok:bool,messages:array<int,string>}
 */
function registration_questionnaire_seed_defaults($conn): array
{
	$messages = array();
	$res = mysqli_query($conn, 'SELECT id FROM registration_questionnaire_settings LIMIT 1');
	if (!$res || mysqli_num_rows($res) === 0) {
		$titleEsc = mysqli_real_escape_string($conn, 'Complete your sign-up questionnaire');
		$subEsc = mysqli_real_escape_string($conn, 'Please answer the questions below. Fields marked required must be completed before you can continue.');
		if (!mysqli_query(
			$conn,
			"INSERT INTO registration_questionnaire_settings (form_title, form_subtitle, updated_at)
			VALUES ('" . $titleEsc . "','" . $subEsc . "',NOW())"
		)) {
			return array('ok' => false, 'messages' => array('Could not seed registration questionnaire settings: ' . mysqli_error($conn)));
		}
		$messages[] = 'Seeded registration questionnaire settings.';
	}
	foreach (registration_questionnaire_default_fields() as $field) {
		$keyEsc = mysqli_real_escape_string($conn, (string) $field['field_key']);
		$exists = mysqli_query($conn, "SELECT id FROM registration_questionnaire_fields WHERE field_key='" . $keyEsc . "' LIMIT 1");
		if ($exists && mysqli_num_rows($exists) > 0) {
			continue;
		}
		$postEsc = mysqli_real_escape_string($conn, (string) $field['post_name']);
		$dbEsc = mysqli_real_escape_string($conn, (string) $field['db_column']);
		$labelEsc = mysqli_real_escape_string($conn, (string) $field['label']);
		$typeEsc = mysqli_real_escape_string($conn, (string) $field['input_type']);
		$depKey = isset($field['depends_on_field_key']) ? mysqli_real_escape_string($conn, (string) $field['depends_on_field_key']) : '';
		$depVal = isset($field['depends_on_value']) ? mysqli_real_escape_string($conn, (string) $field['depends_on_value']) : '';
		$depKeySql = $depKey !== '' ? "'" . $depKey . "'" : 'NULL';
		$depValSql = $depVal !== '' ? "'" . $depVal . "'" : 'NULL';
		$req = !empty($field['is_required']) ? 1 : 0;
		if (!mysqli_query(
			$conn,
			"INSERT INTO registration_questionnaire_fields
			(field_key, post_name, db_column, label, input_type, sort_order, is_active, is_required, depends_on_field_key, depends_on_value, updated_at)
			VALUES ('" . $keyEsc . "','" . $postEsc . "','" . $dbEsc . "','" . $labelEsc . "','" . $typeEsc . "'," . (int) $field['sort_order'] . ",1," . $req . "," . $depKeySql . "," . $depValSql . ",NOW())"
		)) {
			return array('ok' => false, 'messages' => array('Could not seed field ' . $field['field_key'] . ': ' . mysqli_error($conn)));
		}
		$messages[] = 'Seeded field ' . $field['field_key'] . '.';
	}
	return array('ok' => true, 'messages' => $messages);
}

/**
 * @return array<string,mixed>|null
 */
function registration_questionnaire_settings($conn): ?array
{
	$res = mysqli_query($conn, 'SELECT * FROM registration_questionnaire_settings ORDER BY id ASC LIMIT 1');
	if (!$res || mysqli_num_rows($res) === 0) {
		return null;
	}
	return mysqli_fetch_assoc($res);
}

/**
 * @return array<int,array<string,mixed>>
 */
function registration_questionnaire_list_fields($conn, bool $activeOnly = false): array
{
	$sql = 'SELECT * FROM registration_questionnaire_fields';
	if ($activeOnly) {
		$sql .= ' WHERE is_active=1';
	}
	$sql .= ' ORDER BY sort_order ASC, id ASC';
	$res = mysqli_query($conn, $sql);
	$rows = array();
	if ($res) {
		while ($row = mysqli_fetch_assoc($res)) {
			$rows[] = $row;
		}
	}
	return $rows;
}

function registration_questionnaire_labels($conn): array
{
	$labels = array('terms_accepted' => 'Terms accepted');
	foreach (registration_questionnaire_list_fields($conn) as $field) {
		$labels[(string) $field['field_key']] = (string) $field['label'];
	}
	return $labels;
}

/**
 * @return array{ok:bool,message:string}
 */
function registration_questionnaire_save_settings($conn, string $title, string $subtitle): array
{
	if (trim($title) === '') {
		return array('ok' => false, 'message' => 'Form title is required.');
	}
	$titleEsc = mysqli_real_escape_string($conn, trim($title));
	$subEsc = mysqli_real_escape_string($conn, trim($subtitle));
	$settings = registration_questionnaire_settings($conn);
	if (!$settings) {
		return array('ok' => false, 'message' => 'Registration questionnaire settings not found.');
	}
	$ok = (bool) mysqli_query(
		$conn,
		"UPDATE registration_questionnaire_settings SET form_title='" . $titleEsc . "', form_subtitle='" . $subEsc . "', updated_at=NOW() WHERE id=" . (int) $settings['id']
	);
	return array('ok' => $ok, 'message' => $ok ? 'Registration form settings saved.' : 'Could not save settings: ' . mysqli_error($conn));
}

/**
 * @return array{ok:bool,message:string}
 */
function registration_questionnaire_save_field($conn, int $id, string $label, int $sortOrder, int $isActive, int $isRequired): array
{
	if ($id <= 0) {
		return array('ok' => false, 'message' => 'Invalid field.');
	}
	if (trim($label) === '') {
		return array('ok' => false, 'message' => 'Question label is required.');
	}
	$labelEsc = mysqli_real_escape_string($conn, trim($label));
	$sortOrder = max(1, $sortOrder);
	$ok = (bool) mysqli_query(
		$conn,
		'UPDATE registration_questionnaire_fields SET label=\'' . $labelEsc . '\', sort_order=' . $sortOrder . ', is_active=' . ($isActive ? 1 : 0) . ', is_required=' . ($isRequired ? 1 : 0) . ', updated_at=NOW() WHERE id=' . $id
	);
	return array('ok' => $ok, 'message' => $ok ? 'Question updated.' : 'Could not update question: ' . mysqli_error($conn));
}

function registration_questionnaire_read_post_value(array $post, array $field): string
{
	$postName = (string) ($field['post_name'] ?? '');
	if ($postName === '') {
		return '';
	}
	if (!isset($post[$postName])) {
		return '';
	}
	if (($field['input_type'] ?? '') === 'radio_yes_no') {
		return (string) $post[$postName];
	}
	return trim((string) $post[$postName]);
}

function registration_questionnaire_collect_from_post($conn, array $post): array
{
	$data = array(
		'submitted_at' => date('c'),
		'terms_accepted' => !empty($post['chkterm_cond']),
	);
	foreach (registration_questionnaire_list_fields($conn, true) as $field) {
		$data[(string) $field['field_key']] = registration_questionnaire_read_post_value($post, $field);
	}
	return $data;
}

function registration_questionnaire_apply_to_user($conn, int $userId, array $post): void
{
	$sets = array();
	foreach (registration_questionnaire_list_fields($conn, true) as $field) {
		$col = trim((string) ($field['db_column'] ?? ''));
		if ($col === '') {
			continue;
		}
		$val = registration_questionnaire_read_post_value($post, $field);
		$sets[] = '`' . mysqli_real_escape_string($conn, $col) . "`='" . mysqli_real_escape_string($conn, $val) . "'";
	}
	if ($sets === array()) {
		return;
	}
	$sql = 'UPDATE cpo_usermaster SET ' . implode(', ', $sets);
	if (function_exists('onboarding_schema_ready') && onboarding_schema_ready($conn)) {
		$sql .= ", registration_questionnaire_at='" . mysqli_real_escape_string($conn, date('Y-m-d H:i:s')) . "'";
	}
	$sql .= ' WHERE iUserId=' . $userId;
	mysqli_query($conn, $sql);
}

function registration_questionnaire_render_form_html($conn): string
{
	$fields = registration_questionnaire_list_fields($conn, true);
	if ($fields === array()) {
		return '<p class="alert alert-warning">Registration questionnaire is not configured.</p>';
	}
	$html = '';
	$byKey = array();
	foreach ($fields as $field) {
		$byKey[(string) $field['field_key']] = $field;
	}
	$rendered = array();
	foreach ($fields as $field) {
		$key = (string) $field['field_key'];
		if (isset($rendered[$key])) {
			continue;
		}
		$dep = trim((string) ($field['depends_on_field_key'] ?? ''));
		if ($dep !== '' && isset($byKey[$dep])) {
			$html .= registration_questionnaire_render_pair_row($byKey[$dep], $field);
			$rendered[$dep] = true;
			$rendered[$key] = true;
			continue;
		}
		if ($dep !== '') {
			continue;
		}
		$html .= registration_questionnaire_render_field_row($field);
		$rendered[$key] = true;
	}
	return $html;
}

function registration_questionnaire_render_field_row(array $field): string
{
	$type = (string) ($field['input_type'] ?? 'textarea');
	$post = htmlspecialchars((string) $field['post_name'], ENT_QUOTES, 'UTF-8');
	$label = htmlspecialchars((string) $field['label'], ENT_QUOTES, 'UTF-8');
	$req = !empty($field['is_required']) ? ' required' : '';
	if ($type === 'radio_yes_no') {
		return '<div class="row"><div class="col-md-5"><div class="form-group"><label style="display:block;">' . $label . '</label>'
			. '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="' . $post . '" value="1" id="' . $post . '_yes"><label class="form-check-label" for="' . $post . '_yes">Yes</label></div>'
			. '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="' . $post . '" value="0" id="' . $post . '_no" checked><label class="form-check-label" for="' . $post . '_no">No</label></div></div></div></div>';
	}
	return '<div class="row"><div class="col-md-12"><div class="form-group"><label for="' . $post . '">' . $label . '</label>'
		. '<textarea class="form-control" rows="3" id="' . $post . '" name="' . $post . '"' . $req . '></textarea></div></div></div>';
}

function registration_questionnaire_render_pair_row(array $radioField, array $textField): string
{
	$radioPost = htmlspecialchars((string) $radioField['post_name'], ENT_QUOTES, 'UTF-8');
	$textPost = htmlspecialchars((string) $textField['post_name'], ENT_QUOTES, 'UTF-8');
	$radioLabel = htmlspecialchars((string) $radioField['label'], ENT_QUOTES, 'UTF-8');
	$textLabel = htmlspecialchars((string) $textField['label'], ENT_QUOTES, 'UTF-8');
	$onclick = 'getdisable(this)';
	return '<div class="row"><div class="col-md-5"><div class="form-group"><label style="display:block;">' . $radioLabel . '</label>'
		. '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="' . $radioPost . '" value="1" onclick="' . $onclick . '" id="' . $radioPost . '_yes"><label class="form-check-label" for="' . $radioPost . '_yes">Yes</label></div>'
		. '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="' . $radioPost . '" value="0" onclick="' . $onclick . '" checked id="' . $radioPost . '_no"><label class="form-check-label" for="' . $radioPost . '_no">No</label></div></div></div>'
		. '<div class="col-md-7"><div class="form-group"><label for="' . $textPost . '">' . $textLabel . '</label>'
		. '<textarea class="form-control" rows="3" id="' . $textPost . '" name="' . $textPost . '" disabled="disabled"></textarea></div></div></div>';
}
