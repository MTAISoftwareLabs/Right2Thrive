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
<title>Add Learner to Tutor</title>
<link href="adminstyle.css" rel="stylesheet" type="text/css">

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
	document.frmuserintegrate.action="adduserintegrate.php?lid="+id;
	document.frmuserintegrate.submit();
}
function validate1(lid,cid)
{
	
	document.frmuserintegrate.method = "post";
	document.frmuserintegrate.action="adduserintegrate.php?lid="+lid+"&cid="+cid;
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
	
		//var len=document.frmuserintegrate.count.value;
		//alert(len);
		//for(i=1;i<len;i++)
		//{
			//var hb=cbo+i;
			
			//if(document.frmuserintegrate.hb.value=="-")
		//	{
			//	alert("please select learner");
				//document.frmuserintegrate.hb.focus();
				//return false;
			//}
		//}
	
	
	
	document.frmuserintegrate.action="adduserintegrate.php?active=1";
	document.frmuserintegrate.submit();
}


function win_onload()
{
 //document.frmsubjectintegrate.txtCourseId.focus();
}

</script>
</head>

<body leftmargin="0" topmargin="0" class="seffact" onLoad="win_onload()">
<?php 

if(isset($_GET['active']))
{
		$count=$_POST['count'];
		//echo $count;
		$t="";
		$t1="";
		for($i=1;$i<$count;$i++)
		{
			$cb="cbo".$i;
			$x=$_POST[$cb];
			
			$t=$t.$x.",";
			$t1=$t1."0,";
		}
		
		
		$x=strlen($t);
		$last=substr($t , $x-1, $x); 
		if($last==',')
			$str=substr($t , 0,$x-1);
			
		$x=strlen($t1);
		$last=substr($t1 , $x-1, $x); 
		if($last==',')
			$str1=substr($t1 , 0,$x-1);
			
			$Learner_id=$_POST['txtLearnerId'];
			$Course_id=$_POST['txtCourseId'];
				
			 $selectdata="select * from cpo_usercourse where iUserId=".$Learner_id." and iCourseId=".$Course_id." and vTutorId!=''";
			 $result=runquery1($selectdata);
			 $count= $result ? mysqli_num_rows($result) : 0 ;
			 if($count==0)
			 {
			 
			 			$fetchsubject="select vSubjectID from cpo_subjectincourse where iCourseID=$Course_id";
						$fetchsubjectresult=runquery1($fetchsubject);
						$id=mysqli_result($fetchsubjectresult,0,0);
			 
			 			$sql="update cpo_usercourse set vTutorId = '". $str ."',vSubjectId='".$id."',vSubjectStatus = '". $str1 ."' where iUserId=".$Learner_id." and iCourseId=".$Course_id."";
						runquery1($sql);
						$msg="Tutors added Successfully";
						
			 
			 }
			else
			{
						$msg="Tutors are already Added";
						 
						
			}
				
				
			//$record=mysqli_query($addsql1,$_SESSION['conn']) or die("could not execute query".mysqli_error());
			?>
  				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    					<tr> 
      							<td>&nbsp;</td>
    					</tr>
    					<tr> 
      							<td><h3><b>Learner Tutor Admin</b></h3></td>
    					</tr>
    					<tr> 
      							<td> 
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
          										<tr> 
            											<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            											<td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=userfortutor">Overview</a></div></td>
            											<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><img src="images/active_middle.jpg" width="11" height="23"></div></td>
            											<td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Add</font></div></td>
            											<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewuserfortutor.php">Edit / Delete</a></div></td>
											            <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listuserfortutor.php">List</a></div></td>
            											<td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            											<td width="34%" background="images/middle_last.jpg"><div align="right"></div></td>
          										</tr>
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
              													<table width="70%" border="0" align="center" cellpadding="0" cellspacing="1" class="table">
                														<tr> 
                  																<td>
																						<table width="100%" border="0" cellspacing="0" cellpadding="0">
 																	                    		<tr> 
																				                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
																				                        <td width="100%" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
																			                    </tr>
																		                </table>
																				</td>
                														</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
																		</tr>		
                														<tr> 
            																	
            <td align="center"> <font class="comment"><b><?php echo $msg; ?>.</b></font> 
            </td>
          																</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
														                </tr>	
                														<tr> 
																                <td align="center"><div align="right"><a href="adduserintegrate.php"><img src="images/add_new.gif" width="73" height="22" border="0"></a>&nbsp;<a href="overview.php?id=userfortutor"><img src="images/cancel.gif" width="73" height="22" border="0"></a>&nbsp;</div></td>
                														</tr>
                														<tr> 
                  																<td>&nbsp;</td>
                														</tr>
              													</table> 
														<tr> 
                  												<td>&nbsp;</td>
                										</tr>
<?php
}
else
{
?>

		<form action="adduserintegrate.php" name="frmuserintegrate" method="post">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
						<td>&nbsp;</td>
				</tr>
				<tr> 
						<td><h3><b>Learner Tutor Admin</b></h3></td>
				</tr>
				<tr> 
						<td> 
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr> 
																							<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            											<td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=userfortutor">Overview</a></div></td>
            											<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><img src="images/active_middle.jpg" width="11" height="23"></div></td>
            											<td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Add</font></div></td>
            											<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewuserfortutor.php">Edit / Delete</a></div></td>
											            <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listuserfortutor.php">List</a></div></td>
            											<td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            											<td width="34%" background="images/middle_last.jpg"><div align="right"></div></td>
										</tr>
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
						  						<td bgcolor="#FFFFFF">&nbsp;
														<table width="68%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								<td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
																								
                            <td width="417" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Add 
                              Learner to Tutor</strong></font></td>
																								<td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
									  													</tr> 
																						<tr> 
																								<td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
																						</tr>
																				</table>
																		</td>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Select 
                        Learner</td>
      					
                      <td width="60%" ><select name="txtLearnerId" class="textbox" onChange="validate(this.value)">
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
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Select 
                        Course</td>
      					
                      <td width="60%" ><select name="txtCourseId" class="textbox" onChange="validate1(document.frmuserintegrate.txtLearnerId.value,this.value)">
                          <option value="-">Select Course </option>
                          <?php
						  $result=runquery1($sqlcourse);
							
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
							?>
                          <option value="<?php echo $row["iCourseId"];?>">
						  <?php
						  	$sqlfetchname="select * from cpo_coursemaster where iCourseId=$row[iCourseId]";
							$resultname=runquery1($sqlfetchname);
							$name=mysqli_result($resultname,0,1);
							 echo $name;
						?></option>
                          <?php
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
											$id=mysqli_result($fetchsubjectresult,0,0);
											$id=explode(",",$id);
											?>
											<tr>
                      <td height="42" class=""> Select Tutors to Subjects</td>
                    </tr>
											<?php
											$cnt=1;
											for($i=0;$i<count($id);$i++)
											{
												
												$fetchsubjectname="select vSubjectName from cpo_subjectmaster where iSubjectId=$id[$i]";
												$fetchsubjectnameresult=runquery1($fetchsubjectname);
												$name=mysqli_result($fetchsubjectnameresult,0,0);
												?>
												<tr>
                      									<td align="center" height="42" class=""><?php echo $name ?></td>
					  									<td  height="42" class=""><select name=cbo<?phpecho $cnt;?>>
														
													<?php
													$fetchsubjectfromcourses="select * from cpo_tutorforcourses";
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
											?>
											<input type="hidden" name="count" value=<?php echo $cnt ?>>
											<?php
											
										}			
											
									?>	
											    															
    						<tr><td colspan="2">&nbsp;</td></tr>															
	  					
                      				
							
							
    															<tr> 
      																	<td colspan="2" align="center" class="" height="12">
																				
																				<input type="image" src="images/add.gif" border="0" alt="Add" onClick="return sub1()"> 
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
}
	?>
	
</body>
</html>
