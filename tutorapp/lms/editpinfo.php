<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";
if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
?>
<html>
<head>
<title><? echo sitename;?>Edit Learner Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../functions.js"></script>
<script language="JavaScript" src="calendar1.js"></script>
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
	
}function changeval()
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
function validation1()
{
	if (document.FRMLEARNQUALIFICATION.RBLEARNDISABILITY[0].checked == true)
	{
		if (document.FRMLEARNQUALIFICATION.TXLEARNDISABILITYEXPLAIN.value == "")
		{
			alert("Please enter disibility reason");
			document.FRMLEARNQUALIFICATION.TXLEARNDISABILITYEXPLAIN.focus();
			return false;
		}
	}
	
	document.FRMLEARNQUALIFICATION.action="EditMember.php?mode=quali&next=yes";
	document.FRMLEARNQUALIFICATION.submit();
}
function validation()
{
	if(document.FRMLEARNPERSONAL.TXLEARNNAME.value=="")
	{	
		alert("Please Enter Name!");
		document.FRMLEARNPERSONAL.TXLEARNNAME.focus();
		return false;
	}
	
	document.FRMLEARNPERSONAL.action="editpinfo.php?mode=personal&next=yes";
	document.FRMLEARNPERSONAL.submit();
	return true;
}
</script><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color:#DCEEFC;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>

<body >
<pre>&nbsp;</pre>
<table width="900"  cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>


