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
<title><?php echo sitename;?>Data Protection Policy Statement</title>
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
                        <td colspan="4" ><div align="left"><img src="images/dataheading.jpg" width="335" height="25"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="2"  >&nbsp;</td>
                        <td width="50%"  ><div align="right"><a  href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                        <td width="14%" nowrap  ><div align="right"><a  class="print" href="javascript:print()">Print 
                            this page</a></div></td>
                        <td width="1%">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="5%" height="50" valign="top" bgcolor="ECF9FF"><div align="center">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td height="30" align="center"><img src="images/bullet.jpg" width="5" height="5"></td>
                              </tr>
                              <tr> 
                                <td>&nbsp;</td>
                              </tr>
                            </table>
                          </div></td>
                        <td height="50" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">My Digital Future needs to keep certain personal data on 
                            staff and clients using the service. This data is 
                            subject to data protection legislation covered by 
                            the Data Protection Acts 1984 and 1998. The legislation 
                            covers information held electronically and in manual 
                            formats.</div></td>
                      </tr>
                      <tr> 
                        <td height="46" align="center" valign="bottom" bgcolor="ECF9FF"><div align="justify">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td height="54" align="center"><img src="images/bullet.jpg" width="5" height="5"></td>
                              </tr>
                            </table>
                          </div></td>
                        <td height="46" colspan="3" valign="bottom" bgcolor="ECF9FF" class="bodytext"><div align="justify">Personal 
                            data covers both facts and opinions about the individual. 
                            It also includes information regarding the intentions 
                            of the data controller towards the individual. Processing 
                            incorporates the concepts of &#8216;obtaining&#8217;, 
                            holding&#8217; and &#8216;disclosing information.</div></td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF"><div align="justify"></div></td>
                        <td height="23" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="45" bgcolor="ECF9FF"><div align="justify">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td height="30" align="center"><img src="images/bullet.jpg" width="5" height="5"></td>
                              </tr>
                              <tr> 
                                <td height="19">&nbsp;</td>
                              </tr>
                            </table>
                          </div></td>
                        <td height="45" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">The 
                            Data protection Act 1998 sets out eight principles 
                            that are to be adhered to by members of staff and 
                            volunteers when processing personal data. The eight 
                            principles are as follows:<br>
                          </div></td>
                      </tr>
                      <tr> 
                        <td align="center" valign="bottom" bgcolor="ECF9FF"> <div align="justify"></div></td>
                        <td height="11" colspan="3" valign="bottom" bgcolor="ECF9FF" class="bodytext"> 
                          <div align="justify"> 
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td width="3%" height="22" class="bodytext">-</td>
                                <td width="97%" height="30" class="bodytext">&#8220;The First 
                                  Principle: Personal data shall be processed 
                                  fairly and lawfully.</td>
                              </tr>
                              <tr> 
                                <td height="22" class="bodytext">-</td>
                                <td height="40" class="bodytext">The Second Principle: Personal 
                                  data shall be obtained only for one or more 
                                  specified and lawful purposes, and shall not 
                                  be further processed in any manner incompatible 
                                  with that purpose or those purposes.</td>
                              </tr>
                              <tr> 
                                <td height="22" class="bodytext">-</td>
                                <td height="40" class="bodytext">The Third Principle: Personal 
                                  data shall be adequate, relevant and not excessive 
                                  in relation to the purpose or purposes for which 
                                  they are processed.</td>
                              </tr>
                              <tr> 
                                <td height="22" class="bodytext">-</td>
                                <td height="30" class="bodytext">The Fourth Principle: Personal 
                                  data shall be accurate and, where necessary 
                                  kept up to date.</td>
                              </tr>
                              <tr> 
                                <td height="22" class="bodytext">-</td>
                                <td height="40" class="bodytext">The Fifth Principle: Personal 
                                  data processed for any purpose or purposes shall 
                                  not be kept for longer than is necessary for 
                                  that purpose or those purposes.</td>
                              </tr>
                              <tr> 
                                <td height="22" class="bodytext">-</td>
                                <td height="40" class="bodytext">The Sixth Principle: Personal 
                                  data shall be processed in accordance with the 
                                  rights of (the individual) under the Act. </td>
                              </tr>
                              <tr> 
                                <td height="22" class="bodytext">-</td>
                                <td height="45" class="bodytext">The Seventh Principle: Appropriate 
                                  technical and organisational measures shall 
                                  be taken against unauthorised or unlawful processing 
                                  of personal data and against accidental loss 
                                  or destruction of, or damage to personal data 
                                  and against accidental loss or destruction of, 
                                  or damage to, personal data.</td>
                              </tr>
                              <tr> 
                                <td height="22" class="bodytext">-</td>
                                <td height="40" class="bodytext">The Eighth Principle: Personal 
                                  data shall not be transferred to a country or 
                                  territory outside the European Economic Are 
                                  unless that country or territory.</td>
                              </tr>
                              <tr> 
                                <td colspan="2" class="bodytext">Ensures an adequate 
                                  level of protection for the rights and freedoms 
                                  of (individuals) in relation to the processing 
                                  of personal data&#8221;.</td>
                              </tr>
                            </table>
                          </div></td>
                      </tr>
                      <tr> 
                        <td height="8" bgcolor="ECF9FF"><div align="justify"></div></td>
                        <td height="8" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="45" bgcolor="ECF9FF"><div align="justify">
                            <table width="100%" height="44" border="0" cellpadding="0" cellspacing="0">
                              <tr> 
                                <td height="12" align="center"><img src="images/bullet.jpg" width="5" height="5"></td>
                              </tr>
                              <tr> 
                                <td>&nbsp;</td>
                              </tr>
                            </table>
                          </div></td>
                        <td height="50" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">We 
                            aim to comply with the data protection legislation 
                            by ensuring the Administration Co-ordinator, who is 
                            responsible for ensuring any personal data obtained 
                            from clients is held in the manner in which personal 
                            data is to be processed. The Administrative Co-ordinator 
                            will also provide guidance to members of staff and 
                            volunteers on their responsibilities relating to the 
                            legislation.</div></td>
                      </tr>
                      <tr> 
                        <td height="45" bgcolor="ECF9FF"><div align="justify">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td height="35" align="center"><img src="images/bullet.jpg" width="5" height="5"></td>
                              </tr>
                              
                            </table>
                          </div></td>
                        <td height="45" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">My Digital Future will ensure client records are stored 
                            in accordance with the Data protection Act.</div></td>
                      </tr>
                      <tr> 
                        <td height="49" align="center" valign="bottom" bgcolor="ECF9FF"><div align="justify">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td height="31" align="center"><img src="images/bullet.jpg" width="5" height="5"></td>
                              </tr>
                              <tr> 
                                <td>&nbsp;</td>
                              </tr>
                            </table>
                          </div></td>
                        <td height="49" colspan="3" valign="bottom" bgcolor="ECF9FF" class="bodytext"><div align="justify">Staff 
                            will make it clear to clients when data is being collected 
                            from them which will be held by the organisation, 
                            for example on client questionnaires and feedback 
                            forms and verbally when information is collected by 
                            phone or in interviews. </div></td>
                      </tr>
                      <tr> 
                        <td height="45" valign="top" bgcolor="ECF9FF"><div align="justify">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td height="40" align="center"><img src="images/bullet.jpg" width="5" height="5"></td>
                              </tr>
                              <tr> 
                                <td>&nbsp;</td>
                              </tr>
                            </table>
                          </div></td>
                        <td height="70" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">All 
                            members of staff will be made fully aware that it 
                            is their responsibility to inform the Administration 
                            Co-ordinator about any proposals they have to retain 
                            automated personal data, and to ensure their own awareness 
                            of the data protection principles when processing 
                            personal data. This will be covered during Induction.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF"><div align="justify"></div></td>
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
