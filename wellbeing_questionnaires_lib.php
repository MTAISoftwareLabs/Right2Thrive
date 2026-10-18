<?php

declare(strict_types=1);

require_once __DIR__ . '/career_progress_lib.php';

function wellbeing_phq9_remarks(int $total): string
{
	if ($total <= 4) {
		return 'No depression treatment needed';
	}
	if ($total <= 14) {
		return 'Clinical judgment about treatment';
	}
	return 'Warrants treatment for depression';
}

function wellbeing_gad7_label(int $total): string
{
	if ($total <= 4) {
		return 'No anxiety';
	}
	if ($total <= 9) {
		return 'Low anxiety';
	}
	if ($total <= 14) {
		return 'Moderate anxiety';
	}
	return 'Severe anxiety';
}

function wellbeing_table_usable($conn, string $tableName): bool
{
	if (!career_table_exists($conn, $tableName)) {
		return false;
	}
	$safe = mysqli_real_escape_string($conn, $tableName);
	try {
		$res = mysqli_query($conn, 'SELECT 1 FROM `' . $safe . '` LIMIT 1');
		return $res !== false;
	} catch (Throwable $e) {
		return false;
	}
}

function wellbeing_schema_ready($conn): bool
{
	return wellbeing_table_usable($conn, 'cpo_phq9')
		&& wellbeing_table_usable($conn, 'cpo_gad7');
}

function wellbeing_create_phq9_table($conn): bool
{
	$sql = "CREATE TABLE IF NOT EXISTS cpo_phq9 (
		id INT AUTO_INCREMENT PRIMARY KEY,
		iStudentId INT NOT NULL,
		tutorid INT NOT NULL DEFAULT 0,
		radio1 TINYINT NOT NULL DEFAULT 0,
		radio2 TINYINT NOT NULL DEFAULT 0,
		radio3 TINYINT NOT NULL DEFAULT 0,
		radio4 TINYINT NOT NULL DEFAULT 0,
		radio5 TINYINT NOT NULL DEFAULT 0,
		radio6 TINYINT NOT NULL DEFAULT 0,
		radio7 TINYINT NOT NULL DEFAULT 0,
		radio8 TINYINT NOT NULL DEFAULT 0,
		radio9 TINYINT NOT NULL DEFAULT 0,
		difficulty TINYINT NULL DEFAULT NULL,
		submit_date DATETIME NOT NULL,
		KEY idx_phq9_student (iStudentId),
		KEY idx_phq9_tutor (tutorid),
		KEY idx_phq9_submit (submit_date)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
	return (bool) mysqli_query($conn, $sql);
}

function wellbeing_create_gad7_table($conn): bool
{
	$sql = "CREATE TABLE IF NOT EXISTS cpo_gad7 (
		id INT AUTO_INCREMENT PRIMARY KEY,
		iStudentId INT NOT NULL,
		tutorid INT NOT NULL DEFAULT 0,
		radio1 TINYINT NOT NULL DEFAULT 0,
		radio2 TINYINT NOT NULL DEFAULT 0,
		radio3 TINYINT NOT NULL DEFAULT 0,
		radio4 TINYINT NOT NULL DEFAULT 0,
		radio5 TINYINT NOT NULL DEFAULT 0,
		radio6 TINYINT NOT NULL DEFAULT 0,
		radio7 TINYINT NOT NULL DEFAULT 0,
		submit_date DATETIME NOT NULL,
		KEY idx_gad7_student (iStudentId),
		KEY idx_gad7_tutor (tutorid),
		KEY idx_gad7_submit (submit_date)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
	return (bool) mysqli_query($conn, $sql);
}

function wellbeing_clear_orphan_tablespace($conn, string $tableName): bool
{
	$safe = mysqli_real_escape_string($conn, $tableName);
	$dbRes = mysqli_query($conn, 'SELECT DATABASE()');
	$dbName = ($dbRes && ($dbRow = mysqli_fetch_row($dbRes))) ? (string) $dbRow[0] : '';
	$datadirRes = mysqli_query($conn, "SHOW VARIABLES LIKE 'datadir'");
	$datadir = '';
	if ($datadirRes && ($dirRow = mysqli_fetch_assoc($datadirRes))) {
		$datadir = rtrim(str_replace('\\', '/', (string) $dirRow['Value']), '/');
	}
	if ($datadir === '' || $dbName === '') {
		return false;
	}
	$ibd = $datadir . '/' . $dbName . '/' . $tableName . '.ibd';
	if (!is_file($ibd)) {
		return false;
	}
	return @unlink($ibd);
}

/**
 * @param callable(mysqli): bool $createFn
 * @return array{ok:bool,messages:array<int,string>}
 */
