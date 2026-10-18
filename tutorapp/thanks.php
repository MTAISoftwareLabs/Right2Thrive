<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";

if(cleancode($_GET['insert'])=='yes')
{
	$fullname = $_POST['hTXuserfname'].' '.$_POST['hTXuserlname'];
	$address = $_POST['hTXaddress'];
	$postcode = $_POST['hTXpostcode'];
	$tele = $_POST['hTXtelephone'];
	$mobile = $_POST['hTXmobile'];
	$email = $_POST['hTXemailid'];
	
	$pupilname1 = $_POST['firstname1'].' '.$_POST['lastname1'];
	$pupilage1 = $_POST['age1'];
	$pupilname2 = $_POST['firstname2'].' '.$_POST['lastname2'];
	$pupilage2 = $_POST['age2'];
	$pupilname3 = $_POST['firstname3'].' '.$_POST['lastname3'];
	$pupilage3 = $_POST['age3'];
	$pupilname4 = $_POST['firstname4'].' '.$_POST['lastname4'];
	$pupilage4 = $_POST['age4'];
	$pupilname5 = $_POST['firstname5'].' '.$_POST['lastname5'];
	$pupilage5 = $_POST['age5'];
	
	$pupchk1 = isset($_POST['chk1'])?"True":"";
	$pupchk2 = isset($_POST['chk2'])?"True":"";
	$pupchk3 = isset($_POST['chk3'])?"True":"";
	$pupchk4 = isset($_POST['chk4'])?"True":"";
	$pupchk5 = isset($_POST['chk5'])?"True":"";
	$pupchk6 = isset($_POST['chk6'])?"True":"";
	$pupchk7 = isset($_POST['chk7'])?"True":"";
	$pupchk8 = isset($_POST['chk8'])?"True":"";
	$pupchk9 = isset($_POST['chk9'])?"True":"";

	/////////////////
	$message="<style type='text/css'>.bodytext{font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 8pt;font-style: normal;color: #000000;}</style>";
	$message.="<table width='95%' border='0' align='center' cellpadding='4' cellspacing='1' bgcolor='DFEAF2'>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='30' class='bodytext' colspan='2'><b>Personal Details</b></td>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Full Name :</b></td><td class='bodytext'>".$fullname."</td></tr>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Address :</b></td><td class='bodytext'>".$address."</td></tr>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Post Code :</b></td><td class='bodytext'>".$postcode."</td></tr>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Telephone :</b></td><td class='bodytext'>".$tele."</td></tr>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Mobile No :</b></td><td class='bodytext'>".$mobile."</td></tr>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Email :</b></td><td class='bodytext'>".$email."</td></tr>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='30' class='bodytext' colspan='2'>&nbsp;</td>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='30' class='bodytext' colspan='2'><b>Pupil Details</b></td>";
	$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Full Name :</b></td><td class='bodytext'>".$pupilname1."&nbsp;&nbsp;<b>Age :</b>".$pupilage1."</td></tr>";
	if(strlen($pupilname2)>1)
	{
		$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Full Name :</b></td><td class='bodytext'>".$pupilname2."&nbsp;&nbsp;<b>Age :</b>".$pupilage2."</td></tr>";		
	}	
	if(strlen($pupilname3)>1)
	{
		$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Full Name :</b></td><td class='bodytext'>".$pupilname3."&nbsp;&nbsp;<b>Age :</b>".$pupilage3."</td></tr>";		
	}	
	if(strlen($pupilname4)>1)
	{
		$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Full Name :</b></td><td class='bodytext'>".$pupilname4."&nbsp;&nbsp;<b>Age :</b>".$pupilage4."</td></tr>";		
	}	
	if(strlen($pupilname5)>1)
	{
		$message.="	<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'><b>Full Name :</b></td><td class='bodytext'>".$pupilname5."&nbsp;&nbsp;<b>Age :</b>".$pupilage5."</td></tr>";		
	}	
		$message.="	<tr bgcolor='#FFFFFF'><td colspan='2'>";

		$message.="		<table width='97%' border='0' align='center' cellpadding='4' cellspacing='1' bgcolor='DFEAF2'>";

		$message.="		<tr bgcolor='#FFFFFF'><td height='30' class='bodytext' width='20%'><b>Subject</b></td><td class='bodytext' width='35%'><b>Key Stage 1-2 SATs</b></td><td class='bodytext' width='25%'><b>Key Stage 3-4 SATs</b></td><td class='bodytext' width='10%'><b>Please Tick</b></td></tr>";
		$message.="		<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'>English</td><td class='bodytext'>Primary School <br>(Age 5-11)</td><td class='bodytext'>".$pupchk6."</td><td class='bodytext'>Secondary School <br>(Age 11-16)</td><td class='bodytext'>".$pupchk1."</td></tr>";
		$message.="		<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'>Maths</td><td class='bodytext'>Primary School <br>(Age 5-11)</td><td class='bodytext'>".$pupchk7."</td><td class='bodytext'>Secondary School <br>(Age 11-16)</td><td class='bodytext'>".$pupchk2."</td></tr>";
		$message.="		<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'>Science</td><td class='bodytext'>Primary School <br>(Age 5-11)</td><td class='bodytext'>".$pupchk8."</td><td class='bodytext'>Secondary School <br>(Age 11-16)</td><td class='bodytext'>".$pupchk3."</td></tr>";
		$message.="		<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'>Media Studies</td><td class='bodytext'></td><td class='bodytext' colspan=2>Secondary School <br>(Age 11-16)</td><td class='bodytext'>".$pupchk4."</td></tr>";
		$message.="		<tr bgcolor='#FFFFFF'><td height='22' class='bodytext'>Business Studies</td><td class='bodytext'></td><td class='bodytext' colspan=2>A Level <br>(Age 15-17)</td><td class='bodytext'>".$pupchk5."</td></tr>";
		$message.="		<tr bgcolor='#FFFFFF'><td height='30' class='bodytext'>Career Planning</td><td class='bodytext' colspan=2>OCR 'Career Planning' Qualification, which has a GCSE equivalent of grades F-A.</td><td class='bodytext'>Work Related Learning</td><td class='bodytext'>".$pupchk6."</td></tr>";

		$message.="		</table>";

		$message.="	</td></tr>";
		$message.="	</table>";

	////////////////
	$subject = "New Registration as Parent at Careerpaths.";
	$toname = "Careerpaths";
	$toaddress = admin_email;
	$fromname = "Administrator of Careerpaths";
	$fromaddress = $email;
	SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
}

