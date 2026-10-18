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
                <h4>My E-Portfolio</h4>
            </div>
            <div class="page-content">
                <section>
					<div class="row">
						<div class="col-md-6">
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light">Functional Skills</h6>
								<a href="my-ac-personal-information?mode=edit" class="list-group-item list-group-item-action">Personal Information</a>
								<a href="eps-personal-development" class="list-group-item list-group-item-action">Personal Development</a>
								<a href="eps-upload-course-work" class="list-group-item list-group-item-action">Upload Course Work</a>
								<a href="eps-download-course-work" class="list-group-item list-group-item-action">Download Course Work</a>
							</div>						
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light">Individual Learning Plan</h6>
								<a href="epl-plan-upload" class="list-group-item list-group-item-action">Upload</a>
								<a href="epl-plan-download" class="list-group-item list-group-item-action">Download</a>
							</div>
						</div>				
						<div class="col-md-6">
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light">Homework</h6>
								<a href="eph-homework" class="list-group-item list-group-item-action">Homework</a>
							</div>
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light">Individual Learning Review</h6>
								<a href="epl-review-upload" class="list-group-item list-group-item-action">Upload</a>
								<a href="epl-review-download" class="list-group-item list-group-item-action">Download</a>
								<a href="javascript:downloadfile();" class="list-group-item list-group-item-action">Evaluation Questionnaire</a> 
								<!-- need to create script for download ../CourseEvaluationQuestionnairedoc.doc-->
							</div>
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light">Learner Log Book</h6>
								<a href="student-log-form" class="list-group-item list-group-item-action">Add Learner Log</a>
								<a href="student-log-book" class="list-group-item list-group-item-action">View Learner Log</a>
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