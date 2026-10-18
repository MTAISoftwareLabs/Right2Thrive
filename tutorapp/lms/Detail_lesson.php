<?php
include_once 'dbConnection.php';

if(isset($_GET['id']))
{
	$sqlselect="select * from cpo_lessons where  I_lid =".$_GET['id'];
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
		$result_info = mysqli_fetch_array($result_info);
	}
	//get subject and tutor anem
	$sql_us = "select sb.iSubjectId,um.iUserId,us.I_tutorid ,um.vUserName,sb.vSubjectName    from  cpo_user_subject as us, cpo_subjectmaster  as sb, cpo_usermaster as um  where   us.I_user_subid  =".$result_info['I_user_subjectid']." and us.I_tutorid =um.iUserId  and sb.iSubjectId =us.I_subjectid";
	$res_us = runquery1($sql_us);
	$fet_us = mysqli_fetch_array($res_us);
	//check from cpo_user_leason

	$sql_lsn = "select *  from  cpo_user_lesson   where   I_lesson=".$_GET['id'];
	$res_lsn = runquery1($sql_lsn);
	 $num_lsn= $res_lsn ? mysqli_num_rows($res_lsn) : 0;
	if($num_lsn > 0)
	{	$fet_lsn = mysqli_fetch_array($res_lsn);
	}
	
}
if(isset($_POST['hdn_submit']) && $_POST['hdn_submit'] == 1)
{
	$usersubid	= $_POST['hdn_usersub_id'];
	$tutor_id	= $_POST['hdn_tutor_id'] ;
	$lesson_id	= $_POST['hdn_lesson_id'] ;
	$new_date	= $_POST['hdn_date'];
	$learn		= $_POST['ta_learn'];
	$joy		= $_POST['rad_joy'];
	$reason		= $_POST['ta_reason'] ;
	$insql = "insert into cpo_user_lesson(I_tutorid,I_userid,I_lesson, T_didulearn,T_enjoy ,T_reason,i_usersubjectid,D_date )
				values(".$tutor_id.",".$_SESSION['user_id'].",".$lesson_id.",'".$learn."','".$joy."','".$reason."',".$usersubid.",'".$new_date."')";

	$ininfo=runquery($insql);
	if($ininfo)
	{?>
		<script language="javascript">
		var subid = <? echo $_POST['hdn_sub_id'];?>;
		window.opener.location.href='sub_lesson.php?ct='+subid;
		window.close();
	</script>
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
	if(document.frmdet.ta_learn.value == '')
	{
		alert('Please enter what did you learn.');
		document.frmdet.ta_learn.focus();
		return false;
	}
	
	var fruit = new Array('Yes', 'No');
	var selection = document.frmdet.rad_joy;
	var cnt =0;
	for (i=0; i<selection.length; i++)
	{
		if (selection[i].checked == true && selection[i].value =='No')
		{
			var val = fruit[i];
			cnt++;
		}
	}
	if(cnt == 1)
	{
		if(document.frmdet.ta_reason.value == '')
		{
			alert('Please enter reason.');
			document.frmdet.ta_reason.focus();
			return false;
		}
	}
	return true;
}
function hide(obj)
{
	if(obj == 'y')
	{
		document.getElementById('ta_reason').disabled=true ;
	}
	else
	{	document.getElementById('ta_reason').disabled = false;
	}
}
</script>
<link href="../admin/css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/css_styles.css" rel="stylesheet" type="text/css">
<title><? echo sitename;?>Lesson Summary - Detail View</title><body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
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
		<form name="frmdet" method="post" action="" onSubmit="return validate()">
		<input type="hidden" name="hdn_submit" value="1">
		<input type="hidden" name="hdn_usersub_id" value="<?=$result_info['I_user_subjectid'];?>">
         <tr> 
          <td colspan="4">
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
<tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" align="center" class="bodytext"><b><? echo ucfirst($result_info['V_name']);?>&nbsp;&nbsp;:&nbsp;&nbsp;<? echo ucfirst($result_info['T_desc']);?></b></td>
              </tr>
			   <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext" colspan="2"><? if($fet_lsn['D_date'] !=''){  $date12 =explode('-',$fet_lsn['D_date']); echo $date12[0]."-". $date12[1]."-". $date12[2]; }else { $curdate =date('d/m/Y');$date1=date('Y-m_d');?><input value="<? echo $curdate;?>" name="txt_date" readonly="" type="text" class="textbox"><? }?></td>
				<input type="hidden" name="hdn_date" value="<? echo $date1;?>">
              </tr>
			  
			   <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Tutor Name</b></td>
                <td height="22" class="bodytext">&nbsp;<? echo ucfirst($fet_us['vUserName']);?><input type="hidden" name="hdn_tutor_id" value="<? echo $fet_us['I_tutorid'];?>"><input type="hidden" name="hdn_lesson_id" value="<? echo $_GET['id'];?>"></td>
              </tr>
              
			    <tr bgcolor="#FFFFFF"> 
                <td height="22"  class="bodytext"><strong>What did you learn? </strong><br>(Once entered,<br> could not be changed)</td>
				 <td height="22" class="bodytext">&nbsp;<? if($fet_lsn['T_didulearn'] !=''){ echo ucfirst($fet_lsn['T_didulearn']); }else {?>
				<textarea name="ta_learn" cols="60" rows="3"><? echo $fet_lsn['T_scomments'];?></textarea><? }?></td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td height="22"class="bodytext" nowrap="nowrap"><strong>Did you enjoy the lesson?</strong></td>
				 <td width="73%" height="22" class="bodytext">&nbsp;<? if($fet_lsn['T_enjoy'] !=''){ echo $fet_lsn['T_enjoy']; }else {?>
				<input name="rad_joy" type="radio" value="Yes" checked onClick="hide('y')"> 
				&nbsp;Yes <input type="radio" name="rad_joy" value="No" onClick="hide('n')"> &nbsp;No<? }?></td>
              </tr>
              
			 <? if(trim($fet_lsn['T_reason']) =='' && ($fet_lsn['T_didulearn'] =='' || $fet_lsn['T_didulearn'] =='No')){ ?>
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><strong>If no, please explain why</strong></td>
				 <td height="22"  valign="top" class="bodytext"><? if(trim($fet_lsn['T_reason']) =='' && $fet_lsn['T_didulearn'] ==''){ ?><textarea name="ta_reason" cols="60" rows="3" id="ta_reason" disabled="disabled" ><? echo $fet_lsn['T_reason'];?></textarea><? }else {echo ucfirst($fet_lsn['T_reason']); }?></td>
              </tr>
			  <? }?>                   
           
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><? if($fet_lsn['T_reason'] !=''){  }else {?>
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