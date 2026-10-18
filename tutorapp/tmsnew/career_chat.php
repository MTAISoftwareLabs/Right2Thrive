<?php
declare(strict_types=1);

include 'dbConnection.php';
require_once dirname(__DIR__, 2) . '/career_chat_lib.php';

career_chat_ensure_schema($conn);

$tutorId = (int) $_SESSION['user_id'];
$learners = career_chat_learners_for_tutor($conn, $tutorId);
$unreadByLearner = career_chat_unread_by_learner_for_tutor($conn, $tutorId);

$selectedLearnerId = isset($_GET['learner_id']) ? (int) $_GET['learner_id'] : 0;
if ($selectedLearnerId < 1 && $learners !== array()) {
    $selectedLearnerId = (int) ($learners[0]['iUserId'] ?? 0);
}

$selectedLearner = null;
foreach ($learners as $l) {
    if ((int) ($l['iUserId'] ?? 0) === $selectedLearnerId) {
        $selectedLearner = $l;
        break;
    }
}

$messages = array();
$lastId = 0;
if ($selectedLearner && $selectedLearnerId > 0) {
    career_chat_mark_read($conn, $selectedLearnerId, $tutorId, 'tutor');
    $messages = career_chat_thread($conn, $selectedLearnerId, $tutorId, 250, 0);
    $lastId = career_chat_thread_last_id($conn, $selectedLearnerId, $tutorId);
}

$csrf = career_chat_csrf_token();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($sitename ?? 'Careers', ENT_QUOTES, 'UTF-8'); ?> | Career coach chat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <style>
        .cch-thread { max-height: min(55vh, 520px); overflow-y: auto; padding: 0.75rem; background: #f8fafc; border-radius: 0.5rem; border: 1px solid #dee2e6; display: flex; flex-direction: column; }
        .cch-bubble { max-width: 85%; margin-bottom: 0.75rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; font-size: 0.95rem; word-break: break-word; }
        .cch-bubble--mine { margin-left: auto; background: #0d6efd; color: #fff; }
        .cch-bubble--mine .cch-meta { color: rgba(255,255,255,0.85); }
        .cch-bubble--theirs { margin-right: auto; background: #fff; border: 1px solid #dee2e6; }
        .cch-meta { font-size: 0.72rem; opacity: 0.85; margin-top: 0.25rem; }
        .cch-learner-list { max-height: min(55vh, 520px); overflow-y: auto; }
        #cch-input { resize: vertical; min-height: 2.75rem; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
  <nav class="app-header navbar navbar-expand bg-body"><div class="container-fluid"><?php include 'topbar.php'; ?></div></nav>
  <?php require 'sidebar.php'; ?>
  <main class="app-main">
    <div class="app-content-header">
      <div class="container-fluid">
        <h3 class="mb-0"><i class="bi bi-chat-dots me-2"></i>Career coach chat</h3>
        <p class="text-muted small mb-0">Live messaging with learners assigned to you. Updates every few seconds.</p>
      </div>
    </div>
    <div class="app-content">
      <div class="container-fluid">
        <?php if ($learners === array()) { ?>
          <div class="alert alert-info">No learners are assigned to you yet. Assign learners from <a href="career_progress.php">Career Progress Monitor</a>.</div>
        <?php } else { ?>
        <div class="row g-3">
          <div class="col-md-4 col-lg-3">
            <div class="card h-100">
              <div class="card-header py-2"><strong>Your learners</strong></div>
              <div class="list-group list-group-flush cch-learner-list">
                <?php foreach ($learners as $l) {
                    $lid = (int) ($l['iUserId'] ?? 0);
                    $active = $lid === $selectedLearnerId;
                    $unread = (int) ($unreadByLearner[$lid] ?? 0);
                    ?>
                <a href="career_chat.php?learner_id=<?php echo $lid; ?>"
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<?php echo $active ? ' active' : ''; ?>"
                   data-chat-learner-id="<?php echo $lid; ?>">
                  <span><?php echo htmlspecialchars((string) ($l['vUserName'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
                  <?php if ($unread > 0) { ?>
                    <span class="badge rounded-pill text-bg-danger cch-unread-badge"><?php echo $unread > 99 ? '99+' : $unread; ?></span>
                  <?php } ?>
                </a>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-md-8 col-lg-9">
            <?php if ($selectedLearner) { ?>
            <div class="card h-100" id="career-chat-app"
                 data-api="career-chat-api.php"
                 data-role="tutor"
                 data-learner-id="<?php echo (int) $selectedLearnerId; ?>"
                 data-csrf="<?php echo htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8'); ?>"
                 data-last-id="<?php echo (int) $lastId; ?>"
                 data-poll-ms="5000">
              <div class="card-header">
                <strong><?php echo htmlspecialchars((string) ($selectedLearner['vUserName'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></strong>
                <span class="text-muted small ms-2"><?php echo htmlspecialchars((string) ($selectedLearner['vUserEmailId'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
              </div>
              <div class="card-body d-flex flex-column">
                <div class="cch-thread flex-grow-1" id="cch-thread" aria-live="polite" aria-relevant="additions">
                  <?php if ($messages === array()) { ?>
                    <p class="text-muted cch-empty text-center py-3 mb-0">No messages in this thread yet.</p>
                  <?php } else {
                      foreach ($messages as $m) {
                          $mine = ($m['sender_role'] ?? '') === 'tutor';
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
                  <textarea id="cch-input" name="message_body" class="form-control" rows="3" maxlength="8000" placeholder="Reply to learner…" required></textarea>
                  <div class="d-flex align-items-center gap-2 mt-2">
                    <button type="submit" id="cch-send" class="btn btn-primary"><i class="bi bi-send me-1"></i> Send</button>
                    <span class="cch-status small text-muted" id="cch-status"></span>
                  </div>
                </form>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </main>
  <footer class="app-footer"><?php require 'footer.php'; ?></footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="dist/js/adminlte.js"></script>
<?php if ($selectedLearner) { ?>
<script src="../../assets/js/career-chat.js"></script>
<?php } ?>
</body>
</html>
