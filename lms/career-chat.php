<?php
/**
 * Collective Careers Hub — text chat with assigned career coach (live poll + send).
 */
include 'dbConnection.php';
require_once dirname(__DIR__) . '/career_chat_lib.php';

career_chat_ensure_schema($conn);

$userId = (int) $_SESSION['user_id'];
$summary = career_get_user_summary($conn, $userId);
$mentorId = ($summary && !empty($summary['career_mentor_id'])) ? (int) $summary['career_mentor_id'] : 0;
$mentorRow = null;
if ($mentorId > 0) {
    $st = mysqli_prepare($conn, 'SELECT iUserId, vUserName, vUserEmailId FROM cpo_usermaster WHERE iUserId = ? AND iUserType = 1 AND iUserStatus = 1 LIMIT 1');
    if ($st) {
        mysqli_stmt_bind_param($st, 'i', $mentorId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        if ($rs && mysqli_num_rows($rs)) {
            $mentorRow = mysqli_fetch_assoc($rs);
        }
        mysqli_stmt_close($st);
    }
}

$messages = array();
$lastId = 0;
$unread = 0;
if ($mentorRow && $mentorId > 0) {
    career_chat_mark_read($conn, $userId, $mentorId, 'learner');
    $messages = career_chat_thread($conn, $userId, $mentorId, 250, 0);
    $lastId = career_chat_thread_last_id($conn, $userId, $mentorId);
    $unread = career_chat_unread_count($conn, $userId, $mentorId, 'learner');
}

$csrf = career_chat_csrf_token();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'metadata.php'; ?>
    <title>Chat with career coach<?php echo sitename; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        .cch-wrap { max-width: 720px; }
        .cch-card { border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.25rem; margin-bottom: 1rem; background: #fff; box-shadow: 0 4px 18px rgba(15,23,42,0.06); }
        .cch-muted { color: #64748b; font-size: 0.9rem; }
        .cch-thread { max-height: min(55vh, 480px); overflow-y: auto; padding: 0.75rem; background: #f8fafc; border-radius: 0.75rem; border: 1px solid #e2e8f0; display: flex; flex-direction: column; }
        .cch-bubble { max-width: 85%; margin-bottom: 0.75rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; font-size: 0.95rem; line-height: 1.45; word-break: break-word; }
        .cch-bubble--mine { margin-left: auto; background: #4f46e5; color: #fff; border-bottom-right-radius: 0.2rem; }
        .cch-bubble--mine .cch-meta { color: rgba(255,255,255,0.85); }
        .cch-bubble--theirs { margin-right: auto; background: #fff; border: 1px solid #e2e8f0; border-bottom-left-radius: 0.2rem; }
        .cch-meta { font-size: 0.72rem; opacity: 0.85; margin-top: 0.25rem; }
        #cch-input { resize: vertical; min-height: 2.75rem; }
        #cch-send:disabled { opacity: 0.65; }
    </style>
</head>
<body>
<div id="app">
    <?php include 'sidebar.php'; ?>
    <div id="main" style="padding: 1.5rem 2rem;">
        <?php include 'header.php'; ?>

        <div class="page-heading">
            <h3 class="mb-1">
                <i class="bi bi-chat-dots me-2 text-primary"></i>Chat with your career coach
                <span id="cch-title-unread" class="badge rounded-pill text-bg-danger ms-2<?php echo $unread > 0 ? '' : ' d-none'; ?>"><?php echo $unread > 99 ? '99+' : (int) $unread; ?></span>
            </h3>
            <p class="hub-page-sub mb-0">Messages update automatically. Press Enter to send, Shift+Enter for a new line.</p>
        </div>

        <div class="page-content">
            <div class="cch-wrap">
                <?php if (!$mentorRow) { ?>
                    <div class="cch-card">
                        <p class="mb-0"><strong>No career coach assigned yet.</strong></p>
                        <p class="cch-muted mb-0 mt-2">Once a tutor is assigned in the Collective Careers Hub, you can chat here.</p>
                    </div>
                <?php } else { ?>
                    <div class="cch-card py-2">
                        <p class="mb-0 small"><span class="text-muted">Your coach:</span> <strong><?php echo htmlspecialchars((string) $mentorRow['vUserName'], ENT_QUOTES, 'UTF-8'); ?></strong></p>
                    </div>

                    <div class="cch-card" id="career-chat-app"
                         data-api="career-chat-api.php"
                         data-role="learner"
                         data-csrf="<?php echo htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8'); ?>"
                         data-last-id="<?php echo (int) $lastId; ?>"
                         data-poll-ms="5000">
                        <div class="cch-thread" id="cch-thread" aria-live="polite" aria-relevant="additions">
                            <?php if ($messages === array()) { ?>
                                <p class="cch-muted cch-empty mb-0 text-center py-3">No messages yet. Say hello to your coach.</p>
                            <?php } else {
                                foreach ($messages as $m) {
                                    $mine = ($m['sender_role'] ?? '') === 'learner';
                                    $cls = $mine ? 'cch-bubble cch-bubble--mine' : 'cch-bubble cch-bubble--theirs';
                                    ?>
                                    <div class="<?php echo $cls; ?>" data-id="<?php echo (int) ($m['id'] ?? 0); ?>">
                                        <div class="cch-body"><?php echo nl2br(htmlspecialchars((string) ($m['message_body'] ?? ''), ENT_QUOTES, 'UTF-8')); ?></div>
                                        <div class="cch-meta"><?php echo htmlspecialchars((string) ($m['created_at'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></div>
                                    </div>
                                <?php }
                            } ?>
                        </div>

                        <form id="cch-form" class="mt-3" novalidate>
                            <label class="form-label" for="cch-input">Your message</label>
                            <textarea id="cch-input" name="message_body" class="form-control" rows="3" maxlength="8000" placeholder="Type your message…" required></textarea>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <button type="submit" id="cch-send" class="btn btn-primary"><i class="bi bi-send me-1"></i> Send</button>
                                <span class="cch-status small text-muted" id="cch-status"></span>
                            </div>
                        </form>
                    </div>
                <?php } ?>

                <p class="cch-muted mt-2"><a href="career-progress-dashboard.php">← Back to Career Progress Monitor</a></p>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>
<?php if ($mentorRow) { ?>
<script src="../assets/js/career-chat.js"></script>
<?php } ?>
</body>
</html>
