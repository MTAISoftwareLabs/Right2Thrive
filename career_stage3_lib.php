<?php

declare(strict_types=1);

require_once __DIR__ . '/career_progress_lib.php';

if (!function_exists('career_stage3_schema_ready')) {
    function career_stage3_schema_ready($conn): bool
    {
        return career_column_exists($conn, 'cpo_usermaster', 'career_stage3_pcap_activated')
            && career_table_exists($conn, 'career_pcap_plans');
    }
}

if (!function_exists('career_stage3_ensure_schema')) {
    function career_stage3_ensure_schema($conn): bool
    {
        if (!career_column_exists($conn, 'cpo_usermaster', 'career_stage3_pcap_activated')) {
            if (!mysqli_query($conn, 'ALTER TABLE cpo_usermaster ADD COLUMN career_stage3_pcap_activated TINYINT(1) NOT NULL DEFAULT 0')) {
                return false;
            }
        }
        if (!career_column_exists($conn, 'cpo_usermaster', 'career_stage3_activated_at')) {
            if (!mysqli_query($conn, 'ALTER TABLE cpo_usermaster ADD COLUMN career_stage3_activated_at DATETIME NULL DEFAULT NULL')) {
                return false;
            }
        }
        if (!career_table_exists($conn, 'career_pcap_plans')) {
            $sql = "CREATE TABLE career_pcap_plans (
                user_id INT NOT NULL PRIMARY KEY,
                mentor_id INT NULL,
                cv_status ENUM('not_started','in_progress','completed') NOT NULL DEFAULT 'not_started',
                cv_notes TEXT NULL,
                linkedin_applicable TINYINT(1) NOT NULL DEFAULT 1,
                linkedin_status ENUM('not_started','in_progress','completed','not_applicable') NOT NULL DEFAULT 'not_started',
                linkedin_notes TEXT NULL,
                confidence_goals TEXT NULL,
                required_training TEXT NULL,
                engagement_level ENUM('low','medium','high') NOT NULL DEFAULT 'medium',
                coach_completion_pct TINYINT UNSIGNED NOT NULL DEFAULT 0,
                activated_at DATETIME NULL,
                updated_at DATETIME NULL,
                KEY idx_pcap_mentor (mentor_id)
            ) ENGINE=InnoDB";
            if (!mysqli_query($conn, $sql)) {
                return false;
            }
        }
        if (!career_table_exists($conn, 'career_pcap_workshops')) {
            mysqli_query($conn, "CREATE TABLE career_pcap_workshops (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                week_label VARCHAR(50) NULL,
                status ENUM('not_started','in_progress','completed') NOT NULL DEFAULT 'not_started',
                KEY idx_pcap_ws_user (user_id)
            ) ENGINE=InnoDB");
        }
        if (!career_table_exists($conn, 'career_pcap_weekly_targets')) {
            mysqli_query($conn, "CREATE TABLE career_pcap_weekly_targets (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                week_start DATE NOT NULL,
                applications_target INT NOT NULL DEFAULT 0,
                applications_completed INT NOT NULL DEFAULT 0,
                status ENUM('not_started','in_progress','completed') NOT NULL DEFAULT 'not_started',
                KEY idx_pcap_tgt_user (user_id)
            ) ENGINE=InnoDB");
        }
        if (!career_table_exists($conn, 'career_pcap_sessions')) {
            mysqli_query($conn, "CREATE TABLE career_pcap_sessions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                session_at DATETIME NOT NULL,
                title VARCHAR(255) NOT NULL,
                status ENUM('scheduled','completed','cancelled') NOT NULL DEFAULT 'scheduled',
                notes TEXT NULL,
                KEY idx_pcap_sess_user (user_id)
            ) ENGINE=InnoDB");
        }
        if (!career_table_exists($conn, 'career_pcap_coaching_notes')) {
            mysqli_query($conn, "CREATE TABLE career_pcap_coaching_notes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                mentor_id INT NULL,
                note_text TEXT NOT NULL,
                created_at DATETIME NOT NULL,
                KEY idx_pcap_note_user (user_id)
            ) ENGINE=InnoDB");
        }
        return career_stage3_schema_ready($conn);
    }
}

if (!function_exists('career_stage1_complete')) {
    function career_stage1_complete(?array $summary): bool
    {
        return $summary && (int) ($summary['career_assessment_completed'] ?? 0) === 1;
    }
}

if (!function_exists('career_stage2_complete')) {
    function career_stage2_complete(?array $summary): bool
    {
        return $summary && !empty($summary['career_initial_coaching_completed']);
    }
}

