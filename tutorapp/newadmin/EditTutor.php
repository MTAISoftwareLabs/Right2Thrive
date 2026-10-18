<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
$userid = $_GET['id'];
$query = "select * from cpo_usermaster where iUserId = ".$userid."";
$result = runquery1($query) or die('could note execute'.mysqli_error());
$num = mysqli_num_rows($result);
$rslist = mysqli_fetch_array($result)
?>
<html>
<head>
<title>Edit School</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function onload()
{
	document.frmtutor.txtfName.focus();
}
function validation()
{
	if(document.frmtutor.txtfName.value=="")
	{
		alert("Please Enter First Name");
		document.frmtutor.txtfName.focus();
		return false;
	}
	if(document.frmtutor.txtAdd1.value=="")
	{
		alert("Please Enter Address");
		document.frmtutor.txtAdd1.focus();
		return false;
	}
	if(document.frmtutor.txtPhoneNo.value=="")
	{
		alert("Please Enter Phone No");
		document.frmtutor.txtPhoneNo.focus();
		return false;
	}
	if(document.frmtutor.txtMobileNo.value=="")
	{
		alert("Please Enter Mobile No.");
		document.frmtutor.txtMobileNo.focus();
		return false;
	}
	if(document.frmtutor.txtEmailId.value=="")
	{
		alert("Please Enter E-mail Address");
		document.frmtutor.txtEmailId.focus();
		return false;
	}
	else
	{
	
		var x = document.frmtutor.txtEmailId.value;
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;  
		if (!filter.test(x))
		{
			alert("Enter a valid E-mail Address");
			document.frmtutor.txtEmailId.value="";
			document.frmtutor.txtEmailId.focus();
			return false;
		}
	}
	if(document.frmtutor.txtpass.value=="")
	{
		alert("Please Enter Password");
		document.frmtutor.txtpass.focus();
		return false;
	}
	if(document.frmtutor.txtpass.value.length<4)
	{	
		alert("Password must be more than 4 character!");
		document.frmtutor.txtpass.focus();
		return false;
	}
	if(document.frmtutor.txtpass.value.length>16)
	{	
		alert("Password not more than 16 character!");
		document.frmtutor.txtpass.focus();
		return false;
	}
	if(document.frmtutor.txtQualification.value=="")
	{
		alert("Please Enter Qualification");
		document.frmtutor.txtQualification.focus();
		return false;
	}		
	return true;
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txtfName'])) {?> onLoad="onload();" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['txtfName'])  )
{
	$fname=$_POST['txtfName'];
	$pass=$_POST['txtpass'];
	$add1=$_POST['txtAdd1'];
	$phone=$_POST['txtPhoneNo'];
	$mobile=$_POST['txtMobileNo'];
	$email=$_POST['txtEmailId'];
	$qualification=addslashes($_POST['txtQualification']);
	$achieve=$_POST['txtAchieve'];
	if(isset($_POST['chkactive']))
	{
		$active=1;
	}
	else
	{
		$active=0;
	}
		
	$sql="update cpo_usermaster set vUserName='". $fname ."',vUserPassword='". $pass ."',vUserAddress='".$add1."', vUserMobile='".$mobile."',vUserPhone='".$phone."',vUserEmailId='".$email."',TUserQualification='".$qualification."',TUserAchive='".$achieve."',iUserStatus='".$active."' where iUserId=".$userid;
      
	$rscheck=runquery1($sql) or die('could not'.mysqli_error());
	$flg="green";
	$msg='Tutor "'.$fname.'"  updated successfully.';
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Tutor Admin</td>
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
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=tutor" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
					   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="addtutor.php" class="greendeactfont">Add</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listtutor.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Tutor Information</td>
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
									<a href="./viewtutor.php"><img src="./images/go_back.gif" alt="View Tutor" border="0"></a>
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
     <form name="frmtutor" action="" method="post" onSubmit="return validation();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Tutor Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=tutor" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addtutor.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listtutor.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Edit Tutor</td>
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
                  <td width="32%" height="30" class="" >&nbsp;&nbsp;Tutor Name 
                    </td>
                  <td width="68%" >&nbsp; 
                    <input name="txtfName" type="text" class="textbox" size="40" value="<?php echo $rslist["vUserName"]; ?>"> 
                    <font color="#FF0000">*</font></td>
                </tr>
                <tr> 
                  <td colspan="2" height="2%">&nbsp;</td>
                </tr>
                <tr> 
                  <td class="bodytext">&nbsp;&nbsp;Address</td>
                  <td align=left>&nbsp; 
                    <textarea name=txtAdd1 maxlength =255  rows="3" cols="45"class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["vUserAddress"]);?></textarea><font color="#FF0000">&nbsp;*</font> 
                  </td>
                </tr>
                <td colspan="2" height="2%">&nbsp;</td>
                </tr>
                <tr> 
                  <td class="bodytext">&nbsp;&nbsp;Phone No </td>
                  <td align=left>&nbsp; 
                    <input name="txtPhoneNo"type="text" class="textbox" size=20 maxlength=12  value="<?php echo $rslist["vUserMobile"]; ?>" onBlur="chkfloat(this)"><font color="#FF0000">&nbsp;*</font> 
                  </td>
                </tr>
                <td colspan="2" height="2%">&nbsp;</td>
                </tr>
                <tr> 
                  <td  class="bodytext">&nbsp;&nbsp;Mobile No</td>
                  <td align=left>&nbsp; 
                    <input name="txtMobileNo" type="text" class="textbox" size="20" maxlength=12 value="<?php echo $rslist["vUserPhone"]; ?>" onBlur="chkfloat(this)"><font color="#FF0000">&nbsp;*</font> 
                  </td>
                </tr>
                <td colspan="2" height="2%">&nbsp;</td>
                </tr>
                <tr> 
                  <td  class="bodytext">&nbsp;&nbsp;E-mail ID</td>
                  <td align=left>&nbsp; 
                    <input name="txtEmailId" type="text" class="textbox" value="<?php echo $rslist["vUserEmailId"]; ?>"><font color="#FF0000">&nbsp;*</font> 
                  </td>
                </tr>
				<td colspan="2" height="2%">&nbsp;</td>
                </tr>
                
                
				<tr> 
                  <td  class="bodytext">&nbsp;&nbsp;Password</td>
                  <td align=left>&nbsp;&nbsp;<input name="txtpass" type="password" class="textbox" size="40" value="<?php echo $rslist["vUserPassword"]; ?>"> 
				  <font color="#FF0000">&nbsp;*</font> 
                  </td>
                </tr>
                <td colspan="2" height="2%">&nbsp;</td>
                <tr> 
                  <td class="bodytext">&nbsp;&nbsp;Qualification</td>
                  <td align=left>&nbsp;&nbsp;<textarea name="txtQualification" maxlength =255  rows="3" cols="45"class="textbox"><?php echo ereg_replace('<br />',  '' ,  $rslist["TUserQualification"]);?></textarea> 
				  <font color="#FF0000">&nbsp;*</font> 
                  </td>
                </tr>
                <td colspan="2" height="2%">&nbsp;</td>
                </tr>
                <tr> 
                  <td  class="bodytext">&nbsp;&nbsp;Achievements</td>
                  <td align=left>&nbsp; 
                    <textarea name=txtAchieve maxlength =255  rows="3" cols="45"class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["TUserAchive"]);?></textarea> 
                  </td>
                </tr>
                <td colspan="2" height="2%">&nbsp;</td>
                </tr>
                <tr> 
                  <td  height="28" valign="top" class="bodytext">&nbsp;&nbsp; 
                    Active</td>
                  <td align=left valign="top">&nbsp;&nbsp;
                    <?php
					
				  if (intval($rslist["iUserStatus"])==0)
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
                    <input type="hidden" name="txtchk" value="1"> <input type="hidden" name="txtnewsid" value="<?php echo $newsid ?>"> 
                  </td>
                </tr>
                <tr align="right"> 
                  <td width="32%" height="40" class="">&nbsp;</td>
                  <td width="68%"> <input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Tutor" class="mouse"> 
                    &nbsp; <input name="id" type="hidden" value="<?=$rslist["iUserId"]?>"> 
                    <a href="./viewtutor.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a> 
                 &nbsp; </td>
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
