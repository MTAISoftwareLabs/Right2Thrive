<?php
ob_start();
include_once 'dbConnection.php';
?>
<html>
<head>
<title>CareerPaths Online :: Courses</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script language="JavaScript" src="functions.js"></script>
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function validation()
{
	document.frm.action="courses.php?valid=yes";
	document.frm.submit();
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
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" onLoad="MM_preloadImages('images/products_over.jpg','images/services_over.jpg','images/faqs_over.jpg','images/contact_over.jpg','images/company_over.jpg','images/home_over.jpg','images/login_over.jpg')">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="Untitled" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  <tr><td colspan="4">
  <? include "includetop.php";?>
  </td></tr>
  <tr> 
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA;border-left : 1px solid #759FBA"><? include "includeleft.php";?></td>
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="94%" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			  		<tr>
                      <td>&nbsp;</td>
                    </tr>
					<tr> 
                      <td width="100%" class="intheading"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="23" colspan="2" class="intheading" > 
                              <div align="right" class="t_bottom_border"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="75%" class="intheading"><img src="images/arrow.gif" width="14" height="14"> 
                                      Welcome to New Learner Registration</td>
                                    <td width="8%"><div align="right"><a href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
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
                <td height="10">&nbsp;</td>
                <td colspan="3" nowrap class="intsubheading">&nbsp;</td>
              </tr>
              <?
if (isset($_GET['valid']))
{

	$username=trim($HTTP_POST_VARS['hhTXusername']);
	$address=trim($HTTP_POST_VARS['hhTXaddress']);
	$country=trim($HTTP_POST_VARS['hhCBOcountry']);
	$postcode=trim($HTTP_POST_VARS['hhTXpostcode']);
	$telephone=trim($HTTP_POST_VARS['hhTXtelephone']);
	$mobile=trim($HTTP_POST_VARS['hhTXmobile']);
	$emailid=trim($HTTP_POST_VARS['hhTXemailid']);
	$pwd=trim($HTTP_POST_VARS['hhTXpwd']);
	$bdate1=trim($HTTP_POST_VARS['hhTXbdate1']);
	$bdate2=trim($HTTP_POST_VARS['hhTXbdate2']);
	$bdate3=trim($HTTP_POST_VARS['hhTXbdate3']);
	$bdate=$bdate3."-".$bdate1."-".$bdate2;
	$ethnicity=trim($HTTP_POST_VARS['hhTXethnicity']);
	$gender=$HTTP_POST_VARS['hhrnd'];

	$regdate = date("Y-m-d");
	$qua_achieved=trim($HTTP_POST_VARS['hTXqua_achieved']);
	$rnde=trim($HTTP_POST_VARS['hrnde']);
	$long_employed=trim($HTTP_POST_VARS['hTXlong_employed']);
	$career_ocuu=trim($HTTP_POST_VARS['hTXcareer_ocuu']);
	$qua_likeachieved=trim($HTTP_POST_VARS['hTXqua_likeachieved']);
	$skill_achieved=trim($HTTP_POST_VARS['hTXskill_achieved']);
	$hobbies=trim($HTTP_POST_VARS['hTXhobbies']);
	$rnddis=trim($HTTP_POST_VARS['hrnddis']);
	$disability=trim($HTTP_POST_VARS['hTXdisability']);	

	$sql="select vUserEmailId from cpo_usermaster where vUserEmailId='".$emailid."'";
	$result=runquery($sql);
	if($result)
	{	
		$num = mysqli_num_rows($result);
	}
	else
	{
		$num=0;
	}	
	if($num > 0)
	{
		$msg = "Email-Id Already Exist !!!";
		$flg=0;
	}
	else
	{
	$addsql="insert into cpo_usermaster values ('','".$username."','".$pwd."','".$address."','".$postcode."','".$country."','".$mobile."','".$telephone."','".$emailid."',0,'".$qua_achieved."',2,'".$regdate."','".$bdate."','".$ethnicity."',".$gender.",".$rnde.",'".$long_employed."','".$career_ocuu."','".$qua_likeachieved."','".$skill_achieved."','".$hobbies."',".$rnddis.",'".$disability."')";
	$record1=runquery($addsql);
	$cnt1=$HTTP_POST_VARS['cnt'];
	$select="select max(iUserId) from cpo_usermaster";
	$result=runquery($select);
	if($result)
	{
		$num = mysqli_num_rows($result);
	}
	else
	{
		$num=0;
	}
	if($num >0) 
	{
		$rslist=mysqli_fetch_array($result);
		$userid=$rslist[0];
	}
	else
	{
		$userid=1;
	}
	for($i=1;$i<$cnt1;$i++)
	{
			if(isset($HTTP_POST_VARS['chk'.$i]))
			{
				$coursename= $HTTP_POST_VARS['chk'.$i];
				$addcourse="insert into cpo_usercourse values('',".$userid.",".$coursename.",'','".$regdate."',0,'','')";
				$record=runquery($addcourse);
			}
	}
		if($record1)
		{
			$msg = "Congratulations ! Your account has been registered successfully.";
			session_register('emailid');
    		$HTTP_SESSION_VARS['emailid'] = $emailid;
    		$flg = 1;
			//Sending mail 
			$fromname="Administrator of CareerPaths Online";
			$fromaddress=admin_email;
			$toname=$username;
			$toaddress=$emailid;
			$subject="Member Registration confirmation of CareerPaths Online";
			$message=
			"<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Dear ".$username." ,<?xml:namespace prefix = o ns = 'urn:schemas-microsoft-com:office:office' /><o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Welcome to <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>careerpathsonline.net</SPAN></B>!!! We, congratulate you on your decision to become a member of the Career Path Online – <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>careerpathsonline.net</SPAN></B>!!! <SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Your User Name : <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>".$emailid."</SPAN></B><SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Your Password  : <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>".$pwd."</SPAN></B><SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>				
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Your Profile is currently being screened and checked by the web master of careerpathsonline.net. It will be activated, please visit <a href='www.careerpathsonline.net'>www.careerpathsonline.net</a> to check the status. If the profile / postings is not active, please write to <a href='mailto:webmaster@careerpathsonline.net;'>webmaster@careerpathsonline.net</a><o:p></o:p></SPAN></P>				
				";
				$mailflg=SendingMail($fromname,$fromaddress,$fromname,$toaddress, $subject, $message);
		}
		else
		{
			$msg = "Error in Insert User Name !!!";
			$flg = 0;
		}
	}	

				if($flg == 0)
				{?>
              <tr> 
                <td class="blacktxt"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr> 
                            <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                            <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="77%" class="welcome">Registration Finish</td>
                                  <td width="20%" class="welcome"><div align="center">Step 3 of 3</div></td>
                                  <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                </tr>
                              </table></td>
                            <td width="2%"><img src="images/changep_right_cor.jpg"></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forborder"><tr><td align="center"><? echo $msg; ?></font><br> 
                      <br>If you forget Your Password, Please <a href="forgotpwd.php">Click Here</a></td></tr></table></td>
                    </tr><br>
                  </table></td>
              </tr>
              <tr> 
                <td class="blacktxt"><table width="89%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                      <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><a href="register.php"><img src="images/closebutton.gif" alt="Close" border="0"></a></div></td>
                      <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                    </tr>
                  </table></td>
              </tr>
              <?
				}
				else
				{
			  ?>
              <tr> 
                <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr> 
                            <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                            <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="77%" class="welcome">Registration Finish</td>
                                  <td width="20%" class="welcome"><div align="center">Step 3 of 3</div></td>
                                  <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                </tr>
                              </table></td>
                            <td width="2%"><img src="images/changep_right_cor.jpg"></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forborder"><tr><td align="center"><? echo $msg."<br><br>"; 
					  echo "<font size='1' color='red'>Your Profile is currently being screened and checked by the web master of careerpathsonline.net. It will be activated, please visit www.careerpathsonline.net to check the status. If the profile / postings is not active, please write to webmaster@careerpathsonline.net</font><br><br>";?></td></tr></table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td><table width="89%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                      <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><a href="user_login.php"><img src="images/closebutton.gif" alt="Close" border="0"></a></div></td>
                      <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                    </tr>
                  </table></td>
              </tr>
              <?
		  }
	}
	else
	{
?>
              <tr> 
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                            <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="77%" class="welcome">Choose your courses</td>
                                  <td width="20%" class="welcome"><div align="center">Step 3 of 3</div></td>
                                  <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                </tr>
                              </table></td>
                            <td width="2%"><img src="images/changep_right_cor.jpg"></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>
				<form name="frm" method="post" action="courses.php?valid=yes">
<? 
if(isset($_GET['insert']))
{
?>
<input type="hidden" name="hhTXusername" value="<? echo trim($HTTP_POST_VARS['hTXusername'])?>">
<input type="hidden" name="hhTXaddress" value="<? echo trim($HTTP_POST_VARS['hTXaddress'])?>">
<input type="hidden" name="hhTXpostcode" value="<? echo trim($HTTP_POST_VARS['hTXpostcode'])?>">
<input type="hidden" name="hhCBOcountry" value="<? echo trim($HTTP_POST_VARS['hCBOcountry'])?>">
<input type="hidden" name="hhTXtelephone" value="<? echo trim($HTTP_POST_VARS['hTXtelephone'])?>">
<input type="hidden" name="hhTXmobile" value="<? echo trim($HTTP_POST_VARS['hTXmobile'])?>">
<input type="hidden" name="hhTXemailid" value="<? echo trim($HTTP_POST_VARS['hTXemailid'])?>">	
<input type="hidden" name="hhTXpwd" value="<? echo trim($HTTP_POST_VARS['hTXpwd'])?>">	
<input type="hidden" name="hhTXconfirm_pwd" value="<? echo trim($HTTP_POST_VARS['hTXconfirm_pwd'])?>">	
<input type="hidden" name="hhTXbdate1" value="<? echo trim($HTTP_POST_VARS['hTXbdate1'])?>">
<input type="hidden" name="hhTXbdate2" value="<? echo trim($HTTP_POST_VARS['hTXbdate2'])?>">
<input type="hidden" name="hhTXbdate3" value="<? echo trim($HTTP_POST_VARS['hTXbdate3'])?>">	
<input type="hidden" name="hhTXethnicity" value="<? echo trim($HTTP_POST_VARS['hTXethnicity'])?>">

<input type="hidden" name="hhrnd" value="<? echo $HTTP_POST_VARS['hrnd']?>">
<input type="hidden" name="hTXqua_achieved" value="<? echo trim($HTTP_POST_VARS['TXqua_achieved'])?>">
<input type="hidden" name="hrnde" value="<? echo trim($HTTP_POST_VARS['rnde'])?>">
<input type="hidden" name="hTXlong_employed" value="<? echo trim($HTTP_POST_VARS['TXlong_employed'])?>">
<input type="hidden" name="hTXcareer_ocuu" value="<? echo trim($HTTP_POST_VARS['TXcareer_ocuu'])?>">
<input type="hidden" name="hTXqua_likeachieved" value="<? echo trim($HTTP_POST_VARS['TXqua_likeachieved'])?>">
<input type="hidden" name="hTXskill_achieved" value="<? echo trim($HTTP_POST_VARS['TXskill_achieved'])?>">
<input type="hidden" name="hTXhobbies" value="<? echo trim($HTTP_POST_VARS['TXhobbies'])?>">
<?
if ($HTTP_POST_VARS['rnddis'] == "0")
{
	$disability = "";
}
else
{
	$disability = trim($HTTP_POST_VARS['TXdisability']);
}
?>	
<input type="hidden" name="hrnddis" value="<? echo trim($HTTP_POST_VARS['rnddis'])?>">	
<input type="hidden" name="hTXdisability" value="<? echo $disability?>">	
				<table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="DFEAF2">
                    <tr> 
                      <td width="9%" height="20" class="bodytext" ><strong>&nbsp;Select Course</strong></td>
                      <td width="57%" class="bodytext"><strong>&nbsp;Course Name</strong></td>
	                  <td width="15%" class="bodytext" align="center"><strong>&nbsp;Duration</strong></td>
                              <td width="19%" class="bodytext" align="center"><strong>&nbsp;Fees(Pounds)</strong></td>
                      <!--<td width="8%" class="bodytext"><strong>&nbsp;Status</strong></td>-->
                     
                    </tr>
<?
	$sql="select * from cpo_coursemaster where iStatus=1 order by iCourseOrder";
	$result=runquery($sql);
	if($result)
	{
	$num = mysqli_num_rows($result);
	}
	else
	{
	$num=0;
	}
	$counter=1;	
	if($num > 0)
	{
	while($rslist = mysqli_fetch_array($result))
	{
?>
                    <tr bgcolor="#FFFFFF" class="bodytext"> 
                      <td align="center"><input type="checkbox" id=1 name="chk<? echo $counter;?>" value="<? echo $rslist["iCourseId"]?>"></td>
                      <td height="25" align="left"><? echo $rslist["vCourseName"]; ?></td>
                      <td align="center"><? echo $rslist["vCourseDuration"]; ?></td>
                      <td align="center">&pound;&nbsp;<? echo $rslist["fCourseFees"]; ?></td>
                   </tr>
                    <?
$counter++;
}
}
?>
			<input type="hidden" name="cnt" value="<? echo $counter;?>">
            </table>
			<tr bgcolor="#FFFFFF"><td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><img name="image" src="images/registration_finish.gif" class="mouse" onClick="validation()"></div></td>
                <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td></tr>
			<?
}
}
?>
</form></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td height="22"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                      <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="77%" class="welcome">Minimum System Requirements</strong></td>
                            <td width="20%" class="welcome"></td>
                            <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                          </tr>
                        </table></td>
                      <td width="2%"><img src="images/changep_right_cor.jpg"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forborder">
                    <tr> 
                      <td valign="top">
                          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                            <tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;Multimedia PC with an 800 MHz Pentium or Higher Processor</td>
							</tr>
							<tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;Microsoft Windows  98 or Later</td>
							</tr>
							<tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;VGA Display with 16k Colour Support</td>
							</tr>
							<tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;Soundcard and Speakers (Recommended)</td>
							</tr>
							<tr bgcolor="#FFFFFF" class="bodytext"> 
                              <td>&nbsp;<img src="images/bullet.jpg" alt="" height="5" width="5">&nbsp;A Printer (Recommended)</td>
							</tr>
							</table>		  
					  </td>
					 </tr>
					 </table>
				</td>
              <tr> 
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                      <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"></div></td>
                      <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
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
 <tr><td colspan="4" >
  <? include "includebottom.php";?></td></tr>
</table>
</body>
</html>