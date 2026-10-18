<?php
ob_start();
session_start();
include_once("dbConnection.php");
include "session.php";

if(isset($_GET['id']))

{

	$sql="select * FROM cpo_coursemaster where iCourseId=".cleancode($HTTP_GET_VARS['id']);

	$rID=runquery($sql);

	

	if(isset($rID))

	{

	

		$rs = mysqli_fetch_array($rID);

		$u1=$rs['vCourseName'];

		

		$_SESSION['u']=$u1;

		$u=$_SESSION['u'];

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

<style type="text/css">cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}</style></style>

<script src="js/Lacuna_Regular_400.js" type="text/javascript"></script> 
<script src="js/Aller_400.js" type="text/javascript"></script> 

<script type="text/javascript">
			Cufon.replace('h1', { fontFamily: 'Lacuna Regular' });
			Cufon.replace('h2', { fontFamily: 'Aller' });
			Cufon.replace('h3', { fontFamily: 'Lacuna Regular' });
		</script>

<script type="text/javascript" language="javascript" src="js/loginvalid.js"></script>
<script type="text/javascript" language="javascript">



function openwin1(obj)

{

	new1=window.open("moredesc_course.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');

	return true;

}

function getsubmit(obj)

{

	document.frmcoursedetail.action='coursedetail.php?id='+obj.value;

	document.frmcoursedetail.submit();

}

function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

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
  <div class="content_left_h"><h3><cufon style="width: 112px; height: 22px;" alt="ONLINE COURSES" class="cufon cufon-canvas"><canvas style="width: 138px; height: 29px; top: -4px; left: 0px;" height="29" width="138"></canvas><cufontext>ONLINE COURSES </cufontext></cufon></h3></div>

                    <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">

                    <tr>

                     	<td>

                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr><td height="20">&nbsp;</td></tr>

                                  <tr>

                                    <td  height="20"><img src="images/arrow.gif" width="14" height="14" />&nbsp; Online  Courses </td>

                                    <?

					  	$sql = "select iCourseId,vCourseName from cpo_coursemaster order by iCourseId";

						$rssql = runquery($sql);

						$nos = isset($rssql)? mysqli_num_rows($rssql) :0;

						if($nos > 0)

						{

					  ?>

                                    <form action="" method="post" name="frmcoursedetail" id="frmcoursedetail">

                                      <td class="fontnorm" align="right">Select Course&nbsp;

                                          <select name="selcourse" class="textbox" onchange="getsubmit(this)">

                                            <?

					  	while($result = mysqli_fetch_array($rssql))

						{

							if(isset($_GET['id']) && cleancode($_GET['id'])==$result['iCourseId'])

							{

								?>

                                            <option value="<? echo $result['iCourseId'];?>" selected="selected"><? echo $result['vCourseName'];?></option>

                                            <?

							}

							else

							{

								?>

                                            <option value="<? echo $result['iCourseId'];?>"><? echo $result['vCourseName'];?></option>

                                            <?

							}

						}

					  ?>

                                        </select></td>

                                    </form>

                                    <?

					  }

					  else

					  {?>

                                    <td>&nbsp;</td>

                                    <?

					  }

					  ?>

                                  </tr>

                                  <tr>

                                    <td  height="20">&nbsp;</td>

                                    <td align="right"><a class="links2" href="#min"><u>Minimum 

                                      System Requirements</u><a id="min"></a></td>

                                    <td>&nbsp;</td>

                                  </tr>

                                </table>

                        </td>

           			</tr> 

            		</table>

              		<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">

                	<tr>

                    <td height="20"></td>

                    </tr>

                    <tr> 

                    <td height="22"> <!--blue top header bar-->

                    <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">

                               <tr>

                                  <td width="77%" ><h3>Course  Information</h3></td>
                      </tr>

                      </table>

                    </td> 

                    </tr> <!--end blue header-->

                    <tr>

                    <td> <!--contnent of table-->

                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="forborder">

                          <tr>

                            <td valign="top"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1">

                                <tr>

                                  <td width="70%"><span class="fontgreen_big"><? echo $rs['vCourseName']?></span></td>

                                  <td width="2%" valign="top"><div align="right"><a href="javascript:print();"></a></div></td>

                                  <td width="28%" valign="top" class="fontnorm"><div align="center"><a href="javascript:print();" class="links">Print 

                                  this Page</a>&nbsp;&nbsp;</div></td>

                                </tr>

                                <tr>

                                  <td colspan="3"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="">

                                      <tr>
                                        <td width="22%" height="22" class="fontnorm">Course Date </td>
                                        <td width="2%" height="22" class="fontnorm"><strong>:</strong></td>
                                        <td width="76%" height="22" class="fontnorm"><? echo $rs['startdate'];?></td>
                                      </tr>
                                      <tr>
                                        <td height="22" class="fontnorm">Location</td>
                                        <td height="22" class="fontnorm"><strong>:</strong></td>
                                        <td height="22" class="fontnorm"><? echo $rs['location'];?></td>
                                      </tr>
                                      <tr>
                                        <td height="22" class="fontnorm">Time</td>
                                        <td height="22" class="fontnorm"><strong>:</strong></td>
                                        <td height="22" class="fontnorm"><? echo $rs['starttime'];?></td>
                                      </tr>
                                      <tr>
                                        <td height="22" class="fontnorm">Cost</td>
                                        <td height="22" class="fontnorm"><strong>:</strong></td>
                                        <td height="22" class="fontnorm">&pound; <? echo $rs['fCourseFees'];?></td>
                                      </tr>
                                      <tr>

                                        <td height="22" class="fontgreen" colspan="3"><b>Course  

                                          Summary</b></td>
                                      </tr>

                                      <tr>

                                        <td height="22" colspan="3"><? echo $rs['tCourseDesc'];?></td>
                                      </tr>
                                      <tr>
                                        <td height="22" colspan="3" align="right" class="fontnorm">
										<form name="payform" id="payform" method="post" action="paypal.php">
										<input type="image" src="buy-now-paypal.png" border="0" name="submit" alt="Make payments with PayPal - it’s fast, free and secure!">
										<input type="hidden" name="cost" id="cost" value="<? echo $rs['fCourseFees'];?>" />
										<input type="hidden" name="cname" id="cname" value="<? echo $rs['vCourseName'];?>" />
										</form>										</td>
                                      </tr>


                                     


                                  </table></td>

                                </tr>

                            </table></td>

                          </tr>

                      </table>

                    </td>

                    </tr> <!--end main content-->

                    <tr> <!--blue footer-->

                    <td>

                    

                    </td>

                    </tr><!--end blue footer-->

              		</table>

              		<table width="550" height="25" border="0" align="center" cellpadding="0" cellspacing="0">

                		<tr>

                        <td height="5">&nbsp;

                        </td>

                        </tr>

                        

              		</table>

              		<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">

                	<tr> 

                    <td height="22"> <!--blue top header bar-->

                    <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">

                         <tr>

                                  <td ><h3>System Requirements</h3>                                    </td>
                      </tr>
                      </table>

                    </td> 

                    </tr>	<!--end blue header bar-->

                	<tr> <!--content-->

                    <td>	

                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="forborder">

                    <tr>

                      <td valign="top"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">

                          <tr class="fontnorm">

                            <td>&nbsp;<img src="images/layout_33.jpg" alt="" height="5" width="5" />&nbsp;Multimedia 

                              PC with an 800 MHz Pentium or Higher Processor</td>

                          </tr>

                          <tr class="fontnorm">

                            <td>&nbsp;<img src="images/layout_33.jpg" alt="" height="5" width="5" />&nbsp;Microsoft 

                              Windows 98 or Later</td>

                          </tr>

                          <tr class="fontnorm">

                            <td>&nbsp;<img src="images/layout_33.jpg" alt="" height="5" width="5" />&nbsp;VGA 

                              Display with 16k Colour Support</td>

                          </tr>

                          <tr class="fontnorm">

                            <td>&nbsp;<img src="images/layout_33.jpg" alt="" height="5" width="5" />&nbsp;Soundcard 

                              and Speakers (Recommended)</td>

                          </tr>

                          <tr class="fontnorm">

                            <td>&nbsp;<img src="images/layout_33.jpg" alt="" height="5" width="5" />&nbsp;A 

                              Printer (Recommended)</td>

                          </tr>

                      </table></td>

                    </tr>

                </table>

                    </td>

                    </tr><!--endcontent-->

                    <tr> <!--start footer row-->

                    <td>

                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

                    <tr>

                      <td width="1%" >&nbsp;</td>

                      <td width="96%" ><div align="right"></div></td>

                      <td width="3%"><div align="right"></div></td>

                    </tr>

                </table>

                    </td>

                    </tr><!--end footer row-->

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
<? }

}

?>