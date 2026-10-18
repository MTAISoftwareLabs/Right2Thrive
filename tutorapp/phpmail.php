<?php 
ob_start();
include_once "dbConnection.php";
?>

<html>
<head>
<title>CareerPaths Online :: New Learner Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">

<?php
// URL of script: http://www.blazonry.com/scripting/phpmail.php

  // if submitted form process and send mail
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

	// just to be safe I strip out HTML tags
	$realname = strip_tags($realname);
	$email = strip_tags($email);
	$feedback = strip_tags($feedback);

	// set the variables
	// replace $me@mysite.com with your email address
	$sendto = "neilnpaul@gmail.com"; // this is the email address collected form the form
	$subject = "customized";
	$message = "$realname, $email\n\n$feedback";

	// send the email
	mail($sendto, $subject, $message);

  }

?>

<html>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style><head>
  <title>Collect Feedback And Email It To Yourself</title>
  <meta name="author" value="www.blazonry.com">
  <meta name="copyright" value="(c) 2000 Astonish Inc.">
  
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
<body bgcolor="#FFFFFF">
<table width="775" height="402" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="656" valign="top"><table width="775" height="470" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="774" height="47" align="left" valign="top"><? include "includetop.php"; ?></td>
      </tr>
      <tr>
        <td><table width="771" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="23" valign="top">&nbsp;</td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="75%" class="intheading"><img src="images/arrow.gif" width="14" height="14"> Career Planing Demo</td>
                <td width="8%"><div align="right"><a href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                <td width="17%" class="bodytext"><div align="right"><a  class="print" href="javascript:print()">Print 
                  this page</a></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="204" align="left" valign="top"><span style="border-right : 1px solid #759FBA;border-left : 1px solid #759FBA">
              <? include "includeleft.php";?>
            </span></td>
            <td width="494" valign="top"><h2>&nbsp;</h2>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="77%" class="welcome">Enter Your Personal Information</td>
                        <td width="20%" class="welcome"><div align="center"></div></td>
                        <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                      </tr>
                  </table></td>
                  <td width="2%"><img src="images/changep_right_cor.jpg"></td>
                </tr>
              </table>
              <h2>
                <?php 
// if submitted form process and send mail
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

	// just to be safe I strip out HTML tags
	
	$email = strip_tags($email);
	

	// set the variables
	// replace $me@mysite.com with your email address
	$sendto = $_POST['email']; // this is the email address collected form the form
	$message = "Thank you for your time, we will get back to you soon";

	// send the email
	mail($sendto, $subject, $message);

  }
?>
                <!-- ***  START HTML FORM -->
                          </h2>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" METHOD="POST">
                <table cellpadding="4" cellspacing="0" border="0">
                  <tr>
                    <td><b>Name: </b></td>
                    <td><input type="text" name="realname" size="25"></td>
                  </tr>
                  <tr>
                    <td><b>Email:</b></td>
                    <td><input type="text" name="email" size="25"></td>
                  </tr>
                  <tr>
                    <td colspan=2><b>Feedback:</b><br />
                        <textarea name="feedback" rows="4" cols="40" wrap="physical"></textarea>                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right"><input type="submit" value="Send Feedback"></td>
                  </tr>
                </table>
              </form>
              <!-- *** END HTML FORM -->
              <?php ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="44" align="left" valign="top"><? include "includebottom.php";?></td>
      </tr>
    </table></td>
  </tr>
</table>
<h2>&nbsp;</h2>

</body>
</html>
