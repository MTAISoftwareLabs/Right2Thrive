<?php
//	Function when date is view onto page
function fdate($dt)
{
	$datadate = explode("/",$dt);
	$tday = date("Y-m-d", mktime(0,0,0,$datadate[1],$datadate[0],$datadate[2]));
	return $tday;
}
	
//	Function when date is inserted into database	
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d-m-Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}

// added to properly format string
function clean_string($str)
{
	$str = htmlspecialchars(str_replace("\'", "'", trim($str)));
	$str = rtrim($str);	
	$str = str_replace("'", "\'", $str);
	return $str;
}

function SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message)
{
	if (function_exists('app_sending_mail')) {
		return app_sending_mail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
	}
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= 'From: "' . str_replace('"', '', $fromname) . '" <' . $fromaddress . ">\r\n";
	return @mail($toaddress, $subject, $message, $headers);
}

function logout()
{
	session_unregister("user_id");
	session_unregister("user_name");
	session_unregister("email_id");		
	//header("Location:../lms/");	
	header("Location:../");
	exit;
}
function datetime($dt)
{
	$ans=explode(" ",$dt);
	$date=explode("-",$ans[0]);
	$dateans=$date[2]."/".$date[1]."/".$date[0];
	$timeans=$ans[1];
	$datetimefinal=$dateans." ".$timeans;
	return $datetimefinal;
}
function addlog($operationid)
{
	if(isset($_SESSION['user_name']))
	{
		$studid = $_SESSION['user_id'];
		$studname = $_SESSION['user_name'];
		$dtime = date('Y-m-d H:i:s');
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$sqlinsert = "insert into tracklogstudent (StudentId,StudentName,OperationId,DateTime,IPAddress) 
		values (".$studid.",'".$studname."',".$operationid.",'".$dtime."','".$ipaddress."')";
		runquery($sqlinsert);
	}
}
function tutor_counter($logged_in)
{
	if(isset($_SESSION['user_name']))
	{
		$tutorid = $_SESSION['user_id'];
		$tutorname = $_SESSION['user_name'];
		$dtime = date('Y-m-d H:i:s');
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$sqldel = "delete from tracklogtutor where TutorId=".$tutorid;
		runquery($sqldel);
		if($logged_in==1)
		{
			$sqlinsert = "insert into tracklogtutor(TutorId,TutorName,OperationDone,DateTime,IPAddress) values (".$tutorid.",'".$tutorname."',".$logged_in.",'".$dtime."','".$ipaddress."')";
			runquery($sqlinsert);
		}
	}
}
?>