?>
<html>
<head>
<title>CareerPaths Online :: Thanks for Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
function valid()
{
	if (document.FRMPERSONAL.TXEMAIL.value == "")
	{
		alert("Please enter your Email ID");
		document.FRMPERSONAL.TXEMAIL.focus();
		return false;
	}
	var x = document.FRMPERSONAL.TXEMAIL.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))
	{
		alert("Enter a valid E-mail address!");
		document.FRMPERSONAL.TXEMAIL.value="";
		document.FRMPERSONAL.TXEMAIL.focus();
		return false;
	}
	document.FRMPERSONAL.method ="post";
	document.FRMPERSONAL.action = "forgotpwd.php?valid=yes";
	document.FRMPERSONAL.submit();
	//return true;
}

function closewin()
{
	document.location="user_login.php";
}
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
//document.FRMPERSONAL.TXEMAIL.focus();-->
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
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" onLoad="">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="Untitled" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  <tr><td colspan="4">
  <? include "includetop.php";?>
  </td></tr>
  <tr> 
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA;border-left : 1px solid #759FBA"><? include "includeleft.php";?></td>
    <td colspan="2" valign="top" align="center" style="border-right : 1px solid #759FBA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
              <tr> 
                <td class="blacktxt">
				<form name="FRMPERSONAL" method="post" action="">
              <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr><td>&nbsp;</td></tr>
				<tr> 
                  <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                        <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="77%" class="welcome">Thanks for Registration</td>
                              <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                            </tr>
                          </table></td>
                        <td width="2%"><img src="images/changep_right_cor.jpg"></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td class="forborder"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td>
						  <table width="85%" border="0" align="center" cellpadding="0" cellspacing="1">
							<tr> 
							  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr><td colspan="3">&nbsp;</td></tr>
								  <tr><td colspan="3">&nbsp;</td></tr>
								  <tr> 
									<td width="100%" class="bodytext" colspan="2">Thank you for sending us your registration form.</td>
								  </tr>
								  <tr><td colspan="3">&nbsp;</td></tr>
								  <tr><td colspan="3">&nbsp;</td></tr>
								  <tr> 
									<td width="100%" class="bodytext" colspan="2">Our tutor will contact you shortly.</td>
								  </tr>
								  <tr><td colspan="3">&nbsp;</td></tr>
								  <tr><td colspan="3">&nbsp;</td></tr>								  
								</table></td>
							</tr>
						  </table>
						  </td>
                      </tr>
                    </table></td>
                </tr>
        <tr> 
          <td><table width="550" border="0" cellspacing="0" cellpadding="0">
             <tr> 
                <td width="2%" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td width="96%" height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                <td width="2%" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td>
        </tr>				
              </table>
            </form>
				</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <Tr><td colspan="4" >
  <? include "includebottom.php";?></td></Tr>
</table>
</body>
</html>
