<?php
ob_start();
session_start();
include_once("dbConnection.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="cufon-active cufon-ready" xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Welcome to My Digital Future</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-1">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Language" content="en"> 
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="imagetoolbar" content="no">
<meta name="Keywords" content="">
<meta name="Description" content="Welcome to My Digital Future">
<meta name="robots" content="index,follow"> 
<link type="text/css" rel="stylesheet" media="screen" href="css/newstyle.css"> 
<link rel="shortcut icon" href="" title="Favicon">
<!--[if lt IE 8]>

<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>

<![endif]-->


<script src="js/cufon-yui.js" type="text/javascript"></script>

<style type="text/css">
cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}
</style></style>

<script src="js/Lacuna_Regular_400.js" type="text/javascript"></script> 
<script src="js/Aller_400.js" type="text/javascript"></script> 

<script type="text/javascript">
			Cufon.replace('h1', { fontFamily: 'Lacuna Regular' });
			Cufon.replace('h2', { fontFamily: 'Aller' });
			Cufon.replace('h3', { fontFamily: 'Lacuna Regular' });
		</script>

<script type="text/javascript" language="javascript" src="js/loginvalid.js"></script>

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

<!-- Start Wrapper -->
<div id="wrapper">

	<!-- Start Header -->
	<?php include "includes/header.php"; ?>
	<!-- End Header -->
	<div><p></p></div>
	<!--<div align="center">
			<img src="images/flash.jpg" width="912" height="188"/>
  </div>-->
<!-- Start Featured -->
  	 <!--<div id="featured1">
	
	<div id="featured_left">

	</div>
	

		
