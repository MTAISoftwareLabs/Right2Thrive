<?php

declare(strict_types=1);

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
require_once dirname(__DIR__, 2) . '/onboarding_lib.php';

$userId = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
$data = $userId > 0 ? onboarding_load_registration_questionnaire($userId) : null;

if (isset($_GET['download']) && $userId > 0 && $data) {
    $jsonPath = onboarding_user_questionnaire_dir($userId) . DIRECTORY_SEPARATOR . 'registration_questionnaire.json';
    if (is_file($jsonPath)) {
        header('Content-Type: application/json; charset=UTF-8');
        header('Content-Disposition: attachment; filename="registration_questionnaire_user_' . $userId . '.json"');
        readfile($jsonPath);
        exit;
    }
}

$st = $userId > 0
    ? mysqli_prepare($conn, 'SELECT vUserName, vUserEmailId, dUserRegDate FROM cpo_usermaster WHERE iUserId = ? AND iUserType = 2 LIMIT 1')
    : null;
$user = null;
if ($st) {
    mysqli_stmt_bind_param($st, 'i', $userId);
    mysqli_stmt_execute($st);
    $rs = mysqli_stmt_get_result($st);
    $user = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
    mysqli_stmt_close($st);
}

$labels = onboarding_questionnaire_labels($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registration questionnaire · Admin</title>
    <link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
    <link href="css/admin-layout.css" rel="stylesheet" type="text/css" />
    <style>
        .quest-admin .btn { display: inline-block; padding: 0.35rem 0.75rem; margin: 0 0.35rem 0.35rem 0; background: #0d6efd; color: #fff; text-decoration: none; border: none; cursor: pointer; font-size: 0.9rem; }
        .quest-admin .btn-secondary { background: #6c757d; }
        .quest-admin table.data { width: 100%; border-collapse: collapse; font-size: 0.9rem; margin-bottom: 1rem; }
        .quest-admin table.data th, .quest-admin table.data td { border: 1px solid #ccc; padding: 6px 8px; vertical-align: top; }
        .quest-admin table.data th { background: #f1f5f9; width: 30%; }
    </style>
</head>
<body>
<?php include_once __DIR__ . '/top.php'; ?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="208" valign="top"><?php include_once __DIR__ . '/add.php'; ?></td>
        <td width="791" valign="top" class="quest-admin bodytext" style="padding:12px;">
            <p class="schoolfont">Registration questionnaire</p>
            <p>
                <a class="btn btn-secondary" href="pending_registrations.php">← Pending registrations</a>
                <a class="btn btn-secondary" href="main.php">Admin home</a>
            </p>

            <?php if (!$user): ?>
                <p>Learner not found.</p>
            <?php else: ?>
                <p>
                    <strong><?php echo htmlspecialchars((string) $user['vUserName'], ENT_QUOTES, 'UTF-8'); ?></strong>
                    &middot;
                    <?php echo htmlspecialchars((string) $user['vUserEmailId'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php if (!empty($user['dUserRegDate'])): ?>
                        &middot; Registered <?php echo htmlspecialchars((string) $user['dUserRegDate'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php endif; ?>
                </p>

                <?php if (!$data): ?>
                    <p>No questionnaire file found for this user.</p>
                <?php else: ?>
                    <?php
                    $personal = isset($data['personal']) && is_array($data['personal']) ? $data['personal'] : array();
                    $questionnaire = isset($data['questionnaire']) && is_array($data['questionnaire']) ? $data['questionnaire'] : array();
                    ?>
                    <?php if ($personal !== array()): ?>
                        <h3 class="schoolfont">Personal details (at registration)</h3>
                        <table class="data">
                            <?php foreach ($personal as $key => $value): ?>
                                <tr>
                                    <th><?php echo htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8'); ?></th>
                                    <td><?php echo nl2br(htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8')); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>

                    <h3 class="schoolfont">Questionnaire responses</h3>
                    <table class="data">
                        <?php foreach ($labels as $field => $label):
                            if (!array_key_exists($field, $questionnaire)) {
                                continue;
                            }
                            $val = $questionnaire[$field];
                            if ($field === 'terms_accepted') {
                                $display = $val ? 'Yes' : 'No';
                            } elseif ($field === 'in_work' || $field === 'has_disability') {
                                $display = ((string) $val === '1') ? 'Yes' : 'No';
                            } else {
                                $display = (string) $val;
                            }
                            ?>
                            <tr>
                                <th><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></th>
                                <td><?php echo nl2br(htmlspecialchars($display, ENT_QUOTES, 'UTF-8')); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <p>
                        <a class="btn btn-secondary" href="view_registration_questionnaire.php?user_id=<?php echo $userId; ?>&amp;download=1">Download JSON</a>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>
</table>
</body>
</html>
