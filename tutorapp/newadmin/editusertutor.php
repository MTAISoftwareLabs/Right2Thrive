<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} ?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>

<script language="JavaScript">
function validation()
{
	if(document.frmtutorintegrate.txtTutorId.value=="-")
	{
		alert("Please Select Tutor Name");
		document.frmtutorintegrate.txtTutorId.focus();
		return false;
	}
}
function win_focus()
{
	
}
</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect"  <?php if(!isset($_POST['hdnsubmit'])){?> onLoad="win_focus()" <?php } ?>>
<?php
	$Learnerid = isset($_GET['lid'])?$_GET['lid']:'';
	$Courseid = isset($_GET['cid'])?$_GET['cid']:'';
	$Tutorid = isset($_GET['tid'])?$_GET['tid']:'';
	$sid= isset($_GET['sid'])?$_GET['sid']:'';
	
?>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['hdnsubmit'])  && $_POST['hdnsubmit'] ==1)
{
			$newtutorid = $_POST['txtTutorId'];
				$Courseid = $_POST['cid'];
				$Learnerid = $_POST['lid'];
				$subjectid = $_POST['sid'];
				//$oldtutorid = $_POST['id'];
							
																				
				$selectdata="select vSubjectId,vTutorId from cpo_usercourse where iCourseId='".$Courseid."' and iUserId='".$Learnerid ."'";
				
			 	$result=runquery1($selectdata) or die('could'.mysqli_error());
				$count=mysqli_num_rows($result);
				//echo $count."count";
				$str="";
				$flg="";
			 
			  		$sid=mysqli_result($result,0,0);
					$tid=mysqli_result($result,0,1);
																	
										$sid=explode(",",$sid);
										$tid=explode(",",$tid);
										$c=count($sid)-1;										
										for($i=0;$i<count($sid);$i++)
										{
																if($sid[$i]==$subjectid)
																{
																	$str=$str.$newtutorid.",";	
																}
																elseif($c!=$i)
																{
																	$str=$str.$tid[$i].",";
																}
																else
																	$str=$str.$tid[$i];
										}
															 $x=strlen($str);
															  $last=substr($str, $x-1, $x); 
															  if($last==',')
																	$str=substr($str, 0,$x-1); 	
															 
															
															//echo $str;
															
																			
															$sql="update cpo_usercourse set vTutorId='".$str."'  where iCourseId='".$Courseid."' and iUserId='".$Learnerid."'";
															runquery1($sql) or die('error'.mysqli_error().$sql);
															$msg="Record edited successfully.";
															$flg="green";
						
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" class="schoolfont">Learner - Tutor Admin</td>
        </tr>
        <tr>
          <td class="graydotline">&nbsp;</td>
        </tr>

        <tr>
          <td height="30px;"></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=userfortutor" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="adduserintegrate.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listuserfortutor.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table></td>
              </tr>
              <tr>
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                  <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                      <tr>
                                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td class="toheaderbg" colspan="3">Learner - Tutor Integration Information</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                </tr>
                                <tr>
                                  <td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1">
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>

									<tr> 
								<?php
									if($flg == "red")
									{
								?>
								<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
							</tr>
							<tr>
								<td colspan="2" align="center" height="35" class="error"><?php echo $msg; ?></td>
								<?php
								}
								else
								{
								?>
								<td colspan="2" align="center" height="35" class="fontblue"><?php echo $msg; }?></td>								
							</tr>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                     
                                     
                                    </table></td>
                                </tr>
								<tr> 
								<td colspan="2" height="30" align="right" style="padding-right:10px">
									<a href="./viewuserfortutor.php"><img src="./images/go_back.gif" alt="Edit Course" border="0"></a>
								</td>
							</tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <?php } else {?>
  <form name="frmtutorintegrate"  method="post"onSubmit="return validation()">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td align="left" class="schoolfont">Learner - Tutor Admin</td>
          </tr>
          <tr>
            <td class="graydotline">&nbsp;</td>
          </tr>
          <tr>
            <td height="30px;"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=userfortutor" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="adduserintegrate.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listuserfortutor.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table></td>
                </tr>
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                  <tr>
                                    <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                        <tr>
                                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td class="toheaderbg" colspan="3">Edit Learner Tutor Integration</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                                      				
                 <tr> 
                  <td width="30%" height="30" class="" >&nbsp;&nbsp;Learner </td>
								<td width="70%" >&nbsp;&nbsp;<select name="txtTutorId" disabled  class="textbox">
																		<option value="-">Select Learner </option>
					
					<?php
						   $fetch="select * from cpo_usermaster where iUserType=2 and iUserStatus=1";
							$result=runquery1($fetch);
							$count=mysqli_num_rows($result);
							
							while($row=mysqli_fetch_array($result))
							{
											
						?>
						
						<option value="<?php echo $row["iUserId"];?>" <?php if($row["iUserId"]==$Learnerid)
						{
						?>
						selected
						<?php
						}?>
						 ><?php echo $row["vUserName"];?></option>
                      	<?php
						}
						?>
                    </select><font color="#FF0000">&nbsp;*</font></td>
							</tr>
							<tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td  class="bodytext">&nbsp;&nbsp;Course</td>
								<td align=left>&nbsp;&nbsp;<select name="txtCourseId" disabled  class="textbox">
																		<option value="-">Select Course</option>
					
					<?php
						   $fetch="select * from cpo_coursemaster";
							$result=runquery1($fetch);
							$count=mysqli_num_rows($result);
							
							while($row=mysqli_fetch_array($result))
							{
											
						?>
						
						<option value="<?php echo $row["iCourseId"];?>" <?php if($row["iCourseId"]==$Courseid)
						{
						?>
						selected
						<?php
						}?>
						 ><?php echo $row["vCourseName"];?></option>
                      	<?php
						}
						?>
                    </select><font color="#FF0000">&nbsp;*</font>
								  </td>
							  </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td  class="bodytext">&nbsp;&nbsp;Subject</td>
								<td align=left>&nbsp;&nbsp;<?php $fetchsubjectname="select vSubjectName from cpo_subjectmaster where iSubjectId=$sid";
												$fetchsubjectnameresult=mysqli_query($fetchsubjectname);
												$name=mysqli_result($fetchsubjectnameresult,0,0);
												echo $name ?>
								  </td>
							  </tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  
                <tr> 
                  <td class="bodytext">&nbsp;&nbsp;Select Tutor</td>
								<td align=left>&nbsp;&nbsp;<select name="txtTutorId" class="textbox">
														
													<?php
													$fetchsubjectfromcourses="select * from cpo_tutorforcourses where iCourseID=$Courseid";
													$result=runquery1($fetchsubjectfromcourses);
													while($rslist = mysqli_fetch_array($result))
													{	
															$idsubject=explode(",",$rslist["vSubjectIDs"]);
																										
																for($j=0;$j<count($idsubject);$j++)
																	{
																			if($idsubject[$j]==$sid)
																			{
																				$fetchname="select * from cpo_usermaster where iUserId=".$rslist["iUserID"];
																				$resultfetchname=mysqli_query($fetchname);
																				$tutorname=mysqli_result($resultfetchname,0,1);
																			?>
																				<option value="<?php echo $rslist["iUserID"];?>"<?php if($rslist["iUserID"]==$Tutorid)
																				{
																				?>
																				selected
																				<?php
																				}?>
																				 ><?php echo $tutorname;?></option>
																			 <?php
																			 }
																	}
													}
																																					
													?>							
											
							
                        </select><font color="#FF0000">&nbsp;*</font>
                  </td>
							  </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  
							  
							  
							  
							  
							  
														
							<tr align="right"> 
								<td width="31%" height="30" class="">&nbsp;</td>
								<td width="69%"><input name="lid" type="hidden" value="<?php echo $Learnerid;?>">
									<input name="cid" type="hidden" value="<?php echo $Courseid;?>">
									<input name="sid" type="hidden" value="<?php echo $sid;?>">
									<input name="id" type="hidden" value="<?php echo $Tutorid;?>">
									<input name="hdnsubmit" type="hidden" value="1">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Tutor Integrate" onClick="return validation()" class="mouse">&nbsp;<a href="viewuserfortutor.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>&nbsp;</td>
							</tr>
					
							
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="0%"><img src="images/green_left_corn.gif" /></td>
                        <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                        <td width="0%"><img src="images/green_right_corn.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </form>
      <?php }?>
    </td>
  </tr>
</table>
</body>
</html>
