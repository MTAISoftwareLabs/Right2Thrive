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
<title>Change Password Admin</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function memberlogin()
{
	v_val=validation(this);
	if(v_val==true)
	{
		document.frm.action="changecheck.asp?valid=yes";
		document.frm.submit();
	}
	return false;
}
function validation(frm)
{
	if(document.frm.oldpass.value.length==0)
	{
		alert("Password can not be Blank");
		document.frm.oldpass.focus();
		return false;
	}
	if(document.frm.newpass.value.length==0)
	{
		alert("New Password can not be blank");
		document.frm.newpass.focus();
		return false;
	}

	if(document.frm.newpass2.value.length==0)
	{
		alert("Confirm Password can not be blank");
		document.frm.newpass2.focus();
		return false;
	}
	if(document.frm.newpass.value!=document.frm.newpass2.value)
	{
		alert("New Password and Confirm password must same.");
		document.frm.newpass2.value="";
		document.frm.newpass2.focus();
		return false;
	}
	return true;
}
function onload()
{
	document.frm.oldpass.focus();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_GET['next'])){?> onLoad="onload()" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 

if(isset($_GET['next']))
{							
	$oldpass=$_POST['oldpass'];
	$newpass=$_POST['newpass'];
	$sql="select adminpass from admin where adminid=1";
	$rIDPass=runquery($sql);
	$num = $rIDPass ? mysqli_num_rows($rIDPass) : 0;
	if ($num > 0){
		$opass=mysqli_result($rIDPass,0,0);	
        }else{	
		$opass="";
       }

	if ($opass != $oldpass)
	{
		$flg = "red";
		$msg = "Old password does not match.";
	}
	else
	{ 
		if ($opass == $oldpass)
		{
			$sqlup="update admin set adminpass='".$newpass."' where adminid=1";
			$rIDUp=runquery($sqlup);
			$msg = "Password changed successfully.";
		}
	}
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Change Password Admin</td>
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
					<td width="25%" align="center" class="midtabgreen">Change Password</td>
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
                                              <td class="toheaderbg" colspan="3">Change Password Information</td>
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
                                        <td align="center"><div align="right"><a href="./changepass.php"><img src="./images/go_back.gif" border="0" alt="Go Back">&nbsp; </a> &nbsp;</div></td>
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
   <form name="frm" action="./changepass.php?next=yes" method="post" onSubmit="return validation(this)">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Change Password Admin</td>
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
						<td width="25%" align="center" class="midtabgreen">Change Password</td>
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
                                                <td class="toheaderbg" colspan="3">Change Password</td>
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
                  <td  width="36%" height="25">&nbsp;&nbsp;Old Password</td>
                  <td width="64%" height="25" > <input type="password" name="oldpass" size="20" class="textbox"> 
                    <font color="red">&nbsp;*</font> </td>
                </tr>
                <tr> 
                  <td width="36%" height="25">&nbsp;&nbsp;New Password</td>
                  <td width="64%" height="25"> <input type="password" name="newpass" size="20" class="textbox"> 
                    <font color="red">&nbsp;*</font> </td>
                </tr>
                <tr> 
                  <td width="36%" height="25">&nbsp;&nbsp;Confirm Password</td>
                  <td width="64%" > <input type="password" name="newpass2" size="20" class="textbox"> 
                    <font color="red">&nbsp;*</font> </td>
                </tr>
                <tr> 
                  <td colspan="2" align="right"><input type="image" src="./images/submit.gif" value="Submit" alt="Submit">
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
