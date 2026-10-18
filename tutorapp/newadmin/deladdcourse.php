<?php
ob_start();
extract($_GET);
extract($_POST);
extract($_REQUEST);

include_once 'dbConnection.php';


if(isset($myaction) and $myaction=="delete")
{
	if(isset($Event_Ids) and count($Event_Ids)>0)
	{
	
		$qryDelNL = "DELETE FROM cpo_usercourse WHERE iUserCourseId IN (".implode(",",$Event_Ids).")";
		//echo $qryDelNL;
		runquery1($qryDelNL);
		
		
	}

header ("Location:deletestudentcourse.php?curpage=$curpage");
	exit;	
}


if(isset($myaction) and $myaction=="active")
{
	if(isset($Event_Ids) and count($Event_Ids)>0)
	{
	
		$qryDelNL = "update cpo_usercourse set iCourseStatus='1' WHERE iUserCourseId IN (".implode(",",$Event_Ids).")";
		//echo $qryDelNL;
		runquery1($qryDelNL);
		
		
	}

	header ("Location:deletestudentcourse.php?curpage=$curpage");
	exit;	
}


?>
