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
	$tday = date("d/m/Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
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
   $headers  = "MIME-Version: 1.0\n";
   $headers .= "Content-type: text/html; charset=iso-8859-1\n";
   $headers .= "X-Priority: 3\n";
   $headers .= "X-MSMail-Priority: Normal\n";
   $headers .= "X-Mailer: php\n";
   $headers .= "From: \"".$fromname."\" <".$fromaddress.">\n";
   return mail($toaddress, $subject, $message,$headers);
}

function logout()
{
	session_unregister("user_id");
	session_unregister("user_name");
	session_unregister("email_id");		
	header("Location:../lms/");
	exit;
}
?>
