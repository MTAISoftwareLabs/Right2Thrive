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
$getlid = isset($_GET['lid']) ? (int) $_GET['lid'] : 0;
$getcidRaw = isset($_GET['cid']) ? (string) $_GET['cid'] : '';
// Course <select> values are "iCourseId~vCourseName"; SQL must use the id only.
$getcid = '';
if ($getcidRaw !== '') {
	if (strpos($getcidRaw, '~') !== false) {
		$getcid = (string) (int) explode('~', $getcidRaw, 2)[0];
	} else {
		$getcid = (string) (int) $getcidRaw;
	}
}

//echo $getlid;
//echo $getcid;

if ($getlid === 0)
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
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

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
	
	var len=document.all.length;
	var flag = 0;
	for(i=0;i<len;i++)
	{
		if(document.all(i).value=='-' && document.all(i).id==1)
		{
		
			flag = 1;
						
		}
	}
	
	if (flag == 1)
	{
		alert("First Selects Tutors to all Subjects !");
		return false;
	}
	
	
	
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
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	<?php 
if(isset($_GET['active']))
{
    // 	var_dump( $_POST);
		  //  	 die;
		  $Learner_id=$_POST['txtLearnerId'];
        $Course_id = isset($_POST['txtCourseId']) ? (string) $_POST['txtCourseId'] : '';
        if (strpos($Course_id, '~') !== false) {
            $Course_id = (string) (int) explode('~', $Course_id, 2)[0];
        } else {
            $Course_id = (string) (int) $Course_id;
        }
        $str= 92;
        $id=$_POST['x'];
        $str1=$_POST['y'];
        
        
		$count=1;
		if($count==0)
		{
		    	 
				$msg="Unable to Add Learner - No Subjects Found in Courses";	
		}
		else
		{		
				// 		echo("test");
		  //  	 die;
		    	 
		    	 
					
											$sql = "INSERT INTO cpo_usercourse (iUserId, iCourseId, vTutorId, vSubjectId, vSubjectStatus) 
                VALUES ('$Learner_id', '$Course_id', '$str', '$id', '$str1')";
											runquery1($sql);
											$msg="Tutors added Successfully";
								// 						echo("test1");
		    	 //die;
											
								 
								 }
							
		
				
				
			//$record=mysqli_query($addsql1,$HTTP_SESSION_VARS['conn']) or die("could not execute query".mysqli_error());}
?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Subject Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=userfortutor" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewuserfortutor.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listuserfortutor.php" class="greendeactfont">List</a></td>
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
                            <td class="toheaderbg" colspan="3">Learner - Tutor Information</td>	
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
			
              			<font class="fontblue"><b><?php echo $msg ?></b></font> 
               													</td>
          																</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
														                </tr>	
                														<tr> 
																                <td align="center"><div align="right"><a href="adduserintegrate.php"><img src="images/add_new.gif" width="73" height="22" border="0"></a>&nbsp;<a href="overview.php?id=userfortutor"><img src="images/cancel.gif" width="73" height="22" border="0"></a> &nbsp;</div></td>
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
	<form action="adduserintegrate.php" name="frmuserintegrate" method="post">

	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Learner - Tutor Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=subject" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewuserfortutor.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listsubject.php" class="greendeactfont">List</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">Add Learner- Tutor</td>
																								
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
										  								
                          
                      <td width="29%" height="30" class="">&nbsp;&nbsp;Select 
                        Learner</td>
      					
                      <td width="71%" >
                          
                      <select name="txtLearnerId" class="textbox" onChange="validate(this.value)" >
                   <?php $sqlst = "select iUserId,vUserName from cpo_usermaster where iUserType=2";
					$queryst = runquery1($sqlst);
					while($rowst = mysqli_fetch_array($queryst))
					{								
					?>
				<option value="<?=$rowst['iUserId']?>"><?=$rowst['vUserName']?></option>
				<?php }?>
                                                                    </select>
                        
                        
                        <?php if ($getlid<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getlid;?>',document.frmuserintegrate.txtLearnerId);</script>
												<?php
												}?> <font color="#FF0000">*</font></td>
    															</tr>
							<tr> 
										  								
                          
                      <td width="29%" height="30" class="">&nbsp;&nbsp;Select 
                        Course</td>
      					
                      <td width="71%" >
                          
                         <select name="txtCourseId" class="textbox" onChange="validate1(document.frmuserintegrate.txtLearnerId.value,this.value)">
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
                    </select>
                        
                        <?php if ($getcidRaw !== '')
												{?>  
											  <script language="JavaScript">getselected1('<?php echo htmlspecialchars($getcidRaw, ENT_QUOTES, 'UTF-8'); ?>',document.frmuserintegrate.txtCourseId);</script>
												<?php
												}?> <font color="#FF0000">*</font></td>
    															</tr>
									
								<?php if ($getcid !== '' && (int) $getcid > 0)
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
												<td  class="">&nbsp;&nbsp;Select Tutors to Subjects</td>
                    </tr>					<?php
											$cnt=1;
											for($i=0;$i<count($id);$i++)
											{
												
												$fetchsubjectname="select vSubjectName from cpo_subjectmaster where iSubjectId=$id[$i]";
												$fetchsubjectnameresult=runquery1($fetchsubjectname);
												$name=mysqli_result($fetchsubjectnameresult,0,0);
												?>
												<tr>
                      									<td align="left" >&nbsp;&nbsp;<?php echo $name ?></td>
					  									<td  height="30"><select id="1" name="cbo<?php echo $cnt; ?>" class="textbox">
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
                          												
                          
                      <td> </td>
      																	
                          <td style="height:50px; padding-right:10px" align="right" valign="middle"><input type="image" src="images/add.gif" border="0" alt="Add" onClick="return sub1()">&nbsp;&nbsp;<a href="overview.php?id=userfortutor"><img src="images/cancel.gif"  border="0"></a></td>
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
