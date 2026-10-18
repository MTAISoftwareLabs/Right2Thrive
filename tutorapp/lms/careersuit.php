<?
include "db.php";
if(isset($_POST['login']))
   {
extract($_POST);
	$qAdmin = "SELECT * FROM `careersuit` WHERE `email`='$username' AND `password`='$password'";
	//echo $qAdmin;
	$rsAdmin = mysqli_query($qAdmin);
	$no_rows = mysqli_num_rows($rsAdmin);
if ($no_rows > 0){
	$resAdmin = mysqli_fetch_array($rsAdmin);

	ini_set('session.gc_maxlifetime', 7200);
		session_start(); //start a sessiion 
		$_SESSION['cemail'] = $resAdmin['email'];
		$expire=time()+60*60*24*30;
		header("Location:main1.php?id=14");
		exit;
}else{
	header("Location:careersuit.php?msg=1");
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
<script type="text/javascript" language="javascript" src="js/loginvalid.js"></script>
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
    <th height="572"  align="center" valign="top">
	<p>&nbsp;</p>
	<form name="loginform" id="loginform" method="post" action="" onSubmit="return loginvalid();">
        <table width="650" align="center" cellpadding="5">
        <?php
		$msg=$_REQUEST['msg'];
		if($msg==1)
		{
			?>
          <tr>
            <th colspan="2" align="center" bgcolor="#dedede" class="red style1 style3">Invalid username and password. Please try again.</th>
          </tr>
            <? } ?>
          <tr>

            <th colspan="2" align="left" bgcolor="#dedede" class="red style2 style4">LOGIN</th>
          </tr>

          <tr>

            <th width="24%" align="left" bgcolor="#dedede"><label for="fname2"><span class="style1">*</span><span class="style3">Email:</span></label></th>

            <td bgcolor="#dedede"><input name="username" id="username" title="Username"  size="30" type="text" onBlur="checkField(this);" value="" />              <span id="usernamereq" style="font-size:11px"></span></td>
          </tr>

          <tr>
            
            <th align="left" bgcolor="#dedede"><label for="password2"><span class="style1">*</span><span class="style3">Password</span></label>
            <span class="style3">            :</span></th>
            
            <td bgcolor="#dedede"><input name="password" id="password" title="Type Password (5-12 characters)" size="30" maxlength="12" type="password" onBlur="checkField(this);" value=""  />              <span id="passwordreq" style="font-size:11px"></span></td>
          </tr>

          <tr>
            <th align="center" bgcolor="#dedede">&nbsp;</th>
            <th align="left" bgcolor="#dedede"><label></label>
            <a href="careerforgot.php">Forgot Password?</a></th>
          </tr>
          <tr>
            <th align="left" bgcolor="#dedede">&nbsp;</th>
            <td bgcolor="#dedede" id="country_input"><input type="submit" name="login" class="login-cmd" value="Log In" /></td>
          </tr>
          <tr>
            
            <th colspan="2" align="left" bgcolor="#dedede"><span class="style2">No account yet?</span> <span class="signupnow-free"><a href="careersignup.php">Sign up now... <span class="free">It's Free!</span></a></span></th>
          </tr>
        </table>
</form></th>
  </tr>
</table>
</body>
</html>