if (!function_exists('career_stage3_active')) {
    function career_stage3_active(?array $summary): bool
    {
        return $summary && !empty($summary['career_stage3_pcap_activated']);
    }
}

if (!function_exists('career_can_access_stage3')) {
    function career_can_access_stage3(?array $summary): bool
    {
        return career_stage2_complete($summary) && career_stage3_active($summary);
    }
}

if (!function_exists('career_stage3_block_message')) {
    function career_stage3_block_message(?array $summary): string
    {
        if (!career_stage1_complete($summary)) {
            return 'Complete Stage 1 (career assessment) before accessing this stage.';
        }
        if (!career_stage2_complete($summary)) {
            return 'Complete Stage 2 (initial career coaching session and pathway assignment) before your Personal Career Action Plan can begin.';
        }
        if (!career_stage3_active($summary)) {
            return 'Your coach will activate Stage 3: Personal Career Action Plan (Week 1–2) after Stage 2 is complete.';
        }
        return '';
    }
}

if (!function_exists('career_get_pcap_plan')) {
    function career_get_pcap_plan($conn, int $userId): ?array
    {
        if (!career_stage3_schema_ready($conn)) {
            return null;
        }
        $st = mysqli_prepare($conn, 'SELECT * FROM career_pcap_plans WHERE user_id = ? LIMIT 1');
        if (!$st) {
            return null;
        }
        mysqli_stmt_bind_param($st, 'i', $userId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        return $row ?: null;
    }
}

if (!function_exists('career_pcap_list_workshops')) {
    function career_pcap_list_workshops($conn, int $userId): array
    {
        $rows = array();
        if (!career_table_exists($conn, 'career_pcap_workshops')) {
            return $rows;
        }
        $rs = mysqli_query($conn, 'SELECT * FROM career_pcap_workshops WHERE user_id=' . $userId . ' ORDER BY id ASC');
        if ($rs) {
            while ($r = mysqli_fetch_assoc($rs)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }
}

if (!function_exists('career_pcap_list_weekly_targets')) {
    function career_pcap_list_weekly_targets($conn, int $userId): array
    {
        $rows = array();
        if (!career_table_exists($conn, 'career_pcap_weekly_targets')) {
            return $rows;
        }
        $rs = mysqli_query($conn, 'SELECT * FROM career_pcap_weekly_targets WHERE user_id=' . $userId . ' ORDER BY week_start ASC');
        if ($rs) {
            while ($r = mysqli_fetch_assoc($rs)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }
}

if (!function_exists('career_pcap_list_sessions')) {
    function career_pcap_list_sessions($conn, int $userId): array
    {
        $rows = array();
        if (!career_table_exists($conn, 'career_pcap_sessions')) {
            return $rows;
        }
        $rs = mysqli_query($conn, 'SELECT * FROM career_pcap_sessions WHERE user_id=' . $userId . ' ORDER BY session_at ASC');
        if ($rs) {
            while ($r = mysqli_fetch_assoc($rs)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }
}

if (!function_exists('career_pcap_list_coaching_notes')) {
    function career_pcap_list_coaching_notes($conn, int $userId, bool $learnerVisibleOnly = false): array
    {
        $rows = array();
        if (!career_table_exists($conn, 'career_pcap_coaching_notes')) {
            return $rows;
        }
        $rs = mysqli_query($conn, 'SELECT n.*, u.vUserName AS mentor_name FROM career_pcap_coaching_notes n
            LEFT JOIN cpo_usermaster u ON u.iUserId = n.mentor_id
            WHERE n.user_id=' . $userId . ' ORDER BY n.created_at DESC');
        if ($rs) {
            while ($r = mysqli_fetch_assoc($rs)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }
}

if (!function_exists('career_pcap_progress_pct')) {
    function career_pcap_progress_pct($conn, int $userId, ?array $plan): int
    {
        if (!$plan) {
            return 0;
        }
        $total = 0;
        $done = 0;
        $cv = (string) ($plan['cv_status'] ?? 'not_started');
        $total++;
        if ($cv === 'completed') {
            $done++;
        }
        if (!empty($plan['linkedin_applicable'])) {
            $li = (string) ($plan['linkedin_status'] ?? 'not_started');
            if ($li !== 'not_applicable') {
                $total++;
                if ($li === 'completed') {
                    $done++;
                }
            }
        }
        foreach (career_pcap_list_workshops($conn, $userId) as $w) {
            $total++;
            if (($w['status'] ?? '') === 'completed') {
                $done++;
            }
        }
        foreach (career_pcap_list_weekly_targets($conn, $userId) as $t) {
            $total++;
            if (($t['status'] ?? '') === 'completed') {
                $done++;
            }
        }
        if ($total === 0) {
            return (int) ($plan['coach_completion_pct'] ?? 0);
        }
        return (int) round(($done / $total) * 100);
    }
}

if (!function_exists('career_coach_may_edit_learner')) {
    function career_coach_may_edit_learner($conn, int $learnerId, int $staffId, string $mode): bool
    {
        if ($mode === 'admin') {
            return true;
        }
        $st = mysqli_prepare($conn, 'SELECT career_mentor_id FROM cpo_usermaster WHERE iUserId = ? LIMIT 1');
        if (!$st) {
            return false;
        }
        mysqli_stmt_bind_param($st, 'i', $learnerId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        return $row && (int) ($row['career_mentor_id'] ?? 0) === $staffId;
    }
}

if (!function_exists('career_handle_stage3_coach_post')) {
    function career_handle_stage3_coach_post($conn, int $staffId, string $mode): string
    {
        if (!isset($_POST['pcap_action'])) {
            return '';
        }
        career_stage3_ensure_schema($conn);
        $uid = (int) ($_POST['user_id'] ?? 0);
        if ($uid <= 0 || !career_coach_may_edit_learner($conn, $uid, $staffId, $mode)) {
            return 'You cannot edit this learner.';
        }
        $summary = career_get_user_summary($conn, $uid);
        if (!career_stage2_complete($summary)) {
            return 'Stage 2 must be completed before activating Stage 3 (PCAP).';
        }

        $action = (string) $_POST['pcap_action'];

        if ($action === 'activate_pcap') {
            $cv = in_array($_POST['cv_status'] ?? '', array('not_started', 'in_progress', 'completed'), true)
                ? $_POST['cv_status'] : 'not_started';
            $liApp = !empty($_POST['linkedin_applicable']) ? 1 : 0;
            $li = in_array($_POST['linkedin_status'] ?? '', array('not_started', 'in_progress', 'completed', 'not_applicable'), true)
                ? $_POST['linkedin_status'] : ($liApp ? 'not_started' : 'not_applicable');
            $eng = in_array($_POST['engagement_level'] ?? '', array('low', 'medium', 'high'), true)
                ? $_POST['engagement_level'] : 'medium';
            $cvN = mysqli_real_escape_string($conn, trim((string) ($_POST['cv_notes'] ?? '')));
            $liN = mysqli_real_escape_string($conn, trim((string) ($_POST['linkedin_notes'] ?? '')));
            $conf = mysqli_real_escape_string($conn, trim((string) ($_POST['confidence_goals'] ?? '')));
            $train = mysqli_real_escape_string($conn, trim((string) ($_POST['required_training'] ?? '')));
            $now = date('Y-m-d H:i:s');
            mysqli_query($conn, "INSERT INTO career_pcap_plans (user_id, mentor_id, cv_status, cv_notes, linkedin_applicable, linkedin_status, linkedin_notes,
                confidence_goals, required_training, engagement_level, activated_at, updated_at)
                VALUES (" . $uid . "," . $staffId . ",'" . $cv . "','" . $cvN . "'," . $liApp . ",'" . $li . "','" . $liN . "','" . $conf . "','" . $train . "','" . $eng . "','" . $now . "','" . $now . "')
                ON DUPLICATE KEY UPDATE mentor_id=VALUES(mentor_id), cv_status=VALUES(cv_status), cv_notes=VALUES(cv_notes),
                linkedin_applicable=VALUES(linkedin_applicable), linkedin_status=VALUES(linkedin_status), linkedin_notes=VALUES(linkedin_notes),
                confidence_goals=VALUES(confidence_goals), required_training=VALUES(required_training),
                engagement_level=VALUES(engagement_level), updated_at=VALUES(updated_at)");
            mysqli_query($conn, 'UPDATE cpo_usermaster SET career_stage3_pcap_activated=1, career_stage3_activated_at=NOW() WHERE iUserId=' . $uid);
            return 'Stage 3: Personal Career Action Plan activated.';
        }

        if ($action === 'update_pcap') {
            if (!career_stage3_active($summary)) {
                return 'Activate the PCAP first.';
            }
            $cv = in_array($_POST['cv_status'] ?? '', array('not_started', 'in_progress', 'completed'), true)
                ? $_POST['cv_status'] : 'not_started';
            $liApp = !empty($_POST['linkedin_applicable']) ? 1 : 0;
            $li = in_array($_POST['linkedin_status'] ?? '', array('not_started', 'in_progress', 'completed', 'not_applicable'), true)
                ? $_POST['linkedin_status'] : 'not_applicable';
            $eng = in_array($_POST['engagement_level'] ?? '', array('low', 'medium', 'high'), true)
                ? $_POST['engagement_level'] : 'medium';
            $pct = max(0, min(100, (int) ($_POST['coach_completion_pct'] ?? 0)));
            $cvN = mysqli_real_escape_string($conn, trim((string) ($_POST['cv_notes'] ?? '')));
            $liN = mysqli_real_escape_string($conn, trim((string) ($_POST['linkedin_notes'] ?? '')));
            $conf = mysqli_real_escape_string($conn, trim((string) ($_POST['confidence_goals'] ?? '')));
            $train = mysqli_real_escape_string($conn, trim((string) ($_POST['required_training'] ?? '')));
            mysqli_query($conn, "UPDATE career_pcap_plans SET cv_status='" . $cv . "', cv_notes='" . $cvN . "', linkedin_applicable=" . $liApp . ",
                linkedin_status='" . $li . "', linkedin_notes='" . $liN . "', confidence_goals='" . $conf . "',
                required_training='" . $train . "', engagement_level='" . $eng . "', coach_completion_pct=" . $pct . ", updated_at=NOW()
                WHERE user_id=" . $uid);
            return 'PCAP plan updated.';
        }

        if ($action === 'add_workshop') {
            $title = mysqli_real_escape_string($conn, trim((string) ($_POST['workshop_title'] ?? '')));
            $week = mysqli_real_escape_string($conn, trim((string) ($_POST['workshop_week'] ?? '')));
            if ($title !== '') {
                mysqli_query($conn, "INSERT INTO career_pcap_workshops (user_id, title, week_label) VALUES (" . $uid . ",'" . $title . "','" . $week . "')");
            }
            return 'Workshop added.';
        }

        if ($action === 'add_weekly_target') {
            $ws = mysqli_real_escape_string($conn, trim((string) ($_POST['target_week_start'] ?? '')));
            $tgt = max(0, (int) ($_POST['applications_target'] ?? 0));
            if ($ws !== '') {
                mysqli_query($conn, "INSERT INTO career_pcap_weekly_targets (user_id, week_start, applications_target) VALUES (" . $uid . ",'" . $ws . "'," . $tgt . ")");
            }
            return 'Weekly target added.';
        }

        if ($action === 'add_session') {
            $at = mysqli_real_escape_string($conn, trim((string) ($_POST['session_at'] ?? '')));
            $title = mysqli_real_escape_string($conn, trim((string) ($_POST['session_title'] ?? '')));
            if ($at !== '' && $title !== '') {
                mysqli_query($conn, "INSERT INTO career_pcap_sessions (user_id, session_at, title) VALUES (" . $uid . ",'" . $at . "','" . $title . "')");
            }
            return 'Session scheduled.';
        }

        if ($action === 'add_coaching_note') {
            $note = mysqli_real_escape_string($conn, trim((string) ($_POST['coaching_note'] ?? '')));
            if ($note !== '') {
                mysqli_query($conn, "INSERT INTO career_pcap_coaching_notes (user_id, mentor_id, note_text, created_at) VALUES (" . $uid . "," . $staffId . ",'" . $note . "',NOW())");
            }
            return 'Coaching note saved.';
        }

        return '';
    }
}

if (!function_exists('career_extend_user_summary_stage3')) {
    function career_extend_user_summary_stage3($conn, array $row): array
    {
        if (!career_stage3_schema_ready($conn)) {
            $row['career_stage3_pcap_activated'] = 0;
            $row['career_stage3_activated_at'] = null;
            return $row;
        }
        $uid = (int) ($row['iUserId'] ?? 0);
        $st = mysqli_prepare($conn, 'SELECT career_stage3_pcap_activated, career_stage3_activated_at FROM cpo_usermaster WHERE iUserId = ? LIMIT 1');
        if ($st) {
            mysqli_stmt_bind_param($st, 'i', $uid);
            mysqli_stmt_execute($st);
            $rs = mysqli_stmt_get_result($st);
            if ($rs && mysqli_num_rows($rs) > 0) {
                $s3 = mysqli_fetch_assoc($rs);
                $row['career_stage3_pcap_activated'] = (int) ($s3['career_stage3_pcap_activated'] ?? 0);
                $row['career_stage3_activated_at'] = $s3['career_stage3_activated_at'] ?? null;
            }
            mysqli_stmt_close($st);
        }
        return $row;
    }
}
