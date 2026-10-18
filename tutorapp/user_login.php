<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/dbConnection.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

//echo $_POST['TXUSERID'];
date_default_timezone_set('Europe/London');
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
        		function clean_strings($string) {
    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
    return str_replace($bad, "", $string);
}

$first_name = $_SESSION['user_name']; // required
$email_from = $_SESSION['email_id']; // required
 // set your section name here

$email_to = "cleeown@yahoo.co.uk";
$email_subject = "Login Alert";
$email_message = "Form details below.\n\n";
$email_message .= "Member: " . clean_strings($first_name) . " has been logged in My Digital Future at " . date('d-m-Y G:i:s') . " in " . $sectionname . "\n";

$mail = new PHPMailer(true);
$smtp = app_smtp_config();

try {
	$mail->isSMTP();
	$mail->Host = $smtp['host'];
	$mail->SMTPAuth = true;
	$mail->Username = $smtp['username'];
	$mail->Password = $smtp['password'];
	$mail->SMTPSecure = $smtp['encryption'];
	$mail->Port = $smtp['port'];
	$mail->setFrom($smtp['from_email'], $smtp['from_name']);
	$mail->addAddress($email_to);
	$mail->isHTML(true);
	$mail->Subject = $email_subject;
	$mail->Body = nl2br($email_message);
	$mail->AltBody = $email_message;
	$mail->send();
} catch (Exception $e) {
	error_log('Tutorapp login mail: ' . $mail->ErrorInfo);
}

        if ($res['iUserType'] == 1){
            tutor_counter(1);
			header('Location: ' . app_tutorapp_local_tms_home());
			exit;
        }
        if ($res['iUserType'] == 2){
            addlog(1);
			header('Location: ' . app_tutorapp_local_lms_home());
			exit;
        }
        if ($res['iUserType'] == 4){
			header('Location: ' . app_tutorapp_local_tpm_home());
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
			header('Location: ' . app_tutorapp_local_tms_home());
			exit;
        }
        if ($res['iUserType'] == 2){
            addlog(1);
			header('Location: ' . app_tutorapp_local_lms_home());
			exit;
        }
        if ($res['iUserType'] == 4){
			header('Location: ' . app_tutorapp_local_tpm_home());
			exit;
        }
    }else{
        $msg = "Invalid User ID or Password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
  <title>Right2Thrive UK Hub | Modern Sign In</title>
  <link rel="shortcut icon" href="logo.gif" type="image/x-icon">
  
  <!-- Google Fonts + Bootstrap Icons + Modern minimal CSS (no scroll) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f1f5fe 0%, #e6edf8 100%);
      height: 100vh;
      width: 100vw;
      overflow: hidden;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* animated background abstraction - no scroll */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(circle at 30% 20%, rgba(79, 70, 229, 0.08) 0%, rgba(59, 60, 228, 0.02) 80%);
      pointer-events: none;
      z-index: 0;
    }

    /* main container fits exactly in viewport without overflow */
    .login-container {
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      overflow: hidden;
    }

    /* glass card with fixed max-height and no overflow */
    .glass-card {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(0px);
      border-radius: 44px;
      box-shadow: 0 30px 55px -20px rgba(0, 0, 0, 0.2), 0 1px 3px rgba(0, 0, 0, 0.02);
      border: 1px solid rgba(255, 255, 255, 0.7);
      transition: transform 0.2s ease, box-shadow 0.3s ease;
      width: 100%;
      max-width: 1120px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .glass-card:hover {
      box-shadow: 0 40px 65px -22px rgba(59, 60, 228, 0.25);
    }

    /* brand area - compact */
    .brand-header {
      text-align: center;
      padding: 1.5rem 1.5rem 0.6rem 1.5rem;
      flex-shrink: 0;
    }

    .brand-title {
      font-weight: 800;
      font-size: 2rem;
      letter-spacing: -0.02em;
      background: linear-gradient(135deg, #1e2b4f, #2d3a66);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      display: inline-block;
    }

    .brand-badge {
      background: #eef2ff;
      border-radius: 60px;
      padding: 0.2rem 1rem;
      font-size: 0.7rem;
      font-weight: 600;
      color: #4f46e5;
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      margin-top: 0.4rem;
    }

    /* two column flexible row without scroll */
    .login-grid-row {
      display: flex;
      flex-wrap: nowrap;
      flex: 1;
      min-height: 0;
    }

    .form-panel {
      flex: 1;
      padding: 1.6rem 2rem 1.8rem 2rem;
      background: #ffffff;
      overflow-y: auto;
      scrollbar-width: thin;
    }

    .info-panel {
      flex: 1;
      background: linear-gradient(115deg, #fafcff, #ffffff);
      border-left: 1px solid #eef2fc;
      padding: 1.6rem 1.8rem;
      overflow-y: auto;
      scrollbar-width: thin;
    }

    /* hide scroll on webkit but still functional (if content overflows, but we prevent) */
    .form-panel::-webkit-scrollbar, .info-panel::-webkit-scrollbar {
      width: 4px;
      background: transparent;
    }

    .input-modern {
      border-radius: 28px;
      border: 1.5px solid #e9edf4;
      padding: 0.75rem 1.2rem;
      font-size: 0.9rem;
      transition: all 0.2s;
      background: #ffffff;
      width: 100%;
    }

    .input-modern:focus {
      border-color: #818cf8;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
      outline: none;
    }

    .btn-login {
      background: linear-gradient(105deg, #4f46e5, #6366f1);
      border: none;
      border-radius: 44px;
      padding: 0.75rem 1.2rem;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.2s;
      color: white;
      width: 100%;
      box-shadow: 0 8px 18px rgba(79, 70, 229, 0.25);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      background: linear-gradient(105deg, #4338ca, #4f46e5);
      box-shadow: 0 14px 24px -8px rgba(79, 70, 229, 0.4);
    }

    .btn-outline-modern {
      border-radius: 40px;
      border: 1.5px solid #cbd5e6;
      padding: 0.55rem 1.2rem;
      font-weight: 600;
      transition: all 0.2s;
      color: #2c3e66;
      background: white;
      font-size: 0.85rem;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
    }

    .btn-outline-modern:hover {
      border-color: #4f46e5;
      background: #f8faff;
      color: #4f46e5;
    }

    .feature-list {
      list-style: none;
      padding-left: 0;
      margin: 0;
    }

    .feature-list li {
      margin-bottom: 0.85rem;
      display: flex;
      align-items: center;
      gap: 0.7rem;
      font-size: 0.85rem;
      color: #1f2b48;
    }

    .feature-list li i {
      color: #4f46e5;
      font-size: 1.2rem;
      background: #eef2ff;
      width: 30px;
      height: 30px;
      border-radius: 30px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .divider {
      height: 1px;
      background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
      margin: 1rem 0;
    }

    .link-help {
      color: #5b6e8c;
      text-decoration: none;
      font-size: 0.8rem;
      font-weight: 500;
      transition: color 0.2s;
    }

    .link-help:hover {
      color: #4f46e5;
      text-decoration: underline;
    }

    .copyright {
      text-align: center;
      font-size: 0.7rem;
      color: #7e8ba3;
      padding: 0.9rem 1rem;
      border-top: 1px solid #edf2f7;
      background: #ffffffcc;
      flex-shrink: 0;
    }

    .alert-glass {
      background: #fff5e8;
      border-left: 5px solid #f59e0b;
      border-radius: 20px;
      padding: 0.6rem 1rem;
      margin-bottom: 1.2rem;
      font-size: 0.8rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }

    /* fix for no scroll on body/container */
    h3, p, .form-group {
      margin-bottom: 0.8rem;
    }

    .mb-3 {
      margin-bottom: 0.85rem !important;
    }
    .mt-3 {
      margin-top: 0.85rem !important;
    }
    .mb-4 {
      margin-bottom: 1rem !important;
    }
    .mt-4 {
      margin-top: 1rem !important;
    }

    @media (max-width: 780px) {
      .login-grid-row {
        flex-direction: column;
      }
      .info-panel {
        border-left: none;
        border-top: 1px solid #eef2fc;
      }
      .form-panel, .info-panel {
        padding: 1.2rem;
      }
      .brand-title {
        font-size: 1.6rem;
      }
    }

    /* ensure height never overflows */
    .glass-card {
      max-height: 95vh;
    }

    /* fade in animation smooth */
    @keyframes fadeSlide {
      0% { opacity: 0; transform: translateY(8px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .glass-card {
      animation: fadeSlide 0.4s ease-out;
    }

    /* fix label styling */
    .form-label {
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      color: #4b5a7c;
      margin-bottom: 0.3rem;
    }

    .input-group-custom {
      display: flex;
      align-items: center;
      background: #fff;
      border-radius: 28px;
      border: 1.5px solid #e9edf4;
      transition: all 0.2s;
    }
    .input-group-custom:focus-within {
      border-color: #818cf8;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
    }
    .input-icon {
      padding: 0 0 0 1rem;
      color: #94a3b8;
      font-size: 1rem;
    }
    .input-icon i {
      display: flex;
      align-items: center;
    }
    .input-clean {
      border: none;
      background: transparent;
      padding: 0.75rem 1rem 0.75rem 0.5rem;
      width: 100%;
      font-size: 0.9rem;
      outline: none;
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body>
<div class="login-container">
  <div class="glass-card">
    <div class="brand-header">
      <h1 class="brand-title">
        <span style="color: #e53e3e;">Right</span>
        <span style="color: #f97316;">2</span>
        <span style="color: #10b981;">Thrive</span>
        <span style="color: #1e293b;"> UK Hub</span>
      </h1>
      <div class="brand-badge"><i class="bi bi-shield-check"></i> secure member portal</div>
    </div>

    <div class="login-grid-row">
      <!-- LEFT: LOGIN FORM -->
      <div class="form-panel">
        <h3 style="font-weight: 700; font-size: 1.6rem; letter-spacing: -0.3px;">Welcome back</h3>
        <p class="text-muted" style="font-size: 0.8rem; margin-bottom: 1.2rem;">Sign in to access your learning dashboard, tasks & mentoring.</p>

        <?php if(!empty($msg)): ?>
          <div class="alert-glass">
            <i class="bi bi-exclamation-triangle-fill text-warning"></i>
            <span><?php echo htmlspecialchars($msg); ?></span>
          </div>
        <?php endif; ?>

        <form name="FRMLOGIN" action="user_login.php" method="post" onSubmit="return checklogin();">
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <div class="input-group-custom">
              <span class="input-icon"><i class="bi bi-envelope"></i></span>
              <input type="email" class="input-clean" id="uname" placeholder="you@example.com" name="TXUSERID" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group-custom">
              <span class="input-icon"><i class="bi bi-lock"></i></span>
              <input type="password" class="input-clean" id="pwd" placeholder="••••••••" name="TXPASSWORD" required>
            </div>
          </div>
          <button type="submit" class="btn-login"><i class="bi bi-box-arrow-in-right"></i> Sign in</button>
          <div class="d-flex justify-content-between mt-3 flex-wrap gap-2">
            <a href="../forgotpwd.php" class="link-help"><i class="bi bi-question-circle"></i> Forgot password?</a>
            <a href="javascript:void(0);" onclick="openwin();" class="link-help"><i class="bi bi-headset"></i> Trouble signing in?</a>
          </div>
        </form>
      </div>

      <!-- RIGHT: INFO / BENEFITS (compact, no overflow) -->
      <div class="info-panel">
        <div class="mb-2">
          <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill" style="font-size: 0.7rem;"><i class="bi bi-stars"></i> New to digital learning?</span>
        </div>
        <h4 style="font-weight: 700; font-size: 1.3rem; margin-bottom: 0.6rem;">Unlock your future</h4>
        <p class="text-secondary mb-3" style="font-size: 0.8rem;">Join thousands of learners who are accelerating their careers with personalised support.</p>
        
        <ul class="feature-list">
          <li><i class="bi bi-briefcase-fill"></i> <span><strong>Improve job prospects</strong> — gain in-demand skills employers seek.</span></li>
          <li><i class="bi bi-trophy-fill"></i> <span><strong>Key skills for employment</strong> — from IT to communication.</span></li>
          <li><i class="bi bi-chat-dots-fill"></i> <span><strong>1-2-1 tutoring & mentoring</strong> — real human support.</span></li>
          <li><i class="bi bi-people-fill"></i> <span><strong>No peer pressure</strong> — learn at your own pace, stress‑free.</span></li>
        </ul>
        
        <div class="divider"></div>
        
        <div class="text-center text-md-start">
          <a href="register.php" class="btn-outline-modern"><i class="bi bi-pen-fill"></i>Create free account</a>
          <p class="small text-muted mt-2 mb-0" style="font-size: 0.7rem;"><i class="bi bi-shield-lock-fill"></i> Instant access to the hub after registration</p>
        </div>
      </div>
    </div>
    
    <div class="copyright">
      <p class="mb-0">Copyright &copy; <?php echo date("Y"); ?>, <strong>Right2Thrive UK Ltd</strong> — All rights reserved.</p>
    </div>
  </div>
</div>

<!-- No external heavy libs to keep fast, only vanilla JS -->
<script type="text/javascript">
  // Focus on load
  window.onload = function() {
    if(document.FRMLOGIN && document.FRMLOGIN.TXUSERID) {
      document.FRMLOGIN.TXUSERID.focus();
    }
    // Ensure body has no scroll
    document.body.style.overflow = 'hidden';
  };

  // Enhanced checklogin with modern validation
  function checklogin() {
    var emailField = document.FRMLOGIN.TXUSERID;
    var pwdField = document.FRMLOGIN.TXPASSWORD;
    var email = emailField.value.trim();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    if (!filter.test(email)) {
      alert("Please enter a valid email address (e.g. name@example.com)");
      emailField.value = "";
      emailField.focus();
      return false;
    }
    if (pwdField.value.trim() === "") {
      alert("Password cannot be empty. Please enter your password.");
      pwdField.value = "";
      pwdField.focus();
      return false;
    }
    return true;
  }

  function openwin() {
    window.open("help.htm", "", 'height=450,width=620,scrollbars=yes,top=100,left=200');
  }

  // preserve ga (if needed)
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34503062-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>