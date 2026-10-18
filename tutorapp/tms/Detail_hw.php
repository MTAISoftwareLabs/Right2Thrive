<?php
include_once '../dbConnection.php';

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
	$sql_us = "select sb.iSubjectId,um.iUserId,us.I_studentid ,um.vUserName,sb.vSubjectName    from  cpo_user_subject as us, cpo_subjectmaster  as sb, cpo_usermaster as um  where   us.I_user_subid  =".$result_info['I_user_subjectid']." and us.I_studentid =um.iUserId  and sb.iSubjectId =us.I_subjectid";
	$res_us = runquery1($sql_us);
	$fet_us = mysqli_fetch_array($res_us);
	//check from cpo_user_leason
}
if(isset($_POST['hdn_submit']) && $_POST['hdn_submit'] == 1)
{
	$comment	= $_POST['txttcomments'];
	$reason		= $_POST['ta_reason'];
	$comp		= $_POST['rad_comp'];
	$insql 		= "update cpo_homework set T_Feedback ='".$comment."',  T_whynot_reason  ='".$reason."' , C_Completed  ='".$comp."' where I_homeworkid =".$_GET['id'];
	$ininfo=runquery($insql);
	if($ininfo)
	{
		$flg = 1;
	}
	
	$sel = "select D_due_date,I_studentid from cpo_homework where I_homeworkid =".$_GET['id'];
	$selh=runquery($sel);
	$res = mysqli_fetch_array($selh);
	$user_sub = $res['I_studentid'];
	$due_date = $res['D_due_date'];
	$date = date('Y-m-d');
	
	if($date <= $due_date)
	{	
		$sqlp = "select vUserName,vUserEmailId,I_prize from cpo_usermaster where iUserId =".$res['I_studentid'];
		$sqlpp=runquery($sqlp);
		$row = mysqli_fetch_array($sqlpp);
		$prizeold = $row['I_prize'];
		$prize = $prizeold + 1;
		$upsql 		= "update cpo_usermaster set I_prize =".$prize." where iUserId =".$res['I_studentid'];
		$upinfo=runquery($upsql);
		
		if(($prize%10) == 0 )
		{
			$fromname='Colin';//$_SESSION['user_name'];
			$fromaddress=admin_email;
			$toname=$row['vUserName'];
			//$toaddress='colin_leeown2000@yahoo.com';
			$toaddress=$row['vUserEmailId'];
			$subject="Dear '".$row['vUserName']."' you will get a prize.";
			$message="<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>
				Dear <b>'".$row['vUserName']."'</b>,<br><p> As you have completed your homework on time at CareerPaths Online you are eligible to get a prize.</p><br>Thanks,<br><br>
				Admin CareerPaths Online.</html>";
			SendingMail($fromname,$fromaddress,$toname,$toaddress, $subject, $message);
		}
		$flg = 1;
	}
	else
	{
		$flg = 1;
	}
	
	if($flg == 1)
	{?>
		<script language="javascript">
		var subid = <?php echo $_POST['sub_id'];?>;
		window.opener.location.href='homework.php?ct='+subid;
		window.close();
	</script>;
	<?php  }
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
		alert('Please enter your feedback.');
		document.frmhw.txttcomments.focus();
		return false;
	}
	var fruit = new Array('Yes', 'No');
	var selection = document.frmhw.rad_comp;
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
		if(document.frmhw.ta_reason.value == '')
		{
			alert('Please enter reason.');
			document.frmhw.ta_reason.focus();
			return false;
		}
	}
}
function hide(obj)
{

	if(obj == 'y')
	{
		document.getElementById('reason1').style.display = 'none';
				document.getElementById('reason2').style.display = 'none';
	}
	else
	{	document.getElementById('reason1').style.display = '';
				document.getElementById('reason2').style.display = '';
	}
	
}
</script>
<link href="../admin/css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/css_styles.css" rel="stylesheet" type="text/css">
<title><?php echo sitename;?>Homework - Detail View</title><body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
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
		<input type="hidden" name="sub_id" value="<?php echo $fet_us['iSubjectId']?>">
        <tr> 
          <td colspan="4">
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Subject  Name</b></td>
                <td height="22" class="bodytext">&nbsp;<?php echo ucfirst($fet_us['vSubjectName']);?></td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Learner Name</b></td>
                <td height="22" class="bodytext">&nbsp;<?php echo ucfirst($fet_us['vUserName']);?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Homework Title</b></td>
                <td height="22" class="bodytext">&nbsp;<?php echo ucfirst($result_info['V_title']);?></td>
              </tr>
			     <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Assign Date</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo $asign_date=gdate($result_info['D_assign_date']);?></td>
              </tr>
			     <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Due Date </strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo $due_date = gdate($result_info['D_due_date']);?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Completed</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php if($result_info['C_Completed'] !=''){echo $result_info['C_Completed'] ;} else {?>
				 <input type="radio"  name="rad_comp" ID='RAD' value="Yes" checked onClick="hide('y')"> 
				&nbsp;Yes <input type="radio"  name="rad_comp" ID='RAD' value="No"    onClick="hide('n');"> &nbsp;No<?php } ?></td>
              </tr>
               <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Learner Comments</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" valign="top" class="bodytext"><?php echo $result_info['T_Summary'] ;?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Tutor Comments</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td colspan="2" valign="top" class="bodytext"><?php if($result_info['T_Feedback'] !=''){echo $result_info['T_Feedback'] ;} else {?><textarea name="txttcomments" cols="60" rows="3"></textarea><?php }?></td>
              </tr>
			  <tr bgcolor="#FFFFFF" id="reason1" style="display:none">  
                <td height="22" colspan="2" class="bodytext"><strong>Reason for not completing?</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF" id="reason2" style="display:none">
                <td colspan="2" valign="top" class="bodytext"> <textarea name="ta_reason" cols="60" rows="3"></textarea></td>
              </tr>
           <?php if($result_info['T_whynot_reason'] !=''){?>
            <tr bgcolor="#FFFFFF" >  
                <td height="22" colspan="2" class="bodytext"><strong>Reason for not completing?</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF" > 
                <td colspan="2" valign="top" class="bodytext"><?php echo $result_info['T_whynot_reason'] ;?></td>
              </tr>
			  <?php } ?>
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><?php if($result_info['T_Feedback'] !=''){  }else {?>
				<input type="image" src="../admin/images/submitbttn.jpg"><?php }?>&nbsp;<img src="../admin/images/closebutton.gif" onClick="javascript:window.close();" style="cursor:hand"></div></td>
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