<?php
include_once 'dbConnection.php';
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d-m-Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}
if(isset($_GET['id']))
{
	$sqlselect="select s.iLogId,s.iStudentId,t.vUserName,s.dEntryDate,s.vAreaCovered,s.vSkillAchieved,s.vProblemEncounter,s.vSuggestion,s.iIsSatisfied,sm.vSubjectName from cpo_studentlogbook s,cpo_usermaster t,cpo_subjectmaster sm where s.iTutorId = t.iUserId and s.iSubjectId = sm.iSubjectId and s.iStudentId and s.iLogId=".$_GET['id'];
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
<link href="../admin/css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/css_styles.css" rel="stylesheet" type="text/css">
<title>Student Log Book - Detail View - Careerpaths Online</title>
<body topmargin="0">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr> 
    <td colspan="4"><img src="images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td background="images/coupons3.jpg" class="flipv"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="images/coupons3.jpg" class="flipv"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td background="images/coupons3.jpg" class="flipv"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        
		<tr><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
              <tr> 
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                      <td width="417" class="headingtd"> Lesson Detail</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			 <tr> 
			<td width="85%"  colspan="2" valign="top" class="headingtd" style="padding-right:10px" align="right"><div align="right"><a href="javascript:print();"><img src="../admin/images/print_this_page.jpg" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="javascript:print();">Print this Page</a>&nbsp;&nbsp;</div></td>
        </tr>
		   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			              <tr > 
                <td height="22" class="bodytext"><b>Learner Name</b></td>
                <td height="22" class="bodytext">&nbsp;<?php 
															$fetchname="select * from cpo_usermaster where iUserId=".$result_info['iStudentId'];
															$resultfetchname=runquery1($fetchname);
															$name=mysqli_result($resultfetchname,0,1);
															echo $name; ?></td>
              </tr>
			  <tr> 
                <td height="22" class="bodytext"><b>Tutor's Name</b></td>
                <td height="22" class="bodytext">&nbsp;<?php echo $result_info['vUserName']; ?></td>
              </tr>
              <?php
						?>
              <tr > 
                <td width="27%" height="22" class="bodytext"><strong>Subject</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo $result_info['vSubjectName'];?></td>
              </tr>
              <tr> 
                <td width="27%" height="22" class="bodytext"><strong>Date of Entry</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo gdate($result_info['dEntryDate']);?></td>
              </tr>
              <tr > 
                <td height="22" colspan="2" class="bodytext"><strong>Area Covered</strong>&nbsp;</td>
              </tr>
              <tr> 
                <td height="22" colspan="2" class="bodytext"><?php echo $result_info['vAreaCovered'];?></td>
              </tr>
              <tr > 
                <td height="22" colspan="2" class="bodytext"><strong>Skill Achieved</strong>&nbsp;</td>
              </tr>
              <tr > 
                <td height="22" colspan="2" valign="top" class="bodytext"><?php echo $result_info['vSkillAchieved'];?></td>
              </tr>
              <tr> 
                <td height="22" colspan="2" valign="top" class="bodytext"><strong>Problems 
                  Encountered</strong>&nbsp;</td>
              </tr>
              <tr > 
                <td height="22" class="bodytext" colspan="2"><?php echo $result_info['vProblemEncounter'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext" colspan="2"><strong>Was the subject 
                  taught to your satisfaction ?</strong></td>
              </tr>
              <tr > 
                <td height="22" colspan="2" class="bodytext"> 
                  <?php if($result_info['iIsSatisfied']){ echo 'Yes';}else{ echo 'No';}?>
                </td>
              </tr>
              <tr > 
                <td height="22" colspan="2" class="bodytext"><strong>If no please 
                  explain below why and how you think we can improve the course 
                  ?</strong>&nbsp;</td>
              </tr>
              <tr > 
                <td height="22" colspan="2" class="bodytext"><?php echo $result_info['vSuggestion'];?></td>
              </tr>

              <td colspan="2" height="2%">&nbsp;</td>
            </table></td></tr>
        <tr> 
          <td colspan="2"><div align="right"><img src="images/close.gif"  onClick="javascript:window.close();" style="cursor:hand"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="images/coupons3.jpg"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="images/coupons3.jpg"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td background="images/coupons3.jpg"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>
 
</table>

