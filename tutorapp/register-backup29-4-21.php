<?

ob_start();

include_once 'dbConnection.php';

if(isset($_POST['submit'])){

$TXusername = $_POST['TXusername'];
//$TXaddress= $_POST['TXaddress'];
//$TXpostcode= $_POST['TXpostcode'];
$CBOcountry= $_POST['CBOcountry'];
$TXtelephone= $_POST['TXtelephone'];
$TXmobile= $_POST['TXmobile'];
$TXemailid= $_POST['TXemailid'];
$TXpwd= $_POST['TXpwd'];
$TXconfirm_pwd= $_POST['TXconfirm_pwd'];
$TXbdate1= $_POST['TXbdate1'];
$TXbdate2= $_POST['TXbdate2'];
$TXbdate3= $_POST['TXbdate3'];
$date = $TXbdate1."-".$TXbdate2."-".$TXbdate3;
$TXethnicity = $_POST['CBOethnicity'];
$rnde = $_POST['rnd'];
$total =$_POST['total'];
$capcha =$_POST['capcha'];
$random =substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,25))),1,25);

if($TXemailid!=''){
$result5 = runquery("SELECT * FROM cpo_usermaster WHERE vUserEmailId='$TXemailid'");
if(mysqli_num_rows($result5)>0){
$er="Email Already Exist In Our Database";
$abc=5;
}
}

if($capcha!=$total){
$er="Capcha code is invalid";
}
if($TXpwd!=$TXconfirm_pwd){
$er="Password Doesn't Match";
}

if($capcha==$total && $TXpwd==$TXconfirm_pwd && $abc!=5){
$sql=runquery("INSERT INTO cpo_usermaster (vUserName,vUserPassword,vUserCountry,vUserMobile,vUserPhone,vUserEmailId,dUserBirthDate,vUserEthenticity,iUserGender,iUserType,random)VALUES ('$TXusername','$TXpwd','$CBOcountry','$TXmobile','$TXtelephone','$TXemailid','$date','$TXethnicity','$rnde','2','$random')");
mysqli_error($conn);
$er = "Register Successfully Please Check Your Email To Activate Your Account!";



$to = $TXemailid;

$subject = "Verify CareerPathOnline Registration";

$message = "


<p>Thank you for your registration, We will notify you shortly how to login to your MY DiGITAL FUTURE Portfolio !</p>


";

/*Welcome To CareerPathOnline Please <a href='http://www.careerpathsonline.net/activate_acc.php?id=$random'>Click Here</a> TO Active your Account*/

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@careerpathsonline.net>' . "\r\n";





mail($to,$subject,$message,$headers);


if($rnde=='1'){
$rnde='Male';
}
if($rnde=='0'){
$rnde='Female';
}

$to2 = 'info@careerpathsonline.net';
$subject2 = "New Registration on CareerPathOnline";

$message2 = "


<h4>New Registration Detail</h4>
<table id='tab'>
<tr>
<td>
Name
</td>

<td>
$TXusername
</td>
</tr>

<tr>
<td>
Address
</td>

<td>
$TXaddress
</td>
</tr>

<tr>
<td>
Postcode
</td>

<td>
$TXpostcode
</td>
</tr>

<tr>
<td>
Country
</td>

<td>
$CBOcountry
</td>
</tr>

<tr>
<td>
Telephone & Mobile
</td>

<td>
$TXtelephone, $TXmobile
</td>
</tr>

<tr>
<td>
E-mail address
</td>

<td>
$TXemailid
</td>
</tr>

<tr>
<td>
Date of Birth
</td>

<td>
$date
</td>
</tr>

<tr>
<td>
 Employment
</td>

<td>
$TXethnicity
</td>
</tr>

<tr>
<td>
 Sex
</td>

<td>
$rnde
</td>
</tr>



</table>
<style>
#tab td{
padding:10px!important;
}
</style>
";

// Always set content-type when sending HTML email
$headers2 = "MIME-Version: 1.0" . "\r\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers2 .= 'From: <info@careerpathsonline.net>' . "\r\n";





mail("$to2,sandeep.datalogic@gmail.com",$subject2,$message2,$headers2);

}

}




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>careerpathsonline.net</title>

<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

<link href="css/style.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" src="functions.js"></script>

<script language="JavaScript" src="calendar1.js"></script> 

<script language="JavaScript">

function userid_avalilibilty()

