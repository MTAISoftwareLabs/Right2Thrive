<?php 
ob_start();
include_once "dbConnection.php";
?>




<html>
<head>
<title>CareerPaths Online :: New Learner Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">

<script language="JavaScript">
function validation()
{

   var regExp1 = /^[0-9 -]+$/;
    var x = document.frmpersonal.contact_email.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
	
	if(document.frmpersonal.contact_name.value=='')
	{
		alert("Enter Your Name");
		document.frmpersonal.contact_name.focus();
		return false;
	}
	
	if (!regExp1.test(document.frmpersonal.contact_phone.value))
	{
		alert("Invalid Phone Number....Please Enter Only Numbers");
		document.frmpersonal.contact_phone.focus();
		return false;
	}
	
	
	if (!filter.test(x))
	{
		alert("Enter a valid E-mail address!");
		document.frmpersonal.contact_email.value="";
		document.frmpersonal.contact_email.focus();
		return false;
	}
	
	
	
	return true;
	
}
function winfocus()
{
	//document.frmpersonal.TXusername.focus();
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

<body bgcolor="#ffffff" leftmargin="0" topmargin="0" onLoad="winfocus()">

<table width="775" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="Untitled" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  <tr><td colspan="4">
  <? include "includetop.php"; ?>
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
                                    <td width="75%" class="intheading"><img src="images/arrow.gif" width="14" height="14"> Creating an Effective CV Demo</td>
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
 <form name="frmpersonal" action="mailsend2.php" method="post"   onSubmit="return validation();">
 <input type="hidden" name="hsubmit" value="">
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
                              <td width="20%" class="welcome"><div align="center"></div></td>
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
                               <td width="30%" height="30" class="bodytext">&nbsp;Name</td>
                              <td width="70%" colspan="2" class="bodytext">&nbsp;<input name="contact_name" type="text" class="textbox" size="30">
                                <font color="#FF0000">*&nbsp;</font></td>
                            </tr>
                            <tr>
                              <td height="30" class="bodytext">&nbsp;Organisation/ Company</td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="contact_company" type="text" class="textbox" size="30"></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Address</td>
                              <td colspan="2">&nbsp;<textarea name="contact_adress" class="textbox" cols="30"></textarea>
                                          </td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Postcode</td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="contact_postcode" type="text" class="textbox" maxlength="8" size="10"></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Telephone</td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="contact_phone" type="text" class="textbox" maxlength="12" size="20">
                                <font color="#FF0000">*&nbsp;</font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;E-mail </td>
                              <td colspan="2" class="bodytext">&nbsp;<input name="contact_email" type="text" class="textbox" size="30"> 
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
	<td>
		<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr> 
			<td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
			<td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"><input type="image" src="images/submit.jpg" name="image1" width="69" height="17" class="mouse"></div></td>
			<td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
		</tr>
			</table>

	
		</td>
        </tr>
		</form>
        
      </table></td>
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
