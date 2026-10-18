<?php

declare(strict_types=1);

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
require_once dirname(__DIR__, 2) . '/onboarding_lib.php';

$flash = '';
$flashType = 'success';
$setupMessages = array();

if (!onboarding_schema_ready($conn)) {
    $setup = onboarding_ensure_schema($conn);
    if ($setup['ok']) {
        $setupMessages = $setup['messages'];
    } else {
        $flash = implode(' ', $setup['messages']);
        $flashType = 'danger';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
    if (isset($_POST['approve']) && $userId > 0) {
        $approve = onboarding_approve_learner($conn, $userId);
        $flash = $approve['message'];
        $flashType = $approve['ok'] ? 'success' : 'danger';
    } elseif (isset($_POST['resend_verification']) && $userId > 0) {
        $mail = onboarding_send_verification_email($conn, $userId);
        if ($mail['sent']) {
            $flash = 'Verification email sent.';
        } else {
            $flash = $mail['error'] !== '' ? $mail['error'] : 'Verification email could not be sent.';
            $flashType = 'warning';
        }
    } elseif (isset($_POST['mark_email_verified']) && $userId > 0) {
        $mark = onboarding_admin_mark_email_verified($conn, $userId);
        $flash = $mark['message'];
        $flashType = $mark['ok'] ? 'success' : 'danger';
    } elseif (isset($_POST['import_legacy_questionnaire']) && $userId > 0) {
        $imp = onboarding_import_legacy_questionnaire($conn, $userId);
        $flash = $imp['message'];
        $flashType = $imp['ok'] ? 'success' : 'danger';
    }
}

$pending = onboarding_list_pending_learners($conn);
$incomplete = onboarding_list_incomplete_learners($conn);
$schemaReady = onboarding_schema_ready($conn);
$pendingCount = count($pending);
$incompleteCount = count($incomplete);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pending learner registrations · Admin</title>
    <link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
    <link href="css/admin-layout.css" rel="stylesheet" type="text/css" />
    <style>
        .pending-admin .btn { display: inline-block; padding: 0.35rem 0.75rem; margin: 0 0.35rem 0.35rem 0; background: #0d6efd; color: #fff; text-decoration: none; border: none; cursor: pointer; font-size: 0.9rem; }
        .pending-admin .btn-secondary { background: #6c757d; }
        .pending-admin .btn-success { background: #198754; }
        .pending-admin .btn-warning { background: #ffc107; color: #000; }
        .pending-admin .btn-info { background: #0dcaf0; color: #000; }
        .pending-admin .hint { font-size: 0.85rem; color: #475569; margin: 0.5rem 0 1rem; max-width: 52rem; }
        .pending-admin .flash { padding: 0.5rem 0.75rem; margin-bottom: 1rem; }
        .pending-admin .flash-success { background: #ecfdf5; border: 1px solid #86efac; }
        .pending-admin .flash-danger { background: #fef2f2; border: 1px solid #fca5a5; }
        .pending-admin .flash-warning { background: #fffbeb; border: 1px solid #fcd34d; }
        .pending-admin table.data { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        .pending-admin table.data th, .pending-admin table.data td { border: 1px solid #ccc; padding: 6px 8px; vertical-align: top; }
        .pending-admin table.data th { background: #f1f5f9; }
        .pending-admin .inline-form { display: inline; }
    </style>
</head>
<body>
<?php include_once __DIR__ . '/top.php'; ?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="208" valign="top"><?php include_once __DIR__ . '/add.php'; ?></td>
        <td width="791" valign="top" class="pending-admin bodytext" style="padding:12px;">
            <p class="schoolfont">Pending learner registrations</p>
            <p>
                <a class="btn btn-secondary" href="main.php">← Admin home</a>
                <a class="btn btn-secondary" href="registration_questionnaire_admin.php">Edit registration questionnaire</a>
                <a class="btn btn-secondary" href="career_progress_admin.php">Career Progress Monitor</a>
            </p>
            <p>Review sign-up questionnaires, confirm email verification, then approve accounts so learners can sign in.</p>
            <p class="hint"><strong>After approval:</strong> use <strong>Assign tutor &amp; career plan</strong> to open the Career Progress Monitor with that learner selected, assign their tutor, then build milestones / Stage 3 PCAP — tutors will see the same progress charts on their coaching workspace.</p>
            <p><strong>Existing accounts</strong> (registered before onboarding) appear under incomplete onboarding — not only “pending approval”.</p>

            <?php if ($setupMessages !== array()): ?>
                <p class="flash flash-success">Database setup completed: <?php echo htmlspecialchars(implode(' ', $setupMessages), ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <?php if (!$schemaReady): ?>
                <p style="color:#b45309;">
                    <strong>Setup required:</strong>
                    open <a href="../../migrate_onboarding.php" target="_blank" rel="noopener">migrate_onboarding.php</a>
                    at the site root, or ask your host to run it once.
                </p>
            <?php endif; ?>

            <?php if ($flash !== ''): ?>
                <p class="flash flash-<?php echo htmlspecialchars($flashType, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($flash, ENT_QUOTES, 'UTF-8'); ?>
                </p>
            <?php endif; ?>

            <h3 style="margin-top:1.25rem;">New registrations awaiting approval</h3>
            <?php if ($pendingCount === 0): ?>
                <p><strong>No new learners are waiting for approval.</strong></p>
            <?php else: ?>
                <p><strong><?php echo (int) $pendingCount; ?></strong> learner(s) awaiting approval.</p>
                <table class="data">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <?php if ($schemaReady): ?>
                                <th>Email verified</th>
                                <th>Questionnaire</th>
                            <?php endif; ?>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pending as $row):
                        $uid = (int) $row['iUserId'];
                        $qStatus = $schemaReady ? onboarding_questionnaire_status($conn, $uid, $row) : array('done' => false, 'label' => '—', 'has_file' => false, 'has_legacy' => false);
                        $hasFile = $qStatus['has_file'];
                        $emailOk = $schemaReady && (int) ($row['email_verified'] ?? 0) === 1;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $row['vUserName'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $row['vUserEmailId'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) ($row['dUserRegDate'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php if ($schemaReady): ?>
                                <td><?php echo $emailOk ? 'Yes' : 'No'; ?></td>
                                <td><?php echo htmlspecialchars($qStatus['label'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php endif; ?>
                            <td>
                                <?php if ($hasFile): ?>
                                    <a class="btn btn-secondary" href="view_registration_questionnaire.php?user_id=<?php echo $uid; ?>">View questionnaire</a>
                                <?php endif; ?>
                                <a class="btn btn-secondary" href="career_progress_admin.php?user_id=<?php echo $uid; ?>">Assign tutor &amp; career plan</a>
                                <?php if ($schemaReady && !$qStatus['done'] && $qStatus['has_legacy']): ?>
                                    <form method="post" class="inline-form" onsubmit="return confirm('Import old profile fields into the new questionnaire record?');">
                                        <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
                                        <button type="submit" class="btn btn-info" name="import_legacy_questionnaire" value="1">Import legacy questionnaire</button>
                                    </form>
                                <?php endif; ?>
                                <form method="post" class="inline-form">
                                    <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
                                    <button type="submit" class="btn btn-success" name="approve" value="1" onclick="return confirm('Approve this learner?');">Approve</button>
                                </form>
                                <?php if ($schemaReady && !$emailOk): ?>
                                    <form method="post" class="inline-form">
                                        <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
                                        <button type="submit" class="btn btn-warning" name="resend_verification" value="1">Resend verification</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <h3 style="margin-top:2rem;">Incomplete onboarding (existing accounts)</h3>
            <p>Learners who still need the questionnaire and/or email verification. Includes older accounts already marked active (<code>iUserStatus=1</code>).</p>
            <p class="hint">
                <strong>Questionnaire “Missing”</strong> means no new JSON file and no <code>registration_questionnaire_at</code> timestamp.
                Older users may still have answers in the database — use <strong>Import legacy questionnaire</strong>.
                Learners can also complete it themselves at
                <a href="<?php echo htmlspecialchars(onboarding_complete_registration_url(), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">complete registration</a>.
            </p>
            <?php if ($incompleteCount === 0): ?>
                <p><strong>No incomplete onboarding records.</strong></p>
            <?php else: ?>
                <p><strong><?php echo (int) $incompleteCount; ?></strong> account(s) need attention.</p>
                <table class="data">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Email verified</th>
                            <th>Questionnaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($incomplete as $row):
                        $uid = (int) $row['iUserId'];
                        $qStatus = onboarding_questionnaire_status($conn, $uid, $row);
                        $hasFile = $qStatus['has_file'];
                        $emailOk = (int) ($row['email_verified'] ?? 0) === 1;
                        $qDone = $qStatus['done'];
                        $statusLabel = (int) ($row['iUserStatus'] ?? 0) === 1 ? 'Active (legacy)' : 'Pending approval';
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $row['vUserName'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $row['vUserEmailId'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($statusLabel, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $emailOk ? 'Yes' : 'No'; ?></td>
                            <td><?php echo htmlspecialchars($qStatus['label'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php if ($hasFile): ?>
                                    <a class="btn btn-secondary" href="view_registration_questionnaire.php?user_id=<?php echo $uid; ?>">View questionnaire</a>
                                <?php endif; ?>
                                <a class="btn btn-secondary" href="career_progress_admin.php?user_id=<?php echo $uid; ?>">Assign tutor &amp; career plan</a>
                                <?php if (!$qDone && $qStatus['has_legacy']): ?>
                                    <form method="post" class="inline-form" onsubmit="return confirm('Import old profile fields into the new questionnaire record?');">
                                        <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
                                        <button type="submit" class="btn btn-info" name="import_legacy_questionnaire" value="1">Import legacy questionnaire</button>
                                    </form>
                                <?php endif; ?>
                                <?php if (!$emailOk): ?>
                                    <form method="post" class="inline-form">
                                        <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
                                        <button type="submit" class="btn btn-warning" name="resend_verification" value="1">Resend verification</button>
                                    </form>
                                    <form method="post" class="inline-form" onsubmit="return confirm('Mark email as verified manually?');">
                                        <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
                                        <button type="submit" class="btn btn-secondary" name="mark_email_verified" value="1">Mark email verified</button>
                                    </form>
                                <?php endif; ?>
                                <?php if ((int) ($row['iUserStatus'] ?? 0) === 0): ?>
                                    <form method="post" class="inline-form">
                                        <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
                                        <button type="submit" class="btn btn-success" name="approve" value="1">Approve</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <p style="margin-top:1.5rem;color:#666;font-size:0.85rem;">
                Questionnaire files: <code>storage/registration_questionnaires/user_{id}/</code>
            </p>
        </td>
    </tr>
</table>
</body>
</html>
