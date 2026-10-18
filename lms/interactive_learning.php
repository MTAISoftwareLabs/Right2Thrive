<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Individual Learning Plan<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h3 class="mb-0">Individual Learning Plan</h3>
                <p class="hub-page-sub">Upload or download your plan documents.</p>
            </div>
            <div class="page-content">
                <section>
					<div class="row hub-link-columns">
						<div class="col-md-6">
							<div class="list-group with-icon">
								<h6 class="list-group-item list-group-item-action active title-light"><i class="bi bi-diagram-3" aria-hidden="true"></i> Individual Learning Plan</h6>
								<a href="epl-plan-upload.php" class="list-group-item list-group-item-action"><i class="bi bi-cloud-upload" aria-hidden="true"></i> Upload</a>
								<a href="epl-plan-download.php" class="list-group-item list-group-item-action"><i class="bi bi-download" aria-hidden="true"></i> Download</a>
								<a href="career-progress-dashboard.php" class="list-group-item list-group-item-action"><i class="bi bi-list-check" aria-hidden="true"></i> Update Weekly Plan Tasks</a>
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
