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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="lms.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo sitename;?>Learner Home</title>
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
</head>

<body >
<table width="911"  cellspacing="0" cellpadding="0" align="center">
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
        <th height="10" align="left" valign="top" scope="col"><? include "includewelcome.php";?></th>
        </tr>
      <tr>
        <th align="center" valign="top" scope="col"><table width="97%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F9FBEB" >
         <br /> <tr>
            <td colspan="3" ><div align="left"><img src="images/Complaint%20Procedures.gif" width="210" height="18"></div></td>
          </tr>
          <tr>
            <td colspan="3" class="bodytext">&nbsp;</td>
          </tr>
          <tr>
            <td class="subheading" colspan="3" align="center"><strong>21K Digital Media Ltd</strong></td>
          </tr>
          <tr>
            <td colspan="3" align="center" class="subheading"><strong>COMPLAINT PROCEDURE</strong></td>
          </tr>
          <tr>
            <td colspan="3" align="center" class="subheading"><strong>COMPLAINTS, COMMENTS 
              AND COMPLIMENTS POLICY</strong></td>
          </tr>
          <tr>
            <td width="5"  bgcolor="F9FBEB" class="personal" style=" border-top : 1px solid #E6ECB6">&nbsp;COMPLIMENTS</td>
            <td width="50%"  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6"><div align="right"><a  href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
            <td width="15%" nowrap  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6"><div align="justify"><a  class="print" href="javascript:print()">Print 
              this page</a></div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
          </tr>
          <tr>
            <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">An individual can give compliments either 
              verbally, by letter, by email or by completing a Compliments 
              Form.</div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" ><div align="justify"></div></td>
          </tr>
          <tr>
            <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">The member of staff receiving the details of the complaint will record all complaints received on a Complaints log. If a Complaints form, letter or email is received this should be stapled to the Complaints Log and stored in the Complaints File.</div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" ><div align="justify"></div></td>
          </tr>
          <tr>
            <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">All compliments received within the calendar month will be reported at the 21K Digital Media Ltd team meeting. Individual staff will be identified and examples of best practice highlighted and replicated wherever possible across the service.</div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" ><div align="justify">&nbsp;</div></td>
          </tr>
          <tr>
            <td height="22"  class="personal" colspan="3" bgcolor="F9FBEB" style=" border-top : 1px solid #E6ECB6"><div align="justify">&nbsp;COMPLAINTS</div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
          </tr>
          <tr>
            <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">An individual can give complaints either verbally, by letter, by email or by completing a Complaints form.</div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" ><div align="justify"></div></td>
          </tr>
          <tr>
            <td height="20" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">The member of staff receiving the details of the complaint will record all complaints received on a Complaints log. If a Complaints form, letter or email is received this should be stapled to the Complaints Log and stored in the Complaints File.</div></td>
          </tr>
          <tr>
            <td height="27" colspan="3" bgcolor="ECF9FF" ><div align="justify"></div></td>
          </tr>
          <tr>
            <td height="5" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">All complaints made in person or by telephone should be responded to immediately by the member of staff who takes the complaint - either through their own response or by referral to the 21K Digital Media Ltd Quality Manager if available. </div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" ><div align="justify"></div></td>
          </tr>
          <tr>
            <td height="15" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">If the complaint id not resolved immediately, then the member of staff should:</div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" ><div align="justify"></div></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="5%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" height="14"><img src="images/bullet.jpg" width="5" height="5"></td>
                      </tr>
                  </table></td>
                  <td width="95%" class="bodytext">Ask the complainant to complete a Complaints Form (or complete it on behalf of the client) Explain to the client the complaint procedure and that they will receive a response within five working days.</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="bodytext">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" height="14"><img src="images/bullet.jpg" width="5" height="5"></td>
                      </tr>
                  </table></td>
                  <td class="bodytext"><div align="justify">Complete a Complaints Log form-staple the Complaints Form to the Complaints Log Form. File both the originals in the Complaints File.</div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" height="14"><img src="images/bullet.jpg" width="5" height="5"></td>
                      </tr>
                  </table></td>
                  <td class="bodytext"><div align="justify">Refer the complaint to the 21K Digital Media Ltd Quality Manager by forwarding copies of the Complaint form. File and Complaints Log.</div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" height="14"><img src="images/bullet.jpg" width="5" height="5"></td>
                      </tr>
                  </table></td>
                  <td class="bodytext"><div align="justify">The 21K Digital Media Ltd Quality Manager will ensure the complaint is actioned and the Complaint receives a written response within five working days.</div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="bodytext">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" height="14"><img src="images/bullet.jpg" width="5" height="5"></td>
                      </tr>
                  </table></td>
                  <td class="bodytext"><div align="justify">All complaints received in the calendar month will be discussed at the  21K Digital Media Ltd Team Meeting. Individual staff members will not be identified however, the  21K Digital Media Ltd Quality Manager will be responsible for ensuring learning points are highlighted and corrective action taken.</div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="ECF9FF" ><div align="justify"></div></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th align="center" valign="top" scope="col"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></th>
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

<map name="Map2" id="Map2"><area shape="rect" coords="1,1,196,67" href="#" /></map>
<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map></body>
</html>