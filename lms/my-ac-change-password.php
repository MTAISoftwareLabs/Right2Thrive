<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Change Password<?php echo sitename; ?></title>
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
								<a class="nav-link" id="summery-tab" href="my-account.php" role="tab" aria-controls="summery" aria-selected="true"><i class="fa fa-university" aria-hidden="true"></i> Account Summary</a>
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
								<a class="nav-link" id="joincourse-tab" href="my-ac-join-course.php" role="tab" aria-controls="joincourse" aria-selected="false" title="Add to purchase the course"><i class="fa fa-book" aria-hidden="true"></i> Join Course</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="changepassword-tab" href="my-ac-change-password.php" role="tab" aria-controls="changepassword" aria-selected="true"><i class="fa fa-key" aria-hidden="false"></i> Change Password</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
								<h5>Change Password</h5>								
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-6">
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body">
												
													<?php 
														if (isset($_POST['submit'])){														
															$sqlchange = "select vUserEmailId,vUserName from cpo_usermaster where vUserEmailId='".$_SESSION['email_id']."' and vUserPassword='".$_POST['TXLEARNOLDPASSWORD']."'";															
															$rschange = runquery1($sqlchange);	
															$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
															if ($num > 0 )
															{
																$rsdata = mysqli_fetch_array($rschange);
																$sqldelete = "update cpo_usermaster set vUserPassword='".$_POST['TXLEARNNEWPASSWORD']."' where iUserId=".$_SESSION['user_id'];
																runquery1($sqldelete);
																$fromname = "CareerPaths Online";
																$fromaddress = admin_email;
																$toname = $rsdata['vUserName'];
																$toaddress = $rsdata['vUserEmailId'];
																$subject = "Change password for CareerPaths Online.";
																$message ="<html><body><p>Dear ".$rsdata['vUserName'].",</p>";
																$message .= "<p>You have successfully change your password from '".$_POST['TXLEARNOLDPASSWORD']."' to '".$_POST['TXLEARNNEWPASSWORD']."'</p>";
																$message .= "<p>Warm Regard From,</p>";
																$message .= "<p>CareerPaths Online Team</p></body></html>";
																SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
																echo "<div class='alert alert-success' role='alert'>Password changed successfully.</div>";
																addlog(4);
															}
															else
															{
																echo "<div class='alert alert-danger' role='alert'>Your Password does not match !</div>";						
															}
														}	
													?>

													<form class="" name="frmex" method="post" action="my-ac-change-password.php">
													  <div class="form-group">
														<input class="form-control" id="oldPassword" name="TXLEARNOLDPASSWORD" placeholder="Current Password" required type="password" autocomplete="off" aria-describedby="inputGroupPrepend">
													  </div>
													  <div class="form-group">
														<input name="TXLEARNNEWPASSWORD" type="password" autocomplete="off" class="form-control" id="newPassword" placeholder="New Password" aria-describedby="inputGroupPrepend" required>
													  </div>
													  <div class="form-group">
														 <input name="TXLEARNCONFIRMPASSWORD" type="password" autocomplete="off" class="form-control" id="confirmPassword" placeholder="Confirm Password" aria-describedby="inputGroupPrepend" onfocusout="passwordMatch();" required>
														 <div class="invalid-feedback" id="unmatch">Password not a match.</div>
													  </div>
													  <div class="form-group">
														 <button id="submitBtn" class="btn btn-md btn-primary btn-block" type="submit" name="submit">Update</button>
													  </div>													  
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3">
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
	<script>		
		function passwordMatch() {
		  var x = document.getElementById("newPassword").value;
		  var y = document.getElementById("confirmPassword").value;
		  if(x !== y){
			document.getElementById("unmatch").style.display = "inline";
			document.getElementById("submitBtn").disabled = true;
		  }else{
			document.getElementById("submitBtn").disabled = false;
			document.getElementById("unmatch").style.display = "none";
		  }
		}
	</script>
</body>

</html>