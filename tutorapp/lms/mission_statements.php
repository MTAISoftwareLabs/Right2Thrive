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

<title><? echo sitename;?>Mission Statement</title>
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
  <!-- fwtable fwsrc="lms_1.png" fwbase="lms_1.gif" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  
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
            <td width="2%" align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr> 
                  <td width="2%" valign="top">&nbsp;</td>
                  <td width="96%" height="300" valign="top" align="center"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                                         <tr> 
                        <td colspan="2" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="4" ><div align="left"><img src="images/Mission%20Statements.gif" width="162" height="18"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="2"  bgcolor="F9FBEB" class="personal"><div align="justify">&nbsp;Statements 
                            of Service</div></td>
                        <td width="50%"  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6"><div align="right"><a  href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                        <td width="14%" nowrap  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6"><div align="justify"><a  class="print" href="javascript:print()">Print 
                            this page</a></div></td>

                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;"><div align="justify"> 
                            &nbsp; </div></td>
                      </tr>
                      <tr> 
                        <td height="12" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify"> 21K Digital Media Ltd is an e-learning company based in London 
                            We specialise in producing high quality e- learning
                            resources to aid individual career development.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">Our 
                            aim is to empower all who are socially, and economically, 
                            disadvantaged. We focus, especially, on those who 
                            are disabled, refugees, unemployed, low-income employees 
                            or, in any way, socially excluded.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            help them improve their quality of life through increased 
                            effective knowledge, by our skilful use of media and 
                            technology</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">By 
                            developing specific multimedia solutions, we enable 
                            businesses, community organisations and other training 
                            agencies, to enhance their courses.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            are experts in producing a wide range of educational 
                            programmes to meet the diverse needs within the workplace. 
                          </div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            provide unbiased, confidential information advice 
                            and guidance to individuals who need to decide what 
                            career options are available to them and how to take 
                            the necessary steps to achieve their goals.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">Our 
                            IAG services are supported by a code of conduct relating 
                            to confidentiality, equal opportunities and disability.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            regularly review our IAG services and use your comments 
                            to increase our awareness on how well we meet your 
                            needs.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="4" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">Date 
                            January 2010<br>
                            Review Date February 2011 </div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a</td>
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