<?php
session_start();
ob_start();
extract($_GET);
extract($_POST);
extract($_REQUEST);

include "../lms/db.php";

if(isset($myaction) and $myaction=="delete")
{
	if(isset($Event_Ids) and count($Event_Ids)>0)
	{
	
		$qryDelNL = "DELETE FROM careersuit WHERE id IN (".implode(",",$Event_Ids).")";
		//echo $qryDelNL;
		mysqli_query($qryDelNL) or die("can not delete nl".mysqli_error());
		
		
	}

	header ("Location:careersuite.php");
	exit;	
}
if(isset($myaction) and $myaction=="active")
{
	if(isset($Event_Ids) and count($Event_Ids)>0)
	{
	
		$qryDelNL = "update  careersuit set status='1' WHERE id IN (".implode(",",$Event_Ids).")";
		//echo $qryDelNL;
		mysqli_query($qryDelNL) or die("can not delete nl".mysqli_error());
		
		
	}

	header ("Location:careersuite.php");
	exit;	
}
if(isset($myaction) and $myaction=="inactive")
{
	if(isset($Event_Ids) and count($Event_Ids)>0)
	{
	
		$qryDelNL = "update  careersuit set status='0' WHERE id IN (".implode(",",$Event_Ids).")";
		//echo $qryDelNL;
		mysqli_query($qryDelNL) or die("can not delete nl".mysqli_error());
		
		
	}

	header ("Location:careersuite.php");
	exit;	
}
?>
