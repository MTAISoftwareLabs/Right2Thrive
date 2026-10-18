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
$q="select * from cpo_usermaster where iUserId='$user_id'";
$r=runquery($q);
if(mysqli_num_rows($r) > 0){																
	$f=mysqli_fetch_array($r);
	$picture=$f['picture'];
	if($picture !== ""){	
		$picarray = explode(',', $picture);
		$proimg = "uploads/".end($picarray);
	}

}	
?>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Dashboard</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card user">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="avatar avatar-xl">
													<img src="<?php echo $proimg; ?>" alt="Face 1">
												</div>
                                            </div>
                                            <div class="col-md-8">                                                
												<h5 class="font-bold username"><?php echo $_SESSION['user_name']; ?></h5>
												<h6 class="text-muted mb-0"><?php echo "MDFS".$_SESSION['user_id']; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="bi bi-door-open-fill"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Login As</h6>
                                                <h6 class="font-extrabold mb-0" id="locationdiv">Student</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="bi bi-calendar3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Date</h6>
                                                <h6 class="font-extrabold mb-0" id="datediv"><?php echo date("d M Y"); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Time</h6>
                                                <h6 class="font-extrabold mb-0" id="timediv"><?php echo date("h:i A"); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Notice Board</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="notice-board">
											<?php 
												$flag = 0; 
												if($flag == 0){ 
													$query = "SELECT * FROM cpo_notice WHERE iUserId='$user_id'";
													$result = runquery1($query) or die("could note execute".mysqli_error($conn));
													$num = $result ? mysqli_num_rows($result) : 0;
													if ($num > 0){
														$res = mysqli_fetch_array($result);
														foreach($result as $row){
															echo "<div class='alert alert-secondary'><i class='bi bi-check-circle'></i> ".$row['notice']."</div>";
															
															//print_r($row); echo "<br/>";
														}												
													}else{
														echo "<p class='font-bold'>Empty Notice Board</h6>";
													}
												}
											?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>						
						<div class="row">
                            <div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>New Information for you</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-lg">
												<?php 
													$flag=0;
													$sqlfiles = "SELECT vUserName,cpo_usermaster.iUserId,cpo_uploadfilestutor.iFileId,vFilePath,vUploadDate FROM cpo_uploadfilestutor,cpo_usermaster,cpo_uploadfilesviewed WHERE cpo_uploadfilesviewed.iFileId=cpo_uploadfilestutor.iFileId AND cpo_uploadfilesviewed.iUserId=".$_SESSION['user_id']." AND cpo_uploadfilestutor.iTutorId=cpo_usermaster.iUserId AND cpo_uploadfilestutor.iUserId LIKE '%".$_SESSION['user_id']."%' ORDER BY vUploadDate DESC";
													$rsfiles = runquery($sqlfiles);
													$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
													if ( $num > 0 ){ 
														$flag=1;
														echo "<thead><tr><th rowspan='3'>Download Files :</th></tr></thead><tbody>";
																
																while($rsresult = mysqli_fetch_array($rsfiles))
																{
																	$path = $rsresult['iUserId']."/".$rsresult['vFilePath'];
																	echo "<tr>
																		<td class='col-4'>
																				<p class='font-bold ms-3 mb-0'><a href='#' onClick='javascript:getnewwin($path,".$rsresult['iFileId'].");'>".$rsresult['vFilePath']."</a></p>
																			</div>
																		</td>
																		<td class='4'>
																			<p class='mb-0'>".gdate($rsresult['vUploadDate'])."</p>
																		</td>
																		<td class='4'>
																			<p class='mb-0'>".$rsresult['vUserName']."</p>
																		</td>
																	</tr>";
																}
														echo "</tbody>";
													}else{
														echo "<thead><tr><th rowspan='3'>No Download Files</th></tr></thead><tbody>";
													}

													$sqlfiles="select js.iJobinfoId,us.vUserName as student,j.vJobTitle as job,js.dDateOfEntry from cpo_jobsuggesioninfo js ,cpo_usermaster us ,cpo_jobmaster j where js.iviewed=0 and js.iTutorId = us.iUserId and js.iJobId=j.iJobId and js.iStudentId=".$user_id;
													$rsfiles = runquery($sqlfiles);
													$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
													if ( $num > 0 ){ 
														$flag=1;
														echo "<thead><tr><th rowspan='3'>Job Suggestion :</th></tr></thead><tbody>";
																
																while($rslist = mysqli_fetch_array($rsfiles))
																{
																	echo "<tr>
																		<td class='col-4'>
																				<p class='font-bold ms-3 mb-0'><a class='sidelink' href='#' onClick='javascript:openwin(".$rslist['iJobinfoId'].")'>". $rslist['job']."</a></p>
																			</div>
																		</td>
																		<td class='4'>
																			<p class='mb-0'><a class='sidelink' href='#' onClick='javascript:openwin(".$rslist['iJobinfoId'].")'>". gdate($rslist['dDateOfEntry'])."</a></p>
																		</td>
																		<td class='4'>
																			<p class='mb-0'><a class='sidelink' href='#' onClick='javascript:openwin(".$rslist['iJobinfoId'].")'>".$rslist['student']."</a></p>
																		</td>
																	</tr>";
																}
														echo "</tbody>";
													}else{
														echo "<thead><tr><th rowspan='3'>No Job Suggestion</th></tr></thead><tbody>";
													}

													$sqlfiles="select cpo_usermaster.vUserName,iTutorId,dDate,iIndId from cpo_ind_plan,cpo_usermaster where cpo_usermaster.iUserId=cpo_ind_plan.iTutorId and iStudentId ='".$_SESSION['user_id']."' and iflag=0";
													$rsfiles = runquery($sqlfiles);
													$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
													if ( $num > 0 ){ 
														$flag=1;
														echo "<thead><tr><th rowspan='3'>Learning Plan :</th></tr></thead><tbody>";
																
																while($result_tutor_info = mysqli_fetch_array($rsfiles))
																{
																	echo "<tr>
																		<td class='col-4'>
																				<p class='font-bold ms-3 mb-0'><a target='_blank' href='../download.php?id=Individual_Learning_Plan.doc'>".$result_tutor_info['vUserName']."</a></p>
																			</div>
																		</td>
																		<td class='4'>
																			<p class='mb-0'>".gdate($result_tutor_info['dDate'])."</p>
																		</td>
																		<td class='4'>
																			
																		</td>
																	</tr>";
																}
														echo "</tbody>";
													}else{
														echo "<thead><tr><th rowspan='3'>No Learning Plan</th></tr></thead><tbody>";
													}

													$sqlfiles="select cpo_usermaster.vUserName,iTutorId,dDate,iIndId from cpo_ind_review,cpo_usermaster where cpo_usermaster.iUserId=cpo_ind_review.iTutorId and iStudentId ='".$_SESSION['user_id']."' and iflag=0";
													$rsfiles = runquery($sqlfiles);
													$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
													if ( $num > 0 ){ 
														$flag=1;
														echo "<thead><tr><th rowspan='3'>Learning Review :</th></tr></thead><tbody>";
																
																while($result_tutor_info = mysqli_fetch_array($rsfiles))
																{
																	$path = $rsresult['iUserId']."/".$rsresult['vFilePath'];
																	echo "<tr>
																		<td class='col-4'>
																				<p class='font-bold ms-3 mb-0'><a  target='_blank' href='../download.php?id=Individual_Learning_Plan_Review.doc'>".$result_tutor_info['vUserName']."</a></p>
																			</div>
																		</td>
																		<td class='4'>
																			<p class='mb-0'>".gdate($result_tutor_info['dDate'])."</p>
																		</td>
																		<td class='4'>
																			
																		</td>
																	</tr>";
																}
														echo "</tbody>";
													}else{
														echo "<thead><tr><th rowspan='3'>No Learning Review</th></tr></thead><tbody>";
													}
												?>
											</table>
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
		function getnewwin(obj,fid){
			new1=window.open("viewdownload?id="+obj+"&fid="+fid);
		}

		function openwin(obj){
			new1=window.open("Detail_SuggestJob?id="+obj,"",'height=500,width=600,scrollbars=yes,top=50 left=150');
			return true;
		}
	</script>
</body>

</html>