</div>-->
	<!-- End Featured -->
	
	<!-- Start Featured Sub -->
	
	<!-- End Featured Sub -->
	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
	<div id="content">
	
		<!-- Start Content Left -->
	  <div id="content_left" class="content">
	   <div>
  <div class="content_left_h"><h3><cufon style="width: 112px; height: 22px;" alt="HELP" class="cufon cufon-canvas"><canvas style="width: 138px; height: 29px; top: -4px; left: 0px;" height="29" width="138"></canvas>
  <cufontext>HELP </cufontext></cufon></h3></div>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="550" id="AutoNumber5" height="509">
      <tr>
        <td width="1%" height="509">&nbsp;</td>
        <td width="99%" height="509" class="fontgreen_big">SIGN IN HELP
            <hr color="#8EBADB" size="1" />
            <b>Help me with...</b>
            <hr color="#8EBADB" size="1" />
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber6" height="1">
              <tr>
                <td width="3%" height="13"><img border="0" src="images/bullet.gif" width="7" height="12" /></td>
                <td width="97%" height="13"><a href="#a0" class="links">Signing In</a></td>
              </tr>
              <tr>
                <td width="3%" height="13"><img border="0" src="images/bullet.gif" width="7" height="12" /></td>
                <td width="97%" height="13"><a href="#a01" class="links">What Should I Do If I Forget My 
                  Password?</a></td>
              </tr>
              <tr>
                <td width="3%" height="7"><img border="0" src="images/bullet.gif" width="7" height="12" /></td>
                <td width="97%" height="7"><a href="#a02" class="links">I Want to Change My Password. What Do I 
                  Do?</a></td>
              </tr>
              <tr>
                <td width="3%" height="11"><img border="0" src="images/bullet.gif" width="7" height="12" /></td>
                <td width="97%" height="11"><a href="#a04" class="links">How Do I Sign Out of My Digital Future?</a></td>
              </tr>
              <tr>
                <td width="3%" height="8"></td>
                <td width="97%" height="8"></td>
              </tr>
              <tr>
                <td width="3%" height="8"><a name="a0" id="a0"></a> <img border="0" src="images/bullet.gif" width="7" height="12" class="fontgreen" /></td>
                <td width="97%" height="8" class="fontgreen"><b>Signing In to My Digital Future</b></td>
              </tr>
              <tr>
                <td width="3%" height="6"></td>
                <td class="fontnorm" width="97%" height="6">For your protection, you must sign in to 
                  use My Digital Future. <br />
                        <br />
                        <b>To sign in: </b>
                        <ol>
                          <li>On the <b> <a class="local" style="cursor:pointer;" onclick="return popitup('user_login.php')"> <u>Login</u></a></b> page, type your login email address in the Email 
                            Address field. This <b>email address</b> is what you used to sign 
                            up for the My Digital Future service.</li>
                          <li>In the <b>Password</b> field, type your password. </li>
                          <li>Click <b>Submit</b>. </li>
                        </ol></td>
              </tr>
              <tr>
                <td width="3%" height="1"></td>
              </tr>
              <tr>
                <td width="3%" height="23">&nbsp;</td>
                <td width="97%" height="23"><p align="right"><a href="#a_p"> <img border="0" src="images/top.gif" width="40" height="15" /></a></p></td>
              </tr>
              <tr>
                <td width="100%" height="23" colspan="2"><hr color="#8EBADB" size="1" />
                </td>
              </tr>
              <tr>
                <td width="3%" height="23"><a name="a01" id="a01"></a> <img border="0" src="images/bullet.gif" width="7" height="12" /></td>
                <td class="fontnorm" width="97%" height="23"><b>What Should I Do If I Forget My 
                  Password?<br />
                  &nbsp;</b></td>
              </tr>
              <tr>
                <td width="3%" height="23">&nbsp;</td>
                <td class="fontnorm" width="97%" height="23">If you forget your password, you must 
                  request password retrieval. For security reasons, we cannot tell you 
                  what your Login Email Address is. If you have forgotten your 
                  password, we'll be happy to remind you of your password at any time. <br />
                        <br />
                        <b>To retrieve forgotten password: </b>
                        <ol>
                          <li>Please go to the <b> <a class="local"  style="cursor:pointer;" onclick="return popitup('user_login.php')"> <u>Login</u></a></b> area of My Digital Future. </li>
                          <li>Enter your Login Email Address in the <b><a class="local"  style="cursor:pointer;" onclick="return popitup('forgotpwd.php')"">Forgot Password? </a></b>
                            form. </li>
                          <li>Click <b>Submit.</b> </li>
                        </ol>
                  <p>We will send your password in plain text via email. <br />
                            <br />
                            <b>Remember:</b> Your own email address is the key to your 
                    My Digital Future account - it is unique to you. You can also <b> <a class="local"  style="cursor:pointer;" onclick="return popitup('forgotpwd.php')"">click 
                      here to go to &ldquo;Forgot Password?&rdquo;.</a> </b><br />
                    &nbsp;</p></td>
              </tr>
              <tr>
                <td class="fontnorm" width="3%" height="23">&nbsp;</td>
                <td class="fontnorm" width="97%" height="23"><p align="right"><a title="Top" href="#a_p"> <img border="0" src="images/top.gif" width="40" height="15" /></a></p></td>
              </tr>
              <tr>
                <td class="fontnorm" width="100%" height="23" colspan="2"><hr color="#8EBADB" size="1" />
                </td>
              </tr>
              <tr>
                <td class="fontnorm" width="3%" height="23"><a name="a02" id="a02"></a> <img border="0" src="images/bullet.gif" width="7" height="12" /></td>
                <td class="fontnorm" width="97%" height="23"><b>I Want to Change My Password. What Do 
                  I Do?</b></td>
              </tr>
              <tr>
                <td class="fontnorm" width="3%" height="23">&nbsp;</td>
                <td class="fontnorm" width="97%" height="23"> You can change your password at any time after you sign in. <br />
                    <br />
                    <b>To change your password:</b>
                  <ol>
                      <li>First Sign in with your current Login Email Address and 
                        Password. </li>
                    <li>Click <b>Change Password.</b> </li>
                    <li>In <b>Old Password</b>, type your current password. You 
                      must type your current password before you can change it to a new 
                      one. </li>
                    <li>In <b>New Password</b>, type the new password you would like 
                      to use. <br />
                              <b><br />
                                Note: </b>The password must be between five and twelve 
                      characters (letters or numbers). Try to pick a password 
                      that no one can guess. We recommend a combination of letters 
                      and numbers for security reasons.</li>
                    <li>In <b>Confirm Password</b>, type your new password again 
                      to verify it.</li>
                    <li>When you are finished, click <b>Submit</b>.</li>
                  </ol>
                  <p>Use your new password the next time you sign in to your My Digital Future account.<br />
                    &nbsp;</p></td>
              </tr>
              <tr>
                <td class="fontnorm" width="3%" height="23"><img border="0" src="images/tip.gif" width="14" height="13" /></td>
                <td class="fontnorm" width="97%" height="23"><b>Tip: <br />
                  </b>Write down your password and keep it in a secure place - you 
                  will need to enter it the next time you log on to My Digital Future's 
                  secure web site.</td>
              </tr>
              <tr>
                <td class="fontnorm" width="3%" height="23">&nbsp;</td>
                <td class="fontnorm" width="97%" height="23"><p align="right"><a title="Top" href="#a_p"> <img border="0" src="images/top.gif" width="40" height="15" /></a></p></td>
              </tr>
              <tr>
                <td width="100%" height="23" colspan="2"><hr color="#8EBADB" size="1" />
                </td>
              </tr>
              <tr>
                <td width="3%" height="23"><b><a name="a04" id="a04"></a> <img border="0" src="images/bullet.gif" width="7" height="12" /></b></td>
                <td width="97%" height="23" class="fontgreen"><b>How Do I Sign Out of My Digital Future?</b></td>
              </tr>
              <tr>
                <td width="3%" height="23">&nbsp;</td>
                <td class="fontnorm" width="97%" height="23"> When you are finished accessing the recorded data and viewing the 
                  reports in your My Digital Futureaccount, click the <b>Logout</b> button at the top right of the page. You should <b>ALWAYS</b> logout 
                  of your My Digital Future account when finished, even if you plan to 
                  continue using your device.</td>
              </tr>
              <tr>
                <td width="3%" height="23">&nbsp;</td>
                <td width="97%" height="23"><p align="right"><a title="Top" href="#a_p"> <img border="0" src="images/top.gif" width="40" height="15" /></a></p></td>
              </tr>
              <tr>
                <td width="3%" height="23" align="center">&nbsp;</td>
                <td width="97%" height="23" align="center"><hr color="#8EBADB" size="1" />
                </td>
              </tr>
              <tr>
                <td colspan="2" align="left" class="fontnorm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
     If you still have any problem please mail us on  	 
