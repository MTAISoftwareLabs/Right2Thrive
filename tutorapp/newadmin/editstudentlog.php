<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
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
function clean_string($str)
{
	$str = htmlspecialchars(str_replace("\'", "'", trim($str)));
	$str = rtrim($str);	
	$str = str_replace("'", "\'", $str);
	return $str;
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
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script src="calendar1.js"></script>
<script language="JavaScript">
var myvar = 1;
function getIsStaisfied()
{
	myvar = 0;
	document.getElementById("TASUGGESTION").disabled = false;
}
function setIsStaisfied()
{
	myvar = 1;
	document.getElementById("TASUGGESTION").value="";
	document.getElementById("TASUGGESTION").disabled = true;
}
function validation()
{
	if (myvar == 0)
	{	
		if(document.FRMSTUDENTLOG.TASUGGESTION.value=="")
		{
			alert("Please enter your suggestion");
			document.FRMSTUDENTLOG.TASUGGESTION.focus();
			return false;
		}
	}
	document.FRMSTUDENTLOG.ISSATISFIED.value=myvar;
	
	
}


</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="FRMSTUDENTLOG" method="post" action="editstudentlog.php?next=1">		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Learner Log Book Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=logstudent">Overview</a></div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/active_middle.jpg" width=11></div></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr1.jpg" width=11></div></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="liststudentlog.php">List</a></div></td>
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
					
	$area_covered = clean_string($_POST['TAAREACOVERED']);
	$skill_achieved = clean_string($_POST['TASKILLACHIEVED']);
	$problem_encounter = clean_string($_POST['TAPROBLEMSENCOUNTERED']);
	$is_satisfied = $_POST['ISSATISFIED'];
	
	
	if($is_satisfied)
	{
						$suggestion = "";						
	}
	else
	{
						$suggestion = clean_string($_POST['TASUGGESTION']);
	}
	$sqlupdate = "update cpo_studentlogbook set vAreaCovered='".$area_covered."',vSkillAchieved='".$skill_achieved."',vProblemEncounter='".$problem_encounter."',iIsSatisfied='".$is_satisfied."',vSuggestion='".$suggestion."' where iLogId=".$_POST['id'];
	
	
	runquery($sqlupdate) or die('could'.mysqli_error()); 
	
	$msg = "Log Information is updated successfully.";?>
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
                      <a href="viewstudentlog.php"><img src="images/edit1.gif" width="73" height="22" border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=logstudent"><img src="images/cancel.gif" width="73" height="22" border="0"></a></b></font>&nbsp;&nbsp; 
                    </div></td>
                </tr>
                <tr> 
                  <td class="headingtd" colspan="2">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
				<tr><td>&nbsp;</td></tr>
		  
<?php }
else
{
?>
         
          <tr> 
            <td bgcolor="#FFFFFF" height="10">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="75%" cellSpacing=0 cellPadding=0 border=0 class="table" align="center">
                <tr> 
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="517" class="headingtd">Edit / Delete Learner 
                          Log Book</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
					<?php	$sqldata = "select * from cpo_studentlogbook where iLogId=".$_GET['sid'];
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
							$sqlsub = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rsdata1[4];
							$rssub = runquery($sqlsub);
							$num1 = $rssub ? mysqli_num_rows($rssub) : 0 ;
							if ($num1 > 0 )
							{
								$rsdata = mysqli_fetch_array($rssub);
								$subname = $rsdata[0];
							}?>
                <tr><td class="bodytext" align="right">All (<font color="red">*</font>) mark are compulsory fields</td></tr>
				<tr>
					<td>
					<table width="100%" align="center">
                      <tr> 
                        <td class="bodytext" height="32">&nbsp;Learner Name</td>
                        <td class="bodytext"><?php echo $tutorname?></td>
                      </tr>
                      <tr> 
                        <td class="bodytext" height="32">&nbsp;Tutor Name</td>
                        <td class="bodytext"><?php echo $stuname?></td>
                      </tr>
                      <tr> 
                        <td width="41%" height="30" class="bodytext">&nbsp;Subject Name</td>
                        <td width="69%" class="bodytext"><?php echo $subname?></td>
                      </tr>
                      <tr> 
                        <td width="41%" height="30" class="bodytext">&nbsp;Area Covered</td>
                        <td width="69%"> 
                          <textarea name="TAAREACOVERED" class="textbox" rows="4" cols="50"><?php echo $rsdata1[5]?></textarea>
                          &nbsp;<a href="javascript:pickdate('TXCOURSECOMMENCEDATE')"></a></td>
                      </tr>
                      <tr> 
                        <td width="41%" height="30" class="bodytext">&nbsp;Skills Achieved</td>
                        <td width="69%"> 
                          <textarea name="TASKILLACHIEVED" class="textbox" rows="4" cols="50"><?php echo $rsdata1[6]?></textarea>
                          &nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="41%" height="30" class="bodytext">&nbsp;Problem Encountered</td>
                        <td width="69%"> 
                          <textarea name="TAPROBLEMSENCOUNTERED" class="textbox" rows="4" cols="50"><?php echo $rsdata1[7]?></textarea>
                          &nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="41%" height="30" class="bodytext">&nbsp;Was the Subject taugh to your <br>&nbsp;satisfication</td>
                        <td width="69%" class="bodytext"><input type="radio" name="RBISSATISFIED" id="RBISSATISFIED" value="1" <?php if($rsdata1[8]==1) { ?> checked <?php } ?> onClick="setIsStaisfied();">Yes &nbsp;<input type="radio" name="RBISSATISFIED" id="RBISSATISFIED" value="0" <?php if($rsdata1[8]==0) { ?> checked <?php } ?> onClick="getIsStaisfied();">No&nbsp;<input type="hidden" name="ISSATISFIED" value=""></td>
                          &nbsp;
                      </tr>
                      <tr> 
                        <td width="41%" height="30" class="bodytext">&nbsp;If no please explain below why and how<br>&nbsp;you think we can improve the 
                          course ?</td>
                        <td width="69%"> 
                          <textarea name="TASUGGESTION" class="textbox" rows="4" cols="50" id="TASUGGESTION" <?php if($rsdata1[8]==1) { ?> disabled <?php } ?>><?php echo $rsdata1[9]?></textarea>
                          &nbsp;</td>
                      </tr>
                      <tr align="right"> 
                        <td width="41%">&nbsp;</td>
                        <td width="69%" align="right"><input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Student Information" onClick="return validation()" class="mouse">
                          &nbsp; <input name="id" type="hidden" value="<?php echo $_GET['sid']?>"> 
                          <a href="./viewstudentlog.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>&nbsp;</td>
                     &nbsp; </tr>
                    </table>					
					
					</td>
				</tr><?php
					}
					?>
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

