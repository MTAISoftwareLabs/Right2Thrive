<?
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
<title><? echo sitename;?>Add Courses</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../admin/calendar1.js"></script> 
<script language="JavaScript">
function clean_string($str)
{
	$str = htmlspecialchars(str_replace("\'", "'", trim($str)));
	$str = rtrim($str);	
	$str = str_replace("'", "\'", $str);
	return $str;
}
var myvar = 1;
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['FRMSTUDENTLOGBOOK'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}
function getsubject()
{
	var selindex = document.FRMSTUDENTLOGBOOK.CBOTUTOR.selectedIndex;
	var selmake = document.FRMSTUDENTLOGBOOK.CBOTUTOR.options[selindex].value;
	document.FRMSTUDENTLOGBOOK.CBOSUBJECT.options.length = 0;
	document.FRMSTUDENTLOGBOOK.CBOSUBJECT.options[0] = new  Option("Select Subject","");
	var k = 1;
	for(var j = 0; j<subject.length; j++)
	{
		if (subject[j][0] == selmake)
		{
			document.FRMSTUDENTLOGBOOK.CBOSUBJECT.options[k] = new Option(subject[j][2],subject[j][1] );
			k++;
		}
	}
}
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
	if (document.FRMSTUDENTLOGBOOK.CBOTUTOR.value == "")
	{	
		alert("Please select your tutor");
		document.FRMSTUDENTLOGBOOK.CBOTUTOR.focus();
		return false;
	}
	if (document.FRMSTUDENTLOGBOOK.CBOSUBJECT.value == "")
	{	
		alert("Please select your subject");
		document.FRMSTUDENTLOGBOOK.CBOSUBJECT.focus();
		return false;
	}
	if (myvar == 0)
	{	
		if(document.FRMSTUDENTLOGBOOK.TASUGGESTION.value=="")
		{
			alert("Please enter your suggestion");
			document.FRMSTUDENTLOGBOOK.TASUGGESTION.focus();
			return false;
		}
	}
	document.FRMSTUDENTLOGBOOK.ISSATISFIED.value=myvar;
	return true;	
}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<body
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
	
  	<tr> 
    	<td rowspan="2" valign="top" style="border-right:1px solid #cccccc" bgcolor="#FFFFFF"> 
      		<? include "leftpanel.php";?>
    	</td>
    	<td valign="top"> 
      		<? include "includewelcome.php";?>
    	</td>
  	</tr>
  	<tr> 
    	<td valign="top">
			<table width="100%%" border="0" cellspacing="0" cellpadding="0">
  			<tr>
		 	   <td>
			   		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td> <form name="FRMSTUDENTLOGBOOK" method="post" action="AddCourses.php?next=1">
                    <?
