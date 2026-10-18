<?php

declare(strict_types=1);

require_once __DIR__ . '/career_progress_lib.php';
require_once __DIR__ . '/career_stage3_lib.php';

if (!function_exists('career_chat_table_ready')) {
    function career_chat_table_ready($conn): bool
    {
        return career_table_exists($conn, 'career_chat_messages');
    }
}

if (!function_exists('career_chat_read_cursors_ready')) {
    function career_chat_read_cursors_ready($conn): bool
    {
        return career_table_exists($conn, 'career_chat_read_cursors');
    }
}

if (!function_exists('career_chat_ensure_schema')) {
    function career_chat_ensure_schema($conn): bool
    {
        if (!career_chat_table_ready($conn)) {
            $sql = "CREATE TABLE IF NOT EXISTS career_chat_messages (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                learner_id INT NOT NULL,
                tutor_id INT NOT NULL,
                sender_role ENUM('learner','tutor') NOT NULL,
                sender_user_id INT NOT NULL,
                message_body TEXT NOT NULL,
                created_at DATETIME NOT NULL,
                PRIMARY KEY (id),
                KEY idx_cchat_thread (learner_id, tutor_id, created_at),
                KEY idx_cchat_tutor (tutor_id, created_at),
                KEY idx_cchat_thread_id (learner_id, tutor_id, id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            if (!mysqli_query($conn, $sql)) {
                return false;
            }
        }
        if (!career_chat_read_cursors_ready($conn)) {
            $sql2 = "CREATE TABLE IF NOT EXISTS career_chat_read_cursors (
                learner_id INT NOT NULL,
                tutor_id INT NOT NULL,
                learner_last_read_id INT UNSIGNED NOT NULL DEFAULT 0,
                tutor_last_read_id INT UNSIGNED NOT NULL DEFAULT 0,
                updated_at DATETIME NOT NULL,
                PRIMARY KEY (learner_id, tutor_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            if (!mysqli_query($conn, $sql2)) {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('career_chat_csrf_token')) {
    function career_chat_csrf_token(): string
    {
        if (empty($_SESSION['career_chat_csrf']) || !is_string($_SESSION['career_chat_csrf'])) {
            $_SESSION['career_chat_csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['career_chat_csrf'];
    }
}

if (!function_exists('career_chat_csrf_verify')) {
    function career_chat_csrf_verify(?string $token): bool
    {
        $expected = $_SESSION['career_chat_csrf'] ?? '';
        return is_string($token) && $token !== '' && is_string($expected) && hash_equals($expected, $token);
    }
}

if (!function_exists('career_chat_pair_valid')) {
    function career_chat_pair_valid($conn, int $learnerId, int $tutorId): bool
    {
        if ($learnerId < 1 || $tutorId < 1) {
            return false;
        }
        $st = mysqli_prepare($conn, 'SELECT career_mentor_id FROM cpo_usermaster WHERE iUserId = ? AND iUserType = 2 AND iUserStatus = 1 LIMIT 1');
        if (!$st) {
            return false;
        }
        mysqli_stmt_bind_param($st, 'i', $learnerId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        return $row && (int) ($row['career_mentor_id'] ?? 0) === $tutorId;
    }
}

if (!function_exists('career_chat_format_message')) {
    function career_chat_format_message(array $row, string $viewerRole): array
    {
        $senderRole = (string) ($row['sender_role'] ?? '');
        return array(
            'id' => (int) ($row['id'] ?? 0),
            'body' => (string) ($row['message_body'] ?? ''),
            'sender_role' => $senderRole,
            'mine' => $senderRole === $viewerRole,
            'created_at' => (string) ($row['created_at'] ?? ''),
        );
    }
}

if (!function_exists('career_chat_mark_read')) {
    function career_chat_mark_read($conn, int $learnerId, int $tutorId, string $readerRole, int $upToMessageId = 0): void
    {
        if (!career_chat_read_cursors_ready($conn) || !career_chat_pair_valid($conn, $learnerId, $tutorId)) {
            return;
        }
        if ($upToMessageId < 1) {
            $stMax = mysqli_prepare(
                $conn,
                'SELECT COALESCE(MAX(id), 0) AS mid FROM career_chat_messages WHERE learner_id = ? AND tutor_id = ?'
            );
            if (!$stMax) {
                return;
            }
            mysqli_stmt_bind_param($stMax, 'ii', $learnerId, $tutorId);
            mysqli_stmt_execute($stMax);
            $rsMax = mysqli_stmt_get_result($stMax);
            $rowMax = ($rsMax && mysqli_num_rows($rsMax) > 0) ? mysqli_fetch_assoc($rsMax) : null;
            mysqli_stmt_close($stMax);
            $upToMessageId = (int) ($rowMax['mid'] ?? 0);
        }
        if ($upToMessageId < 1) {
            return;
        }
        if ($readerRole === 'learner') {
            $sql = 'INSERT INTO career_chat_read_cursors (learner_id, tutor_id, learner_last_read_id, tutor_last_read_id, updated_at)
                VALUES (?, ?, ?, 0, NOW())
                ON DUPLICATE KEY UPDATE learner_last_read_id = GREATEST(learner_last_read_id, VALUES(learner_last_read_id)), updated_at = NOW()';
        } elseif ($readerRole === 'tutor') {
            $sql = 'INSERT INTO career_chat_read_cursors (learner_id, tutor_id, learner_last_read_id, tutor_last_read_id, updated_at)
                VALUES (?, ?, 0, ?, NOW())
                ON DUPLICATE KEY UPDATE tutor_last_read_id = GREATEST(tutor_last_read_id, VALUES(tutor_last_read_id)), updated_at = NOW()';
        } else {
            return;
        }
        $st = mysqli_prepare($conn, $sql);
        if (!$st) {
            return;
        }
        mysqli_stmt_bind_param($st, 'iii', $learnerId, $tutorId, $upToMessageId);
        mysqli_stmt_execute($st);
        mysqli_stmt_close($st);
    }
}

if (!function_exists('career_chat_unread_count')) {
    function career_chat_unread_count($conn, int $learnerId, int $tutorId, string $forRole): int
    {
        if (!career_chat_table_ready($conn) || !career_chat_pair_valid($conn, $learnerId, $tutorId)) {
            return 0;
        }
        $fromRole = $forRole === 'learner' ? 'tutor' : 'learner';
        $cursorCol = $forRole === 'learner' ? 'learner_last_read_id' : 'tutor_last_read_id';
        $sql = "SELECT COUNT(*) AS c FROM career_chat_messages m
            LEFT JOIN career_chat_read_cursors r ON r.learner_id = m.learner_id AND r.tutor_id = m.tutor_id
            WHERE m.learner_id = ? AND m.tutor_id = ? AND m.sender_role = ?
            AND m.id > COALESCE(r.{$cursorCol}, 0)";
        $st = mysqli_prepare($conn, $sql);
        if (!$st) {
            return 0;
        }
        mysqli_stmt_bind_param($st, 'iis', $learnerId, $tutorId, $fromRole);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        return (int) ($row['c'] ?? 0);
    }
}

if (!function_exists('career_chat_unread_by_learner_for_tutor')) {
    /** @return array<int,int> learner_id => unread count */
    function career_chat_unread_by_learner_for_tutor($conn, int $tutorId): array
    {
        if ($tutorId < 1 || !career_chat_table_ready($conn)) {
            return array();
        }
        $sql = "SELECT m.learner_id, COUNT(*) AS c
            FROM career_chat_messages m
            INNER JOIN cpo_usermaster u ON u.iUserId = m.learner_id AND u.career_mentor_id = ?
            LEFT JOIN career_chat_read_cursors r ON r.learner_id = m.learner_id AND r.tutor_id = m.tutor_id
            WHERE m.tutor_id = ? AND m.sender_role = 'learner'
            AND m.id > COALESCE(r.tutor_last_read_id, 0)
            GROUP BY m.learner_id";
        $st = mysqli_prepare($conn, $sql);
        if (!$st) {
            return array();
        }
        mysqli_stmt_bind_param($st, 'ii', $tutorId, $tutorId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $out = array();
        if ($rs) {
            while ($row = mysqli_fetch_assoc($rs)) {
                $out[(int) $row['learner_id']] = (int) $row['c'];
            }
        }
        mysqli_stmt_close($st);
        return $out;
    }
}

if (!function_exists('career_chat_send')) {
    /**
     * @return array{ok:bool,message:string,id?:int}
     */
    function career_chat_send($conn, int $senderUserId, string $senderRole, int $learnerId, int $tutorId, string $body): array
    {
        if (!career_chat_ensure_schema($conn)) {
            return array('ok' => false, 'message' => 'Chat is not available. Run migrate_career_chat.php once.');
        }
        $body = trim($body);
        if ($body === '') {
            return array('ok' => false, 'message' => 'Message cannot be empty.');
        }
        if (strlen($body) > 8000) {
            return array('ok' => false, 'message' => 'Message is too long (max 8000 characters).');
        }
        if ($senderRole !== 'learner' && $senderRole !== 'tutor') {
            return array('ok' => false, 'message' => 'Invalid sender role.');
        }
        if (!career_chat_pair_valid($conn, $learnerId, $tutorId)) {
            return array('ok' => false, 'message' => 'You can only chat with your assigned career coach and their learners.');
        }
        if ($senderRole === 'learner' && $senderUserId !== $learnerId) {
            return array('ok' => false, 'message' => 'Access denied.');
        }
        if ($senderRole === 'tutor' && ($senderUserId !== $tutorId || !career_coach_may_edit_learner($conn, $learnerId, $tutorId, 'mentor'))) {
            return array('ok' => false, 'message' => 'Access denied.');
        }

        $st = mysqli_prepare(
            $conn,
            'INSERT INTO career_chat_messages (learner_id, tutor_id, sender_role, sender_user_id, message_body, created_at)
             VALUES (?, ?, ?, ?, ?, NOW())'
        );
        if (!$st) {
            return array('ok' => false, 'message' => 'Could not save message.');
        }
        mysqli_stmt_bind_param($st, 'iisis', $learnerId, $tutorId, $senderRole, $senderUserId, $body);
        $ok = mysqli_stmt_execute($st);
        mysqli_stmt_close($st);
        if (!$ok) {
            return array('ok' => false, 'message' => 'Could not save message.');
        }
        $newId = (int) mysqli_insert_id($conn);
        career_chat_mark_read($conn, $learnerId, $tutorId, $senderRole, $newId);
        return array('ok' => true, 'message' => 'Message sent.', 'id' => $newId);
    }
}

if (!function_exists('career_chat_thread')) {
    function career_chat_thread($conn, int $learnerId, int $tutorId, int $limit = 200, int $afterId = 0): array
    {
        if (!career_chat_table_ready($conn) || !career_chat_pair_valid($conn, $learnerId, $tutorId)) {
            return array();
        }
        $limit = max(1, min(500, $limit));
        $afterId = max(0, $afterId);
        if ($afterId > 0) {
            $st = mysqli_prepare(
                $conn,
                'SELECT id, learner_id, tutor_id, sender_role, sender_user_id, message_body, created_at
                 FROM career_chat_messages
                 WHERE learner_id = ? AND tutor_id = ? AND id > ?
                 ORDER BY id ASC
                 LIMIT ' . $limit
            );
            if (!$st) {
                return array();
            }
            mysqli_stmt_bind_param($st, 'iii', $learnerId, $tutorId, $afterId);
        } else {
            $st = mysqli_prepare(
                $conn,
                'SELECT id, learner_id, tutor_id, sender_role, sender_user_id, message_body, created_at
                 FROM career_chat_messages
                 WHERE learner_id = ? AND tutor_id = ?
                 ORDER BY id ASC
                 LIMIT ' . $limit
            );
            if (!$st) {
                return array();
            }
            mysqli_stmt_bind_param($st, 'ii', $learnerId, $tutorId);
        }
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $rows = array();
        if ($rs) {
            while ($row = mysqli_fetch_assoc($rs)) {
                $rows[] = $row;
            }
        }
        mysqli_stmt_close($st);
        return $rows;
    }
}

if (!function_exists('career_chat_thread_last_id')) {
    function career_chat_thread_last_id($conn, int $learnerId, int $tutorId): int
    {
        if (!career_chat_table_ready($conn)) {
            return 0;
        }
        $st = mysqli_prepare(
            $conn,
            'SELECT COALESCE(MAX(id), 0) AS mid FROM career_chat_messages WHERE learner_id = ? AND tutor_id = ?'
        );
        if (!$st) {
            return 0;
        }
        mysqli_stmt_bind_param($st, 'ii', $learnerId, $tutorId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        return (int) ($row['mid'] ?? 0);
    }
}

if (!function_exists('career_chat_learners_for_tutor')) {
    function career_chat_learners_for_tutor($conn, int $tutorId): array
    {
        if ($tutorId < 1) {
            return array();
        }
        $st = mysqli_prepare(
            $conn,
            'SELECT iUserId, vUserName, vUserEmailId
             FROM cpo_usermaster
             WHERE iUserType = 2 AND iUserStatus = 1 AND career_mentor_id = ?
             ORDER BY vUserName ASC'
        );
        if (!$st) {
            return array();
        }
        mysqli_stmt_bind_param($st, 'i', $tutorId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $rows = array();
        if ($rs) {
            while ($row = mysqli_fetch_assoc($rs)) {
                $rows[] = $row;
            }
        }
        mysqli_stmt_close($st);
        return $rows;
    }
}

if (!function_exists('career_chat_api_json')) {
    function career_chat_api_json(array $payload, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        echo json_encode($payload, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

if (!function_exists('career_chat_api_handle')) {
    /**
     * @param 'learner'|'tutor' $viewerRole
     */
    function career_chat_api_handle($conn, int $userId, string $viewerRole): void
    {
        career_chat_ensure_schema($conn);

        if ($userId < 1) {
            career_chat_api_json(array('ok' => false, 'error' => 'Not authenticated.'), 401);
        }

        $learnerId = isset($_REQUEST['learner_id']) ? (int) $_REQUEST['learner_id'] : 0;
        $tutorId = isset($_REQUEST['tutor_id']) ? (int) $_REQUEST['tutor_id'] : 0;

        if ($viewerRole === 'learner') {
            $summary = career_get_user_summary($conn, $userId);
            $tutorId = ($summary && !empty($summary['career_mentor_id'])) ? (int) $summary['career_mentor_id'] : 0;
            $learnerId = $userId;
            if ($tutorId < 1) {
                career_chat_api_json(array('ok' => false, 'error' => 'No career coach assigned yet.'), 403);
            }
        } else {
            if ($learnerId < 1) {
                career_chat_api_json(array('ok' => false, 'error' => 'learner_id is required.'), 400);
            }
            $tutorId = $userId;
            if (!career_chat_pair_valid($conn, $learnerId, $tutorId)) {
                career_chat_api_json(array('ok' => false, 'error' => 'Access denied for this learner.'), 403);
            }
        }

        $action = isset($_REQUEST['action']) ? (string) $_REQUEST['action'] : 'poll';

        if ($action === 'csrf') {
            career_chat_api_json(array('ok' => true, 'csrf' => career_chat_csrf_token()));
        }

        if ($action === 'poll') {
            $afterId = isset($_REQUEST['after_id']) ? (int) $_REQUEST['after_id'] : 0;
            $markRead = !isset($_REQUEST['mark_read']) || $_REQUEST['mark_read'] !== '0';
            if ($markRead) {
                career_chat_mark_read($conn, $learnerId, $tutorId, $viewerRole);
            }
            $rows = $afterId > 0
                ? career_chat_thread($conn, $learnerId, $tutorId, 100, $afterId)
                : career_chat_thread($conn, $learnerId, $tutorId, 250, 0);
            $messages = array();
            foreach ($rows as $row) {
                $messages[] = career_chat_format_message($row, $viewerRole);
            }
            $payload = array(
                'ok' => true,
                'messages' => $messages,
                'last_id' => career_chat_thread_last_id($conn, $learnerId, $tutorId),
                'unread' => career_chat_unread_count($conn, $learnerId, $tutorId, $viewerRole),
                'csrf' => career_chat_csrf_token(),
            );
            if ($viewerRole === 'tutor') {
                $payload['unread_by_learner'] = career_chat_unread_by_learner_for_tutor($conn, $tutorId);
            }
            career_chat_api_json($payload);
        }

        if ($action === 'send' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrf = isset($_POST['csrf']) ? (string) $_POST['csrf'] : '';
            if (!career_chat_csrf_verify($csrf)) {
                career_chat_api_json(array('ok' => false, 'error' => 'Invalid session token. Refresh the page and try again.'), 403);
            }
            $body = isset($_POST['message_body']) ? (string) $_POST['message_body'] : '';
            $r = career_chat_send($conn, $userId, $viewerRole, $learnerId, $tutorId, $body);
            if (!$r['ok']) {
                career_chat_api_json(array('ok' => false, 'error' => $r['message']), 400);
            }
            $row = array();
            if (!empty($r['id'])) {
                $st = mysqli_prepare(
                    $conn,
                    'SELECT id, learner_id, tutor_id, sender_role, sender_user_id, message_body, created_at
                     FROM career_chat_messages WHERE id = ? LIMIT 1'
                );
                if ($st) {
                    $mid = (int) $r['id'];
                    mysqli_stmt_bind_param($st, 'i', $mid);
                    mysqli_stmt_execute($st);
                    $rs = mysqli_stmt_get_result($st);
                    $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : array();
                    mysqli_stmt_close($st);
                }
            }
            career_chat_api_json(array(
                'ok' => true,
                'message' => career_chat_format_message($row, $viewerRole),
                'last_id' => (int) ($r['id'] ?? 0),
                'unread' => 0,
                'csrf' => career_chat_csrf_token(),
            ));
        }

        career_chat_api_json(array('ok' => false, 'error' => 'Unknown action.'), 400);
    }
}
