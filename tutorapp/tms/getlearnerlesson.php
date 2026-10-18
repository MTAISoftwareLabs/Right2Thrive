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
$sub_id = $_GET['id'];

 $sqls = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and  us.I_subjectid =".$sub_id." and us.I_tutorid  =".$_SESSION['user_id'];
$querys = runquery1($sqls);
$rows = mysqli_fetch_array($querys);
$studit = $rows['I_studentid'];
$sid = array();
$sid = explode(";",$studit);

for($j=0;$j<count($sid);$j++)
{
	$sql_s = "select vUserName from cpo_usermaster where   iUserId =".$sid[$j];
	$qry = runquery1($sql_s);
	$row_s = mysqli_fetch_array($qry);
	
	$option .='	<option value='.$sid[$j].'>'.$row_s['vUserName'].'</option>';
}



$tabl .= '<table><tr><td width="55%" height="30" class="bodytext">Select Learner </td>
							<td width="59%" class="bodytext">&nbsp;<select name="cmbstudent" class="textbox" size="10">
						                                               <option value="">Select Learner</option>';

$tabl .= $option.' </select>				&nbsp;<font color="red">*</font></td></tr></table>';

echo $tabl;
?>
