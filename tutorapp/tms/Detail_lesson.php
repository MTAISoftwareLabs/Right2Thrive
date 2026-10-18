<?php
include_once 'dbConnection.php';
//lesson id sent for summary

function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "../lms/images/swf.gif";
			break;
		case "doc" : 
			return "../lms/images/doc.gif";
			break;			
		case "jpg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "peg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "gif" : 
			return "../lms/images/gif.gif";
			break;			
		case "pdf" : 
			return "../lms/images/pdf.gif";								
			break;
		case "ppt" : 
			return "../lms/images/ppt.gif";	
			break;			
		case "avi" : 
			return "../lms/images/avi.gif";								
			break;
		case "mpg" : 
			return "../lms/images/mpeg.gif";								
			break;
		default : 
			return "../lms/images/gif.gif";				
			break;			
	}
}

if(isset($_GET['id']))
{
	$sqlselect="select * from cpo_user_lesson where I_ulid =".$_GET['id'];
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
		$result_info = mysqli_fetch_array($result_info);
	}
	//get all the lesson information
	$sql_les = "select * from cpo_lessons_new where I_lid=".$result_info['I_lesson'];
	$res_les = runquery1($sql_les);
	$fet_les = mysqli_fetch_array($res_les);
	
	//need more error checking in here and more efficient sql
	//get tutor and subject information
	$sql_subject="select sm.vSubjectName, us.V_sublevel from cpo_subjectmaster as sm, cpo_user_subject as us where sm.iSubjectId=".$fet_les['I_sid']." and sm.iSubjectId = us.I_subjectid and us.I_studentid =".$result_info['I_userid'];
	//echo $sql_subject;
	$sql_sub = runquery1($sql_subject);
	$sub_res = mysqli_fetch_array($sql_sub);
	$subject = $sub_res['vSubjectName']; 
	$subject_level = $sub_res['V_sublevel'];
	
	$sql_tutor="select vUserName from cpo_usermaster where iUserId=".$fet_les['I_tid'];
	//echo $sql_tutor;
	$sql_tut = runquery1($sql_tutor);
	$tut_res = mysqli_fetch_array($sql_tut); 
	$tutor = $tut_res['vUserName'];
	
	$sql_stud="select vUserName from cpo_usermaster where iUserId=".$result_info['I_userid'];
	$sql_s = runquery1($sql_stud);
	$s_res = mysqli_fetch_array($sql_s);
	$student = $s_res['vUserName']; 
	
}
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
<title><?php echo sitename;?>Lesson Summary - Detail View</title><body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="10" colspan="4"><img src="../admin/images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr valign="top"> 
    <td height="35" colspan="4"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>CareerPaths Online</strong></font></td>
  </tr>
  <tr> 
    <td colspan="4"><img src="../admin/images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td background="../admin/images/coupons3.jpg" class="flipv"><img src="../admin/images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../admin/images/coupons3.jpg" class="flipv"><img src="../admin/images/coupons3.jpg" width="5" height="5"></td>
    <td background="../admin/images/coupons3.jpg" class="flipv"><div align="right"><img src="../admin/images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        <tr> 
			<td></td>
          <td width="63%" valign="top"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><b></b></font></td>
          <td width="2%" valign="top"><div align="right"><a href="javascript:print();"><img src="../admin/images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
          <td width="20%" valign="top"><div align="center"><a href="javascript:print();">Print this Page</a>&nbsp;&nbsp;</div></td>
        </tr>
        <tr> 
          <td colspan="4">
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
              <tr> 
                <td height="22" class="bodytext" align="center" colspan="4"><b>&nbsp;<?php echo ucfirst($fet_les['V_name']);?> &nbsp;:&nbsp;&nbsp;<?php echo ucfirst($student);?></b></td>
              </tr>
			   
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"  colspan="4"><?php $date12 =explode('-',$fet_lsn['D_date']); if($date12[0] != '' && $date12[1] != '' && $date12[2] !=''){$date = $date12[0]."-". $date12[1]."-". $date12[2];}?><?php=$date?></td>
              
              </tr>
			  
			   <tr bgcolor="#FFFFFF"> 
                <td width="23%" height="22" class="bodytext"><b>Learner Name:</b></td>
                <td width="27%" height="22" class="bodytext">&nbsp;<?php echo ucfirst($student);?></td>
				<td width="23%" class="bodytext"><b>Subject:</b></td>
				<td width="27%" class="bodytext"><?php echo ucfirst($subject);?></td>
              </tr>
			  <tr bgcolor="#FFFFFF">
			  	<td height="22" class="bodytext"><b>Tutor Name:</b></td>
				<td height="22" class="bodytext"><?php echo ucfirst($tutor); ?></td>
				<td class="bodytext"><b>Level:</b> </td>
				<td class="bodytext"><?php echo ucfirst($subject_level); ?></td>
			 </tr>
			 <tr bgcolor="#FFFFFF">
			 	<td class="bodytext"><b>Lesson Name:</b></td>
				<td class="bodytext" colspan="3"><?php echo $fet_les['V_name']; ?></td>
			 </tr>
			 <tr bgcolor="#FFFFFF">
			    <td class="bodytext"><b>Lesson Description:</b></td>
				<td class="bodytext" colspan="3"><?php echo $fet_les['T_desc']; ?></td>
			 </tr>
			 <tr bgcolor="#FFFFFF">
			 	<td class="bodytext"><b>Date Due:</b></td>
				<td class="bodytext"><?php echo $fet_les['D_duedate']; ?></td>
				<td class="bodytext"><b>Submission Date </b></td>
				<td class="bodytext"><?php echo $result_info['D_date']; ?></td>
			</tr>
			
			<?php  if ($result_info['iLesson_fid'] != 0) {
					$sqlfiles = "select * from cpo_uploadfilesstudent where iFileId=".$result_info['I_lesson_fid'];
					$rsfiles = runquery($sqlfiles);
					$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
					if ( $num > 0 ) { 		
				    	while($rsdata = mysqli_fetch_array($rsfiles)){ 
							$ext = substr(strrchr($rsdata['vFilePath'], '.'), 1);
							$path = "../lms/upload/".$student."/".$rsdata['vFilePath'];
				?> 
					<tr>
					 	<td class="bodytext"><b>File Uploaded by Student:</b></td>
						<td class="bodytext" colspan="2"><font color="#FF0000"><a target="_blank" href="<?php echo $path?>" title="Download File for Lesson"><?php echo $rsdata['vFilePath'];?></a></font></td>		
						<td class="bodytext" align="center"><a target="_blank" href="<?php echo $path?>" title="Download File for Lesson"><img border="0`"src="<?php echo getIcon($rsdata['vFilePath'])?>"></a></td>
					</tr> 
                <?php } // end while
				}
				} else { ?>
					<tr> <td colspan="4" class="bodytext">No File Uploaded for this Lesson </td> </tr>
				<?php } //end if else ?> 
				
				
			 <tr>
			    <td class="bodytext">
			    <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><strong>What did you learn? </strong>&nbsp;&nbsp;</td>
				<td class="bodytext" colspan="3">&nbsp;<?php  echo ucfirst($result_info['T_didulearn']); ?></td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td height="22"class="bodytext" nowrap="nowrap"><strong>Did you enjoy the lesson?</strong></td>
				 <td height="22" class="bodytext" colspan="3">&nbsp;<?php  echo $result_info['T_enjoy']; ?></td>
				 
              </tr>
              <?php if($result_info['T_enjoy'] == 'No') {?>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><strong>If no, please explain why</strong></td>
				 <td height="22" valign="top" class="bodytext" colspan="3">&nbsp;<?php  echo ucfirst($result_info['T_reason']);?></td>
              </tr>
			  <?php }?>
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right">&nbsp;<img src="../admin/images/closebutton.gif" onClick="javascript:window.close();" style="cursor:hand"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="../admin/images/coupons3.jpg"><img src="../admin/images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../admin/images/coupons3.jpg"><img src="../admin/images/coupons3.jpg" width="5" height="5"></td>
    <td background="../admin/images/coupons3.jpg"><div align="right"><img src="../admin/images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>