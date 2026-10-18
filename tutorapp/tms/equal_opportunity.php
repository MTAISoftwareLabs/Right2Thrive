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
<title>Equal Opportunity</title>
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
            <td width="2%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr> 
                  <td width="2%" valign="top">&nbsp;</td>
                  <td width="96%" height="300" valign="top"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                      <tr> 
                        <td colspan="3" ></td>
                      </tr>
                      <tr> 
                        <td colspan="3" ><img src="images/careerheading.jpg" width="215" height="24"></td>
                      </tr>
                      <tr> 
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="48%"  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6">Introduction</td>
                        <td width="36%"  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6"><div align="right"><a  href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                        <td width="16%"  bgcolor="F9FBEB" class="personal"  style=" border-top : 1px solid #E6ECB6"><div align="right"><a  class="print" href="javascript:print()">Print 
                            this page</a></div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">21K Creative Media aims to promote equality of opportunity 
                            and is committed to relations amongst all people with 
                            whom it is involved. It is the policy of the 21K Creative Media that 
                            there shall be no discrimination in staff recruitment, 
                            employment conditions, promotions and delivery of 
                            training on the grounds of gender, marital status, 
                            colour, race, ethnic or national origins, disability, 
                            religion, sexual orientation or age.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" class="subheading" style="border-bottom : 1px solid #84D0FF;">21K Creative Media 
                          aims to : </td>
                      </tr>
                      <tr> 
                        <td height="50" colspan="3" bgcolor="ECF9FF" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr bgcolor="ECF9FF"> 
                              <td width="5%" valign="top"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                    <tr> 
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td width="95%" height="35" valign="top" class="bodytext"><div align="justify">Identify 
                                  and stop discrimination whenever it occurs and 
                                  in particular, discrimination against the groups 
                                  within the scope of this statement</div></td>
                            </tr>
                            <tr bgcolor="ECF9FF"> 
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td class="bodytext"><div align="justify">Ensure 
                                  our services and published materials are consistent 
                                  with our Equal Opportunities policy, and avoid 
                                  the use of offensive and discriminating language 
                                  in both formal and informal communications.</div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" class="subheading" style="border-bottom : 1px solid #84D0FF;">To 
                          achieve our aims we will</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="5%" height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td width="95%" height="20" valign="top" class="bodytext"><div align="justify">Promote 
                                  Equal Opportunities throughout the organisation<br>
                                </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                    <tr> 
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td height="20" valign="top" class="bodytext"><div align="justify">Provide 
                                  annual training and/or guidance to all employees 
                                  to ensure 21K Creative Media commitment to Equal Opportunities 
                                  is known and understood<br>
                                </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">Collect, 
                                  evaluate and act upon the anonymous opinions 
                                  of service users</div></td>
                            </tr>
                            <tr> 
                              <td height="20"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td height="20" valign="top" class="bodytext"><div align="justify">Review 
                                  all our policies and procedures annually to 
                                  ensure equality of opportunity, responsiveness, 
                                  sensitivity and accessibility</div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">Ensure 
                                  our disciplinary and grievance procedures contain 
                                  provision to enforce this policy &amp;</div></td>
                            </tr>
                            <tr> 
                              <td height="20"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td height="20" valign="top" class="bodytext"><div align="justify">Include 
                                  Equal Opportunities as a mandatory point/agenda 
                                  item at the 21K Creative Media Quality Review Group meetings 
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="20" colspan="3" bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF;"><div align="center">All 
                            members of 21K Creative Media will be expected to respect and act 
                            in accordance with this policy</div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="18" colspan="3"  bgcolor="F9FBEB" class="personal"  style="border-top : 1px solid #E6ECB6";">Recruitment</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">The 
                            21K Creative Media will recruit and select by processes that reflect 
                            good personnel practice and avoid discrimination against 
                            any group of people. Vacancies and opportunities will 
                            be widely publicised to reach all sectors of society. 
                          </div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" class="subheading" style="border-bottom : 1px solid #84D0FF;">Positive 
                          Action </td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext" ><div align="justify">Under 
                            the Sex Discrimination Act (1975) and Race Relations 
                            Act (1976) we can: (Both Acts are available on request) 
                          </div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="5%" height="20" valign="top"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="13" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                    <tr> 
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td width="95%" height="20" valign="top" class="bodytext"><div align="justify">Provide 
                                  training and encouragement for people of a particular 
                                  race or gender, who are under-represented in 
                                  certain occupations or pay scales</div></td>
                            </tr>
                            <tr> 
                              <td height="20" valign="top"><div align="center"><img src="images/bullet.jpg" width="5" height="5"> 
                                </div></td>
                              <td height="20" valign="middle" class="bodytext"><div align="justify">Address 
                                  any special educational, training or welfare 
                                  needs for a specific racial group. </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td height="20" valign="top" class="bodytext"><div align="justify">Provide 
                                  training and encouragement for people returning 
                                  to work following domestic or family responsibilities 
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext" ><div align="justify">Positive 
                            Action or encouragement might include targeted advertising 
                            and recruitment literature, or reserving places for 
                            particular groups on training courses.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="10" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF;"><div align="justify">Specific 
                            steps will be taken to encourage applicants from particular 
                            groups where these are under-represented. It is the 
                            21K Creative Media s&#8217; policy of the that applicants are employed 
                            and trained on the basis of ability and the requirements 
                            of the job/training scheme. </div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="18" colspan="3"  bgcolor="F9FBEB" class="personal"  style="border-top : 1px solid #E6ECB6";">Monitoring</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3"  bgcolor="ECF9FF" class="bodytext" ><div align="justify">21K Creative Media 
                            will collect and maintain records for analysis and 
                            review, and to show what progress is being made in 
                            the implementation of this policy. The information 
                            will include:</div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top"  bgcolor="ECF9FF" class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr valign="middle"> 
                              <td width="5%"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td width="95%" height="20" class="bodytext"><div align="justify">Recruitment 
                                  and Selection data</div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify"> 
                                  Composition of our trainees and employees</div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">	
                                  Achievement of qualifications and job outcomes</div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify"> 
                                  Take-up of work experience placements </div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">Any 
                                  other monitoring as determined by the Equal 
                                  Opportunities Quality Review Group </div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3"  bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF" ><div align="justify">The 
                            Chief Executive will regularly monitor the effectiveness 
                            of Equal Opportunity in all its practices. The senior 
                            management team will take any appropriate action required 
                            to ensure that the 21K Creative Media fulfils the requirements of 
                            all relevant legislations. Monitoring procedures will 
                            cover the ethnicities, gender and disability of applicants 
                            and recruits, in relation to all members of 21K Creative Media. </div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="18" colspan="3"  bgcolor="F9FBEB" class="personal"  style="border-top : 1px solid #E6ECB6";">Inroduction</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3"  bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF"><div align="justify">Staff 
                            and trainees will receive a comprehensive induction 
                            programme that clearly explains their rights and responsibilities. 
                            All staff will receive a copy of the Staff Handbook 
                            and all trainees&#8217; a Training Handbook, both 
                            of which contains details of the Equal Opportunities 
                            Policy.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="18" colspan="3"  bgcolor="F9FBEB" class="personal"  style="border-top : 1px solid #E6ECB6";">Training 
                          And Assessment</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3"  bgcolor="ECF9FF" class="bodytext" ><div align="justify">21K Creative Media 
                            will promote access to training and assessment for 
                            members, and will do all that is possible to ensure 
                            that those who have the potential to achieve the standards 
                            are given access to fair assessments. Where possible, 
                            candidates with particular training and assessment 
                            requirements will be given alternative means to provide 
                            evidence of competence. Care will be taken to ensure 
                            that proposed assessment methods are of equal quality 
                            and rigor to those of mainstream candidates.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3"  bgcolor="ECF9FF" class="bodytext" ><div align="justify">Candidates 
                            will be given appropriate support in their development, 
                            to help them meet the required standard such as:</div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3"  bgcolor="ECF9FF" class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr valign="middle"> 
                              <td width="5%"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td width="95%" height="20" class="bodytext"><div align="justify">Help 
                                  with communication, literacy and numeracy </div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify"> 
                                  Adapted equipment and physical environment </div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">	
                                  Special information technology equipment</div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify"> 
                                  Confidence building</div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">	
                                  Help with finding work or accessing other training 
                                  opportunities </div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext">Information, Advice 
                                and Guidance &#8211; before, during and after 
                                programme</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3"  bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF"><div align="justify">The 
                            21K Creative Media ensures that all our awarding bodies; Equal Opportunities 
                            policies relating to training and assessment, are 
                            adhered to at all times. </div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="18" colspan="3"  bgcolor="F9FBEB" class="personal"  style="border-top : 1px solid #E6ECB6">Staff 
                          Development </td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3"  bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF;"><div align="justify">An 
                            annual training and development budget will be agreed 
                            and training provided as part of a general programme 
                            to improve skills throughout the workforce, In addition, 
                            the 21K Creative Media has a training appraisal for all staff are 
                            encouraged them to use Learndirect programmes for 
                            personal and professional development. Attendance 
                            during working hours will be negotiated with line 
                            managers. Promotion/advancement will be based on ability 
                            and opportunities given to all staff within the organisation. 
                          </div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="18" colspan="3"  bgcolor="F9FBEB" class="personal"  style="border-top : 1px solid #E6ECB6">Complaints 
                          Relating to Abuse and Discrimination</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF;">All 
                          complaints of discrimination &#8211; direct or indirect, 
                          abuse, victimisation or harassment will be investigated 
                          without delay by a senior manger. Such activities, if 
                          established against a 21K Creative Media member, will be dealt with 
                          via the grievance procedure, as gross misconduct under 
                          the disciplinary procedures.</td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="18" colspan="3"  bgcolor="F9FBEB" class="personal"  style="border-top : 1px solid #E6ECB6">Marketing 
                          and Corporate Image</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext"  >All 
                          staff, trainees, applicants and new recruits will receive 
                          information on the Equal Opportunities policy. Staff 
                          and trainee induction will cover equality of opportunity. 
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="subheading" style="border-bottom : 1px solid #84D0FF"  >21K Creative Media 
                          seek to</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" align="left" valign="top" bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF;"m><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr valign="middle"> 
                              <td width="5%"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                    <tr> 
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td width="95%" height="20" valign="top" class="bodytext"><div align="justify">Maintain 
                                  representative numbers of staff from local communities 
                                  on its workforce at all levels </div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="12"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify"> 
                                  Make its marketing strategies relevant to the 
                                  different local communities</div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                    <tr> 
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td valign="top" class="bodytext"><div align="justify">	
                                  Include an appropriate Equal Opportunities statement 
                                  in all advertising or promotional material</div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify"> 
                                  Encourage minority groups to participate </div></td>
                            </tr>
                            <tr valign="middle"> 
                              <td height="20"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                    <tr> 
                                      <td  >&nbsp;</td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td height="20" valign="top" class="bodytext" ><div align="justify">	
                                  Use local and national minority press and local 
                                  networks to ensure that information is widely 
                                  available</div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="18" colspan="3"  bgcolor="F9FBEB" class="personal"  style="border-top : 1px solid #E6ECB6">Organisational 
                          Responsibility</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF" style="border-top: 1px solid #84D0FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext"   ><div align="justify">The 
                            Chief Executive and Senior Management Team will review 
                            the 21K Creative Media&#8217;s Equal Opportunities Policy to ensure 
                            its continued relevance and will recommend and promote 
                            equal opportunities initiatives. Line Mangers are 
                            responsible for implementing and promoting the policy 
                            within their centres/branches. Managers must observe 
                            and promote the company&#8217;s Equal Opportunities 
                            Policy at all times. All staff and trainees are expected 
                            to observe the Equal Opportunities Policy and implement 
                            it within their spheres of activity.</div></td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="subheading" style="border-bottom : 1px solid #84D0FF"  >Key 
                          Terms</td>
                      </tr>
                      <tr> 
                        <td colspan="3" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext" style="border-bottom : 1px solid #84D0FF"   ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="5%" height="20"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                    <tr> 
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td width="95%" height="20" valign="top" class="bodytext"><div align="justify">	
                                  Equal opportunities &#8211; treating people 
                                  the same, regardless of differences that are 
                                  not relevant, but considering differences that 
                                  are.<br>
                                </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"> 
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                      <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                    </tr>
                                    <tr> 
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </div></td>
                              <td valign="top" class="bodytext"><div align="justify">Prejudice 
                                  - unfavourable opinion or feelings formed beforehand 
                                  based on limited knowledge, thought or reason.<br>
                                  <br>
                                </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" class="bodytext"><div align="justify">	
                                  Discrimination - less favourable treatment.</div></td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td valign="middle" class="bodytext"><div align="justify">	
                                  Direct Discrimination &#8211; treating someone 
                                  less favourably than another.</div></td>
                            </tr>
                            <tr> 
                              <td height="20"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td height="20" valign="top" class="bodytext"><div align="justify">	
                                  Indirect Discrimination &#8211; where the conditions 
                                  or requirements for job/ training are unnecessary, 
                                  unfair or unreasonable, to the exclusion of 
                                  individuals or groups. </div></td>
                            </tr>
                            <tr> 
                              <td height="20"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td height="20" valign="top" class="bodytext">Harassment 
                                &#8211; unwelcome or inappropriate behaviour that 
                                undermines, demeans, offends, insults or injures.</td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" valign="top" class="bodytext"> Victimisation 
                                &#8211; Persistent Harassment</td>
                            </tr>
                            <tr> 
                              <td height="20"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" valign="top" class="bodytext"> Grievance 
                                &#8211; a feeling of resentment or injustice at 
                                having been unfairly treated </td>
                            </tr>
                            <tr> 
                              <td height="20"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="15" valign="middle"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td height="20" valign="top" class="bodytext"> Positive 
                                Action - steps to stop discrimination or imbalance 
                                by actively encouraging those who are under represented 
                                in an organisation</td>
                            </tr>
                            <tr> 
                              <td height="20"   ><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                              <td height="20" valign="top" class="bodytext"   > 
                                Members of 21K Creative Media- staff, trainees, candidates, clients, 
                                trustees, partners and guests</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="3" >&nbsp;</td>
                      </tr>
                    </table> </td>
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
