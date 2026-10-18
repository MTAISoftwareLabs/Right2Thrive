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
		window.parent.location = 'index.htm';
	</script> 
<?php
} ?>
<html>
<head>
<title>Add Tutor - Course</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

<script language="JavaScript">

function validation1()
{
	if(document.frmtutorintegrate.txtTutorId.value=="-")
	{
		alert("Please Select Tutor Name");
		document.frmtutorintegrate.txtTutorId.focus();
		return false;
	}
	if(document.frmtutorintegrate.txtCourseId.value=="-")
	{
		alert("Please Select Course Name");
		document.frmtutorintegrate.txtCourseId.focus();
		return false;
	}
	if(document.frmtutorintegrate.txtSubjectId.value=="-")
	{
		alert("Please Select Subject Name!");
		document.frmtutorintegrate.txtSubjectId.focus();
		return false;
	}
	document.frmtutorintegrate.method = "post";
	document.frmtutorintegrate.action="addtutorintegrate.php";
	document.frmtutorintegrate.submit();
	return true;
}
function validation2()
{

	if(document.frmtutorintegrate.txtTutorId.value=="-")
	{
		alert("Please Select Tutor Name");
		document.frmtutorintegrate.txtTutorId.focus();
		return false;
	}
/*	if(document.frmtutorintegrate.txtCourseId.value=="-")
	{
		alert("Please Select Course Name");
		document.frmtutorintegrate.txtCourseId.focus();
		return false;
	} */
/*	if(document.frmtutorintegrate.txtSubjectId.value=="-")
	{
		alert("Please Select Subject Name!");
		document.frmtutorintegrate.txtSubjectId.focus();
		return false;
	} */
	document.frmtutorintegrate.method = "post";
	document.frmtutorintegrate.action="coursewisesubject.php";
	document.frmtutorintegrate.submit();
	return true;
}

/*function win_onload()
{
 document.frmtutorintegrate.txtTutorId.focus();
}*/

