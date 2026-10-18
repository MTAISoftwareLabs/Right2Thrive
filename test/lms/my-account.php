<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>My Account<?php echo sitename; ?></title>
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
								<a class="nav-link active" id="summery-tab" href="my-account" role="tab" aria-controls="summery" aria-selected="true"><i class="fa fa-university" aria-hidden="true"></i> Account Summary</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="information-tab" href="my-ac-personal-information" role="tab" aria-controls="information" aria-selected="false"><i class="fa fa-address-card" aria-hidden="true"></i> Personal Information</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="qualification-tab" href="my-ac-qualification" role="tab" aria-controls="qualification" aria-selected="false"><i class="fa fa-certificate" aria-hidden="true"></i> Qualification</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="uploadphoto-tab" href="my-ac-upload-photo" role="tab" aria-controls="uploadphoto" aria-selected="false"><i class="fa fa-camera" aria-hidden="true"></i> Upload Photo</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="joincourse-tab" href="my-ac-join-course" role="tab" aria-controls="joincourse" aria-selected="false" title="Add to purchase the course"><i class="fa fa-book" aria-hidden="true"></i> Join Course</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="changepassword-tab" href="my-ac-change-password" role="tab" aria-controls="changepassword" aria-selected="false"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="summery" role="tabpanel" aria-labelledby="summery-tab">
								<h5>Account Summery</h5>
								<?php
									$sqlacc = "select uc.* from cpo_usercourse uc,cpo_coursemaster cm where cm.iCourseId=uc.iCourseId and uc.iUserId=".$_SESSION['user_id']." order by cm.iCourseOrder";
									$rsacc = runquery1($sqlacc);
									$num = $rsacc ? mysqli_num_rows($rsacc) : 0 ;
									$cname = ""; $once = 0;
									if ($num > 0 ){ 
										while ($rsdata = mysqli_fetch_array($rsacc))
										{
											$status = explode(",",$rsdata['vSubjectStatus']);
											$sqlcourse = "select vCourseName,iCourseDuration from cpo_coursemaster where iCourseId=".$rsdata['iCourseId'];
											$rscourse = runquery($sqlcourse);
											$num1 = $rscourse ? mysqli_num_rows($rscourse) : 0 ;
											$dur =0;
											if ( $num1 > 0 ){
												$rscs = mysqli_fetch_array($rscourse);
												$cname = $rscs['vCourseName'];
												$dur = $rscs['iCourseDuration'];
												$temp = explode("-",$rsdata['dCourseDate']);
												?>								
												<div class="table-responsive">
														<table class="table table-hover mb-0">
															<thead class="dark">
																<tr>
																	<th>Course Name</th>
																	<th>Start Date</th>
																	<th>End Date</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td class="text-bold-500"><?php echo $cname; ?></td>
																	<td><?php echo substr($temp[2],0,2)."/".$temp[1]."/".$temp[0];?></td>
																	<td><?php echo date("d/m/Y",mktime(0,0,0,($temp[1]+$dur),substr($temp[2],0,2),$temp[0]));?></td>
																</tr>
															</tbody>
														</table>
												</div>
											<?php
											}
											$sqlsubject = "select vSubjectName from cpo_subjectmaster where iSubjectId in (".$rsdata['vSubjectId'].")";
											$rssubject = runquery($sqlsubject);
											$tutorids = explode(",",$rsdata['vTutorId']);
											$tind = 0;
											$num2 = $rssubject ? mysqli_num_rows($rssubject) : 0;
											if ($num2 > 0){?>																			
												<div class="table-responsive">
														<table class="table table-hover mb-0">
															<thead class="dark">
																<tr>
																	<th>Course Name</th>
																	<th>Start Date</th>
																	<th>End Date</th>
																</tr>
															</thead>
															<tbody>																
												<?php
												$ind = 0;	
												while ($rssubjectids = mysqli_fetch_array($rssubject)){
													$sqlusers ="SELECT vUserName FROM cpo_usermaster WHERE iUserId=".$tutorids[$tind];
													//echo $sqlusers;
													$rsusers = runquery($sqlusers);
													$num3 = $rsusers ? mysqli_num_rows($rsusers) : 0;																			
													if ($num3 > 0)
													{
														$rstutor = mysqli_fetch_array($rsusers);
														$tname = $rstutor['vUserName'] ;
													}
													else
													{
														$tname = "";
													}
													?>
													<tr>
													<td class="text-bold-500"><?php echo $rssubjectids['vSubjectName'];?></td>
													<td><?php echo $tname;?></td>
												<?php
													if (count($status) > 0){
														if ($status[$ind] == 1) 
														{
														  echo "<td>Complete</td>";
														}else{
														  echo "<td>In Complete</td>";
														}
													}else{
														echo "<td>In Complete</td>";
													}
													echo "</tr>";
													$tind++; $ind++;			
												} // Inner while loop end											
												echo "</tbody></table></div>";										
											}else{
												echo "<h6 class='text-muted mb-4 mt-4 text-center'>No Tutor Assigned</h6>";
											}	
										$once = 1;
										}	// outer while loop end
									}else{
									echo "<h6 class='text-muted mb-5 mt-5'>No Summary Available</h6>";
								}
								?>
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