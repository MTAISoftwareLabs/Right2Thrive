<?php
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';

$tutor = $_REQUEST['tid'];
$sub_id = $_REQUEST['sub'];
$lesson = isset($_REQUEST['lesson']) ? (string) $_REQUEST['lesson'] : '';
$ser = array();
if($lesson)
{
	$sql = "select I_user_subjectid from cpo_lessons where V_name ='".$lesson."'";
	$rs1 = runquery1($sql);
	$id = array();
	while($r1 = mysqli_fetch_array($rs1))
	{
		$id[] = $r1['I_user_subjectid'];
	}

	for($i=0;$i<count($id);$i++)
	{
		 $sql_l = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_user_subid=".$id[$i]."  and  us.I_studentid=sb.iUserId";
		$rs_1 = runquery1($sql_l);
		while($rs_le = mysqli_fetch_array($rs_1))
		{
			$ser[] = $rs_le['iUserId'];
		}
	}
}

$sqls = "select I_studentid,I_subjectid from cpo_user_subject where I_tutorid=".$tutor." and I_subjectid =".$sub_id;
$result = runquery1($sqls);

$option_ser = '';
while($rslist=mysqli_fetch_array($result))
{
 $selClient = "select iUserId,vUserName from cpo_usermaster where iUserId=".$rslist['I_studentid'];
	$resClient = runquery1($selClient);
	while($fetClient = mysqli_fetch_array($resClient))
	{
		if($lesson !='' && in_array($fetClient['iUserId'],$ser))
		{
			$selected = "selected";
		} 
		else{
			$selected = "";
		}
		$option_ser .="<option  value='".$fetClient['iUserId']."' ".$selected.">".ucfirst($fetClient['vUserName'])."</option>";
	}
}
	$select_ser = "<select name='sel_learner[]' class='textbox' id='sel_learner' multiple size='10'>".$option_ser."</select>";

$tabl ="<table width='100%' class='bodytext'><tr><td width='39%' height='30' class='' valign='top'>&nbsp;Select Learner </td><td width='61%'>&nbsp;".$select_ser."&nbsp;<font color='red'>*</font></td></tr></table>";
echo $tabl;
?>