{	

	

	var x = document.frmpersonal.TXemailid.value;

	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (!filter.test(x))

	{

		alert("Enter a valid E-mail address!");

		document.frmpersonal.TXemailid.value="";

		document.frmpersonal.TXemailid.focus();

		return false;

	}

	new1=window.open("userid_availability.php?userid="+document.frmpersonal.TXemailid.value,"",'height=200,width=400,scrollbars=yes,top=50 left=150');

	return true;

}

function termswin()

{

new1=window.open("learning_agreement.php","",'height=550,width=650,scrollbars=yes,top=150 left=150');

	return true;

}

function backpersonal()

{

	document.frmqua.action="register.php?back1=yes";

	document.frmqua.submit();

	return true;

}

function validation()

{

	if(document.frmpersonal.TXusername.value=="")

	{	

		alert("Please Enter Name!");

		document.frmpersonal.TXusername.focus();

		return false;

	}

	if(document.frmpersonal.TXpostcode.value=="")

	{	

		alert("Please Enter PostCode.!");

		document.frmpersonal.TXpostcode.focus();

		return false;

	}

	if(document.frmpersonal.CBOcountry.value==0)

	{	

		alert("Please Select country.!");

		document.frmpersonal.CBOcountry.focus();

		return false;

	}

	if(document.frmpersonal.TXtelephone.value==0)

	{	

		alert("Please Enter telephone.!");

		document.frmpersonal.TXtelephone.focus();

		return false;

	}



	if (document.frmpersonal.TXtelephone.value != "")

	{

		if (!checknum(document.frmpersonal.TXtelephone))

		{

			alert("Characters are not allowed in Phone No");

			document.frmpersonal.TXtelephone.focus();

			return false;

		}

	}

/*	if (document.frmpersonal.TXtelephone.value != "")

	{

		if(document.frmpersonal.TXtelephone.value.length<10)

		{	

			alert("Phone number can not be less than 10 digit!");

			document.frmpersonal.TXtelephone.focus();

			return false;

		}

	}*/

	if (document.frmpersonal.TXmobile.value != "")

	{

		if (!checknum(document.frmpersonal.TXmobile))

		{

			alert("Characters are not allowed in Mobile");

			document.frmpersonal.TXmobile.focus();

			return false;

		}

	}

/*	if (document.frmpersonal.TXmobile.value != "")

	{

		if(document.frmpersonal.TXmobile.value.length<12)

		{	

			alert("Mobile number can not be less than 12 digit!");

			document.frmpersonal.TXmobile.focus();

			return false;

		}

	}*/

	var x = document.frmpersonal.TXemailid.value;

	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (!filter.test(x))

	{

		alert("Enter a valid E-mail address!");

		document.frmpersonal.TXemailid.value="";

		document.frmpersonal.TXemailid.focus();

		return false;

	}

	if(document.frmpersonal.TXpwd.value=="")

	{	

		alert("Please Enter Password!");

		document.frmpersonal.TXpwd.focus();

		return false;

	}

	if(document.frmpersonal.TXpwd.value.length<4)

	{	

		alert("Password must be more than 4 character!");

		document.frmpersonal.TXpwd.focus();

		return false;

	}

	if(document.frmpersonal.TXpwd.value.length>16)

	{	

		alert("Password not more than 16 character!");

		document.frmpersonal.TXpwd.focus();

		return false;

	}

	if(document.frmpersonal.TXconfirm_pwd.value=="")

	{	

		alert("Please Enter Confirm Password!");

		document.frmpersonal.TXconfirm_pwd.focus();

		return false;

	}

	if(document.frmpersonal.TXconfirm_pwd.value.length<4)

	{	

		alert("Password must be more than 4 character!");

		document.frmpersonal.TXconfirm_pwd.focus();

		return false;

	}

	if(document.frmpersonal.TXconfirm_pwd.value.length>16)

	{	

		alert("Password not more than 16 character");

		document.frmpersonal.TXconfirm_pwd.focus();

		return false;

	}

	if(document.frmpersonal.TXpwd.value!=document.frmpersonal.TXconfirm_pwd.value)

	{

		alert("Both Password Must be same!");

		document.frmpersonal.TXpwd.value="";

		document.frmpersonal.TXconfirm_pwd.value="";

		document.frmpersonal.TXpwd.focus();

		return false;

	}

	if(document.frmpersonal.CBOethnicity.value==0)

	{	

		alert("Please select Employment.!");

		document.frmpersonal.CBOethnicity.focus();

		return false;

	}


	document.frmpersonal.action="courses.php?valid=yes";

	document.frmpersonal.submit();

	return true;

}

