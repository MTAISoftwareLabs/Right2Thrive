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

            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="card hub-logbook-card">
									<div class="card-header">
										<h4 class="card-title mb-0">Learner Log Book</h4>
										<?php if (!isset($_POST['addlog'])) { ?>
										<p class="mb-0 mt-2 text-muted small">All (*) mark are compulsory fields</p>
										<?php } ?>
									</div>

									<?php if (!isset($_POST['addlog'])) {
										$islogout = "";
										if (isset($_GET['logout']) && $_GET['logout'] == "yes") {
											$islogout = "?logout=yes";
										}
										$subject_js = array();
									?>
									<div class="card-body">
	<form class="form form-vertical" name="FRMSTUDENTLOGBOOK" method="post" action="student-log-form.php<?php echo $islogout; ?>" onSubmit="return validation();">
												<div class="form-body">
													<div class="row">
														<div class="col-12">
															<div class="form-group">
																<select name="CBOTUTOR" id="tutor" class="form-select" onChange="getsubject()" required aria-label="Select Tutor, required">
																	<option disabled selected value="">Select Tutor*</option>
																	<?php
																		$query_tutor_id = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
																		$result_tutor_id = runquery($query_tutor_id);
																		$nos = 0;
																		if ($result_tutor_id) {
																			$nos = mysqli_num_rows($result_tutor_id);
																		}
																		if ($nos > 0) {
																			$tutor_ids = '';
																			while ($result_tutor = mysqli_fetch_array($result_tutor_id)) {
																				$str_tutor_id = $result_tutor['vTutorId'];
																				$str_tutor_length = strlen($str_tutor_id) - 1;
																				if (substr($str_tutor_id, $str_tutor_length - 1, $str_tutor_length) <> ',') {
																					$str_tutor_id = $result_tutor['vTutorId'].',';
																				}
																				$tutor_ids .= $str_tutor_id;
																			}
																			if ($tutor_ids <> '') {
																				$tutor_ids = substr($tutor_ids, 0, strlen($tutor_ids) - 1);
																				$query_tutor_info = "select iUserId,vUserName from cpo_usermaster where iUserId in (".$tutor_ids.")";
																				$result_tutor_info = runquery($query_tutor_info);
																				$nos = 0;
																				if ($result_tutor_info) {
																					$nos = mysqli_num_rows($result_tutor_info);
																				}
																				if ($nos > 0) {
																					while ($result_tutor = mysqli_fetch_array($result_tutor_info)) {
																						echo "<option value=\"".(int)$result_tutor['iUserId']."\">".htmlspecialchars($result_tutor['vUserName'])."</option>";
																					}
																				}
																			}
																		} else {
																			echo "<option value='No Tutor' selected>No Tutor Exists For Selection</option>";
																		}
																	?>
																</select>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<select name="CBOSUBJECT" id="subject" class="form-select" onChange="getsubject()" required aria-label="Select Subject, required">
																	<option value="" disabled selected>Select Subject*</option>
																	<?php
																		$query_subject_id = "select vTutorId,vSubjectId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
																		$result_subject_id = runquery($query_subject_id);
																		$nos = 0;
																		if ($result_subject_id) {
																			$nos = mysqli_num_rows($result_subject_id);
																		}
																		if ($nos > 0) {
																			while ($result_subject = mysqli_fetch_array($result_subject_id)) {
																				$tutor_id = explode(',', $result_subject['vTutorId']);
																				$subject_id = explode(',', $result_subject['vSubjectId']);
																				for ($k = 0; $k < count($tutor_id); $k++) {
																					if (!isset($subject_id[$k])) {
																						continue;
																					}
																					$sqlsubject = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$subject_id[$k];
																					$rssubject = runquery($sqlsubject);
																					$num = $rssubject ? mysqli_num_rows($rssubject) : 0;
																					if ($num > 0) {
																						while ($rssubjectname = mysqli_fetch_array($rssubject)) {
																							$tid = (int) trim($tutor_id[$k]);
																							$sid = (int) trim($subject_id[$k]);
																							$sname = $rssubjectname['vSubjectName'];
																							$subject_js[] = array($tid, $sid, $sname);
																							echo "<option value=\"".$sid."\">".htmlspecialchars($sname)."</option>";
																						}
																					}
																				}
																			}
																		} else {
																			echo "<option value='No Subject' selected>No Subject Exists For Selection</option>";
																		}
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
																<textarea id="area" class="form-control" name="TAAREACOVERED" rows="4" placeholder="Area Covered..."></textarea>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<textarea id="skill" class="form-control" name="TASKILLACHIEVED" rows="4" placeholder="Skill Achieved..."></textarea>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<textarea id="problem" class="form-control" name="TAPROBLEMSENCOUNTERED" rows="4" placeholder="Problem Encountered..."></textarea>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<input type="hidden" name="ISSATISFIED" id="ISSATISFIED" value="1">
																<div class="form-check form-switch">
																	<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" onclick="getdisable(this);">
																	<label class="form-check-label" for="flexSwitchCheckChecked">Was the subject taught to your satisfaction ?</label>
																</div>
																<textarea id="satisfaction" class="form-control mt-2" name="TASUGGESTION" rows="4" placeholder="If no please explain below why and how you think we can improve the course ?" disabled></textarea>
															</div>
														</div>
														<div class="col-12 d-flex justify-content-end">
															<button type="submit" class="btn btn-primary me-1 mb-1" name="addlog" value="1">Submit</button>
														</div>
													</div>
												</div>
											</form>
											<script>
												var subject = <?php echo json_encode($subject_js, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
											</script>
										</div>
									<?php } else {
										$tutor_id = $_POST['CBOTUTOR'];
										$subject_post = clean_string($_POST['CBOSUBJECT']);
										$area_covered = clean_string($_POST['TAAREACOVERED']);
										$skill_achieved = clean_string($_POST['TASKILLACHIEVED']);
										$problem_encounter = clean_string($_POST['TAPROBLEMSENCOUNTERED']);
										$is_satisfied = isset($_POST['ISSATISFIED']) ? (int) $_POST['ISSATISFIED'] : 1;
										if ($is_satisfied) {
											$suggestion = "";
										} else {
											$suggestion = clean_string($_POST['TASUGGESTION']);
										}

										$edate = explode('/', $_POST['TXENTRYDATE']);
										$entry_date = $edate[2].'-'.$edate[1].'-'.$edate[0];
										$insert_studentlog = "insert into cpo_studentlogbook(iStudentId,iTutorId,dEntryDate,iSubjectId,vAreaCovered,vSkillAchieved,vProblemEncounter,iIsSatisfied,vSuggestion) values (".$user_id.",".$tutor_id.",'".$entry_date."','".$subject_post."','".$area_covered."','".$skill_achieved."','".$problem_encounter."',".$is_satisfied.",'".$suggestion."')";
										runquery($insert_studentlog);

										$msg = "Your Log Book information has been submitted successfully.";
										if (isset($_GET['logout']) && $_GET['logout'] == "yes") {
											$_SESSION['log_fill'] = 1;
											$newbtn = "<a href='javascript:logout()' class='btn btn-secondary me-1 mb-1 mt-4'>Sign Out Now</a>";
										} else {
											$newbtn = "<a href='student-log-form.php' class='btn btn-secondary me-1 mb-1 mt-4'>Back to Learner Log Book</a>";
										}
										addlog(13);
									?>
									<div class="card-body text-center">
	<h6 class="mb-3"><?php echo $msg; ?></h6>
											<?php echo $newbtn; ?>
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
		var myvar = 1;

		function getsubject(){
			if (typeof subject === 'undefined' || !subject.length) {
				return;
			}
			var selindex = document.FRMSTUDENTLOGBOOK.tutor.selectedIndex;
			var selmake = document.FRMSTUDENTLOGBOOK.tutor.options[selindex].value;
			document.FRMSTUDENTLOGBOOK.subject.options.length = 0;
			document.FRMSTUDENTLOGBOOK.subject.options[0] = new Option("Select Subject*", "", true, true);
			document.FRMSTUDENTLOGBOOK.subject.options[0].disabled = true;
			var k = 1;
			for (var j = 0; j < subject.length; j++) {
				if (String(subject[j][0]) === String(selmake)) {
					document.FRMSTUDENTLOGBOOK.subject.options[k] = new Option(subject[j][2], subject[j][1]);
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
			if (document.FRMSTUDENTLOGBOOK.tutor.value === ""){	
				alert("Please select your tutor");
				document.FRMSTUDENTLOGBOOK.tutor.focus();
				return false;
			}
			if (document.FRMSTUDENTLOGBOOK.subject.value === "" || document.FRMSTUDENTLOGBOOK.subject.value === "0"){	
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
			document.getElementById('ISSATISFIED').value = myvar;
			return true;	
		}
	</script>
</body>

</html>
