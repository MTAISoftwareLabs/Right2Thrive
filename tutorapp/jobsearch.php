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
</style></style>

<script src="js/Lacuna_Regular_400.js" type="text/javascript"></script> 
<script src="js/Aller_400.js" type="text/javascript"></script> 

<script type="text/javascript">
			Cufon.replace('h1', { fontFamily: 'Lacuna Regular' });
			Cufon.replace('h2', { fontFamily: 'Aller' });
			Cufon.replace('h3', { fontFamily: 'Lacuna Regular' });
		</script>
	<script type="text/javascript" language="javascript" src="js/loginvalid.js"></script>
<script type="text/javascript" language="javascript" src="js/util-functions.js"> 

</script>
<script type="text/javascript" language="javascript" src="js/clear-default-text.js"></script>

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
  <div class="content_left_h"><h3><cufon style="width: 112px; height: 22px;" alt="START YOUR JOB SEARCH" class="cufon cufon-canvas"><canvas style="width: 138px; height: 29px; top: -4px; left: 0px;" height="29" width="138"></canvas>
  <cufontext>START YOUR JOB SEARCH </cufontext></cufon></h3></div>
  <table width="590" border="0" align="center" cellpadding="2" cellspacing="3">
            <tr>
              <td height="10" colspan="3" style="font-size:22px; color:#669900;"></td>
            </tr>
            <form id="searchform" method="post" action="jobsearchres.php">
              <tr>
                <td width="139" height="32"><input name="keyword" type="text" id="keyword" size="20" maxlength="20" value="Keyword" class="cleardefault" />
                </td>
                <td width="133"><!--<input name="location" type="text" id="location" size="20" maxlength="20" value="Location" class="cleardefault" />-->
				<select name="category" class="textbox">
<option value="category">Select Category</option>

<?
$fetch="select * from cpo_categorymaster where iStatus=1";
$result=runquery1($fetch);
$count= $result ? mysqli_num_rows($result) : 0 ;

while($row=mysqli_fetch_array($result))
{
?>
<option value="<? echo $row["iCategoryId"];?>"><? echo $row["vCategoryName"];?></option>
<?
}
?>
</select>
				</td>
                <td width="456"><input type="submit" name="findjobs" id="findjobs" value="Find Jobs" />
                </td>
              </tr>
            </form>
            <tr>
              <td colspan="3"><h3>top sectors &amp; cities</h3></td>
            </tr>
            <tr>
              <td colspan="3" id="joblist">
		
			  <ul>
			  <?
$fetch="select * from cpo_categorymaster where iStatus=1";
$result=runquery1($fetch);
$count= $result ? mysqli_num_rows($result) : 0 ;

while($row=mysqli_fetch_array($result))
{
?>
			  <li> <a href="jobdetails.php?catid=<?=$row["iCategoryId"];?>"><? echo $row["vCategoryName"];?></a>
			  </li>
<?
}
?>
			 
			  </ul>
			 
			</td>
                    
                
            </tr>
            <tr>
              <td height="19" colspan="3">&nbsp;</td>
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

<script type="text/javascript"> Cufon.now(); </script>
<div style="display: none;" id="lbOverlay"></div><div style="display: none;" id="lbCenter"><div id="lbImage"><div style="position: relative;"><a id="lbPrevLink" href="#"></a><a id="lbNextLink" href="#"></a></div></div></div><div style="display: none;" id="lbBottomContainer"><div id="lbBottom"><a id="lbCloseLink" href="#"></a><div id="lbCaption"></div><div id="lbNumber"></div><div style="clear: both;"></div></div></div>
</body>
</html>