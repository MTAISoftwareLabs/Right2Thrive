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
<title><? echo sitename;?>Complaint Procedures</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><? include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%"  style="border-right:1px solid #cccccc;"> 
      <? include "includeleft.php";?>
    </td>
    <td rowspan="2" align="right" valign="top"> <div align="left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
          </tr>
          <tr>
            <td width="2%" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr> 
                  <td width="2%" valign="top">&nbsp;</td>
                  <td width="96%" height="300" valign="top" align="center"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                  
                      <tr> 
                        <td colspan="4" ><div align="left"><img src="images/Complaint%20Procedures.gif" width="210" height="18"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="2"  bgcolor="F9FBEB" class="personal"><div align="justify">&nbsp;Introduction</div></td>
                        <td width="50%"  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6"><div align="right"><a  href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                        <td width="15%" nowrap  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6"><div align="justify"><a  class="print" href="javascript:print()">Print 
                            this page</a></div></td>

                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">The 
                            complaint procedure is designed to assist students 
                            who have perception of unfair and/or unlawful treatment. 
                            A student is defined as any person enrolled full or 
                            part-time in credit or non-credit courses at the College. 
                            A complaint of unfair and/or unlawful treatment formally 
                            charged by a student against a College employee, in 
                            regard to the application of College rules, policies, 
                            procedures, and regulations, should be resolved without 
                            initiating the formal procedure, if at all possible. 
                            This procedure does not supersede the policies set 
                            forth for grievances of discrimination, harassment, 
                            or grade appeals. Access to these policies is listed 
                            at the end of this document.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">The 
                            complaint procedure is designed to assist students 
                            who have perception of unfair and/or unlawful treatment. 
                            A student is defined as any person enrolled full or 
                            part-time in credit or non-credit courses at the College. 
                            A complaint of unfair and/or unlawful treatment formally 
                            charged by a student against a College employee, in 
                            regard to the application of College rules, policies, 
                            procedures, and regulations, should be resolved without 
                            initiating the formal procedure, if at all possible. 
                            This procedure does not supersede the policies set 
                            forth for grievances of discrimination, harassment, 
                            or grade appeals. Access to these policies is listed 
                            at the end of this document.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="22"  class="personal"colspan="4" bgcolor="F9FBEB" style=" border-top : 1px solid #E6ECB6;"><div align="justify">&nbsp;Procedure</div></td>
                      </tr>
                      <tr> 
                        <td height="22"  class="subheading" colspan="4" bgcolor="ECF9FF" style=" border-top : 1px solid #E6ECB6;"><div align="justify">&nbsp;Level 
                            1 </div></td>
                      </tr>
                      <tr> </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">For 
                            classroom problems, a student should always speak 
                            with the Tutor first. The student can make an appointment 
                            and be honest about the problem. If there is no resolution 
                            after speaking with the instructor, the student may 
                            contact the chief executive and again by making an 
                            appointment.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">A 
                            complaint should be raised and resolved as quickly 
                            as possible. Within fifteen (10) business days following 
                            either the event of the complaint </div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">The 
                            first step is for the student to meet with the tutor 
                            involved. If the matter cannot be resolved, the student 
                            may file a written complaint within ten (10) business 
                            days following the verbal response from the College 
                            employee involved. The written complaint should be 
                            presented to the employee with notification of complaint 
                            being forwarded to the employee's supervisor. The 
                            written complaint should contain the following:</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td  width="5%" class="blacktxt" bgcolor="ECF9FF" ><div align="justify"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td wi height="15" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">A 
                            complete description of the complaint</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td width="5%"   class="blacktxt" bgcolor="ECF9FF" ><div align="justify"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="15" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">any 
                            supporting documents</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td width="5%"   class="blacktxt" bgcolor="ECF9FF" ><div align="justify"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="15" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">the 
                            redress (desired outcome) sought.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="30" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">An 
                            entire set of records should be assembled and maintained 
                            by the student. The person receiving the written complaint 
                            has ten (10) business days to reply to the student 
                            in writing. </div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="22"  class="subheading" colspan="4" bgcolor="ECF9FF" ><div align="justify">&nbsp;Level 
                            2 </div></td>
                      </tr>

                      <tr> </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">If 
                            the student is not satisfied with the written response 
                            from the employee, he or she may appeal it to the 
                            appropriate supervisor within ten (10) business days. 
                            The student should forward copies of all correspondence 
                            and relevant documents from LEVEL 1, along with a 
                            cover letter, to the supervisor. The supervisor has 
                            ten (10) business days to adjudicate the matter and 
                            reply in writing to the student.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="22"  class="subheading" colspan="4" bgcolor="ECF9FF" ><div align="justify">&nbsp;Level 
                            3 </div></td>
                      </tr>

                      <tr> </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">If 
                            the student is not satisfied with the written response 
                            from LEVEL 2, he or she may appeal to the appropriate 
                            Dean/Provost. This appeal must be made within ten 
                            (10) business days after the reply from LEVEL 2. The 
                            student should forward copies of all correspondence 
                            and relevant documents from LEVELS 1 and 2, along 
                            with a cover letter, to the Dean/Provost. The Dean/Provost 
                            has ten (10) business days to adjudicate the matter 
                            and reply in writing to the student.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="22"  class="subheading" colspan="4" bgcolor="ECF9FF" ><div align="justify">&nbsp;Level 
                            4 </div></td>
                      </tr>

                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td height="20" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">If 
                            the student is not satisfied with the Dean/Provost's 
                            response, he or she may appeal to the College President 
                            within ten (10) business days after the reply from 
                            LEVEL 3. The student should forward copies of all 
                            correspondence and documentation from LEVELS 1, 2, 
                            and 3, along with a cover letter, to the President. 
                            The President will discuss the complaint with all 
                            concerned parties and adjudicate the issue within 
                            ten (10) business days after receipt of the correspondence. 
                            This decision will be final.</div></td>
                      </tr>
                      <tr> 
                        <td height="27" colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="22"  class="personal"colspan="4" bgcolor="F9FBEB" style=" border-top : 1px solid #E6ECB6;"><div align="justify">&nbsp;General 
                            Guidelines </div></td>
                      </tr>
                     <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF"><img src="images/whiteimage.jpg" width="6" height="5"></td>
                      </tr>
                      <tr> 
                        <td height="5" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">The 
                            student filing a complaint may be accompanied by an 
                            advisor or representative of his/her choice and at 
                            the student's expense at any level of the procedure. 
                            The student may not be represented in these discussions 
                            by an attorney-at-law without prior written approval 
                            and K.C.T.C.S. legal council also present. </div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="15" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">Revision 
                            of the deadlines for filing appeals and providing 
                            written responses may be made due to extenuating circumstances 
                            such as vacations, examinations, or illnesses. If 
                            the deadlines are changed by either party, the respective 
                            employee should inform the student of the receipt 
                            of the complaint and give an estimated date of the 
                            final reply.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="12" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">Copies 
                            of the Dean's/Provosts' decision will be sent to the 
                            appropriate College employees at LEVELS 1 and 2, and 
                            to the President.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="12" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">For 
                            formal grievance procedures involving alleged discrimination 
                            or harassment, students should refer to the following 
                            websites: </div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4"  class="blacktxt" bgcolor="ECF9FF"><div align="justify"><a class="bottomlink" href="http://www.kctcs.edu/employee/policies/volumeII/volII6-6.pdf" target="_blank">&lt;http://www.kctcs.edu/employee/policies/volumeII/volII6-6.pdf&gt;</a><BR>
                            <a class="bottomlink" href="http://www.kctcs.edu/student/sexualharassmentstudents.pdf" target="_blank">&lt;http://www.kctcs.edu/student/sexualharassmentstudents.pdf&gt;</a></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td height="12" colspan="4" bgcolor="ECF9FF" class="bodytext"><div align="justify">The 
                            Student Code of Conduct may be accessed at the following 
                            website</div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4"  bgcolor="ECF9FF"  class="blacktxt"><div align="justify"><a class="bottomlink" href="http://www.kctcs.edu/student/code.htm" target="_blank">&lt;http://www.kctcs.edu/student/code.htm&gt;</a></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" ><div align="justify"></div></td>
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
