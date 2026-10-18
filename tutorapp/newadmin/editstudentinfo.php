<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//include_once '../lms/function.php';
function fdate($dt)
{
	$datadate = explode("/",$dt);
	$tday = date("Y-m-d", mktime(0,0,0,$datadate[1],$datadate[0],$datadate[2]));
	return $tday;
}

function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d/m/Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}

?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 

?>

<HTML>
<HEAD>
<link href="adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script src="calendar1.js"></script>
<script language="JavaScript">
function validation()
{
	/*if (document.FRMSTUDENTINFORMATION.CBOSTUDENT.value == "")
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
	}*/
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
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="FRMSTUDENTINFORMATION" method="post" action="editstudentinfo.php?next=1">		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Learner Information - Tutor Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=studentinfo">Overview</a></div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/active_middle.jpg" width=11></div></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr1.jpg" width=11></div></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="liststudinfo.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="45%" background="images/middle_last.jpg"></td>
          </tr>
        </table></td>
	</tr>
	<tr> 
      <td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF">&nbsp;</td>
          </tr>

<?php
if (isset($_GET['next']))
{
	$comdate = $_POST['TXCOURSECOMMENCEDATE'];
	$ldate = $_POST['TXLESSIONDATE'];
	$compdate = $_POST['TXCOURSECOMPELETEDATE'];
	$outcome = $_POST['TALEARNINGOUTCOMES'];
	$sqlupdate = "update cpo_studentinfo set dDateCommenceCourse='".fdate($comdate)."',dDateOfLession='".fdate($ldate)."',dDateCompleteCourse='".fdate($compdate)."',vLearningOutcomes='".$outcome."' where iSinfoId=".$_POST['id'];
	runquery($sqlupdate); 
	$msg = "Student information is updated successfully.";?>
	<tr><td>&nbsp;</td></tr>
				<tr><td>&nbsp;</td></tr>
	<tr> 
            <td bgcolor="#FFFFFF"><table width="75%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
                <tr> 
                  <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                  <td width="652" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
                </tr>
                <tr> 
                  <td height="35" colspan="2" class="fontblue" align="center"><?php echo $msg;?>.</td>
                </tr>
                <tr> 
                  <td colspan="2" ><div align="right">&nbsp; 
                      <a href="viewstudentinformation.php"><img src="images/edit1.gif" width="73" height="22" border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=studentinfo"><img src="images/cancel.gif" width="73" height="22" border="0"></a></b></font>&nbsp;&nbsp; 
                    </div></td>
                </tr>
                <tr> 
                  <td class="headingtd" colspan="2">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td>&nbsp;</td></tr>				
		  
<?php }
else
{
?>
         
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="75%" cellSpacing=0 cellPadding=0 border=0 class="table" align="center">
                <tr> 
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="517" class="headingtd">Edit / Delete Learner 
                          Information</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
				<tr>
					<td>
					<?php
						$sqldata = "select * from cpo_studentinfo where iSinfoId=".$_GET['sid'];
						$rsst = runquery($sqldata);
						$num = $rsst ? mysqli_num_rows($rsst) : 0 ;
						if ($num > 0)
						{
							$rsdata1 = mysqli_fetch_array($rsst);
							$tutorname = "";
							$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rsdata1[1];
							$rstutor = runquery($sqltutor);
							$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
							if ($num1 > 0 )
							{
								$rsdata = mysqli_fetch_array($rstutor);
								$tutorname = $rsdata[0];
							}
	
							$stuname = "";
							$sqlstu = "select vUserName from cpo_usermaster where iUserId=".$rsdata1[2];
							$rsstu = runquery($sqlstu);
							$num1 = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
							if ($num1 > 0 )
							{
								$rsdata = mysqli_fetch_array($rsstu);
								$stuname = $rsdata[0];
							}
	
							$subname = "";
							$sqlsub = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rsdata1[3];
							$rssub = runquery($sqlsub);
							$num1 = $rssub ? mysqli_num_rows($rssub) : 0 ;
							if ($num1 > 0 )
							{
								$rsdata = mysqli_fetch_array($rssub);
								$subname = $rsdata[0];
							}
							
					?>
					<table class="" width="100%" align="center">
					<tr><td height="10" colspan="2" class="bodytext" align="right">All (<font color="red">*</font>) mark are compulsory fields</td></tr>
						<tr>
							<td class="bodytext" height="32">&nbsp;Tutor Name</td>
							<td class="bodytext">&nbsp;<?php echo $tutorname?></td>
						</tr>
						<tr>
							<td class="bodytext" height="32">&nbsp;Learner Name</td>
							<td class="bodytext">&nbsp;<?php echo $stuname?></td>
						</tr>
						<tr>
							<td width="30%" height="30" class="bodytext">&nbsp;Subject Name</td>
							<td width="70%" class="bodytext">&nbsp;<?php echo $subname?></td>
						</tr>
						<tr>
							<td width="30%" height="30" class="bodytext">&nbsp;Date of Course Commence</td>
							<td width="70%">&nbsp;<input name="TXCOURSECOMMENCEDATE" type="text" class="textbox" readonly value="<?php echo gdate($rsdata1['dDateCommenceCourse']);?>">&nbsp;<a href="javascript:pickdate('TXCOURSECOMMENCEDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a></td>
						</tr>
						<tr>
							<td width="30%" height="30" class="bodytext">&nbsp;Date of Lesson</td>
							<td width="70%">&nbsp;<input name="TXLESSIONDATE" type="text" class="textbox" readonly value="<?php echo gdate($rsdata1['dDateOfLession']);?>">&nbsp;<a href="javascript:pickdate('TXLESSIONDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a></td>
						</tr>
						<tr>
							<td width="30%" height="30" class="bodytext">&nbsp;Date of Course Compelete</td>
							<td width="70%">&nbsp;<input name="TXCOURSECOMPELETEDATE" type="text" class="textbox" readonly value="<?php echo gdate($rsdata1['dDateCompleteCourse']);?>">&nbsp;<a href="javascript:pickdate('TXCOURSECOMPELETEDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a></td>
						</tr>
						<tr>
							<td width="30%" height="30" class="bodytext" valign="top">&nbsp;Learning Outcomes</td>
							<td width="70%">&nbsp;<textarea name="TALEARNINGOUTCOMES" class="textbox" rows="4" cols="50"><?php echo $rsdata1['vLearningOutcomes']?></textarea></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
							<tr> 
								<td width="30%">&nbsp;</td>
								<td width="70%" align="right">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Student Information" onClick="return validation()" class="mouse">&nbsp;
									<input name="id" type="hidden" value="<?php echo $rsdata1["iSinfoId"]?>">
									<a href="./viewstudentinformation.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
								</td>
							</tr>						
					</table>					
					<?php
					}
					?>
					</td>
				</tr>
				<tr align="right" bgcolor="#FFFFFF" >
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
                        <td width="772" class="headingtd">&nbsp;</td>
                        <td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
                      </tr>
                    </table></td>
                </tr>
              </table> </td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
<?php
}
?>
        </table>
		</td>
	</tr>
</table>
</form>
</BODY>
</HTML>

