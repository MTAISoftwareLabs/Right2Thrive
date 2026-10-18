<?php
include_once 'dbConnection.php';

if(isset($_GET['id']))
{
	$sqlselect="select * from cpo_homework where I_homeworkid =".$_GET['id'];
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
		$result_info = mysqli_fetch_array($result_info);
	}
	//get subject and tutor anem
	$sql_us = "select sb.iSubjectId,um.iUserId,us.I_studentid ,um.vUserName,sb.vSubjectName    from  cpo_user_subject as us, cpo_subjectmaster  as sb, cpo_usermaster as um  where   us.I_user_subid  =".$result_info['I_user_subjectid']." and us. I_tutorid  =um.iUserId  and sb.iSubjectId =us.I_subjectid";
	$res_us = runquery1($sql_us);
	$fet_us = mysqli_fetch_array($res_us);
	//check from cpo_user_leason
}
if(isset($_POST['hdn_submit']) && $_POST['hdn_submit'] == 1)
{

	$txttask	= $_POST['txttask'];
	$comment	= $_POST['txttcomments'];
	$insql = "update cpo_homework set T_Summary  ='".$comment."' where I_homeworkid =".$_GET['id'];
	$ininfo=runquery($insql);
	if($ininfo)
	{?>
		<script language="javascript">
		var subid = <? echo $_POST['sub_id'];?>;
		window.opener.location.href='viewhw.php?ct='+subid;
		window.close();
	</script>;
	<?  }
	else
	{
		$msg = "Sorry comment cannot be inserted";
		$flg = "red";
	}
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
<script language="JavaScript" src="../admin/calendar1.js"></script> 
<script type="text/javascript" language="javascript">
function validate()
{
	if(document.frmhw.txttcomments.value == '')
	{
		alert('Please enter your summary');
		document.frmhw.txttcomments.focus();
		return false;
	}
	<?php /*?><? if( $result_info['C_Completed'] == 'No') {?>
	if(document.frmhw.txttask.value == '')
	{
		alert('Please enter reason');
		document.frmhw.txttask.focus();
		return false;
	}
	<? }?><?php */?>
	return true;
}
</script>
<link href="../admin/css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/css_styles.css" rel="stylesheet" type="text/css">
<title><? echo sitename;?>Homework - Detail View</title><body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
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
		<form name="frmhw" method="post" action="" onSubmit="return validate()">
		<input type="hidden" name="hdn_submit" value="1">
		<input type="hidden" name="sub_id" value="<? echo $fet_us['iSubjectId']?>">
        <tr> 
          <td colspan="4">
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Subject  Name</b></td>
                <td height="22" class="bodytext">&nbsp;<? echo ucfirst($fet_us['vSubjectName']);?></td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Tutor  Name</b></td>
                <td height="22" class="bodytext">&nbsp;<? echo ucfirst($fet_us['vUserName']);?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Homework Title</b></td>
                <td height="22" class="bodytext">&nbsp;<? echo ucfirst($result_info['V_title']);?></td>
              </tr>
			     <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Assign Date</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $asign_date=gdate($result_info['D_assign_date']);?></td>
              </tr>
			     <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Due Date </strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $due_date = gdate($result_info['D_due_date']);?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Completed</strong></td>
                <td width="73%" height="22" class="bodytext"><? echo $result_info['C_Completed'] ;?></td>
              </tr>
			  <!-- <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Information about the homework task</strong></td>
              </tr>-->
              <!--<tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" valign="top" class="bodytext"><? if($result_info['T_htask'] !=''){echo $result_info['T_htask'] ;} else {?><textarea name="txttask" cols="60" rows="3"></textarea><? }?></td>
              </tr>-->
               <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Learner Comments</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" valign="top" class="bodytext"><? if($result_info['T_Summary'] !=''){echo $result_info['T_Summary'] ;} else {?><textarea name="txttcomments" cols="60" rows="3"></textarea><? }?></td>
              </tr>
			
			 
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Tutor Comments</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF" >
                <td height="22" colspan="2" valign="top" class="bodytext"><? echo $result_info['T_Feedback'] ;?></td>
              </tr>
	 <? if( $result_info['C_Completed'] == 'No') {?>
            <tr bgcolor="#FFFFFF" >  
                <td height="22" colspan="2" class="bodytext"><strong>Reason for not completing?</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF" > 
                <td height="22" colspan="2" valign="top" class="bodytext"><?=$result_info['T_whynot_reason']?></td>
              </tr>
			  <? }?>
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><? if($result_info['T_Summary'] != ''){  }else {?>
				<input type="image" src="../admin/images/submitbttn.jpg"><? }?>&nbsp;<img src="../admin/images/closebutton.gif" onClick="javascript:window.close();" style="cursor:hand"></div></td>
        </tr>
		</form>
      </table></td>
  </tr>
  <tr> 
    <td background="../admin/images/coupons3.jpg"><img src="../admin/images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../admin/images/coupons3.jpg"><img src="../admin/images/coupons3.jpg" width="5" height="5"></td>
    <td background="../admin/images/coupons3.jpg"><div align="right"><img src="../admin/images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>