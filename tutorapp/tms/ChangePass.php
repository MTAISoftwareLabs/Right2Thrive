<?php
include_once 'dbConnection.php';
?>
<html>
<head>
<title><?php echo sitename;?>Change Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function closewin()
{
	document.location='ChangePass.php';
}

function validation()
{
	if (document.FRMTUTORCHANGEPASSWORD.TXTUTOROLDPASSWORD.value == "")
	{	
		alert("Please enter old password !!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTOROLDPASSWORD.focus();
		return false;
	}
	if (document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.value == "")
	{	
		alert("Please enter new password !!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.focus();
		return false;
	}
	if(document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.value.length<4)
	{	
		alert("Password must be more than 4 character!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.focus();
		return false;
	}
	if(document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.value.length>16)
	{	
		alert("Password not more than 16 character!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.focus();
		return false;
	}
	
	if (document.FRMTUTORCHANGEPASSWORD.TXTUTORCONFIRMPASSWORD.value == "")
	{	
		alert("Please enter confirm password !!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORCONFIRMPASSWORD.focus();
		return false;
	}
	if (document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.value != document.FRMTUTORCHANGEPASSWORD.TXTUTORCONFIRMPASSWORD.value)
	{	
		alert("new password and confirm password must be same !!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.focus();
		document.FRMTUTORCHANGEPASSWORD.TXTUTORCONFIRMPASSWORD.value = "";
		return false;
	}
	return true;	
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td></tr>
  <tr> 
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <?php include "includeleft.php";?>
    </td>
	<td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>    <!--<td><img src="images/spacer.gif" width="1" height="20" border="0" alt=""></td>-->
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMTUTORCHANGEPASSWORD" method="post" action="ChangePass.php?next=1" onSubmit=" return validation();">
			<?php
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Change Password</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td class="bodytext">Old Password</td>
							<td><input name="TXTUTOROLDPASSWORD" type="password" class="textbox"></td>
						</tr>
					<tr>
							<td class="bodytext">New Password</td>
							<td><input name="TXTUTORNEWPASSWORD" type="password" class="textbox"></td>
						</tr>
						<tr>
							<td class="bodytext">Confirm Password</td>
							<td><input name="TXTUTORCONFIRMPASSWORD" type="password" class="textbox"></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }
			  else
			  {
			  		$sqlchange = "select vUserEmailId,vUserName from cpo_usermaster where vUserEmailId='".$_SESSION['email_id']."' and vUserPassword='".$_POST['TXTUTOROLDPASSWORD']."'";
					$rschange = runquery1($sqlchange);	
					$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
					if ($num > 0 )
					{
						$rsdata = mysqli_fetch_array($rschange);
						$sqldelete = "update cpo_usermaster set vUserPassword='".$_POST['TXTUTORNEWPASSWORD']."' where iUserId=".$_SESSION['user_id'];
						runquery1($sqldelete);
						$msg = "Password changed successfully !";
						$fromname = "Auto response system";
						$fromaddress = admin_email;
						$toname = $rsdata['vUserName'];
						$toaddress = $rsdata['vUserEmailId'];
						$subject = "Change password from CareerPaths Online";
						$message ="<html><body><p>Dear ".$rsdata['vUserName'].",</p>";
						$message .= "<p>You have successfully change your password from '".$_POST['TXTUTOROLDPASSWORD']."' to '".$_POST['TXTUTORNEWPASSWORD']."'</p>";
						$message .= "<p>Warm Regard From,</p>";
						$message .= "<p>CareerPathOnline Team</p></body></html>";
						SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
						$color = "black";
					}
					else
					{
						$msg = "Your Password does not match !";
						$color = "red";						
					} ?>
 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Change Password</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                  <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="closewin()"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <?php }
			  ?>
			
			</form></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
