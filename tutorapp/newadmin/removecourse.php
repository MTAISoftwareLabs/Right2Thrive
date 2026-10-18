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
} 
$getlid = isset($_GET['lid'])?$_GET['lid']:'';
$getcid = isset($_GET['cid'])?$_GET['cid']:'';

//echo $getlid;
//echo $getcid;

if($getlid=='')
{
$sqlcourse="select * from cpo_coursemaster";
//echo $sqlcourse;
}
else
{
$sqlcourse="select * from cpo_usercourse where iUserId=$getlid";
//echo $sqlcourse;
}

?>
<html>
<head>
<title>Remove Course From Learner</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
<script language="JavaScript">
function getselected(val,obj)
{
	if(val != "")
	{
		for(i=obj.length-1;i>=0;i--)
		{
			if(obj.options[i].value==val)
			{
				obj.options[i].selected=true;
			}
		}
	}
	else
	{
		obj.options[0].selected=true;
	}
}
function getselected1(val,obj)
{
	if(val != "")
	{
		for(i=obj.length-1;i>=0;i--)
		{
			if(obj.options[i].value==val)
			{
				obj.options[i].selected=true;
			}
		}
	}
	else
	{
		obj.options[0].selected=true;
	}
}
function validate(id)
{
	//alert(id);
	document.frmuserintegrate.method = "post";
	document.frmuserintegrate.action="removecourse.php?lid="+id;
	document.frmuserintegrate.submit();
}
function validate1(lid,cid)
{
	
	document.frmuserintegrate.method = "post";
	document.frmuserintegrate.action="removecourse.php?lid="+lid+"&cid="+cid;
	document.frmuserintegrate.submit();
}
function sub1()
{
	if(document.frmuserintegrate.txtLearnerId.value=="-")
	{
		alert("Please Select Learner Name");
		document.frmuserintegrate.txtLearnerId.focus();
		return false;
	}
	if(document.frmuserintegrate.txtCourseId.value=="-")
	{
		alert("Please Select Course Name");
		document.frmuserintegrate.txtCourseId.focus();
		return false;
	}
		
	document.frmuserintegrate.action="removecourse.php?active=1";
	document.frmuserintegrate.submit();
}
function onload()
{
	document.frmuserintegrate.txtLearnerId.focus();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_GET['txtLearnerId'])){?> onLoad="onload()" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 

if(isset($_GET['active']))
{							
	$Learner_id=$_POST['txtLearnerId'];
	$Course_id=$_POST['txtCourseId'];
		
	 $selectdata="delete from cpo_usercourse where iUserId=".$Learner_id." and iCourseId=".$Course_id."";
	 runquery1($selectdata);
	 
	 $msg = "Course Removed Successfully";
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Remove Course Admin</td>
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
                     <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
					<td width="25%" align="center" class="midtabgreen">Remove Course</td>
					<td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
					 <td width="0%" align="right"></td>
					<td width="25%" align="center" ></td>
					<td width="0%" align="left"></td>
					<td width="0%" align="right"></td>
					<td width="25%" align="center" ></td>
					<td width="0%" align="left"></td>
					<td width="0%" align="right"></td>
					<td width="25%" align="center" ></td>
					<td width="0%" align="left"></td>
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
                                              <td class="toheaderbg" colspan="3">Remove Course Information</td>
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
									 <?php if($flg == 'red')
																					{?>
									  <tr>
										<td height="35" align="center"><img src="./images/alert.gif" border="0"></td>
									  </tr>
									  <tr>
										<td  align="center" height="35" class="error"><?php echo $msg; ?></td>
									  </tr>
									  <?php }
																											else
																											{?>
									  <tr>
										<td align="center"><font class="comment"><b><?php echo $msg ?></b></font> </td>
									  </tr>
									  <tr>
										<td align="center">&nbsp;</td>
									  </tr>
									  <?php
																					
																					} ?>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="center"><div align="right"><a href="removecourse.php"><img src="images/go_back.gif"  border="0"></a> &nbsp;</div></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
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
      <?php } else {?>
   <form action="adduserintegrate.php" name="frmuserintegrate" method="post" onSubmit="return sub1()">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Remove Course Admin</td>
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
                         <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
						<td width="25%" align="center" class="midtabgreen">Remove Course</td>
						<td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center"></td>
                        <td width="0%" align="left"></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center"></td>
                        <td width="0%" align="left"></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center" ></td>
                        <td width="0%" align="left"></td>
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
                                                <td class="toheaderbg" colspan="3">Remove Course</td>
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
										  								
                          
                      <td width="29%" height="30" class="">&nbsp;&nbsp;Select 
                        Learner</td>
      					
                      <td width="71%" ><select name="txtLearnerId" class="textbox" onChange="validate(this.value)">
                          <option value="-">Select Learner </option>
                          <?php
						   $fetch="select DISTINCT iUserId from cpo_usercourse where iCourseStatus=1";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
								$fetchname="select * from cpo_usermaster where iUserId=".$row["iUserId"];
								$resultfetchname=runquery1($fetchname);
								$tutorname=mysqli_result($resultfetchname,0,1);
							?>
                          <option value="<?php echo $row["iUserId"];?>"><?php echo $tutorname;?></option>
                          <?php
							}
							?>
                        </select><?php if ($getlid<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getlid;?>',document.frmuserintegrate.txtLearnerId);</script>
												<?php
												}?> <font color="#FF0000">*</font></td>
    															</tr>
							<tr> 
										  								
                          
                      <td width="29%" height="30" class="">&nbsp;&nbsp;Select 
                        Course</td>
      					
                      <td width="71%" ><select name="txtCourseId" class="textbox">
                          <option value="-">Select Course </option>
                          <?php
						  $result=runquery1($sqlcourse);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							while($row=mysqli_fetch_array($result))
							{
									$sqlfetchname="select * from cpo_coursemaster where iCourseId=$row[iCourseId] and iStatus=1";
									$resultname=runquery1($sqlfetchname);
									$count1= $resultname ? mysqli_num_rows($resultname) : 0 ;
									if ($count1 > 0)
									{
									$name=mysqli_result($resultname,0,1);
									
									?>
										<option value="<?php echo $row["iCourseId"];?>">
						 			 <?php
						  				echo $name;
									?></option>
                          			<?php
									}
							}
							?>
                        </select><?php if ($getcid<>'')
												{?>  
											  <script language="JavaScript">getselected1('<?php echo $getcid;?>',document.frmuserintegrate.txtCourseId);</script>
												<?php
												}?> <font color="#FF0000">*</font></td>
    															</tr>
									
								<?php if ($getcid<>'')
								{
											$fetchsubject="select vSubjectID from cpo_subjectincourse where iCourseID=$getcid";
											$fetchsubjectresult=runquery1($fetchsubject);
											$num = $fetchsubjectresult? mysqli_num_rows($fetchsubjectresult) : 0;
											if ($num > 0)
											{
											$id=mysqli_result($fetchsubjectresult,0,0);
											$id=explode(",",$id);
											?>
											<tr>
												
                      <td height="30" class=""> &nbsp;&nbsp;Select Tutors to Subjects</td>
                    </tr>					<?php
											$cnt=1;
											for($i=0;$i<count($id);$i++)
											{
												
												$fetchsubjectname="select vSubjectName from cpo_subjectmaster where iSubjectId=$id[$i]";
												$fetchsubjectnameresult=runquery1($fetchsubjectname);
												$name=mysqli_result($fetchsubjectnameresult,0,0);
												?>
												<tr>
                      									<td align="center" height="30" class=""><?php echo $name ?></td>
					  									<td  height="30"><select id="1" name="cbo<?phpecho $cnt;?>" class="textbox">
														<option value="-">Select Tutor</option>
														
													<?php
													$fetchsubjectfromcourses="select * from cpo_tutorforcourses where iCourseID=$getcid";
													$result=runquery1($fetchsubjectfromcourses);
													while($rslist = mysqli_fetch_array($result))
													{	
															$idsubject=explode(",",$rslist["vSubjectIDs"]);
																										
																for($j=0;$j<count($idsubject);$j++)
																	{
																			if($idsubject[$j]==$id[$i])
																			{
																				$fetchname="select * from cpo_usermaster where iUserId=".$rslist["iUserID"];
																				$resultfetchname=runquery1($fetchname);
																				$tutorname=mysqli_result($resultfetchname,0,1);
																			?>
																				<option value="<?php echo $rslist["iUserID"];?>"><?php echo $tutorname;?></option>
																			 <?php
																			 }
																	}
													}
																																					
													?>							
											
							
                        </select></td>
                    </tr>
												
												<?php
												$cnt=$cnt+1;
												}
											}
											else
											{
													$cnt=-2;
											}
											?>
											<input type="hidden" name="count" value=<?php echo $cnt ?>>
											<?php
											
										}			
											
									?>	
											    															
    						<tr><td colspan="2">&nbsp;</td></tr>															
	  					
                      			 
							
							
    															<tr> 
      																<td colspan="2" align="right" class="" height="12"><input type="image" src="images/cmd_Remove.gif" border="0" alt="Add">&nbsp;&nbsp;</td>
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
