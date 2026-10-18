<?php
ob_start();
include_once 'dbConnection.php';
?>
<html>
<head>
<title>CareerPaths Online :: New Learner Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<style>

</style>
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
function userid_avalilibilty()
{	
	
	var x = document.frmpersonal.TXemailid.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))
	{
		alert("Enter a valid E-mail address!");
		document.frmpersonal.TXemailid.value="";
		document.frmpersonal.TXemailid.focus();
		return false;
	}
	new1=window.open("userid_availability.php?userid="+document.frmpersonal.TXemailid.value,"",'height=200,width=400,scrollbars=yes,top=50 left=150');
	return true;
}
function termswin()
{
	new1=window.open("learning_agreement.php","",'height=550,width=650,scrollbars=yes,top=150 left=150');
	return true;
}
function backpersonal()
{
	document.frmqua.action="register.php?back1=yes";
	document.frmqua.submit();
	return true;
}
function validation()
{
	if(document.frmpersonal.TXuserfname.value=="")
	{	
		alert("Please Enter First Name.");
		document.frmpersonal.TXuserfname.focus();
		return false;
	}
	if(document.frmpersonal.TXuserlname.value=="")
	{	
		alert("Please Enter Last Name.");
		document.frmpersonal.TXuserlname.focus();
		return false;
	}
	if(document.frmpersonal.TXpostcode.value=="")
	{	
		alert("Please Enter PostCode.!");
		document.frmpersonal.TXpostcode.focus();
		return false;
	}
	if(document.frmpersonal.TXtelephone.value==0)
	{	
		alert("Please Enter telephone.!");
		document.frmpersonal.TXtelephone.focus();
		return false;
	}
	if (document.frmpersonal.TXtelephone.value != "")
	{
		if (!checknum(document.frmpersonal.TXtelephone))
		{
			alert("Characters are not allowed in Phone No");
			document.frmpersonal.TXtelephone.focus();
			return false;
		}
	}
	if (document.frmpersonal.TXmobile.value != "")
	{
		if (!checknum(document.frmpersonal.TXmobile))
		{
			alert("Characters are not allowed in Mobile");
			document.frmpersonal.TXmobile.focus();
			return false;
		}
	}
	var x = document.frmpersonal.TXemailid.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))
	{
		alert("Enter a valid E-mail address!");
		document.frmpersonal.TXemailid.value="";
		document.frmpersonal.TXemailid.focus();
		return false;
	}
	document.frmpersonal.action="parent_register.php?next=yes";
	document.frmpersonal.submit();
	return true;
}
function validation_qua()
{
	if (document.frmqua.firstname1.value == "")
	{
		alert("Please Enter First Name.");
		document.frmqua.firstname1.focus();
		return false;
	}
	if (document.frmqua.lastname1.value == "")
	{
		alert("Please Enter Last Name.");
		document.frmqua.lastname1.focus();
		return false;
	}
	if (document.frmqua.age1.value == "")
	{
		alert("Please Enter Age.");
		document.frmqua.age1.focus();
		return false;
	}
	if (document.frmqua.age1.value != "")
	{
		if (!checknum(document.frmqua.age1))
		{
			alert("Characters are not allowed in Age");
			document.frmqua.age1.value = "";
			document.frmqua.age1.focus();
			return false;
		}
	}
	document.frmqua.action="thanks.php?insert=yes";
	document.frmqua.submit();
	return false;
}
function getOthers()
{
	
	//if(document.frmpersonal.CBOethnicity.value=="Other")
	//{
		//document.getElementById("ethnicity").style.display='block';
	//}
	//else
	//{
		//document.getElementById("ethnicity").style.display='none';
	//}
}
function distext()
{
	winfocus();
	//document.getElementById("ethnicity").style.display='none';
}
function getdisable(obj)
{
	if(obj.value == 1)
	{
		document.getElementById(1).disabled=false;
	}
	else
	{
		document.getElementById(1).value="";
		document.getElementById(1).disabled=true;
	}
	
}
function winfocus()
{
	document.frmpersonal.TXuserfname.focus();
}
function winfocus1()
{
	document.frmqua.firstname1.focus();
}
</script>

