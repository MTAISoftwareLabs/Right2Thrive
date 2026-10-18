<?php
ob_start();
session_start();
require_once('page_redirect.php');
require_once('../classes/CLogin.php'); 
require_once('access.php'); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>eLearning :: Home</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="functions.js"></script>
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function userid_avalilibilty()
{	
	
	var x = document.frmpersonal.txtemailid.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))
	{
		alert("Enter a valid E-mail address!");
		document.frmpersonal.txtemailid.value="";
		document.frmpersonal.txtemailid.focus();
		return false;
	}
	new1=window.open("userid_availability.php?userid="+document.frmpersonal.txtemailid.value,"",'height=200,width=400,scrollbars=yes,top=50 left=150');
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
	if(document.frmpersonal.txtusername.value=="")
	{	
		alert("Please Enter User Name!");
		document.frmpersonal.txtusername.focus();
		return false;
	}
	if(document.frmpersonal.txttelephone.value=="")
	{	
		alert("Please Enter Telephone no.!");
		document.frmpersonal.txttelephone.focus();
		return false;
	}
	if (document.frmpersonal.txttelephone.value != "")
	{
		if (!checknum(document.frmpersonal.txttelephone))
		{
			alert("Characters are not allowed in Phone No");
			document.frmpersonal.txttelephone.focus();
			return false;
		}
	}
	if (document.frmpersonal.txtmobile.value != "")
	{
		if (!checknum(document.frmpersonal.txtmobile))
		{
			alert("Characters are not allowed in Mobile");
			document.frmpersonal.txtmobile.focus();
			return false;
		}
	}
	var x = document.frmpersonal.txtemailid.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))
	{
		alert("Enter a valid E-mail address!");
		document.frmpersonal.txtemailid.value="";
		document.frmpersonal.txtemailid.focus();
		return false;
	}

	if(document.frmpersonal.txtpwd.value=="")
	{	
		alert("Please Enter Password!");
		document.frmpersonal.txtpwd.focus();
		return false;
	}
	if(document.frmpersonal.txtconfirm_pwd.value=="")
	{	
		alert("Please Enter Confirm Password!");
		document.frmpersonal.txtconfirm_pwd.focus();
		return false;
	}
	if(document.frmpersonal.txtpwd.value!=document.frmpersonal.txtconfirm_pwd.value)
	{
		alert("Both Password Must be same!");
		document.frmpersonal.txtpwd.value="";
		document.frmpersonal.txtconfirm_pwd.value="";
		document.frmpersonal.txtpwd.focus();
		return false;
	}
	document.frmpersonal.action="register.php?next=yes";
	document.frmpersonal.submit();
	return true;
}
function validation_qua()
{
	document.frmqua.action="courses.php?insert=yes";
	document.frmqua.submit();
}
function winfocus()
{
	document.frmlogin.txtusername.focus();
}
</script>

</head>
<body topmargin="0">
<?php require_once('../template/header.php'); ?>
<table width="780" border="0" align="center">
  <tr> 
    <td width="25" height="15">&nbsp;</td>
    <td width="144" rowspan="2" class="tableDetail"><div align="center"> 
        <?php require_once('left.php'); ?>
      </div></td>
    <td width="1">&nbsp;</td>
    <td rowspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td>&nbsp;</td>
        </tr>
