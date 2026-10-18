<?php
ob_start();
include_once 'dbConnection.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>careerpathsonline.net</title>
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
<script type="text/javascript">
function openwin1(obj)
{
//	new1=window.open("moredesc_course.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
	document.location = "coursedetail.php?id="+obj;
	return true;
}
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-size: 10pt; color: #4FAFE9; font-family: verdana;}
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

<body><br />
<br />
<table width="912" border="0" align="center" cellpadding="0"  height="860" cellspacing="0">
  <tr>
    <td height="2" colspan="3" bgcolor="#000000"></td>
  </tr>
  <tr>
    <td width="2" rowspan="2" bgcolor="#000000"></td>
    <td width="910" height="858" align="center" valign="top">
    <br />
    <table width="885" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="170">
        <table width="884" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                <tr>
                  <td><? include"header.php"; ?></td>
                </tr>
              </table></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><table width="825" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="823" height="27" align="left" valign="middle">
            <table width="560" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="11"><img src="images/menu_1.png" width="11" height="27" /></td>
                <td background="images/menu_2.png" style="background-repeat:repeat-x;">
                <div id='menu'> 
<ul>
<li ><a href="index.php">Home</a></li>
<li ></li>
 <li ><a href="e-learning.php">About e-learning</a></li> 
<li  ><a href="company.php">Company&nbsp;</a></li>
 <li ><a href="subjects.php">Subjects&nbsp;</a></li> 
<li ><a href="services.php">Services  </a></li> 
<li ><a href="faq.php">FAQ  </a></li> 
<li ><a href="contact.php">Contact</a></li>
</ul> 
</div >                </td>
                <td width="11"><img src="images/menu_3.png" width="11" height="27" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top"><img src="images/line1.png" width="823" height="3" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="20"></td>
      </tr>
      <tr>
        <td width="907"><table width="885" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="203" height="584" align="left" valign="top"><? include "leftpanel.php"; ?></td>
            <td width="18"></td>
            <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="23" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="100%" class="intheading"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td   height="23" colspan="2"  ><div align="left" class="t_bottom_border">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="75%" class="intheading"><img src="images/arrow.gif" width="14" height="14" /> Welcome to Courses</td>
                                    <td width="8%"><div align="right"><a href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0" /></a></div></td>
                                    <td width="17%" class="bodytext"><div align="right"><a  class="print" href="javascript:print()">Print 
                                      this page</a></div></td>
                                  </tr>
                                </table>
                            </div></td>
                            <td class="intheading">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="intheading">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="22"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20" /></td>
                      <td width="96%"    background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="77%" ><span class="welcome">Courses</span></strong></td>
                            <td width="20%" class="welcome"></td>
                            <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                          </tr>
                      </table></td>
                      <td width="2%"><img src="images/changep_right_cor.jpg" /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td ><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forborder">
                    <tr>
                      <td valign="top"><form action="" method="post" name="frm" id="frm">
                          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="DFEAF2">
                            <tr class="blacktxt">
                              <td width="36%" align="center"><strong>&nbsp;Course Name</strong></td>
                              <td width="19%" align="center"><strong>&nbsp;Duration</strong></td>
                              <td width="13%" align="center"><strong>&nbsp;Fees</strong></td>
                              <td width="32%"><strong>&nbsp;Subject</strong></td>
                            </tr>
                            <?
$sql="select * from cpo_coursemaster where iStatus=1 order by iCourseOrder";
	$result=runquery($sql);
	$num = mysqli_num_rows($result);
	$counter=1;	
	if($num > 0)
	{
	while($rslist = mysqli_fetch_array($result))
	{
?>
                            <tr bgcolor="#FFFFFF" class="bodytext">
                              <td height="25" align="left"><a class="midsublink" href="#" onclick="javascript:openwin1(<? echo $rslist['iCourseId'] ?>)"><u><? echo $rslist["vCourseName"]; ?></u></a></td>
                              <td align="center"><? echo $rslist["vCourseDuration"]; ?></td>
                              <td align="right">&pound;&nbsp;<? echo $rslist["fCourseFees"]; ?>&nbsp;&nbsp;</td>
                              <td><?
$sql1="select * from cpo_subjectincourse where iCourseID='".$rslist[0]."'";
$resc=runquery1($sql1);
$rssub=mysqli_fetch_array($resc);
$subjectids = explode(",",$rssub["vSubjectID"]);
$cnt=0;
for ($i=0;$i <= count($subjectids)-1 ;$i++)	
{
	$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$subjectids[$i]."";
	$result2=runquery($sql2);
	$num = $result2 ? mysqli_num_rows($result2) : 0;
	if ($num > 0)
	{
		$name=mysqli_fetch_array($result2);
		if ($i%3 == 0)
		{
		}?>
                                  <? if($cnt!=0)
														echo ",";
													else
														$cnt=1;
																																																																			
												?>
                                  <? echo $name['vSubjectName']?>
                                  <? }
	} ?>
                              </td>
                            </tr>
                            <?
$counter++;
}
}
?>
                          </table>
                      </form></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25" /></td>
                      <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"></div></td>
                      <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25" /></div></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="22"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20" /></td>
                      <td width="96%"    background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="77%" ><span class="welcome">Minimum System Requirements</span></strong></td>
                            <td width="20%" class="welcome"></td>
                            <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                          </tr>
                      </table></td>
                      <td width="2%"><img src="images/changep_right_cor.jpg" /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forborder">
                    <tr>
                      <td valign="top"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                          <tr bgcolor="#FFFFFF" class="bodytext">
                            <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5" />&nbsp;Multimedia PC with an 800 MHz Pentium or Higher Processor</td>
                          </tr>
                          <tr bgcolor="#FFFFFF" class="bodytext">
                            <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5" />&nbsp;Microsoft Windows  98 or Later</td>
                          </tr>
                          <tr bgcolor="#FFFFFF" class="bodytext">
                            <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5" />&nbsp;VGA Display with 16k Colour Support</td>
                          </tr>
                          <tr bgcolor="#FFFFFF" class="bodytext">
                            <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5" />&nbsp;Soundcard and Speakers (Recommended)</td>
                          </tr>
                          <tr bgcolor="#FFFFFF" class="bodytext">
                            <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5" />&nbsp;A Printer (Recommended)</td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25" /></td>
                      <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"></div></td>
                      <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25" /></div></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="2"></td>
      </tr>
     
      <tr>
        <td height="28" align="center" class="board"><? include "footer.php"; ?></td>
      </tr>
    </table></td>
    <td width="2" rowspan="2" bgcolor="#000000"></td>
  </tr>
  <tr>
    <td height="2" bgcolor="#000000"></td>
  </tr>
</table>
</body>
</html>