<table width="911" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <th height="672"  align="center"><table width="905" border="0" align="center"  cellpadding="0" cellspacing="0">
      
      <tr>
        <th width="199" rowspan="3" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><? include "leftpanel.php"; ?></th>
      </tr>
      <tr>
        <th colspan="2" align="center" valign="top" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td valign="top"><? include "includewelcome.php";?>            </td>
          </tr>
          <tr>
            <td valign="top" height="30">&nbsp;</td>
          </tr>
          <tr>
            <td><?
					
						if (isset($_GET['next']))
						{ 
							$username = trim($_POST['TXLEARNNAME']);
							$school_id = trim($_POST['TXTSCHOOLID']);
							$school_year = trim($_POST['TXLEARNYEAR']);
							$class = trim($_POST['TXLEARNCLASS']);
							$disability = trim($_POST['TXLEARNDISABILITYEXPLAIN']);
							$bddate = trim($_POST['CBBIRTHYEAR'])."-".trim($_POST['CBBIRTHMONTH'])."-".trim($_POST['CBBIRTHDAY']);
							
							$gender = $_POST['RBLEARNSEX'];
//							$temp = explode("/",$bddate);
//							$fdate = date("Y-m-d",mktime(0,0,0,$temp[1],$temp[0],$temp[2]));
							
							$sqlupdate = "update cpo_usermaster set vUserName='".$username."',dUserBirthDate='".$bddate."',iUserGender=".$gender." ,TUserDisabilityReason ='".$disability."', I_schoolid  ='".$school_id."',I_schoolyear ='".$school_year."',V_schoolclass ='".$class."' where iUserId=".$_SESSION['user_id'];
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
                <form name="FRMLEARNPERSONAL" method="post" onSubmit="return validation();">
                  <?
							$sqledit = "select * from cpo_usermaster where iUserId=".$_SESSION['user_id'];
							$rsedit = runquery1($sqledit);
							$num = $rsedit ? mysqli_num_rows($rsedit) : 0 ;
							if ($num > 0)
							{
								$rsdata = mysqli_fetch_array($rsedit);
								
						?>
                  <table width="693" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
                    <tr>
                      <td width="14"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                      <td width="677" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="welcome"><strong>Personal Information</strong></td>
                            <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                          </tr>
                      </table></td>
                      <td width="12" background="images/changep_right_cor.jpg">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                          <table width="98%" align="center" bgcolor="#FFFFFF" class="">
                            <tr>
                              <td colspan="2" align="right" class="bodytext">All (<font color="red">*</font>) mark are compulsory fields</td>
                            </tr>
                            <?php //het school info
						  $sql_scl = "select * from cpo_school order by I_schoolname";
$res_scl = runquery1($sql_scl) or die('could note execute'.mysqli_error());

						  ?>
                            <tr>
                              <td height="30" class="bodytext" colspan="2"><table width="98%">
                                  <tr>
                                    <td width="18%" height="30" class="bodytext"> Name</td>
                                    <td width="40%" class="text2">&nbsp;
                                        <input name="TXLEARNNAME" type="text"  class="textbox" size="30" value="<? echo $rsdata['vUserName']?>">
                                        <font color="#FF0000">* </font></td>
                                    <td width="18%" height="30" class="bodytext">&nbsp;School </td>
                                    <td width="24%" class="bodytext">&nbsp;
                                        <select name="TXTSCHOOLID" class="textbox"  >
                                          <option value="">Select school</option>
                                          <? while($rsschool = mysqli_fetch_array($res_scl)) {?>
                                          <option value="<? echo $rsschool["I_schoolid"];?>" <?php if($rsdata['I_schoolid'] == $rsschool["I_schoolid"]){?> selected="selected" <? } ?>><?php echo $rsschool['I_schoolname'];?></option>
                                          <? } ?>
                                      </select></td>
                                  </tr>
                                  <?
							$temp = explode("-",$rsdata['dUserBirthDate']);
//							$da = date("d/m/Y",mktime(0,0,0,$temp[1],$temp[2],$temp[0]));
							?>
                                  <tr>
                                    <td width="18%" height="30" class="bodytext" nowrap="nowrap">Age/Date of Birth</td>
                                    <td width="40%" class="bodytext" align="left">&nbsp;&nbsp;
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
                                      <br>
                                      &nbsp;&nbsp;&nbsp;[mm-dd-yyyy] <font color="#FF0000">* </font></td>
                                    <td height="30" class="bodytext">&nbsp;Year </td>
                                    <td class="bodytext">&nbsp;&nbsp;
                                        <input name="TXLEARNYEAR" type="text"  class="textbox" maxlength="12" size="20" value="<? if($rsdata['I_schoolyear'] != '' && $rsdata['I_schoolyear'] !=0){ echo $rsdata['I_schoolyear'];}?>" ></td>
                                  </tr>
                                  <tr>
                                    <td width="18%" height="30" class="bodytext">Sex</td>
                                    <td width="40%" class="bodytext">&nbsp;
                                        <input name="RBLEARNSEX" type="radio" value="1" <? if ($rsdata['iUserGender'] == 1) { ?> checked <? }?>>
                                      Male
                                      <input name="RBLEARNSEX" type="radio" value="0" <? if ($rsdata['iUserGender'] == 0) { ?> checked <? }?>>
                                      Female <font color="#FF0000">* </font></td>
                                    <td height="30" class="bodytext">&nbsp;Class </td>
                                    <td class="bodytext">&nbsp;&nbsp;
                                        <input name="TXLEARNCLASS" type="text"  class="textbox" maxlength="12" size="20" value="<? echo $rsdata['V_schoolclass']?>" ></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td width="" height="30" class="bodytext" colspan="2">Disability/Other Info</td>
                            <tr>
                              <td  colspan="2" height="30" class="bodytext" ><textarea name="TXLEARNDISABILITYEXPLAIN" id="1" class="textbox" cols="30" > <?=$rsdata['TUserDisabilityReason']; ?>
            </textarea></td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="14" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                      <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
                        <input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">
                      </div></td>
                      <td width="12" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                    </tr>
                  </table>
                  <? } ?>
                </form>
              <?
					
					}
					?>            </td>
          </tr>
          <tr>
            <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th colspan="2" align="center" valign="top" scope="col"></th>
      </tr>
     
      <tr>
        <th colspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><div align="center">
          <? include "includebottom.php";?>
        </div></th>
        </tr>
      
      
      
    </table>      
    </th>
  </tr>
</table>
<p class="table">&nbsp;</p>

<map name="Map" id="Map"><area shape="rect" coords="1,1,71,25" href="#" /></map>
<map name="Map2" id="Map2"><area shape="rect" coords="1,1,196,67" href="#" /></map>
<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map></body>
</html>
