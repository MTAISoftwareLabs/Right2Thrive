<?php
@ob_start();
include_once 'dbConnection.php';
$getid = isset($_GET['id'])?$_GET['id']:'';
if($getid=='')
{
$sqlcourse="select * from cpo_usercourse";
echo $sqlcourse;
}
else
{
$sqlcourse="select * from cpo_usercourse where iUserId=$getid";
echo $sqlcourse;
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
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Select 
                        Learner</td>
      					
                      <td width="60%" ><select name="txtLearnerId" onChange="validate(this.value)">
                          <option value="-">Select Course </option>
                          <?php
						   $fetch="select * from cpo_userMaster where iUserType=2";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
							?>
                          <option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
                          <?php
							}
							?>
                        </select><?php if ($getid<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getid;?>',document.frmuserintegrate.txtLearnerId);</script>
												<?php
												}?> <font color="#FF0000">*</font></td>
    															</tr>
							<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Select 
                        Course</td>
      					
                      <td width="60%" ><select name="txtCourseId"">
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
							$resultname=mysqli_query($sqlfetchname);
							$name=mysqli_result($resultname,0,1);
							 echo $name;
						?></option>
                          <?php
							}
							?>
                        </select> <font color="#FF0000">*</font></td>
    															</tr>
							
    															
    						<tr><td colspan="2">&nbsp;</td></tr>															
	  					
                      
																
					
							
							
    															<tr> 
      																	<td colspan="2" align="center" class="" height="12">
																				<input type="image" src="images/next1.gif" border="0" alt="Next" > 
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
		
	
</body>
</html>
