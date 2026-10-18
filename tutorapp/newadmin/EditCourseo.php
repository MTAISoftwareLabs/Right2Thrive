<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		document.location ="index.htm";
	</script> 
<?php
} ?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function validation(aid)
{
	if(document.frmcourse.txtCourseName.value=="")
	{
		alert("Course Name can not be blank!");
		document.frmcourse.txtCourseName.focus();
		return false;
	}
	if(document.frmcourse.txtCourseDesc.value=="")
	{
		alert("Course Description can not be blank!");
		document.frmcourse.txtCourseDesc.focus();
		return false;
	}
	if(document.frmcourse.txtCourseDuration.value=="")
	{
		alert("Course Description can not be blank!");
		document.frmcourse.txtCourseDuration.focus();
		return false;
	}
	
			
	return true;
}

function win_focus()
{
	document.frmcourse.txtCourseName.focus();
}
</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect" onLoad="win_focus()">
<?php
	$courseid = $_GET['id'];
	$query = "select * from cpo_coursemaster where iCourseId = ".$courseid."";
	$result = runquery1($query) or die('could note execute'.mysqli_error());
?>

	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b>Admin - Course</b></h3></td>
	</tr>
	<tr> 
		<td> 
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					 <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=course">Overview</a></div></td>
                  <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 
                  src="images/bg_bodytab_crnr2.jpg" 
                  width=11></div></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="addcourse.php">Add 
                  </a></div></td>
                  <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
                  <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Edit 
                      / Delete</font></div></td>
                  <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listcourse.php"> 
                  List </a></div></td>
                  <td width="1%"><div align="right"><IMG height=23 
                  src="images/bg_bodytab_crnr3.jpg" 
                  width=11></div></td>
                  <td width="27%" background="images/middle_last.jpg"><div align="right"></div></td>
			</table>
		</td>
	</tr>
	<tr> 
		<td> 
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
				<tr> 
					<td bgcolor="F5F8FF">&nbsp;</td>
				</tr>
				<tr> 
					<td bgcolor="#FFFFFF">&nbsp;</td>
				</tr>
				<tr> 
					<td bgcolor="#FFFFFF">
						<form name="frmcourse" action="EditCourseProcess.php" method="post">
						<table width="65%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
							<tr> 
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr> 
											<td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
											<td width="497" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Edit Course</strong></font></td>
											<td width="500" class="headingtd"><div align="right"><img height=20 src="./images/img_header_gradient.jpg" width=147></div></td>
										</tr>
										<tr> 
											<td height="19" colspan="3" class="bodytext" ><div align="right">( fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
										</tr>
									</table>
								</td>
							</tr>
<?php
	if($result)
	{	$num = mysqli_num_rows($result);
		$rslist = mysqli_fetch_array($result)
?>
							
                <tr> 
                  <td width="25%" height="30" class="" >&nbsp; Course Name &nbsp;&nbsp;</td>
								<td width="75%" >&nbsp;&nbsp;<input name="txtCourseName" type="text" class="textbox" size="40" value="<?php echo $rslist["vCourseName"]; ?>">
                    <font color="#FF0000"> *</font></td>
							</tr>
							<tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td class="bodytext">&nbsp; Course Summary</td>
								<td align=left>&nbsp;&nbsp;<textarea name=txtCourseDesc   rows="10" cols="45"class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["tCourseDesc"]);?></textarea>
                    <font color="#FF0000"> *</font> </td>
							  </tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  
                <tr> 
                  <td class="bodytext">&nbsp; Course Duration</td>
								<td align=left>&nbsp;&nbsp;<input name="txtCourseDuration" type="text" class="textbox" size="9" value="<?php echo $rslist["iCourseDuration"]; ?>">
                    <font color="#FF0000"> *</font> (In Months)</td>
							  </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td class="bodytext">&nbsp; New Course Fees</td>
								<td align=left>&nbsp;&nbsp;<input name="txtCourseFees" type="text" class="textbox" size="9" value="<?php echo $rslist["fCourseFees"]; ?>" onBlur="chkfloat(this)">
                    <font color="#FF0000"> *</font> (In Pounds) </td>
							  </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  
							  <tr> 
                  <td  height="28" valign="top" class="bodytext">&nbsp;
                    Active</td>
                  <td align=left valign="top">&nbsp;&nbsp;
                    <?php
					
				  if (intval($rslist["iStatus"])==0)
				  {
				  ?>
                    <input type="checkbox" name="chkactive" value="0"> 
                    <?php
				}
				else
				{
				?>
                    <input type="checkbox" name="chkactive" value="1" checked>
                    <?php
				 }
				 ?>
                    <input type="hidden" name="txtchk" value="1"><input type="hidden" name="txtnewsid" value="<?php echo $newsid ?>"> </td>
                </tr>
							  
							  
														
							<tr align="right"> 
								<td width="25%" height="40" class="">&nbsp;</td>
								<td width="75%">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Course" onClick="return validation(<?php echo $rslist["iCourseId"]; ?>)" class="mouse">&nbsp;
									<input name="id" type="hidden" value="<?=$rslist["iCourseId"]?>">
									<a href="./viewcourse.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
								&nbsp;</td>
							</tr>
<?php	}
	else
	{
?>
							<tr> 
								<td height="30" class="error" align="center" colspan="2"><strong>No Record Exist in Database...!</strong></td>
							</tr>
<?php			
	}
?>							
							<tr> 
								<td colspan="2" align="right" class="" height="12">&nbsp;</td>
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
						</table>
						</form>
					</td>
				</tr>
				<tr> 
					<td bgcolor="#FFFFFF"><h1>&nbsp;</h1></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
