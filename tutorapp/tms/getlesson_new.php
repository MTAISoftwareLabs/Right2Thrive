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
while($rows = mysqli_fetch_array($querys)){

		$option .= "<option value='".$rows['I_studentid']."'>".ucfirst($rows['vUserName']).'</option>';
	}

$tabl = '<table width="100%"><tr><td width="43%" height="30" class="bodytext">Select Learner </td>
		<td width="57%" align="left"><select name="cmbstudent[]" class="textbox" id="student" multiple size="10">
		';

$tabl .= $option.'</select>&nbsp;<font color="red">*</font></td></tr></table>';



  $sql_h = "SELECT us.I_tutorid , cl.I_lid, cl.V_name from cpo_lessons_new as cl , cpo_user_subject
 as us where us.I_tutorid=".$user_id." and us.I_subjectid=".$sub_id." group by cl.V_name" ;
 //echo $sql_h;
$qhw = runquery1($sql_h);
$num_h = mysqli_num_rows($qhw);
if($num_h)
{
	while($row_h = mysqli_fetch_array($qhw))
	{
		$opthw .='<option value='.$row_h['I_lid'].'>'.ucfirst($row_h['V_name']).'</option>';
	}
	$hw = '<table width="100%"><tr><td width="43%" height="30" class="bodytext">Select Lesson </td>
							<td width="58%" class="bodytext"><select name="cmblesson"   class="textbox" id="sel_lesson">
				 <option value="">Select Lesson</option>';
$hw .= $opthw.' </select>&nbsp;<font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
</table>';
}
else
{
	$hw = '<table width="100%"><tr><td height="30" class="bodytext" align="center"></td><td>&nbsp;<font color="red"><select name="cmblesson"   class="textbox" id="sel_lesson">
				 <option value="">No Lesson Added</option></select></font></td></tr></table>';
}

echo $tabl."//".$hw;
?>