<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Monthly Progress Report - Detail View<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<body>
<?php
	if(isset($_POST['hdn_submit']) && $_POST['hdn_submit'] == 1){
		$text = $_POST['tacomments'];
		$insql = "update cpo_progressreport set T_scomments='".$text."' where I_progressid=".$_GET['id'];
		$ininfo=runquery($insql);
		if($ininfo){
			echo "<script language='javascript'> window.close(); </script>";
		}else{
			$msg = "<p class='text-danger'>Sorry comment cannot be inserted</p>";
		}
	}
?>
	<div id="app">
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="row mt-4 mb-4" style="border-bottom:solid 2px gray;">
						<div class="col-sm-6"><h4>My Digital Future <span class="small text-danger d-block" style="font-size:14px; font-weight:600">Progress Detail View</span></h4></div>
						<div class="col-sm-6 text-right">
							<a class="print" href="javascript:print();"><i class="fa fa-print" aria-hidden="true"></i> Print this page</a><br/>
							<a class="text-danger" href="javascript:window.close();"><i class="fa fa-close" aria-hidden="true"></i> Close</a>
						</div>
					</div>
					<div class="table-responsive">
						<?php
							if(isset($_GET['id'])){
								$sqlselect="select * from cpo_progressreport where I_progressid=".$_GET['id'];
								$result_info=runquery($sqlselect);
								$num = $result_info ? mysqli_num_rows($result_info) : 0;
								if($num > 0){
									$result_info = mysqli_fetch_array($result_info);
						?>
						<form name="frmreport" method="post" action="" onsubmit="return validate();">
							<input type="hidden" name="hdn_submit" value="1">
							<table>
							  <?php 
								  if(isset($msg) && $msg !=="") {
									echo "<tr><td colspan='2'>$msg</font></td></tr>";
								  }
							  ?>
								<tr> 
									<th>Learner Name</th>
									<td>
										<?php
											$fetchname="select * from cpo_usermaster where iUserId=".$result_info['I_userid'];
											$resultfetchname=runquery1($fetchname);
											$name=mysqli_result($resultfetchname,0,1);
											echo $name; 
										?>
									</td>
								</tr>
								<tr> 
									<th>Tutor's Name</th>
									<td>
										<?php 
											$fetchtut="select * from cpo_usermaster where iUserId=".$result_info['I_tutorid'];
											$resultfetchtut=runquery1($fetchtut);
											$tut=mysqli_result($resultfetchtut,0,1);
											echo $tut;
										?>
									</td>
								</tr>
								<tr> 
									<th>Subject</th>
									<td>
										<?php 
											$fetchsub="select vSubjectName from cpo_subjectmaster where iSubjectId=".$result_info['I_subjectId'];
											$resultfetchsub=runquery1($fetchsub);
											$sub=mysqli_fetch_array($resultfetchsub);
											echo $sub['vSubjectName'];
										?>
									</td>
								</tr>
								<tr> 
									<th>Month / Year</th>
									<td><?php echo $result_info['I_month']."/".$result_info['I_year']; ?></td>
								</tr>
								<tr> 
									<th colspan="2">Tutor Comments</th>
								</tr>
								<tr> 
									<td colspan="2"><?php echo $result_info['T_tcomments']; ?></th>
								</tr>
								<tr> 
									<th colspan="2">Learner Comments <span class="small">(Once entered, could not be changed)<span></th>
								</tr>
								<tr> 
									<th colspan="2">
										<?php 
											if($result_info['T_scomments'] !=''){ 
												echo $result_info['T_scomments']; 
											}else{
											?> 
												<textarea name="tacomments" rows="3">
											<?php 
												echo $result_info['T_scomments']; 
											?>
											</textarea>
											<?php 
											}
										?>
									</th>
								</tr>
								<tr> 
									<th colspan="2">Parent Comments</th>
								</tr>
								<tr> 
									<td colspan="2"><?php echo $result_info['T_pcomments']; ?></td>
								</tr>
							</table>
						</form>
						<?php
								}else{ echo "<p class='text-danger text-center font-bold'>Details are not exists.</p>"; }
							}else{echo "<p class='text-danger text-center font-bold'>Sorry, Invalid Request!!</p>"; }
						?>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</div>
	<script>
		function validate(){
			if(document.frmreport.tacomments.value == ''){
				alert('Please enter your comments');
				document.frmreport.tacomments.focus();
				return false;
			}
		}
	</script>
</body>
</html>
