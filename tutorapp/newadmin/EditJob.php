<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
$jobid = $_GET['id'];
$query = "select * from cpo_jobmaster where iJobId = ".$jobid."";
$result = runquery1($query) or die('could note execute'.mysqli_error());
$num = mysqli_num_rows($result);
$rslist = mysqli_fetch_array($result);
$sdate=explode('-',$rslist["dDate"]);
?>
<html>
<head>
<title>Edit Job</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function onload()
{
	document.frmjob.txtJobName.focus();
}
function validation()
{
	if(document.frmjob.txtJobName.value=="")
	{
		alert("Job Title can not be blank!");
		document.frmjob.txtJobName.focus();
		return false;
	}
	if(document.frmjob.txtJobDesc.value=="")
	{
		alert("Job Description can not be blank!");
		document.frmjob.txtJobDesc.focus();
		return false;
	}
	
	if(document.frmjob.txtContactAdd.value=="")
	{
		alert("Contact Address can not be blank!");
		document.frmjob.txtContactAdd.focus();
		return false;
	}
		if(document.frmjob.txtEmail.value=="")
	{
		alert("Please Enter E-mail Address");
		document.frmjob.txtEmail.focus();
		return false;
	}
	else
	{
		var x = document.frmjob.txtEmail.value;
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;  
		if (!filter.test(x))
		{
				alert("Enter a valid E-mail Address");
				document.frmjob.txtEmail.value="";
				document.frmjob.txtEmail.focus();
			return false;
		}
	}
	if(document.frmjob.txtPerson.value=="")
	{
		alert("Contact Person can not be blank!");
		document.frmjob.txtPerson.focus();
		return false;
	}
	if(document.frmjob.txtPhone.value=="")
	{
		alert("Contact Phone can not be blank!");
		document.frmjob.txtPhone.focus();
		return false;
	}
	if(document.frmjob.txtCategoryId.value=="-")
	{
		alert("Please Select Category");
		document.frmjob.txtCategoryId.focus();
		return false;
	}
	if(document.frmjob.txtInstituteId.value=="-")
	{
		alert("Please Select Institute");
		document.frmjob.txtInstituteId.focus();
		return false;
	}
	return true;
}

function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frmjob'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}

