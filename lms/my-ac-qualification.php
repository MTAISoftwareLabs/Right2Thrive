<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Qualification<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<?php
	$sql="select us.I_user_subid,us.I_subjectid,us.V_sublevel,sb.vSubjectName,sb.iSubjectId,um.iUserId, um.vUserName    from cpo_usermaster as um, cpo_user_subject as us, cpo_subjectmaster as sb where us.I_studentid =".$_SESSION['user_id']." and sb.iSubjectId = us.I_subjectid and us.I_tutorid = um.iUserId group by us.I_subjectid";
	$result1=runquery1($sql);
	$count=mysqli_num_rows($result1);
	$page=Ceil($count/page_size);
	if(isset($_GET['curpage'])){
		$curpage = $_GET['curpage'];
		if($curpage==0){
			$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		}else{
			$current=page_size*($curpage);
			$sql.=" order by sb.vSubjectName Limit " .$current. ",".page_size;
		}
	}else{
		$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		$curpage=0;
	}
	$rID = runquery1($sql);
	$num = $rID ? mysqli_num_rows($rID) : 0 ;
?>
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
								<a class="nav-link active" id="qualification-tab" href="my-ac-qualification.php" role="tab" aria-controls="qualification" aria-selected="true"><i class="fa fa-certificate" aria-hidden="false"></i> Qualification</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="uploadphoto-tab" href="my-ac-upload-photo.php" role="tab" aria-controls="uploadphoto" aria-selected="false"><i class="fa fa-camera" aria-hidden="true"></i> Upload Photo</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="joincourse-tab" href="my-ac-join-course.php" role="tab" aria-controls="joincourse" aria-selected="false" title="Add to purchase the course"><i class="fa fa-book" aria-hidden="true"></i> Join Course</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="changepassword-tab" href="my-ac-change-password.php" role="tab" aria-controls="changepassword" aria-selected="false"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="qualification" role="tabpanel" aria-labelledby="qualification-tab">
								<h5>Qualification Details</h5>
															
								<div class="row">
									<div class="col-md-12">
										<div class="card frm-border">											
											<div class="card-content">
												<div class="card-body">

													<div class="col-md-12 form-section">
													  <?php
													  		$formstat = "disabled" ;
															if(isset($_GET['mode']) && $_GET['mode'] == "edit"){
																$formstat = "";
															}

															if (isset($_POST['submit'])){ 
																$qual_ache = trim($_POST['TXLEARNQUAACHIVED']);
																$employed = trim($_POST['RBLEARNEMPLOYED']);
																$employedreason =  trim($_POST['TXLEARNEMPLOYEDREASON']);
																$career = trim($_POST['TXLEARNCAREER']);
																$qualtillachive = trim($_POST['TXLEARNQUALILIKEACHIVE']);
																$skill = trim($_POST['TXLEARNSKILL']);
																$hobby = trim($_POST['TXLEARNHOBBIES']);
																$yndis = $_POST['RBLEARNDISABILITY'];
																if ($yndis == 1){
																	$disab = $_POST['TXLEARNDISABILITYEXPLAIN'];
																}else{
																	$disab = "";
																}
																$sqlupdate = "update cpo_usermaster set TUserQualification='".$qual_ache."',TUserAchive='".$qualtillachive."',iUserEmployed=".$employed.",";
																$sqlupdate .= "vUserEmployedReason='".$employedreason."',TUserCareerOccupation='".$career."',TUserSkills='".$skill."',TUserHobbies='".$hobby."',";
																$sqlupdate .= "TUserDisabilityReason='".$disab."',iUserDisability=".$yndis." where iUserId=".$_SESSION['user_id'];
																runquery1($sqlupdate);
																//echo $sqlupdate;
																addlog(3);
																echo "<div class='lfm alert alert-success'>Your Qualification details has been updated successfully.</div>";
															}
															
															$sqledit = "select TUserQualification,TUserAchive,iUserEmployed,vUserEmployedReason,TUserCareerOccupation,TUserSkills,TUserHobbies,iUserDisability,TUserDisabilityReason,I_schoolyear,I_schoolid,V_schoolclass from cpo_usermaster where iUserId=".$_SESSION['user_id'];
															$rsedit = runquery1($sqledit);
															$num = $rsedit ? mysqli_num_rows($rsedit) : 0 ;
															if ($num > 0)
															{
																$rsdata = mysqli_fetch_array($rsedit);
														  ?>
														  <form name="frmqua" id="frmqua" method="post" action="my-ac-qualification.php">

															<div class="row">
																<div class="col-md-7">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="achievedqual">Qualification Achieved</label>
																	  <textarea class="form-control" rows="3" id="achievedqual" name="TXLEARNQUAACHIVED"><?php echo $rsdata['TUserQualification']; ?></textarea>
																	</fieldset>
																</div>
																<div class="col-md-5 text-center">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="uname" style="padding-right: 10px; display:block;"class="mb-3">Employed</label>
																	  <div class="form-check form-check-inline">
																		 <input class="form-check-input" type="radio" name="RBLEARNEMPLOYED" value="1" id="rnde1" <?php if ($rsdata['iUserEmployed'] == 1) { echo "checked" ; }?>>
																		 <label class="form-check-label" for="rnde1">Yes</label>
																	  </div>
																	  <div class="form-check form-check-inline">
																		 <input class="form-check-input" type="radio" name="RBLEARNEMPLOYED" value="0" id="rnde2" <?php if ($rsdata['iUserEmployed'] == 0) { echo "checked" ; }?>>
																		 <label class="form-check-label" for="rnde2">No</label>
																	  </div>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="yourjob">If Yes please explain what Jobs OR If No how long have you been employed</label>
																	  <textarea class="form-control" rows="3" id="yourjob" name="TXLEARNEMPLOYEDREASON"><?php echo $rsdata['vUserEmployedReason']; ?></textarea>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="yourinterest">Career Occupation you would like to enter</label>
																	  <textarea class="form-control" rows="3" id="yourinterest" name="TXLEARNCAREER"><?php echo $rsdata['TUserCareerOccupation']; ?></textarea>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="gain-qul">Qualification you would like to achieve</label>
																	  <textarea class="form-control" rows="3" id="gain-qul" name="TXLEARNQUALILIKEACHIVE"><?php echo $rsdata['TUserAchive']; ?></textarea>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="skill">Skills that you may already have:</label>
																	  <textarea class="form-control" rows="3" id="skill" name="TXLEARNSKILL"><?php echo $rsdata['TUserSkills']; ?></textarea>				  
																	</fieldset>
																</div>
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="hobbies">Hobbies</label>
																	  <textarea class="form-control" rows="3" id="hobbies" name="TXLEARNHOBBIES"><?php echo $rsdata['TUserHobbies']; ?></textarea>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-5 text-center">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="uname" style="padding-right: 10px; display:block;"class="mb-3">Do you have a disability?</label>
																	  <div class="form-check form-check-inline">
																		 <input class="form-check-input" type="radio" name="RBLEARNDISABILITY" value="1" onclick="getdisable(this)" <?php if ($rsdata['iUserDisability'] == 1) { echo "checked" ; }?>>
																		 <label class="form-check-label" for="inlineRadio7">Yes</label>
																	  </div>
																	  <div class="form-check form-check-inline">
																		 <input class="form-check-input" type="radio" name="RBLEARNDISABILITY" value="0" onclick="getdisable(this)" <?php if ($rsdata['iUserDisability'] == 0) { echo "checked" ; }?>>
																		 <label class="form-check-label" for="inlineRadio8">No</label>
																	  </div>				  
																	</fieldset>
																</div>
																<div class="col-md-7">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="1">If yes, please explain.</label>
																	  <textarea class="form-control" rows="3" id="1" name="TXLEARNDISABILITYEXPLAIN" <?php if ($rsdata['iUserDisability'] == 0) { echo "disabled" ; }?>><?php echo $rsdata['TUserDisabilityReason']; ?></textarea>
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-8">
																	<div class="form-group">
																		<div class="form-check" style="margin-top: 13px;">
																		  <label class="form-check-label">																			
																			<div id="ethnicity"><input type="hidden" name="test" value="" /></div>
																		  </label>
																		</div>
																	</div>
																</div>
																<div class="col-md-4 text-right">
																<?php																	
																	if($formstat == "disabled"){
																		echo "<a href='my-ac-qualification.php?mode=edit' class='btn btn-primary'><i class='fa fa-pencil-square-o'></i> Edit Qualification</a>";
																	}else{
																		echo "<button type='submit' name='submit' class='btn btn-primary'><i class='fa fa-check-square'></i> Update</button>";
																	}																
																?>
																</div>
															</div>
														  </form>					  
														  <?php
															}
														  ?>
													</div>
													
												</div>
											</div>
										</div>
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
		
	function getOthers(){
		if(document.frmpersonal.CBOethnicity.value=="Other"){
			document.getElementById("ethnicity").style.display='block';
		}else{
			document.getElementById("ethnicity").style.display='none';
		}
	}

	function distext(){
		winfocus();
		document.getElementById("ethnicity").style.display='none';
	}

	function getdisable(obj){
		if(obj.value == 1){
			document.getElementById(1).disabled=false;
		}
		else{
			document.getElementById(1).value="";
			document.getElementById(1).disabled=true;
		}
	}

	</script>
</body>

</html>