function validation_qua()

{

	if(!document.frmqua.chkterm_cond.checked)

	{

		alert("First Select Terms and Conditions!");

		return false;

	}

	if (document.frmqua.rnddis[0].checked == true)

	{

		if (document.frmqua.TXdisability.value == "")

		{

			alert("Please enter disibility reason");

			document.frmqua.TXdisability.focus();

			return false;

		}

	}

	document.frmqua.action="courses.php?valid=yes";

	document.frmqua.submit();

}

function getOthers()

{

	

	if(document.frmpersonal.CBOethnicity.value=="Other")

	{

		document.getElementById("ethnicity").style.display='block';

	}

	else

	{

		document.getElementById("ethnicity").style.display='none';

	}

}

function distext()

{

	winfocus();

	document.getElementById("ethnicity").style.display='none';

}

function getdisable(obj)

{



	if(obj.value == 1)

	{

		document.getElementById(1).disabled=false;

	}

	else

	{

		document.getElementById(1).value="";

		document.getElementById(1).disabled=true;

	}

	

}

function winfocus()

{

	document.frmpersonal.TXusername.focus();

}

function winfocus1()

{

	document.frmqua.TXqua_achieved.focus();

}

</script>

<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script>

</head>



<? if(!isset($_GET['next']))

{

?>

<body bgcolor="#ffffff" leftmargin="0" topmargin="0" onLoad="distext()">

<?

}

else

{

?>

<body topmargin="0" onLoad="winfocus1()">

<?

}

?>
<link type="text/css" rel="stylesheet" media="screen" href="css/newstyle.css">
<!-- Start Wrapper -->
<style type="text/css">
#header {
	background-image: url("../images/header.gif") !important;
    width: 912px !important;
}
#logo {
width: 288px !important;
}
#navigation {
   width: 531px !important;
   
}
</style>
<div id="wrapper" style="padding-bottom:12px;">
<?php

include('includes/header.php');  

?>
</div>
<table width="912" height="900" border="0" align="center" cellpadding="0" cellspacing="0">


      <tr>

        <td height="622" valign="top">

        	<table width="912" border="0" cellspacing="0" cellpadding="0">

          		<tr>

                  <td width="205" height="200" valign="top" bgcolor="#f5f5f5">

                    <?php // include('left.php');?>

                  </td>

                  <td width="712" valign="top">

                    <table width="682" border="0" align="center" cellpadding="0" cellspacing="0">

                    <tr><td colspan="3">&nbsp;</td></tr>

                     	<tr>

                              <td width="75%" class="intheading" style="font-family:arial"><img src="images/arrow.gif" width="14" height="14" /> Welcome to My Digital Careers Hub</td>

                              <td width="8%"></td>

                              <td width="17%" class="bodytext"></td>

                            </tr>

            		</table>
					
                     
              		<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">

                	<tr><td>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                            

              <tr>

                <td height="10">&nbsp;</td>

                <td colspan="3" nowrap="nowrap" class="intsubheading">&nbsp;</td>

              </tr>
              <?php if($_GET['msg']=='incorrectcode') { ?>
              <tr><td colspan="2"><div style="   color: #993300;
    font-size: 23px;
    padding-bottom: 10px;
    padding-left: 28px;"> Capcha code is incorrect</div></td></tr>
<?php } ?>
              <? if(isset($_GET['next']))

