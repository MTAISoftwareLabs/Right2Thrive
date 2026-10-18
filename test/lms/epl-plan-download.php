<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Download Learning Plan<?php echo sitename; ?></title>
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
								<h5 class="mb-4">Learning Plan Center</h5>															
								<div class="row">
									<div class="col-md-6">
										<div class="card frm-border">											
											<div class="card-content">
												<div class="card-body">													
													<div class="table-responsive">	
														<h6>Download Learning Plans</h6>
														<p class="text-sm text-danger">You have been assign plan from the following tutors. Click on link to download review plan</p>
														<table class="table table-hover mb-0">
															<thead class="dark">
																<tr>
																	<th>Tutor Name</th>
																	<th>Assigned Date</th>
																</tr>
															</thead>
															<tbody>	
																<?php
																	$query_tutor_id = "select iTutorId,dDate from cpo_ind_plan where iStudentId ='".$_SESSION['user_id']."' and iflag=0";
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
																		if($nos > 0){  
																			$result_tutor_info=mysqli_fetch_array($result_tutor_info);
																			echo "<tr><td><a target='_blank' href='../download.php?id=Individual_Learning_Plan.doc'>".$result_tutor_info['vUserName']."</a></td><td>".$ans[2]."/".$ans[1]."/".$ans[0]."</td></tr>";
																			}									
																		}
																	}
																	else{
																		echo "<tr><td colspan='2'><p class='font-bold text-mute mb-0'>No Learning Plan assign.</p></td></tr>";
																	}
																?>																
															</tbody>
														</table>
													</div>													
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card frm-border">											
											<div class="card-content">
												<div class="card-body">													
													<div class="table-responsive">	
														<h6>Download Learning Plan changed by Tutor</h6>
														<p class="text-sm text-danger">The Following tutors have made changes to your plan and submitted to you. Click on link to download plan</p>
														<table class="table table-hover mb-0">
															<thead class="dark">
																<tr>
																	<th>Tutor Name</th>
																	<th>Changes Date</th>
																</tr>
															</thead>
															<tbody>	
																<?php
																	$query_tutor_id = "select iTutorId,dDate,iIndId from cpo_ind_plan where iStudentId ='".$_SESSION['user_id']."' and iflag=1 and iComplete=1";
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
																			echo "<tr><td><a target='_blank' href='uploads/plan/".$result_tutor['iIndId'].".doc'>".$result_tutor_info['vUserName']."</a></td><td>".$ans[2]."/".$ans[1]."/".$ans[0]."</td></tr>";
																			}									
																		}
																	}
																	else{
																		echo "<tr><td colspan='2'><p class='font-bold text-mute mb-0'>No Learning Plan changes available.</p></td></tr>";
																	}
																?>															
															</tbody>
														</table>
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
</body>

</html>