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
function sub1()
{
	document.frmuserintegrate.action="adduser.php?active=1";
	document.frmuserintegrate.submit();
}
function validate(id)
{
	//alert(id);
	document.frmuserintegrate.method = "post";
	document.frmuserintegrate.action="adduserintegrate.php?id="+id;
	document.frmuserintegrate.submit();
}

function validation()
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
	document.frmuserintegrate.method = "post";
	document.frmuserintegrate.action="adduser.php";
	document.frmuserintegrate.submit();

	
	return true;
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
	
		$Subject_id = "";	
		foreach($_POST['txtSubjectId'] as $value)
		{
			$Subject_id.= $value. ",";
		}
		$Subject_id = substr($Subject_id,0,strlen($Subject_id)-1);
		
		if ($Subject_id <> "-")
		{
			$Course_id=$_POST['txtCourseId'];
				
			 $selectdata="select vSubjectID,iCourseID from cpo_subjectincourse where iCourseID=".$Course_id."";
			 $result=runquery1($selectdata);
			 $count= $result ? mysqli_num_rows($result) : 0 ;
			 if($count==1)
			 {
					$Subject_id = "";	
					$id1=mysqli_result($result,0,0);
					$tutorcourseid=mysqli_result($result,0,1);
					$id=explode(",", $id1);
					$Subject_id = $id1.",";
					$change = 0;
					foreach($_POST['txtSubjectId'] as $value)
					{
						$flag = 0;
						for($i=0;$i<=count($id)-1;$i++)
						{
							if ($value == $id[$i])
							{
								$flag = 1;
							}
						}
						if ($flag == 0)
						{
							$Subject_id = $Subject_id . $value .",";		
							$change = 1;
						}
					}
					$Subject_id = substr($Subject_id,0,strlen($Subject_id)-1);
					if($change == 0)
						$msg="Record already exist";
					else
					{
						$sql="update cpo_subjectincourse set vSubjectID = '". $Subject_id ."' where iCourseID=".$Course_id;
						runquery1($sql);
						$msg="Record Updated Successfully";
					}
				}
				else
				{
					$addsql="insert into cpo_subjectincourse (vSubjectID,iCourseID)  values ('".$Subject_id."',".$Course_id.")";
					$record=runquery1($addsql);
					$msg="Subject Integrated to Course Successfully";
				}
			}
			else
			{
				$msg="First Select Subjects";
			}	
			//$record=mysqli_query($addsql1,$HTTP_SESSION_VARS['conn']) or die("could not execute query".mysqli_error());
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
            											<td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=subjectincourse">Overview</a></div></td>
            											<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><img src="images/active_middle.jpg" width="11" height="23"></div></td>
            											<td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Add</font></div></td>
            											<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewsubjectintegrate.php">Edit / Delete</a></div></td>
											            <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listsubjectintegrate.php">List</a></div></td>
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
																                <td align="center"><div align="right"><a href="addsubjectintegrate.php"><img src="images/add_new.gif" width="73" height="22" border="0"></a>&nbsp;<a href="viewsubjectintegrate.php"><img src="images/edit1.gif" width="73" height="22" border="0"></a>&nbsp;</div></td>
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
		$learner=$_POST['txtCourseId'];
		$course=$_POST['txtLearnerId'];
		
?>

  		<form action="adduserintegrate.php" name="frmuserintegrate" method="post" onSubmit="return validation();">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
						<td>&nbsp;</td>
				</tr>
				<tr> 
						<td><h3><b>Learner Tutor Integrate Admin</b></h3></td>
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
										  								
                          
                      
                  <td width="40%" height="42" class="">&nbsp;&nbsp;Select Tutor</td>
      					
                      <td width="60%" > <select name=txtSubjectId[] multiple>
                          <option value="-">Select Tutor </option>
                          <?php
						   $fetch="select * from cpo_userMaster where iUserType=1";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
							?>
                          <option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
                          <?php
							}
							?>
                        </select> <font color="#FF0000">*</font></td>
    															</tr>
							
							
    															
    						<tr><td colspan="2">&nbsp;</td></tr>															
	  					
                      
																
					
							
							
    															<tr> 
      																	<td colspan="2" align="center" class="" height="12">
																				<input name="image" type="image" src="images/add.gif" width="73" height="22" onClick="sub1()"> 
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