if (!isset($_GET['next']))
{
?>
                    <table width="90%" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td> <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
                            <tr> 
                              <td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                              <td width="562" background="images/changep_center_cor.jpg"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="welcome">Add Courses</td>
                                    <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                  </tr>
                                </table></td>
                              <td width="12" background="images/changep_right_cor.jpg">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td colspan="3" > 
                                <?
							$sqlsel = "select distinct iCourseId from cpo_usercourse where iUserId =".$user_id;
							$strcourseid = "";
							$resultcourseid=runquery($sqlsel);
							if($resultcourseid)
							{
								$num = mysqli_num_rows($resultcourseid);
							}
							else
							{
								$num=0;
							}
							if($num > 0)
							{
								while($resultcourseid1 = mysqli_fetch_array($resultcourseid))
								{
									$strcourseid.=$resultcourseid1['iCourseId'].',';
								}
							}	
							$strcourseid.="0";
							$sql="select * from cpo_coursemaster WHERE iStatus=1 AND iCourseId not in (".$strcourseid.") order by iCourseOrder";
							$result=runquery($sql);
							if($result)
							{
								$num = mysqli_num_rows($result);
							}
							else
							{
								$num=0;
							}
							$counter=1;	
if($num > 0)
{ ?>
                                <table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="DFEAF2" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">
                                  <tr> 
                                    <td width="10%" height="20" class="bodytext" ><strong>&nbsp;Select 
                                      Course</strong></td>
                                    <td width="50%" class="bodytext"><strong>&nbsp;Course 
                                      Name</strong></td>
                                    <td width="20%" class="bodytext" align="center"><strong>&nbsp;Duration</strong></td>
                                    <td width="20%" class="bodytext" align="center"><strong>&nbsp;Fees(Pounds)</strong></td>
                                  </tr>
                                  <?
								while($rslist = mysqli_fetch_array($result))
								{
							?>
                                  <tr bgcolor="#FFFFFF" class="bodytext"> 
                                    <td align="center"><input type="checkbox" id=1 name="chk<? echo $counter;?>" value="<? echo $rslist["iCourseId"]?>"> 
                                      <input type="hidden" name="cname<? echo $counter;?>" value="<? echo $rslist["vCourseName"]; ?>"></td>
                                    <td height="25" align="left">&nbsp;<? echo $rslist["vCourseName"]; ?></td>
                                    <td align="center"><? echo $rslist["vCourseDuration"]; ?></td>
                                    <td align="center">&pound;&nbsp;<? echo $rslist["fCourseFees"]; ?></td>
                                    <? //if($rslist["iStatus"]==0) 
													//echo "No";
												//else
													//echo "Yes";
											?>
                                  </tr>
                                  <?		$counter++;
								}?>
                                </table></td>
                            </tr>
                            <tr> 
                              <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td height="22" background="images/changebttm_center_cor.jpg" > 
                                <div align="right"> 
                                  <input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">
                                </div></td>
                              <td width="1%"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table><input type="hidden" name="cnt" value="<? echo $counter;?>"></td>
                      </tr>
                      <?
					  	}					  
						else
						{ ?>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="DFEAF2">
                      <tr> 
                        <td colspan="3" height="20" class="bodytext" align="center" bgcolor="DFEAF2" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;"><strong>&nbsp;No 
                          new courses available to add.</strong></td>
                      </tr>
                      <tr> 
                        <td colspan="3"><table width="100%" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td height="25" background="images/changebttm_center_cor.jpg">&nbsp;</td>
                              <td width="1%" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table></td>
                        
                      </tr></table></td></tr></table></td></tr>
                      <?
						}?>
                    </table>
                    <?
			  }
			  else
			  {
					$cnt1=$HTTP_POST_VARS['cnt'];
					$regdate = date("Y-m-d");
					$coursename = "";
					for($i=1;$i<$cnt1;$i++)
					{
							if(isset($HTTP_POST_VARS['chk'.$i]))
							{
								$courseid= $HTTP_POST_VARS['chk'.$i];
								$addcourse="insert into cpo_usercourse values('',".$user_id.",".$courseid.",'','".$regdate."',1,'','')";
								$record=runquery($addcourse);
								$coursename.= "'".$HTTP_POST_VARS['cname'.$i]."',";
							}
					}
					$coursename = substr($coursename,0,strlen($coursename)-1);
					
					//Sending mail 
					$fromname = $_SESSION['user_name'];
					$fromaddress = $_SESSION['email_id'];
					$toname = "Administrator of CareerPaths Online";
					$toaddress = admin_email;
					$subject = "Learner '".$_SESSION['user_name']."' has added new course.";
					$message ="<html><body><p>Dear Administrator,</p>";
					$message .= "<p>Learner '".$_SESSION['user_name']."' has added following courses to his/her account.</p>";
					$message .= "<p>".$coursename."</p>";
					$message .= "<p>Warm Regard From,</p>";
					$message .= "<p>CareerPaths Online Team</p></body></html>";
					SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
					
					$msg = "Your course addition information has been submitted successfully.";
					$color = "black";
					?>
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                        <td width="96%" background="images/changep_center_cor.jpg"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td class="welcome">Add Courses</td>
                              <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                            </tr>
                          </table></td>
                        <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
                          <table class="" width="90%" align="center">
                            <tr> 
                              <td colspan="2" align="center" class="bodytext"><font color="<? echo $color;?>"><b><? echo $msg?></b></font></td>
                            </tr>
                            <tr> 
                              <td colspan="2">&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                        <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='./'"></div></td>
                        <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                      </tr>
                    </table>
                    <? 			}
			  ?>
                  </form></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
                            <tr> 
                <td height="22"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                      <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="77%" class="welcome">Minimum System Requirements</strong></td>
                            <td width="20%" class="welcome"></td>
                            <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                          </tr>
                        </table></td>
                      <td width="2%"><img src="images/changep_right_cor.jpg"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forborder">
                    <tr> 
                      <td valign="top">
                          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                            <tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;Multimedia PC with an 800 MHz Pentium or Higher Processor</td>
							</tr>
							<tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;Microsoft Windows  98 or Later</td>
							</tr>
							<tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;VGA Display with 16k Colour Support</td>
							</tr>
							<tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;Soundcard and Speakers (Recommended)</td>
							</tr>
							<tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;A Printer (Recommended)</td>
							</tr>
							</table>		  
					  </td>
					 </tr>
                     
					 </table>
                     
                     </table>
				</td>
              <tr> 
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                      <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"></div></td>
                      <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td><table width="95%">
                     <tr>
                     <td>
                       <div align="right"><strong><a href="javascript:history.back();" class="textlink">Back</a></strong></div>                     </td>
                     </tr></td>
              </tr>

              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
		  	</tr>
			</table>
		</td>
  	</tr>
  <TR><td colspan="2"> <? include "includebottom.php";?></td></TR>
</table>
</body>
</html>