function Next()
{
	document.frmtutorintegrate.method="post";
	document.frmtutorintegrate.action=coursewisesubject.php;
	
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact">

<?php include_once('top.php')?>
<table width="999"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
<?php if(isset($_POST['txtSubjectId']))
{
		
				$Subject_id=$_POST['txtSubjectId'];
				$Tutor_id=$_POST['txtTutorId'];
				$Course_id=$_POST['txtCourseId'];
		
				$selectdata="select vSubjectIDs,iTutorCourseID from cpo_tutorforcourses where iCourseID='".$Course_id."' and iUserID='".$Tutor_id."'";
			 	$result=runquery($selectdata) or die('could'.mysqli_error());
			 
			 	$count= mysqli_num_rows($result);

			 	if($count==1)
			 	{
			 		$id=mysqli_result($result,0,0);
					$tutorcourseid=mysqli_result($result,0,1);
					if($id==-2)
					{
							$msg="Record Already Exit For all Subject First Deleted that";
					}
					else
					{
							$id=explode(",", $id);
								$c=count($id)-1;
								$str="";
								$flg=false;
									
									for($i=0;$i<count($id);$i++)
										{
												if($id[$i]==$Subject_id)
												{
													$flg=true;
												}
										elseif($c!=$i)
										{
												$str=$str.$id[$i].",";
										}
										else
											$str=$str.$id[$i];
										}
											
								$str=$str.",".$Subject_id;
								echo $str."<br>";
								if($flg==true)
											$msg="Record already exit";
								else
									{
											$sql="update cpo_tutorforcourses set vSubjectIDs='". $str ."' where iCourseID='".$Course_id."' and iUserID='".$Tutor_id."'";
											runquery($sql) or die('error'.mysqli_error().$sql);
											$msg="Record Updated Successfully";
									}
					}
								
				
			 	}
				else
				{
			 	
            	$addsql="insert into cpo_tutorforcourses values ('".$Tutor_id."','".$Course_id."','".$Subject_id."','')";
				$record=runquery($addsql,$HTTP_SESSION_VARS['conn']) or die("could not execute query".mysqli_error());
				$msg="Record added Successfully";
				}
			/*	}
				else
				{
				$msg="First Select Course";
				} */

?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Tutor - Course Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tutorincourse" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtutorintegrate.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtutorintegrate.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
												<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 		
                            <td class="toheaderbg" colspan="3">Tutor - Course Information</td>	
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            									<td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1" class="table">
                														
                														<tr> 
                  																<td align="center">&nbsp;</td>
																		</tr>		
                														<tr> 
            																	<td align="center"> 
			
              			<font class="comment"><b><?php echo $msg ?></b></font> 
               													</td>
          																</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
														                </tr>	
                														<tr> 
																                <td align="center"><div align="right"><a href="addtutorintegrate.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=tutorincourse"><img src="images/cancel.gif"  border="0"></a> &nbsp;</div></td>
                														</tr>
                														<tr> 
                  																<td>&nbsp;</td>
                														</tr>
              													</table></td>
          								</tr>
        						</table>
						</td>
    			</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td></tr>
</table>
</td>
  </tr>
</table>
<?php } else {?>
<form name="frmtutorintegrate" onSubmit="return validation2();">
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Tutor - Course Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tutorincourse" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtutorintegrate.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtutorintegrate.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">Add Tutor - Course</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            									<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
<tr> 
																								<td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
																						</tr>
																<tr> 
										  								
                          
                      <td width="25%" height="42" class="">&nbsp;&nbsp;Select 
                        Tutor</td>
      																	<td width="75%" ><select name="txtTutorId" class="textbox">
																		<option value="-">Select Tutor </option>
					
					<?php
						   $fetch="select * from cpo_usermaster where iUserType=1 and iUserStatus=1";
							$result=runquery($fetch);
							$count=mysqli_num_rows($result);
							
							while($row=mysqli_fetch_array($result))
							{
											
						?>
						
						<option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
                      	<?php
						}
						?>
                    </select> <font color="#FF0000">*</font></td>
    															</tr>
    															<tr> 
                          												
                          
                      <td  valign="top" class="">&nbsp;&nbsp;Select 
                        Courses</td>
      																	
                          
                      <td> <font color="#FF0000"><select name=txtCourseId[] size="15" multiple>
																		<option value="-" selected>Select Course</option>
					
					<?php
						   $fetch="select * from cpo_coursemaster where iStatus=1";
							$result=runquery($fetch);
							$count=mysqli_num_rows($result);
							
							while($row=mysqli_fetch_array($result))
							{
											
						?>
						
						<option value="<?php echo $row["iCourseId"];?>~<?php echo $row["vCourseName"];?>"><?php echo $row["vCourseName"];?></option>
                      	<?php
						}
						?>
                    </select>*</font> </td>
					</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<!--		<tr> 
                          												
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Select 
                        Subject</td>
      																	
                          
                      <td width="60%" > <font color="#FF0000"><select name="txtSubjectId">
																		<option value="-2">ALL Subject </option>
																		
					
					<?php
						   $fetch="select * from cpo_subjectmaster";
							$result=runquery($fetch);
							$count=mysqli_num_rows($result);
							
							while($row=mysqli_fetch_array($result))
							{
											
						?>
						
						<option value="<?php echo $row["iSubjectId"];?>"><?php echo $row["vSubjectName"];?></option>
                      	<?php
						}
						?>
                    </select>*</font> </td>
    															</tr> -->
				<tr> 
                          												
                          
                      <td> </td>
      																	
                          <td style="height:50px; padding-right:10px"  align="right" valign="middle"><input type="image" src="images/next1.gif" border="0" alt="Next">&nbsp;&nbsp;<a href="overview.php?id=tutorincourse"><img src="images/cancel.gif"  border="0"></a></td>
    															</tr>
							
							
    															
</table></td>
          								</tr>
        						</table>
						</td>
    			</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td></tr>
</table>
</td>
  </tr>
</table>
		</form>
	<?php }?>
	</td>
  </tr>
</table>
</body>
</html>