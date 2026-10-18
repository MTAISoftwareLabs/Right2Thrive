<?php
include_once 'dbConnection.php';

if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
$type = $_GET['id'];
?>

<table>
<tr bgcolor="#FFFFFF"> 
<td class="bodytext" align="center" height="50" nowrap="nowrap">
Select Learner&nbsp;&nbsp; 
<?php
$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_progressreport uc where um.iUserId=uc.I_userid and uc.I_tutorid  =".$_SESSION['user_id']." order by um.vUserName";
$rst = runquery($seltutor);
?>
<select class="textbox" name="sellearner">
<option value="0">Select Learner</option>				
<?php
while ($rstutor = mysqli_fetch_array($rst))
{ ?>
<option value="<?php echo $rstutor['iUserId']?>" <?php if (isset($_POST['sellearner']) && $_POST['sellearner'] == $rstutor['iUserId']) {?> selected <?php }?>><?php echo $rstutor['vUserName']?></option>
<?php }
?>				

</select>&nbsp;&nbsp;
<img src="../admin/images/search.gif" style="cursor:hand" onClick="submitpage();" align="absmiddle">
</td>
</tr>
<tr>
<td height="20"></td>
</tr>
<tr> 
<td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
  <tr> 
  <td width="25%" align="left" class="bodytext" style="padding-left:5px"><strong>Learner Name</strong></td>
  <td width="25%" align="left" class="bodytext" style="padding-left:5px"><strong>Subject</strong></td>
	<td width="25%" align="left" class="bodytext" style="padding-left:5px"><strong>Year/Month</strong></td>

  </tr>
   <?php if($num)
{
$cnt=1;
while ($rs = mysqli_fetch_array($rID))
{
$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rs['I_tutorid'];
$rstutor = runquery($sqltutor);
$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
if ($num1 > 0 )
{
$rsdata = mysqli_fetch_array($rstutor);
$tutorname = $rsdata['vUserName'];
}

$sqlstu = "select vUserName from cpo_usermaster where iUserId=".$rs['I_userid'];
$rsstu = runquery($sqlstu);
$num1 = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
if ($num1 > 0 )
{
$rsdata = mysqli_fetch_array($rsstu);
$stuname = $rsdata['vUserName'];
}

$sqls = "select  sb.vSubjectName  from  cpo_progressreport  as  us, cpo_subjectmaster  as sb where  sb.iSubjectId =".$rs['I_subjectId']." and us.I_tutorid  =".$_SESSION['user_id']." group by us.I_subjectid";
$querys = runquery1($sqls);
$fets = mysqli_fetch_array($querys);
$subject = $fets['vSubjectName'];
?>
	  <tr bgcolor="#FFFFFF"> 
		<td height="25" align="left" class="bodytext" style="padding-left:5px"><a class="sidelink" href="#" onClick="javascript:openreport(<?php echo $rs['I_progressid'];?>)"><?php echo ucfirst($stuname);?></a></td>
		<td align="left" class="bodytext" style="padding-left:5px"><a href="#" class="sidelink" onClick="javascript:openreport(<?php echo $rs['I_progressid'] ?>)"><?php echo $subject;?></a></td>
		<td align="left" class="bodytext" style="padding-left:5px"><?php echo $rs['I_year']."/".$rs['I_month'];?></td>
		
	  </tr>
<?php
$cnt++;
}
}
else
{?>
	  <tr bgcolor="#FFFFFF"> 
		<td height="25" align="center" colspan="4" class="bodytext"><b>No Records found.</b></td>
	  </tr>
<?php
}
?>
</table></td>
</tr>
</table>