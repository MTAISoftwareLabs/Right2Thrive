<?php

declare(strict_types=1);

ob_start();
require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/onboarding_lib.php';

onboarding_ensure_schema($conn);

$er = '';
$step = 'login';
$resumeUserId = isset($_SESSION['onboarding_resume_user_id']) ? (int) $_SESSION['onboarding_resume_user_id'] : 0;

if (isset($_GET['cancel'])) {
    unset($_SESSION['onboarding_resume_user_id']);
    header('Location: complete_registration.php');
    exit;
}

if (isset($_POST['verify_account'])) {
    $email = trim((string) ($_POST['TXemailid'] ?? ''));
    $password = (string) ($_POST['TXpwd'] ?? '');
    $row = onboarding_fetch_learner_by_email_password($conn, $email, $password);
    if (!$row) {
        $er = 'We could not find a learner account with that email and password.';
    } elseif (onboarding_questionnaire_is_complete($row) && (int) ($row['email_verified'] ?? 0) === 1) {
        $er = 'This account has already completed registration. You can sign in on the login page.';
    } else {
        $_SESSION['onboarding_resume_user_id'] = (int) $row['iUserId'];
        $resumeUserId = (int) $row['iUserId'];
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        header('Location: register.php?resume_questionnaire=1');
        exit;
    }
}

if ($resumeUserId > 0) {
    if (ob_get_level() > 0) {
        ob_end_clean();
    }
    header('Location: register.php?resume_questionnaire=1');
    exit;
}

$bodyOnLoad = 'document.getElementById("TXemailid")?.focus();';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Complete your registration<?php echo defined('sitename') ? ' · ' . sitename : ''; ?></title>
  <?php include 'metadata.php'; ?>
</head>
<body onload="<?php echo htmlspecialchars($bodyOnLoad, ENT_QUOTES, 'UTF-8'); ?>">
<div class="container">
	<header>
		<div class="row">
			<div class="col-md-12">
				<h1 class="pagetitle text-center">Complete your registration</h1>
			</div>
		</div>
	</header>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="row form-card">
				<div class="col-md-12 form-card-head"><h2>Existing account</h2></div>
				<div class="col-md-12 form-section">
					<p class="form-subtitle">
						If you registered before the new sign-up process, use your <strong>email and password</strong>
						to complete the questionnaire and verify your email.
					</p>
					<?php if ($er !== '') { ?>
						<div class="lfm alert alert-warning"><?php echo htmlspecialchars($er, ENT_QUOTES, 'UTF-8'); ?></div>
					<?php } ?>
					<form method="post">
						<input type="hidden" name="verify_account" value="1">
						<div class="form-group">
							<label for="TXemailid">Email address</label>
							<input type="email" class="form-control" id="TXemailid" name="TXemailid" required autocomplete="username">
						</div>
						<div class="form-group">
							<label for="TXpwd">Password</label>
							<input type="password" class="form-control" id="TXpwd" name="TXpwd" required autocomplete="current-password">
						</div>
						<button type="submit" class="btn btn-primary">Continue to questionnaire</button>
					</form>
					<p class="mt-3"><a href="user_login.php">Back to sign in</a> · <a href="register.php">New registration</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
