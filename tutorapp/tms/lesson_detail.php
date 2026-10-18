<?php
include_once 'dbConnection.php';
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
	$sqlselect="select * from cpo_lessons_new where I_lid =".$_GET['id'];
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
		$result_info = mysqli_fetch_array($result_info);
	}
	//get subject and tutor anem
	//$sql_us = "select sb.iSubjectId,um.iUserId,us.I_studentid ,um.vUserName,sb.vSubjectName from  cpo_user_subject as us, cpo_subjectmaster  as sb, cpo_usermaster as um  where   us.I_user_subid  =".$result_info['I_user_subjectid']." and us.I_studentid =um.iUserId  and sb.iSubjectId =us.I_subjectid";
	//$res_us = runquery1($sql_us);
	//$fet_us = mysqli_fetch_array($res_us);
	//check from cpo_user_leason
	//get subject and tutor name
	$sql_subject="select vSubjectName from cpo_subjectmaster where iSubjectId=".$result_info["I_sid"];
	$sql_sub = runquery1($sql_subject);
	$sub_res = mysqli_fetch_array($sql_sub); 
	$sql_tutor="select vUserName from cpo_usermaster where iUserId=".$_SESSION['user_id'];
	//echo $sql_tutor;
	$sql_tut = runquery1($sql_tutor);
	$tut_res = mysqli_fetch_array($sql_tut); 
	//$sql_lsn = "select *  from  cpo_user_lesson   where   I_lesson=".$_GET['id'];
	//$res_lsn = runquery1($sql_lsn);
	 //$num_lsn= $res_lsn ? mysqli_num_rows($res_lsn) : 0;
	//if($num_lsn > 0)
	//{	$fet_lsn = mysqli_fetch_array($res_lsn);
	//}
	
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
<title><?php echo sitename;?>Lesson Detail View</title><body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
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
	<tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext" align="center" colspan="3"><b>&nbsp;<?php echo ucfirst($sub_res['vSubjectName']);?>  : : &nbsp;<?php echo ucfirst($tut_res['vUserName']);?></b></td>
              </tr> 
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"  colspan="3"><?php $date12 =explode('-',$fet_lsn['D_date']); if($date12[0] != '' && $date12[1] != '' && $date12[2] !=''){$date = $date12[0]."-". $date12[1]."-". $date12[2];}?><?php=$date?></td>
              
              </tr>
			  <tr> 
			  	<td class="bodytext"><b>Lesson ID/Name</b></td>
                <td height="22" class="bodytext" align="left" colspan="2"><?php echo ucfirst($result_info['I_lid']); ?> -  <?php echo ucfirst($result_info['V_name']);?></td>
              </tr> 
			   <tr> 
                <td width="22%" class="bodytext"><b>Lesson Description:</b></td>
                <td colspan="2" class="bodytext">&nbsp;<?php echo ucfirst($result_info['T_desc']);?></td>
              </tr>
				<?php $sqlfiles = "select * from cpo_uploadfilestutor where iFileId=".$result_info['I_lesson_fid'];
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 ) { 		
				    while($rsdata = mysqli_fetch_array($rsfiles)){ 
						$ext = substr(strrchr($rsdata['vFilePath'], '.'), 1);
						$path = "../tms/upload/".$_SESSION['user_id']."/".$rsdata['vFilePath'];
				?> 
					<tr>
					 	<td class="bodytext"><b>File:</b></td>
						<td class="bodytext"><font color="#FF0000"><a target="_blank" href="<?php echo $path?>" title="Download File for Lesson"><?php echo $rsdata['vFilePath'];?></a></font></td>		
						<td class="bodytext" align="center"><a target="_blank" href="<?php echo $path?>" title="Download File for Lesson"><img border="0`"src="<?php echo getIcon($rsdata['vFilePath'])?>"></a></td>
					</tr> 
                <?php } // end while
				} else { ?>
					<tr> <td colspan="3" class="bodytext">No File Uploaded for this Lesson </td> </tr>
				<?php } //end if else ?> 
			<tr>		
				<td class="bodytext"><b>Date:</b></td>
				<td class="bodytext" colspan="2"><?php echo $result_info['D_date'] ?></td>
			 </tr>
			 <tr>
			 	<td class="bodytext"><b>Date Due</b>:</td>
				<td class="bodytext" colspan="2"><?php echo $result_info['D_duedate'] ?></td>
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