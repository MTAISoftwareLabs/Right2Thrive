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

 $sqls = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and  us.I_subjectid =".$sub_id." and us.I_tutorid  =".$_SESSION['user_id']." group by us.I_studentid";
$querys = runquery1($sqls);
while($rows = mysqli_fetch_array($querys)){
$studit = $rows['I_studentid'];
	
	$option .='	<option value='.$rows['I_studentid'].'>'.$rows['vUserName'].'</option>';
}



$tabl .= '<table width="100%"><tr><td width="41%" height="30" class="bodytext">Select Learner </td>
							<td width="59%" class="bodytext"><select name="cmbstudent" class="textbox" >
						                                               <option value="">Select Learner</option>';

$tabl .= $option.' </select>				&nbsp;<font color="red">*</font></td></tr></table>';

echo $tabl;
?>
