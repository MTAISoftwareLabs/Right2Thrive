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
<title>Add Subject</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">

function validation()
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
	
	
	return true;
}

/*function win_onload()
{
 document.frmtutorintegrate.txtTutorId.focus();
}*/

function sel()
{
	
}
</script>
</head>

<!-- <body leftmargin="0" topmargin="0" class="seffact" onLoad="win_onload()"> -->
<?php 
/*if(isset($HTTP_POST_VARS['txtSubjectId']))
{
		
				$Subject_id=$HTTP_POST_VARS['txtSubjectId'];
				$Tutor_id=$HTTP_POST_VARS['txtTutorId'];
				$Course_id=$HTTP_POST_VARS['txtCourseId'];
		
				$selectdata="select vSubjectIDs,iTutorCourseID from cpo_tutorforCourses where iCourseID='".$Course_id."' and iUserID='".$Tutor_id."'";
			 	$result=runquery1($selectdata) or die('could'.mysqli_error());
			 
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
											runquery1($sql) or die('error'.mysqli_error().$sql);
											$msg="Record Updated Successfully";
									}
					}
								
				
			 	}
				else
				{
			 	
            	$addsql="insert into cpo_tutorforcourses values ('".$Tutor_id."','".$Course_id."','".$Subject_id."','')";
				$record=runquery1($addsql,$HTTP_SESSION_VARS['conn']) or die("could not execute query".mysqli_error());
				$msg="Record added Successfully";
				}*/
			//$record=runquery1($addsql1,$HTTP_SESSION_VARS['conn']) or die("could not execute query".mysqli_error());
			?>
		
		
<?php
/*}
else
{*/
?>
<form action="addtutorintegrate.php" name="frmtutorintegrate" method="post" onSubmit="return validation();">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td>&nbsp;</td>	</tr>
<tr> <td><h3><b>Tutor Integrate Admin</b></h3></td></tr>
<tr> 
	<td> 
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
			<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            											<td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=tutorincourse">Overview</a></div></td>
            											<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><img src="images/active_middle.jpg" width="11" height="23"></div></td>
            											<td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Add</font></div></td>
            											<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewtutorintegrate.php">Edit / Delete</a></div></td>
											            <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listtutorintegrate.php">List</a></div></td>
            											<td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            											<td width="34%" background="images/middle_last.jpg"><div align="right"></div></td>
		</tr>
		</table>
	</td>
</tr>
			 <tr> 
			<td> 
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
				<tr><td bgcolor="F5F8FF">&nbsp;</td></tr>
				<tr> 
				<td bgcolor="#FFFFFF">&nbsp;
				<table width="68%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
				<tr> 
				<td colspan="4">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				<td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
																						
                          <td width="417" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Add 
                              Tutor to Course &amp; Subjects</strong></font></td>
<td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
			</tr> 
					<tr> 
					<td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
					</tr>
					</table>
					</td>
																
<?php
$i=0;
	foreach($_POST['txtCourseId'] as $value)
	{
		echo $value;
		$ans=explode("~",$value);
?>
																<tr><td colspan="3">&nbsp;<?php echo $ans[1];?></td></tr>
    															<tr> 
                          												
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;
			<select name="txtCourseId[]" size="10" multiple>
			
			<!-- <option value="-">Select Course</option> -->
					
					<?php		
						   $fetch="select * from cpo_subjectincourse where iCourseID=".$ans[0];
						   $result=runquery1($fetch);
						   $count=mysqli_num_rows($result);
						//	if($count==0)
							//{ ?>
									<!--	<option value="-">No Subject</option> -->
										<?php
								//		}
							if($count>0)
							{			
							while($row=mysqli_fetch_array($result))
							{
								$anssub=explode(",",$row['vSubjectID']);
								echo $anssub;
								foreach($anssub as $sub)
								{
								$fetchsub="select * from cpo_subjectmaster where iSubjectId=".$sub;
								$resultsub=runquery1($fetchsub);		
						?>
						
						<option value="<?php echo $resultsub["iSubjectId"];?>"><?php echo $resultsub["vSubjectName"];?></option>
						</select></td>
						
						<td width="40%" height="42" class="">&nbsp;&nbsp;
                        <input type="image" src="images/next.gif" border="0" alt="Select Subject"></td>
						
                      <td width="60%" > <select name="txtSubjectId" size="10" multiple>
							</select> </td>
							
                      	<?php
								}
							}
							}
							else
							{ ?>
							<option value="-">No Subject</option>
							</select></td>
<?php							}
$i++; ?>
</tr>
<?php }						
						?>

      																	
                <!--          <td width="40%" height="42" class="">&nbsp;&nbsp;
                        <input type="image" src="images/next.gif" border="0" alt="Select Subject"></td>
						
                      <td width="60%" > <select name="txtCourseId" size="10" multiple>
							</select> </td> 
    															</tr> -->
				
    															
	  					
                      
																
					
							
							
    															<tr> 
      																	<td colspan="2" align="center" class="" height="12">
																		<!--		<input type="image" src="images/add.gif" border="0" alt="Add">  -->
																				<input type="image" src="images/add.gif" border="0" alt="Add"> 
																		</td>
																																																					
    															</tr>
  														</table>
  												<td bgcolor="#FFFFFF">&nbsp;</td>
          								</tr>
          								<tr> 
            									<td bgcolor="#FFFFFF">&nbsp;</td>
          								</tr>
        						</table>
						</td>
    			</tr>
  		</table>
  		<p>&nbsp;</p>
  		<p>&nbsp;</p>
  		<p>&nbsp;</p>
		</form>
	<?php
//}
	?>
</body>
</html>
