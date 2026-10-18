<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Join Courses<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>My Account</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="summery-tab" href="my-account.php" role="tab" aria-controls="summery" aria-selected="false"><i class="fa fa-university" aria-hidden="true"></i> Account Summary</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="information-tab" href="my-ac-personal-information.php" role="tab" aria-controls="information" aria-selected="false"><i class="fa fa-address-card" aria-hidden="true"></i> Personal Information</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="qualification-tab" href="my-ac-qualification.php" role="tab" aria-controls="qualification" aria-selected="false"><i class="fa fa-certificate" aria-hidden="true"></i> Qualification</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="uploadphoto-tab" href="my-ac-upload-photo.php" role="tab" aria-controls="uploadphoto" aria-selected="false"><i class="fa fa-camera" aria-hidden="true"></i> Upload Photo</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="joincourse-tab" href="my-ac-join-course.php" role="tab" aria-controls="joincourse" aria-selected="true" title="Add to purchase the course"><i class="fa fa-book" aria-hidden="false"></i> Join Course</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="changepassword-tab" href="my-ac-change-password.php" role="tab" aria-controls="changepassword" aria-selected="false"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="joincourse" role="tabpanel" aria-labelledby="joincourse-tab">
								<h5>Join Courses</h5>								
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-8">
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body">
												
													<?php 
														if (isset($_POST['submit'])){
															$courseid = $_POST['courseid'];
															$coursename = $_POST['coursename'];
															$regdate = date("Y-m-d");
															$addcourse="insert into cpo_usercourse values('',".$user_id.",".$courseid.",'','".$regdate."',1,'','')";
															$record=runquery($addcourse);
															$coursename = substr($coursename,0,strlen($coursename)-1);
															
															//Sending mail 
															$fromname = $_SESSION['user_name'];
															$fromaddress = $_SESSION['email_id'];
															$toname = "Administrator of CareerPaths Online";
															$toaddress = admin_email;
															$subject = "Learner '".$_SESSION['user_name']."' has added new course.";
															$message ="<html><body><p>Dear Administrator,</p>";
															$message .= "<p>Learner '".$_SESSION['user_name']."' has added following courses to his/her account.</p>";
															$message .= "<p>".$coursename."</p>";
															$message .= "<p>Warm Regard From,</p>";
															$message .= "<p>CareerPaths Online Team</p></body></html>";
															SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);							
															
															echo "<div class='alert alert-success text-center'><h5 class='alert alert-success'><span style='color: black; text-transform: capitalize; cursor: pointer;'>$coursename</span> course addition information has been submitted successfully.</h5><a href='my-ac-join-course.php' class='btn btn-sm btn-warning'>Back To Courses</a></div>";
														}else{
															$sqlsel = "select distinct iCourseId from cpo_usercourse where iUserId =".$user_id;
															$strcourseid = "";
															$resultcourseid=runquery($sqlsel);
															if($resultcourseid){
																$num = mysqli_num_rows($resultcourseid);
															}else{
																$num=0;
															}if($num > 0){
																while($resultcourseid1 = mysqli_fetch_array($resultcourseid)){
																	$strcourseid.=$resultcourseid1['iCourseId'].',';
																}
															}	
															$strcourseid.="0";
															$sql="select * from cpo_coursemaster WHERE iStatus=1 AND iCourseId not in (".$strcourseid.") order by iCourseOrder";
															$result=runquery($sql);
															if($result){
																$num = mysqli_num_rows($result);
															}else{
																$num=0;
															}$counter=1;	
															if($num > 0){ 
													?>															
															<div class="table-responsive">
																<table class="table table-hover mb-0">
																	<thead class="dark">
																		<tr>
																			<th>Course Name</th>
																			<th>Duration</th>
																			<th>Fees(Pounds)</th>
																			<th></th>
																		</tr>
																	</thead>
																	<tbody>
																	<?php
																		foreach($result as $rslist){
																			$cid = $rslist["iCourseId"]; $vcn = $rslist["vCourseName"]; $vcd = $rslist["vCourseDuration"]; $fcf = $rslist["fCourseFees"];
																			echo "<tr><td>$vcn</td> <td>$vcd</td><td>&pound; $fcf</td><td class='text-center'>";
																			?>
																			<form name="course_<?php echo $counter; ?>" method="post" action="my-ac-join-course.php">
																				<input type="hidden" name="courseid" value="<?php echo $cid; ?>">
																				<input type="hidden" name="coursename" value="<?php echo $vcn; ?>">
																				<button type="submit" class="btn btn-sm btn-outline-primary" name="submit" id="submitBtn">Join Now</button>
																			</form>
																			<?php
																			echo "</td></tr>";
																			$counter++;
																		}
																	?>
																	</tbody>
																</table>
															</div>
														<?php
															}else{
																echo "<div class='alert alert-danger text-center'><h5>Your course addition information has been submitted successfully.</h5></div>";
															}
														}
														?>
													<p class="font-bold mt-4">Minimum System Requirements</p>
													<ul style="padding-left:20px;">
														<li>Multimedia PC with an 800 MHz Pentium or Higher Processor</li>
														<li>Microsoft Windows 98 or Later</li>
														<li>VGA Display with 16k Colour Support</li>
														<li>Soundcard and Speakers (Recommended)</li>
														<li>A Printer (Recommended)</li>														
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2">
									</div>
								</div>
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