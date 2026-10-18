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
?>
<html>
<head>
<title><?php echo sitename;?>Job Suggestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function disdesc()
{
  if (document.FRMSUGGESTJOB.CBOJOB.value != "")
  {
    window.open("job.php?id="+document.FRMSUGGESTJOB.CBOJOB.value,null,"width=800,height=600,scrollbars=yes");
  }
}
function validation()
{
	if (document.FRMSUGGESTJOB.CBOSTUDENT.value == "")
	{	
		alert("Please select student");
		document.FRMSUGGESTJOB.CBOSTUDENT.focus();
		return false;
	}
	if (document.FRMSUGGESTJOB.CBOJOB.value == "")
	{	
		alert("Please select jot");
		document.FRMSUGGESTJOB.CBOJOB.focus();
		return false;
	}
	return true;	
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['FRMSUGGESTJOB'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc">
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMSUGGESTJOB" method="post" action="SuggestJob.php?next=1" onSubmit="return validation();">
			<?php
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Job Suggestion</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
					<tr><td height="10" colspan="2" class="bodytext" align="right">All (<font color="red">*</font>) mark are compulsory fields</td></tr>
					<tr>
							<td class="bodytext" height="32">Select Learner</td>
							<td class="bodytext">&nbsp;<select name="CBOSTUDENT" class="textbox">
							<option value="" selected>Select Learner</option>
							<?php
							//$query_tutor_id = "select iUserId from cpo_usercourse where iUserId<>0 and vTutorId = ".$user_id;
							$query_tutor_id = "select distinct iUserId from cpo_usercourse where vTutorId like '%".$user_id."%'";
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
							}
							if($nos>0)
							{
								$tutor_ids='';
								while($result_tutor = mysqli_fetch_array($result_tutor_id))
								{
									$str_tutor_id=$result_tutor['iUserId'];

									$tutor_ids= $str_tutor_id;
									if($tutor_ids<>'')
									{								
										$query_tutor_info = "select iUserId,vUserName from cpo_usermaster where iUserId=".$tutor_ids."";
										$result_tutor_info = runquery($query_tutor_info);
										$nos = 0;
										if($result_tutor_info)
										{
											$nos = mysqli_num_rows($result_tutor_info);
										}
										if($nos>0)
										{
											while($result_tutor = mysqli_fetch_array($result_tutor_info))
											{
											?>
												<option value="<?php echo $result_tutor['iUserId'];?>"><?php echo $result_tutor['vUserName'];?></option>	
											<?php
											}									
										}
									}
								}//while end
								
							} // if end
							?>
							</select>&nbsp;<font color="red">*</font></td>
						</tr>
						<?php
						?>
						<tr>
							<td width="41%" height="30" class="bodytext">Select Job</td>
							<td width="59%" class="bodytext">&nbsp;<select name="CBOJOB" class="textbox">
							<option value="" selected>Select Job</option>
							<?php
							$query_job = "select iJobId,vJobTitle from cpo_jobmaster where iStatus='1' AND dDate >='".date('Y-m-d')."'";
							$result_job = runquery($query_job);
							$nos = 0;
							if($result_job)
							{
								$nos = mysqli_num_rows($result_job);
							}
							if($nos>0)
							{
								$tutor_ids='';
								while($result_job_info = mysqli_fetch_array($result_job))
								{
								?>
									<option value="<?php echo $result_job_info['iJobId'];?>"><?php echo $result_job_info['vJobTitle'];?></option>	
								<?php
								}//while end
								
							} // if end
							?>
							</select>&nbsp;<font color="red">*</font>&nbsp;&nbsp;<img src="images/view.gif" onClick="javascript:disdesc()" style="cursor:hand"></td>
						</tr>
						<tr>
							<td width="41%" height="30" class="bodytext">Action Taken</td>
							<td width="59%">&nbsp;<textarea name="TAACTIONTAKEN" class="textbox" rows="4" cols="50"></textarea></td>
						</tr>
						<tr>
							<td width="41%" height="30" class="bodytext">Date of Entry</td>
							<td width="59%">&nbsp;<input name="TXENTRYDATE" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('TXENTRYDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></td>
						</tr>
						<tr>
							<td width="41%" height="30" class="bodytext" valign="top">Outcomes</td>
							<td width="59%">&nbsp;<textarea name="TAOUTCOMES" class="textbox" rows="4" cols="50"></textarea></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }
			  else
			  {
					$student_id = $_POST['CBOSTUDENT'];
					$job_id = $_POST['CBOJOB'];
					$action_taken = $_POST['TAACTIONTAKEN'];
					$date_of_entry = explode('/',$_POST['TXENTRYDATE']);
					$date_of_entry = $date_of_entry[2].'-'.$date_of_entry[1].'-'.$date_of_entry[0];
					$outcomes = clean_string($_POST['TAOUTCOMES']);
					
					$insert_jobinfo="insert into cpo_jobsuggesioninfo(iTutorId,iStudentId,iJobId,vActiontaken,dDateOfEntry,vOutcome) values (".$user_id.",".$student_id.",".$job_id.",'".$action_taken."','".$date_of_entry."','".$outcomes."')";					
					runquery($insert_jobinfo);
					$msg = "Your job suggestion information has been submitted successfully.";
					////////////
					//$fromname = "Auto response system";
					//$fromaddress = "kalpesh@concept.com";
					//$toname = $_SESSION['user_name'];
					//$toaddress = $_SESSION['email_id'];
					//$subject = "Chat time booking in CareerPaths Online";
					//$message ="<html><body><p>Dear ".$_SESSION['user_name'].",</p>";
					//$message .= "<p>Your request has been submited.<br>Once the tutor authorises it you will be notified by E-mail.</p>";
					//$message .= "<p>Warm Regard From,</p>";
					//$message .= "<p>CareerPathOnline Team</p></body></html>";
					//SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
					////////////		
					$color = "black";
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Job Suggestion</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='./'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <?php }
			  ?>
			
			</form></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