{

 ?>






              <form method="post" name="frmqua" id="frmqua">

                <tr>


                  <td><input type="hidden" name="hTXusername" value="<? echo trim($HTTP_POST_VARS['TXusername'])?>" />

 

 

                      <input type="hidden" name="hCBOcountry" value="<? echo trim($HTTP_POST_VARS['CBOcountry'])?>" />

                      <input type="hidden" name="hTXtelephone" value="<? echo trim($HTTP_POST_VARS['TXtelephone'])?>" />

                      <input type="hidden" name="hTXmobile" value="<? echo trim($HTTP_POST_VARS['TXmobile'])?>" />

                      <input type="hidden" name="hTXemailid" value="<? echo trim($HTTP_POST_VARS['TXemailid'])?>" />

                      <input type="hidden" name="hTXpwd" value="<? echo trim($HTTP_POST_VARS['TXpwd'])?>" />

                      <input type="hidden" name="hTXconfirm_pwd" value="<? echo trim($HTTP_POST_VARS['TXconfirm_pwd'])?>" />

                      <input type="hidden" name="hTXbdate1" value="<? echo trim($HTTP_POST_VARS['TXbdate2'])?>" />

                      <input type="hidden" name="hTXbdate2" value="<? echo trim($HTTP_POST_VARS['TXbdate1'])?>" />

                      <input type="hidden" name="hTXbdate3" value="<? echo trim($HTTP_POST_VARS['TXbdate3'])?>" />

                      <? if(trim($HTTP_POST_VARS['CBOethnicity'])=="Other") 

				{

			?>

                      <input type="hidden" name="hTXethnicity" value="<? echo trim($HTTP_POST_VARS['TXethnicity'])?>" />

                      <?

				}

				else

				{

?>

                      <input type="hidden" name="hTXethnicity" value="<? echo trim($HTTP_POST_VARS['CBOethnicity'])?>" />

                      <?

				}

?>

                      <input type="hidden" name="hrnd" value="<? echo $HTTP_POST_VARS['rnd']?>" />

                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

                        <tr>

                          <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                              <tr>


                                <td width="96%" height="20"    background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                  <tr>

									<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20" /></td>

                                    <td width="96%" height="20"  background="images/changep_center_cor.jpg"><span class="fontwhite">Register as Learner or Parent ?</span></td>

                                    <td width="2%" height="20"><img src="images/changep_right_cor.jpg" height="20" /></td>
									
									<!--<td width="2%"><img src="images/changep_right_cor.jpg" /></td>-->

                                  </tr>

                                </table></td>                                

                              </tr>

                          </table></td>

                        </tr>

                        <tr>

                          <td bgcolor="FFFFFF" ><table width="100%" border="0" cellspacing="0" cellpadding="0">

                              <tr>

                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="forborder">

                                    <tr>

                                      <td height="20" colspan="2" class="bodytext" align="right">You must fill in any box that has a red asterisk (<font color="red">*</font>) by it&nbsp;<br/><br/><?php echo $er; ?></td>

                                    </tr>

                                    <tr>

                                      <td width="50%" height="80" class="bodytext">&nbsp;What qualifications (if any) do you have?</td>

                                      <td width="50%" class="text2">&nbsp;

                                          <textarea name="TXqua_achieved" class="textbox" rows="5" cols="35"></textarea>

                                      </td>

                                    </tr>

                                    <tr>

                                      <td height="30" class="bodytext">&nbsp;Are you in work?</td>

                                      <td class="bodytext"><input name="rnde" type="radio" value="1" checked="checked" />

                                        Yes

                                        <input name="rnde" type="radio" value="0" />

                                        No</td>

                                    </tr>

                                    <tr>

                                      <td height="80" class="bodytext">&nbsp;If yes, what is your job?&nbsp;<strong>OR</strong><br />

                                        &nbsp;If no, how long have you been out of work?</td>

                                      <td class="text2">&nbsp;

                                          <textarea name="TXlong_employed" class="textbox" cols="35" rows="5"></textarea></td>

                                    </tr>

                                    <tr>

                                      <td height="80" class="bodytext">&nbsp;What career interests you?</td>

                                      <td class="text2">&nbsp;

                                          <textarea name="TXcareer_ocuu" class="textbox" cols="35" rows="5"></textarea>

                                      </td>

                                    </tr>

                                    <tr>

                                      <td height="80" class="bodytext">&nbsp;What qualifications do you want to gain?</td>

                                      <td class="text2">&nbsp;

                                          <textarea name="TXqua_likeachieved" class="textbox" cols="35" rows="5"></textarea></td>

                                    </tr>

                                    <tr>

                                      <td height="50" class="bodytext">&nbsp;What skills do you have?</td>

                                      <td class="text2">&nbsp;

                                          <textarea name="TXskill_achieved" class="textbox" cols="35"></textarea>

                                      </td>

                                    </tr>

                                    <tr>

                                      <td height="30" class="bodytext">&nbsp;What are your hobbies?</td>

                                      <td class="text2">&nbsp;

                                          <textarea name="TXhobbies" class="textbox" cols="35"></textarea>

                                      </td>

                                    </tr>

                                    <tr>

                                      <td height="30" class="bodytext">&nbsp;Do you have a disability?</td>

                                      <td class="bodytext"><input  type="radio" name="rnddis" value="1" onclick="getdisable(this)" />

                                        Yes

                                        <input  type="radio" name="rnddis" value="0" onclick="getdisable(this)" checked="checked" />

                                        No

                                        <!--<							  <input name="rnddis" type="radio" value="1" onClick="getdisable(this)">

                                Yes 

                                <input name="rnddis" type="radio" value="0" checked onClick="getdisable(this)">

                                No --></td>

                                    </tr>

                                    <tr>

                                      <td height="30" class="bodytext">&nbsp;If yes, please explain.</td>

                                      <td class="text2">&nbsp;

                                          <textarea name="TXdisability" class="textbox" cols="35" disabled="disabled" id="1"></textarea></td>

                                    </tr>

                                    <tr>

                                      <td height="30" class="bodytext" colspan="2" align="center"><input type="checkbox" name="chkterm_cond" />

                                          <a href="#" onclick="termswin()">I agree terms and conditions.</a>&nbsp;&nbsp;</td>

                                    </tr>

                                    <tr>

                                      <td colspan="2"><table id="ethnicity">

                                          <tr>

                                            <td><input type="hidden" name="test" value="" />

                                            </td>

                                          </tr>

                                      </table></td>

                                    </tr>

                                    <tr>

                                      <td colspan="2">&nbsp;</td>

                                    </tr>

                                </table></td>

                              </tr>

                          </table></td>

                        </tr>

                    </table></td>

                </tr>

                <tr>

                  <td><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">

                      <tr>

                        <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25" /></td>

                        <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/next.gif" name="image" class="mouse" id="image" onclick="validation_qua()" /></div></td>

                        <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25" /></div></td>

                      </tr>

                  </table></td>

                </tr>

              </form>

              <? 

}

