<?php
include 'dbConnection.php';
require_once dirname(__DIR__, 2) . '/career_progress_lib.php';
require_once dirname(__DIR__, 2) . '/career_stage3_lib.php';
$sitename = isset($sitename) ? $sitename : (defined('sitename') ? sitename : 'Careers Hub');

$staffId = (int) $_SESSION['user_id'];
$mode = (isset($_GET['mode']) && $_GET['mode'] === 'admin') ? 'admin' : 'mentor';
$selectedUser = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
$stage2Error = '';
$pcapFlash = isset($_GET['pcap_flash']) ? (string) $_GET['pcap_flash'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pcap_action'])) {
        $pcapMsg = career_handle_stage3_coach_post($conn, $staffId, $mode);
        $redirectUid = (int) ($_POST['user_id'] ?? $selectedUser);
        if ($pcapMsg !== '' && $stage2Error === '') {
            header('Location: career_progress.php?mode=' . urlencode($mode) . '&user_id=' . $redirectUid . '&pcap_flash=' . rawurlencode($pcapMsg));
            exit;
        }
        if ($pcapMsg !== '') {
            $pcapFlash = $pcapMsg;
        }
    }
    if (isset($_POST['save_pathway_stage2']) && career_coaching_stage2_columns_ready($conn) && career_coaching_stage2_assessment_columns_ready($conn)) {
        $uid = (int) $_POST['user_id'];
        $pathway = isset($_POST['career_pathway']) ? trim((string) $_POST['career_pathway']) : '';
        $allowed = array_keys(career_pathway_slugs());
        if ($uid > 0 && in_array($pathway, $allowed, true)) {
            $ok = true;
            if ($mode === 'mentor') {
                $mchk = mysqli_query($conn, "SELECT career_mentor_id FROM cpo_usermaster WHERE iUserId=" . $uid . " LIMIT 1");
                $mrow = ($mchk && mysqli_num_rows($mchk)) ? mysqli_fetch_assoc($mchk) : null;
                if (!$mrow || (int) $mrow['career_mentor_id'] !== $staffId) {
                    $ok = false;
                }
            }
            if ($ok) {
                $qual = trim((string) ($_POST['stage2_qualifications_experience'] ?? ''));
                $gaps = trim((string) ($_POST['stage2_skills_gaps'] ?? ''));
                $conf = (int) ($_POST['stage2_confidence_level'] ?? 0);
                $readiness = trim((string) ($_POST['stage2_employment_readiness'] ?? ''));
                $clarity = trim((string) ($_POST['stage2_goal_clarity'] ?? ''));
                $barriers = trim((string) ($_POST['stage2_barriers'] ?? ''));
                $allowedReadiness = array('not_ready', 'developing', 'ready_soon', 'job_ready');
                $allowedClarity = array('unclear', 'emerging', 'clear');
                $validStage2 = ($qual !== '' && $gaps !== '' && $barriers !== ''
                    && $conf >= 1 && $conf <= 5
                    && in_array($readiness, $allowedReadiness, true)
                    && in_array($clarity, $allowedClarity, true));
                if (!$validStage2) {
                    $stage2Error = 'Please complete all Stage 2 assessment fields before marking Stage 2 complete.';
                } else {
                    $pathEsc = mysqli_real_escape_string($conn, $pathway);
                    $qualEsc = mysqli_real_escape_string($conn, $qual);
                    $gapsEsc = mysqli_real_escape_string($conn, $gaps);
                    $readEsc = mysqli_real_escape_string($conn, $readiness);
                    $clarEsc = mysqli_real_escape_string($conn, $clarity);
                    $barEsc = mysqli_real_escape_string($conn, $barriers);
                    mysqli_query($conn, "UPDATE cpo_usermaster SET
                        career_pathway='" . $pathEsc . "',
                        career_initial_coaching_completed=1,
                        career_pathway_assigned_at=NOW(),
                        career_stage2_qualifications_experience='" . $qualEsc . "',
                        career_stage2_skills_gaps='" . $gapsEsc . "',
                        career_stage2_confidence_level=" . $conf . ",
                        career_stage2_employment_readiness='" . $readEsc . "',
                        career_stage2_goal_clarity='" . $clarEsc . "',
                        career_stage2_barriers='" . $barEsc . "'
                        WHERE iUserId=" . $uid);
                }
                if ($validStage2) {
                    $summaryRaw = trim((string) ($_POST['session_summary'] ?? ''));
                    $privateRaw = trim((string) ($_POST['private_notes'] ?? ''));
                    $label = career_pathway_label($pathway);
                    $combined = 'Pathway allocated: ' . $label . '.';
                    if ($summaryRaw !== '') {
                        $combined .= "\n\n" . $summaryRaw;
                    }
                    if ($summaryRaw !== '' || $privateRaw !== '') {
                        $sumEsc = mysqli_real_escape_string($conn, $combined);
                        $privEsc = mysqli_real_escape_string($conn, $privateRaw);
                        mysqli_query($conn, "INSERT INTO career_discovery_sessions (user_id,mentor_id,summary,private_notes,created_at)
                            VALUES (" . $uid . "," . $staffId . ",'" . $sumEsc . "','" . $privEsc . "',NOW())");
                    }
                }
            }
        }
    }
    if (isset($_POST['save_discovery'])) {
        $uid = (int) $_POST['user_id'];
        $summary = mysqli_real_escape_string($conn, trim($_POST['summary']));
        $private = mysqli_real_escape_string($conn, trim($_POST['private_notes']));
        mysqli_query($conn, "INSERT INTO career_discovery_sessions (user_id,mentor_id,summary,private_notes,created_at)
            VALUES (" . $uid . "," . $staffId . ",'" . $summary . "','" . $private . "',NOW())");
    }
    if (isset($_POST['create_milestone'])) {
        $uid = (int) $_POST['user_id'];
        $title = mysqli_real_escape_string($conn, trim($_POST['title']));
        $desc = mysqli_real_escape_string($conn, trim($_POST['description']));
        $target = mysqli_real_escape_string($conn, trim($_POST['target_date']));
        $tok = (int) $_POST['token_value'];
        $ev = mysqli_real_escape_string($conn, trim($_POST['required_evidence']));
        mysqli_query($conn, "INSERT INTO career_plans (user_id,mentor_id,title,created_at)
            SELECT " . $uid . "," . $staffId . ",'Career Plan',NOW()
            WHERE NOT EXISTS (SELECT 1 FROM career_plans WHERE user_id=" . $uid . ")");
        $planRes = mysqli_query($conn, "SELECT id FROM career_plans WHERE user_id=" . $uid . " ORDER BY id DESC LIMIT 1");
        $plan = ($planRes && mysqli_num_rows($planRes)) ? mysqli_fetch_assoc($planRes) : array('id' => 0);
        mysqli_query($conn, "INSERT INTO career_plan_milestones (plan_id,user_id,title,description,target_date,token_value,required_evidence,status)
            VALUES (" . (int)$plan['id'] . "," . $uid . ",'" . $title . "','" . $desc . "','" . $target . "'," . $tok . ",'" . $ev . "','not_started')");
    }
    if (isset($_POST['create_task'])) {
        $uid = (int) $_POST['user_id'];
        $mid = (int) $_POST['milestone_id'];
        $task = mysqli_real_escape_string($conn, trim($_POST['task_title']));
        $start = mysqli_real_escape_string($conn, trim($_POST['week_start']));
        $end = mysqli_real_escape_string($conn, trim($_POST['week_end']));
        $tok = (int) $_POST['task_tokens'];
        mysqli_query($conn, "INSERT INTO career_weekly_tasks (milestone_id,user_id,task_title,week_start,week_end,token_value,status)
            VALUES (" . $mid . "," . $uid . ",'" . $task . "','" . $start . "','" . $end . "'," . $tok . ",'not_started')");
    }
    if (isset($_POST['log_for_user'])) {
        $uid = (int) $_POST['user_id'];
        $desc = mysqli_real_escape_string($conn, trim($_POST['activity_description']));
        $skills = mysqli_real_escape_string($conn, trim($_POST['skills']));
        $conf = (int) $_POST['confidence_level'];
        $notes = mysqli_real_escape_string($conn, trim($_POST['staff_notes']));
        $tokens = (int) $_POST['token_award'];
        mysqli_query($conn, "INSERT INTO career_weekly_logs (user_id,mentor_id,activity_description,skills_json,confidence_level,staff_notes,token_award,created_at)
            VALUES (" . $uid . "," . $staffId . ",'" . $desc . "','" . $skills . "'," . $conf . ",'" . $notes . "'," . $tokens . ",NOW())");
        mysqli_query($conn, "INSERT INTO career_token_ledger (user_id,source_type,source_id,tokens,notes,created_at)
            VALUES (" . $uid . ",'staff_log',NULL," . $tokens . ",'Logged by staff',NOW())");
    }
    if (isset($_POST['manual_assign']) && $mode === 'admin') {
        $uid = (int) $_POST['user_id'];
        $mentorId = (int) $_POST['mentor_id'];
        mysqli_query($conn, "UPDATE cpo_usermaster SET career_mentor_id=" . $mentorId . ", career_assessment_completed=1 WHERE iUserId=" . $uid);
        mysqli_query($conn, "INSERT INTO career_mentor_assignments (user_id,mentor_id,assigned_at,assignment_method) VALUES (" . $uid . "," . $mentorId . ",NOW(),'manual')");
    }
    if (isset($_POST['save_template']) && $mode === 'admin') {
        $title = mysqli_real_escape_string($conn, trim($_POST['template_title']));
        $desc = mysqli_real_escape_string($conn, trim($_POST['template_description']));
        $tok = (int) $_POST['template_tokens'];
        if ($title !== '') {
            mysqli_query($conn, "INSERT INTO career_milestone_templates (title,description,default_tokens,is_active)
                VALUES ('" . $title . "','" . $desc . "'," . $tok . ",1)");
        }
    }
    if (isset($_POST['legacy_delete']) && $mode === 'admin') {
        $lid = (int) $_POST['legacy_id'];
        mysqli_query($conn, "UPDATE career_legacy_uploads SET delete_confirmed=1 WHERE id=" . $lid);
    }
    if ($stage2Error === '') {
        header('Location: career_progress.php?mode=' . $mode . '&user_id=' . $selectedUser);
        exit;
    }
}

$pathwayCols = career_coaching_stage2_columns_ready($conn)
    ? ',u.career_pathway,COALESCE(u.career_initial_coaching_completed,0) AS career_initial_coaching_completed'
    : '';
$users = mysqli_query($conn, "SELECT u.iUserId,u.vUserName,u.vUserEmailId,u.career_mentor_id,u.career_assessment_completed" . $pathwayCols . ",
    (SELECT COALESCE(SUM(tokens),0) FROM career_token_ledger tl WHERE tl.user_id=u.iUserId) AS tokens
    FROM cpo_usermaster u
    WHERE u.iUserType=2 AND u.iUserStatus=1 " . ($mode === 'mentor' ? "AND u.career_mentor_id=" . $staffId : "") . "
    ORDER BY u.iUserId DESC");

$selectedData = null;
$selectedAssessment = null;
if ($selectedUser > 0) {
    $uRes = mysqli_query($conn, "SELECT * FROM cpo_usermaster WHERE iUserId=" . $selectedUser . " LIMIT 1");
    $selectedData = ($uRes && mysqli_num_rows($uRes)) ? mysqli_fetch_assoc($uRes) : null;
    $aRes = mysqli_query($conn, "SELECT * FROM career_assessments WHERE user_id=" . $selectedUser . " LIMIT 1");
    $selectedAssessment = ($aRes && mysqli_num_rows($aRes)) ? mysqli_fetch_assoc($aRes) : null;
}
$templates = mysqli_query($conn, "SELECT * FROM career_milestone_templates WHERE is_active=1 ORDER BY id ASC");
$milestones = $selectedUser > 0 ? mysqli_query($conn, "SELECT * FROM career_plan_milestones WHERE user_id=" . $selectedUser . " ORDER BY id DESC") : null;
$mentors = mysqli_query($conn, "SELECT iUserId,vUserName FROM cpo_usermaster WHERE iUserType=1 AND iUserStatus=1 ORDER BY vUserName ASC");
$unassignedRes = mysqli_query($conn, "SELECT COUNT(*) c FROM cpo_usermaster WHERE iUserType=2 AND iUserStatus=1 AND (career_mentor_id IS NULL OR career_assessment_completed=0)");
$unassigned = ($unassignedRes && mysqli_num_rows($unassignedRes)) ? (int) mysqli_fetch_assoc($unassignedRes)['c'] : 0;
$legacy = $mode === 'admin' ? mysqli_query($conn, "SELECT * FROM career_legacy_uploads ORDER BY id DESC LIMIT 200") : null;
$selectedTokens = ($selectedData) ? career_get_plan_tokens($conn, (int) $selectedData['iUserId']) : null;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $sitename; ?> | Career Progress</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <style>
        .cpm {
            --cpm-indigo: #4f46e5;
            --cpm-indigo-soft: #eef2ff;
            --cpm-teal: #0d9488;
            --cpm-ink: #0f172a;
            --cpm-muted: #64748b;
            --cpm-line: #e2e8f0;
            --cpm-card-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
            font-family: "Plus Jakarta Sans", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
        .cpm .app-content-header {
            background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);
            border-bottom: 1px solid var(--cpm-line);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .cpm .app-content-header h3 {
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--cpm-ink);
            font-size: 1.35rem;
            margin: 0;
        }
        .cpm .app-content-header .cpm-header-sub {
            font-size: 0.875rem;
            color: var(--cpm-muted);
            margin-top: 0.25rem;
        }
        .cpm .app-content { padding-top: 1.25rem; }
        .cpm-admin-banner {
            border-radius: 1rem;
            border: 1px solid #fde68a;
            background: linear-gradient(100deg, #fffbeb 0%, #fff7ed 100%);
            padding: 0.85rem 1.1rem;
            margin-bottom: 1.25rem;
        }
        .cpm-card {
            border: 1px solid var(--cpm-line) !important;
            border-radius: 1rem !important;
            box-shadow: var(--cpm-card-shadow) !important;
            overflow: hidden;
            margin-bottom: 1.25rem !important;
        }
        .cpm-card > .card-header {
            background: linear-gradient(180deg, #fafbff 0%, #fff 100%);
            border-bottom: 1px solid var(--cpm-line);
            padding: 0.9rem 1.15rem;
        }
        .cpm-card > .card-header h5, .cpm-card > .card-header h6 {
            margin: 0;
            font-weight: 800;
            letter-spacing: -0.02em;
            font-size: 1rem;
            color: var(--cpm-ink);
        }
        .cpm-card .card-body { padding: 1.15rem 1.2rem; }
        .cpm-learner-hero {
            border-radius: 1.15rem;
            padding: 1.25rem 1.35rem;
            background: linear-gradient(135deg, #f8fafc 0%, var(--cpm-indigo-soft) 45%, #ecfdf5 100%);
            border: 1px solid var(--cpm-line);
            box-shadow: var(--cpm-card-shadow);
            margin-bottom: 1.25rem;
        }
        .cpm-eyebrow {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--cpm-indigo);
            margin-bottom: 0.35rem;
        }
        .cpm-learner-name {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--cpm-ink);
            margin: 0;
            line-height: 1.2;
        }
        .cpm-learner-meta { font-size: 0.875rem; color: var(--cpm-muted); margin-top: 0.35rem; }
        .cpm-stat-grid { display: flex; flex-wrap: wrap; gap: 0.65rem; }
        .cpm-stat {
            background: #fff;
            border: 1px solid var(--cpm-line);
            border-radius: 0.85rem;
            padding: 0.55rem 0.9rem;
            min-width: 5.5rem;
            text-align: center;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.06);
        }
        .cpm-stat-val { display: block; font-weight: 800; font-size: 1.15rem; color: var(--cpm-ink); line-height: 1.2; }
        .cpm-stat-lbl { font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--cpm-muted); }
        .cpm-hint {
            font-size: 0.8rem;
            color: var(--cpm-muted);
            line-height: 1.5;
            padding: 0.75rem 1rem;
            background: #f8fafc;
            border-radius: 0.75rem;
            border: 1px solid #f1f5f9;
            margin-bottom: 1rem;
        }
        .cpm-assessment {
            background: #fff;
            border: 1px solid var(--cpm-line);
            border-radius: 0.85rem;
            padding: 1rem 1.1rem;
            margin-bottom: 1rem;
        }
        .cpm-assessment dt { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--cpm-muted); margin-top: 0.75rem; }
        .cpm-assessment dt:first-child { margin-top: 0; }
        .cpm-assessment dd { margin: 0.15rem 0 0; font-size: 0.9rem; color: var(--cpm-ink); }
        .cpm .form-label { font-weight: 600; font-size: 0.8rem; color: #334155; margin-bottom: 0.35rem; }
        .cpm .form-control, .cpm .form-select {
            border-radius: 0.65rem;
            border-color: #cbd5e1;
            padding: 0.55rem 0.85rem;
        }
        .cpm .form-control:focus, .cpm .form-select:focus {
            border-color: #a5b4fc;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.15);
        }
        .cpm-btn-primary {
            background: linear-gradient(135deg, var(--cpm-indigo) 0%, #4338ca 100%);
            border: none;
            font-weight: 700;
            border-radius: 0.65rem;
            padding: 0.5rem 1.15rem;
        }
        .cpm-btn-primary:hover { background: linear-gradient(135deg, #4338ca 0%, #3730a3 100%); }
        .cpm-btn-soft {
            border-radius: 0.65rem;
            font-weight: 600;
            border: 1px solid var(--cpm-line);
            background: #fff;
        }
        .cpm-btn-success {
            border-radius: 0.65rem;
            font-weight: 700;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
        }
        .cpm-learner-panel .card-body { max-height: min(70vh, 760px); overflow-y: auto; padding: 0.65rem !important; }
        .cpm-learner-panel .list-group-item {
            border-radius: 0.75rem !important;
            margin-bottom: 0.5rem;
            border: 1px solid #eef2f7 !important;
            padding: 0.85rem 1rem !important;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .cpm-learner-panel .list-group-item:hover {
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.12);
            transform: translateY(-1px);
        }
        .cpm-learner-panel .list-group-item.is-active {
            border-color: var(--cpm-indigo) !important;
            background: var(--cpm-indigo-soft);
            box-shadow: 0 4px 16px rgba(79, 70, 229, 0.15);
        }
        .cpm-learner-panel .list-group-item a { font-weight: 700; color: var(--cpm-ink); text-decoration: none; }
        .cpm-learner-panel .list-group-item a:hover { color: var(--cpm-indigo); }
        .cpm-info-callout {
            border-radius: 1rem;
            border: 1px solid #c7d2fe;
            background: linear-gradient(120deg, #f5f3ff 0%, #eff6ff 100%);
            padding: 0.9rem 1.1rem;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 1.25rem;
        }
        .cpm-info-callout strong { color: var(--cpm-ink); }
        .cpm-learner-panel.sticky-lg-top { z-index: 1010; }
        .cpm-form-row { margin-bottom: 1.25rem; }
        .cpm-form-row > [class*="col-"] { display: flex; }
        .cpm-form-row .cpm-card { flex: 1 1 auto; margin-bottom: 0 !important; width: 100%; }
        @media (max-width: 991px) {
            .cpm-stat-grid { margin-top: 0.75rem; }
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary cpm">
<div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-body"><div class="container-fluid"><?php include "topbar.php";?></div></nav>
    <?php require "sidebar.php";?>
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <h3><i class="bi bi-people-fill me-2" style="color:var(--cpm-indigo)"></i>Career coaching workspace</h3>
                <div class="cpm-header-sub"><?php echo $mode === 'mentor' ? 'Review learners assigned to you, capture Stage 2, and manage their plan.' : 'Organise learners, mentors, templates, and legacy data.'; ?></div>
            </div>
        </div>
        <div class="app-content"><div class="container-fluid">
            <?php if ($mode === 'admin') { ?>
            <div class="cpm-admin-banner d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
                <span><strong>Queue:</strong> <?php echo (int) $unassigned; ?> learner(s) still unassigned or without completed onboarding.</span>
            </div>
            <?php } ?>
            <div class="row g-3">
                <div class="col-lg-8 order-lg-1">
                    <?php if ($selectedData) { ?>
                    <div class="cpm-learner-hero">
                        <div class="d-flex flex-column flex-lg-row flex-lg-wrap justify-content-lg-between align-items-lg-start gap-3">
                            <div>
                                <div class="cpm-eyebrow">Selected learner</div>
                                <h2 class="cpm-learner-name"><?php echo htmlspecialchars($selectedData['vUserName']); ?></h2>
                                <div class="cpm-learner-meta">
                                    <i class="bi bi-envelope me-1"></i><?php echo htmlspecialchars((string) $selectedData['vUserEmailId']); ?>
                                </div>
                            </div>
                            <?php if ($selectedTokens) { ?>
                            <div class="cpm-stat-grid">
                                <div class="cpm-stat"><span class="cpm-stat-val"><?php echo (int) $selectedTokens['earned']; ?></span><span class="cpm-stat-lbl">Earned</span></div>
                                <div class="cpm-stat"><span class="cpm-stat-val"><?php echo (int) $selectedTokens['total']; ?></span><span class="cpm-stat-lbl">Plan total</span></div>
                                <div class="cpm-stat"><span class="cpm-stat-val"><?php echo htmlspecialchars((string) $selectedTokens['pct']); ?>%</span><span class="cpm-stat-lbl">Progress</span></div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="mt-3 pt-3 border-top border-white border-opacity-50">
                            <a class="btn btn-sm cpm-btn-soft" target="_blank" href="get_career_progress_report.php?user_id=<?php echo (int) $selectedData['iUserId']; ?>"><i class="bi bi-file-earmark-pdf me-1"></i> Export PDF report</a>
                        </div>
                    </div>

                    <div class="cpm-info-callout">
                        <i class="bi bi-bar-chart-line me-1 text-primary"></i>
                        <strong>Learner-facing charts</strong> (milestones and skills radar) live on their LMS <em>Career Progress Monitor</em>. Use this page for Stage 2, notes, milestones, tasks, and activity logs.
                    </div>

                    <div class="card cpm-card"><div class="card-header"><h5><i class="bi bi-flag me-2 text-primary"></i>Stage 2 — Initial coaching &amp; pathway</h5></div><div class="card-body">
                        <?php if ($selectedAssessment) { ?>
                            <dl class="cpm-assessment mb-0">
                                <dt>Stage 1 snapshot</dt>
                                <dd class="text-muted small mb-0">From the learner&rsquo;s self-service assessment</dd>
                                <dt>Current status</dt>
                                <dd><?php echo htmlspecialchars($selectedAssessment['current_status']); ?></dd>
                                <?php if (!empty($selectedAssessment['qualifications_text'])) { ?>
                                <dt>Qualifications</dt>
                                <dd><?php echo nl2br(htmlspecialchars((string) $selectedAssessment['qualifications_text'])); ?></dd>
                                <?php } ?>
                                <dt>Skills on file</dt>
                                <dd><code class="small bg-light px-2 py-1 rounded"><?php echo htmlspecialchars($selectedAssessment['skills_json']); ?></code></dd>
                                <?php if (!empty($selectedAssessment['career_interests'])) { ?>
                                <dt>Career interests</dt>
                                <dd><?php echo nl2br(htmlspecialchars((string) $selectedAssessment['career_interests'])); ?></dd>
                                <?php } ?>
                                <?php if (!empty($selectedAssessment['employment_goals'])) { ?>
                                <dt>Employment goals</dt>
                                <dd><?php echo nl2br(htmlspecialchars((string) $selectedAssessment['employment_goals'])); ?></dd>
                                <?php } ?>
                                <dt>Barriers</dt>
                                <dd><?php echo htmlspecialchars($selectedAssessment['barriers_json']); ?></dd>
                            </dl>
                        <?php } ?>
                        <p class="cpm-hint mb-3 mt-3"><i class="bi bi-lightbulb me-1"></i>Cover in session: qualifications and experience, skills gaps, confidence, employment readiness, goal clarity, and practical barriers (childcare, transport, wellbeing).</p>
                        <?php if (career_coaching_stage2_columns_ready($conn) && career_coaching_stage2_assessment_columns_ready($conn)) {
                            $curPw = isset($selectedData['career_pathway']) ? (string) $selectedData['career_pathway'] : '';
                            $curLbl = $curPw !== '' ? career_pathway_label($curPw) : '';
                            $s2done = !empty($selectedData['career_initial_coaching_completed']);
                            $s2Qual = isset($selectedData['career_stage2_qualifications_experience']) ? (string) $selectedData['career_stage2_qualifications_experience'] : '';
                            $s2Gaps = isset($selectedData['career_stage2_skills_gaps']) ? (string) $selectedData['career_stage2_skills_gaps'] : '';
                            $s2Conf = isset($selectedData['career_stage2_confidence_level']) ? (int) $selectedData['career_stage2_confidence_level'] : 3;
                            $s2Read = isset($selectedData['career_stage2_employment_readiness']) ? (string) $selectedData['career_stage2_employment_readiness'] : '';
                            $s2Clar = isset($selectedData['career_stage2_goal_clarity']) ? (string) $selectedData['career_stage2_goal_clarity'] : '';
                            $s2Bar = isset($selectedData['career_stage2_barriers']) ? (string) $selectedData['career_stage2_barriers'] : '';
                            if ($s2done && $curLbl !== '') { ?>
                                <div class="alert alert-success py-2 mb-3 rounded-3 border-0 shadow-sm"><strong>Current pathway:</strong> <?php echo htmlspecialchars($curLbl); ?></div>
                            <?php } ?>
                        <?php if ($stage2Error !== '') { ?>
                            <div class="alert alert-danger py-2 mb-3 rounded-3 border-0"><?php echo htmlspecialchars($stage2Error); ?></div>
                        <?php } ?>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>">
                            <label class="form-label">Qualifications and experience (Stage 2 review)</label>
                            <textarea class="form-control mb-2" name="stage2_qualifications_experience" required><?php echo htmlspecialchars($s2Qual); ?></textarea>
                            <label class="form-label">Skills gaps</label>
                            <textarea class="form-control mb-2" name="stage2_skills_gaps" required><?php echo htmlspecialchars($s2Gaps); ?></textarea>
                            <label class="form-label">Confidence level (1-5)</label>
                            <select class="form-control mb-2" name="stage2_confidence_level" required>
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <option value="<?php echo $i; ?>"<?php echo ($s2Conf === $i) ? ' selected' : ''; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                            <label class="form-label">Employment readiness</label>
                            <select class="form-control mb-2" name="stage2_employment_readiness" required>
                                <option value="">Select readiness</option>
                                <option value="not_ready"<?php echo ($s2Read === 'not_ready') ? ' selected' : ''; ?>>Not ready</option>
                                <option value="developing"<?php echo ($s2Read === 'developing') ? ' selected' : ''; ?>>Developing</option>
                                <option value="ready_soon"<?php echo ($s2Read === 'ready_soon') ? ' selected' : ''; ?>>Ready soon</option>
                                <option value="job_ready"<?php echo ($s2Read === 'job_ready') ? ' selected' : ''; ?>>Job ready</option>
                            </select>
                            <label class="form-label">Clarity of career goals</label>
                            <select class="form-control mb-2" name="stage2_goal_clarity" required>
                                <option value="">Select clarity</option>
                                <option value="unclear"<?php echo ($s2Clar === 'unclear') ? ' selected' : ''; ?>>Unclear</option>
                                <option value="emerging"<?php echo ($s2Clar === 'emerging') ? ' selected' : ''; ?>>Emerging</option>
                                <option value="clear"<?php echo ($s2Clar === 'clear') ? ' selected' : ''; ?>>Clear</option>
                            </select>
                            <label class="form-label">Barriers (confidence, childcare, transport, wellbeing)</label>
                            <textarea class="form-control mb-2" name="stage2_barriers" required><?php echo htmlspecialchars($s2Bar); ?></textarea>
                            <label class="form-label">Assign pathway</label>
                            <select class="form-control mb-2" name="career_pathway" required>
                                <option value="">Select pathway</option>
                                <?php foreach (career_pathway_slugs() as $slug => $plabel) { ?>
                                    <option value="<?php echo htmlspecialchars($slug); ?>"<?php echo ($curPw === $slug) ? ' selected' : ''; ?>><?php echo htmlspecialchars($plabel); ?></option>
                                <?php } ?>
                            </select>
                            <textarea class="form-control mb-2" name="session_summary" placeholder="Session summary (optional — saved to learner record when provided)" rows="3"></textarea>
                            <textarea class="form-control mb-3" name="private_notes" placeholder="Private notes (optional)" rows="2"></textarea>
                            <button class="btn btn-primary cpm-btn-primary" name="save_pathway_stage2" value="1"><i class="bi bi-check2-circle me-1"></i> Save pathway &amp; mark Stage 2 complete</button>
                        </form>
                        <?php } else { ?>
                            <div class="alert alert-warning mb-0 rounded-3 border-0">Run <code>migrate_career_tables.php</code> once to enable full Stage 2 assessment and pathway allocation.</div>
                        <?php } ?>
                    </div></div>

                    <?php
                    if ($selectedData) {
                        $learnerId = (int) $selectedData['iUserId'];
                        $summary = career_get_user_summary($conn, $learnerId);
                        include __DIR__ . '/career_stage3_coach_panel.php';
                    }
                    ?>
                    <div class="row g-3 cpm-form-row">
                        <div class="col-md-6">
                            <div class="card cpm-card h-100 d-flex flex-column"><div class="card-header flex-shrink-0"><h5><i class="bi bi-journal-text me-2 text-secondary"></i>Additional session notes</h5></div><div class="card-body d-flex flex-column flex-grow-1">
                                <form method="post" class="d-flex flex-column flex-grow-1">
                                    <input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>">
                                    <label class="form-label">Summary</label>
                                    <textarea class="form-control mb-2" name="summary" placeholder="Optional follow-up for the learner record" rows="3"></textarea>
                                    <label class="form-label">Private notes</label>
                                    <textarea class="form-control mb-3" name="private_notes" placeholder="Staff-only" rows="2"></textarea>
                                    <button type="submit" class="btn btn-outline-primary cpm-btn-soft mt-auto align-self-start" name="save_discovery" value="1"><i class="bi bi-save me-1"></i> Save session note</button>
                                </form>
                            </div></div>
                        </div>
                        <div class="col-md-6">
                            <div class="card cpm-card h-100 d-flex flex-column"><div class="card-header flex-shrink-0"><h5><i class="bi bi-clipboard-pulse me-2 text-primary"></i>Log weekly activity</h5></div><div class="card-body d-flex flex-column flex-grow-1">
                                <form method="post" class="d-flex flex-column flex-grow-1">
                                    <input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>">
                                    <label class="form-label">Activity</label>
                                    <textarea class="form-control mb-2" name="activity_description" required rows="3" placeholder="What did they do?"></textarea>
                                    <label class="form-label">Skills (comma-separated)</label>
                                    <input class="form-control mb-2" name="skills" placeholder="e.g. Communication, Teamwork">
                                    <label class="form-label">Confidence</label>
                                    <select class="form-control mb-2" name="confidence_level"><option value="1">1</option><option value="2">2</option><option selected value="3">3</option><option value="4">4</option><option value="5">5</option></select>
                                    <label class="form-label">Staff notes</label>
                                    <textarea class="form-control mb-2" name="staff_notes" placeholder="Private staff notes" rows="2"></textarea>
                                    <label class="form-label">Tokens</label>
                                    <input class="form-control mb-3" type="number" name="token_award" value="1" min="1" max="10">
                                    <button type="submit" class="btn btn-primary cpm-btn-primary mt-auto align-self-start" name="log_for_user" value="1"><i class="bi bi-send me-1"></i> Save activity log</button>
                                </form>
                            </div></div>
                        </div>
                    </div>

                    <div class="row g-3 cpm-form-row">
                        <div class="col-md-6">
                            <div class="card cpm-card h-100 d-flex flex-column"><div class="card-header flex-shrink-0"><h5><i class="bi bi-signpost-2 me-2 text-success"></i>Create milestone</h5></div><div class="card-body d-flex flex-column flex-grow-1">
                                <form method="post" class="d-flex flex-column flex-grow-1">
                                    <input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>">
                                    <label class="form-label">Template</label>
                                    <select class="form-control mb-2" onchange="document.getElementById('cpm-milestone-title').value=this.value;">
                                        <option value="">Optional — pick a template</option>
                                        <?php if ($templates) while ($tmp = mysqli_fetch_assoc($templates)) { ?>
                                            <option value="<?php echo htmlspecialchars($tmp['title']); ?>"><?php echo htmlspecialchars($tmp['title']); ?></option>
                                        <?php } ?>
                                    </select>
                                    <label class="form-label">Title</label>
                                    <input id="cpm-milestone-title" class="form-control mb-2" name="title" placeholder="Title" required>
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control mb-2" name="description" placeholder="Description" rows="2"></textarea>
                                    <div class="row g-2">
                                        <div class="col-sm-6"><label class="form-label">Target date</label><input class="form-control mb-2" type="date" name="target_date"></div>
                                        <div class="col-sm-6"><label class="form-label">Tokens</label><input class="form-control mb-2" type="number" min="1" max="10" name="token_value" value="3"></div>
                                    </div>
                                    <label class="form-label">Required evidence</label>
                                    <input class="form-control mb-3" name="required_evidence" placeholder="Optional">
                                    <button type="submit" class="btn btn-success cpm-btn-success mt-auto align-self-start" name="create_milestone" value="1"><i class="bi bi-plus-lg me-1"></i> Add milestone</button>
                                </form>
                            </div></div>
                        </div>
                        <div class="col-md-6">
                            <div class="card cpm-card h-100 d-flex flex-column"><div class="card-header flex-shrink-0"><h5><i class="bi bi-calendar-week me-2 text-success"></i>Create weekly task</h5></div><div class="card-body d-flex flex-column flex-grow-1">
                                <form method="post" class="d-flex flex-column flex-grow-1">
                                    <input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>">
                                    <label class="form-label">Milestone</label>
                                    <select class="form-control mb-2" name="milestone_id" required>
                                        <option value="">Select milestone</option>
                                        <?php if ($milestones) while ($m = mysqli_fetch_assoc($milestones)) { ?>
                                            <option value="<?php echo (int) $m['id']; ?>"><?php echo htmlspecialchars($m['title']); ?></option>
                                        <?php } ?>
                                    </select>
                                    <label class="form-label">Task title</label>
                                    <input class="form-control mb-2" name="task_title" placeholder="Task title" required>
                                    <div class="row g-2">
                                        <div class="col-sm-6"><label class="form-label">Week start</label><input class="form-control mb-2" type="date" name="week_start" required></div>
                                        <div class="col-sm-6"><label class="form-label">Week end</label><input class="form-control mb-2" type="date" name="week_end" required></div>
                                    </div>
                                    <label class="form-label">Task tokens</label>
                                    <input class="form-control mb-3" type="number" name="task_tokens" value="1" min="1" max="10">
                                    <button type="submit" class="btn btn-success cpm-btn-success mt-auto align-self-start" name="create_task" value="1"><i class="bi bi-plus-lg me-1"></i> Add task</button>
                                </form>
                            </div></div>
                        </div>
                    </div>

                    <?php if ($mode === 'admin') { ?>
                    <div class="row g-3 cpm-form-row">
                        <div class="col-md-6">
                            <div class="card cpm-card h-100 d-flex flex-column"><div class="card-header flex-shrink-0"><h5><i class="bi bi-person-plus me-2 text-warning"></i>Manual mentor assignment</h5></div><div class="card-body flex-grow-1">
                                <form method="post">
                                    <input type="hidden" name="user_id" value="<?php echo (int) $selectedData['iUserId']; ?>">
                                    <label class="form-label">Mentor</label>
                                    <select class="form-control mb-3" name="mentor_id" required>
                                        <option value="">Select mentor</option>
                                        <?php if ($mentors) while ($m = mysqli_fetch_assoc($mentors)) { ?>
                                            <option value="<?php echo (int) $m['iUserId']; ?>"><?php echo htmlspecialchars($m['vUserName']); ?></option>
                                        <?php } ?>
                                    </select>
                                    <button type="submit" class="btn btn-warning rounded-3 fw-semibold" name="manual_assign" value="1"><i class="bi bi-link-45deg me-1"></i> Assign mentor</button>
                                </form>
                            </div></div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } else { ?>
                    <div class="card cpm-card border-0 bg-transparent shadow-none" style="box-shadow:none!important;border:none!important;">
                        <div class="card-body text-center py-5 rounded-4" style="background:linear-gradient(180deg,#f8fafc,#fff);border:1px dashed #cbd5e1;">
                            <i class="bi bi-people display-4 text-muted mb-3 d-block"></i>
                            <h5 class="fw-bold text-dark">Choose a learner</h5>
                            <p class="text-muted mb-0 small">Select someone from the list on the right to open their coaching workspace.</p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-lg-4 order-lg-2">
                    <div class="card cpm-card cpm-learner-panel sticky-lg-top" style="top:1rem;">
                        <div class="card-header"><h5 class="mb-0"><i class="bi bi-list-ul me-2 text-primary"></i><?php echo $mode === 'admin' ? 'All learners' : 'Your learners'; ?></h5></div>
                        <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php if ($users) while ($u = mysqli_fetch_assoc($users)) {
                                $pw = isset($u['career_pathway']) ? (string) $u['career_pathway'] : '';
                                $pwl = $pw !== '' ? career_pathway_label($pw) : '';
                                $s2 = isset($u['career_initial_coaching_completed']) ? (int) $u['career_initial_coaching_completed'] : 0;
                                $isActive = ($selectedUser === (int) $u['iUserId']);
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center<?php echo $isActive ? ' is-active' : ''; ?>">
                                    <div>
                                        <a href="career_progress.php?mode=<?php echo $mode; ?>&user_id=<?php echo (int) $u['iUserId']; ?>"><?php echo htmlspecialchars($u['vUserName']); ?></a>
                                        <?php if (career_coaching_stage2_columns_ready($conn)) { ?>
                                            <div class="small text-muted mt-1"><?php echo $s2 && $pwl !== '' ? htmlspecialchars($pwl) : ($s2 ? 'Stage 2 done' : 'Stage 2 pending'); ?></div>
                                        <?php } ?>
                                    </div>
                                    <span class="badge rounded-pill text-bg-primary"><?php echo (int) $u['tokens']; ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($mode === 'admin') { ?>
            <div class="card cpm-card mt-1"><div class="card-header"><h5><i class="bi bi-speedometer2 me-2"></i>Admin metrics &amp; templates</h5></div><div class="card-body">
                <p><strong>Unassigned users:</strong> <?php echo $unassigned; ?></p>
                <a class="btn btn-outline-primary btn-sm mb-3" href="career_progress_export.php" target="_blank">Export All Career Data (CSV)</a>
                <form method="post">
                    <div class="row">
                        <div class="col-md-4"><input class="form-control mb-2" name="template_title" placeholder="Template title" required></div>
                        <div class="col-md-5"><input class="form-control mb-2" name="template_description" placeholder="Description"></div>
                        <div class="col-md-2"><input type="number" class="form-control mb-2" name="template_tokens" value="3" min="1" max="10"></div>
                        <div class="col-md-1"><button class="btn btn-success cpm-btn-success" name="save_template" value="1">Save</button></div>
                    </div>
                </form>
            </div></div>
            <!-- <div class="card cpm-card mt-3"><div class="card-header"><h5><i class="bi bi-archive me-2"></i>Legacy upload archive</h5></div><div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead class="table-light"><tr><th>ID</th><th>User</th><th>File</th><th>Archive</th><th>Expires</th><th>Delete</th></tr></thead>
                    <tbody>
                    <?php if ($legacy) while ($l = mysqli_fetch_assoc($legacy)) { ?>
                        <tr>
                            <td><?php echo (int) $l['id']; ?></td>
                            <td><?php echo (int) $l['user_id']; ?></td>
                            <td><?php echo htmlspecialchars($l['file_name']); ?></td>
                            <td><?php echo htmlspecialchars($l['archive_path']); ?></td>
                            <td><?php echo htmlspecialchars($l['expires_at']); ?></td>
                            <td>
                                <?php if ((int) $l['delete_confirmed'] === 1) { echo '<span class="badge text-bg-danger">Confirmed</span>'; } else { ?>
                                <form method="post" onsubmit="return confirm('Confirm delete request for this legacy upload?');">
                                    <input type="hidden" name="legacy_id" value="<?php echo (int) $l['id']; ?>">
                                    <button class="btn btn-danger btn-sm" name="legacy_delete" value="1">Confirm Delete</button>
                                </form>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                </div>
            </div></div> -->
            <?php } ?>
        </div></div>
    </main>
    <footer class="app-footer"><?php require "footer.php";?></footer>
</div>
</body>
</html>