<a href="mailto:info@mydigitalfuture.co.uk" class="links2">info@mydigitalfuture.co.uk</a></td>
              </tr>
              <tr>
                <td colspan="2" align="right"><a href="javascript:window.close();" class="midsublink"><img src="images/close.gif" alt="close" id="close" border="0" /></a></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
          </table></td>
      </tr>
    </table>
	   </div>
	  </div>
		<!-- End Content Left -->
		
		<!-- Start Content Right -->
	  <?php include "includes/rightpanel.php"; ?>
	  
		<!-- End Content Right -->
		
		<br style="clear: both;">	
	</div>
	<!-- End Content -->
	
	<!-- Start Content Rounded Corners Bottom -->
	<div id="content_rb"></div>
	<!-- End Content Rounded Corners Bottom -->
	
	<!-- Start Footer -->
	<?php include "includes/footer.php"; ?>
	<!-- End Footer -->

</div>
<!-- End Wrapper -->
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url);
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
<script type="text/javascript"> Cufon.now(); </script>
<div style="display: none;" id="lbOverlay"></div><div style="display: none;" id="lbCenter"><div id="lbImage"><div style="position: relative;"><a id="lbPrevLink" href="#"></a><a id="lbNextLink" href="#"></a></div></div></div><div style="display: none;" id="lbBottomContainer"><div id="lbBottom"><a id="lbCloseLink" href="#"></a><div id="lbCaption"></div><div id="lbNumber"></div><div style="clear: both;"></div></div></div>
</body>
</html>