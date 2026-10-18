<?php
include 'dbConnection.php';
require_once dirname(__DIR__) . '/career_progress_lib.php';

$userId = (int) $_SESSION['user_id'];
career_bootstrap_user_profile($conn, $userId);
$summary = career_get_user_summary($conn, $userId);
if (!career_onboarding_schema_ready($conn)) {
    header('Location: ../career_assessment.php');
    exit;
}
if (!$summary || (int) $summary['career_assessment_completed'] === 0) {
    header('Location: ../career_assessment.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['complete_task_id'])) {
        $taskId = (int) $_POST['complete_task_id'];
        mysqli_query($conn, "UPDATE career_weekly_tasks SET status='completed', completed_at=NOW() WHERE id=" . $taskId . " AND user_id=" . $userId);
        $taskRes = mysqli_query($conn, "SELECT token_value, milestone_id FROM career_weekly_tasks WHERE id=" . $taskId . " AND user_id=" . $userId . " LIMIT 1");
        $task = ($taskRes && mysqli_num_rows($taskRes)) ? mysqli_fetch_assoc($taskRes) : array('token_value' => 0, 'milestone_id' => 0);
        $tok = (int) $task['token_value'];
        mysqli_query($conn, "INSERT INTO career_token_ledger (user_id,source_type,source_id,tokens,notes,created_at) VALUES (" . $userId . ",'task'," . $taskId . "," . $tok . ",'Task completed',NOW())");
        if (!empty($task['milestone_id'])) {
            career_sync_milestone_status_from_tasks($conn, (int) $task['milestone_id'], $userId);
        }
    }
    if (isset($_POST['activity_description'])) {
        $desc = mysqli_real_escape_string($conn, trim($_POST['activity_description']));
        $skills = isset($_POST['skills']) ? mysqli_real_escape_string($conn, $_POST['skills']) : '';
        $conf = isset($_POST['confidence_level']) ? (int) $_POST['confidence_level'] : 3;
        $tokenAward = isset($_POST['token_award']) ? (int) $_POST['token_award'] : 1;
        mysqli_query($conn, "INSERT INTO career_weekly_logs (user_id,activity_description,skills_json,confidence_level,token_award,created_at)
            VALUES (" . $userId . ",'" . $desc . "','" . $skills . "'," . $conf . "," . $tokenAward . ",NOW())");
        mysqli_query($conn, "INSERT INTO career_token_ledger (user_id,source_type,source_id,tokens,notes,created_at)
            VALUES (" . $userId . ",'weekly_log',NULL," . $tokenAward . ",'Activity log',NOW())");
    }
    header('Location: career-progress-dashboard.php');
    exit;
}

$token = career_get_plan_tokens($conn, $userId);
career_sync_all_milestone_statuses($conn, $userId);
$mentor = null;
if (!empty($summary['career_mentor_id'])) {
    $mentorRes = mysqli_query($conn, "SELECT iUserId, vUserName, vUserEmailId FROM cpo_usermaster WHERE iUserId=" . (int) $summary['career_mentor_id'] . " LIMIT 1");
    if ($mentorRes && mysqli_num_rows($mentorRes)) {
        $mentor = mysqli_fetch_assoc($mentorRes);
    }
}
$milestoneList = array();
if (career_table_exists($conn, 'career_plan_milestones')) {
    $msRes = mysqli_query($conn, "SELECT id, title, target_date, token_value, status, completed_at FROM career_plan_milestones WHERE user_id=" . $userId . " ORDER BY target_date ASC, id ASC");
    if ($msRes) {
        while ($msRow = mysqli_fetch_assoc($msRes)) {
            $milestoneList[] = $msRow;
        }
    }
}
$roadmapDone = 0;
$roadmapActive = 0;
$roadmapPending = 0;
foreach ($milestoneList as $rm) {
    if ($rm['status'] === 'completed') {
        $roadmapDone++;
    } elseif ($rm['status'] === 'in_progress') {
        $roadmapActive++;
    } else {
        $roadmapPending++;
    }
}
$tasks = career_table_exists($conn, 'career_weekly_tasks')
    ? mysqli_query($conn, "SELECT * FROM career_weekly_tasks WHERE user_id=" . $userId . " ORDER BY week_start ASC, id ASC")
    : false;
$assessment = null;
if (career_table_exists($conn, 'career_assessments')) {
    $assessmentRes = mysqli_query($conn, "SELECT skills_json FROM career_assessments WHERE user_id=" . $userId . " LIMIT 1");
    $assessment = ($assessmentRes && mysqli_num_rows($assessmentRes)) ? mysqli_fetch_assoc($assessmentRes) : null;
}
$baseSkills = array('Communication'=>1,'IT Skills'=>1,'Teamwork'=>1,'Customer Service'=>1,'Problem Solving'=>1,'Time Management'=>1);
if ($assessment && !empty($assessment['skills_json'])) {
    $arr = json_decode($assessment['skills_json'], true);
    if (is_array($arr)) {
        foreach ($arr as $s) {
            if (isset($baseSkills[$s])) {
                $baseSkills[$s] = 3;
            }
        }
    }
}
$currentSkills = $baseSkills;
$logSkills = mysqli_query($conn, "SELECT skills_json FROM career_weekly_logs WHERE user_id=" . $userId . " ORDER BY id ASC");
if ($logSkills) {
    while ($ls = mysqli_fetch_assoc($logSkills)) {
        $tokens = array_map('trim', explode(',', (string)$ls['skills_json']));
        foreach ($tokens as $name) {
            if ($name !== '' && isset($currentSkills[$name]) && $currentSkills[$name] < 5) {
                $currentSkills[$name]++;
            }
        }
    }
}
$pathwaySlug = isset($summary['career_pathway']) ? (string) $summary['career_pathway'] : '';
$pathwayLabel = $pathwaySlug !== '' ? career_pathway_label($pathwaySlug) : '';
$stage2Done = !empty($summary['career_initial_coaching_completed']);
require_once dirname(__DIR__) . '/career_stage3_lib.php';
career_stage3_ensure_schema($conn);
$stage3Active = career_stage3_active($summary);
$stage3CanView = career_can_access_stage3($summary);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <?php include 'metadata.php'; ?>
    <title>Career Progress Monitor<?php echo sitename; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .career-neo {
            font-family: 'Inter', sans-serif;
            background: #f4f7fe;
            color: #0b1c3a;
            --accent-primary: #3b3ce4;
            --accent-glow: rgba(59, 60, 228, 0.2);
            --radius-xl: 32px;
            --radius-md: 24px;
            --border-light: rgba(203, 213, 225, 0.5);
        }
        .career-neo .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(0px);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-light);
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0,0,0,0.02);
            transition: transform 0.2s ease, box-shadow 0.25s ease;
            overflow: hidden;
        }
        .career-neo .glass-card:hover {
            box-shadow: 0 30px 45px -18px rgba(59, 60, 228, 0.2);
        }
        .career-neo .card-header-neo {
            background: #ffffffcc;
            padding: 1.25rem 1.6rem;
            border-bottom: 1px solid #eff2fc;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: -0.2px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .career-neo .metric-tile {
            background: white;
            border-radius: 32px;
            border: 1px solid #eef2fc;
            transition: all 0.2s;
        }
        .career-neo .metric-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(145deg, #181e3a, #2d3a6e);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            line-height: 1.2;
        }
        .career-neo .badge-soft {
            background: #eff3ff;
            color: #3b3ce4;
            border-radius: 100px;
            padding: 0.3rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .career-neo .btn-neo {
            border-radius: 100px;
            padding: 0.5rem 1.3rem;
            font-weight: 600;
            transition: all 0.2s;
            border: none;
            background: linear-gradient(100deg, #3b3ce4, #5c5df0);
            color: white;
            box-shadow: 0 6px 14px rgba(59, 60, 228, 0.25);
        }
        .career-neo .btn-neo:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 22px -8px #3b3ce4;
            color: white;
        }
        .career-neo .coach-neo-card {
            background: linear-gradient(115deg, #f2f5ff, #ffffff);
            border-radius: 28px;
            border-left: 5px solid #3b3ce4;
            padding: 1rem 1.3rem;
        }
        .career-neo .task-neo {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #ecf1f9;
            padding: 0.9rem 1.2rem;
            margin-bottom: 0.8rem;
            transition: all 0.2s;
        }
        .career-neo .task-neo:hover {
            border-color: #c7d0e2;
            background: #fefefe;
        }
        .career-neo .journey-dot {
            width: 32px;
            height: 32px;
            border-radius: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .hero-neo {
            background: radial-gradient(ellipse 70% 50% at 10% 30%, #edf2ff, #ffffff);
            border-radius: 38px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            border: 1px solid #eef2fe;
        }
        /* Skills map chart + milestone timeline */
        .petals-wrapper {
            min-height: 300px;
            position: relative;
        }
        .skills-petal-legend {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.35rem 1rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #eef2f9;
        }
        @media (max-width: 576px) {
            .skills-petal-legend { grid-template-columns: 1fr; }
        }
        .skills-petal-legend__row {
            display: flex;
            align-items: flex-start;
            gap: 0.45rem;
            padding: 0.4rem 0;
            font-size: 0.8125rem;
            line-height: 1.35;
            color: #1e293b;
        }
        .skills-petal-legend__dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 0.28rem;
            background: var(--petal-dot, #6366f1);
        }
        .skills-petal-legend__name {
            font-weight: 600;
            min-width: 0;
            word-break: break-word;
        }
        .skills-petal-legend__scores {
            margin-left: auto;
            flex-shrink: 0;
            text-align: right;
        }
        .horizon-flow {
            min-height: 280px;
            width: 100%;
        }
        .career-roadmap-summary {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }
        .career-roadmap-summary__item {
            flex: 1 1 100px;
            padding: 0.65rem 0.85rem;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            text-align: center;
        }
        .career-roadmap-summary__num {
            font-size: 1.35rem;
            font-weight: 800;
            line-height: 1.2;
            color: #0f172a;
        }
        .career-roadmap-summary__lbl {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #64748b;
        }
        .career-roadmap {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .career-roadmap__item {
            display: flex;
            gap: 0.85rem;
            padding-bottom: 1.15rem;
            position: relative;
        }
        .career-roadmap__item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 28px;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }
        .career-roadmap__marker {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            z-index: 1;
            margin-top: 2px;
        }
        .roadmap-status--done .career-roadmap__marker {
            background: #dcfce7;
            color: #16a34a;
        }
        .roadmap-status--active .career-roadmap__marker {
            background: #fef3c7;
            color: #d97706;
        }
        .roadmap-status--pending .career-roadmap__marker {
            background: #f1f5f9;
            color: #94a3b8;
        }
        .career-roadmap__body {
            flex: 1;
            min-width: 0;
            padding: 0.85rem 1rem;
            border-radius: 14px;
            border: 1px solid #e8eef5;
            background: #fff;
        }
        .roadmap-status--done .career-roadmap__body { border-color: #bbf7d0; background: #f0fdf4; }
        .roadmap-status--active .career-roadmap__body { border-color: #fde68a; background: #fffbeb; }
        .career-roadmap__title {
            font-weight: 700;
            font-size: 0.9375rem;
            color: #0f172a;
            line-height: 1.35;
            word-break: break-word;
        }
        .career-roadmap__meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem 0.75rem;
            margin-top: 0.45rem;
            font-size: 0.8125rem;
            color: #64748b;
        }
        .career-roadmap__badge {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            text-transform: none;
            letter-spacing: 0;
        }
        .roadmap-status--done .career-roadmap__badge { background: #16a34a; color: #fff; }
        .roadmap-status--active .career-roadmap__badge { background: #f59e0b; color: #1e293b; }
        .roadmap-status--pending .career-roadmap__badge { background: #94a3b8; color: #fff; }
        .career-roadmap-hint {
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 1rem;
            line-height: 1.45;
        }
        hr {
            background: #ecf1f9;
            margin: 0.5rem 0;
        }
        @media (max-width: 768px) {
            .career-neo .card-header-neo { padding: 1rem; flex-direction: column; align-items: flex-start; gap: 0.35rem; }
            .career-neo #main { padding: 1rem !important; }
            .metric-number { font-size: 1.9rem; }
            .hero-neo { padding: 1.2rem; }
            .career-roadmap-summary__item { flex: 1 1 calc(33% - 0.35rem); min-width: 90px; }
        }
        .text-gradient {
            background: linear-gradient(135deg, #1e2b4f, #2c3e66);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            font-weight: 800;
        }
    </style>
</head>
<body class="career-neo">
<div id="app">
    <?php include 'sidebar.php'; ?>
    <div id="main" style="padding: 1.5rem 2rem 2rem 2rem;">
        <?php include 'header.php'; ?>

        <!-- Hero section with modern splash -->
        <div class="hero-neo">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h3 class="text-gradient" style="font-size: 1.8rem;">Career Progress Monitor</h3>
                    <p class="text-muted mb-0 mt-1">Overall progress: <strong><?php echo (float) $token['pct']; ?>%</strong> &nbsp;·&nbsp; <?php echo (int) $token['earned']; ?> of <?php echo (int) $token['total']; ?> programme tokens earned</p>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge-soft"><i class="bi bi-calendar-week"></i> Week 1 · active</span>
                    <?php if ($mentor) { ?>
                        <span class="badge-soft bg-white border"><i class="bi bi-person-heart"></i> Connected</span>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php if (!empty($_SESSION['career_stage1_completion_message'])) { unset($_SESSION['career_stage1_completion_message']); ?>
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4" style="background:#e6f7ec; border-left:5px solid #22c55e;">
            <div class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill fs-5"></i> <strong>Assessment ready!</strong> Your 1:1 coaching session is the next milestone.</div>
            <?php if ($mentor) { ?>
                <div class="mt-2 small"><i class="bi bi-envelope"></i> <span class="fw-semibold"><?php echo htmlspecialchars($mentor['vUserName']); ?></span> — <a href="mailto:<?php echo htmlspecialchars($mentor['vUserEmailId']); ?>"><?php echo htmlspecialchars($mentor['vUserEmailId']); ?></a></div>
            <?php } else { ?>
                <div class="mt-2 small text-secondary">Coach assignment in progress — you’ll receive an email when ready.</div>
            <?php } ?>
        </div>
        <?php } ?>

        <!-- Tokens row -->
        <div class="row g-4 mb-4">
            <div class="col-md-4"><div class="metric-tile p-4"><div class="text-secondary text-uppercase small fw-semibold"><i class="bi bi-trophy"></i> Tokens earned</div><div class="metric-number"><?php echo (int) $token['earned']; ?></div><div class="mt-2 small text-secondary">From completed tasks and activity logs</div></div></div>
            <div class="col-md-4"><div class="metric-tile p-4"><div class="text-secondary text-uppercase small fw-semibold"><i class="bi bi-flag"></i> Programme total</div><div class="metric-number"><?php echo (int) $token['total']; ?></div><div class="mt-2 small text-secondary">Tokens available across your plan</div></div></div>
            <div class="col-md-4"><div class="metric-tile p-4"><div class="text-secondary text-uppercase small fw-semibold"><i class="bi bi-pie-chart-fill"></i> Overall progress</div><div class="metric-number"><?php echo (float) $token['pct']; ?>%</div><div class="progress mt-2" style="height:7px;"><div class="progress-bar bg-primary rounded-pill" style="width: <?php echo (float) $token['pct']; ?>%;"></div></div></div></div>
        </div>

        <!-- Skills map + milestone timeline -->
        <div class="row g-4 mb-5">
            <div class="col-xl-6">
                <div class="glass-card h-100">
                    <div class="card-header-neo">
                        <span><i class="bi bi-diagram-3 fs-5 me-2"></i> Skills map</span>
                        <span class="badge-soft">Current vs baseline</span>
                    </div>
                    <div class="p-3 p-xl-4">
                        <div id="skillsPetalChart" class="petals-wrapper"></div>
                        <div id="skillsPetalLegend" class="skills-petal-legend" aria-label="Skills map — levels vs baseline"></div>
                        <div class="text-center small text-muted mt-2">Each ring shows your current level (1 to 5). The table below compares baseline and current scores.</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="glass-card h-100">
                    <div class="card-header-neo">
                        <span><i class="bi bi-signpost-split fs-5 me-2"></i> Career roadmap</span>
                        <span class="badge-soft">Coach milestones</span>
                    </div>
                    <div class="p-3 p-xl-4">
                        <p class="career-roadmap-hint mb-0">Milestones your coach sets for your journey. Complete linked tasks in <strong>Your weekly tasks</strong> below — the roadmap updates automatically.</p>
                        <?php if (empty($milestoneList)) { ?>
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-map fs-1 d-block mb-2"></i>
                                <p class="mb-0 small">Your coach will add milestones after your first session.</p>
                            </div>
                        <?php } else { ?>
                        <div class="career-roadmap-summary">
                            <div class="career-roadmap-summary__item">
                                <div class="career-roadmap-summary__num" style="color:#16a34a;"><?php echo (int) $roadmapDone; ?></div>
                                <div class="career-roadmap-summary__lbl">Completed</div>
                            </div>
                            <div class="career-roadmap-summary__item">
                                <div class="career-roadmap-summary__num" style="color:#d97706;"><?php echo (int) $roadmapActive; ?></div>
                                <div class="career-roadmap-summary__lbl">In progress</div>
                            </div>
                            <div class="career-roadmap-summary__item">
                                <div class="career-roadmap-summary__num" style="color:#64748b;"><?php echo (int) $roadmapPending; ?></div>
                                <div class="career-roadmap-summary__lbl">Not started</div>
                            </div>
                        </div>
                        <ol class="career-roadmap" aria-label="Career milestones">
                            <?php foreach ($milestoneList as $m) {
                                $meta = career_milestone_status_meta($m['status']);
                                $target = !empty($m['target_date']) ? htmlspecialchars($m['target_date']) : '';
                            ?>
                            <li class="career-roadmap__item <?php echo htmlspecialchars($meta['css']); ?>">
                                <span class="career-roadmap__marker" aria-hidden="true"><i class="bi <?php echo htmlspecialchars($meta['icon']); ?>"></i></span>
                                <div class="career-roadmap__body">
                                    <div class="career-roadmap__title"><?php echo htmlspecialchars($m['title']); ?></div>
                                    <div class="career-roadmap__meta">
                                        <span class="career-roadmap__badge"><?php echo htmlspecialchars($meta['label']); ?></span>
                                        <?php if ($target !== '') { ?>
                                        <span><i class="bi bi-calendar3 me-1"></i>Target: <?php echo $target; ?></span>
                                        <?php } ?>
                                        <span><i class="bi bi-coin me-1"></i><?php echo (int) $m['token_value']; ?> token<?php echo (int) $m['token_value'] === 1 ? '' : 's'; ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ol>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly tasks + Coach section (same modern interactions) -->
        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <div class="glass-card">
                    <div class="card-header-neo"><i class="bi bi-check2-square fs-5 me-2"></i> Your weekly tasks</div>
                    <div class="p-4">
                        <p class="small text-muted mb-3">Mark a task complete when you finish it. Tokens are added to your total. Milestones on the roadmap update when all linked tasks are done.</p>
                        <?php if ($tasks && mysqli_num_rows($tasks) > 0) { 
                            while ($t = mysqli_fetch_assoc($tasks)) { ?>
                            <div class="task-neo d-flex flex-wrap justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold"><?php echo htmlspecialchars($t['task_title']); ?></div>
                                    <div class="text-secondary small"><i class="bi bi-calendar-range"></i> <?php echo htmlspecialchars($t['week_start']); ?> — <?php echo htmlspecialchars($t['week_end']); ?></div>
                                </div>
                                <div>
                                    <?php if ($t['status'] !== 'completed') { ?>
                                    <form method="post" class="m-0">
                                        <input type="hidden" name="complete_task_id" value="<?php echo (int) $t['id']; ?>">
                                        <button class="btn-neo btn-sm py-1 px-3"><i class="bi bi-check-lg"></i> Mark complete (+<?php echo (int) $t['token_value']; ?>)</button>
                                    </form>
                                    <?php } else { ?>
                                    <span class="badge bg-success bg-opacity-15 text-success px-3 py-2 rounded-pill"><i class="bi bi-check-circle"></i> completed</span>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } } else { ?>
                            <div class="text-center py-4 text-secondary"><i class="bi bi-list-ul fs-1 d-block mb-2"></i> No tasks yet — check back after coaching</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="glass-card">
                    <div class="card-header-neo"><i class="bi bi-chat-square-quote"></i> Coach & Micro-log</div>
                    <div class="p-4">
                        <div class="coach-neo-card mb-4 d-flex align-items-center gap-3 flex-wrap">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3"><i class="bi bi-person-raised-hand fs-4 text-primary"></i></div>
                            <div>
                                <?php if ($mentor) { ?>
                                    <div class="fw-bold"><?php echo htmlspecialchars($mentor['vUserName']); ?></div>
                                    <div class="small text-secondary"><i class="bi bi-envelope-paper"></i> <a href="mailto:<?php echo htmlspecialchars($mentor['vUserEmailId']); ?>" class="text-decoration-none"><?php echo htmlspecialchars($mentor['vUserEmailId']); ?></a></div>
                                    <div class="mt-1"><span class="badge bg-primary bg-opacity-15">active mentor</span></div>
                                <?php } else { ?>
                                    <div class="fw-semibold">Mentor matching</div>
                                    <div class="small text-secondary">You'll be paired within 48h — stay tuned.</div>
                                <?php } ?>
                            </div>
                        </div>
                        <h6 class="fw-semibold mb-3"><i class="bi bi-pencil-square"></i> Instant activity boost</h6>
                        <form method="post">
                            <textarea class="form-control rounded-4 mb-2" name="activity_description" rows="2" placeholder="e.g., Led presentation, finished module..." required></textarea>
                            <div class="row g-2 mb-2">
                                <div class="col-md-5"><input class="form-control rounded-4" type="text" name="skills" placeholder="Skills (comma)"></div>
                                <div class="col-md-3"><select class="form-select rounded-4" name="confidence_level">
                                    <option value="1">⭐ 1</option><option value="2">⭐ 2</option><option value="3" selected>⭐ 3</option><option value="4">⭐ 4</option><option value="5">⭐ 5</option>
                                </select></div>
                                <div class="col-md-2"><input class="form-control rounded-4" type="number" name="token_award" value="1" min="1" max="10"></div>
                                <div class="col-md-2"><button type="submit" class="btn-neo w-100 py-2"><i class="bi bi-cloud-upload"></i> Log</button></div>
                            </div>
                        </form>
                        <div class="mt-2 small text-secondary"><i class="bi bi-graph-up"></i> logging updates skills radar & token progress</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Journey stage card -->
        <div class="glass-card">
            <div class="card-header-neo"><i class="bi bi-signpost-2"></i> Pathway progress</div>
            <div class="p-4">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="journey-dot bg-success bg-opacity-15 text-success"><i class="bi bi-check2"></i></div>
                            <div><strong>Stage 1 · Assessment complete</strong><div class="small text-muted">Profile & baseline locked</div></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="journey-dot <?php echo $stage2Done ? 'bg-success bg-opacity-15 text-success' : 'bg-warning bg-opacity-10 text-warning'; ?>">
                                <i class="bi <?php echo $stage2Done ? 'bi-check2' : 'bi-clock-history'; ?>"></i>
                            </div>
                            <div>
                                <strong>Stage 2 · Career coaching session</strong>
                                <?php if ($stage2Done && $pathwayLabel !== '') { ?>
                                    <div class="small text-success">✔ Pathway: <?php echo htmlspecialchars($pathwayLabel); ?></div>
                                <?php } else { ?>
                                    <div class="small text-secondary">Pending 1:1 coaching → unlocks your track</div>
                                    <?php if($mentor) echo '<div class="small fw-semibold mt-1"><i class="bi bi-calendar"></i> schedule with your coach</div>'; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="journey-dot <?php echo $stage3CanView ? 'bg-success bg-opacity-15 text-success' : ($stage2Done ? 'bg-info bg-opacity-10 text-info' : 'bg-secondary bg-opacity-10 text-secondary'); ?>">
                                <i class="bi <?php echo $stage3CanView ? 'bi-check2' : ($stage2Done ? 'bi-hourglass-split' : 'bi-lock'); ?>"></i>
                            </div>
                            <div>
                                <strong>Stage 3 · Personal Career Action Plan</strong>
                                <?php if ($stage3CanView) { ?>
                                    <div class="small text-success">Action plan activated (Week 1–2)</div>
                                <?php } elseif ($stage2Done) { ?>
                                    <div class="small text-secondary">Your coach is preparing your PCAP</div>
                                <?php } else { ?>
                                    <div class="small text-muted">Complete Stage 2 to unlock</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include __DIR__ . '/career_pcap_participant_panel.php'; ?>

        <div class="glass-card mb-5" id="workshops">
            <div class="card-header-neo">
                <span><i class="bi bi-mortarboard fs-5 me-2"></i> Collective Careers Hub</span>
                <span class="badge-soft">9-week journey</span>
            </div>
            <div class="p-3 p-xl-4 cd-workshops">
                <?php include __DIR__ . '/career_workshops_snippet.php'; ?>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<script>
(function () {
    // ---------- SKILLS PETAL (radial bar) + HTML legend (Apex legend overlaps with 6 long rows) ----------
    const skillNames = <?php echo json_encode(array_keys($baseSkills)); ?>;
    const baselineArr = <?php echo json_encode(array_values($baseSkills)); ?>;
    const currentArr = <?php echo json_encode(array_values($currentSkills)); ?>;

    function escHtml(text) {
        var d = document.createElement('div');
        d.textContent = text;
        return d.innerHTML;
    }

    const ringColors = skillNames.map(function (_, i) {
        var hue = 230 + (i * 12);
        return 'hsl(' + hue + ', 65%, 58%)';
    });

    var legendBox = document.getElementById('skillsPetalLegend');
    if (legendBox) {
        legendBox.innerHTML = skillNames.map(function (name, i) {
            return '<div class="skills-petal-legend__row" style="--petal-dot:' + ringColors[i] + '">' +
                '<span class="skills-petal-legend__dot" aria-hidden="true"></span>' +
                '<span class="skills-petal-legend__name">' + escHtml(name) + '</span>' +
                '<span class="skills-petal-legend__scores"><strong>' + currentArr[i] + '</strong>/5 ' +
                '<span class="text-muted">(base ' + baselineArr[i] + ')</span></span></div>';
        }).join('');
    }

    const petalOptions = {
        chart: {
            type: 'radialBar',
            height: 340,
            toolbar: { show: false },
            fontFamily: 'Inter, sans-serif',
            dropShadow: { enabled: true, blur: 8, opacity: 0.1, top: 2 }
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                offsetY: -10,
                hollow: { size: '42%', background: 'transparent' },
                track: { background: '#eef2fc', strokeWidth: '97%' },
                dataLabels: {
                    name: { show: false },
                    value: { show: false }
                },
                barLabels: { enabled: false }
            }
        },
        colors: ringColors,
        stroke: { lineCap: 'round' },
        series: currentArr.map(function (val) {
            return Math.round((val / 5) * 100);
        }),
        labels: skillNames,
        legend: { show: false },
        tooltip: {
            y: {
                formatter: function (val, opts) {
                    var i = (opts && typeof opts.seriesIndex === 'number') ? opts.seriesIndex : 0;
                    return skillNames[i] + ': ' + currentArr[i] + '/5 (baseline ' + baselineArr[i] + ')';
                }
            }
        },
        responsive: [{ breakpoint: 550, options: { chart: { height: 320 } } }]
    };

    new ApexCharts(document.querySelector('#skillsPetalChart'), petalOptions).render();
})();
</script>
<style>
    .form-control, .form-select { border-radius: 20px; border: 1px solid #e2edfc; background: #ffffff; transition: 0.2s; }
    .form-control:focus, .form-select:focus { border-color: #888cf5; box-shadow: 0 0 0 3px rgba(59,60,228,0.2); }
    .bg-opacity-15 { background-color: rgba(59,60,228,0.12); }
    .rounded-4 { border-radius: 24px; }
    .apexcharts-radialbar-track path { stroke: #eef2fc; }
    .apexcharts-legend-text { font-family: 'Inter', sans-serif !important; font-weight: 500; }
</style>
</body>
</html>