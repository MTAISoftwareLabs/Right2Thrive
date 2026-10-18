<?php
include "dbConnection.php";
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', FALSE); 
header('Pragma: no-cache'); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>CareerPaths Online :: User Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
function openwin()
{
	new1=window.open("help.htm","",'height=400,width=600,scrollbars=yes,top=50 left=150');
}
function checklogin()
{
	var x = document.FRMLOGIN.TXUSERID.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))
	{
		alert("Enter a valid E-mail address!");
		document.FRMLOGIN.TXUSERID.value="";
		document.FRMLOGIN.TXUSERID.focus();
		return false;
	}
	if(document.FRMLOGIN.TXPASSWORD.value=="") 
	{
		alert("Enter a valid Password!");
		document.FRMLOGIN.TXPASSWORD.value="";
		document.FRMLOGIN.TXPASSWORD.focus();
		return false;
	}
	return true;
}
function onload()
{
	document.FRMLOGIN.TXUSERID.focus();
}

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
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" onLoad="MM_preloadImages('images/products_over.jpg','images/services_over.jpg','images/faqs_over.jpg','images/contact_over.jpg','images/company_over.jpg','images/home_over.jpg','images/login_over.jpg');onload()">
<form name="FRMLOGIN" action="user_login.php" method="post" onSubmit="return checklogin()">
<?
$msg = "";
if (isset($_POST['TXUSERID']))
{
  		$sqlchange = "select * from cpo_usermaster where vUserEmailId='".$_POST['TXUSERID']."' and vUserPassword='".$_POST['TXPASSWORD']."' and iUserStatus=1";
		$rschange = runquery($sqlchange);	
		$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
		if ($num > 0 )
		{
			$res=mysqli_fetch_array($rschange);
			session_register('user_id');
			session_register('user_name');
			session_register('email_id');
			session_register('module');
			session_register('log_fill');

			$HTTP_SESSION_VARS['user_id']=$res['iUserId'];
			$HTTP_SESSION_VARS['user_name']=$res['vUserName'];
			$HTTP_SESSION_VARS['email_id']=$_POST['TXUSERID'];
			$HTTP_SESSION_VARS['module']=$res['iUserType'];
			$HTTP_SESSION_VARS['log_fill']=0;
		
			//////	Sending mail	//////////////
			if($res['iUserType']==1)
			{
				$sectionname = "TMS";
			}
			if($res['iUserType']==2)
			{
				$sectionname = "LMS";
			}
			if($res['iUserType']==4)
			{
				$sectionname = "TPM";
			}
			
			$fromname='CareerPaths Online';//$HTTP_SESSION_VARS['user_name'];
			$fromaddress=$HTTP_SESSION_VARS['email_id'];
			$toname='Colin';
			//$toaddress='colin_leeown2000@yahoo.com';
			$toaddress='info@careerpathsonline.net';
			$subject="Member '".$HTTP_SESSION_VARS['user_name']."' has been logged in";
			$message="<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>
				Member <b>'".$HTTP_SESSION_VARS['user_name']."'</b> has been logged in CareerPaths Online at <b>".date('d-m-Y G:i:s')."</b> in <b>".$sectionname."</b> Section.
				";
				SendingMail($fromname,$fromaddress,$fromname,$toaddress, $subject, $message);
				
			//////	Sending mail over	//////////////
							
			if($res['iUserType']==1)
			{
				tutor_counter(1);
			?>
				<script language="JavaScript" type="text/javascript">
				location.replace("tms/index.php");
				</script>
			<?
			}
			if($res['iUserType']==2)
			{
				addlog(1);
				?>
				<script language="JavaScript" type="text/javascript">
				location.replace("lms/index.php");
				</script>
			<?
			}
			if($res['iUserType']==4)
			{
			?>
				<script language="JavaScript" type="text/javascript">
				location.replace("tpm/index.php");
				</script>
			<?
			}
		}
		else
		{  
			$msg = "Invalid User ID or Password";
		}
}
?>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr><td colspan="4">
		  <? include "includetop.php";?>
  </td></tr>
  <tr> 
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA;border-left : 1px solid #759FBA"><? include "includeleft.php";?></td>
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="94%">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td>&nbsp;</td></tr>
				<tr> 
                      <td width="100%" class="intheading"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td   height="23" colspan="2" class="intheading" > 
                              <div align="right" class="t_bottom_border"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="100%" class="intheading"><img src="images/arrow.gif" width="14" height="14" alt=""> 
                                      Welcome to CareerPaths Online</td>
                                  </tr>
                                </table>
                              </div></td>
                            <td class="intheading">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
          <tr> 
            <td width="100%">&nbsp;<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td width="1"><img src="images/changep_left_cor.jpg" width="11" height="20" alt=""></td>
                  <td width="493" background="images/changep_center_cor.jpg"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="49%" class="welcome"> <div align="left"><font color="#FFFFFF">Login</font></div></td>
                        <td width="50%" class="welcome"><div align="right"><strong>::</strong></div></td>
                      </tr>
                    </table></td>
                  <td width="1" background="images/changep_right_cor.jpg">&nbsp;</td>
                </tr>
                <tr> 
                  <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="46%" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td width="2%"><img src="images/login1.jpg" width="8" height="8" alt=""></td>
                              <td width="97%" background="images/login2.jpg"><img src="images/login2.jpg" width="8" height="8" alt=""></td>
                              <td width="1%"><img src="images/login3.jpg" width="8" height="8" alt=""></td>
                            </tr>
                            <tr> 
                              <td background="images/flogin4.jpg">&nbsp;</td>
                              <td bgcolor="E1F3FF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="22" class=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;Already 
                                      a Member?</strong></font></td>
                                  </tr>
                                  <tr> 
                                    <td height="15" valign="top" class="bodytext" style="border-bottom:1px solid #ffffff">&nbsp;Please 
                                      Sign in.</td>
                                  </tr>
                                  <? 							
