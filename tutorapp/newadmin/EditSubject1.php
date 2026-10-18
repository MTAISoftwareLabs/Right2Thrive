<?php
@ob_start();
//require "../include/globals.php";
include_once 'dbConnection.php';
?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<script language="JavaScript" src="./txteditor.js"></script>
<script language="JavaScript">
function validation(aid)
{
	if(document.frmsubject.txtSubjectName.value=="")
	{
		alert("Subject Name can not be blank!");
		document.frmsubject.txtSubjectName.focus();
		return false;
	}
	if(document.frmsubject.txtSubjectDesc.value=="")
	{
		alert("Subject Description can not be blank!");
		document.frmsubject.txtSubjectDesc.focus();
		return false;
	}
	
			
	return true;
}

function win_focus()
{
	document.frmsubject.txtSubjectName.focus();
}
</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect" onLoad="win_focus()">
<?php
	$subjectid = $_GET['id'];
	$query = "select * from cpo_SubjectMaster where iSubjectId = ".$subjectid."";
	$result = runquery1($query) or die('could note execute'.mysqli_error());
?>

	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b>Admin - Subject</b></h3></td>
	</tr>
	<tr> 
		<td> 
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					 <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
                  <td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=subject">Overview</a></div></td>
                  <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 
                  src="images/bg_bodytab_crnr2.jpg" 
                  width=11></div></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="addsubject.php">Add 
                  </a></div></td>
                  <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
                  <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Edit 
                      / Delete</font></div></td>
                  <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listsubject.php"> 
                  List </a></div></td>
                  <td width="1%"><div align="right"><IMG height=23 
                  src="images/bg_bodytab_crnr3.jpg" 
                  width=11></div></td>
                  <td width="34%" background="images/middle_last.jpg"><div align="right"></div></td>
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
						<form name="frmsubject" enctype="multipart/form-data" action="EditSubjectProcess.php" method="post">
						<table width="65%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
							<tr> 
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr> 
											<td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
											
                        <td width="497" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Edit 
                          Subject</strong></font></td>
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
                  <td width="36%" height="30" class="" align="right">Subject Name 
                    :&nbsp;&nbsp;</td>
								<td width="64%" >&nbsp;&nbsp;<input name="txtSubjectName" type="text" class="textbox" size="40" value="<?php echo $rslist["vSubjectName"]; ?>"><font color="#FF0000">*</font></td>
							</tr>
							<tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td align=right >New Subject Description: </td>
								<td align=left>&nbsp;&nbsp;<textarea name="txtSubjectDesc" maxlength =255  rows="3" cols="45"class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["tSubjectDesc"]);?></textarea>
								  </td>
							  </tr>
							  <tr> 
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							<tr> 
                  <td width="36%" height="30" class="" align="right">File Name 
                    :&nbsp;&nbsp;</td>
								<td width="64%" >&nbsp;&nbsp;<img src="images/preview.gif" width="73" height="22" onClick="previewflash('<?php echo $rslist["vRemarks"];?>')" style='cursor:hand'></td>
							</tr>  			  								
                          <td colspan="2" height="2%">&nbsp;</td>
							</tr>
                      
                  <td width="36%" align=right height="42" class="">Edit File </td>
      																						
                  <td width="64%" > 
                    &nbsp;&nbsp;<input name="txtNewFileName" type="file"/>
 <font color="#FF0000">*</font></td>
    															</tr>
							
							 
							  <td colspan="2" height="2%">&nbsp;</td>
							  <tr> 
                  <td height="28" align=right  class="bodytext"> Active</td>
                  <td align=left valign="top">&nbsp;&nbsp;&nbsp; 
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
							  
							  
														
							<tr> 
								<td width="36%" height="40" class="">&nbsp;</td>
								<td width="64%">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Subject" onClick="return validation(<?php echo $rslist["iSubjectId"]; ?>)" class="mouse">&nbsp;
									<input name="id" type="hidden" value="<?=$rslist["iSubjectId"]?>">
									<a href="./viewsubject.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
								</td>
							</tr>
<?php	}
	else
	{
?>
							<tr> 
								<td height="30" class="error" align="center" colspan="2"><strong>No Record Exist in Database...!e</strong></td>
							</tr>
<?php			
	}
?>							
							<tr> 
								<td colspan="2" align="right" class="" height="12">&nbsp;</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
				<tr> 
					<td bgcolor="#FFFFFF">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