</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txtJobName'])) {?> onLoad="onload();" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['txtJobName']) )
{
	$Job_name=$_POST['txtJobName'];
	$Job_desc=addslashes($_POST['txtJobDesc']);
	$Job_contact=addslashes($_POST['txtContactAdd']);
	$Job_category=$_POST['txtCategoryId'];
	$Job_institute=$_POST['txtInstituteId'];
	$txtstdate=$_POST['txtstdate'];
	$txtemail=$_POST['txtEmail'];
	$txtperson=$_POST['txtPerson'];
	$txtphone=$_POST['txtPhone'];
		
		
	$sdate=explode("/",$txtstdate);
	
	if(isset($_POST['chkactive']))
	{
		$active=1;
	}
	else
	{
		$active=0;
	}
		
	$sql="update cpo_jobmaster set vJobEmailId='". $txtemail ."',vJobTitle='". $Job_name ."',vContactAdd='". $Job_contact ."',vContactPerson='". $txtperson ."',vContactPhone='". $txtphone ."',tJobDesc='".$Job_desc."',iStatus=".$active.",dDate='".$sdate[2].$sdate[1].$sdate[0]."',iCategoryId='".$Job_category."',iInstituteId='".$Job_institute."' where iJobId=".$jobid;
	//echo $sql;
	//exit;			
	$rscheck=runquery1($sql);
	if($rscheck)
	{
		$msg='Job "'.$Job_name.'" updated successfully.';
		$flg = "green";
	}
	else
	{
		$msg = "Error in update.";
		$flg = "red";
	}	
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Job Admin</td>
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
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=job" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
					   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="addjob.php" class="greendeactfont">Add</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listjob.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Job Information</td>
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
								<td colspan="2" align="center" height="35" class="fontblue"><?php echo $msg; ?></td><?php }?>	
								</tr>	
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr> 
								<td colspan="2" height="30" align="right">
									<a href="./viewjob.php"><img src="./images/go_back.gif" alt="View School" border="0"></a>
								</td>
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
     <form action="EditJob.php?id=<?php echo $jobid;?>" name="frmjob" method="post" onSubmit="return validation();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Job Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=job" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addjob.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listjob.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Edit Job</td>
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
                  <td width="30%" height="30"class="bodytext">&nbsp;Job Title 
                   </td>
								<td width="70%" >&nbsp;&nbsp;<input name="txtJobName" type="text" class="textbox" size="45" value="<?php echo $rslist["vJobTitle"]; ?>"><font color="#FF0000">&nbsp;*</font></td>
							</tr>
							<tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td class="bodytext">&nbsp;Job Description </td>
								<td align=left>&nbsp;&nbsp;<textarea name="txtJobDesc"   rows="3" cols="44"class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["tJobDesc"]);?></textarea><font color="#FF0000">&nbsp;*</font>
								  </td>
							  </tr>
							
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
                
							  
							 
							  <tr> 
								
                  <td  class="bodytext">&nbsp;Job Contact Address </td>
								<td align=left>&nbsp;&nbsp;<textarea name="txtContactAdd"   rows="3" cols="44" class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["vContactAdd"]);?></textarea><font color="#FF0000">&nbsp;*</font>
								  </td>
							  </tr align=right class="bodytext">
							   <td colspan="2" height="2%">&nbsp;</td>
							  <tr> 
							  <tr> 
                  <td width="30%" height="30" class="bodytext" >&nbsp;Email Address</td>
								<td width="70%" >&nbsp;&nbsp;<input name="txtEmail" type="text" class="textbox" size="40" value="<?php echo $rslist["vJobEmailId"]; ?>"><font color="#FF0000">&nbsp;*</font></td>
								 <td colspan="2" height="2%">&nbsp;</td>
							  <tr> 
							  <td colspan="2" height="2%">&nbsp;</td>
							  <tr> 
                  <td width="30%" height="30" class="bodytext">&nbsp;Contact 
                    Person </td>
								<td width="70%" >&nbsp;&nbsp;<input name="txtPerson" type="text" class="textbox" size="40" value="<?php echo $rslist["vContactPerson"]; ?>"><font color="#FF0000">&nbsp;*</font></td>
								 <td colspan="2" height="2%">&nbsp;</td>
							  <tr>
							  <td colspan="2" height="2%">&nbsp;</td> 
							  <tr>
							   
                  <td width="30%" height="30" class="bodytext">&nbsp;Contact 
                    Phone</td>
								<td width="70%" >&nbsp;&nbsp;<input name="txtPhone" type="text" class="textbox" size="40" value="<?php echo $rslist["vContactPhone"]; ?>"><font color="#FF0000">&nbsp;*</font></td>
							</tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							  <tr> 
                  <td  width="36%" height="25" class="bodytext">&nbsp;Validation 
                    Date </td>
				  
                  <td width="64%" height="25">&nbsp;&nbsp;<input name="txtstdate" type="text" class="textbox" readonly value="<?php echo $sdate[2]."/".$sdate[1]."/".$sdate[0] ?>">
							  <a href="javascript:pickdate('txtstdate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>
                    <font color="red">&nbsp;*</font> </td>
                </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							<tr> 
                  <td  class="bodytext">&nbsp;Job Category: </td>
								<td align=left>&nbsp;&nbsp;<select name="txtCategoryId">
							<option value="-">Select Category</option>
					
					<?php
						   $fetch="select * from cpo_categorymaster where iStatus=1";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
							$sdate=explode("-",$rslist['dDate']);
							?>
								<option value="<?php echo $row["iCategoryId"];?>" <?php if($row["iCategoryId"]==$rslist["iCategoryId"])
						{
						?>
						selected
						<?php
						}?>
						 ><?php echo $row["vCategoryName"];?></option>
        	              	<?php
							}
							?>
                    		</select><font color="#FF0000">&nbsp;*</font>
                  </td>
							  </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>

<tr> 
                  <td  class="bodytext">&nbsp;Institute Name:</td>
								<td align=left>&nbsp;&nbsp;<select name="txtInstituteId">
							<option value="-">Select Institute</option>
					
					<?php
						   $fetch="select * from cpo_institutemaster where iStatus=1";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
							
							?>
								<option value="<?php echo $row["iInstituteId"];?>" <?php if($row["iInstituteId"]==$rslist["iInstituteId"])
						{
						?>
						selected
						<?php
						}?>
						 ><?php echo $row["vInstituteName"];?></option>
        	              	<?php
							}
							?>
                    		</select><font color="#FF0000">&nbsp;*</font>
                  </td>
					<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  
							  <tr> 
                  <td  height="28" class="bodytext">&nbsp; 
                    Active</td>
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
							  
							  
														
							<tr align="right"> 
								<td width="31%" height="40" class="">&nbsp;</td>
								<td width="69%">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Job" class="mouse">&nbsp;
									<input name="id" type="hidden" value="<?=$rslist["iJobId"]?>">
									<a href="./viewjob.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
								&nbsp;</td>
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