<? if(isset($_GET['next']))
{
 ?>		
		<tr> 
          <td>
<form name="frmqua" method="post">
<input type="hidden" name="htxtusername" value="<? echo trim($HTTP_POST_VARS['txtusername'])?>">
<input type="hidden" name="htxtaddress" value="<? echo trim($HTTP_POST_VARS['txtaddress'])?>">
<input type="hidden" name="htxtpostcode" value="<? echo trim($HTTP_POST_VARS['txtpostcode'])?>">
<input type="hidden" name="htxtcountry" value="<? echo trim($HTTP_POST_VARS['txtcountry'])?>">
<input type="hidden" name="htxttelephone" value="<? echo trim($HTTP_POST_VARS['txttelephone'])?>">
<input type="hidden" name="htxtmobile" value="<? echo trim($HTTP_POST_VARS['txtmobile'])?>">
<input type="hidden" name="htxtemailid" value="<? echo trim($HTTP_POST_VARS['txtemailid'])?>">	
<input type="hidden" name="htxtpwd" value="<? echo trim($HTTP_POST_VARS['txtpwd'])?>">	
<input type="hidden" name="htxtconfirm_pwd" value="<? echo trim($HTTP_POST_VARS['txtconfirm_pwd'])?>">	
<input type="hidden" name="htxtbdate" value="<? echo trim($HTTP_POST_VARS['txtbdate'])?>">
<input type="hidden" name="hcmbethnicity" value="<? echo trim($HTTP_POST_VARS['cmbethnicity'])?>">
<input type="hidden" name="hrnd" value="<? echo $HTTP_POST_VARS['rnd']?>">

			<table width="550" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="22" background="images/tab2.jpg"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="32%" class="tab"><div align="center">&nbsp;&nbsp;Login</div></td>
                      <td width="39%" class="seltab"><div align="center"><strong>Personal 
                          Information</strong> </div></td>
                      <td width="29%" class="tab"><div align="center">Qualification</div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td bgcolor="EEF9FF" class="forborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td height="18" bgcolor="95D5FF">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="50%" height="30" class="bodytext">&nbsp;Qualification Achieved</td>
                            <td width="50%" class="text2">&nbsp; <textarea name="txtqua_achieved" class="textbox" rows="5" cols="30"></textarea>
                              </td>
                          </tr>
                          <tr> 
                            <td height="30" class="bodytext">&nbsp;Employed</td>
                            <td class="bodytext"><input name="rnde" type="radio" value="1" checked>
                              Yes
                              <input name="rnde" type="radio" value="0">
                              No</td>
                          </tr>
                        
                          <tr> 
                            <td height="40" class="bodytext">&nbsp;If Yes please 
                              explain what Jobs&nbsp;<strong>OR</strong><br>&nbsp;If No how long have you been employed</td>
                            <td class="text2">&nbsp; <textarea name="txtlong_employed" class="textbox" cols="30" rows="5"></textarea></td>
                          </tr>
                          <tr> 
                            <td height="30" class="bodytext">&nbsp;Career Occupation 
                              you would like to enter</td>
                            <td class="text2">&nbsp; <textarea name="txtcareer_ocuu" class="textbox" cols="30" rows="5"></textarea>
                              </td>
                          </tr>
                          <tr> 
                            <td height="30" class="bodytext">&nbsp;Qualification 
                              you would like to achieve</td>
                            <td class="text2">&nbsp; <textarea name="txtqua_likeachieved" class="textbox" cols="30" rows="5"></textarea></td>
                          </tr>
                          <tr> 
                            <td height="30" class="bodytext">&nbsp;Skills that 
                              you may already have:</td>
                            <td class="text2">&nbsp; <textarea name="txtskill_achieved" class="textbox" cols="30"></textarea>
                                <a  onClick="userid_avalilibilty()" class="mouse"></a></td>
                          </tr>
                          <tr> 
                            <td height="30" class="bodytext">&nbsp;Hobbies</td>
                              <td class="text2">&nbsp; <textarea name="txthobbies" class="textbox" cols="30"></textarea> 
                              </td>
                          </tr>
                          <tr> 
                            <td height="30" class="bodytext">&nbsp;Do you have a disbility ?</td>
                            <td class="bodytext"><input name="rnddis" type="radio" value="1" checked>
                              Yes
                              <input name="rnddis" type="radio" value="0">
                              No </td>
                          </tr>
                          <tr> 
                            <td height="30" class="bodytext">&nbsp;If yes please explain </td>
                            <td class="text2">&nbsp; <textarea name="txtdisability" class="textbox" cols="30"></textarea></td>
                          </tr>
                          
                         <tr> 
                              <td height="28" lass="bodytext">&nbsp;</td>
							<td align="right"><img name="image" src="images/next.gif" class="mouse" onClick="validation_qua()">&nbsp;&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></form></td>
        </tr>
<? 
}
else
{
 ?>
        <tr>
          <td>
			<form name="frmpersonal" method="post" action="">
			<table width="550" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="22" background="images/tab1.jpg"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="32%" class="seltab"><div align="center">&nbsp;<strong>&nbsp;Login</strong></div></td>
                      <td width="39%" class="tab"><div align="center">Personal 
                          Information </div></td>
                      <td width="29%" class="tab"><div align="center">Qualification</div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td bgcolor="EEF9FF" class="forborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td height="18" bgcolor="95D5FF">&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="21%" height="30" class="bodytext">&nbsp;User Name</td>
                              <td width="79%" class="text2">&nbsp;<input name="txtusername" type="text" class="textbox" size="30"> 
                                <font color="#FF0000">* </font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Address</td>
                              <td class="text2">&nbsp;<textarea name="txtaddress" class="textbox" cols="30"></textarea></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Postcode</td>
                              <td class="text2">&nbsp;<input name="txtpostcode" type="text" class="textbox" maxlength="8"></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Country</td>
                              <td class="text2">&nbsp;<input name="txtcountry" type="text" class="textbox">
                                <font color="#FF0000">*</font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Telephone</td>
                              <td class="text2">&nbsp;<input name="txttelephone" type="text" class="textbox" maxlength="15"> 
                                <font color="#FF0000">*</font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Mobile</td>
                              <td class="text2">&nbsp;<input name="txtmobile" type="text" class="textbox" maxlength="10"></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;E-mail-Id</td>
                              <td>&nbsp;<input name="txtemailid" type="text" class="textbox" size="30">
                                <font color="#FF0000">*</font><a onClick="userid_avalilibilty()" class="mouse">Click 
                                Here</a>to see if this User-Id is available.</td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Password</td>
                              <td class="text2">&nbsp;<input name="txtpwd" type="password" class="textbox" size="30"> 
                                <font color="#FF0000">*</font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Confirm Password</td>
                              <td class="text2">&nbsp;<input name="txtconfirm_pwd" type="password" class="textbox" size="30"> 
                                <font color="#FF0000">*</font></td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Date of Birth</td>
                              <td class="text2">&nbsp;<input name="txtbdate" type="text" class="textbox" readonly="">
                                <a href="javascript:stage2datetime.popup();"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a></td>
                            </tr>
       <script language="JavaScript">
		var stage2datetime = new calendar1(document.forms['frmpersonal'].elements['txtbdate']);
		stage2datetime.year_scroll = true;
		stage2datetime.time_comp = false;
	</script>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Ethnicity</td>
                            <td class="text2">&nbsp;<select name="cmbethnicity" class="textbox">
							<option value="0">Select</option>
							<option value="African">African</option>
							<option value="African Caribbean">African Caribbean</option>
							<option value="Asian">Asian</option>
							<option value="Black British">Black British</option>
							<option value="Chinese">Chinese</option>
							<option value="White European">White European</option>
							<option value="Other">Other</option>	
							</select>
							</td>
                            </tr>
                            <tr> 
                              <td height="30" class="bodytext">&nbsp;Sex</td>
                              <td class="bodytext">&nbsp; <input name="rnd" type="radio" value="1" checked>
                                Male <input name="rnd" type="radio" value="0">
                                Female </td>
                            </tr>
                            <tr> 
                              <td height="30" colspan="2" class="bodytext" align="right"><img name="image" src="images/next.gif" class="mouse" onClick="validation()">&nbsp;&nbsp;</td>
                            </tr>
                          </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></form></td>
        </tr>
<? } ?>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="4"></td>
  </tr>
</table>
<table width="780" border="0" align="center" bgcolor="#DFEAF2">
  <tr>
    <td><?php include('../template/footer.php'); ?></td>
  </tr>
</table>
</body>
</html>
