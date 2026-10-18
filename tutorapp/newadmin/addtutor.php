<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
?>
<html>
<head>
<title>Add Tutor</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
<script src="../include/functions.js" language="JavaScript"></script>
<script language="javascript">
function checked()
{
         if(document.frmtutor.txtfname.value=="")
         {
          alert("Please Enter First Name");
          document.frmtutor.txtfname.focus();
          return false;
         }
		
		   if(document.frmtutor.txtadd.value=="")
         {
          alert("Please Enter Address ");
          document.frmtutor.txtadd.focus();
          return false;
         }
		 
		  if(document.frmtutor.txtphone.value=="")
         {
          alert("Please Enter Phone No");
          document.frmtutor.txtphone.focus();
          return false;
         }
		 if(document.frmtutor.txtmobile.value=="")
         {
          alert("Please Enter Mobile No.");
          document.frmtutor.txtmobile.focus();
          return false;
         }
        if(document.frmtutor.txtemail.value=="")
         {
          alert("Please Enter Email Address");
          document.frmtutor.txtemail.focus();
          return false;
         }
		 else
		 {
		
			var x = document.frmtutor.txtemail.value;
			var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;  
			if (!filter.test(x))
			{
					alert("Enter a valid email Address");
					document.frmtutor.txtemail.value="";
					document.frmtutor.txtemail.focus();
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
		   if(document.frmtutor.txtqualification.value=="")
         {
          alert("Please Enter Qualification");
          document.frmtutor.txtqualification.focus();
          return false;
         }
         return true;
}
function onload()
{
	document.frmtutor.txtfname.focus();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txtfname'])) {?> onLoad="onload()" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top"><?php 
if(isset($_POST['txtcheck']))
{
	$flg = '';
	$msg = '';
	$fname=$_POST['txtfname'];
	$add1=addslashes($_POST['txtadd']);
	$phone=$_POST['txtphone'];
	$mobile=$_POST['txtmobile'];
	$email=$_POST['txtemail'];
	$pass=$_POST['txtpass'];
	$qualification=addslashes($_POST['txtqualification']);
	$achieve=addslashes($_POST['txtachieve']);
	
	if(isset($_POST['chkactive']))
	{
		$status=1;
	}
	else
	{
		$status=0;
	}
	$sql="select vUserEmailId from cpo_usermaster where vUserEmailId='".$email."'";
	$result=runquery1($sql);
	$num = mysqli_num_rows($result);
	if($num > 0)
	{
		$flg = "red";
		$msg = "Email-Id already exist.";
	}
	else
	{
		$addsql="insert into cpo_usermaster(vUserName, vUserPassword, vUserAddress,vUserMobile, vUserPhone, vUserEmailId, iUserStatus,TUserQualification ,iUserType,TUserAchive ) values ('".$fname."','".$pass."','".$add1."','".$mobile."','".$phone."','".$email."','".$status."','".$qualification."','1','".$achieve."')";
		$record=runquery1($addsql) or die('error'.mysqli_error());
		if($record)
		{
			$msg = 'Tutor "'.$fname.'" added successfully.';
		}
		else
		{
			$flg = 'red';
			$msg="Error in insert.";
		}
	}
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
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Add</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="viewtutor.php" class="greendeactfont">Edit / Delete</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
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
									 <?php if($flg == 'red'){?>
									  <tr>
										<td height="35" align="center"><img src="./images/alert.gif" border="0"></td>
									  </tr>
									  <tr>
										<td  align="center" height="35" class="error"><?php echo $msg; ?></td>
									  </tr>
									  <?php }else{?>
									  <tr>
										<td align="center"><font class="fontblue"><b><?php echo $msg ?></b></font> </td>
									  </tr>
									  <tr>
										<td align="center">&nbsp;</td>
									  </tr>
									  <?php } ?>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="center"><div align="right"><a href="addtutor.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=tutor"><img src="images/cancel.gif"  border="0"></a> &nbsp;</div></td>
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
     <form name="frmtutor" method="post" action="addtutor.php" onSubmit="return checked();">
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
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Add</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="viewtutor.php" class="greendeactfont">Edit / Delete</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
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
                                                <td class="toheaderbg" colspan="3">Add Tutor</td>
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
										  <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
											  Tutor Name </div></td>
										  <td align=left width="77%"> &nbsp;&nbsp; <input name="txtfname" value=""  maxlength =255 class="textbox" size="44"><font color="#FF0000">&nbsp; *</font> 
										  </td>
										</tr>
										 
										<tr> 
										 
										<td colspan="2" height="2%">&nbsp;</td>
										</tr>
										<tr> 
										  <td align=right class="bodytext"><div align="left">&nbsp; Address</div></td>
										  <td align=left>&nbsp;&nbsp;
												<textarea name="txtadd" rows="4" cols="48" class="textbox"></textarea><font color="#FF0000">&nbsp; *</font></td>
										</tr>
										
										
										<td colspan="2" height="2%">&nbsp;</td>
										</tr>
										<tr> 
										  <td align=right class="bodytext"><div align="left">&nbsp; Phone 
											  No </div></td>
										  <td align=left>&nbsp;&nbsp;
												<input name="txtphone" value=""   class="textbox" size=20 maxlength=12 onBlur="chkfloat(this)"><font color="#FF0000">&nbsp; *</font></td>
										</tr>
										<td colspan="2" height="2%">&nbsp;</td>
										</tr>
										<tr> 
										  <td align=right class="bodytext"><div align="left">&nbsp; Mobile 
											  No </div></td>
										  <td align=left>&nbsp;&nbsp;
												<input name="txtmobile" value=""  class="textbox" size="20" maxlength=12 onBlur="chkfloat(this)"><font color="#FF0000">&nbsp; *</font></td>
										</tr>
										<td colspan="2" height="2%">&nbsp;</td>
										</tr>
										<tr> 
										  <td align=right class="bodytext"><div align="left">&nbsp; Email 
											  Id </div></td>
										  <td align=left>&nbsp;&nbsp;
												<input name="txtemail" value=""  maxlength =255 class="textbox" size="44"><font color="#FF0000">&nbsp; *</font></td>
										</tr>
										<td colspan="2" height="2%">&nbsp;</td>
										</tr>
										<tr> 
										  <td align=right class="bodytext"><div align="left">&nbsp; Password</div></td>
										  <td align=left>&nbsp;&nbsp;
												<input name="txtpass" type="password" value=""  maxlength =255 class="textbox" size="16"><font color="#FF0000">&nbsp; *</font></td>
										</tr>
										<td colspan="2" height="2%">&nbsp;</td>
										</tr>
										<tr> 
										  <td align=right class="bodytext"><div align="left">&nbsp; Qualification</div></td>
										  <td align=left>&nbsp;&nbsp;
												<textarea name="txtqualification" rows="4" cols="48" class="textbox"></textarea><font color="#FF0000">&nbsp; *</font>
												</td>
										</tr>
										<td colspan="2" height="2%">&nbsp;</td>
										</tr>
										<tr> 
										  <td align=right class="bodytext"><div align="left">&nbsp; Achievements</div></td>
										  <td align=left>&nbsp;&nbsp; <textarea name="txtachieve" rows="4" cols="48" class="textbox"></textarea></td>
										</tr>
										<td colspan="2" height="2%">&nbsp;</td>
										<tr> 
										  <td align=right class="bodytext"> 
											<div align="left">&nbsp; Active</div></td>
										  <td height="22" align=left>&nbsp;&nbsp; <input name="chkactive" type="checkbox" value="1" checked> 
											<input type="hidden" name="txtcheck" value="1"></td>
										</tr>
										<tr> 
										  <td colspan="2" height="2%">&nbsp;</td>
										</tr>
										<tr> 
										  <td colspan="2" > <div align="right"><font face=verdana size=2><b> 
											  &nbsp;&nbsp; 
											  <input name="image" type="image" src="images/add.gif" >
											  &nbsp;&nbsp;<a href="overview.php?id=tutor"><img src="images/cancel.gif"  border="0"></a> 
											  </b></font> </div></div>
											</td>
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
