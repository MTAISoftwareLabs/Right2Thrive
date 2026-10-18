<?php
require_once __DIR__ . '/config/config.php';
app_define_main_branding();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'metadata.php'; ?>
    <title>Workshops &amp; 9-week journey<?php echo sitename; ?></title>
</head>
<body class="user-login-page">
<?php include 'lms/user_log_header.php'; ?>

<main class="container py-4 py-lg-5">
    <div class="mb-4" style="max-width: 720px;">
        <h1 class="h2 fw-bold mb-2">Collective Careers Hub workshops</h1>
        <p class="text-secondary mb-0">Our structured 9-week employability and AI work experience programme. Sign in to track progress, earn tokens, and work with your coach.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-3 p-lg-4 mb-4 cd-workshops">
        <?php include __DIR__ . '/lms/career_workshops_snippet.php'; ?>
    </div>

    <div class="text-center">
        <a class="btn btn-primary rounded-pill px-4" href="user_login.php">Sign in to start your journey</a>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
