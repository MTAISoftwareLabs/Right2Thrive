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
                        <td colspan="4" ><div align="left"><img src="images/servicesheading.jpg" width="251" height="23"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="2"  class="personal">&nbsp;</td>
                        <td width="50%"   class="personal"><div align="right"><a  href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                        <td width="14%" nowrap   class="personal"><div align="right"><a  class="print" href="javascript:print()">Print 
                            this page</a></div></td>
                        <td width="1%">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="3%" height="17" valign="bottom" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="11" colspan="3" rowspan="2" valign="middle" bgcolor="ECF9FF" class="bodytext"><div align="justify">Career 
                            Paths Online is a subsidiary of 21k Media ltd. An 
                            e-learning company based in London. We specialise 
                            in producing high quality e- learning resources to 
                            aid individual career development.</div></td>
                      </tr>
                      <tr> 
                        <td height="25" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="26" bgcolor="ECF9FF">&nbsp;</td>
                        <td height="11" colspan="3" bgcolor="ECF9FF" class="bodytext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="16" align="center" valign="bottom" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td height="6" colspan="3" rowspan="2" valign="middle" bgcolor="ECF9FF" class="bodytext"><div align="justify">Our 
                            aim is to empower all who are socially, and economically, 
                            disadvantaged. We focus, especially, on those who 
                            are disabled, refugees, unemployed, low-income employees 
                            or, in any way, socially excluded.</div></td>
                      </tr>
                      <tr> 
                        <td height="22" align="center" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22" align="center" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                        <td height="5" colspan="3" valign="middle" bgcolor="ECF9FF" class="bodytext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="14" valign="bottom" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="0" colspan="3" rowspan="2" valign="middle" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            help them improve their quality of life through increased 
                            effective knowledge, by our skilful use of media and 
                            technology.</div></td>
                      </tr>
                      <tr> 
                        <td height="8" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22" bgcolor="ECF9FF">&nbsp;</td>
                        <td height="22" colspan="3" valign="middle" bgcolor="ECF9FF" class="bodytext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="16" align="center" valign="bottom" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td height="6" colspan="3" rowspan="2" valign="middle" bgcolor="ECF9FF" class="bodytext"><div align="justify">By 
                            developing specific multimedia solutions, we enable 
                            businesses, community organisations and other training 
                            agencies, to enhance their courses.</div></td>
                      </tr>
                      <tr> 
                        <td height="21" align="center" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td align="center" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                        <td height="5" colspan="3" valign="middle" bgcolor="ECF9FF" class="bodytext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="16" valign="bottom" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="11" colspan="3" rowspan="2" valign="middle" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            are experts in producing a wide range of educational 
                            programmes to meet the diverse needs within the workplace. 
                          </div></td>
                      </tr>
                      <tr> 
                        <td height="23" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF">&nbsp;</td>
                        <td height="11" colspan="3" valign="middle" bgcolor="ECF9FF" class="bodytext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="17" valign="bottom" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="11" colspan="3" rowspan="2" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            provide unbiased, confidential information advice 
                            and guidance to individuals who need to decide what 
                            career options are available to them and how to take 
                            the necessary steps to achieve their goals.</div></td>
                      </tr>
                      <tr> 
                        <td height="21" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24" bgcolor="ECF9FF">&nbsp;</td>
                        <td height="11" colspan="3" bgcolor="ECF9FF" class="bodytext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="16" align="center" valign="bottom" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td height="7" colspan="3" rowspan="2" valign="middle" bgcolor="ECF9FF" class="bodytext"><div align="justify">Our 
                            IAG services are supported by a code of conduct relating 
                            to confidentiality, equal opportunities and disability.</div>
                          <div align="justify"> </div></td>
                      </tr>
                      <tr> 
                        <td height="22" align="center" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td align="center" valign="bottom" bgcolor="ECF9FF">&nbsp;</td>
                        <td height="6" colspan="3" valign="middle" bgcolor="ECF9FF" class="bodytext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="13" align="center" valign="bottom" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"></td>
                        <td height="11" colspan="3" rowspan="2" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            regularly review our IAG services and use your comments 
                            to increase our awareness on how well we meet your 
                            needs.</div></td>
                      </tr>
                      <tr> 
                        <td height="20" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF">&nbsp;</td>
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
