<?php
include_once 'dbConnection.php';
require_once __DIR__ . '/career_progress_lib.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$module = isset($_SESSION['module']) ? (int) $_SESSION['module'] : 0;
if ($module !== 2) {
    header('Location: user_login.php');
    exit;
}

career_bootstrap_user_profile($conn, $userId);
$message = '';
$error = '';
$schemaReady = career_onboarding_schema_ready($conn);
if (!$schemaReady && $error === '') {
    $error = 'Career database setup is not complete. An administrator must run migrate_career_tables.php once (open it in the browser or run: php migrate_career_tables.php from the project root).';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = isset($_POST['current_status']) ? trim($_POST['current_status']) : '';
    $statusOther = isset($_POST['current_status_other']) ? trim($_POST['current_status_other']) : '';
    $qualifications = isset($_POST['qualifications_text']) ? trim($_POST['qualifications_text']) : '';
    $skills = isset($_POST['skills']) && is_array($_POST['skills']) ? $_POST['skills'] : array();
    $skillsOther = isset($_POST['skills_other']) ? trim($_POST['skills_other']) : '';
    $careerInterests = isset($_POST['career_interests']) ? trim($_POST['career_interests']) : '';
    $employmentGoals = isset($_POST['employment_goals']) ? trim($_POST['employment_goals']) : '';
    $barriers = isset($_POST['barriers']) && is_array($_POST['barriers']) ? $_POST['barriers'] : array();
    $barriersOther = isset($_POST['barriers_other']) ? trim($_POST['barriers_other']) : '';

    if ($status === '') {
        $error = 'Please select your current status.';
    } elseif ($qualifications === '') {
        $error = 'Please add your qualifications (or write &ldquo;None yet&rdquo; if that fits you today).';
    } elseif ($careerInterests === '') {
        $error = 'Please tell us about your career interests.';
    } elseif ($employmentGoals === '') {
        $error = 'Please tell us about your employment goals.';
    } elseif (!career_onboarding_schema_ready($conn)) {
        $error = 'Career database setup is incomplete. Run migrate_career_tables.php once from the project root, then submit again.';
    } else {
        $safeStatus = mysqli_real_escape_string($conn, $status);
        $safeStatusOther = mysqli_real_escape_string($conn, $statusOther);
        $safeQual = mysqli_real_escape_string($conn, $qualifications);
        $safeSkills = mysqli_real_escape_string($conn, json_encode(array_values($skills)));
        $safeSkillsOther = mysqli_real_escape_string($conn, $skillsOther);
        $safeInterests = mysqli_real_escape_string($conn, $careerInterests);
        $safeGoals = mysqli_real_escape_string($conn, $employmentGoals);
        $safeBarriers = mysqli_real_escape_string($conn, json_encode(array_values($barriers)));
        $safeBarriersOther = mysqli_real_escape_string($conn, $barriersOther);
        $now = mysqli_real_escape_string($conn, date('Y-m-d H:i:s'));

        mysqli_query($conn, "INSERT INTO career_assessments (user_id,current_status,current_status_other,qualifications_text,skills_json,skills_other,career_interests,employment_goals,barriers_json,barriers_other,created_at,updated_at)
            VALUES (" . $userId . ",'" . $safeStatus . "','" . $safeStatusOther . "','" . $safeQual . "','" . $safeSkills . "','" . $safeSkillsOther . "','" . $safeInterests . "','" . $safeGoals . "','" . $safeBarriers . "','" . $safeBarriersOther . "','" . $now . "','" . $now . "')
            ON DUPLICATE KEY UPDATE current_status=VALUES(current_status),current_status_other=VALUES(current_status_other),qualifications_text=VALUES(qualifications_text),skills_json=VALUES(skills_json),
            skills_other=VALUES(skills_other),career_interests=VALUES(career_interests),employment_goals=VALUES(employment_goals),barriers_json=VALUES(barriers_json),barriers_other=VALUES(barriers_other),updated_at=VALUES(updated_at)");

        $assignResult = assign_mentor_round_robin($conn, $userId);

        if ($assignResult['status'] === 'assigned') {
            $_SESSION['require_assessment'] = false;
            $_SESSION['career_stage1_completion_message'] = true;
            header('Location: lms/career-progress-dashboard.php?onboarding=1');
            exit;
        }

        if ($assignResult['status'] === 'pending') {
            $_SESSION['require_assessment'] = false;
            $_SESSION['career_stage1_completion_message'] = true;
            header('Location: lms/career-progress-dashboard.php?pending_mentor=1');
            exit;
        }

        if ($assignResult['status'] === 'schema_missing') {
            $error = $assignResult['message'];
        } else {
            $_SESSION['require_assessment'] = false;
            $_SESSION['career_stage1_completion_message'] = true;
            $message = $assignResult['message'];
        }
    }
}

$caSkillOptions = array(
    array('label' => 'Communication', 'icon' => 'bi-chat-heart'),
    array('label' => 'IT Skills', 'icon' => 'bi-laptop'),
    array('label' => 'Teamwork', 'icon' => 'bi-people'),
    array('label' => 'Customer Service', 'icon' => 'bi-headset'),
    array('label' => 'Problem Solving', 'icon' => 'bi-lightbulb'),
    array('label' => 'Time Management', 'icon' => 'bi-clock-history'),
);
$caBarrierOptions = array(
    array('label' => 'Mental health challenges', 'icon' => 'bi-heart-pulse'),
    array('label' => 'Physical health issues', 'icon' => 'bi-activity'),
    array('label' => 'Lack of qualifications', 'icon' => 'bi-mortarboard'),
    array('label' => 'No work experience', 'icon' => 'bi-briefcase'),
    array('label' => 'Caring responsibilities', 'icon' => 'bi-house-heart'),
    array('label' => 'Housing instability', 'icon' => 'bi-building'),
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'metadata.php'; ?>
    <link rel="stylesheet" href="css/career-assessment.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <title>Career assessment — Right2Thrive UK Collective Careers Hub</title>
</head>
<body class="ca-app">
<?php include 'lms/user_log_header.php'; ?>

<main class="ca-main" id="main-content">
    <div class="container-fluid ca-fluid px-0">
        <div class="row g-0 ca-row">
            <aside class="col-lg-5 ca-sidebar" aria-label="About this assessment">
                <div class="ca-sidebar__inner">
                    <p class="ca-sidebar__label">Before you begin</p>
                    <h1 class="ca-sidebar__title">Let&rsquo;s understand your starting point</h1>
                    <p class="ca-sidebar__lead">Honest answers help your coach prepare practical support &mdash; not judgement, just clarity.</p>
                    <ul class="ca-sidebar__list">
                        <li><i class="bi bi-shield-check" aria-hidden="true"></i><span>Your responses stay in your hub profile for your mentor team.</span></li>
                        <li><i class="bi bi-patch-check" aria-hidden="true"></i><span>Skip anything you&rsquo;re not comfortable sharing; optional boxes are optional.</span></li>
                        <li><i class="bi bi-stars" aria-hidden="true"></i><span>No wrong answers &mdash; pick what feels true today.</span></li>
                    </ul>
                </div>
                <div class="ca-sidebar__meta">
                    <span class="ca-pill"><i class="bi bi-stopwatch" aria-hidden="true"></i> ~4 minutes</span>
                    <span class="ca-pill"><i class="bi bi-list-check" aria-hidden="true"></i> 6 short sections</span>
                </div>
            </aside>

            <div class="col-12 col-lg-7 ca-content-col">
                <div class="ca-content">
                    <div class="ca-mobile-hero">
                        <h2>Stage 1: registration &amp; initial assessment</h2>
                        <p>A short questionnaire about your skills, qualifications, interests, and goals. Your coach uses this to prepare your first session.</p>
                    </div>

                    <div class="ca-panel">
                        <div class="ca-progress">
                            <div class="ca-progress__labels">
                                <span>Start</span>
                                <span>Almost there</span>
                            </div>
                            <div class="ca-progress__track">
                                <div class="ca-progress__fill"></div>
                            </div>
                        </div>

                        <?php
                        if (!empty($_SESSION['show_collective_careers_welcome'])) {
                            unset($_SESSION['show_collective_careers_welcome']);
                            ?>
                        <div class="ca-callout">
                            <h2>Welcome to the Right2Thrive UK Collective Careers Hub</h2>
                            <p>You&rsquo;re in the right place to get support with jobs, skills, and next steps.</p>
                            <p>Please complete the short assessment so your career coach can understand how best to support you.</p>
                            <p>There are no right or wrong answers &mdash; just select what feels true for you.</p>
                            <p><strong>We&rsquo;re here to help.</strong></p>
                        </div>
                        <?php } ?>

                        <?php
                        if (!empty($_SESSION['registration_mail_failed'])) {
                            unset($_SESSION['registration_mail_failed']);
                            ?>
                        <div class="ca-alert ca-alert--warn" role="alert">
                            <i class="bi bi-envelope-exclamation" aria-hidden="true"></i>
                            <div>Your account was created, but confirmation email could not be sent (the mail server was unreachable). You can continue below; contact support if you need a copy of your registration details.</div>
                        </div>
                        <?php } ?>

                        <?php if ($error !== '') { ?>
                        <div class="ca-alert ca-alert--danger" role="alert">
                            <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                            <div><?php echo htmlspecialchars($error); ?></div>
                        </div>
                        <?php } ?>
                        <?php if ($message !== '') { ?>
                        <div class="ca-alert ca-alert--success" role="alert">
                            <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                            <div>
                                <p class="mb-2"><strong>Thank you for completing your assessment. Please book your 1-to-1 Career Coaching Session.</strong></p>
                                <p class="mb-0 small"><?php echo htmlspecialchars($message); ?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <form method="post" novalidate>
                            <section class="ca-step" aria-labelledby="q1-title">
                                <div class="ca-step__head">
                                    <span class="ca-step__num" aria-hidden="true">1</span>
                                    <div>
                                        <h2 class="ca-step__title" id="q1-title">Where are you right now?</h2>
                                        <p class="ca-step__hint">Choose the situation that best describes you today.</p>
                                    </div>
                                </div>
                                <label class="ca-field-label" for="current_status">Current status</label>
                                <div class="ca-select-wrap">
                                    <i class="bi bi-geo-alt" aria-hidden="true"></i>
                                    <select name="current_status" id="current_status" class="form-select" required>
                                        <option value="">Select your status</option>
                                        <option>In school</option>
                                        <option>College / University</option>
                                        <option>Unemployed</option>
                                        <option>Part-time employed</option>
                                        <option>Full-time employed</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <label class="ca-field-label mt-3" for="current_status_other">If you chose &ldquo;Other&rdquo; (optional)</label>
                                <input type="text" class="form-control" id="current_status_other" name="current_status_other" placeholder="Briefly describe your situation" autocomplete="off">
                            </section>

                            <section class="ca-step" aria-labelledby="q-qual-title">
                                <div class="ca-step__head">
                                    <span class="ca-step__num" aria-hidden="true">2</span>
                                    <div>
                                        <h2 class="ca-step__title" id="q-qual-title">Qualifications</h2>
                                        <p class="ca-step__hint">Qualifications you hold or are working towards (e.g. GCSEs, NVQ, degree). Type <strong>None yet</strong> if that applies.</p>
                                    </div>
                                </div>
                                <label class="ca-field-label" for="qualifications_text">Your qualifications</label>
                                <textarea class="form-control" id="qualifications_text" name="qualifications_text" rows="3" required placeholder="e.g. Level 2 English and Maths, or None yet"></textarea>
                            </section>

                            <section class="ca-step" aria-labelledby="q2-title">
                                <div class="ca-step__head">
                                    <span class="ca-step__num" aria-hidden="true">3</span>
                                    <div>
                                        <h2 class="ca-step__title" id="q2-title">Skills you already have</h2>
                                        <p class="ca-step__hint">Tap any that apply. Leave blank if none fit &mdash; that&rsquo;s useful information too.</p>
                                    </div>
                                </div>
                                <div class="ca-opt-grid" role="group" aria-label="Existing skills">
                                    <?php foreach ($caSkillOptions as $item) {
                                        $skill = $item['label'];
                                        $sid = 'skill_' . md5($skill);
                                        ?>
                                    <label class="ca-opt" for="<?php echo $sid; ?>">
                                        <input class="ca-opt__input" type="checkbox" name="skills[]" value="<?php echo htmlspecialchars($skill); ?>" id="<?php echo $sid; ?>">
                                        <span class="ca-opt__face">
                                            <span class="ca-opt__icon"><i class="bi <?php echo htmlspecialchars($item['icon']); ?>" aria-hidden="true"></i></span>
                                            <span class="ca-opt__text"><?php echo htmlspecialchars($skill); ?></span>
                                        </span>
                                    </label>
                                    <?php } ?>
                                </div>
                                <label class="ca-field-label mt-3" for="skills_other">Other skills (optional)</label>
                                <input type="text" class="form-control" id="skills_other" name="skills_other" placeholder="e.g. languages, tools, hobbies that help at work" autocomplete="off">
                            </section>

                            <section class="ca-step" aria-labelledby="q-interests-title">
                                <div class="ca-step__head">
                                    <span class="ca-step__num" aria-hidden="true">4</span>
                                    <div>
                                        <h2 class="ca-step__title" id="q-interests-title">Career interests</h2>
                                        <p class="ca-step__hint">Sectors, roles, or types of work you&rsquo;re curious about &mdash; even if you&rsquo;re not sure yet.</p>
                                    </div>
                                </div>
                                <label class="ca-field-label" for="career_interests">What kinds of work interest you?</label>
                                <textarea class="form-control" id="career_interests" name="career_interests" rows="3" required placeholder="e.g. retail, healthcare, creative industries, office admin&hellip;"></textarea>
                            </section>

                            <section class="ca-step" aria-labelledby="q-goals-title">
                                <div class="ca-step__head">
                                    <span class="ca-step__num" aria-hidden="true">5</span>
                                    <div>
                                        <h2 class="ca-step__title" id="q-goals-title">Employment goals</h2>
                                        <p class="ca-step__hint">What you&rsquo;d like to achieve next &mdash; first job, more hours, new sector, AI skills, etc.</p>
                                    </div>
                                </div>
                                <label class="ca-field-label" for="employment_goals">Your employment goals</label>
                                <textarea class="form-control" id="employment_goals" name="employment_goals" rows="3" required placeholder="Describe your goals in your own words"></textarea>
                            </section>

                            <section class="ca-step" aria-labelledby="q3-title">
                                <div class="ca-step__head">
                                    <span class="ca-step__num" aria-hidden="true">6</span>
                                    <div>
                                        <h2 class="ca-step__title" id="q3-title">Anything making work or job search harder?</h2>
                                        <p class="ca-step__hint">This helps your coach know how to support you. Only select what you&rsquo;re comfortable sharing.</p>
                                    </div>
                                </div>
                                <div class="ca-opt-grid" role="group" aria-label="Barriers to employment">
                                    <?php foreach ($caBarrierOptions as $item) {
                                        $barrier = $item['label'];
                                        $bid = 'barrier_' . md5($barrier);
                                        ?>
                                    <label class="ca-opt" for="<?php echo $bid; ?>">
                                        <input class="ca-opt__input" type="checkbox" name="barriers[]" value="<?php echo htmlspecialchars($barrier); ?>" id="<?php echo $bid; ?>">
                                        <span class="ca-opt__face">
                                            <span class="ca-opt__icon"><i class="bi <?php echo htmlspecialchars($item['icon']); ?>" aria-hidden="true"></i></span>
                                            <span class="ca-opt__text"><?php echo htmlspecialchars($barrier); ?></span>
                                        </span>
                                    </label>
                                    <?php } ?>
                                </div>
                                <label class="ca-field-label mt-3" for="barriers_other">Anything else (optional)</label>
                                <input type="text" class="form-control" id="barriers_other" name="barriers_other" placeholder="Only if you want to add more context" autocomplete="off">
                            </section>

                            <div class="ca-actions">
                                <button type="submit" class="ca-submit"<?php echo $schemaReady ? '' : ' disabled title="Run database migration first"'; ?>>
                                    <i class="bi bi-arrow-right-circle-fill" aria-hidden="true"></i>
                                    Save and continue to your dashboard
                                </button>
                                <p class="ca-footnote">You can revisit these topics with your mentor later if your situation changes.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="container ca-footer-wrap">
    <?php include 'footer.php'; ?>
</div>
</body>
</html>
