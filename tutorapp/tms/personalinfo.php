<?php
include_once 'dbConnection.php';
if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
?>
<html>
<head>
<title><?php echo sitename?> Personal Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../functions.js"></script>
<script type="text/javascript" language="javascript">
function closewin()
{
	document.location='./';
}
function validation()
{
	if(document.frmtutor.username.value=="")
	{	
		alert("Please Enter Name!");
		document.frmtutor.username.focus();
		return false;
	}
	if (document.frmtutor.txtphone.value != "")
	{
		if (!checknum(document.frmtutor.txtphone))
		{
			alert("Characters are not allowed in Phone No");
			document.frmtutor.txtphone.focus();
			return false;
		}
	}
	if (document.frmtutor.txtphone.value != "")
	{
		if (document.frmtutor.txtphone.value.length < 10)	
		{
			alert("Phone number can not be less that 10 digit");
			document.frmtutor.txtphone.focus();
			return false;
		}
	}	
	if(document.frmtutor.txtmobile.value != "")
	{
		if (!checknum(document.frmtutor.txtmobile))
		{
			alert("Characters are not allowed in Mobile");
			document.frmtutor.txtmobile.focus();
			return false;
		}
	}
	if (document.frmtutor.txtmobile.value != "")
	{
		if (document.frmtutor.txtmobile.value.length < 12)
		{
			alert("Mobile number can not be less than 12 digit");
			document.frmtutor.txtmobile.focus();
			return false;
		}	
	}
	return true;
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc"> 
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" border="0" alt=""></td>
  </tr>
  <tr > 
    <td valign="top">
	<?php if(isset($_POST['hdn_submit']) && $_POST['hdn_submit'] == '1')
	{ 
		$username = trim($_POST['username']);
		$addres = trim($_POST['taddress']);
		$tele = trim($_POST['txtphone']);
		$mobile = trim($_POST['txtmobile']);
		$qua =  trim($_POST['tqualification']);
		$achieve = trim($_POST['tachievment']);
		
		 $sqlupdate = "update cpo_usermaster set vUserName='".$username."',vUserAddress='".$addres."',";
		$sqlupdate .= "vUserPhone='".$tele."',vUserMobile='".$mobile."',";
		$sqlupdate .= "TUserQualification='".$qua."', TUserAchive='".$achieve."' where iUserId=".$_SESSION['user_id'];
		runquery1($sqlupdate);
		//echo $sqlupdate;
		$_SESSION['user_name'] = $username;
		$msg = "Your Personal Information has been updated successfully.";
		addlog(2);
						?>
							<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
							  <tr> 
								<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
								<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr> 
									  <td class="welcome"><b>Personal Information</b></td>
									  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
									</tr>
								  </table></td>
								<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
							  </tr>
							  <tr> 
								<td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
									<table class="" width="90%" align="center">
										<tr><td width="21%" height="15" class="bodytext" colspan="2" align="center"><b><?php echo $msg;?></b></td></tr>
										<tr><td height="15" colspan="2">&nbsp;</td></tr>
									</table>
								</td>
							  </tr>
							  <tr> 
								<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
								<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="closewin()" style="cursor:hand"></div></td>
								<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
							  </tr>
						  </table>														
						<?php }
						else
						{
					?>
        <form name="frmtutor" method="post" onSubmit="return validation();">
		<input type="hidden" name="hdn_submit" value="1">			
			  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr> 
					<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
					<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
						  <td class="welcome"><b>Personal Information</b></td>
						  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
						</tr>
					  </table></td>
					<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
				  </tr>
				  <tr> 
					<td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
						<table class="" width="90%" align="center">
							<tr><td colspan="2" align="right" class="bodytext">All (<font color="red">*</font>) mark are compulsory fields</td></tr>
						<?php
							$sqledit = "select *  from cpo_usermaster where iUserId=".$_SESSION['user_id'];
							$rsedit = runquery1($sqledit);
							$rsdata = mysqli_fetch_array($rsedit);
						?>
                            <tr> 
                              <td width="21%" height="30" class="bodytext">&nbsp;Tutor Name</td>
                              <td width="79%" class="text2">&nbsp;<input name="username" type="text"  class="textbox" size="30" value="<?php echo $rsdata['vUserName']?>"> 
                                <font color="#FF0000">* </font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Address</td>
                              <td class="text2">&nbsp;<textarea name="taddress"  class="textbox" cols="30"> <?php echo $rsdata['vUserAddress']?></textarea></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Phone No.</td>
                              <td class="text2">&nbsp;<input name="txtphone" type="text"  size="20" class="textbox" maxlength="12" value="<?php echo $rsdata['vUserPhone']?>"> 
                                </td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Mobile No.</td>
                              <td class="text2">&nbsp;<input name="txtmobile" type="text"  class="textbox" maxlength="12" size="20" value="<?php echo $rsdata['vUserMobile']?>"></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Qualification</td>
                              <td class="bodytext">&nbsp;<textarea name="tqualification" class="textbox" cols="30"><?php echo $rsdata['TUserQualification']?></textarea></td>
                            </tr>
                             <tr> 
                              <td height="30" class="bodytext">&nbsp;Achievements</td>
                            
                        <td class="text2">&nbsp;<textarea name="tachievment" class="textbox" cols="30"><?php echo $rsdata['TUserAchive']?></textarea></td>
                            </tr>
						</table>
					</td>
				  </tr>
				  <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
				</table>
				</form>
				<?php }?>
	  </td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
      <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
