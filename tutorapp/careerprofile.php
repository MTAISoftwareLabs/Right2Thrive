<?
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
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
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

<body><br />
<br />
<table width="912" border="0" align="center" cellpadding="0"  height="384" cellspacing="0">
  <tr>
    <td height="2" colspan="3" bgcolor="#000000"></td>
  </tr>
  <tr>
    <td width="2" rowspan="2" bgcolor="#000000"></td>
    <td width="910" height="380" align="center" valign="top">
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
<li ><a href="lms/index.php">My account</a></li>
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
            <td width="203" height="111" align="left" valign="top"><? include "leftpanel.php"; ?></td>
            <td width="18"></td>
            <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td height="23" colspan="2" class="intheading"><div align="justify">
                    <table width="100%" height="23" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td   height="23" colspan="2" class="intheading" ><div align="right" class="t_bottom_border">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="75%" class="intheading"><img src="images/arrow.gif" width="14" height="14" /> Career Profile</td>
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
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                </div></td>
              </tr>
              <tr>
                <td width="46%" height="24" valign="top" class="bodytext">
					<!--	<img src="images/frame1.jpg" width="244" height="232" /> -->
					<img src="images/career_img.png" width="244" height="232" />
				</td>
                <td width="54%" valign="top" ><div align="justify">Hi 
                  Everyone, I am your average 24 year old black female who enjoys 
                  everything that most people my age enjoy such as travelling, 
                  clubbing, shopping and all the other usual stuff. I am currently 
                  completing the final year of my degree in Psychology with 
                  Criminology BSc at Middlesex University. As well as studying 
                  I also work part time in banking. As much as I enjoyed all 
                  of the above there came a point in my life when I felt I just 
                  wanted to do something completely random and something that 
                  involved helping others. I had previously spoken to a friend 
                  whom was doing voluntary work in South Africa organizing AIDS 
                  treatment for children and counselling their families with 
                  an organization that provided community education on the effects 
                  and prevention of AIDS. After our discussion I conducted my 
                  own research such as using internet search engines and enquiring 
                  at university about voluntary work. </div></td>
              </tr>
              <tr>
                <td colspan="2" class="bodytext">&nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="bodytext"><div align="justify">I finally 
                  went with a company named i-to-i who arranges everything for 
                  you such as accommodation and placement.<br />
                            <br />
                  For my placement I went to Nepal for three months and I worked 
                  in a home with children from various groups from newborn-young 
                  adults. The home cares for orphans and children who would 
                  otherwise live in jail with a convicted parent or end up living 
                  in the streets. It is vital that these children are cared 
                  for to keep them out of contact with abuse, drugs and crime. 
                  With the children we would create games, help them with homework 
                  or talk to them about anything that wished to discuss. Duties 
                  also consisted of giving the social workers additional support. 
                  I cannot explain how different these kids are from those in 
                  western societies, they have so little and have experienced 
                  so much yet they have so much love to give and appreciate 
                  the lives they have so much. </div></td>
              </tr>
              <tr>
                <td colspan="2" class="bodytext">&nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="bodytext"><div align="justify">Although 
                  this experience hasn&#8217;t changed me dramatically as a 
                  person I definitely appreciate life much more and have a clearer 
                  vision on the route I would like my life take. After completion 
                  of my degree a Masters in Social work may be considered as 
                  I would like to specialise in that area and help others get 
                  over life obstacles. The people in Nepal has definitely influenced 
                  my career aims.</div></td>
              </tr>
              <tr>
                <td colspan="2" class="bodytext">&nbsp;&nbsp;</td>
              </tr>
              <tr valign="top">
                <td colspan="2" class="bodytext"><div align="justify"> </div>
                    <div align="right">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="54%" class="bodytext"><div align="justify">I 
                            have learnt so much from this experience and would 
                            encourage anyone to volunteer just to help those whom 
                            are need of help at voluntary organisations that deal 
                            with people with mental health issues, disabilities, 
                            the elderly, youth offenders and many more even if 
                            it&#8217;s for a short space of time. If everything 
                            ended for me tomorrow I know I may not have done much 
                            but I made a difference to others lives. I will warn 
                            you though and I really don&#8217;t want to anyone 
                            of but you need a VERY STRONG heart for some forms 
                            of voluntary work especially when it comes to children.<br />
                                            <br />
                            I&#8217;m not going to lie, I enjoy my life and I 
                            definitely have experienced more than most. This is 
                            not out of being born into riches. </div></td>
                          <td width="46%" valign="top"><div align="right"><img src="images/career_img.png" width="244" height="232" /></div></td>
                        </tr>
                      </table>
                    </div></td>
              </tr>
              <tr>
                <td colspan="2" class="bodytext"><div align="justify">I have worked 
                  hard for everything I have. When I was at school(Maths, Science, 
                  Humanities, English language, English Literature, Art, Drama 
                  and Office Studies) and college (Law, English &amp; Psychology) 
                  I didn&#8217;t study as much as I should have and I didn&#8217;t 
                  go to university straight after. I was more interested in 
                  my boyfriend and making money and went to work. There is plenty 
                  of time for relationships and making money when you&#8217;re 
                  older. It took me nearly 4 years to go back into full time 
                  education and it&#8217;s the best thing I have done and it&#8217;s 
                  never too late to go back. Going to university opens up so 
                  many doors and there are so many courses to choose from. For 
                  those who just don&#8217;t know what they want to do, I usually 
                  find looking at what you&#8217;ve experienced yourself as 
                  a person both the positive and negative helps a lot. Usually 
                  the jobs you most relate to are the best ones to go for if 
                  you don&#8217;t know what your career aims are in life. </div></td>
              </tr>
              <tr>
                <td colspan="2" class="bodytext">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="bodytext"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
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
