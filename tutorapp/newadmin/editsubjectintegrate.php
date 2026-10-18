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
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<title>Edit Subject - Course </title>
</head>
<script language="JavaScript">
function deleteope(course,subject)
{
//	document.location = "editsubjectintegrateprocess1.php?cid="+course+"&sid="+subject;
	document.frmEditSub.action = "editsubjectintegrate.php?del=course&cid="+course+"&sid="+subject;
	document.frmEditSub.submit();
}
function validation()
{
	if(document.frmEditSub.cmbsubject.value==0)
	{
		alert("Please Select Subject");
		document.frmEditSub.cmbsubject.focus();
		return false;
	}
	
	return true;
}

function CheckDup(val)
{
	var selindex = document.frmEditSub.cmbsubject.selectedIndex;
	var selmake = document.frmEditSub.cmbsubject.options[selindex].value;
	for(var j = 0; j<subject.length; j++)
	{
		if (subject[j] == selmake)
		{
			alert("This item already exists");
			for (i=0;i<document.frmEditSub.cmbsubject.options.length;i++)
			{
				//alert(document.frmEditSub.cmbsubject.options[i].value + "/" + val );
				if (document.frmEditSub.cmbsubject.options[i].value == val)
				{
					document.frmEditSub.cmbsubject.options[i].selected = true;
				}
			}
			document.frmEditSub.cmbsubject.focus();
			return false;
		}
	}
}
function win_focus()
{
	document.frmEditSub.cmbsubject.focus();
}
</script>


<?php
	$id = $_GET['id'];
	$cid = $_GET['cid'];
	$query = "select * from cpo_subjectincourse where iCourseSubjectid = ".$cid;
	$result = runquery1($query); 
	$num = $result ? mysqli_num_rows($result) : 0;
