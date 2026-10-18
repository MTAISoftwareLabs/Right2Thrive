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
</style></style>

<script src="js/Lacuna_Regular_400.js" type="text/javascript"></script> 
<script src="js/Aller_400.js" type="text/javascript"></script> 

<script type="text/javascript">
			Cufon.replace('h1', { fontFamily: 'Lacuna Regular' });
			Cufon.replace('h2', { fontFamily: 'Aller' });
			Cufon.replace('h3', { fontFamily: 'Lacuna Regular' });
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
	<div align="center">
			<img src="images/flash.jpg" width="912" height="188"/>
  </div>


	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
	<div id="content">
	
		<!-- Start Content Left --><!-- End Content Left -->
		  <div id="content_left" class="content">
		<span class="headtext">TRAINING</span>
		<p align="left" style="padding-left:10px"><img width="294" height="100" src="images/training.gif" /><br />
		<br />
		  <strong>Functional  Skills &amp; Vocational Training: </strong><br />
		  Our  functional skills and vocational programmes equip young people with current  employability skills, so that they are ready to compete in the global economy.</p>
		<p align="left" style="padding-left:10px">Career  Paths Online program aims to tackle youth unemployment by enhancing job  preparatory skills required by prospective employers. Our program is entirely  flexible and applicable within the work environment. Functional skills are core  elements of English, Mathematics and ICT that provide individuals with the  skills needed to thrive successfully in life, the community and the work place.</p>
		<p align="left" style="padding-left:10px">Career  Paths Online provides functional skills training in:<br />
		  English-  Available from Entry Level to Level 2<br />
		  Maths-Available  from Entry Level to Level 2<br />
		  ICT  -Available from Entry Level to Level 2</p>
		<p align="left" style="padding-left:10px">Career  Paths Online provides vocational training in Retail:<br />
		  Entrepreneurial  skills,<br />
		  I T,  &amp; E-commerce<br />
		  Health  &amp; Social Care.</p>
		<p align="left" style="padding-left:10px">For  further information email: info@careerpathsonline<br />
		  Tel:  0845 8622360</p>
		<p align="left">&nbsp;</p>
		<!-- Start Content Right --><!-- End Content Right -->
		</div>
		
		<div class="content" id="content_right">
	 	<div class="content_right_h"><h3><cufon style="width: 80px; height: 22px;" alt="LATEST " class="cufon cufon-canvas"><canvas style="width: 106px; height: 29px; top: -4px; left: 0px;" height="29" width="106"></canvas><cufontext>LATEST </cufontext></cufon><cufon style="width: 63px; height: 22px;" alt="NEWS" class="cufon cufon-canvas"><canvas style="width: 80px; height: 29px; top: -4px; left: 0px;" height="29" width="80"></canvas><cufontext>NEWS</cufontext></cufon></h3></div>
		<marquee behavior="scroll" direction="up" scrolldelay="350" onmouseover="this.stop();" onmouseout="this.start();">
		<?php
		$sql = "SELECT * FROM cpo_newsmaster WHERE iStatus = 1 ";
        $rslt = runquery($sql);
		while($row = mysqli_fetch_assoc($rslt))
		{ 
		?>
		<p><strong><?=$row['dNewsDate']?> - <a href="http://careerpathsonline.net/newsdetail.php?id=<?=$row[iNewsID]?>"><?=$row[vNewsTitle]?></a></strong><br>
	     </p>
		<? }
		?>
		</marquee>
<div>

 	   </div>
	  </div>	
  </div>
  <br style="clear: both;">
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