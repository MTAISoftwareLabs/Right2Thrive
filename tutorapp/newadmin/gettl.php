<?php
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';

$sub_id = $_GET['id'];
$sqls = "select sb.I_user_subid,sb.I_tutorid,sb.I_subjectid,um.vUserName,um.iUserId from cpo_user_subject as sb, cpo_usermaster as um where um.iUserId=sb.I_tutorid and sb.I_subjectid =".$sub_id." group by sb.I_tutorid";
$querys = runquery1($sqls);
$num_h = mysqli_num_rows($querys);
if($num_h)
{
	$option = '';
	while($fetClient = mysqli_fetch_array($querys))
	{
		$option .="<option  value='".$fetClient['I_tutorid']."'>".ucfirst($fetClient['vUserName'])."</option>";
	}
	$select_opt = "<select name='sel_tutor' id='sel_tutor' class='textbox'  onchange='get_learn(this.value,".$sub_id .")'><option  value=''>Select Tutor</option>".$option."</select>";
	
	$tabl ="<table width='100%' ><tr><td width='39%' height='30' class='bodytext'>&nbsp;Select Tutor </td><td width='61%'>&nbsp;".$select_opt."&nbsp;<font color='red'>*</font></td></tr></table>";
}
else
{
	$tabl ="<table width='100%'><tr><td width='39%' height='30' class='bodytext'>&nbsp;Select Tutor </td><td width='61%'><select name='sel_tutor' id='sel_tutor' class='textbox'><option  value=''>No Tutor Selected</option></select><font color='red'>*</font></td></tr></table>";
}
echo $tabl;
?>
