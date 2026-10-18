<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>My E-Portfolio<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h3 class="mb-0">My E-Portfolio</h3>
                <p class="hub-page-sub">Manage your profile, development evidence, and learning reviews.</p>
            </div>
            <div class="page-content">
                <section>
					<div class="row hub-link-columns">
						<div class="col-md-6">
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light"><i class="bi bi-folder2-open" aria-hidden="true"></i> My E-Portfolio</h6>
								<a href="my-ac-personal-information.php?mode=edit" class="list-group-item list-group-item-action"><i class="bi bi-person" aria-hidden="true"></i> Personal Information</a>
								<a href="eps-personal-development.php" class="list-group-item list-group-item-action"><i class="bi bi-briefcase" aria-hidden="true"></i> Job vacancies</a>
								<a href="eps-upload-course-work.php" class="list-group-item list-group-item-action"><i class="bi bi-upload" aria-hidden="true"></i> Upload course work</a>
								<a href="eps-download-course-work.php" class="list-group-item list-group-item-action"><i class="bi bi-download" aria-hidden="true"></i> Download course work</a>
								<a href="eph-homework.php" class="list-group-item list-group-item-action"><i class="bi bi-journal-text" aria-hidden="true"></i> Homework</a>
								<a href="student-log-book.php" class="list-group-item list-group-item-action"><i class="bi bi-book" aria-hidden="true"></i> Student log book</a>
								<a href="career-progress-dashboard.php" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-arrow-up" aria-hidden="true"></i> Career Progress Tasks</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light"><i class="bi bi-journal-check" aria-hidden="true"></i> My Learning Review</h6>
								<a href="epl-review-upload.php" class="list-group-item list-group-item-action"><i class="bi bi-cloud-upload" aria-hidden="true"></i> Upload review</a>
								<a href="epl-review-download.php" class="list-group-item list-group-item-action"><i class="bi bi-download" aria-hidden="true"></i> Download review</a>
								<a href="career-progress-dashboard.php" class="list-group-item list-group-item-action"><i class="bi bi-graph-up" aria-hidden="true"></i> Log Weekly Progress</a>
								<a href="javascript:downloadfile();" class="list-group-item list-group-item-action"><i class="bi bi-clipboard2-check" aria-hidden="true"></i> Evaluation Questionnaire</a>
							</div>
						</div>
						<div class="col-md-6 mt-3">
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light"><i class="bi bi-diagram-3" aria-hidden="true"></i> Individual Learning Plan</h6>
								<a href="epl-plan-upload.php" class="list-group-item list-group-item-action"><i class="bi bi-cloud-upload" aria-hidden="true"></i> Upload</a>
								<a href="epl-plan-download.php" class="list-group-item list-group-item-action"><i class="bi bi-download" aria-hidden="true"></i> Download</a>
							</div>
						</div>
					</div>
                </section>
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>
</body>

</html>
