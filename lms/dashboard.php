<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>
	<title>Learner Dashboard<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<?php
$proimg = "assets/images/faces/2.jpg";
$q = "select * from cpo_usermaster where iUserId='$user_id'";
$r = runquery($q);
if (mysqli_num_rows($r) > 0) {
	$f = mysqli_fetch_array($r);
	$picture = $f['picture'];
	if ($picture !== "") {
		$picarray = explode(',', $picture);
		$proimg = "uploads/" . end($picarray);
	}
}
?>

<body>
	<div id="app">
		<?php include "sidebar.php"; ?>
		<div id="main">
			<?php include "header.php"; ?>

			<div class="page-heading">
			    <div class="alert hub-alert-banner mb-4" role="alert">
					Microsoft Teams meeting is scheduled. <a href="https://teams.live.com/l/community/FEAmEJxjG8yItOECAI" class="alert-link">Join the meeting</a>.
				</div>
				<h3 class="mb-0">Dashboard</h3>
				<p class="hub-page-sub">Quick links to your learning, portfolio, and wellbeing tools.</p>
			</div>
			<div class="page-content">
				<section class="row">
					<div class="col-12">
						<div class="row g-4 mb-2">
							<div class="col-md-4 col-sm-12">
								<a href="my-portfolio.php" class="hub-action-card">
									<span class="hub-action-card__icon" aria-hidden="true"><i class="bi bi-stack"></i></span>
									<span class="hub-action-card__title">My E-Portfolio</span>
									<p class="hub-action-card__desc">Career Planning, plans, reviews, and your learning log.</p>
								</a>
							</div>
							<div class="col-md-4 col-sm-12">
								<a href="interactive_learning.php" class="hub-action-card">
									<span class="hub-action-card__icon" aria-hidden="true"><i class="bi bi-egg-fill"></i></span>
									<span class="hub-action-card__title">Individual Career's Plan</span>
									<p class="hub-action-card__desc">Your personalised pathway and interactive resources.</p>
								</a>
							</div>
							<div class="col-md-4 col-sm-12">
								<a href="career-development.php" class="hub-action-card">
									<span class="hub-action-card__icon" aria-hidden="true"><i class="bi bi-award-fill"></i></span>
									<span class="hub-action-card__title">Career development</span>
									<p class="hub-action-card__desc">Resources to build skills and explore opportunities.</p>
								</a>
							</div>
							<div class="col-md-4 col-sm-12">
								<a href="career-progress-dashboard.php" class="hub-action-card">
									<span class="hub-action-card__icon" aria-hidden="true"><i class="bi bi-graph-up-arrow"></i></span>
									<span class="hub-action-card__title">Career Progress Monitor</span>
									<p class="hub-action-card__desc">Track milestones, confidence, and employability readiness.</p>
								</a>
							</div>
							<div class="col-md-4 col-sm-12">
								<a href="zoom.php" class="hub-action-card">
									<span class="hub-action-card__icon" aria-hidden="true"><i class="bi bi-camera-video"></i></span>
									<span class="hub-action-card__title">Virtual Classroom</span>
									<p class="hub-action-card__desc">Join live sessions and wellbeing check-ins.</p>
								</a>
							</div>
							<div class="col-md-4 col-sm-12">
								<a href="career-chat.php" class="hub-action-card">
									<span class="hub-action-card__icon" aria-hidden="true"><i class="bi bi-chat-dots"></i></span>
									<span class="hub-action-card__title">Career coach chat</span>
									<p class="hub-action-card__desc">Message your assigned career coach.</p>
								</a>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="card hub-panel">
									<div class="card-body">
										<h4 class="mb-3 hub-panel-title">Wellbeing &amp; tools</h4>
										<div class="hub-link-list">
											<a href="zoom.php"><i class="bi bi-heart-pulse" aria-hidden="true"></i> My Wellbeing space</a>
											<a href="interactive_learning.php"><i class="bi bi-diagram-3" aria-hidden="true"></i> Individual Learning Plan</a>
											<a href="https://www.right2thrive.org/verisapp/build/web/index.html" target="_blank" rel="noopener noreferrer"><i class="bi bi-phone" aria-hidden="true"></i> Veris app <small class="text-muted">(opens new tab)</small></a>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="col-6 col-lg-3 col-md-6">-->
							<!--    <div class="card">-->
							<!--        <div class="card-body px-3 py-4-5">-->
							<!--            <div class="row">-->

							<!--                <div class="col-md-8">-->
							<!--                     <a href="slide_01_01.html" class='sidebar-link'>-->
							<!--    <i class="bi bi-award-fill"></i>-->
							<!--    <span>Unit 1</span>-->
							<!--</a>-->
							<!--                </div>-->
							<!--            </div>-->
							<!--        </div>-->
							<!--    </div>-->
							<!--</div>-->

							<!--<div class="col-6 col-lg-3 col-md-6">-->
							<!--    <div class="card">-->
							<!--        <div class="card-body px-3 py-4-5">-->
							<!--            <div class="row">-->

							<!--                <div class="col-md-8">-->
							<!--                     <a href="slide_02_01.html" class='sidebar-link'>-->
							<!--    <i class="bi bi-award-fill"></i>-->
							<!--    <span>Unit 2</span>-->
							<!--</a>-->
							<!--                </div>-->
							<!--            </div>-->
							<!--        </div>-->
							<!--    </div>-->
							<!--</div>-->

							<!--<div class="col-6 col-lg-3 col-md-6">-->
							<!--    <div class="card">-->
							<!--        <div class="card-body px-3 py-4-5">-->
							<!--            <div class="row">-->

							<!--                <div class="col-md-8">-->
							<!--                     <a href="unit3/slide_03_01.html" class='sidebar-link'>-->
							<!--    <i class="bi bi-award-fill"></i>-->
							<!--    <span>Unit 3</span>-->
							<!--</a>-->
							<!--                </div>-->
							<!--            </div>-->
							<!--        </div>-->
							<!--    </div>-->
							<!--</div>-->

							<!--<div class="col-6 col-lg-3 col-md-6">-->
							<!--    <div class="card">-->
							<!--        <div class="card-body px-3 py-4-5">-->
							<!--            <div class="row">-->

							<!--                <div class="col-md-8">-->
							<!--                     <a href="unit4/slide_04_01.html" class='sidebar-link'>-->
							<!--    <i class="bi bi-award-fill"></i>-->
							<!--    <span>Unit 4</span>-->
							<!--</a>-->
							<!--                </div>-->
							<!--            </div>-->
							<!--        </div>-->
							<!--    </div>-->
							<!--</div>-->

						</div>
            <div class="page-heading">
                <h3 class="hub-section-title">Job vacancies</h3>
                <p class="hub-page-sub mb-0"><a href="eps-personal-development.php">View all published vacancies</a></p>
            </div>
            <div class="page-content">
                <section>					
					<div class="row">
							<div class="col-12">
								<div class="card">
									
									<div class="card-body">
										<div id="notice-board">
											<?php
											$flag = 0;
											if ($flag == 0) {
													$sqlspn = "Select * from cpo_jobmaster WHERE COALESCE(iStatus,1)=1 ORDER BY iJobId DESC";
// 	echo $sqlspn;
// 	die();
	$result = runquery1($sqlspn) or die('could not execuate');
												$num = $result ? mysqli_num_rows($result) : 0;
												if ($num > 0) {
													$res = mysqli_fetch_array($result);
													foreach ($result as $row) {
														echo "<div class='alert alert-secondary'> <h4> Job Title: " . $row['vJobTitle'] . "</h4></div>";
		echo "<p > <b> Description: </b> " . $row['tJobDesc']. "</p>";
														//print_r($row); echo "<br/>";
													}
												} else {
													echo "<p class='font-bold text-muted mb-0'>No notices at the moment.</p>";
												}
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
                </section>
            </div>
						<!-- <div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>New Information for you</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-lg">
												<?php
												$flag = 0;
												$sqlfiles = "SELECT vUserName,cpo_usermaster.iUserId,cpo_uploadfilestutor.iFileId,vFilePath,vUploadDate FROM cpo_uploadfilestutor,cpo_usermaster,cpo_uploadfilesviewed WHERE cpo_uploadfilesviewed.iFileId=cpo_uploadfilestutor.iFileId AND cpo_uploadfilesviewed.iUserId=" . $_SESSION['user_id'] . " AND cpo_uploadfilestutor.iTutorId=cpo_usermaster.iUserId AND cpo_uploadfilestutor.iUserId LIKE '%" . $_SESSION['user_id'] . "%' ORDER BY vUploadDate DESC";
												$rsfiles = runquery($sqlfiles);

												$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0;
												if ($num > 0) {
													$flag = 1;
													echo "<thead><tr><th rowspan='3'>Download Files :</th></tr></thead><tbody>";

													while ($rsresult = mysqli_fetch_array($rsfiles)) {
														$path = $rsresult['iUserId'] . "/" . $rsresult['vFilePath'];
														echo "<tr>
																		<td class='col-4'>
																				<p class='font-bold ms-3 mb-0'><a href='#' onClick='javascript:getnewwin($path," . $rsresult['iFileId'] . ");'>" . $rsresult['vFilePath'] . "</a></p>
																			</div>
																		</td>
																		<td class='4'>
																			<p class='mb-0'>" . gdate($rsresult['vUploadDate']) . "</p>
																		</td>
																		<td class='4'>
																			<p class='mb-0'>" . $rsresult['vUserName'] . "</p>
																		</td>
																	</tr>";
													}
													echo "</tbody>";
												} else {
															echo "<thead><tr><th rowspan='3'>No Download Files</th></tr></thead><tbody>";
												}

												$sqlfiles = "select js.iJobinfoId,us.vUserName as student,j.vJobTitle as job,js.dDateOfEntry from cpo_jobsuggesioninfo js ,cpo_usermaster us ,cpo_jobmaster j where js.iviewed=0 and js.iTutorId = us.iUserId and js.iJobId=j.iJobId and js.iStudentId=" . $user_id;
												$rsfiles = runquery($sqlfiles);
												$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0;
												if ($num > 0) {
													$flag = 1;
													echo "<thead><tr><th rowspan='3'>Job Suggestion :</th></tr></thead><tbody>";

													while ($rslist = mysqli_fetch_array($rsfiles)) {
														echo "<tr>
																		<td class='col-4'>
																				<p class='font-bold ms-3 mb-0'><a class='sidelink' href='#' onClick='javascript:openwin(" . $rslist['iJobinfoId'] . ")'>" . $rslist['job'] . "</a></p>
																			</div>
																		</td>
																		<td class='4'>
																			<p class='mb-0'><a class='sidelink' href='#' onClick='javascript:openwin(" . $rslist['iJobinfoId'] . ")'>" . gdate($rslist['dDateOfEntry']) . "</a></p>
																		</td>
																		<td class='4'>
																			<p class='mb-0'><a class='sidelink' href='#' onClick='javascript:openwin(" . $rslist['iJobinfoId'] . ")'>" . $rslist['student'] . "</a></p>
																		</td>
																	</tr>";
													}
													echo "</tbody>";
												} else {
															echo "<thead><tr><th rowspan='3'>No Job Suggestion</th></tr></thead><tbody>";
												}

												$sqlfiles = "select cpo_usermaster.vUserName,iTutorId,dDate,iIndId from cpo_ind_plan,cpo_usermaster where cpo_usermaster.iUserId=cpo_ind_plan.iTutorId and iStudentId ='" . $_SESSION['user_id'] . "' and iflag=0";
												$rsfiles = runquery($sqlfiles);
												$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0;
												if ($num > 0) {
													$flag = 1;
													echo "<thead><tr><th rowspan='3'>Learning Plan :</th></tr></thead><tbody>";

													while ($result_tutor_info = mysqli_fetch_array($rsfiles)) {
														echo "<tr>
																		<td class='col-4'>
																				<p class='font-bold ms-3 mb-0'><a target='_blank' href='../download.php?id=Individual_Learning_Plan.doc'>" . $result_tutor_info['vUserName'] . "</a></p>
																			</div>
																		</td>
																		<td class='4'>
																			<p class='mb-0'>" . gdate($result_tutor_info['dDate']) . "</p>
																		</td>
																		<td class='4'>
																			
																		</td>
																	</tr>";
													}
													echo "</tbody>";
												} else {

													echo "<thead><tr><th rowspan='3'>Apprenticeships</th></tr></thead><tbody>";
												}

												$sqlfiles = "select cpo_usermaster.vUserName,iTutorId,dDate,iIndId from cpo_ind_review,cpo_usermaster where cpo_usermaster.iUserId=cpo_ind_review.iTutorId and iStudentId ='" . $_SESSION['user_id'] . "' and iflag=0";
												$rsfiles = runquery($sqlfiles);
												$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0;
												if ($num > 0) {
													$flag = 1;
													echo "<thead><tr><th rowspan='3'>Learning Review :</th></tr></thead><tbody>";

													while ($result_tutor_info = mysqli_fetch_array($rsfiles)) {
														$path = $rsresult['iUserId'] . "/" . $rsresult['vFilePath'];
														echo "<tr>
																		<td class='col-4'>
																				<p class='font-bold ms-3 mb-0'><a  target='_blank' href='../download.php?id=Individual_Learning_Plan_Review.doc'>" . $result_tutor_info['vUserName'] . "</a></p>
																			</div>
																		</td>
																		<td class='4'>
																			<p class='mb-0'>" . gdate($result_tutor_info['dDate']) . "</p>
																		</td>
																		<td class='4'>
																			
																		</td>
																	</tr>";
													}
													echo "</tbody>";
												} else {
													echo "<thead><tr><th rowspan='3'>Work Placements</th></tr></thead><tbody>";
												}
												?>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					</div>
				</section>
			</div>
			<?php include "footer.php"; ?>
		</div>
	</div>
	<script>
		function getnewwin(obj, fid) {
			new1 = window.open("viewdownload?id=" + obj + "&fid=" + fid);
		}

		function openwin(obj) {
			new1 = window.open("Detail_SuggestJob?id=" + obj, "", 'height=500,width=600,scrollbars=yes,top=50 left=150');
			return true;
		}
	</script>
</body>

</html>