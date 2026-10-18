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
<title><?php echo sitename;?>Learner Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
var myvar = 1;
function getsubject()
{
	var selindex = document.FRMSTUDENTINFORMATION.CBOSTUDENT.selectedIndex;
	var selmake = document.FRMSTUDENTINFORMATION.CBOSTUDENT.options[selindex].value;
	document.FRMSTUDENTINFORMATION.CBOSUBJECT.options.length = 0;
	document.FRMSTUDENTINFORMATION.CBOSUBJECT.options[0] = new  Option("Select Subject", "" );
	var k = 1;
	for(var j = 0; j<subject.length; j++)
	{
		if (subject[j][0] == selmake)
		{
			document.FRMSTUDENTINFORMATION.CBOSUBJECT.options[k] = new Option(subject[j][2],subject[j][1] );
			k++;
		}
	}
}
function validation()
{
	if (document.FRMSTUDENTINFORMATION.CBOSTUDENT.value == "")
	{	
		alert("Please select student");
		document.FRMSTUDENTINFORMATION.CBOSTUDENT.focus();
		return false;
	}
	if (document.FRMSTUDENTINFORMATION.CBOSUBJECT.value == "")
	{	
		alert("Please select subject");
		document.FRMSTUDENTINFORMATION.CBOSUBJECT.focus();
		return false;
	}
	return true;	
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['FRMSTUDENTINFORMATION'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
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
          <td><form name="FRMSTUDENTINFORMATION" method="post" action="StudentInformation.php?next=1" onSubmit="return validation();">
			<?php
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Learner Information</td>
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
							<td class="bodytext">&nbsp;<select name="CBOSTUDENT" class="textbox" onChange="getsubject()">
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
							<td width="41%" height="30" class="bodytext">Subject</td>
							<td width="59%" class="bodytext">&nbsp;<select name="CBOSUBJECT" class="textbox">
							<option value="" selected>Select Subject</option>
							<?php
							echo "<script language='JavaScript'>var subject = [];";
							$query_subject_id = "select iUserId,vSubjectId from cpo_usercourse where iUserId<>0 and vTutorId like '%".$user_id."%'";
							$result_subject_id = runquery($query_subject_id);
							$nos = 0;
							if($result_subject_id)
							{
								$nos = mysqli_num_rows($result_subject_id);
							}
							if($nos>0)
							{
								$i =0;
								while($result_subject = mysqli_fetch_array($result_subject_id))
								{
//									$tutor_id=explode(',',$result_subject['vTutorId']);
									$tutor_id=$result_subject['iUserId'];
									$subject_id=explode(',',$result_subject['vSubjectId']);
									
									for($k=0;$k<count($subject_id);$k++)
									{
											$sqlsubject = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$subject_id[$k];
											$rssubject = runquery($sqlsubject);
											$num = $rssubject ? mysqli_num_rows($rssubject) : 0 ;
											if ($num > 0 ) 
											{
												while($rssubjectname = mysqli_fetch_array($rssubject))
												{
													echo "subject[".$i."]= new Array(2);";
													echo "subject[".$i."][0]= ".$tutor_id.";";
													echo "subject[".$i."][1]= ".$subject_id[$k].";";
													echo "subject[".$i."][2]= '".$rssubjectname['vSubjectName']."';";
													
												}
											}
											$i = $i + 1;
									}
									
								}
							}
							echo "</script>";
							?>
							</select>&nbsp;<font color="red">*</font></td>
						</tr>
						<tr>
							<td width="41%" height="30" class="bodytext">Date of Course Commence</td>
							<td width="59%">&nbsp;<input name="TXCOURSECOMMENCEDATE" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('TXCOURSECOMMENCEDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></td>
						</tr>
						<tr>
							
                        <td width="41%" height="30" class="bodytext">Date of Lesson</td>
							<td width="59%">&nbsp;<input name="TXLESSIONDATE" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('TXLESSIONDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></td>
						</tr>
						<tr>
							<td width="41%" height="30" class="bodytext">Date of Course Compelete</td>
							<td width="59%">&nbsp;<input name="TXCOURSECOMPELETEDATE" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('TXCOURSECOMPELETEDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></td>
						</tr>
						<tr>
							<td width="41%" height="30" class="bodytext" valign="top">Learning Outcomes</td>
							<td width="59%">&nbsp;<textarea name="TALEARNINGOUTCOMES" class="textbox" rows="4" cols="50"></textarea></td>
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
					$subject_id = $_POST['CBOSUBJECT'];
					$date_course_commence = explode('/',$_POST['TXCOURSECOMMENCEDATE']);
					$date_of_lession = explode('/',$_POST['TXLESSIONDATE']);
					$date_course_complete = explode('/',$_POST['TXCOURSECOMPELETEDATE']);
					$learning_outcomes = clean_string($_POST['TALEARNINGOUTCOMES']);
					
					$date_course_commence = $date_course_commence[2].'-'.$date_course_commence[1].'-'.$date_course_commence[0];
					$date_of_lession = $date_of_lession[2].'-'.$date_of_lession[1].'-'.$date_of_lession[0];
					$date_course_complete = $date_course_complete[2].'-'.$date_course_complete[1].'-'.$date_course_complete[0];
					
					$insert_studentinfo="insert into cpo_studentinfo(iTutorId,iStudentId,iSubjectId,dDateCommenceCourse,dDateOfLession,dDateCompleteCourse,vLearningOutcomes) values (".$user_id.",".$student_id.",".$subject_id.",'".$date_course_commence."','".$date_of_lession."','".$date_course_complete."','".$learning_outcomes."')";					
					//echo $insert_studentinfo;
					runquery($insert_studentinfo);

					$msg = "Your learner information has been submitted successfully.";
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
                      <td class="welcome">Learner Information</td>
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
