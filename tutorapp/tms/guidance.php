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
<title><?php echo sitename;?>Client Guidance Policy</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="guidance" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
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
                  <td width="96%" height="300" valign="top" align="center"><table width="100%" height="2215" border="0" cellpadding="0" cellspacing="0" >
                      <tr> 
                        <td colspan="4" >&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="4" ><div align="left"><img src="images/ClientGuidancePolicy.gif" width="200" height="18"></div></td>
                      </tr>
                      <tr> 
                        <td colspan="2"  >&nbsp;</td>
                        <td width="50%"  ><div align="right"><a  href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                        <td width="14%" nowrap ><div align="right"><a  class="print" href="javascript:print()">Print 
                            this page</a></div></td>
                        <td width="1%">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22"  class="personal"colspan="4" bgcolor="F9FBEB" style=" border-top : 1px solid #E6ECB6;"><div align="justify">&nbsp;CLIENT 
                            CONTACT, ADVICE &amp; GUIDANCE POLICY</div></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4"  class="subheading" bgcolor="ECF9FF" style=" border-top : 1px solid #E6ECB6;">&nbsp;Initial 
                          Client Contact</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="3%" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext">Welcome 
                          the client in a polite and helpful manner whether online 
                          or in contact. </td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="32" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">Ask 
                            how you can help them</div></td>
                      </tr>
                      <tr> 
                        <td height="15" valign="middle" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5" align="top"></div></td>
                        <td height="33" colspan="3" valign="middle" bgcolor="ECF9FF" class="bodytext">Listen 
                          to their response and identify their needs. Ask further 
                          questions to clarify their needs if necessary. </td>
                      </tr>
                      <tr> 
                        <td height="8" align="center" valign="bottom" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td colspan="3" rowspan="2" valign="middle" bgcolor="ECF9FF" class="bodytext"><div align="justify">Provide 
                            information, in an appropriate format about the services 
                            available. Highlight the services most relevant to 
                            their needs. Explain any cost, restrictions, waiting 
                            times ect. ating with tutors</div></td>
                      </tr>
                      <tr> 
                        <td height="22" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="32" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">Assist 
                            the client to select the services that would be most 
                            helpful to them.</div></td>
                      </tr>
                      <tr> 
                        <td bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="32" colspan="3" bgcolor="ECF9FF" class="bodytext"><div align="justify">Ask 
                            how you can help them</div></td>
                      </tr>
                      <tr> 
                        <td height="13" align="center" valign="middle" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td colspan="3" rowspan="2" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">Agree 
                            with the client how they will access the selected 
                            services and make the necessary arrangements to facilitate 
                            this. If the client is required to complete any documentation 
                            prior to a guidance interview ensure this is done. 
                            If the client is required to bring copies of CV&#8217;s 
                            ect ensure the client is aware of this.</div></td>
                      </tr>
                      <tr> 
                        <td height="40" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="13" align="center" valign="middle" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td colspan="3" rowspan="2" valign="middle" bgcolor="ECF9FF" class="bodytext"><div align="justify">If 
                            the client has attended for pre-booked appointment 
                            and it has been delayed or cancelled, explain the 
                            reason for this to the client. If the appointment 
                            has been cancelled offer another appointment, at a 
                            date and time convenient to the client.</div></td>
                      </tr>
                      <tr> 
                        <td height="32" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22"  class="personal"colspan="4" bgcolor="F9FBEB" style=" border-top : 1px solid #E6ECB6;"><div align="justify">&nbsp;If 
                            appropriate, explain your relationship to the Outreach 
                            site </div></td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4"  class="subheading" bgcolor="ECF9FF" style=" border-top : 1px solid #E6ECB6;">&nbsp;Advice 
                          Contact</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="32" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="32" colspan="3" bgcolor="ECF9FF" class="bodytext">Explain 
                          our policy on confidentially, client records and why 
                          certain information is required.</td>
                      </tr>
                      <tr> 
                        <td height="32" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="32" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Ask 
                          the client to explain their situation and outline why 
                          they have come to see you and what they hope to gain 
                          from the contact. 
                          <div align="justify"> </div></td>
                      </tr>
                      <tr> 
                        <td height="34" valign="middle" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="34" colspan="3" bgcolor="ECF9FF" class="bodytext">Assist 
                          the client to explore their situation further and identify 
                          their needs by using open questions, prompts, active 
                          listening skills and positive body language. </td>
                      </tr>
                      <tr> 
                        <td height="22" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="22" colspan="3" bgcolor="ECF9FF" class="bodytext">Listen 
                          and respond to the client&#8217;s questions promptly 
                          .</td>
                      </tr>
                      <tr> 
                        <td height="21" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="21" colspan="3" bgcolor="ECF9FF" class="bodytext">Be 
                          aware of the client&#8217;s language and aim to respond 
                          in an appropriate language level and style.</td>
                      </tr>
                      <TR> 
                        <td height="21" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="21" colspan="3" bgcolor="ECF9FF" class="bodytext">Assist 
                          the client to identify and explain what is most important 
                          to them in regard to their future </td>
                      </TR>
                      <tr> 
                        <td height="32" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="32" colspan="3" bgcolor="ECF9FF" class="bodytext">Present 
                          information to the client in an appropriate way- verbal 
                          or written, books, leaflets, ICT.</td>
                      </tr>
                      <tr> 
                        <td height="50" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="50" colspan="3" bgcolor="ECF9FF" class="bodytext">Check 
                          the client understands the information presented and 
                          that it is sufficient. If necessary and available, use 
                          alternative sources of information.</td>
                      </tr>
                      <tr> 
                        <td height="37" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="37" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">If 
                          information is not available, agree to undertake resource 
                          on behalf of the client or signpost the client to other 
                          information resources.</td>
                      </tr>
                      <tr> 
                        <td height="29" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="29" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">If 
                          appropriate, provide the client with a copy of written 
                          information. If the information is Reference Only either:</td>
                      </tr>
                      <tr> 
                        <td height="21" bgcolor="ECF9FF"><div align="center"></div></td>
                        <td height="21" colspan="3" bgcolor="ECF9FF" class="bodytext">:: 
                          Make a photocopy</td>
                      </tr>
                      <tr> 
                        <td height="47" bgcolor="ECF9FF"><div align="center"></div></td>
                        <td height="47" colspan="3" bgcolor="ECF9FF" class="bodytext">:: 
                          Arrange to forward a copy. In this case, you must comply 
                          with our policy, which is to post information within 
                          3 working days of the request. </td>
                      </tr>
                      <tr> 
                        <td height="37" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="37" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">If 
                          appropriate, sign post the client to other information 
                          contacts and/or introduce them to other resources in 
                          the information Point.</td>
                      </tr>
                      <tr> 
                        <td height="28" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="28" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Discuss 
                          the information provided with the client. Relate it 
                          to the client&#8217;s needs.</td>
                      </tr>
                      <tr> 
                        <td height="31" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="31" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Assist 
                          the client to identify the implications of the information 
                          on their decision making and next steps.</td>
                      </tr>
                      <tr> 
                        <td height="42" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="42" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Identify 
                          if further specialist support is required. If so, research 
                          and select appropriate referral agencies, discuss these 
                          with the client, make the referral and complete and 
                          provide the client with a Referral Form.</td>
                      </tr>
                      <tr> 
                        <td height="58" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="58" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Ask 
                          the client if he/she requires any further assistance 
                          or services<br>
                          If yes, either provide those services or make the necessary 
                          arrangements for the client to access those services, 
                          or make a referral to an appropriate agency-if you make 
                          an appointment ensure it is at a time/venue convenient 
                          to the client.</td>
                      </tr>
                      <tr> 
                        <td height="35" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="35" colspan="3" bgcolor="ECF9FF" class="bodytext">Explain 
                          to the client how they may contact the service in the 
                          future</td>
                      </tr>
                      <tr> 
                        <td height="47" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="47" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Explain 
                          the Client Information Sheet to the client and ask him/her 
                          to complete., sign and date it. Use the Notes section 
                          to record a summary of the key advice or information 
                          points provided.</td>
                      </tr>
                      <tr> 
                        <td height="65" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="65" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Explain 
                          our aim to gather feedback form users of our services. 
                          Invite the client to complete a client feedback form 
                          and explain that feedback can be given anonymously. 
                          If the client agrees, give them an Advice Client Feedback 
                          Form and a SAE. Ask them to complete the form, place 
                          it in the envelope and either post it back or leave 
                          it in the box provided.</td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4"  class="subheading" bgcolor="ECF9FF" >&nbsp;Guidance 
                          Contact</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="32" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="32" colspan="3" bgcolor="ECF9FF" class="bodytext">Explain 
                          our policy on confidentially, client records and why 
                          certain information is required.</td>
                      </tr>
                      <tr> 
                        <td height="20" align="center" valign="middle" bgcolor="ECF9FF"><img src="images/bullet.jpg" width="5" height="5"> 
                          <div align="center"></div></td>
                        <td colspan="3" rowspan="2" valign="top" bgcolor="ECF9FF" class="bodytext"><div align="justify">Ask 
                            the client to explain their situation and outline 
                            why they have come to se you and what they hope to 
                            gain from the contact. </div></td>
                      </tr>
                      <tr> 
                        <td height="32" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      
                      <tr> 
                        <td height="33" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="33" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Explain 
                          how the interview may be structured and what kind of 
                          things may be discussed. Agreed a contract/agenda for 
                          the interview with the client, based on their needs</td>
                      </tr>
                      <tr> 
                        <td height="30" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="30" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Assist 
                          the client to explore their situation further and identify 
                          their needs and interest, in more depth, by using open 
                          questions, prompts, active listening skills and positive 
                          body language.</td>
                      </tr>
                      <tr> 
                        <td height="26" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="26" colspan="3" bgcolor="ECF9FF" class="bodytext">Listen 
                          and respond to the client&#8217;s questions promptly.</td>
                      </tr>
                      <TR> 
                        <td height="21" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="21" colspan="3" bgcolor="ECF9FF" class="bodytext">Be 
                          aware of the client&#8217;s language and aim to respond 
                          in an appropriate language level and style. </td>
                      </TR>
                      <tr> 
                        <td height="32" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="32" colspan="3" bgcolor="ECF9FF" class="bodytext">Assist 
                          the client to identify and explain what is most important 
                          to them in regard to their future.</td>
                      </tr>
                      <tr> 
                        <td height="34" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="34" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Assist 
                          the client to explore a range of options and consider 
                          alternatives by presenting information to the client 
                          in an appropriate way-verbal or written, books leaflets, 
                          ICT.</td>
                      </tr>
                      <tr> 
                        <td height="37" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="37" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Check 
                          the client understands the information presented and 
                          that it is sufficient. If necessary and available, use 
                          alternative sources of information.</td>
                      </tr>
                      <tr> 
                        <td height="38" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="38" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">If 
                          information is not available, agree to undertake research 
                          on behalf of the client or signpost the client to other 
                          information resources</td>
                      </tr>
                      <tr> 
                        <td height="29" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="21" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">If 
                          appropriate, provide the client with a copy of written 
                          information. If the information is Reference Only either:</td>
                      </tr>
                      <tr> 
                        <td height="36" bgcolor="ECF9FF"><div align="center"></div></td>
                        <td height="36" colspan="3" bgcolor="ECF9FF" class="bodytext">:: 
                          Make a photoc<span class="bodytext">o</span>py</td>
                      </tr>
                      <tr> 
                        <td height="36" bgcolor="ECF9FF"><div align="center"></div></td>
                        <td height="36" colspan="3" bgcolor="ECF9FF" class="bodytext">:: 
                          Arrange to forward a copy. In this case, you must comply 
                          with our policy which is to post information within 
                          3 working days of the request.</td>
                      </tr>
                      <tr> 
                        <td height="37" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="37" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">If 
                          appropriate, signpost the client to other information 
                          contacts and/or introduce them to other resources in 
                          the information Point. </td>
                      </tr>
                      <tr> 
                        <td height="21" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="21" colspan="3" bgcolor="ECF9FF" class="bodytext">Discuss 
                          the information provided with the client. Related it 
                          to the client&#8217;s needs </td>
                      </tr>
                      <tr> 
                        <td height="27" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="27" colspan="3" bgcolor="ECF9FF" class="bodytext">Assist 
                          the client to identify the implications of the information 
                          on their decision making and next steps.</td>
                      </tr>
                      <tr> 
                        <td height="42" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="42" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Assist 
                          the client to make decisions, identify the next action 
                          they need to take and how to they may do this.</td>
                      </tr>
                      <tr> 
                        <td height="35" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="35" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Identify 
                          if further specialist support is required. If so research 
                          and select appropriate referral agencies, discuss these 
                          with the client, make the referral and complete and 
                          provide the client with a Referral Form. </td>
                      </tr>
                      <tr> 
                        <td height="31" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="31" colspan="3" bgcolor="ECF9FF" class="bodytext">Explain 
                          the client how they may contact the service in the future</td>
                      </tr>
                      <tr> 
                        <td height="35" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="35" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Explain 
                          the Client Information Sheet to the client and ask him/her 
                          to complete, sign and date it. Use the Notes section 
                          to record a summary of key advice or information points 
                          provided.</td>
                      </tr>
                      <tr> 
                        <td height="35" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="35" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Provide 
                          the client with a summary of the decisions discussed 
                          and action steps identified and agreed.</td>
                      </tr>
                      <tr> 
                        <td height="63" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="63" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Explain 
                          our aim to gather feedback from users of our services. 
                          Invite the client to complete a client feedback form 
                          and explain that the feedback can be given anonymously. 
                          If the client agrees, give them an Advice Client Feedback 
                          Form and a SAE. Ask them to complete the form, place 
                          it in the envelope and either post it back or leave 
                          it in the box provided.</td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="4"  class="subheading" bgcolor="ECF9FF" >&nbsp;Staff 
                          Competence</td>
                      </tr>
                      <tr> 
                        <td colspan="4" bgcolor="ECF9FF" style="border-top : 1px solid #84D0FF;">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="60" valign="top" bgcolor="ECF9FF"><div align="center"><img src="images/bullet.jpg" width="5" height="5"></div></td>
                        <td height="65" colspan="3" valign="top" bgcolor="ECF9FF" class="bodytext">Explain 
                          our aim to gather feedback form users of our services. 
                          Invite the client to complete a client feedback form 
                          and explain that feedback can be given anonymously. 
                          If the client agrees, give them an Advice Client Feedback 
                          Form and a SAE. Ask them to complete the form, place 
                          it in the envelope and either post it back or leave 
                          it in the box provided.</td>
                      </tr>
                      <tr> 
                        <td colspan="4" valign="top" bgcolor="ECF9FF">&nbsp;</td>
                      </tr>
                      <tr bgcolor="ECF9FF"> 
                        <td colspan="4" class="bodytext"><div align="justify">Career 
                            Paths Online Team will review this policy on an annual 
                            basis<br>
                            Issue No.1<br>
                            Dated: August 2005<br>
                            Revision Date: July 2006 <br>
                          </div></td>
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
