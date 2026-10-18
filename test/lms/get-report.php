<?php
	include_once 'dbConnection.php';

	$id = $_GET['id'];
	$sqlmonth="SELECT * FROM cpo_progressreport where I_month =".$id." and I_userid=".$user_id;
	$rID=runquery1($sqlmonth);
	$count = $rID ? mysqli_num_rows($rID) : 0;
?>
<h6 class="text-info text-left">Monthly Progress Report</h6>
<div class="table-responsive text-left">
	<table class='table border mb-4'>
		<thead class='dark'>
			<tr> 
				<th>Tutor Name</td>
				<th>Subject</td>
				<th>View</td>				
			</tr>
		</thead>
		<tbody>
			<?php
				if($count){
					$cnt=1;
					while ($rs = mysqli_fetch_array($rID)){
						$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rs['I_tutorid'];
						$rstutor = runquery($sqltutor);
						
						$rsdata = mysqli_fetch_array($rstutor);
						$tutorname = $rsdata['vUserName'];
						
						$sqls = "select  sb.vSubjectName  from  cpo_progressreport  as  us, cpo_subjectmaster  as sb where  sb.iSubjectId =".$rs['I_subjectId']." and us.I_userid  =".$_SESSION['user_id']." group by us.I_subjectid";
						$querys = runquery1($sqls);
						$fets = mysqli_fetch_array($querys);
						$subject = $fets['vSubjectName'];
						echo "<tr><td>".ucfirst($tutorname)."</a></td><td>".$subject."</td><td><a href='#' onClick='javascript:openreport(".$rs['I_progressid']."'>Click</a></td></tr>";
						$cnt++;
					}
				}else{
					echo "<tr><td colspan='3' class='font-bold'>No Records found.</td></tr>";
				}
			?>
			<tr><td colspan='3' class='text-right'><button class='btn btn-primary btn-sm' onclick='hidevreport()'>Hide</button></td></tr>
		</tbody>
	</table>
</div>