function wellbeing_install_table($conn, string $tableName, callable $createFn): array
{
	$messages = array();
	$safe = mysqli_real_escape_string($conn, $tableName);

	mysqli_query($conn, 'DROP TABLE IF EXISTS `' . $safe . '`');
	if (wellbeing_clear_orphan_tablespace($conn, $tableName)) {
		$messages[] = 'Removed orphaned tablespace file for ' . $tableName . '.';
	}

	if ($createFn($conn)) {
		$messages[] = 'Created ' . $tableName . ' table.';
		return array('ok' => true, 'messages' => $messages);
	}

	$err = mysqli_error($conn);
	$errno = mysqli_errno($conn);
	if ($errno === 1813 || stripos($err, 'Tablespace') !== false) {
		if (wellbeing_clear_orphan_tablespace($conn, $tableName)) {
			$messages[] = 'Cleared leftover InnoDB file for ' . $tableName . '.';
		}
		mysqli_query($conn, 'DROP TABLE IF EXISTS `' . $safe . '`');
		if ($createFn($conn)) {
			$messages[] = 'Created ' . $tableName . ' table.';
			return array('ok' => true, 'messages' => $messages);
		}
	}

	return array(
		'ok' => false,
		'messages' => array_merge($messages, array('Could not create ' . $tableName . ': ' . mysqli_error($conn))),
	);
}

/**
 * @return array{ok:bool,messages:array<int,string>}
 */
function wellbeing_repair_table($conn, string $tableName): array
{
	$messages = array();
	if (!career_table_exists($conn, $tableName)) {
		return array('ok' => true, 'messages' => $messages);
	}
	if (wellbeing_table_usable($conn, $tableName)) {
		return array('ok' => true, 'messages' => $messages);
	}

	$safe = mysqli_real_escape_string($conn, $tableName);
	if (!mysqli_query($conn, 'DROP TABLE IF EXISTS `' . $safe . '`')) {
		return array(
			'ok' => false,
			'messages' => array('Could not drop broken table ' . $tableName . ': ' . mysqli_error($conn)),
		);
	}
	$messages[] = 'Repaired broken table ' . $tableName . ' (previous data was unavailable).';
	return array('ok' => true, 'messages' => $messages);
}

/**
 * @return array{ok:bool,messages:array<int,string>}
 */
function wellbeing_ensure_schema($conn): array
{
	$messages = array();

	foreach (array('cpo_phq9', 'cpo_gad7') as $tableName) {
		$repair = wellbeing_repair_table($conn, $tableName);
		if (!$repair['ok']) {
			return $repair;
		}
		$messages = array_merge($messages, $repair['messages']);
	}

	if (!wellbeing_table_usable($conn, 'cpo_phq9')) {
		$install = wellbeing_install_table($conn, 'cpo_phq9', 'wellbeing_create_phq9_table');
		if (!$install['ok']) {
			return $install;
		}
		$messages = array_merge($messages, $install['messages']);
	}

	if (!wellbeing_table_usable($conn, 'cpo_gad7')) {
		$install = wellbeing_install_table($conn, 'cpo_gad7', 'wellbeing_create_gad7_table');
		if (!$install['ok']) {
			return $install;
		}
		$messages = array_merge($messages, $install['messages']);
	}

	return array('ok' => true, 'messages' => $messages);
}

function wellbeing_phq9_list_sql(?int $userId = null): string
{
	$sql = "SELECT p.id, p.iStudentId, p.submit_date, u.vUserName,
		(p.radio1 + p.radio2 + p.radio3 + p.radio4 + p.radio5 + p.radio6 + p.radio7 + p.radio8 + p.radio9) AS total
		FROM cpo_phq9 p
		LEFT JOIN cpo_usermaster u ON u.iUserId = p.iStudentId";
	if ($userId !== null && $userId > 0) {
		$sql .= ' WHERE p.iStudentId = ' . $userId;
	}
	$sql .= ' ORDER BY p.submit_date DESC, p.id DESC';
	return $sql;
}

function wellbeing_gad7_list_sql(?int $userId = null): string
{
	$sql = "SELECT g.id, g.iStudentId, g.submit_date, u.vUserName,
		(g.radio1 + g.radio2 + g.radio3 + g.radio4 + g.radio5 + g.radio6 + g.radio7) AS total
		FROM cpo_gad7 g
		LEFT JOIN cpo_usermaster u ON u.iUserId = g.iStudentId";
	if ($userId !== null && $userId > 0) {
		$sql .= ' WHERE g.iStudentId = ' . $userId;
	}
	$sql .= ' ORDER BY g.submit_date DESC, g.id DESC';
	return $sql;
}

function wellbeing_delete_phq9(mysqli $conn, int $id): bool
{
	if ($id <= 0) {
		return false;
	}
	return (bool) mysqli_query($conn, 'DELETE FROM cpo_phq9 WHERE id=' . $id . ' LIMIT 1');
}

function wellbeing_delete_gad7(mysqli $conn, int $id): bool
{
	if ($id <= 0) {
		return false;
	}
	return (bool) mysqli_query($conn, 'DELETE FROM cpo_gad7 WHERE id=' . $id . ' LIMIT 1');
}
