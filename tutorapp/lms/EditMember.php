<?
include_once 'dbConnection.php';
if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}


	$sql="select us.I_user_subid,us.I_subjectid,us.V_sublevel,sb.vSubjectName,sb.iSubjectId,um.iUserId, um.vUserName    from cpo_usermaster as um, cpo_user_subject as us, cpo_subjectmaster as sb where us.I_studentid =".$_SESSION['user_id']." and sb.iSubjectId = us.I_subjectid and us.I_tutorid = um.iUserId group by us.I_subjectid";
	$result1=runquery1($sql);
	$count=mysqli_num_rows($result1);
	$page=Ceil($count/page_size);
	if(isset($_GET['curpage']))
	{
		$curpage = $_GET['curpage'];
		if($curpage==0)
		{
			$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		}
		else
		{
		$current=page_size*($curpage);
		$sql.=" order by sb.vSubjectName Limit " .$current. ",".page_size;
		}
	}
	else
	{
		$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		$curpage=0;
	}
	 $rID = runquery1($sql);
	 $num = $rID ? mysqli_num_rows($rID) : 0 ;
	

?>
<html>
<head>
<title><? echo sitename?>Subjects</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript" src="./txteditor.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>


</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<form name="frmex" method="post">
<table width="911" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
 
  <tr>
    <td valign="top" width="25%" bgcolor="#FFFFFF"> 
      <? include "leftpanel.php";?>    </td> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td valign="top"><? include "includewelcome.php";?>        </td>
      </tr>
      <tr>
        <td valign="top" height="30">&nbsp;</td>
      </tr>
      <tr>
        <td><?
					if (isset($_GET['mode']) && $_GET['mode'] == "quali")
					{
						if (isset($_GET['next']))
						{ 
							$qual_ache = trim($_POST['TXLEARNQUAACHIVED']);
							$employed = trim($_POST['RBLEARNEMPLOYED']);
							$employedreason =  trim($_POST['TXLEARNEMPLOYEDREASON']);
							$career = trim($_POST['TXLEARNCAREER']);
							$qualtillachive = trim($_POST['TXLEARNQUALILIKEACHIVE']);
							$skill = trim($_POST['TXLEARNSKILL']);
							$hobby = trim($_POST['TXLEARNHOBBIES']);
							$yndis = $_POST['RBLEARNDISABILITY'];
							if ($yndis == 1)
							{
								$disab = $_POST['TXLEARNDISABILITYEXPLAIN'];
							}
							else
							{
								$disab = "";
							}
							$sqlupdate = "update cpo_usermaster set TUserQualification='".$qual_ache."',TUserAchive='".$qualtillachive."',iUserEmployed=".$employed.",";
							$sqlupdate .= "vUserEmployedReason='".$employedreason."',TUserCareerOccupation='".$career."',TUserSkills='".$skill."',TUserHobbies='".$hobby."',";
							$sqlupdate .= "TUserDisabilityReason='".$disab."',iUserDisability=".$yndis." where iUserId=".$_SESSION['user_id'];
							runquery1($sqlupdate);
							//echo $sqlupdate;
							addlog(3);
							$msg = "Your Qualification details has been updated successfully."
						?>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="welcome">Qualification</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr>
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table class="" width="90%" align="center">
                      <tr>
                        <td width="21%" height="20" class="bodytext" colspan="2" align="center"><b><? echo $msg;?></b></td>
                      </tr>
                      <tr>
                        <td colspan="2" height="15">&nbsp;</td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="closewin()" style="cursor:hand"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
          <? }
						else
						{
					?>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="welcome">Qualification</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr>
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table class="" width="90%" align="center">
                      <?
							$sqledit = "select TUserQualification,TUserAchive,iUserEmployed,vUserEmployedReason,TUserCareerOccupation,TUserSkills,TUserHobbies,iUserDisability,TUserDisabilityReason,I_schoolyear,I_schoolid,V_schoolclass from cpo_usermaster where iUserId=".$_SESSION['user_id'];
							$rsedit = runquery1($sqledit);
							$num = $rsedit ? mysqli_num_rows($rsedit) : 0 ;
							if ($num > 0)
							{
								$rsdata = mysqli_fetch_array($rsedit);
						?>
                      <tr>
                        <td width="50%" height="30" class="bodytext">Qualification Achieved</td>
                        <td width="50%" class="text2">&nbsp;
                            <textarea name="TXLEARNQUAACHIVED" class="textbox" rows="5" cols="30"><? echo $rsdata['TUserQualification']?></textarea>                        </td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">Employed</td>
                        <td class="bodytext"><input name="RBLEARNEMPLOYED" type="radio" value="1" <? if ($rsdata['iUserEmployed'] == 1) {?>checked <? }?>>
                          Yes
                          <input name="RBLEARNEMPLOYED" type="radio" value="0"<? if ($rsdata['iUserEmployed'] == 0) {?>checked <? }?>>
                          No</td>
                      </tr>
                      <tr>
                        <td height="40" class="bodytext">If Yes please 
                          explain what Jobs <strong>OR</strong><br>
                          If No how long have you been employed</td>
                        <td class="text2">&nbsp;
                            <textarea name="TXLEARNEMPLOYEDREASON" class="textbox" cols="30" rows="5"><? echo $rsdata['vUserEmployedReason']?></textarea></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">Career Occupation 
                          you would like to enter</td>
                        <td class="text2">&nbsp;
                            <textarea name="TXLEARNCAREER" class="textbox" cols="30" rows="5"><? echo $rsdata['TUserCareerOccupation']?></textarea>                        </td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">Qualification 
                          you would like to achieve</td>
                        <td class="text2">&nbsp;
                            <textarea name="TXLEARNQUALILIKEACHIVE" class="textbox" cols="30" rows="5"><? echo $rsdata['TUserAchive']?></textarea></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">Skills that 
                          you may already have:</td>
                        <td class="text2">&nbsp;
                            <textarea name="TXLEARNSKILL" class="textbox" cols="30"><? echo $rsdata['TUserSkills']?></textarea>
                          <a  onClick="userid_avalilibilty()" class="mouse"></a></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">Hobbies</td>
                        <td class="text2">&nbsp;
                            <textarea name="TXLEARNHOBBIES" class="textbox" cols="30"><? echo $rsdata['TUserHobbies']?></textarea>                        </td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">Do you have a disability?</td>
                        <td class="bodytext"><label>
                          <input  type="radio" name="RBLEARNDISABILITY" value="1"  <? if ($rsdata['iUserDisability'] == 1) {?>checked <? }?>  onClick="getdisable(this)">
                          Yes </label>
                            <label>
                            <input  type="radio" name="RBLEARNDISABILITY" value="0"  <? if ($rsdata['iUserDisability'] == 0) {?>checked <? }?>  onClick="getdisable(this)" checked>
                              No </label>                        </td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">If yes please explain </td>
                        <td class="text2">&nbsp;
                            <textarea name="TXLEARNDISABILITYEXPLAIN" id="1" class="textbox" cols="30" <? if ($rsdata['iUserDisability'] == 0) {?> disabled <? }?>><? echo $rsdata['TUserDisabilityReason']?></textarea></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <?
							}
							?>
                  </table></td>
              </tr>
              <tr>
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
                    <input name="image" type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">
                </div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
          <?
						}				
					}
					if (isset($_GET['mode']) && $_GET['mode'] == "personal")
					{
						if (isset($_GET['next']))
						{ 
							$username = trim($_POST['TXLEARNNAME']);
							$addres = trim($_POST['TXLEARNADDRESS']);
							$postcode =  trim($_POST['TXLEARNPOSTCODE']);
							$country = trim($_POST['CBLEARNCOUNTRY']);
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
//							$temp = explode("/",$bddate);
//							$fdate = date("Y-m-d",mktime(0,0,0,$temp[1],$temp[0],$temp[2]));
							
							$sqlupdate = "update cpo_usermaster set vUserName='".$username."',vUserAddress='".$addres."',vUserPostCode='".$postcode."',";
							$sqlupdate .= "vUserCountry='".$country."',vUserPhone='".$tele."',vUserMobile='".$mobile."',dUserBirthDate='".$bddate."',";
							$sqlupdate .= "vUserEthenticity='".$eth."',iUserGender=".$gender." where iUserId=".$_SESSION['user_id'];
							runquery1($sqlupdate);
							//echo $sqlupdate;
							$_SESSION['user_name'] = $username;
							$msg = "Your Personal Information has been updated successfully.";
							addlog(2);
						?>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="welcome">Personal Information</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr>
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table class="" width="90%" align="center">
                      <tr>
                        <td width="21%" height="15" class="bodytext" colspan="2" align="center"><b><? echo $msg;?></b></td>
                      </tr>
                      <tr>
                        <td height="15" colspan="2">&nbsp;</td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="closewin()" style="cursor:hand"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
          <? }
						else
						{
					?>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="welcome">Personal Information</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr>
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table class="" width="90%" align="center">
                      <tr>
                        <td colspan="2" align="right" class="bodytext">All (<font color="red">*</font>) mark are compulsory fields</td>
                      </tr>
                      <?
							$sqledit = "select vUserName,vUserAddress,vUserPostCode,vUserCountry,vUserPhone,vUserMobile,dUserBirthDate,vUserEthenticity,iUserGender,I_schoolyear,I_schoolid,V_schoolclass  from cpo_usermaster where iUserId=".$_SESSION['user_id'];
							$rsedit = runquery1($sqledit);
							$num = $rsedit ? mysqli_num_rows($rsedit) : 0 ;
							if ($num > 0)
							{
								$rsdata = mysqli_fetch_array($rsedit);
						?>
                      <tr>
                        <td width="21%" height="30" class="bodytext">&nbsp;User Name</td>
                        <td width="79%" class="text2">&nbsp;
                            <input name="TXLEARNNAME" type="text"  class="textbox" size="30" value="<? echo $rsdata['vUserName']?>">
                            <font color="#FF0000">* </font></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Address</td>
                        <td class="text2">&nbsp;
                            <textarea name="TXLEARNADDRESS"  class="textbox" cols="30"> <? echo $rsdata['vUserAddress']?></textarea></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Postcode</td>
                        <td class="text2">&nbsp;
                            <input name="TXLEARNPOSTCODE" type="text" size="10" class="textbox" maxlength="10"  value="<? echo $rsdata['vUserPostCode']?>">
                            <font color="#FF0000">*</font></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Country</td>
                        <td class="text2">&nbsp;
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
                            <? $c = $rsdata['vUserCountry']?>
                            <script language="JavaScript">getselected('<? echo $c; ?>');</script>
                            <font color="#FF0000">*</font></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Telephone</td>
                        <td class="text2">&nbsp;
                            <input name="TXLEARNTELEPHONE" type="text"  size="20" class="textbox" maxlength="12" value="<? echo $rsdata['vUserPhone']?>">                        </td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Mobile</td>
                        <td class="text2">&nbsp;
                            <input name="TXLEARNMOBILE" type="text"  class="textbox" maxlength="12" size="20" value="<? echo $rsdata['vUserMobile']?>"></td>
                      </tr>
                      <?
							$temp = explode("-",$rsdata['dUserBirthDate']);
//							$da = date("d/m/Y",mktime(0,0,0,$temp[1],$temp[2],$temp[0]));
							?>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Date of Birth</td>
                        <td class="bodytext">&nbsp;
                            <select name="CBBIRTHDAY" class="textbox">
                              <?
								for($d=01;$d<=31;$d++)
								{?>
                              <option value="<? echo $d ?>" <? if ($d == $temp[2]) {?> selected <? }?>><? echo $d?></option>
                              <?
								}
								?>
                            </select>
                          -
                          <select name="CBBIRTHMONTH" class="textbox">
                            <?	
for($m=01;$m<=12;$m++)
{
?>
                            <option value="<? echo $m ?>" <? if ($m == $temp[1]) {?> selected <? }?>><? echo $m?></option>
                            <?
}
?>
                          </select>
                          -
                          <select name="CBBIRTHYEAR" class="textbox">
                            <?

for($i=1960;$i<=date("Y");$i++)
{
?>
                            <option value="<? echo $i ?>" <? if ($i == $temp[0]) {?> selected <? }?>><? echo $i?></option>
                            <?
}
?>
                          </select>
                          &nbsp;[mm-dd-yyyy]</td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Ethnicity</td>
                        <td class="text2">&nbsp;
                            <select name="CBLEARNETHENTICITY" class="textbox" onChange="changeval()">
                              <option value="0">Select</option>
                              <option value="African">African</option>
                              <option value="African Caribbean">African Caribbean</option>
                              <option value="Asian">Asian</option>
                              <option value="Black British">Black British</option>
                              <option value="Chinese">Chinese</option>
                              <option value="White European">White European</option>
                              <option value="Other">Other</option>
                            </select>
                            <font color="#FF0000">*</font>
                            <input type="text" name="TXLEARNETHENTICITY" class="textbox" id="eh" style="visibility:hidden">
                            <?
							$e = $rsdata["vUserEthenticity"];
							?>
                            <script language="JavaScript">
								getselecteth('<? echo $e;?>');
							</script>                        </td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Sex</td>
                        <td class="bodytext">&nbsp;
                            <input name="RBLEARNSEX" type="radio" value="1" <? if ($rsdata['iUserGender'] == 1) { ?> checked <? }?>>
                          Male
                          <input name="RBLEARNSEX" type="radio" value="0" <? if ($rsdata['iUserGender'] == 0) { ?> checked <? }?>>
                          Female </td>
                      </tr>
                      <?PHP
							if($rsdata['I_schoolid'] != '')
							{
								$sql_scl = "select * from  cpo_school where I_schoolid =".$rsdata['I_schoolid'];
								$res_scl = runquery1($sql_scl);
								$fet_scl = mysqli_fetch_array($res_scl);
								$school = $fet_scl['I_schoolname'];
							}
							else
							{ $school = '';
							}
							?>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;School </td>
                        <td class="bodytext">&nbsp;
                            <input name="TXLEARNSCHOOL" type="text"  class="textbox" maxlength="12" size="20" value="<? echo $school; ?>" readonly=""></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Year</td>
                        <td class="bodytext">&nbsp;
                            <input name="TXLEARNYEAR" type="text"  class="textbox" maxlength="12" size="20" value="<? echo $rsdata['I_schoolyear']?>" readonly=""></td>
                      </tr>
                      <tr>
                        <td height="30" class="bodytext">&nbsp;Class</td>
                        <td class="bodytext">&nbsp;
                            <input name="TXLEARNCLASS" type="text"  class="textbox" maxlength="12" size="20" value="<? echo $rsdata['V_schoolclass']?>" readonly=""></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <?
							}
							?>
                  </table></td>
              </tr>
              <tr>
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
                    <input name="image" type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">
                </div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
          <?
						}				
					}
					?>        </td>
      </tr>
      <tr>
        <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
      </tr>
    </table>    <p>&nbsp;</p></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
      <? include "includebottom.php";?>
</table>
</form>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
