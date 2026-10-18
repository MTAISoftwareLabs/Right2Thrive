<?php
declare(strict_types=1);

ob_start();
require_once __DIR__ . '/dbConnection.php';

$msg = '';
$form = '';
$alertLevel = 'warning';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['TXEMAIL'])) {
    $email = trim((string) $_POST['TXEMAIL']);
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please enter a valid email address.';
    } else {
        $st = mysqli_prepare($conn, 'SELECT vUserName, vUserEmailId, vUserPassword FROM cpo_usermaster WHERE vUserEmailId = ? LIMIT 1');
        $row = null;
        if ($st) {
            mysqli_stmt_bind_param($st, 's', $email);
            mysqli_stmt_execute($st);
            $rs = mysqli_stmt_get_result($st);
            $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
            mysqli_stmt_close($st);
        }

        if (!$row) {
            $msg = 'No account was found for that email address. Check the spelling or contact support.';
        } else {
            $fromname = 'Right2Thrive UK Collective Careers Hub';
            $fromaddress = defined('admin_email') ? admin_email : app_env('ADMIN_EMAIL', 'info@right2thrive.org');
            $toname = (string) ($row['vUserName'] ?? 'Member');
            $toaddress = (string) ($row['vUserEmailId'] ?? $email);
            $subject = 'Your Right2Thrive UK hub login details';
            $loginEmail = htmlspecialchars($toaddress, ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars((string) ($row['vUserPassword'] ?? ''), ENT_QUOTES, 'UTF-8');
            $message = '<p>Hello ' . htmlspecialchars($toname, ENT_QUOTES, 'UTF-8') . ',</p>'
                . '<p>You requested a reminder of your login details:</p>'
                . '<p><strong>Login email:</strong> ' . $loginEmail . '<br>'
                . '<strong>Password:</strong> ' . $password . '</p>'
                . '<p>If you did not request this email, please contact support.</p>'
                . '<p>Kind regards,<br><strong>Right2Thrive UK Collective Careers Hub</strong></p>';

            $sent = SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
            if ($sent) {
                $msg = 'We have emailed your login details to ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '.';
                $form = 'hidden';
                $alertLevel = 'success';
            } elseif (function_exists('app_smtp_is_configured') && !app_smtp_is_configured()) {
                $msg = 'Email is not configured on this server. An administrator must set MAIL_HOST, MAIL_USERNAME, and MAIL_PASSWORD in the .env file (see .env.example).';
            } else {
                $msg = 'We could not send the email. Please try again later or contact support.';
            }
        }
    }
}

// Legacy query flags from old tutorapp/forgotpwd.php
if ($msg === '' && isset($_GET['flag'])) {
    $flag = preg_replace('/[^0-9]/', '', (string) $_GET['flag']);
    if ($flag === '2') {
        $msg = 'We have emailed your login details.';
        $form = 'hidden';
        $alertLevel = 'success';
    } elseif ($flag === '1') {
        $msg = 'No account was found for that email address.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'metadata.php'; ?>
  <title>Password recovery<?php echo sitename; ?></title>
</head>
<body>
<div class="container">
	<header>
		<div class="row">
			<div class="col-md-12">
				<h1 class="pagetitle text-center">Right2Thrive UK Collective Careers Hub</h1>
			</div>
		</div>
	</header>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="row form-card">
				<div class="col-md-12 form-card-head"><h2>Password recovery</h2></div>
				<div class="col-md-12 desc-section">
					  <h5>Reset your password</h5>
					  <?php if ($msg !== '') { ?>
						<div class="lfm alert alert-<?php echo htmlspecialchars($alertLevel, ENT_QUOTES, 'UTF-8'); ?>"><?php echo $msg; ?></div>
					  <?php } ?>
					  <form action="forgotpwd.php" method="post" name="FRMPERSONAL" id="FRMPERSONAL"<?php echo $form === 'hidden' ? ' style="display:none;"' : ''; ?>>
						<div class="form-group">
						  <label for="uname">Enter the email address you use to sign in. We will email your login details.</label>
						  <input type="email" class="form-control" id="uname" placeholder="Your login email" name="TXEMAIL" required autocomplete="email">
						</div>
						<button type="submit" class="btn btn-primary"><i class="fa fa-unlock-alt"></i> Send reminder</button>
					  </form>
					  <div class="space35"></div>
					  <div>
						  <a href="user_login.php">Back to sign in</a>
						  <a href="register.php" style="float:right;">Create an account</a>
					  </div>
					  <div class="space35"></div>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
	<footer>
		<?php include 'footer.php'; ?>
	</footer>
</div>
</body>
</html>
