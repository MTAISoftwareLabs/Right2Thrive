<?
	session_cache_expire(time()-1);
	session_cache_limiter('nocache');
	@ob_start();
	session_start();
	include('../dbConnection.php');

	//////	Sending mail	//////////////
	$sectionname = "TPM";
	
	$fromname='CareerPaths Online';//$HTTP_SESSION_VARS['user_name'];
	$fromaddress=$HTTP_SESSION_VARS['email_id'];
	$toname='Colin';
	$toaddress='colin_leeown2000@yahoo.com';
	$subject="Member '".$HTTP_SESSION_VARS['user_name']."' has been logged out";
	$message="<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'>
		<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>
		Member <b>'".$HTTP_SESSION_VARS['user_name']."'</b> has been logged out from CareerPaths Online at <b>".date('d-m-Y G:i:s')."</b> in <b>".$sectionname."</b> Section.
		";
	SendingMail($fromname,$fromaddress,$fromname,$toaddress, $subject, $message);
		
	//////	Sending mail over	//////////////

	//session_unregister("user_id");
	//session_unregister("user_name");
	//session_unregister("email_id");
$_SESSION['user_id']='';
$_SESSION['user_name']='';
$_SESSION['email_id']='';


		
//	header("Location:../.");
//	exit;
?>
<script language="JavaScript">
	location.replace("../.")
</script>