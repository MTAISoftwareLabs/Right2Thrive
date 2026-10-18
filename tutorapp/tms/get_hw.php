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

$tabl = '<table width="100%" >
	<tr><td width="41%"  class="bodytext" valign="top">Select Learner </td>
		<td width="" align="left"><select name="cmbstudent[]" class="textbox" id="student" multiple size="10">'.$option.'</select>&nbsp;<font color="red">*</font></td></tr></table>';

  $sql_h = "SELECT us.I_tutorid , cl.I_homeworkid, cl.V_title from cpo_homework as cl , cpo_user_subject as us where us.I_tutorid=".$user_id." and us.I_subjectid=".$sub_id."  and us.I_user_subid =cl.I_user_subjectid group by cl.V_title" ;
$qhw = runquery1($sql_h);
$num_h = mysqli_num_rows($qhw);
if($num_h)
{
	while($row_h = mysqli_fetch_array($qhw))
	{
		$opthw .='<option value='.$row_h['I_homeworkid'].'>'.ucfirst($row_h['V_title']).'</option>';
	}
	$hw = '<table width="100%" >
	<tr><td width="41%" height="30" class="bodytext" align="left">Select Homework</td>
		<td width="59%" class="bodytext"><select name="sel_hw" class="textbox" id="sel_hw">
		<option value="">Select Homework</option>'.$opthw.'</select>&nbsp;<font color="red">*</font></td></tr>
<tr><td width="41%"></td><td width="59%" class="bodytext"><input type="checkbox" name="toggleCheckbox" id="toggleCheckbox" onClick="les_txb(this.name);" value="" /> &nbsp;Other </td></tr></table>';
}
else
{
	$hw = '<table width="100%"><tr><td height="30" width="41%" class="bodytext" align="left">Select Homework</td><td width="59%"><select name="sel_hw" class="textbox" id="sel_hw">
				 <option value=""><font color="red">No Homework Added</font></option></select></td></tr><tr><td width="41%"></td><td width="59%" class="bodytext"><input type="checkbox" name="toggleCheckbox" id="toggleCheckbox" onClick="les_txb(this.name);" value="" />&nbsp;Other </td></tr></table>';
}

echo $tabl."//".$hw;
?>