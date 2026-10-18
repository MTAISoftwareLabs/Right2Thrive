<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Learner Log Book - Detail View<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<body>
	<div id="app">
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="row mt-4 mb-4" style="border-bottom:solid 2px gray;">
						<div class="col-sm-6"><h4>My Digital Future <span class="small text-danger d-block" style="font-size:14px; font-weight:600">Log Book Detail View</span></h4></div>
						<div class="col-sm-6 text-right">
							<a class="print" href="javascript:print();"><i class="fa fa-print" aria-hidden="true"></i> Print this page</a><br/>
							<a class="text-danger" href="javascript:window.close();"><i class="fa fa-close" aria-hidden="true"></i> Close</a>
						</div>
					</div>
					<div class="table-responsive">
						<?php
							if(isset($_GET['id'])){
								$sqlselect="select s.iLogId,t.vUserName,s.dEntryDate,s.vAreaCovered,s.vSkillAchieved,s.vProblemEncounter,s.vSuggestion,s.iIsSatisfied,sm.vSubjectName from cpo_studentlogbook s,cpo_usermaster t,cpo_subjectmaster sm where s.iTutorId = t.iUserId and s.iSubjectId = sm.iSubjectId and s.iLogId=".$_GET['id'];
								$result_info=runquery($sqlselect);
								$num = $result_info ? mysqli_num_rows($result_info) : 0;
								if($num > 0){
									$result_info = mysqli_fetch_array($result_info);
									addlog(14);
						?>
						<form name="frmreport" method="post" action="" onsubmit="return validate();">
							<input type="hidden" name="hdn_submit" value="1">
							<table>
								<tr> 
									<th>Tutor's Name</th>
									<td><?php echo $result_info['vUserName']; ?></td>
								</tr>
								<tr> 
									<th>Subject</th>
									<td><?php echo $result_info['vSubjectName']; ?></td>
								</tr>
								<tr> 
									<th>Date of Entry</th>
									<td><?php echo gdate($result_info['dEntryDate']); ?></td>
								</tr>
								<tr> 
									<th colspan="2">Area Covered</th>
								</tr>
								<tr> 
									<td colspan="2"><?php echo $result_info['vAreaCovered']; ?></th>
								</tr>
								<tr> 
									<th colspan="2">Skill Achieved</th>
								</tr>
								<tr> 
									<th colspan="2"><?php echo $result_info['vSkillAchieved']; ?>
									</th>
								</tr>
								<tr> 
									<th colspan="2">Problems Encountered</th>
								</tr>
								<tr> 
									<td colspan="2"><?php echo $result_info['vProblemEncounter']; ?></td>
								</tr>
								<tr> 
									<th colspan="2">Was the subject taught to your satisfaction ?</th>
								</tr>
								<tr> 
									<th colspan="2"><?php if($result_info['iIsSatisfied']){ echo 'Yes'; }else{ echo 'No'; } ?>
									</th>
								</tr>
								<tr> 
									<th colspan="2">If no please explain below why and how you think we can improve the course?</th>
								</tr>
								<tr> 
									<td colspan="2"><?php echo $result_info['vSuggestion']; ?></td>
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