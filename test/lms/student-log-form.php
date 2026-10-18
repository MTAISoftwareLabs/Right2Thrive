<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Learner Log Book<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <!--<div class="page-heading">
                <h4>Learner Log Book</h4>
            </div>-->
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="card">
									<div class="card-header">
										<h4 class="card-title">Learner Log Book</h4>

										<?php if (!isset($_POST['addlog'])){ ?>
										<p>All (*) mark are compulsory fields</p>
									</div>
									<div class="card-content">
										<div class="card-body">
											<?php
												$islogout = "";
												if (isset($_GET['logout']) && $_GET['logout'] == "yes"){
													$islogout = "?logout=yes";
												}	
											?>
											<form class="form form-vertical" name="FRMSTUDENTLOGBOOK" method="post" action="student-log-form<?php echo $islogout; ?>" onSubmit="return validation();">
												<div class="form-body">
													<div class="row">
														<div class="col-12">
															<div class="form-group">
																<select name="CBOTUTOR" id="tutor"class="form-select" onChange="getsubject()" required>
																	<option disabled selected>Select Tutor*</option>
																	<?php
																		$query_tutor_id = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
																		$result_tutor_id = runquery($query_tutor_id);
																		$nos = 0;
																		if($result_tutor_id){
																			$nos = mysqli_num_rows($result_tutor_id);
																		}
																		if($nos>0){
																			$tutor_ids='';
																			while($result_tutor = mysqli_fetch_array($result_tutor_id)){
																				$str_tutor_id=$result_tutor['vTutorId'];
																				$str_tutor_length = strlen($str_tutor_id)-1;
																				if(substr($str_tutor_id,$str_tutor_length-1,$str_tutor_length)<>','){
																					$str_tutor_id=$result_tutor['vTutorId'].',';
																				}
																				$tutor_ids.= $str_tutor_id;
																			}
																			if($tutor_ids<>''){
																				$tutor_ids=substr($tutor_ids,0,strlen($tutor_ids)-1);								
																				$query_tutor_info = "select iUserId,vUserName from cpo_usermaster where iUserId in (".$tutor_ids.")";
																				$result_tutor_info = runquery($query_tutor_info);
																				$nos = 0;
																				if($result_tutor_info){
																					$nos = mysqli_num_rows($result_tutor_info);
																				}
																				if($nos>0){
																					while($result_tutor = mysqli_fetch_array($result_tutor_info)){
																						echo "<option value=".$result_tutor['iUserId'].">".$result_tutor['vUserName']."</option>";
																					}									
																				}
																			}
																		}else{
																			echo "<option value='No Tutor' selected>No Tutor Exists For Selection</option>";
																		}
																	?>
																</select>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<select name="CBOSUBJECT" id="subject"class="form-select" onChange="getsubject()" required>
																	<option value="0" disabled selected>Select Subject*</option>
																	<?php
																		$query_subject_id = "select vTutorId,vSubjectId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
																		//echo "<script language='JavaScript'>var subject = [];";
																		$result_subject_id = runquery($query_subject_id);
																		$nos = 0;
																		if($result_subject_id){
																			$nos = mysqli_num_rows($result_subject_id);
																		}
																		if($nos>0){
																			$i =0;
																			while($result_subject = mysqli_fetch_array($result_subject_id)){
																				$tutor_id=explode(',',$result_subject['vTutorId']);
																				$subject_id=explode(',',$result_subject['vSubjectId']);
																				for($k=0;$k<count($tutor_id);$k++){
																						$sqlsubject = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$subject_id[$k];
																						$rssubject = runquery($sqlsubject);
																						$num = $rssubject ? mysqli_num_rows($rssubject) : 0 ;
																						if ($num > 0 ){
																							while($rssubjectname = mysqli_fetch_array($rssubject)){
																								//echo "subject[".$i."]= new Array(2);";
																								//echo "subject[".$i."][0]= ".$tutor_id[$k].";";
																								//echo "subject[".$i."][1]= ".$subject_id[$k].";";
																								//echo "subject[".$i."][2]= '".$rssubjectname['vSubjectName']."';";
																								echo "<option value=".$subject_id[$k].">".$rssubjectname['vSubjectName']."</option>";

																							}
																						}
																						$i = $i + 1;
																				}
																			}
																		}else{
																			echo "<option value='No Subject' selected>No Subject Exists For Selection</option>";
																		}
																		//echo "</script>";
																	?>
																</select>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<label for="entrydate">Date of Entry</label>
																<input type="text" id="entrydate" class="form-control" name="TXENTRYDATE" value="<?php echo date("d/m/Y"); ?>" readonly>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<textarea id="area" class="form-control" name="TAAREACOVERED" placeholder="Area Covered..."></textarea>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<textarea id="skill" class="form-control" name="TASKILLACHIEVED" placeholder="Skill Achieved..."></textarea>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<textarea id="problem" class="form-control" name="TAPROBLEMSENCOUNTERED" placeholder="Problem Encountered..."></textarea>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<div class="form-check form-switch">
																	<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="ISSATISFIED" onclick="getdisable(this);">
																	<label class="form-check-label" for="flexSwitchCheckChecked">Was the subject taught to your satisfaction ?</label>
																</div>
																<textarea id="satisfaction" class="form-control" name="TASUGGESTION" placeholder="If no please explain below why and how you think we can improve the course ?" disabled></textarea>
															</div>
														</div>
														<div class="col-12 d-flex justify-content-end">
															<button type="submit" class="btn btn-primary me-1 mb-1" name="addlog">Submit</button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
									<?php } else{ 
										$tutor_id = $_POST['CBOTUTOR'];
										$subject = clean_string($_POST['CBOSUBJECT']);
										$area_covered = clean_string($_POST['TAAREACOVERED']);
										$skill_achieved = clean_string($_POST['TASKILLACHIEVED']);
										$problem_encounter = clean_string($_POST['TAPROBLEMSENCOUNTERED']);
										$is_satisfied = $_POST['ISSATISFIED'];
										if($is_satisfied)
										{
											$suggestion = "";						
										}
										else
										{
											$suggestion = clean_string($_POST['TASUGGESTION']);
										}

										$edate = explode('/',$_POST['TXENTRYDATE']);
										$entry_date = $edate[2].'-'.$edate[1].'-'.$edate[0];
										$insert_studentlog="insert into cpo_studentlogbook(iStudentId,iTutorId,dEntryDate,iSubjectId,vAreaCovered,vSkillAchieved,vProblemEncounter,iIsSatisfied,vSuggestion) values (".$user_id.",".$tutor_id.",'".$entry_date."','".$subject."','".$area_covered."','".$skill_achieved."','".$problem_encounter."',".$is_satisfied.",'".$suggestion."')";
										runquery($insert_studentlog);

										$msg = "Your Log Book information has been submitted successfully.";
										$color = "black";
										if (isset($_GET['logout']) && $_GET['logout'] == "yes"){											
											$_SESSION['log_fill']=1;
											$newbtn = "<a href='javascript:logout()' class='btn btn-secondary me-1 mb-1 mt-4'>Sign Out Now</a>";
										}else{
											$newbtn = "<a href='student-log-form' class='btn btn-secondary me-1 mb-1 mt-4'>Back to Learner Log Book</a>";
										}
										addlog(13);	
									?>
									</div>
									<div class="card-content">
										<div class="card-body text-center">
											<h6><?php echo $msg ?></h6><?php echo $newbtn ?>
										</div>
									</div>
									<?php } ?>

								</div>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>
	<script>
		function clean_string($str){
			$str = htmlspecialchars(str_replace("\'", "'", trim($str)));
			$str = rtrim($str);	
			$str = str_replace("'", "\'", $str);
			return $str;
		}

		var myvar = 1;

		function getsubject(){
			var selindex = document.FRMSTUDENTLOGBOOK.tutor.selectedIndex;
			var selmake = document.FRMSTUDENTLOGBOOK.tutor.options[selindex].value;
			document.FRMSTUDENTLOGBOOK.subject.options.length = 0;
			document.FRMSTUDENTLOGBOOK.subject.options[0] = new  Option("Select Subject","");
			var k = 1;
			for(var j = 0; j<subject.length; j++){
				if (subject[j][0] == selmake){
					document.FRMSTUDENTLOGBOOK.subject.options[k] = new Option(subject[j][2],subject[j][1] );
					k++;
				}
			}
		}

		function getdisable(obj){
			if(obj.checked == true){
				myvar = 0;
				document.getElementById("satisfaction").disabled=false;
			}
			else{
				myvar = 1;
				document.getElementById("satisfaction").value="";
				document.getElementById("satisfaction").disabled=true;
			}
		}

		function validation(){
			if (document.FRMSTUDENTLOGBOOK.tutor.value == ""){	
				alert("Please select your tutor");
				document.FRMSTUDENTLOGBOOK.tutor.focus();
				return false;
			}
			if (document.FRMSTUDENTLOGBOOK.subject.value == ""){	
				alert("Please select your subject");
				document.FRMSTUDENTLOGBOOK.subject.focus();
				return false;
			}
			if (myvar == 0){	
				if(document.FRMSTUDENTLOGBOOK.satisfaction.value=="")
				{
					alert("Please enter your suggestion");
					document.FRMSTUDENTLOGBOOK.satisfaction.focus();
					return false;
				}
			}
			document.FRMSTUDENTLOGBOOK.ISSATISFIED.value=myvar;
			return true;	
		}
	</script>
</body>

</html>