</head>
<? if(!isset($_GET['next']))
{
?>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" onLoad="distext()">
<?
}
else
{
?>
<body topmargin="0" onLoad="winfocus1()">
<?
}
?>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="Untitled" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  <tr><td colspan="4">
  <? include "includetop.php";?>
  </td></tr>
  <tr> 
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA;border-left : 1px solid #759FBA"><? include "includeleft.php";?></td>
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="94%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td   class="blacktxt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr><td>&nbsp;</td></tr>
					<tr> 
                      <td width="100%" class="intheading"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td   height="23" colspan="2" class="intheading" > 
                              <div align="right" class="t_bottom_border"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="75%" class="intheading"><img src="images/arrow.gif" width="14" height="14"> 
                                      Welcome to New Parent Registration</td>
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
        <? if(isset($_GET['next']))
{
 ?>
 		<form name="frmqua" method="post">
        <tr> 
          <td> 
              <input type="hidden" name="hTXuserfname" value="<? echo trim($HTTP_POST_VARS['TXuserfname'])?>">
              <input type="hidden" name="hTXuserlname" value="<? echo trim($HTTP_POST_VARS['TXuserlname'])?>">
              <input type="hidden" name="hTXaddress" value="<? echo trim($HTTP_POST_VARS['TXaddress'])?>">
              <input type="hidden" name="hTXpostcode" value="<? echo trim($HTTP_POST_VARS['TXpostcode'])?>">
              <input type="hidden" name="hTXtelephone" value="<? echo trim($HTTP_POST_VARS['TXtelephone'])?>">
              <input type="hidden" name="hTXmobile" value="<? echo trim($HTTP_POST_VARS['TXmobile'])?>">
              <input type="hidden" name="hTXemailid" value="<? echo trim($HTTP_POST_VARS['TXemailid'])?>">
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                        <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="77%" class="welcome">Enter Your Pupils' Details</td>
                              <td width="20%" class="welcome"><div align="center"><strong>Step 2 of 3</strong></div></td>
                              <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                            </tr>
                          </table></td>
                        <td width="2%"><img src="images/changep_right_cor.jpg"></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td bgcolor="FFFFFF" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td>
						
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="forborder">
                            <tr><td height="20" colspan="2" class="bodytext" align="right">You must fill in any box that has a red asterisk (<font color="red">*</font>) by it&nbsp;</td></tr>
							<tr><td colspan="2">

								<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2">
									<tr bgcolor="#FFFFFF"> 
									  <td height="30" class="bodytext"><b>First Name</b></td>
									  <td class="bodytext"><b>Last Name</b></td>
									  <td class="bodytext"><b>Age</b></td>									  									  
									</tr>
									<tr bgcolor="#FFFFFF"> 
									  <td height="22" class="bodytext"><input type="text" name="firstname1"> <font color="#FF0000">*</font></td>
									  <td class="bodytext"><input type="text" name="lastname1"> <font color="#FF0000">*</font></td>
									  <td class="bodytext"><input type="text" name="age1" size="5"> <font color="#FF0000">*</font></td>									  									  
									</tr>
									<tr bgcolor="#FFFFFF"> 
									  <td height="22" class="bodytext"><input type="text" name="firstname2"></td>
									  <td class="bodytext"><input type="text" name="lastname2"></td>
									  <td class="bodytext"><input type="text" name="age2" size="5"></td>									  									  
									</tr>
									<tr bgcolor="#FFFFFF"> 
									  <td height="22" class="bodytext"><input type="text" name="firstname3"></td>
									  <td class="bodytext"><input type="text" name="lastname3"></td>
									  <td class="bodytext"><input type="text" name="age3" size="5"></td>									  									  
									</tr>
									<tr bgcolor="#FFFFFF"> 
									  <td height="22" class="bodytext"><input type="text" name="firstname4"></td>
									  <td class="bodytext"><input type="text" name="lastname4"></td>
									  <td class="bodytext"><input type="text" name="age4" size="5"></td>									  									  
									</tr>
									<tr bgcolor="#FFFFFF"> 
									  <td height="22" class="bodytext"><input type="text" name="firstname5"></td>
									  <td class="bodytext"><input type="text" name="lastname5"></td>
									  <td class="bodytext"><input type="text" name="age5" size="5"></td>									  									  
									</tr>
								</table>

							</td></tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr><td colspan="2">

								<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2">
                                              <tr bgcolor="#FFFFFF"> 
                                                <td height="30" class="bodytext" width="20%"><b>Subject</b></td>
                                                <td width="35%" colspan="2" class="bodytext"><b>Key 
                                                  Stage 1-2 SATs</b></td>
                                                <td class="bodytext" width="25%"><b>Key 
                                                  Stage 3-4 SATs</b></td>
                                                <td class="bodytext" width="10%"><b>Please 
                                                  Tick</b></td>
                                              </tr>
                                              <tr bgcolor="#FFFFFF"> 
                                                <td height="22" class="bodytext">English</td>
                                                <td class="bodytext">Primary School 
                                                  <br>
                                                  (Age 5-11)</td>
                                                <td class="bodytext"><div align="center">
                                                    <input type="checkbox" name="chk7">
                                                  </div></td>
                                                <td class="bodytext">Secondary 
                                                  School <br>
                                                  (Age 11-16)</td>
                                                <td class="bodytext"><input type="checkbox" name="chk1"></td>
                                              </tr>
                                              <tr bgcolor="#FFFFFF"> 
                                                <td height="22" class="bodytext">Maths</td>
                                                <td class="bodytext">Primary School 
                                                  <br>
                                                  (Age 5-11)</td>
                                                <td class="bodytext"><div align="center"><input type="checkbox" name="chk8"></div></td>
                                                <td class="bodytext">Secondary 
                                                  School <br>
                                                  (Age 11-16)</td>
                                                <td class="bodytext"><input type="checkbox" name="chk2"></td>
                                              </tr>
                                              <tr bgcolor="#FFFFFF"> 
                                                <td height="22" class="bodytext">Science</td>
                                                <td class="bodytext">Primary School 
                                                  <br>
                                                  (Age 5-11)</td>
                                                <td class="bodytext"><div align="center">
                                                    <input type="checkbox" name="chk9">
                                                  </div></td>
                                                <td class="bodytext">Secondary 
                                                  School <br>
                                                  (Age 11-16)</td>
                                                <td class="bodytext"><input type="checkbox" name="chk3"></td>
                                              </tr>
                                              <tr bgcolor="#FFFFFF"> 
                                                <td height="22" class="bodytext">Media 
                                                  Studies</td>
                                                <td colspan="2" class="bodytext"></td>
                                                <td class="bodytext">Secondary 
                                                  School <br>
                                                  (Age 11-16)</td>
                                                <td class="bodytext"><input type="checkbox" name="chk4"></td>
                                              </tr>
                                              <tr bgcolor="#FFFFFF"> 
                                                <td height="22" class="bodytext">Business 
                                                  Studies</td>
                                                <td colspan="2" class="bodytext"></td>
                                                <td class="bodytext">A Level <br>
                                                  (Age 15-17)</td>
                                                <td class="bodytext"><input type="checkbox" name="chk5"></td>
                                              </tr>
                                              <tr bgcolor="#FFFFFF"> 
                                                <td height="30" class="bodytext">Career 
                                                  Planning</td>
                                                <td colspan="2" class="bodytext">OCR 
                                                  "Career Planning" Qualification, 
                                                  which has a GCSE equivalent 
                                                  of grades F-A.</td>
                                                <td class="bodytext">Work Related 
                                                  Learning</td>
                                                <td class="bodytext"><input type="checkbox" name="chk6"></td>
                                              </tr>
                                            </table>

							</td></tr>
							
							
                            <tr> 
                              <td colspan="2"></td>
                            </tr>
                            <tr> 
                              <td colspan="2">&nbsp;</td>
                            </tr>
                          </table>
						  
						  
						  </td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </td>
        </tr>
		<tr>
          <td><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr> 
                <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><img name="image" src="images/next.gif" class="mouse" onClick="validation_qua()"></div></td>
                <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td>
        </tr>
		</form>
<? 
}
else
{
 ?><form name="frmpersonal" method="post" action="">
        <tr> 
          <td> 
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                        <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="77%" class="welcome">Enter Your Personal Information</td>
                              <td width="20%" class="welcome"><div align="center"><strong>Step 1 of 3</strong></div></td>
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
                        <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr><td height="20" colspan="3" class="bodytext" align="right">You must fill in any box that has a red asterisk (<font color="red">*</font>) by it&nbsp;</td></tr>
                            <tr> 
                               <td width="30%" height="30" class="bodytext">&nbsp;First Name</td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="TXuserfname" type="text" class="textbox" size="30"> 
                                <font color="#FF0000">* </font></td>
                            </tr>
							<tr> 
                               <td width="30%" height="30" class="bodytext">&nbsp;Last Name</td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="TXuserlname" type="text" class="textbox" size="30"> 
                                <font color="#FF0000">* </font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Address</td>
                              <td colspan="2">&nbsp;<textarea name="TXaddress" class="textbox" cols="30"></textarea></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Postcode</td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="TXpostcode" type="text" class="textbox" maxlength="8" size="10">
                                <font color="#FF0000">*</font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Telephone</td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="TXtelephone" type="text" class="textbox" maxlength="12" size="20" onKeyPress="onlynum(event)"> <font color="#FF0000">*</font> 
                                </td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Mobile</td>
                              <td colspan="2">&nbsp;<input name="TXmobile" type="text" class="textbox" maxlength="12" size="20"></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;E-mail address</td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="TXemailid" type="text" class="textbox" size="30"> 
                                <font color="#FF0000">*&nbsp;</font></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </td>
        </tr>
        <tr> 
          <td><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr> 
                <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><img name="image" src="images/next.gif" class="mouse" onClick="validation()"></div></td>
                <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td>
        </tr></form>
        <? } ?>
      </table>&nbsp;</td>
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
