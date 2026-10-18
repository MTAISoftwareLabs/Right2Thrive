<?php

ob_start();

include_once 'dbConnection.php';

include "session.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Products: <?php echo $u1;?></title>





<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>



<link href="css/style.css" rel="stylesheet" type="text/css" />



<!--

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

//-->

</script>

<style type="text/css">

<!--
.style2 {
	font-size: 24px;
	font-weight: bold;
	color: #61C448;
}
.style3 {
	font-size: 20px;
	font-weight: bold;
}
.style4 {
	color: #FF0000;
	font-weight: bold;
}

-->

</style>

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

<?php

include('header.php');  

?>

      <tr>

        <td height="622" valign="top">

        	<table width="800" border="0" cellspacing="0" cellpadding="0">

          		<tr>

                  <td width="205" height="200" valign="top" bgcolor="#f5f5f5">

                    <?php include('left.php');?>

                  </td>

                  <td width="580" valign="top">

                    

                    <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">

                    <tr>

                   	  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td height="20" colspan="2" class="fontgreen_big"><p class="style2">Helping you to prepare for GCSE &amp; A- Level Exams </p></td>
                          
                        </tr>
                        <tr>
                          <td  colspan="2"  height="5"></td>
                        </tr>
                        <tr>
                          <td width="49%" height="20" ><img src="image002.jpg" width="269" height="118" border="0" /></td>
                          <td width="51%" align="right" class="fontnorm"><img src="image001.jpg" width="276" height="118" border="0" /></td>
                        </tr>
                        <tr>
                          <td height="20" colspan="2" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="49" colspan="2" align="left" ><p>CareerPaths  Online is an innovative educational programme which aims to help young people  who are not getting the best from their classroom based teaching.</p></td>
                        </tr>
                        <tr>
                          <td height="27" colspan="2" ><p><strong>CareerPaths Online provides tailored lessons and  mentoring via the internet </strong></p></td>
                        </tr>
                        <tr>
                          <td height="108" colspan="2" align="center" ><p align="center"><span class="style3">We provide lessons in:</span><br />
                                <strong>Maths,  Key Stage 4, GCSE &amp; A-Level</strong><br />
                                <strong>English,    Key Stage 4, GCSE &amp; A-Level</strong><br />
                                <strong>Business  Studies GCSE &amp; A-Level</strong><br />
                                <strong>Career  Planning</strong></p></td>
                        </tr>
                        <tr>
                          <td height="54" colspan="2" ><p>We assign  tutors to teach their specialist subject area and who are skilled  at assessing the students' ability and targeting those areas that would most  benefit from support. </p></td>
                        </tr>
                        <tr>
                          <td height="20" colspan="2" > Lessons include working with  past papers from the relevant examination boards, tutors will focus on exam technique, study skills and any areas of the syllabus that require specific support.</td>
                        </tr>
                        <tr>
                          <td height="71" colspan="2" ><p>Another vital  role is for our online mentors is to build and maintain students' confidence,  find out there learning styles and raising their aspirations, thereby enabling  them to realise their full potential. </p></td>
                        </tr>
                        <tr>
                          <td height="70" colspan="2" ><p>The aim of  our educational programmes is to improve student’s grade to gain access to  further education, or a chosen university and also prepare them for employment.  All of our tutors are CRB checked.</p></td>
                        </tr>
                        <tr>
                          <td height="20" colspan="2" ><p><span class="style4">For  Further Information and a Free Online Demonstration</span><br />
                          <strong>E-mail: <a href="mailto:info@careerpathsonline.net">info@careerpathsonline.net</a></strong><br />
                          <strong>Tel: 0845 8622360 <br />
Aboard: +44 0845 8622360 <br /></strong>
                            </p></td>
                        </tr>
                      </table></td>
           			</tr> 
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