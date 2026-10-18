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
?>
<html>
<head>
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
<link href="css.css" rel="stylesheet" type="text/css" />
<title><? echo sitename;?>Disability Policy</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>

<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
 
  <tr> 
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF"> 
      <? include "leftpanel.php";?>
    </td>
    <td rowspan="2" align="right" valign="top"> <div align="left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
          </tr>
          <tr>
            <td width="2%" height="1060" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr> 
                  <td width="2%" valign="top">&nbsp;</td>
                  <td width="96%" height="300" valign="top"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                      <tr> 
                        <td colspan="4" ></td>
                      </tr>
                      <tr> 
                        <td colspan="4" ><img src="images/headings_disabilitypolicy.gif" width="159" height="25"></td>
                      </tr>
                      <tr> 
                        <td colspan="4" ><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr>
                        <td width="70%" align="right" class="personal"  style=" border-top : 1px solid #84D0FF">&nbsp;</td>
                        <td width="16%" class="personal"  style=" border-top : 1px solid #84D0FF"><div align="right"><a  class="print" href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0" align="left">Print 
                            this page</a></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">21K Digital Media Ltd is totally committed to the elimination 
                            of any from of discrimination. We will ensue hat members 
                            of staff; our clients and professional organisations 
                            that access our service are not discriminated against 
                            directly or indirectly because of any disability hey 
                            have or may have had.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" height="5" class="subheading" style="border-bottom : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="50" colspan="4" bgcolor="ECF9FF" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr bgcolor="ECF9FF"> 
                              <td width="95%"  valign="top" class="bodytext"><div align="justify"> 
                                  The elimination of discrimination against disabled 
                                  persons or persons who have had a disability 
                                  are the subjects of disability discrimination 
                                  legislation. This is covered by The Disability 
                                  Discrimination Act 1995. 
                                  <p> </p>
                                </div></td>
                            </tr>
                            <tr bgcolor="ECF9FF"> 
                              <td class="bodytext"><div align="justify"> According 
                                  to the Disability Discrimination Act, a disabled 
                                  person is anyone with &#8220;a physical or mental 
                                  impairment, which has substantial and long-term 
                                  adverse effect upon his or (her) ability to 
                                  carry out normal day -to- day activities. </div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" class="subheading" style="border-bottom : 1px solid #84D0FF;">Discrimination 
                          is deemed to have occurred when:</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="5%" height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td width="95%" height="20" valign="top" class="bodytext"><div align="justify">A 
                                  disabled person is treated less favourably than 
                                  some else; and <br>
                                </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td height="15" valign="top" class="bodytext"><div align="justify">The 
                                  treatment is for a reason relating to the person&#8217;s 
                                  disability; and <br>
                                </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">The 
                                  treatment cannot be justified; and also where</div></td>
                            </tr>
                            <tr> 
                              <td height="20"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                  </tr>
                                </table></td>
                              <td height="15" valign="top" class="bodytext"><div align="justify">There 
                                  is a failure to make reasonable adjustment; 
                                  and </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">That 
                                  failure cannot be justified.</div></td>
                            </tr>
                            <tr> 
                              <td height="15" colspan="2">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td height="15" colspan="2"> <div align="justify" class="bodytext"> 
                                  We will ensure that our recruitment and selection 
                                  policies reflect good practice in relation to 
                                  disability.</div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td height="15" colspan="4" bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF;"><div align="justify"> 
                            Disability discrimination will be covered in the induction 
                            of all staff and training for staff in disability 
                            issues will be offered as appropriate.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify"> 
                            Information resources held in our Information Points 
                            will include those with positive images of people 
                            with disabilities and learning difficulties.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext" ><div align="justify"> 
                            We will make all reasonable attempts to gain feedback 
                            from service users with disabilities. All uses with 
                            disabilities will be asked to complete client feedback 
                            forms.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="95%" height="20" valign="top" class="bodytext"><div align="justify"> 
                                  We will review our policies and procedures in 
                                  the light of feedback from clients with disabilities. 
                                  Furthermore, we will take positive action to 
                                  research the needs of disabled persons and continuously 
                                  seek ways in which to improve our services and 
                                  facilities in order to reduce or remove any 
                                  disadvantage they may caused a disabled person 
                                  compared to a non-disabled person.</div></td>
                            </tr>
                            <tr> 
                              <td height="20" valign="middle" class="bodytext">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td height="20" valign="middle" class="bodytext"><div align="justify"> 
                                  If disabled clients are prevented from accessing 
                                  our services due to premises issues our staff 
                                  will organise a referral to an alternative provider/ 
                                  venue, using the NL IAG Networking Directory. 
                                  Our staff will record the reasons for a referral 
                                  on a Disability Monitoring Form which is stored 
                                  in the front of the Client Records File i.e. 
                                  premises involved, details of the disability, 
                                  difficulties with the premises and where the 
                                  client was referred to. </div></td>
                            </tr>
                            <tr> 
                              <td height="20" valign="top" class="bodytext">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td height="20" valign="top" class="bodytext"><div align="justify"> 21K Digital Media Ltd Management Team will review this policy 
                                  on an annual basis.<br>
                                  Issue No.1 Dated 26 February 2016<br>
                                  Revision Date: January 2017<br>
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="4" ><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                    </table> </td>
                  <td width="1%" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top">&nbsp;</td>
                  <td height="19" valign="top"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
                  <td valign="top">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table>
      </div></td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td height="350"><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      <? include "includebottom.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" border="0" alt=""></td>
  </tr>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>