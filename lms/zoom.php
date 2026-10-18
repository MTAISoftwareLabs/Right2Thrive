<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>My Wellbeing<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h3 class="mb-0">My Wellbeing</h3>
                <p class="hub-page-sub">Goals, plans, check-ins, and standard wellbeing questionnaires.</p>
            </div>
            <div class="page-content">
				<?php /*include "in-section-chat.php";*/ ?>
                <section>
					<div class="row hub-link-columns">
						<div class="col-md-6">
                            <div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light"><i class="bi bi-heart-pulse" aria-hidden="true"></i> My Wellbeing Space</h6>
								<a href="#" class="list-group-item list-group-item-action"><i class="bi bi-bullseye" aria-hidden="true"></i> My Goals</a>
								<a href="career-progress-dashboard.php" class="list-group-item list-group-item-action"><i class="bi bi-cloud-upload" aria-hidden="true"></i> Log My Weekly Career Progress</a>
								<a href="mh-review-download.php" class="list-group-item list-group-item-action"><i class="bi bi-download" aria-hidden="true"></i> Download</a>
                                <a href="my_care_plan.php" class="list-group-item list-group-item-action"><i class="bi bi-file-medical" aria-hidden="true"></i> My Wellbeing Plan</a>
								<a href="my_weekly_wellness_checkin.php" class="list-group-item list-group-item-action"><i class="bi bi-calendar-week" aria-hidden="true"></i> My Weekly Progress</a>
                                <a href="gad7.php" class="list-group-item list-group-item-action"><i class="bi bi-clipboard-pulse" aria-hidden="true"></i> Generalized Anxiety Disorder 7 (GAD-7)</a>
                                <a href="phq9.php" class="list-group-item list-group-item-action"><i class="bi bi-clipboard-check" aria-hidden="true"></i> Nine Symptom Checklist (PHQ-9)</a>
							</div>
                        </div>
                    </div>
                </section>
            
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>	
	<script>		
		function chatnow(){
			new1=window.open("../chatnew/","","titlebar='CareerPaths Online - Chatting',height=460,width=700,scrollbars=yes,top=50,left=150");
		}
	</script>
</body>

</html>