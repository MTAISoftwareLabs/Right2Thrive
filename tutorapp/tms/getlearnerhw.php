<?php
include_once ('dbConnection.php');

if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
$sub_id = $_GET['id'];
$sqls = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and  us.I_subjectid =".$sub_id." and us.I_tutorid  =".$_SESSION['user_id'];
$querys = runquery1($sqls);
$rows = mysqli_fetch_array($querys);
$studit = $rows['I_studentid'];
$sid = explode(";",$studit);

for($j=0;$j<count($sid);$j++)
{
	$sql_s = "select vUserName from cpo_usermaster where  iUserId=".$sid[$j];
	$qry = runquery1($sql_s);
	$row_s = mysqli_fetch_array($qry);
	$option .= "<option value='".$sid[$j]."'>".$row_s['vUserName'].'</option>';
}

$tabl = '<table width="100%"><tr><td width="43%" height="30" class="bodytext">Select Learner </td>
		<td width="58%" class="bodytext">&nbsp;<select name="cmbstudent" class="textbox">
		<option value="">Select Learner</option>';

$tabl .= $option.'</select>&nbsp;<font color="red">*</font></td></tr></table>';



$sql_h = "select I_homeworkid,V_title from cpo_homework where  I_Subject=".$sub_id;
$qhw = runquery1($sql_h);
$num_h = mysqli_num_rows($qhw);
if($num_h)
{
	while($row_h = mysqli_fetch_array($qhw))
	{
		$opthw .='<option value='.$row_h['I_homeworkid'].'>'.$row_h['V_title'].'</option>';
	}
	$hw = '<table width="100%"><tr><td width="43%" height="30" class="bodytext">Select Homework </td>
							<td width="58%" class="bodytext">&nbsp;<select name="cmbstudent" class="textbox">
				 <option value="">Select Homework</option>';
$hw .= $opthw.' </select>&nbsp;<font color="red">*</font></td></tr></table>';
}
else
{
	$hw = '<table width="100%"><tr><td height="30" class="bodytext" align="center">&nbsp;<font color="red">No Homework Added</font></td></tr></table>';
}

echo $tabl."//".$hw;
?>