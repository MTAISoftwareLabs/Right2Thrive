<?php
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "dbConnection.php"; //Add or update globle site information like sitename, admin mail, database info ?>
  <title>User Login<?php echo sitename; ?></title>
  <?php include "metadata.php"; //Add or update meta data and css files here ?>
</head>
<body>
<?php
$msg = "";
if (isset($_POST['TXUSERID'])){
	$sqlchange = "select * from cpo_usermaster where vUserEmailId='" . $_POST['TXUSERID'] . "' and vUserPassword='" . $_POST['TXPASSWORD'] . "' and iUserStatus=1";
	$rschange = runquery($sqlchange);
	$num = $rschange ? mysqli_num_rows($rschange) : 0;
	//echo $num;
	if ($num > 0){
		$res = mysqli_fetch_array($rschange);
		//session_register('user_id');
		$_SESSION['user_id'] = $res['iUserId'];
		//session_register('user_name');
		$_SESSION['user_name'] = $res['vUserName'];
		//session_register('email_id');
		$_SESSION['email_id'] = $res['vUserName'];
		//session_register('module');
		$_SESSION['module'] = $res['iUserType'];
		//session_register('log_fill');
		$_SESSION['log_fill'] = 0;
		//echo $res['iUserType'];
		$HTTP_SESSION_VARS['user_id'] = $res['iUserId'];
		$HTTP_SESSION_VARS['user_name'] = $res['vUserName'];
		$HTTP_SESSION_VARS['email_id'] = $_POST['TXUSERID'];
		$HTTP_SESSION_VARS['module'] = $res['iUserType'];
		$HTTP_SESSION_VARS['log_fill'] = 0;

		//////	Sending mail	//////////////
		if ($res['iUserType'] == 1){
			$sectionname = "TMS";
		}

		if ($res['iUserType'] == 2){
			$sectionname = "LMS";
		}

		if ($res['iUserType'] == 4){
			$sectionname = "TPM";
		}

		//echo $sectionname;
		//echo $HTTP_SESSION_VARS['user_name'];
		

		//////	Sending mail over	//////////////
		

		// EDIT THE 2 LINES BELOW AS REQUIRED
		$email_to = "cleeown@yahoo.co.uk";
		$email_subject = "Colin";
		$first_name = $HTTP_SESSION_VARS['user_name']; // required
		$email_from = $HTTP_SESSION_VARS['email_id']; // required
		

		$email_message = "Form details below.\n\n";
		$email_message = "Member: " . clean_string($first_name) . " has been logged in My Digital Future at " . date('d-m-Y G:i:s') . " in " . $sectionname . "\n";

		// create email headers
		$header = "From: " . $email_from . "\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$header .= "X-Priority: 1\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		$headers .= "X-Priority: 1" . "\r\n";

		mail($email_to, $email_subject, $email_message, $headers);

		if ($res['iUserType'] == 1){
			tutor_counter(1);
			header('Location: ../' . app_tutor_tms_dashboard_href());
			exit;
		}
		if ($res['iUserType'] == 2){
			addlog(1);
			header('Location: ../lms/index.php');
			exit;
		}
		if ($res['iUserType'] == 4){
			header('Location: ../' . app_tutor_tpm_dashboard_href());
			exit;
		}
	}
	else{
		$msg = "Invalid User ID or Password";
	}
}
if (isset($_POST['reglogin_x'])){
	extract($_POST);
	$sqlchange = "select * from cpo_usermaster where vUserEmailId='" . $_POST['TXUSERID1'] . "' and vUserPassword='" . $_POST['TXPASSWORD1'] . "' and iUserStatus=1";
	$rschange = runquery($sqlchange);
	$num = $rschange ? mysqli_num_rows($rschange) : 0;
	//echo $num;
	if ($num > 0){
		$res = mysqli_fetch_array($rschange);
		//session_register('user_id');
		$_SESSION['user_id'] = $res['iUserId'];
		//session_register('user_name');
		$_SESSION['user_name'] = $res['vUserName'];
		//session_register('email_id');
		$_SESSION['email_id'] = $res['vUserName'];
		//session_register('module');
		$_SESSION['module'] = $res['iUserType'];
		//session_register('log_fill');
		$_SESSION['log_fill'] = 0;
		//echo $res['iUserType'];
		$HTTP_SESSION_VARS['user_id'] = $res['iUserId'];
		$HTTP_SESSION_VARS['user_name'] = $res['vUserName'];
		$HTTP_SESSION_VARS['email_id'] = $_POST['TXUSERID1'];
		$HTTP_SESSION_VARS['module'] = $res['iUserType'];
		$HTTP_SESSION_VARS['log_fill'] = 0;

		//////	Sending mail	//////////////
		if ($res['iUserType'] == 1){
			$sectionname = "TMS";
		}
		if ($res['iUserType'] == 2){
			$sectionname = "LMS";
		}
		if ($res['iUserType'] == 4){
			$sectionname = "TPM";
		}
		//echo $sectionname;
		//echo $HTTP_SESSION_VARS['user_name'];
		$fromname = 'CareerPaths Online'; //$HTTP_SESSION_VARS['user_name'];
		$fromaddress = $HTTP_SESSION_VARS['email_id'];
		$toname = 'Colin';
		//$toaddress='colin_leeown2000@yahoo.com';
		$toaddress = 'info@careerpathsonline.net';
		//$toaddress="samheighes@gmail.com";
		$subject = "Member '" . $HTTP_SESSION_VARS['user_name'] . "' has been logged in";
		$message = "<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'><P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Member <b>'" . $HTTP_SESSION_VARS['user_name'] . "'</b> has been logged in CareerPaths Online at <b>" . date('d-m-Y G:i:s') . "</b> in <b>" . $sectionname . "</b> Section.";

		SendingMail($fromname, $fromaddress, $fromname, $toaddress, $subject, $message);
		//////	Sending mail over	//////////////     

		if ($res['iUserType'] == 1){
			tutor_counter(1);
			header('Location: ../' . app_tutor_tms_dashboard_href());
			exit;
		}
		if ($res['iUserType'] == 2){
			addlog(1);
			header('Location: ../lms/index.php');
			exit;
		}
		if ($res['iUserType'] == 4){
			header('Location: ../' . app_tutor_tpm_dashboard_href());
			exit;
		}
	}else{
		$msg = "Invalid User ID or Password";
	}
}
?>
<div class="container">
	<header>
		<div class="row">
			<div class="col-md-12">
				<h1 class="pagetitle text-center">My Digital Future</h1>
			</div>
		</div>
	</header>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="row form-card">
				<div class="col-md-12 form-card-head"><h2>Login</h2></div>
				<div class="col-md-6 form-section">
					  <h4 class="form-title">Already a Member?</h4>
					  <p class="form-subtitle">Please Sign in.</p>
					  <?php
						if(!empty($msg)){
							echo"<div class='lfm alert alert-warning'>Invalid User ID or Password!!</div>";
						}
					  ?>					  
					  <form name="FRMLOGIN" action="user_login" method="post" onSubmit="return checklogin();">
						<div class="form-group">
						  <label for="uname">Username:</label>
						  <input type="text" class="form-control" id="uname" placeholder="Enter user email" name="TXUSERID" required>				  
						</div>
						<div class="form-group">
						  <label for="pwd">Password:</label>
						  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="TXPASSWORD" required>
						</div>
						<button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Submit</button>
					  </form>
					  <div class="space35"></div>
					  <div class="">
						  <a href="forgotpwd" target="_blank">Forgot your password?</a><br/>
						  <a href="" onclick="javascript:openwin();" target="_blank">Having trouble signing in?</a>
					  </div>
					  <div class="space35"></div>
				</div>
				<div class="col-md-6 desc-section">
					<h4>New to Online Learning?</h4>
					<p>To get below Benefits Sign Up <span class="highlight">NOW!!</span></p>
					<ul class="square">
						<li>Improve your Job Prospects.</li>
						<li>Gain Key Skills to find a Job.</li>
						<li>Instant access to one-2-one online Tutoring and Mentoring Support.</li>
						<li>Learn New Skills without the peer pressure in a classroom.</li>
					 </ul>					 
					 <div class=""><a href="register" class="btn btn-outline-primary btn-sm"><i class="fa fa-check-square"></i> Sign Up Now</a></div>
					 <div class="space35"></div>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
	<footer>
		<?php include "footer.php"; //Add or update footer information and javascript files here ?>
	</footer>
</div>
<script>
	$( window ).on( "load", function() {
        $("#uname").focus();
    });
    
	function openwin(){
		new1=window.open("login-help","",'height=400,width=600,scrollbars=yes,top=50 left=150');
	}
</script>
</body>
</html>
