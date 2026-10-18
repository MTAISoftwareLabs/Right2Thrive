<?php
@ini_set('display_errors', 'off');
@ini_set('display_errors', 'on');
session_start();
include "dbConnection.php";
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', FALSE); 
header('Pragma: no-cache'); 
?>
<?php
//echo $_POST['TXUSERID'];
date_default_timezone_set('Europe/London');
$msg = "";

if (isset($_POST['TXUSERID']))
{
  		$sqlchange = "select * from cpo_usermaster where vUserEmailId='".$_POST['TXUSERID']."' and vUserPassword='".$_POST['TXPASSWORD']."' and iUserStatus=1";		

                $rschange = runquery($sqlchange);	

		$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
		//echo $num;
		if ($num > 0 )
		{
			$res=mysqli_fetch_array($rschange);
			//session_register('user_id');
			$_SESSION['user_id']= $res['iUserId'];
			//session_register('user_name');
			$_SESSION['user_name']=$res['vUserName'];
						//session_register('email_id');
			$_SESSION['email_id']=$res['vUserName'];
						//session_register('module');
			$_SESSION['module']=$res['iUserType'];
						//session_register('log_fill');
			$_SESSION['log_fill']=0;
			//echo $res['iUserType'];
			$HTTP_SESSION_VARS['user_id']=$res['iUserId'];
			$HTTP_SESSION_VARS['user_name']=$res['vUserName'];
			$HTTP_SESSION_VARS['email_id']=$_POST['TXUSERID'];
			$HTTP_SESSION_VARS['module']=$res['iUserType'];
			$HTTP_SESSION_VARS['log_fill']=0;

			//////	Sending mail	//////////////
			if($res['iUserType']==1)
			{
				$sectionname = "TMS";
			}

			if($res['iUserType']==2)
			{
				$sectionname = "LMS";
			}

			if($res['iUserType']==4)
			{
				$sectionname = "TPM";
			}
			
			//echo $sectionname;
			//echo $HTTP_SESSION_VARS['user_name'];
		

			//////	Sending mail over	//////////////
			
			
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "cleeown@yahoo.co.uk";
 
    $email_subject = "Colin";
 
 
    $first_name = $HTTP_SESSION_VARS['user_name']; // required
  
    $email_from = $HTTP_SESSION_VARS['email_id']; // required
 
 
    $email_message = "Form details below.\n\n";
 

    $email_message = "Member: ".clean_string($first_name)." has been logged in My Digital Future at ".date('d-m-Y G:i:s')." in ".$sectionname."\n";
  
	// create email headers
	
	$header = "From: ".$email_from."\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n"; 
	$headers .= "X-Mailer: PHP/" . phpversion();
	$headers .= "X-Priority: 1" . "\r\n"; 
	

	mail($email_to, $email_subject, $email_message, $headers);  
 


			if($res['iUserType']==1)

			{

				tutor_counter(1);

			?>

				<script language="JavaScript" type="text/javascript">

				location.replace("tms/index.php");

				</script>

			<?php

			}

			if($res['iUserType']==2)

			{
				//echo "user 2";
				addlog(1);

				?>

				<script language="JavaScript" type="text/javascript">
                
				location.replace("lms/index.php");

				</script>

			<?php

			}

			if($res['iUserType']==4)

			{

			?>

				<script language="JavaScript" type="text/javascript">

				location.replace("tpm/index.php");

				</script>

			<?php

			}

		}

		else

		{  

			$msg = "Invalid User ID or Password";

		}

}

