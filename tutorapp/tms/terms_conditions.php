<?php
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
<title><?php echo sitename;?>Terms & Conditions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <!-- fwtable fwsrc="lms_1.png" fwbase="lms_1.gif" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  <tr> 
    <td colspan="2" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="100%"  valign="top"> 
            <?php include "includetop.php";?>
          </td>
          <td  ></td>
        </tr>
      </table></td>
    <td width="1">&nbsp;</td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%"  style="border-right:1px solid #cccccc;"> 
      <?php include "includeleft.php";?>
    </td>
    <td rowspan="2" align="right" valign="top"> <div align="left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
          </tr>
          <tr>
            <td width="2%" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr> 
                  <td width="2%" valign="top">&nbsp;</td>
                  <td width="96%" height="300" valign="top" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
                      <tr> 
                        <td colspan="4" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="4" ><div align="left"><img src="images/headings_terms.gif" width="196" height="18"></div></td>
                      </tr>
                      
                      <tr> 
                        <td colspan="2"  >&nbsp;</td>
                        <td width="50%"  ><div align="right"><a  href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                        <td width="14%" nowrap ><div align="right"><a  class="print" href="javascript:print()">Print 
                            this page</a></div></td>
                        <td width="1%">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4"  class="personal" bgcolor="F9FBEB" style=" border-top : 1px solid #E6ECB6;">&nbsp;In 
                          order to enrol on our career development programme you 
                          must consent to this agreement:</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="3%" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext">I 
                          agree to be honest in the information I provide to CareerPaths 
                          Online.</td>
                      </tr>
                      <tr> 
                        <td align="center" valign="bottom" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td height="11" colspan="3" valign="bottom" bgcolor="ECF9FF" class="bodytext">I 
                          agree to complete all activities related to my programme 
                          within the time agreed </td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF">&nbsp;</td>
                        <td height="11" colspan="3" bgcolor="ECF9FF" class="bodytext">with 
                          my tutor.</td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">I 
                            agree to fill in any evaluation and funding forms 
                            within the time agreed.</div></td>
                      </tr>
                      <tr> 
                        <td align="center" valign="bottom" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td height="11" colspan="3" valign="bottom" bgcolor="ECF9FF" class="bodytext"><div align="justify">I 
                            agree to follow any regulations CareerPaths Online 
                            may introduce from time to </div></td>
                      </tr>
                      <tr> 
                        <td height="8" bgcolor="ECF9FF">&nbsp;</td>
                        <td height="8" colspan="3" bgcolor="ECF9FF" class="bodytext">time.</td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext">I 
                          consent to the Privacy Policy (read the Policy here). 
                        </td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">I 
                            agree to use the Chat room and notice board only for 
                            careers-related matters.</div></td>
                      </tr>
                      <tr> 
                        <td align="center" valign="bottom" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td height="13" colspan="3" valign="bottom" bgcolor="ECF9FF" class="bodytext"><div align="justify">I 
                            agree not to use abusive, aggressive, discriminatory 
                            or sexual language while using </div>
                          <div align="justify"> </div></td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF">&nbsp;</td>
                        <td height="11" colspan="3" bgcolor="ECF9FF" class="bodytext">using 
                          the Chat room, noticeboard or any other areas of the 
                          website, or while communicating with tutors</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22"  class="personal"colspan="4" bgcolor="F9FBEB" style=" border-top : 1px solid #E6ECB6;">&nbsp;CareerPaths Online agrees to:</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext">Provide 
                          advice, information and support relevant to your career 
                          goals and needs.</td>
                      </tr>
                      <tr> 
                        <td height="11" valign="middle" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="11" colspan="3" valign="middle" bgcolor="ECF9FF" class="bodytext">Provide 
                          the best service we can to all students, whatever their 
                          cultural or educational 
                          <div align="justify"> </div></td>
                      </tr>
                      <tr> 
                        <td height="11" valign="top" bgcolor="ECF9FF">&nbsp;</td>
                        <td height="11" colspan="3" bgcolor="ECF9FF" class="bodytext">background, 
                          race, gender, disability, religion or sexuality. </td>
                      </tr>
                      <tr> 
                        <td height="22" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext">Respond 
                          to all questions within 24 hours </td>
                      </tr>
                      <tr> 
                        <td height="22" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext">Respond 
                          to all complaints within 24hours</td>
                      </tr>
                      <tr> 
                        <td height="22" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext">Follow 
                          the Privacy Policy.</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="1%" valign="top">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div></td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      <?php include "includebottom.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" border="0" alt=""></td>
  </tr>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
