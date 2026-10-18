<?php



require_once __DIR__ . '/dbConnection.php';

require_once __DIR__ . '/onboarding_lib.php';



$token = isset($_GET['token']) ? trim((string) $_GET['token']) : '';

$status = 'invalid';

$message = 'This verification link is invalid or has expired.';



if ($token !== '') {

    $user = onboarding_fetch_user_by_token($conn, $token);

    if ($user) {

        if (onboarding_schema_ready($conn) && (int) ($user['email_verified'] ?? 0) === 1) {

            $status = 'already';

            $message = 'Your email is already verified. You can close this page.';

        } elseif (onboarding_mark_email_verified($conn, (int) $user['iUserId'])) {

            $status = 'ok';

            $message = 'Your email has been verified. A super administrator will review your account next. You will be able to sign in after approval.';

        } else {

            $status = 'error';

            $message = 'We could not update your account. Please run migrate_onboarding.php or contact support.';

        }

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>


    <title>Email verification<?php echo sitename; ?></title>

    <?php include 'metadata.php'; ?>

</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-body text-center p-4">

                    <?php if ($status === 'ok'): ?>

                        <h1 class="h3 text-success">Email verified</h1>

                    <?php elseif ($status === 'already'): ?>

                        <h1 class="h3 text-info">Already verified</h1>

                    <?php else: ?>

                        <h1 class="h3 text-warning">Verification</h1>

                    <?php endif; ?>

                    <p class="mt-3"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>

                    <p class="mt-4"><a href="user_login.php" class="btn btn-primary">Go to sign in</a></p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'footer.php'; ?>

</body>

</html>

