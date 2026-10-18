<?
include "db.php";
if(isset($_POST['register']))
{
extract($_POST);
$phone=$phone+$phone1;
$signupqry="insert into careersuit (email,password,lastname,firstname,address,city,state,zip,phone,mobile,ethinicity,status) values('$email','$password','$lastname','$firstname','$address','$city','$state','$zip','$phone','$mobile','$ethinicity','1')";
mysqli_query($signupqry);
$fname=$firstname.' '.$lastname;
$add=$address.', '.$city.', '.$state.', '.$zip;

$to= "cleeown@yahoo.co.uk";
$subject = "New Reistration";
$message ="Hi,";
$message .="\nNew user as been registered for find out what work suite you.";  

$message .="<br><strong>Email:</strong> ".$email;
$message .="<br><strong>Password:</strong> ".$password;
$message .="<br><br><strong>Name:</strong> ".$fname;
$message .="<br><br><strong>Address:</strong> ".$add;
$message .="<br><br><strong>Phone:</strong> ".$phone;
$message .="<br><br><strong>Mobile:</strong> ".$mobile;
$message .="<br><br><strong>Employment Status:</strong> ".$ethinicity;
 
					$message .="<br><br>Thanks again for using our services.";
					$message .="<br>Regards";
					$message .="<br>Technical Support Team.";
$from="admin@careerpathsonline.net";
  $headers 	= "From: $from\n" ."MIME-Version: 1.0\n" .
               "Content-type: text/html; charset=iso-8859-1";
mail($to,$subject,$message,$headers);




header("Location:careersuit.php");
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
<script type="text/javascript" language="javascript" src="js/regvalid.js"></script>
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
.style4 {
	color: #BB2B2B;
	font-size: 14px;
}
.style5 {color: #FF0000; font-size: 12px; }
.style7 {font-size: 18px}
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
	<p><span class="acount-title style7"><strong>Create an Account</strong></a></span></p>
	<form name="registerform" id="registerform" method="post" action="" onSubmit="return regvalid();">
        <table width="667" align="center" cellpadding="5">
        <?php
		$msg=$_REQUEST['msg'];
		if($msg==1)
		{
			?>
          <tr>
            <th colspan="3" align="center" bgcolor="#dedede" class="style5">Username already existed. Please try again.</th>
          </tr>
            <? } ?>
          <tr>

            <th width="33%" align="left" bgcolor="#dedede" class="red style4">LOGIN INFORMATION</th>

            <td width="35%" bgcolor="#dedede">&nbsp;</td>

            <td width="32%" bgcolor="#dedede"></td>
          </tr>

          <tr>
            <th align="left" bgcolor="#dedede" class="style2"><span class="style1">*</span>Email:</th>
            <td bgcolor="#dedede" id="country_input2"><input name="email" id="email" title="Email" size="30" type="text" onBlur="checkField(this);"  /></td>
            <td bgcolor="#dedede"></td>
          </tr>

          <tr>

            <th align="left" bgcolor="#dedede" class="style2"><label for="password2"><span class="style1">*</span>Password</label>:</th>

            <td bgcolor="#dedede"><input name="password" id="password" title="Type Password (5-12 characters)" size="30" maxlength="12" type="password" onBlur="checkField(this);"  /></td>

            <td bgcolor="#dedede" class="style2">5-12 characters</td>
          </tr>

          <tr>

            <th align="left" bgcolor="#dedede" class="style2"><label for="password_confirm2"><span class="style1">*</span>Confirm Password:</label></th>

            <td bgcolor="#dedede"><input name="cpassword" id="cpassword" title="Retype Password" size="30" maxlength="12" type="password"  onblur="checkField(this);" /></td>

            <td bgcolor="#dedede" class="style2">5-12 characters</td>
          </tr>

          <tr>

            <th align="left" bgcolor="#dedede">&nbsp;</th>

            <td bgcolor="#dedede" id="country_input5">&nbsp;</td>

            <td bgcolor="#dedede"></td>
          </tr>

          <tr>

            <th align="left" bgcolor="#dedede" class="style4">PERSONAL INFORMATION</th>

            <td bgcolor="#dedede" id="country_input12">&nbsp;</td>

            <td bgcolor="#dedede"></td>
          </tr>

          <tr>

            <th align="left" bgcolor="#dedede" class="style2"><span class="style1">*</span>Last Name:</th>

            <td bgcolor="#dedede" id="country_input13"><input name="lastname" id="lastname" title="Last Name" size="30" type="text" onBlur="checkField(this);"  /></td>

            <td bgcolor="#dedede"></td>
          </tr>

          <tr>

            <th align="left" valign="top" bgcolor="#dedede" class="style2"><span class="style1">*</span>First Name:</th>

            <td bgcolor="#dedede" id="country_input"><input name="firstname" id="firstname" title="First Name" size="30" type="text" onBlur="checkField(this);"  /></td>

            <td bgcolor="#dedede"></td>
          </tr>

          <tr>

            <th align="left" valign="top" bgcolor="#dedede" class="style2"><span class="style1">*</span>Address:</th>

            <td bgcolor="#dedede" id="country_input8"><input name="address" id="address" title="Address" size="30" type="text" onBlur="checkField(this);"  /></td>

            <td bgcolor="#dedede"></td>
          </tr>

          <tr>

            <th align="left" valign="top" bgcolor="#dedede" class="style2"><span class="style1">*</span>City:</th>

            <td bgcolor="#dedede" id="country_input6"><input name="city" id="city" title="City" size="30" type="text" onBlur="checkField(this);"  /></td>

            <td bgcolor="#dedede"></td>
          </tr>

          <tr>

            <th align="left" valign="top" bgcolor="#dedede" class="style2"><span class="style1">*</span>State:</th>

            <td bgcolor="#dedede" id="country_input7"><input name="state" id="state" title="state" size="30" type="text" onBlur="checkField(this);"  /></td>

            <td bgcolor="#dedede"><span class="style1"><strong>*</strong></span><strong class="style2">Zip Code: </strong>              <input name="zip" id="zip" title="Zipcode" size="10" type="text" onBlur="checkField(this);"  /></td>
          </tr>

          <tr>

            <th align="left" bgcolor="#dedede" class="style2">Phone Number: </th>

            <td colspan="2" bgcolor="#dedede" id="country_input15"><input name="phone" id="phone" title="Phone" size="4" maxlength="3" type="text" onBlur="checkField(this);"  />

              - 

             <input name="phone1" id="phone1" title="Phone1" size="20" maxlength="7" type="text" onBlur="checkField(this);"  /></td>
          </tr>


          <tr>
            <th align="left" bgcolor="#dedede" class="style2">Mobile : </th>
            <td bgcolor="#dedede" id="country_input16"><input name="mobile" id="mobile" title="mobile" size="30" type="text" onBlur="checkField(this);"  /></td>
            <td bgcolor="#dedede">&nbsp;</td>
          </tr>
          <tr>
            <th align="left" bgcolor="#dedede" class="style2"><span class="style1">*</span>Employment Status:</th>
            <td bgcolor="#dedede" id="country_input16"><select name="ethinicity" id="ethinicity" onBlur="checkField(this);" style="width:210px">
              <option value="">Select</option>
              <option value="Unemployed">Unemployed</option>
              <option value="Employed">Employed</option>
            
            </select></td>
            <td bgcolor="#dedede">&nbsp;</td>
          </tr>
          <tr>

            <th align="left" bgcolor="#dedede">&nbsp;</th>

            <td bgcolor="#dedede" id="country_input16"><input type="submit" name="register" id="register" value="Save and Continue" /></td>

            <td bgcolor="#dedede">&nbsp;</td>
          </tr>
        </table>
</form></th>
  </tr>
</table>
</body>
</html>
