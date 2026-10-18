<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include "dbConnection.php"; ?>
		<title>Upload Learning Review<?php echo sitename; ?></title>
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
					<section class="row">
						<div class="col-12">
							<div class="tab-content card-header">
								<div class="tab-pane fade active show" id="uploadphoto" role="tabpanel" aria-labelledby="uploadphoto-tab">
									<div class="row">
										<div class="col-md-3">
										</div>
										<div class="col-md-6">
											<div class="card shadow mt-4">
												<div class="card-content">
													<div class="card-body text-center">
														<h5 class="mb-4">Upload Care Plan</h5>
														<?php
															if (isset($_POST['addreview']))
															{
																$sqlid = "SELECT * FROM cpo_ind_review WHERE iStudentId = " . $_SESSION['user_id'];
																$rsid = runquery($sqlid);
																$numid = $rsid ? mysqli_num_rows($rsid) : 0;
																if ($numid > 0) {
																	$rs = mysqli_fetch_array($rsid);
																}
																$allowedTypes = array('application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
																$fileType = $_FILES['TXUPFILE']['type'];
																if (in_array($fileType, $allowedTypes)) {
																	$uploaddir = "./uploads/";
																	if (!file_exists($uploaddir)) {
																		mkdir($uploaddir, 0755, true);
																	}
																	// var_dump($rs['iIndId']);
																	// exit;
																	// Insert the data into the database
																	$sqlInsert = "INSERT INTO cpo_ind_review (iStudentId, iTutorId, iflag, dDate, file_type) VALUES (" . $_SESSION['user_id'] . ", " . $_POST['CBOSTUDENT'] . ", 0, '" . date('Y/m/d') . "', 'portfolio_upload')";
																	runquery($sqlInsert);
																	$lastInsertedId = mysqli_insert_id($conn);
																	$userfile_tmp = $_FILES['TXUPFILE']['tmp_name'];
																	$newfile = $uploaddir . $lastInsertedId . ".doc";
																	move_uploaded_file($userfile_tmp, $newfile);
																	$sqlup = "UPDATE cpo_ind_review SET iflag = 0, dDate = '" . date('Y/m/d') . "', file_name='".$lastInsertedId.".doc' WHERE iIndId = " . $lastInsertedId;
																	runquery($sqlup);
																	$msg = "Your file was uploaded successfully.";
																	echo "<div class='alert alert-danger' role='alert'>Your file was uploaded successfully</div>";
																	addlog(18);
																}
																else {
																	$msg = "<div class='alert alert-success text-center' role='alert'>You can only upload MS-Word files.</div>";
																	echo "<div class='alert alert-danger' role='alert'>You can only upload MS-Word files.</div>";
																}
															}
															$query_tutor_id = "SELECT iTutorId FROM cpo_ind_review WHERE iStudentId = " . $_SESSION['user_id'] . " AND iflag = 0";
															$result_tutor_id = runquery($query_tutor_id);
															$nos = 0;
															if ($result_tutor_id) {
																$nos = mysqli_num_rows($result_tutor_id);
															}
															$formsts = "";
															if ($nos == 0) {
																$formsts = "";
																echo "<div class='alert alert-danger' role='alert'>No Learning Review Assign.</div>";
															}
														?>
														<form class="" name="FRMUPLOADPLAN" method="post" action="" enctype="multipart/form-data">
															<fieldset class="form-group" <?php echo $formsts ?>>
																<select name="CBOSTUDENT" class="form-select" id="tutor">
																	<option value="" selected>Select Tutor </option>
																	<?php
																		$query_tutor_id = "select I_tutorid from cpo_user_subject where I_studentid='".$_SESSION['user_id']."' ";
																		$result_tutor_id = runquery($query_tutor_id);

																		$nos = 0;
																		if($result_tutor_id){
																			$nos = mysqli_num_rows($result_tutor_id);
																		}
																		if($nos>0){
																			$tutor_ids='';
																			$result_tutor = mysqli_fetch_array($result_tutor_id);
																			$str_tutor_id=$result_tutor['I_tutorid'];
																			$tutor_ids= $str_tutor_id;
																			if($tutor_ids<>''){
																				$query_tutor_info = "select iUserId,vUserName from cpo_usermaster ";
																				$result_tutor_info = runquery($query_tutor_info);
																				$nos = 0;
																				if($result_tutor_info){
																					$nos = mysqli_num_rows($result_tutor_info);
																				}
																				if($nos>0){
																					while($result_tutor = mysqli_fetch_array($result_tutor_info)){
																						$isseleted = "";
																						if(isset($_POST['CBOSTUDENT']) && $_POST['CBOSTUDENT'] == $result_tutor['iUserId'] ){
																							$isseleted = "selected";
																						}
																						echo "<option value=".$result_tutor['iUserId']." $isseleted>".$result_tutor['vUserName']."</option>";
																					}
																				}
																			}
																		}
																	?>
																</select>
															</fieldset>
															<fieldset class="form-group" id="sfile">
																<div class="input-group">
																	<input type="file" name="TXUPFILE" class="form-control"    required>
																	<button class="btn btn-primary" type="submit" id="inputGroupFileAddon04" name="addreview">Upload</button>
																</div>
																<p class="small mt-1 text-primary">Only upload <span class="text-danger">.docx</span> documents.</p>
															</fieldset>
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
			/*$(document).ready(function(){
				$("#sfile").attr("disabled", true);
				$("#tutor").change(function(){
					if($("#tutor").val() !== ""){
						$("#sfile").attr("disabled", false);
					}
					else{
						$("#sfile").attr("disabled", true);
					}
				});
			});*/
		</script>
	</body>
</html>