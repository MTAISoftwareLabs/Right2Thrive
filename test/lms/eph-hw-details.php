<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Homework - Detail View<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<body>
	<?php
		if(isset($_GET['id'])){
			$sqlselect="select * from cpo_homework where I_homeworkid =".$_GET['id'];
			$result_info=runquery($sqlselect);
			$num = $result_info ? mysqli_num_rows($result_info) : 0;
			$ftid = ""; $ftsbn = ""; $ftun = "";
			if($num > 0){
				$result_info = mysqli_fetch_array($result_info);
				//get subject and tutor anem
				$sql_us = "select sb.iSubjectId, um.iUserId, us.I_studentid, um.vUserName, sb.vSubjectName from cpo_user_subject as us, cpo_subjectmaster as sb, cpo_usermaster as um  where us.I_user_subid =".$result_info['I_user_subjectid']." and us.I_tutorid = um.iUserId  and sb.iSubjectId = us.I_subjectid";
				$res_us = runquery1($sql_us);
				$fet_us = mysqli_fetch_array($res_us);
				$ftid = $fet_us['iSubjectId'];
				$ftsbn = $fet_us['vSubjectName'];
				$ftun = $fet_us['vUserName'];
				//check from cpo_user_leason
			}
		}
	?>	
	<div id="app">
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="row mt-4 mb-4" style="border-bottom:solid 2px gray;">
						<div class="col-sm-6"><h4>My Digital Future <span class="small text-danger d-block" style="font-size:14px; font-weight:600">Homework Detail View<span></span></span></h4></div>
						<div class="col-sm-6 text-right">
							<a class="print" href="javascript:print();"><i class="fa fa-print" aria-hidden="true"></i> Print this page</a><br/>
							<a class="text-danger" href="javascript:window.close();"><i class="fa fa-close" aria-hidden="true"></i> Close</a>
						</div>
					</div>
					<div class="table-responsive">
						<?php							
							if(isset($_GET['id'])){
								$sqlselect="select * from cpo_homework where I_homeworkid =".$_GET['id'];
								$result_info=runquery($sqlselect);
								$num = $result_info ? mysqli_num_rows($result_info) : 0;
								$ftid = ""; $ftsbn = ""; $ftun = "";
								if($num > 0){
									$result_info = mysqli_fetch_array($result_info);
									//get subject and tutor anem
									$sql_us = "select sb.iSubjectId, um.iUserId, us.I_studentid, um.vUserName, sb.vSubjectName from cpo_user_subject as us, cpo_subjectmaster as sb, cpo_usermaster as um  where us.I_user_subid =".$result_info['I_user_subjectid']." and us.I_tutorid = um.iUserId  and sb.iSubjectId = us.I_subjectid";
									$res_us = runquery1($sql_us);
									$fet_us = mysqli_fetch_array($res_us);
									$ftid = $fet_us['iSubjectId'];
									$ftsbn = $fet_us['vSubjectName'];
									$ftun = $fet_us['vUserName'];
									//check from cpo_user_leason
								}
							}
						?>
						<table class='table table-hover mb-0 bg-light'>
							<tbody border>
								<tr><th>Subject Name</th><td><?php echo ucfirst($ftsbn); ?></td></tr>
								<tr><th>Tutor Name</th><td><?php echo ucfirst($ftun); ?></td></tr>
								<tr><th>Homework Title</th><td><?php echo ucfirst($result_info['V_title']); ?></td></tr>
								<tr><th>Assign Date</th><td><?php echo gdate($result_info['D_assign_date']); ?></td></tr>
								<tr><th>Due Date</th><td><?php echo gdate($result_info['D_due_date']); ?></td></tr>
								<tr><th>Completed</th><td><?php echo $result_info['C_Completed']; ?></td></tr>
								<?php 
									if( $result_info['C_Completed'] == 'No') {
										if($result_info['T_whynot_reason'] == ''){ 
											$comm = "No Reason Provided Yet.";
										}else{
											$comm = $result_info['T_whynot_reason'];
										}
										echo "<tr><td colspan='2'><p class='font-bold mb-0'>Reason for not completing?</p><p>$comm</p></td></tr>";
									} 
								?>
							</tbody>
						</table>
					</div>
					<div class="row">
						<form action="eph-hw-details?id=<?php echo $_GET['id']; ?>" method="post">
							<div class="form-group mt-4 mb-3">
								<label>Add or Update Learner Comments</label>
								<textarea class="form-control" name="txttcomments"	 rows="3" required><?php echo $result_info['T_Summary']; ?></textarea>
								<?php							
									if(isset($_POST['submit'])){
										$comment = $_POST['txttcomments'];
										$insql = "update cpo_homework set T_Summary ='".$comment."' where I_homeworkid =".$_GET['id'];
										$ininfo=runquery($insql);
										if($ininfo){
											echo "<p class='text-success'>Comment saved successfully.</p>";
										}else{
											echo "<p class='text-danger'>Sorry comment cannot be inserted</p>";
										}
									}
								?>
							</div>
							<div class="form-group mb-3 text-right">
								<button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
							</div>
						</form>
					</div>
					<div class="row">
						<div class="col-sm-12 mb-4">
							<p class="font-bold">Tutor Comments</p>
							<p class="mb-0"><?php if($result_info['T_Feedback'] == ''){ echo "No Comment."; }else{ echo $result_info['T_Feedback'] ; } ?></p>
						</div>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</div>
</body>
</html>