<?php
include_once 'dbConnection.php';

if(isset($_GET['id']))
{
	$sqlselect="select * from cpo_progressreport where I_progressid=".$_GET['id'];
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
		$result_info = mysqli_fetch_array($result_info);
	}
}

if(isset($_POST['hdn_submit']) && $_POST['hdn_submit'] == 1)
{
	$text = $_POST['tacomments'];
	$insql = "update cpo_progressreport set T_pcomments='".$text."' where I_progressid=".$_GET['id'];
	$ininfo=runquery($insql);
	if($ininfo)
	{?>
		<script language="javascript">
		window.close();
		</script>
	<? }
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
<script type="text/javascript" language="javascript">
function validate()
{
	if(document.frmreport.tacomments.value == '')
	{
		alert('Please enter your comments');
		document.frmreport.tacomments.focus();
		return false;
	}
}
</script>
<link href="../admin/css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/css_styles.css" rel="stylesheet" type="text/css">
<title><? echo sitename;?>Monthly Progress Report - Detail View</title>

<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script>

<body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
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
		<form name="frmreport" method="post" action="" onSubmit="return validate()">
		<input type="hidden" name="hdn_submit" value="1">
        <tr> 
          <td colspan="4">
		  
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
              <? if($msg !='') {?>
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" align="center"><font color="<?=$flg?>"><? echo $msg; ?></font></td>
              </tr>
			  <? }?>
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Learner Name</b></td>
                <td height="22" class="bodytext">&nbsp;<? 
															$fetchname="select * from cpo_usermaster where iUserId=".$result_info['I_userid'];
															$resultfetchname=runquery1($fetchname);
															$name=mysqli_result($resultfetchname,0,1);
															echo $name; ?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext"><b>Tutor's Name</b></td>
                <td height="22" class="bodytext">&nbsp;<? 
				$fetchtut="select * from cpo_usermaster where iUserId=".$result_info['I_tutorid'];
				$resultfetchtut=runquery1($fetchtut);
				$tut=mysqli_result($resultfetchtut,0,1);
				echo $tut;?></td>
              </tr>
              <?
						?>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Subject</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<? 
				$fetchsub="select vSubjectName from cpo_subjectmaster where iSubjectId=".$result_info['I_subjectId'];
				$resultfetchsub=runquery1($fetchsub);
				$sub=mysqli_fetch_array($resultfetchsub);
				echo $sub['vSubjectName'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Month / Year</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $result_info['I_month']."/".$result_info['I_year'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Tutor Comments</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><? echo $result_info['T_tcomments'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Learner Comments</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" valign="top" class="bodytext"><? echo $result_info['T_scomments'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" valign="top" class="bodytext"><strong>Parent Comments</strong>&nbsp;(Once entered, could not be changed) </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext" colspan="2">
				<? if($result_info['T_pcomments'] !=''){ echo $result_info['T_pcomments']; }else {?>
				<textarea name="tacomments" cols="60" rows="3"><? echo $result_info['T_pcomments'];?></textarea><? }?></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><? if($result_info['T_pcomments'] !=''){  }else {?>
				<input type="image" src="../admin/images/submitbttn.jpg" ><? }?>&nbsp;<img src="../admin/images/closebutton.gif" onClick="javascript:window.close();" style="cursor:hand"></div></td>
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