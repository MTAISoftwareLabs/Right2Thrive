<?php
	include_once 'dbConnection.php';

	if(!isset($_SESSION['user_id']))
	{
		header("Location:../user_login.php");
	}
	else
	{
		$user_id = $_SESSION['user_id'];
	}

	$id = $_GET['id'];
	$sqlmonth="SELECT * FROM cpo_progressreport where I_month =".$id;
	$rID=runquery1($sqlmonth);
	$count = $rID ? mysqli_num_rows($rID) : 0;
?>
<script language="javascript">
	function submitpage()
	{
		document.frmreport.action = "personaldev.php";
		document.frmreport.submit();
	}
</script>
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center">View Monthly Progress Report</th>
	</tr>
  </thead>
  <tbody>
    <tr>
      <td>
		<table class="table">
			<thead>
				<tr>
					<th scope="col"><strong>Learner Name</strong></th>
					<th scope="col"><strong>Subject</strong></th>
					<th scope="col"><strong>View</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($count)
					{
						$cnt=1;
						while ($rs = mysqli_fetch_array($rID))
						{
							$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rs['I_tutorid'];
							$rstutor = runquery($sqltutor);
							$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
							if ($num1 > 0 )
							{
								$rsdata = mysqli_fetch_array($rstutor);
								$tutorname = $rsdata['vUserName'];
							}
							$sqlstu = "select vUserName from cpo_usermaster where iUserId=".$rs['I_userid'];
							$rsstu = runquery($sqlstu);
							$num1 = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
							if ($num1 > 0 )
							{
								$rsdata = mysqli_fetch_array($rsstu);
								$stuname = $rsdata['vUserName'];
							}
							$sqls = "select  sb.vSubjectName  from  cpo_progressreport  as  us, cpo_subjectmaster  as sb where  sb.iSubjectId =".$rs['I_subjectId']." and us.I_tutorid  =".$_SESSION['user_id']." group by us.I_subjectid";
							$querys = runquery1($sqls);
							$fets = mysqli_fetch_array($querys);
							$subject = $fets['vSubjectName'];
							?>
							<tr> 
								<td><? echo ucfirst($stuname);?></a></td>
								<td><? echo $subject;?></td>
								<td><a  href="#" onClick="javascript:openreport(<? echo $rs['I_progressid'];?>)">Click</a></td>
							</tr>
							<?
							$cnt++;
						}
					}
					else
					{
						?>
						<tr> 
							<td colspan="4"><b>No Records found.</b></td>
						</tr>
						<?
					}
				?>
			</tbody>
		</table>
	  </td>
    </tr>
    <tr>
		<td style="text-align: right;">
			<input type="button" value="Close" onClick="hidevreport();" class="btn btn-secondary" style="cursor:hand; font-weight:bold;" />
		</td>
	</tr>
  </tbody>
</table>