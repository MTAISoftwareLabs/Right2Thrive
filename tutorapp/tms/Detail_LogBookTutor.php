<?php
include_once 'dbConnection.php';

if(isset($_GET['id']))
{
//	echo $_GET['id'];
//	$sqlselect="select s.iLogId,t.vUserName,s.dEntryDate,s.vAreaCovered,s.vSkillAchieved,s.vProblemEncounter,s.vSuggestion,s.iIsSatisfied,sm.vSubjectName from cpo_studentlogbook s,cpo_usermaster t,cpo_subjectmaster sm where s.iTutorId = t.iUserId and s.iSubjectId = sm.iSubjectId and s.iStudentId and s.iLogId=".$HTTP_GET_VARS['id'];
	$sqlselect="select s.iLogId,t.vUserName,s.dEntryDate,s.vAreaCovered,s.vSkillAchieved,s.vProblemEncounter,s.vSuggestion,s.iIsSatisfied,sm.vSubjectName from cpo_tutorlogbook s,cpo_usermaster t,cpo_subjectmaster sm where s.iStudentId = t.iUserId and s.vSubject = sm.iSubjectId and s.iLogId=".$HTTP_GET_VARS['id'];	
//	echo $sqlselect; exit;	
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
		$result_info = mysqli_fetch_array($result_info);
	//}
?>
<style>
.bothfeatured3
{
	border-left:1px solid #88B4F9;
	border-right:1px solid #88B4F9;	
}
.flipv {
	FILTER: FlipV();
}
</style>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/css_styles.css" rel="stylesheet" type="text/css">
<title><?php echo sitename;?>Learner Log Book By Tutor- Detail View</title><body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="10" colspan="4"><img src="../src/images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr valign="top"> 
    <td height="35" colspan="4"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>CareerPaths 
      Online</strong></font></td>
  </tr>
  <tr> 
    <td colspan="4"><img src="../src/images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td background="../images/coupons3.jpg" class="flipv"><img src="../images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../images/coupons3.jpg" class="flipv"><img src="../images/coupons3.jpg" width="5" height="5"></td>
    <td background="../images/coupons3.jpg" class="flipv"><div align="right"><img src="../images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        <tr> 
			<td></td>
          <td width="63%" valign="top"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><b></b></font></td>
          <td width="2%" valign="top"><div align="right"><a href="javascript:print();"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
          <td width="20%" valign="top"><div align="center"><a href="javascript:print();">Print this Page</a>&nbsp;&nbsp;</div></td>
        </tr>
        <tr> 
          <td colspan="4">
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Tutor's Name</b></td>
                <td height="22" class="bodytext">&nbsp;<?php echo $result_info['vUserName']; ?></td>
              </tr>
              <?php
						?>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Subject</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo $result_info['vSubjectName'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Date of Entry</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo gdate($result_info['dEntryDate']);?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Area Covered</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><?php echo $result_info['vAreaCovered'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Skill Achieved</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" valign="top" class="bodytext"><?php echo $result_info['vSkillAchieved'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" valign="top" class="bodytext"><strong>Problems 
                  Encountered</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext" colspan="2"><?php echo $result_info['vProblemEncounter'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext" colspan="2"><strong>Are you satisfied 
                  by your Learner ?</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"> 
                  <?php if($result_info['iIsSatisfied']){ echo 'Yes';}else{ echo 'No';}?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>If no please 
                  explain below why and how you think we can improve the Learner 
                  ?</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><?php echo $result_info['vSuggestion'];?></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><img src="images/closebutton.gif" onClick="javascript:window.close();" style="cursor:hand">&nbsp;&nbsp;</div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="../images/coupons3.jpg"><img src="../images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../images/coupons3.jpg"><img src="../images/coupons3.jpg" width="5" height="5"></td>
    <td background="../images/coupons3.jpg"><div align="right"><img src="../images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>

<?php
	}
}
?>