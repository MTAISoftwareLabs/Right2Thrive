<?php
include_once ('dbConnection.php');

if(!isset($_SESSION['user_id']))
{
	header("Location:index.htm");
}
else
{
	$user_id = $_SESSION['user_id'];
}

$tutor = $_REQUEST['tid'];
$sub_id = $_REQUEST['sub'];

$sqls = "select I_studentid,I_subjectid from cpo_user_subject where I_tutorid=".$tutor." and I_subjectid =".$sub_id;
$result = runquery1($sqls);

while($rslist=mysqli_fetch_array($result))
{
 $selClient = "select iUserId,vUserName from cpo_usermaster where iUserId=".$rslist['I_studentid'];
	$resClient = runquery1($selClient);
	while($fetClient = mysqli_fetch_array($resClient))
	{
		$option_ser .="<option  value='".$fetClient['iUserId']."' ".$selected.">".ucfirst($fetClient['vUserName'])."</option>";
	}
}
	$select_ser = "<select name='sel_learner' class='textbox' id='sel_learner' ><option value=''>Select Learner</option>".$option_ser."</select>";

$tabl ="<table width='100%' ><tr><td width='39%' height='30' valign='top' class='bodytext'>&nbsp;Select Learner </td><td width='61%'>&nbsp;".$select_ser."&nbsp;<font color='red'>*</font></td></tr></table>";
echo $tabl;
?>