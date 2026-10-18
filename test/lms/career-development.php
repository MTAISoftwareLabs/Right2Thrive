<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Career Development<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Carrer Development</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">					
						<div class="row">
                            <div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Interactive Course</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-lg">
												<?php
													$sql="select uc.* from cpo_usercourse uc,cpo_coursemaster cm where cm.iCourseId=uc.iCourseId and uc.vTutorId<>'' and uc.iUserId=$user_id order by cm.iCourseOrder";
													$rID=runquery1( $sql); $count = mysqli_num_rows($rID); $sr=1;
													if($count>0){
														while($rslist=mysqli_fetch_array($rID)) {
															$sql1="select vCourseName from cpo_coursemaster where iCourseId = '".$rslist["iCourseId"]."' order by iCourseOrder";
															$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
															$num = $result1 ? mysqli_num_rows($result1) : 0;
															$cname = "";
															if ($num > 0){
																$name=mysqli_result($result1,0,0); 
																$cname =  $sr."-   ".$name; 
															}
															echo "<tr><th>Course Name</th><td>$cname</td></tr><tr><th colspan='2'>Subjects</th></tr>";

															$sql1="select vSubjectID from cpo_subjectincourse where iCourseID = '".$rslist["iCourseId"]."'";
															$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
															$num = $result1 ? mysqli_num_rows($result1) : 0;
															if ($num > 0){
																$name=mysqli_result($result1,0,0);
																$id=explode(",", $name);
																for($i=0;$i<count($id);$i++) {
																	$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$id[$i]."";
																	$result2=runquery1($sql2);
																	$num = $result2 ? mysqli_num_rows($result2) : 0;
																	if ($num > 0) {
																		$name=mysqli_fetch_array($result2);
																		echo "<tr><td>$name[1]</td><td><a href='javascript:previewflash('".$name[0]."')' class='btn btn-outline-info'><i class='fa fa-leanpub'></i> >Start Tutorial</a></td></tr>";
																	}
																}
															}
														$sr=$sr+1;
														}
													}else{
														echo "<tr><td>No interactive courses found for you.</td></tr>";
													}

													$sql1="select i_subjectid from cpo_student_interact where i_studentid = '".$user_id."' and i_active=1" ;
													$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
													$num = $result1 ? mysqli_num_rows($result1) : 0;
													if ($num > 0){
														echo "<tr><th colspan='2'>Additional Subjects</td></tr>";
														for($i=0;$i<$num;$i++){
															$thisid = mysqli_result($result1,$i,"i_subjectid") ;
															$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$thisid;
															//echo $sql2;
															$result2=runquery1($sql2);
															$name=mysqli_fetch_array($result2);													
															echo "<tr><td>$name[1]</td><td><a href='javascript:previewflash('".$name[0]."')' class='btn btn-outline-info'><i class='fa fa-leanpub'></i> >Start Tutorial</a></td></tr>";													
														}
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
</body>

</html>