if(isset($_POST['reglogin_x']))
{
extract($_POST);
  		$sqlchange = "select * from cpo_usermaster where vUserEmailId='".$_POST['TXUSERID1']."' and vUserPassword='".$_POST['TXPASSWORD1']."' and iUserStatus=1";		

                $rschange = runquery($sqlchange);	

		$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
		//echo $num;
		if ($num > 0 )

		{
			$res=mysqli_fetch_array($rschange);
			//session_register('user_id');
			$_SESSION['user_id']= $res['iUserId'];
			//session_register('user_name');
			$_SESSION['user_name']=$res['vUserName'];
						//session_register('email_id');
			$_SESSION['email_id']=$res['vUserName'];
						//session_register('module');
			$_SESSION['module']=$res['iUserType'];
						//session_register('log_fill');
			$_SESSION['log_fill']=0;

			//echo $res['iUserType'];

			$HTTP_SESSION_VARS['user_id']=$res['iUserId'];

			$HTTP_SESSION_VARS['user_name']=$res['vUserName'];

			$HTTP_SESSION_VARS['email_id']=$_POST['TXUSERID1'];

			$HTTP_SESSION_VARS['module']=$res['iUserType'];

			$HTTP_SESSION_VARS['log_fill']=0;

		

			//////	Sending mail	//////////////

			if($res['iUserType']==1)

			{

				$sectionname = "TMS";

			}

			if($res['iUserType']==2)

			{

				$sectionname = "LMS";

			}

			if($res['iUserType']==4)

			{

				$sectionname = "TPM";

			}

			
			//echo $sectionname;
			//echo $HTTP_SESSION_VARS['user_name'];
			$fromname='CareerPaths Online';//$HTTP_SESSION_VARS['user_name'];

			$fromaddress=$HTTP_SESSION_VARS['email_id'];

			$toname='Colin';

			//$toaddress='colin_leeown2000@yahoo.com';

			$toaddress='info@careerpathsonline.net';
			//$toaddress="samheighes@gmail.com";

			$subject="Member '".$HTTP_SESSION_VARS['user_name']."' has been logged in";

			$message="<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'>

				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>

				Member <b>'".$HTTP_SESSION_VARS['user_name']."'</b> has been logged in CareerPaths Online at <b>".date('d-m-Y G:i:s')."</b> in <b>".$sectionname."</b> Section.

				";

				SendingMail($fromname,$fromaddress,$fromname,$toaddress, $subject, $message);

				

			//////	Sending mail over	//////////////

				



			if($res['iUserType']==1)

			{

				tutor_counter(1);

			?>

				<script language="JavaScript" type="text/javascript">

				location.replace("tms/index.php");

				</script>

			<?php

			}

			if($res['iUserType']==2)

			{
				//echo "user 2";
				addlog(1);

				?>

				<script language="JavaScript" type="text/javascript">
                
				location.replace("/lms/index.php");

				</script>

			<?php

			}

			if($res['iUserType']==4)

			{

			?>

				<script language="JavaScript" type="text/javascript">

				location.replace("tpm/index.php");

				</script>

			<?php

			}

		}

		else

		{  

			$msg = "Invalid User ID or Password";

		}


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CareerPaths Online :: User Login</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
#menu
 {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 620px;
	height: 27px;
	clear: both;
	position: relative;
} 
#menu 
ul 
{ 
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
}

#menu
ul 
li 
{
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
list-style:none; 
float:left;
}
#menu
ul 
li 
a 
{
margin: 0px 0px 0px 0px;
padding: 7px 8px 5px 9px; 
font: normal 14px/15px 'Lucida Grande', 'Geneva', 'Helvetica', 'Tahoma', 'Verdana', sans-serif , Arial; 
color: #000000; 
display: block;
text-decoration: none; 

}

#menu
ul 
li 
a:hover 
{ 
margin: 0px 0px 0px 0px;
padding:7px 8px 5px 9px;
color:#ff0003;
text-decoration:none; 
clear:right;
}
-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<link href="css.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" type="text/JavaScript">

function openwin()

{

	new1=window.open("help.htm","",'height=400,width=600,scrollbars=yes,top=50 left=150');

}

function checklogin()

{

	var x = document.FRMLOGIN.TXUSERID.value;

	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (!filter.test(x))

	{

		alert("Enter a valid E-mail address!");

		document.FRMLOGIN.TXUSERID.value="";

		document.FRMLOGIN.TXUSERID.focus();

		return false;

	}

	if(document.FRMLOGIN.TXPASSWORD.value=="") 

	{

		alert("Enter a valid Password!");

		document.FRMLOGIN.TXPASSWORD.value="";

		document.FRMLOGIN.TXPASSWORD.focus();

		return false;

	}

	return true;

}

function onload()

{

	document.FRMLOGIN.TXUSERID.focus();

}




//-->
</script>
<style type="text/css">
<!--
.style1 {font-size: 10pt; color: #4FAFE9; font-family: verdana;}
-->
</style>
<link href="css/style.css" rel="stylesheet" type="text/css" />

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
<body>



<table width="800" height="900" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="FRMLOGIN" action="user_login.php" method="post" onSubmit="return checklogin()">
<?php
include('header.php');  
?>
      <tr>
        <td height="622" valign="top">
        	<table width="800" border="0" cellspacing="0" cellpadding="0">
          		<tr>
                  <!-- <td width="205" height="200" valign="top" bgcolor="#f5f5f5">
                    <?php //include('left.php');?>
                  </td>
-->
                  <td width="580" valign="top">
                    <table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
               <!--      	<tr>
                <td width="100%" class="fontgreen_big"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td   height="23" colspan="2" class="intheading" ><div align="right" class="t_bottom_border">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100%" class="fontgreen_big"><img src="images/arrow.gif" width="14" height="14" alt="" /> Welcome To Online Learning</td>
                            </tr>
                          </table>
                      </div></td>
                      <td class="intheading">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>-->
              <tr>
                <td width="100%">&nbsp;
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="1"><img src="images/changep_left_cor.jpg" width="11" height="20" alt="" /></td>
                        <td width="493" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="49%" class="fontgreen"><div align="left"><font color="#FFFFFF">Login</font></div></td>
                              <td width="50%" class="fontgreen"><div align="right"><strong>::</strong></div></td>
                            </tr>
                        </table></td>
                        <td width="1" background="images/changep_right_cor.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="46%" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="2%"><img src="images/login1.jpg" width="8" height="8" alt="" /></td>
                                    <td width="97%" background="images/login2.jpg"><img src="images/login2.jpg" width="8" height="8" alt="" /></td>
                                    <td width="1%"><img src="images/login3.jpg" width="8" height="8" alt="" /></td>
                                  </tr>
                                  <tr>
                                    <td background="images/flogin4.jpg">&nbsp;</td>
                                    <td bgcolor="E1F3FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="22" class=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;Already 
                                            
                                            a Member?</strong></font></td>
                                        </tr>
                                        <tr>
                                          <td height="15" valign="top" class="fontnorm" style="border-bottom:1px solid #ffffff">&nbsp;Please 
                                            
                                            Sign in.</td>
                                        </tr>
                                        <?php 							

//								if(isset(cleancode($_GET['flag']))==1)

	//							{

		//							$msg="Invalid User ID or Password";

									//$cnt=1;

								?>
                                        <tr>
                                          <td class="error"><font color="#FF0000">&nbsp;<?php echo $msg;?></font></td>
                                        </tr>
                                        <?php

			//					}

						  		

								?>
                                        <tr>
                                          <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                                              <tr>
                                                <td width="29%" height="35" class="fontnorm"><strong>&nbsp;&nbsp;User 
                                                  
                                                  ID&nbsp;</strong></td>
                                                <td width="71%" height="30">&nbsp;&nbsp;
                                                    <input type="text" name="TXUSERID" size="20" maxlength="50" class="textbox" /></td>
                                              </tr>
                                              <tr>
                                                <td height="35" class="fontnorm"><strong>&nbsp;&nbsp;Password&nbsp;</strong></td>
                                                <td height="30">&nbsp;&nbsp;
                                                    <input type="password" name="TXPASSWORD" size="20" maxlength="10" class="textbox" value="" />
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td height="35" colspan="2"><div align="right">
                                                    <input name="image" type="image" src="images/submitbttn.jpg" width="67" height="17">
                                                  &nbsp;</div></td>
                                                  
                                              </tr>
                                              </form>
                                              <tr>
                                                <td height="20" colspan="3" class="fontnorm">&nbsp;<a class="links" href="forgotpwd.php">Forgot 
                                                  
                                                  your password?</a></td>
                                              </tr>
                                              <tr>
                                                <td height="20" colspan="3" class="fontnorm">&nbsp;<a class="links" href="javascript:openwin();">Having 
                                                  
                                                  trouble signing in?</a></td>
                                              </tr>
                                              <tr>
                                                <td height="23" colspan="3">&nbsp;</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                    </table></td>
                                    <td background="images/login4.jpg"><img src="images/login4.jpg" width="8" height="8" alt="" /></td>
                                  </tr>
                                  <tr >
                                    <td><img src="images/flogin1.jpg" width="8" height="8" alt="" /></td>
                                    <td background="images/flogin2.jpg"><img src="images/flogin2.jpg" width="8" height="8" alt="" /></td>
                                    <td><img src="images/flogin3.jpg" width="8" height="8" alt="" /></td>
                                  </tr>
                              </table></td>
                              <td width="54%" valign="top"><table width="94%" border="0" align="right" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="2%"><img src="images/grey1.jpg" width="9" height="8" alt="" /></td>
                                    <td width="97%" background="images/fgrey4.jpg"><img src="images/fgrey4.jpg" width="9" height="8" alt="" /></td>
                                    <td width="1%"><img src="images/grey7.jpg" width="9" height="8" alt="" /></td>
                                  </tr>
                                  <tr>
                                    <td background="images/grey2.jpg">&nbsp;</td>
                                    <td height="50" bgcolor="#F9F9F9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="28" style="border-bottom:1px solid #cccccc"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;New 
                                            
                                            to Online Learning?</strong></font></td>
                                        </tr>
                                        <tr>
                                          <td height="26" class="fontnorm">&nbsp;To 
                                            
                                            get below Benefits Sign Up <font color="#FF0000"><strong>NOW!!</strong></font></td>
                                        </tr>
                                        <tr>
                                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td class="fontnorm"><div align="center">o</div></td>
                                                <td height="20" class="fontnorm">Improve 
                                                  
                                                  your Job Prospects. </td>
                                              </tr>
                                              <tr>
                                                <td class="fontnorm"><div align="center">o</div></td>
                                                <td width="94%" height="20" class="fontnorm">Gain Key Skills to find a Job. </td>
                                              </tr>
                                              <tr>
                                                <td valign="top" class="fontnorm"><div align="center">o</div></td>
                                                <td height="30" class="fontnorm">Instant access to one-2-one online Tutoring and Mentoring Support. </td>
                                              </tr>
                                              <tr>
                                                <td valign="top" class="fontnorm"><div align="center">o</div></td>
                                                <td width="94%" height="30" class="fontnorm">Learn New Skills without the peer pressure in a classroom. </td>
                                              </tr>
                                              <tr>
                                                <td class="fontnorm"><div align="center"></div></td>
                                                <td height="30" class="fontnorm"><div align="center"><a href="register.php"><img  alt="" src="images/signup.gif" width="99" height="19" border="0" /></a></div></td>
                                              </tr>
                                          </table></td>

                                        </tr>
                                    </table></td>
                                    <td background="images/fgrey2.jpg" height="10"><img src="images/fgrey2.jpg" width="9" height="8" alt="" /></td>
                                  </tr>
                                  <tr>
                                    <td><img src="images/grey3.jpg" width="9" height="8" alt="" /></td>
                                    <td background="images/grey4.jpg"><img src="images/grey4.jpg" width="10" height="8" alt="" /></td>
                                    <td><img src="images/grey5.jpg" width="9" height="8" alt="" /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td width="1" ><img src="images/changebttm_left_cor.jpg" width="11" height="25" alt="" /></td>
                        <td width="99%" height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                        <td width="1" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25" alt="" /></div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                  </table></td>
              </tr>
            </table></td>
            </tr>
            
            		</table>
              		<table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
                	
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