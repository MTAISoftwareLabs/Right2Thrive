<?php
ob_start();
session_start();
include_once("dbConnection.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="cufon-active cufon-ready" xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Welcome to CareerPaths Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-1">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Language" content="en"> 
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="imagetoolbar" content="no">
<meta name="Keywords" content="">
<meta name="Description" content="Welcome to CareerPaths Online">
<meta name="robots" content="index,follow"> 
<link type="text/css" rel="stylesheet" media="screen" href="css/newstyle.css"> 
<link rel="shortcut icon" href="" title="Favicon">
<!--[if lt IE 8]>

<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>

<![endif]-->

<script type="text/javascript" language="javascript" src="js/loginvalid.js"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>

<style type="text/css">
cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}
#div1 {	width:375px;
	height:250px;
	background:#F7F7F7;
	padding: 5px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
}
.style2 {color: #FF0000}
.style4 {font-size: 13px}
</style></style>

<script src="js/Lacuna_Regular_400.js" type="text/javascript"></script> 
<script src="js/Aller_400.js" type="text/javascript"></script> 

<script type="text/javascript">
			Cufon.replace('h1', { fontFamily: 'Lacuna Regular' });
			Cufon.replace('h2', { fontFamily: 'Aller' });
			Cufon.replace('h3', { fontFamily: 'Lacuna Regular' });
		</script>
<script type="text/javascript" language="javascript" src="js/loginvalid.js"></script>		
<style type="text/css">
<!--
.style2 {color: #FF0000}
.style4 {font-size: 13px}
-->
</style>
<script type="text/javascript" language="javascript">
function validpostresume()
{

if(document.uploadres.resume_type.value=="")
  {
     alert("please select type");
	 document.uploadres.resume_type.focus();
	 return false;
	
  }
  if(document.uploadres.email.value=="")
  {
     alert("please enter email");
	 document.uploadres.email.focus();
	 return false;
	
  }
  else if(document.uploadres.file.value=="")
  {
    alert("please upload resume");
	document.uploadres.file.focus();
	return false;
	}
  return true;
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

<body>

<!-- Start Wrapper -->
<div id="wrapper">

	<!-- Start Header -->
	<?php include "includes/header.php"; ?>
	<!-- End Header -->
	<div><p></p></div>
	<!--<div align="center">
			<img src="images/featured_bg.gif" width="912" height="300"/>  </div>-->


	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
  <div id="content">
	
		<!-- Start Content Left -->
	  <div id="content_left" class="content">
	   <div>
  <div class="content_left_h"><h3><cufon style="width: 112px; height: 22px;" alt="SEND YOUR CV FOR COMPREHENSIVE ANALYSIS" class="cufon cufon-canvas"><canvas style="width: 138px; height: 29px; top: -4px; left: 0px;" height="29" width="138"></canvas><cufontext>SEND YOUR CV FOR COMPREHENSIVE ANALYSIS </cufontext></cufon></h3></div>

	<form id="uploadres" name="uploadres" method="post" action="upload_paypal.php" onsubmit="return validpostresume();" enctype="multipart/form-data">
          <table width="580" border="0" align="center" style="font-family: Arial, Verdana, sans-serif;font-size: 13px;">
            
            <tr>
              <td height="41" colspan="3" align="left" style="color:#000000"> Start Right Now!  Upload your CV and let our Career Specialists do their utmost to build a CV that will help you stand a better chance of getting an interview.</td>
            </tr>
            <tr>
              <td height="25" colspan="3" align="left" style="color:#000000"><strong>Your CV will take 3-4 working days to be completed</strong></td>
            </tr>
            <tr>
              <td height="25" colspan="3" align="left" style="color:#000000">Fee: &pound;20 &nbsp; &nbsp;     Unemployed: &pound;12 &nbsp; &nbsp;      Student:  &pound;10 </td>
            </tr>
            <?php if($msg!="")
		  {?>
            <tr>
              <td colspan="3" align="center" style="color:#FF0000">You have successfully posted.</td>
            </tr>
            <? } ?>
            <tr>
              <td height="30"><strong>CV Type </strong></td>
              <td><strong>:</strong></td>
              <td><label>
                <select name="resume_type" id="resume_type">
                  <option value="">Select</option>
                  <option value="Unemployed">Unemployed</option>
                  <option value="Student">Student</option>
                </select>
              </label></td>
            </tr>
            <tr>
              <td width="151" height="30"><strong>Email <span class="style2">* </span></strong></td>
              <td width="5"><strong>:</strong></td>
              <td width="734"><label>
                <input name="email" id="email" type="text" size="30" />
              </label></td>
            </tr>
            <tr>
              <td height="41"><strong>Comments/Notes </strong></td>
              <td><strong>:</strong></td>
              <td><textarea autocomplete="off" name="comments" rows="2" cols="29" id="comments">The attached CV will give you detailed information about me.</textarea></td>
            </tr>
            <tr>
              <td height="32"><strong>Upload CV<span class="style2">*</span> </strong></td>
              <td><strong>:</strong></td>
              <td><label>
                <input type="file" name="file" id="file" />
              </label></td>
            </tr>
            <tr>
              <td height="24" align="right"><span class="helptext style4">.</span></td>
              <td align="right">&nbsp;</td>
              <td align="left"><span class="helptext style4">Upload .doc,.docx,.txt,.pdf or .rtf files of up to 1024 KB</span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="image" src="images/upload.png" name="upload" id="upload" />              </td>
            </tr>
          </table>
    </form>
 
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

<script type="text/javascript"> Cufon.now(); </script>
<div style="display: none;" id="lbOverlay"></div><div style="display: none;" id="lbCenter"><div id="lbImage"><div style="position: relative;"><a id="lbPrevLink" href="#"></a><a id="lbNextLink" href="#"></a></div></div></div><div style="display: none;" id="lbBottomContainer"><div id="lbBottom"><a id="lbCloseLink" href="#"></a><div id="lbCaption"></div><div id="lbNumber"></div><div style="clear: both;"></div></div></div>
</body>
</html>