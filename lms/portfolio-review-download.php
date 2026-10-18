<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Download Learning Review<?php echo sitename; ?></title>
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
								<h5 class="mb-4">Learning Review Center</h5>															
								<div class="row">
									<div class="col-md-6">
										<div class="card frm-border">											
											<div class="card-content">
												<div class="card-body">													
													<div class="table-responsive">	
														<h6>Download Progress Report</h6>
														<p class="text-sm text-danger">You have been assign review plan from the following tutors. Click on link to download review plan</p>
														<table class="table table-hover mb-0">
															<thead class="dark">
																<tr>
																	<th>Tutor Name</th>
																	<th>Assigned Date</th>
																</tr>
															</thead>
															<tbody>	
																<?php	
																	//$query_tutor_id = "select iTutorId,dDate from cpo_ind_review where iStudentId ='".$_SESSION['user_id']."' and iflag=1";
                                                                    $query_files = "select * from cpo_uploadfilestutor where iUserId='".$_SESSION['user_id']."' and file_type='portfolio_upload' order by vUploadDate desc";
                                                                    //echo $query_files ;
																	$result_files = runquery($query_files);
																	$nos = 0;
																	if($result_files){
																		$nos = mysqli_num_rows($result_files);
																	}
																	if($nos>0){
																	while($result_file = mysqli_fetch_array($result_files)){ 
																		$date=$result_file['vUploadDate'];
																		$ans=explode("-",$date);
																		$query_tutor_info = "select vUserName from cpo_usermaster where iUserId=".$result_file['iTutorId']."";
																		$result_tutor_info = runquery($query_tutor_info);
																		$nos = 0;
																		if($result_tutor_info){
																			$nos = mysqli_num_rows($result_tutor_info);
																		}
																		if($nos>0){  
																			$result_tutor_info=mysqli_fetch_array($result_tutor_info);
																			//echo "<tr><td><a target='_blank' href='./uploads/32.doc'>".$result_tutor_info['vUserName']."</a></td><td>".$ans[2]."/".$ans[1]."/".$ans[0]."</td></tr>";
                                                                            echo "<tr><td><a target='_blank' href='../../app/tms/upload/".$result_file['iTutorId']."/".$result_file['vFilePath']."'>".$result_tutor_info['vUserName']."</a></td><td>".$ans[2]."/".$ans[1]."/".$ans[0]."</td></tr>";
																			}									
																		}
																	}
																	else{
																		echo "<tr><td colspan='2'><p class='font-bold text-mute mb-0'>No file uploaded.</p></td></tr>";
																	}
																?>																
															</tbody>
														</table>
													</div>													
												</div>
											</div>
										</div>
									</div>
									<?php
                                    /*<div class="col-md-6">
										<div class="card frm-border">											
											<div class="card-content">
												<div class="card-body">													
													<div class="table-responsive">	
														<h6>Download Learning Review changed by Tutor</h6>
														<p class="text-sm text-danger">The Following tutors have made changes to your review and submitted to you. Click on link to download review plan</p>
														<table class="table table-hover mb-0">
															<thead class="dark">
																<tr>
																	<th>Tutor Name</th>
																	<th>Changes Date</th>
																</tr>
															</thead>
															<tbody>	
																<?php
																	$query_tutor_id = "select iTutorId,dDate,iIndId from cpo_ind_review where iStudentId ='".$_SESSION['user_id']."' and iflag=1 and iComplete=1";
																	$result_tutor_id = runquery($query_tutor_id);
																	$nos = 0;
																	if($result_tutor_id){
																		$nos = mysqli_num_rows($result_tutor_id);
																	}
																	if($nos>0){
																		while($result_tutor = mysqli_fetch_array($result_tutor_id)){ 
																			$date=$result_tutor['dDate'];
																			$ans=explode("-",$date);
																			$query_tutor_info = "select vUserName from cpo_usermaster where iUserId=".$result_tutor['iTutorId']."";
																			$result_tutor_info = runquery($query_tutor_info);
																			$nos = 0;
																		if($result_tutor_info){
																			$nos = mysqli_num_rows($result_tutor_info);
																		}
																		if($nos>0){  
																			$result_tutor_info=mysqli_fetch_array($result_tutor_info);
																			echo "<tr><td><a target='_blank' href='uploads/review/".$result_tutor['iIndId'].".doc'>".$result_tutor_info['vUserName']."</a></td><td>".$ans[2]."/".$ans[1]."/".$ans[0]."</td></tr>";
																			}									
																		}
																	}
																	else{
																		echo "<tr><td colspan='2'><p class='font-bold text-mute mb-0'>No Learning Review changes available.</p></td></tr>";
																	}
																?>																
															</tbody>
														</table>
													</div>													
												</div>
											</div>
										</div>
									</div>*/
                                    ?>
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
		function downloadfile(){
			fname = "Individual_Learning_Plan_Review.doc";
		//	new1=window.open("../download.php?id="+fname,"","titlebar='CareerPaths Online - Chatting","menubar=1,height=475,width=775,scrollbars=yes,top=50 left=150");
			new1=window.open("../download.php?id="+fname);
		}
	</script>
</body>

</html>