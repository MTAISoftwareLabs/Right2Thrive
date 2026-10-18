<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "dbConnection.php"; ?>
    <title>Career Development Resources<?php echo sitename; ?></title>
    <?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h3 class="mb-0">Career development resources</h3>
                <p class="hub-page-sub mb-0">Online tools and links. The <strong>9-Week Employability &amp; AI Work Experience Journey</strong> lives on your <a href="career-progress-dashboard.php#workshops">Career Progress Monitor</a> dashboard.</p>
            </div>

            <div class="page-content">
                <section class="row mb-4">
                    <div class="col-12 col-md-8">
                        <div class="alert border rounded-3 mb-0" style="background:#f8fafc;border-color:#c7d2fe!important;">
                            <strong><i class="bi bi-chat-dots me-1"></i> Collective Careers Hub</strong> —
                            <a href="career-chat.php">Chat with your assigned career coach</a> (separate from legacy course chat bookings).
                        </div>
                    </div>
                </section>
                <section class="row mb-4" aria-labelledby="other-resources-heading">
                    <div class="col-12">
                        <h3 id="other-resources-heading" class="h5 mb-3">Other resources</h3>
                        <div class="row g-3">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <p class="mb-0 text-muted small">Click on the banner below for the interactive story, or use Job Rules.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <a href="http://www.right2thrive.org/app21/lms/canva_2/story.html" class="sidebar-link">
                                            <i class="bi bi-award-fill"></i>
                                            <span>Job Rules</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="http://www.right2thrive.org/app21/lms/canva/story.html" class="sidebar-link d-block">
                                <img src="uploads/background.png" class="img-fluid rounded w-100" alt="Career development interactive story — open link">
                            </a>
                        </div>
                    </div>
                </section>
            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>
</body>
</html>
