<?php
include_once 'dbConnection.php';

if(isset($_GET['id']))
{

	$sqlselect="select s.dDateCommenceCourse,s.dDateOfLession,s.dDateCompleteCourse,ut.vUserName as tutor,us.vUserName as student,s.vLearningOutcomes,sm.vSubjectName as subject 
	from cpo_studentinfo s,cpo_usermaster ut,cpo_usermaster us,cpo_subjectmaster sm 
	where s.iStudentId = us.iUserId and 
	s.iTutorId = ut.iUserId and 
	s.iSubjectId = sm.iSubjectId and s.iSinfoId=".$HTTP_GET_VARS['id'];	
	//echo $sqlselect;
	//exit;
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
		$result_info = mysqli_fetch_array($result_info);

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
<link href="../css/css_styles.css" rel="stylesheet" type="text/css">
<title><?php echo sitename;?>Learner Information - Detail View</title><body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="10" colspan="4"><img src="../images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr valign="top"> 
    <td height="35" colspan="4"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>CareerPaths 
      Online</strong></font></td>
  </tr>
  <tr> 
    <td colspan="4"><img src="../images/whiteimage.jpg" width="6" height="5"></td>
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
                <td height="22" class="bodytext">&nbsp;<?php echo $result_info['tutor']; ?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Learner's Name</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<?php echo $result_info['student'];?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Subject</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<?php echo $result_info['subject'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Date of Course Commence</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<?php echo gdate($result_info['dDateCommenceCourse']);?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Date of Lesson</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<?php echo gdate($result_info['dDateOfLession']);?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Date of Course Compelete</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<?php echo gdate($result_info['dDateCompleteCourse']);?></td>
              </tr>			  
			  
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Learning Outcomes</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><?php echo $result_info['vLearningOutcomes'];?></td>
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