?>	
<body class="seffect"  <?php if(!isset($_POST['hdn_submit'])) {?> onLoad="win_focus()" <?php } ?> >
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
	<?php 
	if(isset($_GET['del']) &&  $_GET['del'] == 'course' )
	{
				$Subjectid = isset($_GET['sid'])?$_GET['sid']:'';
				$Courseid = isset($_GET['cid'])?$_GET['cid']:'';
				$selectdata="select vSubjectID,iCourseID from cpo_subjectincourse where iCourseSubjectid=".$Courseid;
			 	$result=runquery1($selectdata) or die('could'.mysqli_error());
				$str="";
				$flg="";
			 
			  		$id=mysqli_result($result,0,0);
					$id1=explode(",",$id);
					$c=count($id1);
					if($c==1)
					{
							$sql="delete from cpo_subjectincourse where iCourseSubjectid=".$Courseid;
							runquery1($sql) or die('error'.mysqli_error().$sql);
							$msg="Subject Removed Successfully";
					}
					else
					{
							$id=explode(",",$id);
							$c=count($id)-1;										
									for($i=0;$i<count($id);$i++)
										{
												if($id[$i]==$Subjectid)
												{
														
												}
												elseif($c!=$i)
												{
													$str=$str.$id[$i].",";
												}
												else
													$str=$str.$id[$i];
										}
											 $x=strlen($str);
											  $last=substr($str, $x-1, $x); 
											  if($last==',')
											  		$str=substr($str, 0,$x-1); 	
											 
										
																				
															
											$sql="update cpo_subjectincourse set vSubjectID='".$str."'  where iCourseSubjectid=".$Courseid;
											runquery1($sql) or die('error'.mysqli_error().$sql);
											$msg="Subject removed successfully.";
					}?>
					<table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Subject - Course Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=subjectincourse" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addsubjectintegrate.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listsubjectintegrate.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Subject Course Integration Information</td>
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
								<tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                     
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
								 <tr>
                                        <td align="center"><div align="right"><a href="./viewsubjectintegrate.php"><img src="./images/go_back.gif" alt="Edit Course" border="0"></a> &nbsp;</div></td>
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
					
					
					
	<?php }
	else if(isset($_POST['hdn_submit']))
	{
				$newSubjectid = $_POST['txtSubjectId'];
				$Courseid = $_POST['cid'];
				$Tutorid = $_POST['tid'];
				$oldSubjectid = $_POST['id'];
							
																				
				$selectdata="select vSubjectIDs,iTutorCourseID from cpo_tutorforcourses where iCourseID='".$Courseid."' and iUserID='".$Tutorid."'";
				
			 	$result=runquery1($selectdata) or die('could'.mysqli_error());
				$count=mysqli_num_rows($result);
				//echo $count."count";
				$str="";
				$flg="";
			 
			  		$id=@mysqli_result($result,0,0);
					if($id==-2)
					{
							$sql="update cpo_tutorforcourses set vSubjectIDs='".$newSubjectid."'  where iCourseID='".$Courseid."' and iUserID='".$Tutorid."'";
							runquery1($sql) or die('could not execute'.mysqli_error());
							$msg="Tutor integrated successfully.";
					}
					
					else
					{
							$id1=@mysqli_result($result,0,0);
							$id1=explode(",",$id1);
							$c=count($id1)-1;
							$f=false;										
									for($i=0;$i<count($id1);$i++)
										{
												if($id1[$i]==$newSubjectid)
													{
													$msg="Tutor is already integrate to that subject.";
													$f=true;
													}
												
										}
										if($f!=true)
										{
							
											$id=explode(",",$id);
											$c=count($id)-1;										
													for($i=0;$i<count($id);$i++)
														{
																if($id[$i]==$oldSubjectid)
																{
																	$str=$str.$newSubjectid.",";	
																}
																elseif($c!=$i)
																{
																	$str=$str.$id[$i].",";
																}
																else
																	$str=$str.$id[$i];
														}
															 $x=strlen($str);
															  $last=substr($str, $x-1, $x); 
															  if($last==',')
																	$str=substr($str, 0,$x-1); 	
															 
															
															//echo $str;
															
																			
															$sql="update cpo_tutorforcourses set vSubjectIDs='".$str."'  where iCourseID='".$Courseid."' and iUserID='".$Tutorid."'";
															runquery1($sql) or die('error'.mysqli_error().$sql);
															$msg="Record edited successfully.";
															$flg="green";
											}
									
					}
								?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Subject - Course Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=subjectincourse" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addsubjectintegrate.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listsubjectintegrate.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Subject Course Integration Information</td>
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
								<tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                     
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
								 <tr>
                                        <td align="center"><div align="right"><a href="./viewsubjectintegrate.php"><img src="./images/go_back.gif" alt="Edit Course" border="0"></a> &nbsp;</div></td>
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


     <form name="frmEditSub" method="post" onSubmit="return validation()" action="editsubjectintegrate.php">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Subject - Course Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=subjectincourse" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addsubjectintegrate.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listsubjectintegrate.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Edit Subject Course Integration</td>
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
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							 
					<?php
	 if($num > 0)
	{
		$rslist = mysqli_fetch_array($result);
		$cid = $rslist['iCourseID'];
?>		
							  
              	<tr> 
                  <td  width="36%" height="25">&nbsp;&nbsp;<b>Course:</b></td>
                  <td width="64%" height="25">
				  <select name="cmbcourse" class="textbox" disabled>
				  	<option value=0>Select Course</option>				  
				  <?php
//				  $stid=$HTTP_GET_VARS['stateid'];
				  $stqry="select * from cpo_coursemaster";
				  $recourse=runquery1($stqry);
				  $num = $recourse ? mysqli_num_rows($recourse) : 0 ;
				if($num > 0)
				{
					while($rslist1 = mysqli_fetch_array($recourse))
					{
					if($rslist1['iCourseId']==$cid){?>
					<option value="<?php echo $rslist1['iCourseId'];?>" selected><?php echo $rslist1['vCourseName'];?></option>	
					<?php }else{ ?>
					<option value="<?php echo $rslist1['iCourseId'];?>"><?php echo $rslist1['vCourseName'];?></option>										
					<?php	}
					}
				}
				  ?>
				  </select>
				  <font color="red">&nbsp;*</font> </td>
				</tr>
				<tr> 
                  <td  width="36%" height="25">&nbsp;&nbsp;<b>Subject:</b></td>
                  <td width="64%" height="25">
			  <?php $list = explode(",",$rslist['vSubjectID']); 
				  echo "<script language='JavaScript'>var subject = [];";
				  $i = 0;
				   foreach($list as $value)
					{
							echo "subject[".$i."]= new Array();";
							echo "subject[".$i."]= ".$value.";";
							$i++;
					}
					echo "</script>";						
				  ?>

					</script>
  				  <select name="cmbsubject" class="textbox" onChange="CheckDup(<?php echo $id;?>)">
				  <option value=0>Select Subject</option>
				  <?php
//				   $ctid=$HTTP_GET_VARS['cityid'];
				  $stqry="select * from cpo_subjectmaster";
				  $resubject=runquery1($stqry);
				  $num = $resubject ? mysqli_num_rows($resubject) : 0 ;
				if($num > 0)
				{
					while($rslist1 = mysqli_fetch_array($resubject))
					{
					if($rslist1['iSubjectId']==$id){?>
					<option value="<?php echo $rslist1['iSubjectId'];?>" selected><?php echo $rslist1['vSubjectName'];?></option>	
					<?php }else{ ?>
					<option value="<?php echo $rslist1['iSubjectId'];?>"><?php echo $rslist1['vSubjectName'];?></option>										
					<?php	}
					}
				}
				  ?>
				  </select>
                    <font color="red">&nbsp;*</font> </td>
                </tr>
				<tr><td colspan="2">&nbsp;</td></tr>
							<tr align="right"> 
								<td width="31%" height="40" class="">&nbsp;</td>
								<td width="69%">
								<input name="courseid" value="<?php echo $rslist['iCourseID']; ?>" type="hidden">
								<input name="subjectid" value="<?php echo $id;?>" type="hidden">	
								<input type="hidden" name="hdn_submit" value="1">							
									<input type="image" name="imgupdategenre" src="./images/update.gif" alt="Update Subject Integrate"  class="mouse">
									<img name="imgdelete" src="./images/delete1.gif" alt="Delete Subject" onClick="return deleteope(<?php echo $rslist['iCourseSubjectid'] ?>,<?php echo $id;?>)" style="cursor:hand">									
									<a href="./viewsubjectintegrate.php"><img src="./images/cancel.gif" border="0"></a>
								&nbsp;</td>
							</tr>
							<?php 
		}
		else
		{
?>
			<tr>
				<td colspan="2" align="center" class="error"><?php echo "No Record Found";?></td></tr><?php } ?>

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
	  <?php } ?>
     
    </td>
  </tr>
</table>
</body>
</html>
