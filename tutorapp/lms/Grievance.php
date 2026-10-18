<?
include "dbConnection.php";
if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
?>
<html>
<head>
<script language="JavaScript">
function validation()
{
	if (document.FRMBRIEVANCE.TXGRIEVANCECOMP.value == "")
	{
		alert("Please enter complaint detail !");
		document.FRMBRIEVANCE.TXGRIEVANCECOMP.focus();
		return false;
	}
	if (document.FRMBRIEVANCE.CHLETTER.checked == false && document.FRMBRIEVANCE.CHEMAIL.checked == false && document.FRMBRIEVANCE.CHTELEPHONE.checked == false && document.FRMBRIEVANCE.CHINPERSON.checked == false)
	{
		alert("Please select atleast one option from complaint recieve list !");
		document.FRMBRIEVANCE.CHLETTER.focus();
		return false;
	}
	return true;
}
function closewin()
{
	document.location = "./";
}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css" />

<title><? echo sitename;?>Learner Grievance</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>

<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  
  <tr> 
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF">
      <? include "leftpanel.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
  </tr>
  <tr> 
    <td valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td> 
            <form name="FRMBRIEVANCE" method="post" action="Grievance.php?next=1" onSubmit="return validation();">
			  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#AFE0FA">
		      <tr> 
					<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
					<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
						  <td class="welcome">Grievance Form</td>
						  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
						</tr>
					  </table></td>
					<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
				  </tr>
				  <tr> 
                  <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
				  	<table width="90%" align="center" bgcolor="#F9FBEB">
					<?
						if (isset($_GET['next']))
						{
							$sqluser = "select vUserName,vUserPhone,vUserEmailId,vUserAddress from cpo_usermaster where iUserId=".$_SESSION['user_id'];
							$rsuser = runquery($sqluser);
							$num = $rsuser ? mysqli_num_rows($rsuser) : 0 ;
							if ($num > 0)
							{
								$rsdata = mysqli_fetch_array($rsuser);
						
								$fromname = $rsdata['vUserName']; 
								$fromaddress = $rsdata['vUserEmailId']; 
								$toname = "Administrator of CareerPaths Online";
								$toaddress = admin_email;
								$subject = "Grievance form send by ".$rsdata['vUserName'];
								$message = $_POST['TXGRIEVANCECOMP'];
								$in = 0;
								if (isset($_POST['CHLETTER']) && $_POST['CHLETTER'] == "Letter")
								{
									$rec = $_POST['CHLETTER'];
									$in = 1;
								}
								if (isset($_POST['CHEMAIL']) && $_POST['CHEMAIL'] == "Mail")
								{
									if ($in == 1)
									{
										$rec .= " or ".$_POST['CHEMAIL'];
									}
									else
									{
										$rec = $_POST['CHEMAIL'];
										$in = 1;
									}
									
								}
								if (isset($_POST['CHTELEPHONE']) && $_POST['CHTELEPHONE'] == "Telephone")
								{
									if ($in == 1)
									{
										$rec .= " or ".$_POST['CHTELEPHONE'];
									}
									else
									{
										$rec = $_POST['CHTELEPHONE'];
										$in = 1;
									}
								}
								if (isset($_POST['CHINPERSON']) && $_POST['CHINPERSON'] == "Personally")
								{
									if ($in == 1)
									{
										$rec .= " or ".$_POST['CHINPERSON'];
									}
									else
									{
										$rec = $_POST['CHINPERSON'];
										$in = 1;
									}
								}
								
								$message .= "<br>user prefer to recieve complaint by ".$rec;
								SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message); ?>
		    <tr><td class="bodytext" align="center" colspan="4"><font color="#FF0000"><b>Grievance send successfully.</b><br>
									<?
									echo "Thank you for recording the details of your complaint.<br>";
									echo "The CareerPaths Online Quality Manager will investigate your complaint and <br>contact you by the method you have indicated within 5 working days of <br> the receipt of this form.";
									addlog(19);
									?></font>
								</td></tr>	
								<tr><td class="bodytext" align="center" colspan="4">&nbsp;</td></tr>									
							<? }	
						}
						else
						{
							$sqluser = "select vUserName,vUserPhone,vUserEmailId,vUserAddress from cpo_usermaster where iUserId=".$_SESSION['user_id'];
							$rsuser = runquery($sqluser);
							$num = $rsuser ? mysqli_num_rows($rsuser) : 0 ;
							if ($num > 0)
							{
								$rsdata = mysqli_fetch_array($rsuser);
						?>
							<tr><td colspan="4" align="right" class="bodytext">All (<font color="red">*</font>) mark are compulsory fields</td></tr>
							<tr>
								<td class="bodytext">Complaint made by</td>
								<td class="bodytext" colspan="3"><? echo ": ".$rsdata['vUserName'];?></td>
							</tr>
							<tr>
								<td class="bodytext" width="35%">Telephone</td>
								<td class="bodytext" colspan="3"><? echo ": ".$rsdata['vUserPhone'];?></td>
							</tr>
							<tr>
								<td class="bodytext" width="35%">E-mail</td>
								<td class="bodytext" colspan="3"><? echo ": ".$rsdata['vUserEmailId'];?></td>
							</tr>
							<tr>
								<td class="bodytext" width="35%">Address</td>
								<td class="bodytext" colspan="3"><? echo ": ".$rsdata['vUserAddress'];?></td>
							</tr>
							<tr>
								<td class="bodytext" colspan="4">Detail of complaint :</td>
							</tr>
							<tr>
								<td class="bodytext" colspan="3">
									<textarea name="TXGRIEVANCECOMP" class="textbox" cols="78" rows="10"></textarea> <font color="#FF0000">* </font>								</td>
							</tr>
							<tr>
								<td class="bodytext" colspan="4">How complaint recieved :    (Please tick atleast one which method you prefer)</td>
							</tr>
							<tr>
								<td class="bodytext" colspan="4"><input type="checkbox" name="CHLETTER" value="Letter">&nbsp;&nbsp;Letter</td>
							</tr>
							<tr>
								<td class="bodytext" colspan="4"><input type="checkbox" name="CHEMAIL" value="Mail">&nbsp;&nbsp;E-mail</td>
							</tr>
							<tr>
								<td class="bodytext" colspan="4"><input type="checkbox" name="CHTELEPHONE" value="Telephone">&nbsp;&nbsp;Telephone</td>
							</tr>
							<tr>
								<td class="bodytext" colspan="4"><input type="checkbox" name="CHINPERSON" value="Personally">&nbsp;&nbsp;In person</td>
							</tr>
						<?
							}
						}
						?>
					</table>                  </td>
				  </tr>
				  <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><? if (!isset($_GET['next'])) {?><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"> <? } else { ?> <img alt="close" src="../images/closebutton.gif" style="cursor:hand" onClick="closewin()"><? }?></div></td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
				  <tr>
				    <td >&nbsp;</td>
				    <td height="22"  ><div align="right"><strong><a href="javascript:history.back();" class="textlink">Back</a></strong></div></td>
				    <td >&nbsp;</td>
			    </tr>
				</table>
			</form>				
		  	</td>
		</tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <? include "includebottom.php";?>
</table>
</body>
</html>