<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
function fdate($dt)
{
	$datadate = explode("/",$dt);
	$tday = date("Y-m-d", mktime(0,0,0,$datadate[1],$datadate[0],$datadate[2]));
	return $tday;
}
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d/m/Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}
function clean_string($str)
{
	$str = htmlspecialchars(str_replace("\'", "'", trim($str)));
	$str = rtrim($str);	
	$str = str_replace("'", "\'", $str);
	return $str;
}
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php } ?>
<html>
<head>
<title>Add Learner</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
<script src="../include/functions.js" language="JavaScript"></script>
<script src="calendar1.js"></script>
<script language="JavaScript">
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
function changeval()
{
	var selindex = document.FRMLEARNPERSONAL.CBLEARNETHENTICITY.value;
	if (selindex == "Other")	
	{
		document.getElementById('eh').style.visibility = "visible";
	}
	else
	{
		document.getElementById('eh').style.visibility = "hidden";	
	}
}
function closewin()
{
	document.location='./';
}
function getselected(cid)
{
	for (i = 0 ; i < document.FRMLEARNPERSONAL.CBLEARNCOUNTRY.length-1;i++)
	{
		if (document.FRMLEARNPERSONAL.CBLEARNCOUNTRY.options[i].value == cid)
		{
			document.FRMLEARNPERSONAL.CBLEARNCOUNTRY.options[i].selected = true;
		}
	}
}
function getselecteth(id)
{
	var f = 0;
	//alert(id)
	for (i = 0 ; i < document.FRMLEARNPERSONAL.CBLEARNETHENTICITY.length-1;i++)
	{
		if (document.FRMLEARNPERSONAL.CBLEARNETHENTICITY.options[i].value == id)
		{
			document.FRMLEARNPERSONAL.CBLEARNETHENTICITY.options[i].selected = true;
			f = 1 ;
		}
	}
	if (f == 0)
	{
		document.FRMLEARNPERSONAL.CBLEARNETHENTICITY.options[i].selected = true;
		document.getElementById('eh').style.visibility = "visible";	
		document.FRMLEARNPERSONAL.TXLEARNETHENTICITY.value = id;
	}
}
function validation()
{
	var iChars = "0123456789!@#$%^&*()+=-[]\\\';,./{}|\":<>?";
	if(document.FRMLEARNPERSONAL.TXLEARNNAME.value=="")
	{	
		alert("Please Enter Name!");
		document.FRMLEARNPERSONAL.TXLEARNNAME.focus();
		return false;
	}
	if(document.FRMLEARNPERSONAL.TXLEARNNAME.value != '')
	{
		for (var i = 0; i < document.FRMLEARNPERSONAL.TXLEARNNAME.value.length; i++) 
		{
			if (iChars.indexOf(document.FRMLEARNPERSONAL.TXLEARNNAME.value.charAt(i)) != -1)
			{
				alert("Please Enter Characters Only In Name.");
				document.FRMLEARNPERSONAL.TXLEARNNAME.focus();
				return false;
			}
		}
	} 
	if(document.FRMLEARNPERSONAL.TXpwd.value=="")
	{	
		alert("Please Enter Password!");
		document.FRMLEARNPERSONAL.TXpwd.focus();
		return false;
	}
	if(document.FRMLEARNPERSONAL.TXpwd.value.length<4)
	{	
		alert("Password must be more than 4 character!");
		document.FRMLEARNPERSONAL.TXpwd.focus();
		return false;
	}
	if(document.FRMLEARNPERSONAL.TXpwd.value.length>16)
	{	
		alert("Password not more than 16 character!");
		document.FRMLEARNPERSONAL.TXpwd.focus();
		return false;
	}
	if(document.FRMLEARNPERSONAL.TXLEARNPOSTCODE.value=="")
	{	
		alert("Please Enter PostCode!");
		document.FRMLEARNPERSONAL.TXLEARNPOSTCODE.focus();
		return false;
	}
	if(document.FRMLEARNPERSONAL.CBLEARNCOUNTRY.value=="0")
	{	
		alert("Please Select Country!");
		document.FRMLEARNPERSONAL.CBLEARNCOUNTRY.focus();
		return false;
	}
	if(document.FRMLEARNPERSONAL.TXLEARNEMAIL.value=="")
	{	
		alert("Please Enter Email!");
		document.FRMLEARNPERSONAL.TXLEARNEMAIL.focus();
		return false;
	}
	var x = document.FRMLEARNPERSONAL.TXLEARNEMAIL.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))
	{
		alert("Please Enter Valid Email!");
		document.FRMLEARNPERSONAL.TXLEARNEMAIL.focus();
		return false;
	}
	var digits = "0123456789 - ";
	var phoneNumberDelimiters = "() ";
	var validWorldPhoneChars = phoneNumberDelimiters + "+" +"-";
	var minDigitsInIPhoneNumber = 6;
	var maxDigitsInIPhoneNumber = 20;
	function isInteger(s)
	{   
	var i;
	for (i = 0; i < s.length; i++)
	{   
		var c = s.charAt(i);
		if (((c < "0") || (c > "9"))) return false;
	}
	return true;
	}
	function stripCharsInBag(s, bag)
	{  
	var i;
	var returnString = "";
	for (i = 0; i < s.length; i++)
	{   
		var c = s.charAt(i);
		if (bag.indexOf(c) == -1) returnString += c;
	}
	return returnString;
	}
	function checkInternationalPhone(strPhone)
	{
		s=stripCharsInBag(strPhone,validWorldPhoneChars);
		return (isInteger(s) && s.length <= maxDigitsInIPhoneNumber);
	}
	if(document.FRMLEARNPERSONAL.TXLEARNTELEPHONE.value !='')
	{
		var  Phone = document.FRMLEARNPERSONAL.TXLEARNTELEPHONE;
		if (checkInternationalPhone(Phone.value)==false)
		{
			alert("Please Enter Only Numeric Value In Telephone Number.");
			Phone.value="";                                               
			Phone.focus();
			return false;
		}
	}
	if(document.FRMLEARNPERSONAL.TXLEARNMOBILE.value !='')
	{
		var  Phone = document.FRMLEARNPERSONAL.TXLEARNMOBILE;
		if (checkInternationalPhone(Phone.value)==false)
		{
			alert("Please Enter Only Numeric Value In Telephone Number.");
			Phone.value="";                                               
			Phone.focus();
			return false;
		}
	}
	if (document.FRMLEARNPERSONAL.CBLEARNETHENTICITY.value == "0")
	{
		alert("Please select Ethnicity.!");
		document.FRMLEARNPERSONAL.TXLEARNMOBILE.focus();
		return false;
	}
	
	if (document.FRMLEARNPERSONAL.CBLEARNETHENTICITY.value == "Other")
	{
		if (document.FRMLEARNPERSONAL.TXLEARNETHENTICITY.value == "")
		{
			alert("Please enter Ethnicity.!");
			document.FRMLEARNPERSONAL.TXLEARNETHENTICITY.focus();
			return false;
		}
	}
	if (document.FRMLEARNPERSONAL.RBLEARNDISABILITY[0].checked == true)
	{
		if (document.FRMLEARNPERSONAL.TXLEARNDISABILITYEXPLAIN.value == "")
		{
			alert("Please enter disibility reason");
			document.FRMLEARNPERSONAL.TXLEARNDISABILITYEXPLAIN.focus();
			return false;
		}
	}
	if(document.FRMLEARNPERSONAL.TXTSCHOOLID.value=="")
	{	
		alert("Please Select School!");
		document.FRMLEARNPERSONAL.TXTSCHOOLID.focus();
		return false;
	}
	return true;
}
function onload()
{
	document.FRMLEARNPERSONAL.TXLEARNNAME.focus();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_GET['next'])){?> onLoad="onload()" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
	<?php
	if (isset($_GET['next']) && isset($_POST['hdn_submit']))
	{
						
								$username = trim($_POST['TXLEARNNAME']);
								$password = trim($_POST['TXpwd']);
								$addres = trim($_POST['TXLEARNADDRESS']);
								$postcode =  trim($_POST['TXLEARNPOSTCODE']);
								$country = trim($_POST['CBLEARNCOUNTRY']);
								$email = trim($_POST['TXLEARNEMAIL']);
								$tele = trim($_POST['TXLEARNTELEPHONE']);
								$mobile = trim($_POST['TXLEARNMOBILE']);
								$bddate = trim($_POST['CBBIRTHYEAR'])."-".trim($_POST['CBBIRTHMONTH'])."-".trim($_POST['CBBIRTHDAY']);
								if ($_POST['CBLEARNETHENTICITY'] == "Other")
								{
									$eth = $_POST['TXLEARNETHENTICITY'];
								}
								else
								{
									$eth = trim($_POST['CBLEARNETHENTICITY']);
								}
								$gender = $_POST['RBLEARNSEX'];
								$qual_ache =addslashes($_POST['TXLEARNQUAACHIVED']);
								$employed = trim($_POST['RBLEARNEMPLOYED']);
								$employedreason =  trim($_POST['TXLEARNEMPLOYEDREASON']);
								$career = addslashes(trim($_POST['TXLEARNCAREER']));
								$qualtillachive = addslashes(trim($_POST['TXLEARNQUALILIKEACHIVE']));
								$skill = addslashes(trim($_POST['TXLEARNSKILL']));
								$hobby = addslashes(trim($_POST['TXLEARNHOBBIES']));
								$yndis = $_POST['RBLEARNDISABILITY'];
								$school_id = addslashes(trim($_POST['TXTSCHOOLID']));
								$school_year= addslashes(trim($_POST['TXTSHOOLYEAR']));
								$class = $_POST['TXTCLASS'];
								if ($yndis == 1)
								{
									$disab = $_POST['TXLEARNDISABILITYEXPLAIN'];
								}
								else
								{
									$disab = "";
								}
								$rgdate =date('Y-m-d');
								$sqlchange = "select vUserEmailId,vUserName,vUserPassword from cpo_usermaster where vUserEmailId='".$email."'";
								$rschange = runquery1($sqlchange);	
								$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
								
								if ($num > 0 )
								{	
									
									$msg = 'Username "'.$username.'" already exists.';
									$fl_g='red';
								}
								else
								{
									//sending mail
									$fromname = "CareerPaths Online";
											$fromaddress = admin_email;
											$toname = $username;
											$toaddress = $email;
											$subject = "Change password for CareerPaths Online.";
											$message ="<html><body><p>Dear ".$username.",</p>";
											$message .= "<p>The Administration have changed Your Password is  '".$password."'</p>";
											$message .= "<p>Warm Regard From,</p>";
											$message .= "<p>CareerPaths Online Team</p></body></html>";
											//echo $message;
											SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
											
											
										 $sqlupdate = "insert into  cpo_usermaster (vUserName ,vUserPassword,vUserAddress, vUserPostCode , vUserCountry ,vUserMobile , vUserPhone ,vUserEmailId,iUserStatus ,TUserQualification ,
										   iUserType  , dUserRegDate , dUserBirthDate ,vUserEthenticity ,iUserGender , iUserEmployed , vUserEmployedReason, TUserCareerOccupation ,TUserAchive , TUserSkills ,   TUserHobbies  ,iUserDisability 
										   ,TUserDisabilityReason ,I_schoolid ,I_schoolyear , V_schoolclass ) values ('".$username."','".$password."','".$addres."','".$postcode."','".$country."','".$mobile."','".$tele."','".$email."','1','".$qual_ache."','2',
										   '".$rgdate."','".$bddate."','".$eth."','".$gender."','".$employed."','".$employedreason."','".$career."','".$qualtillachive."','".$skill."','".$hobby."','".$yndis."','".$disab."','".$school_id."','".$school_year."','".$class."')";
										   	$res = runquery1($sqlupdate);
									$msg = 'Learner "'.$username.'" added successfully.';
								}
		?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Learner Admin</td>
        </tr>
        <tr>
          <td class="graydotline">&nbsp;</td>
        </tr>
        <tr>
          <td height="30px;"></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=learner" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Add</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="viewuser.php" class="greendeactfont">Edit / Delete</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listuser.php" class="greendeactfont">List</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                  <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                      <tr>
                                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td class="toheaderbg" colspan="3">Learner Information</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                </tr>
                                <tr>
                                  <td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1">
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
									 <?php if($fl_g == 'red')
																					{?>
									  <tr>
										<td height="35" align="center"><img src="./images/alert.gif" border="0"></td>
									  </tr>
									  <tr>
										<td  align="center" height="35" class="error"><?php echo $msg; ?></td>
									  </tr>
									  <?php }
																											else
																											{?>
									  <tr>
										<td align="center"><font class="fontblue"><b><?php echo $msg ?></b></font> </td>
									  </tr>
									  <tr>
										<td align="center">&nbsp;</td>
									  </tr>
									  <?php
																					
																					} ?>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="center"><div align="right"><a href="addlearner.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=learner"><img src="images/cancel.gif"  border="0"></a> &nbsp;</div></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <?php } else {?>
     <form name="FRMLEARNPERSONAL" method="post" action="addlearner.php?next=1">	
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Learner Admin</td>
          </tr>
          <tr>
            <td class="graydotline">&nbsp;</td>
          </tr>
          <tr>
            <td height="30px;"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=learner" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Add</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="viewuser.php" class="greendeactfont">Edit / Delete</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listuser.php" class="greendeactfont">List</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                  <tr>
                                    <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                        <tr>
                                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td class="toheaderbg" colspan="3">Add Learner</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                                     
										
										<tr> 
											<td class="bodytext" height="32">&nbsp;&nbsp;Name</td>
											<td class="bodytext">
					<input name="TXLEARNNAME" type="text"  class="textbox" size="30" value=""><font color="#FF0000">&nbsp;* </font></td>
										  </tr>
										  <tr> 
											<td class="bodytext" height="32">&nbsp;&nbsp;Password</td>
											<td class="bodytext">
					<input name="TXpwd" type="password"  class="textbox" size="30" value=""><font color="#FF0000">&nbsp;* </font></td>
										  </tr>
										  <tr> 
											<td class="bodytext" height="32">&nbsp;&nbsp;Address</td>
											<td class="bodytext">
					<textarea name="TXLEARNADDRESS"  class="textbox" cols="30"> </textarea></td>
										  </tr>
										  <tr> 
											<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Postal Code</td>
											<td width="69%" class="bodytext">
					<input name="TXLEARNPOSTCODE" type="text" size="10" class="textbox" maxlength="10"  value=""><font color="#FF0000">&nbsp;* </font></td>
										  </tr>
										  <tr> 
											<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Country</td>
											<td width="69%" class="bodytext"> 
											  <select name="CBLEARNCOUNTRY" class="textbox">
													  <option value="0">Select</option>
					<option value="ARGENTINA">ARGENTINA</option>
														<option value="ARNENIA">ARNENIA</option>
														<option value="ANTIGUA">ANTIGUA</option>
														<option value="AUSTRALIA">AUSTRALIA</option>
														<option value="AUSTIA">AUSTIA</option>
														<option value="BARBADOS">BARBADOS</option>
														<option value="BERMUDA">BERMUDA</option>
														<option value="BOTSWANA">BOTSWANA</option>
														<option value="BRAZIL">BRAZIL</option>
														<option value="CAMBODIA">CAMBODIA</option>
														<option value="CANADA">CANADA</option>
														<option value="CHILE">CHILE</option>
														<option value="CHINA">CHINA</option>
														<option value="COLOMBIA">COLOMBIA</option>
														<option value="CROATIA">CROATIA</option>
														<option value="CYPRUS">CYPRUS</option>
														<option value="CAY ISLANDS">CAY ISLANDS</option>									
														<option value="CZECH REPUBLIC">CZECH REPUBLIC</option>
														<option value="DENMARK">DENMARK</option>
														<option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option>									
														<option value="ECUADOR">ECUADOR</option>
														<option value="EGYPT">EGYPT</option>
														<option value="ESTONIA">ESTONIA</option>
														<option value="FRANCE">FRANCE</option>
														<option value="GERMANY">GERMANY</option>
														<option value="GHANA">GHANA</option>
														<option value="GRENADA">GRENADA</option>
														<option value="GRENADINES">GRENADINES</option>									
														<option value="GUATEMALA">GUATEMALA</option>
														<option value="GUYANA">GUYANA</option>									
														<option value="HAITI">HAITI</option>
														<option value="HUNGARY">HUNGARY</option>
														<option value="ICELAND">ICELAND</option>
														<option value="INDIA">INDIA</option>
														<option value="IRAN">IRAN</option>
														<option value="IRELAND">IRELAND</option>
														<option value="ISRAEL">ISRAEL</option>
														<option value="ITALY">ITALY</option>
														<option value="JORDAN">JORDAN</option>
														<option value="LAOS">LAOS</option>
														<option value="LEBANON">LEBANON</option>
														<option value="LITHUANIA">LITHUANIA</option>
														<option value="LUXEMBOURG">LUXEMBOURG</option>
														<option value="MALAYSIA">MALAYSIA</option>
														<option value="MALTA">MALTA</option>
														<option value="MAXICO">MAXICO</option>
														<option value="NEPAL">NEPAL</option>
														<option value="NETHARLANDS">NETHARLANDS</option>
														<option value="NEW ZEALAND">NEW ZEALAND</option>
														<option value="NIGERIA">NIGERIA</option>
														<option value="NORWAY">NORWAY</option>
														<option value="PAKISTAN">PAKISTAN</option>
														<option value="PALESTIAN">PALESTIAN</option>
														<option value="PORTUGAL">PORTUGAL</option>
														<option value="PUERTO RIKO">PUERTO RIKO</option>
														<option value="ROMANIA">ROMANIA</option>
														<option value="RUSSIA">RUSSIA</option>
														<option value="SERBIA">SERBIA</option>
														<option value="SINGAPORE">SINGAPORE</option>
														<option value="SLOVENIA">SLOVENIA</option>
														<option value="SOUTH AFRICA">SOUTH AFRICA</option>
														<option value="SPAIN">SPAIN</option>
														<option value="SRI LANKA">SRI LANKA</option>
														<option value="ST. VINCENT">ST. VINCENT</option>
														<option value="ST. LUCIA">ST. LUCIA</option>									
														<option value="SWEDEN">SWEDEN</option>
														<option value="SWITZERLAND">SWITZERLAND</option>
														<option value="TAIWAN">TAIWAN</option>
														<option value="TANZANIA">TANZANIA</option>
														<option value="THAILAND">THAILAND</option>
														<option value="TUNISIA">TUNISIA</option>
														<option value="TURKEY">TURKEY</option>
														<option value="UGANDA">UGANDA</option>
														<option value="UK">UK</option>
														<option value="UKRAINE">UKRAINE</option>
														<option value="DSGSFDSF">DSGSFDSF</option>
														<option value="URUGUAY">URUGUAY</option>
														<option value="UZBEKISTAN">UZBEKISTAN</option>
														<option value="UK - NORTHERN IRELAND">UK - NORTHERN IRELAND</option>
														<option value="UK - SCOTLAND">UK - SCOTLAND</option>
														<option value="CALIFORNIA - NORTH">CALIFORNIA - NORTH</option>
														<option value="CALIFORNIA - SOUTH">CALIFORNIA - SOUTH</option>
														<option value="COLORADO">COLORADO</option>
														<option value="CONNECTICUT">CONNECTICUT</option>
														<option value="DAKOTAS">DAKOTAS</option>
														<option value="DELAWARE">DELAWARE</option>
														<option value="DIST. COLUMBIA">DIST. COLUMBIA</option>
														<option value="FLORIDA">FLORIDA</option>
														<option value="GEORGIA">GEORGIA</option>
														<option value="ILLINOIS">ILLINOIS</option>
														<option value="INDIANA">INDIANA</option>
														<option value="KENTUCKY">KENTUCKY</option>
														<option value="NEVADA">NEVADA</option>
														<option value="NEW YORK/NEW JERSEY">NEW YORK/NEW JERSEY</option>
														<option value="NORTH CAROLINA">NORTH CAROLINA</option>
														<option value="OHIO">OHIO</option>
														<option value="OKLAHOMA">OKLAHOMA</option>
														<option value="OREGON">OREGON</option>
														<option value="PENNSYLVANIA">PENNSYLVANIA</option>
														<option value="SOUTH CAROLINA">SOUTH CAROLINA</option>
														<option value="TENNESSEE">TENNESSEE</option>
														<option value="TEXAS">TEXAS</option>
														<option value="UTAH">UTAH</option>
														<option value="VIRGINIA">VIRGINIA</option>
														<option value="WASHINGTON STATE">WASHINGTON STATE</option>
														<option value="WEST VIRGINIA">WEST VIRGINIA</option>
														<option value="WISCONSIN">WISCONSIN</option>
														<option value="ENGLAND/WALES">ENGLAND/WALES</option>
														<option value="NORTHERN IRELAND">NORTHERN IRELAND</option>
														<option value="SCOTLAND">SCOTLAND</option>
														<option value="BRITISH COLUMBIA">BRITISH COLUMBIA</option>
														<option value="ONTARIO">ONTARIO</option>
														<option value="PRAIRIES">PRAIRIES</option>
														<option value="QUEBEC">QUEBEC</option>
														<option value="NEW SOUTH WALES">NEW SOUTH WALES</option>
														<option value="QUEENSLAND">QUEENSLAND</option>
														<option value="TEST COUNTRY">TEST COUNTRY</option>
														<option value="CHINA - BEIJING">CHINA - BEIJING</option>
														<option value="CHINA - HONG KONG">CHINA - HONG KONG</option>
														<option value="INDONESIA">INDONESIA</option>
														<option value="JAPAN">JAPAN</option>
														<option value="KOREA - SOUTH">KOREA - SOUTH</option>
														<option value="PHILIPPINES">PHILIPPINES</option>
														<option value="VIETNAM">VIETNAM</option>
														<option value="QATAR">QATAR</option>
														<option value="SAUDI ARABIA">SAUDI ARABIA</option>
														<option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
													</select>
													<?php $c = $rsdata['vUserCountry']?>
													<script language="JavaScript">getselected('<?php echo $c; ?>');</script>
											  <font color="#FF0000">*</font> &nbsp;</td>
										  </tr>
										   <tr> 
											<td class="bodytext" height="32">&nbsp;&nbsp;Email</td>
											<td class="bodytext">
					<input name="TXLEARNEMAIL" type="text"  class="textbox" size="30" value=""><font color="#FF0000">&nbsp;* </font></td>
										  </tr>
										  <tr> 
											<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Telephone</td>
											<td width="30%" class="bodytext"> 
											  <input name="TXLEARNTELEPHONE" type="text"  size="20" class="textbox" maxlength="12" value="">
											  <font color="#FF0000"></font></td>
										  </tr>
										  <tr> 
											<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Mobile</td>
											<td width="30%"> 
											  <input name="TXLEARNMOBILE" type="text"  class="textbox" maxlength="12" size="20" value="">
											   &nbsp;</td>
										  </tr>
						
										  <tr> 
											<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Date of Birth</td>
											<td width="69%" class="bodytext"> 
							  				<select name="CBBIRTHDAY" class="textbox">
											<?php for($d=01;$d<=31;$d++){?>
												<option value="<?php echo $d ?>" <?php if ($d == $temp[2]) {?> selected <?php }?>><?php echo $d?></option>
											<?php
												}
											?>
											</select>-<select name="CBBIRTHMONTH" class="textbox">
											<?php for($m=01;$m<=12;$m++){?>
												<option value="<?php echo $m ?>" <?php if ($m == $temp[1]) {?> selected <?php }?>><?php echo $m?></option>
											<?php }?>		
											</select>-
											<select name="CBBIRTHYEAR" class="textbox">
											<?php for($i=1960;$i<=date("Y");$i++){?>
												<option value="<?php echo $i ?>" <?php if ($i == $temp[0]) {?> selected <?php }?>><?php echo $i?></option>
											<?php }?>
											</select>&nbsp;[mm-dd-yyyy]
										  </td>
										  &nbsp;
									  </tr>
									  <tr> 
										<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Ethienticity</td>
										<td width="69%" class="bodytext"> 
										  <select name="CBLEARNETHENTICITY" class="textbox" onChange="changeval()">
											<option value="0">Select</option>
											<option value="African">African</option>
											<option value="African Caribbean">African Caribbean</option>
											<option value="Asian">Asian</option>
											<option value="Black British">Black British</option>
											<option value="Chinese">Chinese</option>
											<option value="White European">White European</option>
											<option value="Other">Other</option>
										  </select> <font color="#FF0000">*</font>
										  <input type="text" name="TXLEARNETHENTICITY" class="textbox" id="eh" style="visibility:hidden">
										  <?php
											$e = $rsdata["vUserEthenticity"];
											?>
										  <script language="JavaScript">
												getselecteth('<?php echo $e;?>');
											</script>
											
											
										  &nbsp;</td>
									  </tr>
									  <tr> 
										<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Sex</td>
										<td width="30%" class="bodytext">
				<input name="RBLEARNSEX" type="radio" value="1" <?php if ($rsdata['iUserGender'] == 1) { ?> checked <?php }?>>
												Male <input name="RBLEARNSEX" type="radio" value="0" <?php if ($rsdata['iUserGender'] == 0) { ?> checked <?php }?>>
												Female 
										  &nbsp;</td>
									  </tr>
									  <?php //het school info
									  $sql_scl = "select * from cpo_school order by I_schoolname";
			$res_scl = runquery1($sql_scl) or die('could note execute'.mysqli_error());
			
									  ?>
									  <tr> 
										<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;School</td>
										<td width="30%" class="bodytext">
											<select name="TXTSCHOOLID" class="textbox"  >
												<option value="">Select school</option>
												<?php while($rsschool = mysqli_fetch_array($res_scl)) {?>
												<option value="<?php echo $rsschool["I_schoolid"];?>"><?php echo $rsschool['I_schoolname'];?></option> <?php } ?>
												</select>&nbsp;<font color="#FF0000">&nbsp;* </font></td>
									  </tr>
									  <tr> 
										<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;School Year</td>
										<td width="30%" class="bodytext">
										<select name="TXTSHOOLYEAR" class="textbox"  >
										<option value="">Year</option>
										<?php 
											$yr = date('Y')-100;
											$year = date('Y')+1;
											for ($year;$year>$yr;$year--){?>
											<option value="<?php echo $year;?>" ><?php echo $year;?></option> <?php } ?>
										</select>
										</td>
									</tr>
									<tr> 
									  <td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Class</td>
									  <td width="30%" class="bodytext">
									  <input name="TXTCLASS" type="text" value="" class="textbox">
									  &nbsp;</td>
									</tr>
									  <tr> 
										<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;What qualifications 
										  (if any) do you have?</td>
										<td width="30%" class="bodytext"><textarea name="TXLEARNQUAACHIVED" class="textbox" rows="5" cols="30"></textarea></td>
									  </tr>
									  <tr> 
										<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Are you in 
										  work?</td>
										<td width="30%" class="bodytext">
				<input name="RBLEARNEMPLOYED" type="radio" value="1" <?php if ($rsdata['iUserEmployed'] == 1) {?>checked <?php }?>>
											  Yes
											  <input name="RBLEARNEMPLOYED" type="radio" value="0"<?php if ($rsdata['iUserEmployed'] == 0) {?>checked <?php }?>>
											  No &nbsp;</td>
									  </tr>
									  <tr> 
										<td width="41%" class="bodytext">&nbsp;&nbsp;If yes, what 
										  is your job? OR<br>
										  &nbsp;&nbsp;If no, how long have you been out of work?</td>
										<td width="30%" class="bodytext">
				<textarea name="TXLEARNEMPLOYEDREASON" class="textbox" cols="30" rows="5"></textarea> &nbsp;</td>
									  </tr>
									  <tr> 
										<td width="41%" class="bodytext">&nbsp;&nbsp;What career 
										  interests you?</td>
										<td width="30%" class="bodytext"> 
										  <textarea name="TXLEARNCAREER" class="textbox" cols="30" rows="5"></textarea> &nbsp;</td>
									  </tr>
									  <tr> 
										<td width="41%" class="bodytext">&nbsp;&nbsp;What qualifications 
										  do you want to gain?</td>
										<td width="30%" class="bodytext">
				<textarea name="TXLEARNQUALILIKEACHIVE" class="textbox" cols="30" rows="5"></textarea>&nbsp;</td>
									  </tr>
									  <tr> 
										<td width="41%" class="bodytext">&nbsp;&nbsp;What skills 
										  do you have?</td>
										<td width="30%" class="bodytext">
				<textarea name="TXLEARNSKILL" class="textbox" cols="30"></textarea></td>
									  </tr>
									  <tr> 
										<td width="41%" class="bodytext">&nbsp;&nbsp;What are 
										  your hobbies?</td>
										<td width="30%" class="bodytext"> 
										  <textarea name="TXLEARNHOBBIES" class="textbox" cols="30"></textarea></td>
									  </tr>
									  <tr> 
										<td width="41%" height="32" class="bodytext">&nbsp;&nbsp;Do you have 
										  a disability ?</td>
										<td width="30%" class="bodytext"> 
										  <label>
										<input  type="radio" name="RBLEARNDISABILITY" value="1"  <?php if ($rsdata['iUserDisability'] == 1) {?>checked <?php }?>  onClick="getdisable(this)">
													Yes
											</label>
											  <label> 
													<input  type="radio" name="RBLEARNDISABILITY" value="0"  <?php if ($rsdata['iUserDisability'] == 0) {?>checked <?php }?>  onClick="getdisable(this)" checked>
													No
											</label>&nbsp;</td>
									  </tr>
									  <tr> 
										<td width="41%" class="bodytext">&nbsp;&nbsp;If yes please 
										  explain </td>
										<td width="30%" class="bodytext">
				<textarea name="TXLEARNDISABILITYEXPLAIN" id="1" class="textbox" cols="30" <?php if ($rsdata['iUserDisability'] == 0) {?> disabled <?php }?>><?php echo $rsdata['TUserDisabilityReason']?></textarea>&nbsp;</td>
									  </tr>
									  <tr>
										<td colspan="2">&nbsp;</td>
									  </tr>
									  <tr> 
										<td width="41%" height="32" class="">&nbsp;</td>
										<td width="69%" align="right">
										<input  type="hidden" name="hdn_submit" value="1">
										 <input type="image" name="imgaddarea" src="images/add.gif" alt="Update Student Information" onClick="return validation()" class="mouse">
									  <a href="overview.php?id=learner"><img src="images/cancel.gif" border="0" alt="Cancel"></a> 
										</td>
									  </tr>
								
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="0%"><img src="images/green_left_corn.gif" /></td>
                        <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                        <td width="0%"><img src="images/green_right_corn.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </form>
      <?php }?>
    </td>
  </tr>
</table>
</body>
</html>