//								if(isset(cleancode($_GET['flag']))==1)
	//							{
		//							$msg="Invalid User ID or Password";
									//$cnt=1;
								?>
                                  <tr> 
                                    <td class="error"><font color="#FF0000">&nbsp;<? echo $msg;?></font></td>
                                  </tr>
                                  <?
			//					}
						  		
								?>
                                  <tr> 
                                    <td> <table width="100%" border="0" cellspacing="1" cellpadding="0">
                                              <tr> 
                                                <td width="29%" height="35" class="bodytext"><strong>&nbsp;&nbsp;User 
                                                  ID&nbsp;</strong></td>
                                                <td width="71%" height="30">&nbsp;&nbsp; 
                                                  <input type="text" name="TXUSERID" size="20" maxlength="50" class="textbox"></td>
                                              </tr>
                                              <tr> 
                                                <td height="35" class="bodytext"><strong>&nbsp;&nbsp;Password&nbsp;</strong></td>
                                                <td height="30">&nbsp;&nbsp; <input type="password" name="TXPASSWORD" size="20" maxlength="10" class="textbox" value=""> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td>&nbsp;</td>
                                                <td height="35" colspan="2"><div align="right"> 
                                                    <input name="image" type="image" src="images/submitbttn.jpg" width="67" height="17" >
                                                    &nbsp;</div></td>
                                              </tr>
                                              <tr> 
                                                <td height="20" colspan="3" class="bodytext">&nbsp;<a class="sublink" href="forgotpwd.php">Forgot 
                                                  your password?</a></td>
                                              </tr>
                                              <tr> 
                                                <td height="20" colspan="3" class="bodytext">&nbsp;<a class="sublink" href="javascript:openwin();">Having 
                                                  trouble signing in?</a></td>
                                              </tr>
                                              <tr> 
                                                <td height="23" colspan="3">&nbsp;</td>
                                              </tr>
                                            </table></td>
                                  </tr>
                                </table></td>
                              <td background="images/login4.jpg"><img src="images/login4.jpg" width="8" height="8" alt=""></td>
                            </tr>
                            <tr > 
                              <td><img src="images/flogin1.jpg" width="8" height="8" alt=""></td>
                              <td background="images/flogin2.jpg"><img src="images/flogin2.jpg" width="8" height="8" alt=""></td>
                              <td><img src="images/flogin3.jpg" width="8" height="8" alt=""></td>
                            </tr>
                          </table></td>
                        <td width="54%" valign="top"><table width="94%" border="0" align="right" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td width="2%"><img src="images/grey1.jpg" width="9" height="8" alt=""></td>
                              <td width="97%" background="images/fgrey4.jpg"><img src="images/fgrey4.jpg" width="9" height="8" alt=""></td>
                              <td width="1%"><img src="images/grey7.jpg" width="9" height="8" alt=""></td>
                            </tr>
                            <tr> 
                              <td background="images/grey2.jpg">&nbsp;</td>
                              <td height="50" bgcolor="#F9F9F9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="28" style="border-bottom:1px solid #cccccc"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;New 
                                      to Careerpaths Online?</strong></font></td>
                                  </tr>
                                  <tr> 
                                    <td height="26" class="bodytext">&nbsp;To 
                                      get below Benefits Sign Up <font color="#FF0000"><strong>NOW!!</strong></font></td>
                                  </tr>
                                  <tr> 
                                    <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="6%" class="bodytext"><div align="center">o</div></td>
                                          <td width="94%" height="20" class="bodytext">Get E-learning Facility.</td>
                                        </tr>
                                        <tr> 
                                          <td class="bodytext"><div align="center">o</div></td>
                                                <td width="94%" height="20" class="bodytext">Facility 
                                                  of Voice Chat with Skype</td>
                                        </tr>
                                        <tr> 
                                          <td class="bodytext"><div align="center">o</div></td>
                                                <td height="20" class="bodytext">Improve 
                                                  your Job Prospects. </td>
                                        </tr>
                                        <tr> 
                                          <td class="bodytext"><div align="center">o</div></td>
                                          <td width="94%" height="20" class="bodytext">Gain Key Skills to find a Job. 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td valign="top" class="bodytext"><div align="center">o</div></td>
                                          <td height="30" class="bodytext">Instant access to one-2-one online Tutoring and Mentoring Support.
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td valign="top" class="bodytext"><div align="center">o</div></td>
                                          <td width="94%" height="30" class="bodytext">Learn New Skills without the peer pressure in a classroom.
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="bodytext"><div align="center"></div></td>
                                          <td height="30" class="bodytext"><div align="center"><a href="register.php"><img  alt="" src="images/signup.gif" width="99" height="19" border="0"></a></div></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                              <td background="images/fgrey2.jpg" height="10"><img src="images/fgrey2.jpg" width="9" height="8" alt=""></td>
                            </tr>
                            <tr> 
                              <td><img src="images/grey3.jpg" width="9" height="8" alt=""></td>
                              <td background="images/grey4.jpg"><img src="images/grey4.jpg" width="10" height="8" alt=""></td>
                              <td><img src="images/grey5.jpg" width="9" height="8" alt=""></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td width="1" ><img src="images/changebttm_left_cor.jpg" width="11" height="25" alt=""></td>
                  <td width="99%" height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                  <td width="1" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25" alt=""></div></td>
                </tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td>&nbsp;</td></tr>
              </table> </td>
          </tr>
        </table>
			<!-- new -->
			</td>
        </tr>
      </table></td>
   
  </tr>
  <Tr><td colspan="4" >
  <? include "includebottom.php";?></td></Tr>
</table>
</form>
</body>
</html>
