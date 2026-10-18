<script language="JavaScript">
function chatnow()
{
	new1=window.open("../chatnew/","","titlebar='My Digital Future - Chatting',height=460,width=700,scrollbars=yes,top=50,left=150");
}
function downloadfile()
{
	fname = "Course_Evaluation_Questionnaire.doc";
//	new1=window.open("../download.php?id="+fname,"","titlebar='My Digital Future - Chatting","menubar=1,height=475,width=775,scrollbars=yes,top=50 left=150");
	new1=window.open("../download.php?id="+fname);
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" >
  <tr> 
    <td height="21" colspan="3" background="images/logo_bg.jpg" class="career"><div align="center">My Digital Future</div></td>
  </tr>
  <tr> 
    <td width="100%" background="images/navig_center_bg1.jpg">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="76%" height="23" align="center"><div align="right"><a class="sidemainlink" href="../index.php"><img src="../images/home_icon.gif" height="18" border="0" alt="Home"></a></div></td>
		<td width="24%" align="center"><a class="sidemainlink" href="index.php"><img src="../images/myacount_icon.gif" border="0" alt="My Account" height="18"></a></td>
	</tr></table>
	</td>
  </tr>
  <tr > 
    <td height="34" colspan="3" background="images/personalinfo_bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="19%" height="20">&nbsp;</td>
          <td width="81%" height="20" class="personal">Personal Information</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="59" colspan="3"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;" class="normaltext"> 
            Edit Member Info</td>
        </tr>
		 <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="EditMember.php?mode=personal">Personal 
            Information</a></td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="EditMember.php?mode=quali">Qualification</a></td>
        </tr>
        <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="ChangePass.php">Change 
            Password</a></td>
        </tr>
        <tr> 
          <td height="22" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="AccountSummary.php">Account 
            Summary</a> </td>
        </tr>
        <tr> 
          <td height="22" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="AddCourses.php">Add Courses</a></td>
        </tr>
      </table></td>
  </tr>
  <tr >
    <td height="36" colspan="3" background="images/personalinfo_bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="19%" height="20">&nbsp;</td>
          <td width="81%" height="20" class="personal">My E-Portfolio</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="22" colspan="3"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
	   <? 
	$page = substr(strrchr($_SERVER['PHP_SELF'],'/'),1);
	if($page == 'editpinfo.php')
	{?>
	<tr>
          <td width="17%" class="sidelinkac"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" class="sidelinkac" style="border-bottom : 1px solid  #D6D6D6;"><font class="normaltext"><b>Personal Information</b></font></td>
        </tr>
	<? } else
	{?>
	 <tr>
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="editpinfo.php"><b>Personal Information</b></a></td>
        </tr>
	
	<? }  
	if($page == 'viewsubject.php')
	{?>
	<tr>
          <td width="17%" class="sidelinkac"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" class="sidelinkac" style="border-bottom : 1px solid  #D6D6D6;"><font class="normaltext"><b>Subjects</b></font></td>
        </tr>
	<? } else
	{?>
	 <tr>
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="viewsubject.php"><b>Subjects</b></a></td>
        </tr>
	
	<? }
	if($page == 'sub_lesson.php')
	{?>
	<tr>
          <td width="17%" class="sidelinkac"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" class="sidelinkac" style="border-bottom : 1px solid  #D6D6D6;"><font class="normaltext"><b>Lessons</b></font></td>
        </tr>
	<? } else
	{?>
	 <tr>
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="sub_lesson.php"><b>Lessons</b></a></td>
        </tr>
	
	<? }if($page == 'viewhw.php')
	{?>
	<tr>
          <td width="17%" class="sidelinkac"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" class="sidelinkac" style="border-bottom : 1px solid  #D6D6D6;"><font class="normaltext"><b>Homework</b></font></td>
        </tr>
	<? } else
	{?>
	 <tr>
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="viewhw.php"><b>Homework</b></a></td>
        </tr>
	
	<? }
	if($page == 'personaldev.php')
	{?>
	<tr>
          <td width="17%" class="sidelinkac"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" class="sidelinkac" style="border-bottom : 1px solid  #D6D6D6;"><font class="normaltext"><b>Personal Development</b></font></td>
        </tr>
	<? } else
	{?>
	 <tr>
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="personaldev.php"><b>Personal Development</b></a></td>
        </tr>
	
	<? }?>
    <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="UploadFiles.php"><b>Upload Course Work</b></a></td>
        </tr>
        <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="DownFiles.php"><b>Download Course Work</b></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="36" colspan="3" background="images/personalinfo_bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="19%" height="20">&nbsp;</td>
          <td width="81%" height="20" class="personal">Interactive</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="22" colspan="3"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr> 
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"> 
            <a class="sidelink" href="admindownfiles.php">Document Download Centre</a></td>
        </tr>
        <tr> 
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"> 
            <a class="sidelink" href="interreactive.php">Interactive Course</a></td>
        </tr>
        <tr> 
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"> 
            <a class="sidelink" href="bookchattime.php">Book Chat Time</a></td>
        </tr>
        <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="javascript:chatnow();">Chat 
            Now</a></td>
        </tr>
			 	
        <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="sendmail.php">Send 
            Mail</a></td>
        </tr>
			 	
			 	<tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="Studentoperation.php">Event 
            History</a></td>
        </tr>
				<tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"  class="normaltext">Job</td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="ViewSuggestJob.php">View 
            Suggested Job</a></td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="ActionSuggestJob.php">Job 
            Action </a></td>
        </tr>
        <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"  class="normaltext">Learner 
            Log Book</td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="StudentLogBook.php">Add 
            Learner Log</a></td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="ViewStudentLogBook.php">View 
            Learner Log</a></td>
        </tr>
		    <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;" class="normaltext">Individual 
            Learning Plan</td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="GetAssignPlan.php">Download</a></td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="UploadPlan.php">Upload</a></td>
        </tr>
        <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;" class="normaltext">Individual Learning Review</td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="GetAssignReview.php">Download</a></td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="AssignReview.php">Upload</a></td>
        </tr>
        <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="Grievance.php">Grievance 
            Form </a> </td>
        </tr>
		 		<tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="javascript:downloadfile();">Evaluation Questionnaire</a></td>
        </tr>
				
      <!--  <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;" class="normaltext">Individual Learning Review</td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="GetAssignReview.php">Download</a></td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="#">Upload</a></td>
        </tr>
        <tr> 
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;" class="normaltext">Individual 
            Learning Plan</td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="#">Download</a></td>
        </tr>
        <tr> 
          <td width="17%" bgcolor="#F1F1F1"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;</td>
          <td width="83%" height="20" bgcolor="#F1F1F1" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="#">Upload</a></td>
        </tr>-->
      </table></td>
  </tr>
  <tr> 
    <td height="36" colspan="3" background="images/personalinfo_bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="19%" height="20">&nbsp;</td>
          <td width="81%" height="20" class="personal">Resources</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="22" colspan="3"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"> 
            <a class="sidelink" href="#">Sample Link 1</a></td>
        </tr>
        <tr> 
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2"  style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="../CareerPathsIntroductionHandbook.pdf">Induction 
      Pack</a></td>
  </tr>
  <tr>
    <td height="22" colspan="3" bgcolor="#DEF2D2" style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="procedures.php">Complaint 
                  Procedures</a></td>
  </tr>
  <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2" style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="disability_policy.php">Disability 
      Policy</a> </td>
  </tr>
  <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2" style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="equal_opportunity.php">Equal 
      Opportunity</a></td>
  </tr>
  <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2" style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="terms_conditions.php">Terms 
      & Conditions</a></td>
  </tr>
  <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2" style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="mission_statements.php">Mission Statements</a></td>
  </tr>  
  <tr> 
    <td colspan="3" class="personal" style="border-bottom : 1px solid  #ffffff;"><font size="1">&nbsp;</font></td>
  </tr>
  <tr> 
    <td height="22" colspan="3" class="personal" style="border-bottom : 1px solid  #ffffff;"><a href="../forum/"><img src="images/shareyorth_img.jpg" width="198" height="68" border="0"></a></td>
  </tr>
</table>