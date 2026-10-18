<?php

require_once __DIR__ . '/dbConnection.php';

$emailSent = !empty($_SESSION['registration_email_sent']);
$emailNote = isset($_SESSION['registration_email_note']) ? (string) $_SESSION['registration_email_note'] : '';
$verifyLink = isset($_SESSION['registration_verify_link']) ? (string) $_SESSION['registration_verify_link'] : '';
unset($_SESSION['registration_email_sent'], $_SESSION['registration_email_note'], $_SESSION['registration_verify_link']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration received<?php echo sitename; ?></title>
    <?php include 'metadata.php'; ?>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h3">Thank you for registering</h1>
                    <p>Your registration questionnaire has been saved. To activate your account you need to:</p>
                    <ol>
                        <li><strong>Verify your email</strong> — use the link we send to your inbox (check spam/junk).</li>
                        <li><strong>Wait for super administrator approval</strong> — you will be able to sign in once your account is approved.</li>
                    </ol>
                    <?php if ($emailSent): ?>
                        <div class="alert alert-success">A verification email has been sent to your inbox. Please check your email (and spam/junk) and click the confirmation link.</div>
                    <?php elseif ($emailNote !== ''): ?>
                        <div class="alert alert-warning"><?php echo htmlspecialchars($emailNote, ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php else: ?>
                        <div class="alert alert-info">We could not confirm whether the verification email was sent. If you do not receive it within a few minutes, contact support or ask a super administrator to resend verification from Pending learner registrations.</div>
                    <?php endif; ?>
                    <?php if ($verifyLink !== ''): ?>
                        <div class="alert alert-secondary mt-3">
                            <p class="mb-1"><strong>Development note:</strong> SMTP is not configured. Save this verification link:</p>
                            <p class="mb-0 small"><a href="<?php echo htmlspecialchars($verifyLink, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($verifyLink, ENT_QUOTES, 'UTF-8'); ?></a></p>
                        </div>
                    <?php endif; ?>
                    <p class="mt-4 mb-0"><a href="user_login.php">Return to sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