else

{

 ?>

              <form action="" method="post" name="frmpersonal" id="frmpersonal">

                <tr>

                  <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

                      <tr>

                        <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td width="2%"><img src="images/changep_left_cor.jpg" width="10" height="21" /></td>

                              <td width="96%"   background="images/changep_center_cor.jpg"><table width="100%" height="20" border="0" cellpadding="0" cellspacing="0">

                                  <tr>

                                    <td width="77%" class="fontwhite">Enter Your Personal Information</td>

                                    <td width="20%" class="fontwhite"><!--<div align="center"><strong>Step 1 of 2 </strong></div>--></td>

                                    <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>

                                  </tr>

                              </table></td>

                              <td width="2%"><img src="images/changep_right_cor.jpg" height="20" /></td>

                            </tr>

                        </table></td>

                      </tr>

                      <tr>

                        <td class="forborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                  <tr>

                                    <td height="20" colspan="3" class="bodytext" align="right">You must fill in any box that has a red asterisk (<font color="red">*</font>) by it&nbsp;<br/><br/><?php echo $er; ?></td>

                                  </tr>

                                  <tr>

                                    <td width="30%" height="30" class="bodytext">&nbsp;Name</td>

                                    <td colspan="2" class="bodytext">&nbsp;

                                        <input name="TXusername" type="text" class="textbox" size="30" required/>

                                        <font color="#FF0000">* </font></td>

                                  </tr>

                                  

                                  

                                  <tr>

                                    <td height="30" class="bodytext">&nbsp;Country</td>

                                    <td colspan="2" class="bodytext">&nbsp;

                                        <select name="CBOcountry" class="textbox" onchange="getOthers()" required >

                                          <option value="0">Select</option>

                                          <option value="ANTIGUA">ANTIGUA</option>

                                          <option value="ARGENTINA">ARGENTINA</option>

                                          <option value="ARMENIA">ARMENIA</option>

                                          <option value="AUSTRALIA">AUSTRALIA</option>

                                          <option value="AUSTRIA">AUSTRIA</option>

                                          <option value="BARBADOS">BARBADOS</option>

                                          <option value="BERMUDA">BERMUDA</option>

                                          <option value="BOTSWANA">BOTSWANA</option>

                                          <option value="BRAZIL">BRAZIL</option>

                                          <option value="BRITISH COLUMBIA">BRITISH COLUMBIA</option>

                                          <option value="CALIFORNIA - NORTH">CALIFORNIA - NORTH</option>

                                          <option value="CALIFORNIA - SOUTH">CALIFORNIA - SOUTH</option>

                                          <option value="CAMBODIA">CAMBODIA</option>

                                          <option value="CANADA">CANADA</option>

                                          <option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option>

                                          <option value="CHILE">CHILE</option>

                                          <option value="CHINA - BEIJING">CHINA - BEIJING</option>

                                          <option value="CHINA - HONG KONG">CHINA - HONG KONG</option>

                                          <option value="CHINA">CHINA</option>

                                          <option value="COLOMBIA">COLOMBIA</option>

                                          <option value="COLORADO">COLORADO</option>

                                          <option value="CONNECTICUT">CONNECTICUT</option>

                                          <option value="CROATIA">CROATIA</option>

                                          <option value="CYPRUS">CYPRUS</option>

                                          <option value="CZECH REPUBLIC">CZECH REPUBLIC</option>

                                          <option value="DAKOTAS">DAKOTAS</option>

                                          <option value="DELAWARE">DELAWARE</option>

                                          <option value="DENMARK">DENMARK</option>

                                          <option value="DIST. COLUMBIA">DIST. COLUMBIA</option>

                                          <option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option>

                                          <option value="ECUADOR">ECUADOR</option>

                                          <option value="EGYPT">EGYPT</option>

                                          <option value="ENGLAND/WALES">ENGLAND/WALES</option>

                                          <option value="ESTONIA">ESTONIA</option>

                                          <option value="FLORIDA">FLORIDA</option>

                                          <option value="FRANCE">FRANCE</option>

                                          <option value="GEORGIA">GEORGIA</option>

                                          <option value="GERMANY">GERMANY</option>

                                          <option value="GHANA">GHANA</option>

                                          <option value="GRENADA">GRENADA</option>

                                          <option value="GRENADINES">GRENADINES</option>

                                          <option value="GUATEMALA">GUATEMALA</option>

                                          <option value="GUYANA">GUYANA</option>

                                          <option value="HAITI">HAITI</option>

                                          <option value="HUNGARY">HUNGARY</option>

                                          <option value="ICELAND">ICELAND</option>

                                          <option value="ILLINOIS">ILLINOIS</option>

                                          <option value="INDIA">INDIA</option>

                                          <option value="INDIANA">INDIANA</option>

                                          <option value="INDONESIA">INDONESIA</option>

                                          <option value="IRAN">IRAN</option>

                                          <option value="ISRAEL">ISRAEL</option>

                                          <option value="ITALY">ITALY</option>

                                          <option value="JAPAN">JAPAN</option>

                                          <option value="JORDAN">JORDAN</option>

                                          <option value="KENTUCKY">KENTUCKY</option>

                                          <option value="KOREA - SOUTH">KOREA - SOUTH</option>

                                          <option value="LAOS">LAOS</option>

                                          <option value="LEBANON">LEBANON</option>

                                          <option value="LITHUANIA">LITHUANIA</option>

                                          <option value="LUXEMBOURG">LUXEMBOURG</option>

                                          <option value="MALAYSIA">MALAYSIA</option>

                                          <option value="MALTA">MALTA</option>

                                          <option value="MEXICO">MEXICO</option>

                                          <option value="NEPAL">NEPAL</option>

                                          <option value="NETHERLANDS">NETHERLANDS</option>

                                          <option value="NEVADA">NEVADA</option>

                                          <option value="NEW SOUTH WALES">NEW SOUTH WALES</option>

                                          <option value="NEW YORK/NEW JERSEY">NEW YORK/NEW JERSEY</option>

                                          <option value="NEW ZEALAND">NEW ZEALAND</option>

                                          <option value="NIGERIA">NIGERIA</option>

                                          <option value="NORTH CAROLINA">NORTH CAROLINA</option>



                                          <option value="NORTHERN IRELAND">NORTHERN IRELAND</option>

                                          <option value="NORWAY">NORWAY</option>

                                          <option value="OHIO">OHIO</option>

                                          <option value="OKLAHOMA">OKLAHOMA</option>

                                          <option value="ONTARIO">ONTARIO</option>

                                          <option value="OREGON">OREGON</option>

                                          <option value="PAKISTAN">PAKISTAN</option>

                                          <option value="PALESTINE">PALESTINE</option>

                                          <option value="PENNSYLVANIA">PENNSYLVANIA</option>

                                          <option value="PHILIPPINES">PHILIPPINES</option>

                                          <option value="PORTUGAL">PORTUGAL</option>

                                          <option value="PUERTO RICO">PUERTO RICO</option>

                                          <option value="QATAR">QATAR</option>

                                          <option value="QUEBEC">QUEBEC</option>

                                          <option value="QUEENSLAND">QUEENSLAND</option>

                                          <option value="REPUBLIC OF IRELAND">REPUBLIC OF IRELAND</option>

                                          <option value="ROMANIA">ROMANIA</option>

                                          <option value="RUSSIA">RUSSIA</option>

                                          <option value="SAUDI ARABIA">SAUDI ARABIA</option>

                                          <option value="SCOTLAND">SCOTLAND</option>

                                          <option value="SERBIA">SERBIA</option>

                                          <option value="SINGAPORE">SINGAPORE</option>

                                          <option value="SLOVENIA">SLOVENIA</option>

                                          <option value="SOUTH AFRICA">SOUTH AFRICA</option>

                                          <option value="SOUTH CAROLINA">SOUTH CAROLINA</option>

                                          <option value="SPAIN">SPAIN</option>

                                          <option value="SRI LANKA">SRI LANKA</option>

                                          <option value="ST LUCIA">ST LUCIA</option>

                                          <option value="ST VINCENT">ST VINCENT</option>

                                          <option value="SWEDEN">SWEDEN</option>

                                          <option value="SWITZERLAND">SWITZERLAND</option>

                                          <option value="TAIWAN">TAIWAN</option>

                                          <option value="TANZANIA">TANZANIA</option>

                                          <option value="TENNESSEE">TENNESSEE</option>

                                          <option value="TEST COUNTRY">TEST COUNTRY</option>

                                          <option value="TEXAS">TEXAS</option>

                                          <option value="THAILAND">THAILAND</option>

                                          <option value="TUNISIA">TUNISIA</option>

                                          <option value="TURKEY">TURKEY</option>

                                          <option value="UGANDA">UGANDA</option>

                                          <option value="UK - NORTHERN IRELAND">UK - NORTHERN IRELAND</option>

                                          <option value="UK - SCOTLAND">UK - SCOTLAND</option>

                                          <option value="UK">UK</option>

                                          <option value="UKRAINE">UKRAINE</option>

                                          <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>

                                          <option value="URUGUAY">URUGUAY</option>

                                          <option value="UTAH">UTAH</option>

                                          <option value="UZBEKISTAN">UZBEKISTAN</option>

                                          <option value="VIETNAM">VIETNAM</option>

                                          <option value="VIRGINIA">VIRGINIA</option>

                                          <option value="WASHINGTON STATE">WASHINGTON STATE</option>

                                          <option value="WEST VIRGINIA">WEST VIRGINIA</option>

                                          <option value="WISCONSIN">WISCONSIN</option>

                                        </select>

                                        <font color="#FF0000">*</font></td>

                                  </tr>

                                  <tr>

                                    <td height="30" class="bodytext">&nbsp;Telephone</td>

                                    <td colspan="2" class="bodytext">&nbsp;

                                        <input name="TXtelephone" type="text" class="textbox" maxlength="12" size="20" required />

                                        <font color="#FF0000">*</font> </td>

                                  </tr>

                                  <tr>

                                    <td height="30" class="bodytext">&nbsp;Mobile</td>

                                    <td colspan="2">&nbsp;

                                        <input name="TXmobile" type="text" class="textbox" maxlength="12" size="20" /></td>

                                  </tr>

                                  <tr>

                                    <td height="30" class="bodytext">&nbsp;E-mail address</td>

                                    <td colspan="2" class="bodytext">&nbsp;

                                        <input name="TXemailid" type="email" class="textbox" size="30" required />

                                        <font color="#FF0000">*&nbsp;</font>[This will be your User ID]</td>

                                  </tr>

                                  <tr>

                                    <td height="30" class="bodytext">&nbsp;Password</td>

                                    <td colspan="2" class="bodytext">&nbsp;

                                        <input name="TXpwd" type="password" class="textbox" size="16" maxlength="16" required />

                                        <font color="#FF0000">*</font></td>

                                  </tr>

                                  <tr>

                                    <td height="30" class="bodytext">&nbsp;Confirm Password</td>

                                    <td colspan="2" class="bodytext">&nbsp;

                                        <input name="TXconfirm_pwd" type="password" class="textbox" size="16" maxlength="16" required />

                                        <font color="#FF0000">*</font></td>

                                  </tr>

                                  <tr>

                                    <td height="30" class="bodytext">&nbsp;Date of Birth</td>

                                    <td colspan="2" class="bodytext">&nbsp;

                                        <select name="TXbdate2" class="textbox">

                                          <?

for($d=01;$d<=31;$d++)

{

?>

                                          <option value="<? echo $d ?>"><? echo $d?></option>

                                          <?

}

?>

                                        </select>

                                      -

                                      <select name="TXbdate1" class="textbox">

                                          <?	

for($m=1;$m<=12;$m++)

{

	$monthnm=date("F", mktime(0, 0, 0, $m,1,2005));

?>

                                          <option value="<? echo $m;?>"><? echo $monthnm;?></option>

                                          <?

}

?>

                                        </select>

                                      -

                                      <select name="TXbdate3" class="textbox">

                                          <?



for($i=1960;$i<=date("Y");$i++)

{

?>

                                          <option value="<? echo $i ?>"><?echo $i?></option>

                                          <?

}

?>

                                        </select>

                                      &nbsp;[dd-mm-yyyy]</td>

                                  </tr>

                                  <!--<tr>

                                    <td height="30" class="bodytext">&nbsp;Ethnicity</td>

                                    <td width="26%" class="bodytext">&nbsp;

                                        <select name="CBOethnicity" class="textbox" onchange="getOthers()" required >

                                          <option value="0">Select</option>

                                          <option value="African">African</option>

                                          <option value="African Caribbean">African Caribbean</option>

                                          <option value="Asian">Asian</option>

                                          <option value="Black British">Black British</option>

                                          <option value="Chinese">Chinese</option>

                                          <option value="White European">White European</option>

                                          <option value="Other">Other</option>

                                        </select>

                                        <font color="#FF0000">*</font> </td>

                                    <td width="44%" class="text2"><table id="ethnicity">

                                        <tr>

                                          <td><input type="text" name="TXethnicity" value="" class="textbox" />

                                          </td>

                                        </tr>

                                    </table></td>

                                  </tr>-->

                                <tr>

                                    <td height="30" class="bodytext">&nbsp;Employment</td>

                                    <td width="26%" class="bodytext">&nbsp;

                                        <select name="CBOethnicity" class="textbox" required >

                                          <option value="0">Select</option>

                                          <option value="Unemployed">Unemployed</option>

                                          <option value="Employed">Employed</option>

                                         

                                        </select>

                                        <font color="#FF0000">*</font> </td>

                                    <td width="44%" class="text2"></td>

                                  </tr>
<tr>

                                    <td height="30" class="bodytext">&nbsp;Capcha :  <strong><?php $num1=rand(0,9);
					  $num2=rand(0,9);
					  echo $num1." + ".$num2." = "; 
				?></strong>
                <input type="hidden" name="total" value="<?php echo $num1+$num2; ?>" /></td>

                                    <td width="26%" class="bodytext">&nbsp;

                                       <input type="text" value="" class="textbox" style="width:101px;" name="capcha" />

                                        <font color="#FF0000">*</font> </td>

                                    <td width="44%" class="text2"></td>

                                  </tr>
                                  <tr>

                                    <td height="30" class="bodytext">&nbsp;Sex</td>

                                    <td colspan="2" class="bodytext">&nbsp;

                                        <input name="rnd" type="radio" value="1" checked="checked" />

                                      Male

                                      <input name="rnd" type="radio" value="0" />

                                      Female </td>

                                  </tr>

                              </table></td>

                            </tr>

                        </table></td>

                      </tr>

                  </table></td>

                </tr>

                <tr>

                  <td><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">

                      <tr>

                        <td width="1%" valign="top" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25" /></td>

                        <!--<td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/submitbttn.jpg" name="image" class="mouse" id="image" onclick="validation()" /></div></td>-->

<td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><input type='submit' name='submit' style='background-image:url(images/submitbttn.jpg);width:70px;' value=''/></div></td>

                        <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25" /></div></td>

                      </tr>

                  </table></td>

                </tr>

              </form>

              <? } ?>

            </table>

                    </td>

                    </tr>

              		</table>

              		<table width="380" height="272" border="0" align="center" cellpadding="0" cellspacing="0">

                		

              		</table>

              		<table width="380" border="0" align="center" cellpadding="0" cellspacing="0">

                		

                		

              		</table>

                </td>

          	</tr>

        </table>

       </td>

      </tr>

      <?php include('footer.php'); ?>

    </table>

    </td>

  </tr>

</table>



<map name="Map" id="Map"><area shape="rect" coords="4,5,47,28" href="#" /></map>

<map name="Map2" id="Map2"><area shape="rect" coords="5,3,88,28" href="<?php echo $chatstr;?>" /></map>



<map name="Map10" id="Map10">

<area shape="rect" coords="-4,2,157,61" href="#" />

</map>

<map name="Map11" id="Map11">

<area shape="rect" coords="2,1,181,46" href="#" />

</map>

</body>

</html>

