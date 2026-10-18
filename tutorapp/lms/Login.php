<?
include_once 'dbConnection.php';
?>
<html>
<head>
<title><? echo sitename;?>Learner login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function validation()
{
	if (document.frmLogin.txtusername.value == "")
	{	
		alert("Please enter Username !!");
		document.frmLogin.txtusername.focus();
		return false;
	}
	if (document.frmLogin.txtpassword.value == "")
	{	
		alert("Please enter Password !!");
		document.frmLogin.txtpassword.focus();
		return false;
	}
	return true;	
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
   <tr> 
    <td colspan="2" valign="top"><? include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc">
      <? include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="frmLogin" method="post" action="Login.php?next=1" onSubmit=" return validation();">
			<?
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Login</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							
                        <td class="bodytext">Username</td>
							<td><input name="txtusername" type="text" class="bodytext"></td>
						</tr>
					<tr>
							
                        <td class="bodytext">Password</td>
							<td><input name="txtpassword" type="password" class="bodytext"></td>
						</tr>
						<!--<tr>
							<td class="bodytext">Confirm Password</td>
							<td><input name="txtconfirmpassword" type="password" class="bodytext"></td>
						</tr> -->
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><td align="center" colspan="2">&nbsp;&nbsp;<a class="sidelink" href="forgotpass.php">Forgot Password</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidelink" href="../register.php">User Registration</a></td></tr>
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?
			  }
			  else
			  {
			  		$sqlchange = "select * from cpo_usermaster where vUserName='".$_POST['txtusername']."' and vUserPassword='".$_POST['txtpassword']."'";
					$rschange = runquery1($sqlchange);	
					$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
					if ($num > 0 )
					{
						
/*						$sqldelete = "update cpo_usermaster set vUserPassword='".$_POST['txtnewpassword']."' where iUserId=13";
						runquery1($sqldelete);
						$msg = "Password changed successfully !";
						SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
						$color = "black"; */
					}
					else
					{
						$msg = "User does not exist !";
						$color = "red";						
					} ?>
 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Login</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<? echo $color;?>"><b><? echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/submitbttn.jpg" alt="Close" width="67" height="17" onClick="javascript:document.location='ChangePass.php'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <? }
			  ?>
			
			</form></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      <? include "includebottom.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="30" border="0" alt=""></td>
  </tr>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
