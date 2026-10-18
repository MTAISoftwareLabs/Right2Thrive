<?php
require_once __DIR__ . '/config/config.php';
app_define_main_branding();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'metadata.php'; ?>
    <title>About us<?php echo sitename; ?></title>
</head>
<body class="user-login-page">
<?php include 'lms/user_log_header.php'; ?>

<main class="container py-4 py-lg-5" style="max-width: 820px;">
    <h1 class="h2 fw-bold mb-3">About Right2Thrive UK Collective Careers Hub</h1>
    <p class="lead text-secondary">Employability support, coaching, and AI skills for young people and adults in North London and online.</p>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h2 class="h5 fw-bold">What we offer</h2>
            <ul class="mb-0">
                <li>Career assessment and 1:1 coaching with an assigned mentor</li>
                <li>9-week Employability &amp; AI Work Experience Journey</li>
                <li>Progress tracking — skills map, milestones, tokens, and weekly tasks</li>
                <li>Direct chat with your career coach inside the hub</li>
                <li>Job vacancies and links to the Right2Thrive UK Wellbeing Hub</li>
            </ul>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h2 class="h5 fw-bold">Who we support</h2>
            <p class="mb-0 text-secondary">People seeking work, career changers, and young adults building confidence, CVs, interview skills, and digital/AI workplace skills. Programmes are delivered by Right2Thrive UK in partnership with 21K Digital Media.</p>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a class="btn btn-primary rounded-pill px-4" href="user_login.php">Sign in to the Careers Hub</a>
        <a class="btn btn-outline-secondary rounded-pill px-4" href="workshops.php">View 9-week programme</a>
        <a class="btn btn-outline-secondary rounded-pill px-4" href="https://www.right2thriveuk.com/about/" target="_blank" rel="noopener noreferrer">Right2Thrive UK organisation</a>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
