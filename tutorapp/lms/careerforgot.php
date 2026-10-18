<?
include "db.php";
if(isset($_POST['forgot']))
{
extract($_POST);
$query1="select * from careersuit where email='$email'";
$result1=mysqli_query($query1);
$row=@mysqli_num_rows($result1);
if($row>0){
$fetch=mysqli_fetch_array($result1);
$fname=$fetch['firstname'].' '.$fetch['lastname'];
$password=$fetch['password'];
$subject = "Your Password .";
$message ="Dear ".ucfirst($fname);
$message .="\nThis mail is being sent to you because a request was made at career paths to re-send the user name and/or password for this account. ";  
$message .="<br><br><strong>Name:</strong> ".$fname;
$message .="<br><strong>Email:</strong> ".$email;
$message .="<br><strong>Password:</strong> ".$password;
$message .="<br><br>Please keep this information in a safe, secure place, so that you will be able to access all of the services and features available to you."; 
					$message .="<br><br>Thanks again for using our services.";
					$message .="<br>Regards";
					$message .="<br>Technical Support Team.";
$from="admin@careepathsonline.net";
  $headers 	= "From: $from\n" ."MIME-Version: 1.0\n" .
               "Content-type: text/html; charset=iso-8859-1";
mail($email,$subject,$message,$headers);
header("location:careerforgot.php?msg=1");
}
else {
header("location:careerforgot.php?msg=2");

}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Careerpaths: Learner Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./txteditor.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/forgotvalid.js"></script>
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
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {font-size: 13px}
.style3 {font-size: 12px}
.style4 {color: #BB2B2B}
-->
</style>
</head>

<body >

<table width="811"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
	<link href="../newadmin/css/adminstyle.css" rel="stylesheet" type="text/css" />
<link href="../newadmin/css/style.css" rel="stylesheet" type="text/css" />
<link href="../newadmin/css/tracking.css" rel="stylesheet" type="text/css" />
<table width="911" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>

    <td colspan="2" valign="top" class="banner"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="logo" width="65%"><img src="../newadmin/images/logo.gif" /></td>
    <td width="35%" class="greenfont" valign="top"></td>
  </tr>
</table>
</td>
</tr>
<tr><td colspan="2" class="topbor"><img src="../newadmin/images/spacer.gif" /></td></tr>
<tr><td colspan="2" class="graybg"></td></tr>
<tr><td class="purple" width="899px;">&nbsp;</td>
  <td class="signoutbg" align="center" valign="middle"><a href="../index.php" class="textlink">Home</a></td>
</tr>
</table>

    </td>
  </tr>
</table>

<table width="911" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <th height="372"  align="center" valign="top">
	<p>&nbsp;</p>
<form name="forgotform" id="forgotform" method="post" action="" onsubmit="return forgotvalid();">
        <table width="650" align="center" cellpadding="5">
        <?php
  $msg=$_REQUEST['msg'];
  if($msg==1){ ?><tr>
  <td height="20" colspan="2" align="center" class="style2" style="color:#FF0000"><?php echo "Password has been sent to your email";?> </td>
       </tr>
  <?php } 
  if($msg==2){ ?><tr>
  <td height="20" colspan="2" align="center" class="style2" style="color:#FF0000"> <?php echo "Username and email does not match";?> </td>
  </tr>
  <?php } ?>

          <tr>

            <th colspan="2" align="left" bgcolor="#dedede" class="red style2 style4">Forgot Password?</th>
          </tr>

          <tr>
            
            <th width="24%" align="left" bgcolor="#dedede"><label for="password2"><span class="style1">*</span><span class="style3">Enter your email:</span></label></th>
            
            <td bgcolor="#dedede"><input name="email" id="email" title="Email" value="" size="30" type="text" onblur="checkField(this);" />
            <span id="emailreq" style="font-size:11px"></span></td>
          </tr>
          <tr>
            <th align="left" bgcolor="#dedede">&nbsp;</th>
            <td bgcolor="#dedede" id="country_input"><input type="submit" name="forgot" id="forgot" class="login-cmd" value="Submit" /></td>
          </tr>
        </table>
</form></th>
  </tr>
</table>
</body>
</html>
