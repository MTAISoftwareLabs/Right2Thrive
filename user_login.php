<?php
// Start output buffering to prevent header issues
ob_start();

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once __DIR__ . '/career_progress_lib.php';
require_once __DIR__ . '/onboarding_lib.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "dbConnection.php"; ?>
    <title>Right2Thrive UK Hub | Modern Login<?php echo sitename; ?></title>
    <?php include "metadata.php"; ?>
    <meta name="description" content="Right2Thrive UK Collective Careers Hub — skills, learning, and career support." />
    <meta name="keywords" content="Right2Thrive, careers, UK, collective hub" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#0f6b5c">
    
    <!-- Modern Fonts & Icons -->
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
            background: linear-gradient(135deg, #f0f4fe 0%, #e6ecf8 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 30%, rgba(79, 70, 229, 0.08) 0%, rgba(59, 60, 228, 0.02) 80%);
            pointer-events: none;
            z-index: 0;
        }

        /* Navbar styling - preserved and modernized */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            padding: 0.8rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.3rem;
            background: linear-gradient(135deg, #1e2b4f, #2d3a66);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Main container */
        .login-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            min-height: calc(100vh - 70px);
        }

        .glass-master {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 48px;
            box-shadow: 0 30px 55px -20px rgba(0, 0, 0, 0.18), 0 1px 3px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.6);
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 1280px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .glass-master:hover {
            box-shadow: 0 40px 65px -22px rgba(59, 60, 228, 0.2);
        }

        .brand-zone {
            text-align: center;
            padding: 1.2rem 1.5rem 0.5rem 1.5rem;
            flex-shrink: 0;
        }

        .brand-wordmark {
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #1e2b4f, #2d3a66);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }

        .brand-wordmark span {
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
        }

        .trust-badge {
            background: #eef2ff;
            border-radius: 60px;
            padding: 0.2rem 1rem;
            font-size: 0.7rem;
            font-weight: 600;
            color: #4f46e5;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            margin-top: 0.3rem;
        }

        .split-layout {
            display: flex;
            flex-wrap: nowrap;
            flex: 1;
            min-height: 0;
        }

        .login-panel {
            flex: 1;
            padding: 1.4rem 2rem 1.8rem 2rem;
            background: #ffffff;
        }

        .info-panel {
            flex: 1;
            background: linear-gradient(115deg, #fafcff, #ffffff);
            border-left: 1px solid #eef2fc;
            padding: 1.4rem 1.8rem;
        }

        .input-group-fancy {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 36px;
            border: 1.5px solid #e9edf4;
            transition: all 0.2s;
        }

        .input-group-fancy:focus-within {
            border-color: #818cf8;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        }

        .input-icon {
            padding: 0 0 0 1.2rem;
            color: #94a3b8;
            font-size: 1rem;
            display: flex;
            align-items: center;
        }

        .input-clean {
            border: none;
            background: transparent;
            padding: 0.75rem 1rem 0.75rem 0.6rem;
            width: 100%;
            font-size: 0.9rem;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .btn-login-modern {
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
            gap: 0.6rem;
            cursor: pointer;
        }

        .btn-login-modern:hover {
            transform: translateY(-2px);
            background: linear-gradient(105deg, #4338ca, #4f46e5);
            box-shadow: 0 14px 24px -8px rgba(79, 70, 229, 0.4);
        }

        .btn-outline-light {
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

        .btn-outline-light:hover {
            border-color: #4f46e5;
            background: #f8faff;
            color: #4f46e5;
        }

        .feature-bullets {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .feature-bullets li {
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 0.85rem;
            color: #1f2b48;
        }

        .feature-bullets li i {
            color: #4f46e5;
            font-size: 1.1rem;
            background: #eef2ff;
            width: 30px;
            height: 30px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .divider-grace {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 1rem 0;
        }

        .link-muted {
            color: #5b6e8c;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .link-muted:hover {
            color: #4f46e5;
            text-decoration: underline;
        }

        .copyright-footer {
            text-align: center;
            font-size: 0.7rem;
            color: #7e8ba3;
            padding: 0.8rem 1rem;
            border-top: 1px solid #edf2f7;
            background: #ffffffcc;
            flex-shrink: 0;
        }

        .alert-glass {
            background: #fff5e8;
            border-left: 5px solid #f59e0b;
            border-radius: 24px;
            padding: 0.6rem 1rem;
            margin-bottom: 1.2rem;
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .form-label-modern {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #4b5a7c;
            margin-bottom: 0.3rem;
            display: block;
        }

        h3 {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.3px;
            margin-bottom: 0.3rem;
        }

        .hub-badge {
            background: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
            border-radius: 30px;
            padding: 0.2rem 0.9rem;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(12px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-master {
            animation: slideUp 0.45s ease-out;
        }

        @media (max-width: 780px) {
            .split-layout {
                flex-direction: column;
            }
            .info-panel {
                border-left: none;
                border-top: 1px solid #eef2fc;
            }
            .login-panel,
            .info-panel {
                padding: 1.2rem;
            }
            .brand-wordmark {
                font-size: 1.5rem;
            }
            .navbar-modern {
                padding: 0.5rem 1rem;
            }
        }
    </style>
</head>

<body>
    <?php
    // ==============================================
    // PRESERVED PHP LOGIC - EXACTLY AS ORIGINAL
    // ==============================================
    $msg = "";
    
    function career_post_login_redirect($conn, $res)
    {
        $userType = isset($res['iUserType']) ? (int) $res['iUserType'] : 0;
        $userId = isset($res['iUserId']) ? (int) $res['iUserId'] : 0;
        if ($userType === 2 && $userId > 0) {
            career_bootstrap_user_profile($conn, $userId);
            $summary = career_get_user_summary($conn, $userId);
            $assessmentCompleted = isset($summary['career_assessment_completed']) ? (int) $summary['career_assessment_completed'] : 0;
            if ($assessmentCompleted === 0 || !empty($_SESSION['require_assessment'])) {
                $_SESSION['require_assessment'] = true;
                header('Location: career_assessment.php');
                exit;
            }
        }
    }
    
    function user_login_failure_message($conn, $email_login, $pass_login)
    {
        $msg = 'Invalid User ID or Password';
        if ($email_login === '') {
            return $msg;
        }
        $cols = onboarding_login_select_columns($conn);
        $st = mysqli_prepare($conn, 'SELECT ' . $cols . ' FROM cpo_usermaster WHERE vUserEmailId = ?');
        if (!$st) {
            return $msg;
        }
        mysqli_stmt_bind_param($st, 's', $email_login);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        if (!$rs) {
            mysqli_stmt_close($st);
            return $msg;
        }
        while ($row = mysqli_fetch_assoc($rs)) {
            if (!hash_equals((string) $row['vUserPassword'], $pass_login)) {
                continue;
            }
            mysqli_stmt_close($st);
            if (onboarding_schema_ready($conn)) {
                $reason = onboarding_login_block_reason($row, (string) $row['vUserPassword'], $pass_login);
                if ($reason !== '') {
                    return $reason;
                }
            } elseif ((int) ($row['iUserStatus'] ?? 0) !== 1) {
                return 'Your account exists but is not active yet. Please contact support or ask an administrator to activate your learner account.';
            }
            return $msg;
        }
        mysqli_stmt_close($st);
        return $msg;
    }

    function user_login_attempt($conn, $email_login, $pass_login)
    {
        $cols = onboarding_login_select_columns($conn);
        $stmt = mysqli_prepare($conn, 'SELECT ' . $cols . ' FROM cpo_usermaster WHERE vUserEmailId = ?');
        if (!$stmt) {
            return array('user' => null, 'error' => 'Invalid User ID or Password');
        }
        mysqli_stmt_bind_param($stmt, 's', $email_login);
        mysqli_stmt_execute($stmt);
        $rschange = mysqli_stmt_get_result($stmt);
        if ($rschange) {
            while ($row = mysqli_fetch_assoc($rschange)) {
                if (!hash_equals((string) $row['vUserPassword'], $pass_login)) {
                    continue;
                }
                mysqli_stmt_close($stmt);
                if (onboarding_schema_ready($conn)) {
                    $reason = onboarding_login_block_reason($row, (string) $row['vUserPassword'], $pass_login);
                    if ($reason !== '') {
                        return array('user' => null, 'error' => $reason);
                    }
                    if (!onboarding_user_may_login($row)) {
                        return array(
                            'user' => null,
                            'error' => 'Your account cannot be used to sign in yet. Please verify your email and wait for administrator approval.',
                        );
                    }
                } elseif ((int) ($row['iUserStatus'] ?? 0) !== 1) {
                    return array(
                        'user' => null,
                        'error' => 'Your account exists but is not active yet. Please contact support or ask an administrator to activate your learner account.',
                    );
                }
                return array('user' => $row, 'error' => '');
            }
        }
        mysqli_stmt_close($stmt);
        return array('user' => null, 'error' => user_login_failure_message($conn, $email_login, $pass_login));
    }
    
    if (isset($_POST['TXUSERID'])) {
        $email_login = trim((string) $_POST['TXUSERID']);
        $pass_login = (string) $_POST['TXPASSWORD'];
        $loginResult = user_login_attempt($conn, $email_login, $pass_login);
        $res = $loginResult['user'];
        if ($res) {
            $_SESSION['user_id'] = $res['iUserId'];
            $_SESSION['user_name'] = $res['vUserName'];
            $_SESSION['email_id'] = $res['vUserName'];
            $_SESSION['module'] = $res['iUserType'];
            $_SESSION['log_fill'] = 0;
            $HTTP_SESSION_VARS['user_id'] = $res['iUserId'];
            $HTTP_SESSION_VARS['user_name'] = $res['vUserName'];
            $HTTP_SESSION_VARS['email_id'] = $_POST['TXUSERID'];
            $HTTP_SESSION_VARS['module'] = $res['iUserType'];
            $HTTP_SESSION_VARS['log_fill'] = 0;
            
            if ($res['iUserType'] == 1) {
                $sectionname = "TMS";
            }
            if ($res['iUserType'] == 2) {
                $sectionname = "LMS";
            }
            if ($res['iUserType'] == 4) {
                $sectionname = "TPM";
            }
            
            function clean_strings($string) {
                $bad = array("content-type", "bcc:", "to:", "cc:", "href");
                return str_replace($bad, "", $string);
            }
            
            $first_name = $_SESSION['user_name'];
            $email_from = $_SESSION['email_id'];
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
                error_log('Login notification email: ' . $mail->ErrorInfo);
            }
            
            if ($res['iUserType'] == 1) {
                tutor_counter(1);
                header('Location: ' . app_tutor_tms_dashboard_href());
                exit;
            }
            if ($res['iUserType'] == 2) {
                career_post_login_redirect($conn, $res);
                addlog(1);
                header('Location: lms/index.php');
                exit;
            }
            if ($res['iUserType'] == 4) {
                header('Location: ' . app_tutor_tpm_dashboard_href());
                exit;
            }
        } else {
            $msg = $loginResult['error'] !== '' ? $loginResult['error'] : user_login_failure_message($conn, $email_login, $pass_login);
        }
    }
    
    if (isset($_POST['reglogin_x'])) {
        extract($_POST);
        $email_login = trim((string) $_POST['TXUSERID1']);
        $pass_login = (string) $_POST['TXPASSWORD1'];
        $loginResult = user_login_attempt($conn, $email_login, $pass_login);
        $res = $loginResult['user'];
        if ($res) {
            $_SESSION['user_id'] = $res['iUserId'];
            $_SESSION['user_name'] = $res['vUserName'];
            $_SESSION['email_id'] = $res['vUserName'];
            $_SESSION['module'] = $res['iUserType'];
            $_SESSION['log_fill'] = 0;
            $HTTP_SESSION_VARS['user_id'] = $res['iUserId'];
            $HTTP_SESSION_VARS['user_name'] = $res['vUserName'];
            $HTTP_SESSION_VARS['email_id'] = $_POST['TXUSERID1'];
            $HTTP_SESSION_VARS['module'] = $res['iUserType'];
            $HTTP_SESSION_VARS['log_fill'] = 0;
            
            if ($res['iUserType'] == 1) {
                $sectionname = "TMS";
            }
            if ($res['iUserType'] == 2) {
                $sectionname = "LMS";
            }
            if ($res['iUserType'] == 4) {
                $sectionname = "TPM";
            }
            
            $fromname = 'Right2Thrive UK Collective Careers Hub';
            $fromaddress = $HTTP_SESSION_VARS['email_id'];
            $toname = 'Colin';
            $toaddress = 'info@careerpathsonline.net';
            $subject = "Member '" . $HTTP_SESSION_VARS['user_name'] . "' has been logged in";
            $message = "<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'><P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Member <b>'" . $HTTP_SESSION_VARS['user_name'] . "'</b> has been logged in CareerPaths Online at <b>" . date('d-m-Y G:i:s') . "</b> in <b>" . $sectionname . "</b> Section.";
            SendingMail($fromname, $fromaddress, $fromname, $toaddress, $subject, $message);
            
            if ($res['iUserType'] == 1) {
                tutor_counter(1);
                header('Location: ' . app_tutor_tms_dashboard_href());
                exit;
            }
            if ($res['iUserType'] == 2) {
                career_post_login_redirect($conn, $res);
                addlog(1);
                header('Location: lms/index.php');
                exit;
            }
            if ($res['iUserType'] == 4) {
                header('Location: ' . app_tutor_tpm_dashboard_href());
                exit;
            }
        } else {
            $msg = $loginResult['error'] !== '' ? $loginResult['error'] : user_login_failure_message($conn, $email_login, $pass_login);
        }
    }
    ?>
    
    <!-- INCLUDE ORIGINAL NAVBAR HEADER -->
    <?php include('lms/user_log_header.php'); ?>
    
    <!-- MODERN LOGIN UI -->
    <div class="login-wrapper">
        <div class="glass-master">
            <div class="brand-zone">
                <h1 class="brand-wordmark">
                    <span style="color: #e53e3e;">Right</span>
                    <span style="color: #f97316;">2</span>
                    <span style="color: #10b981;">Thrive</span>
                    <span style="color: #1e293b;"> UK Hub</span>
                </h1>
                <div class="trust-badge"><i class="bi bi-shield-check"></i> collective careers hub · secure portal</div>
            </div>

            <div class="split-layout">
                <!-- LEFT: LOGIN FORM -->
                <div class="login-panel">
                    <h3>Welcome back</h3>
                    <p style="font-size: 0.85rem; color: #5b6e8c; margin-bottom: 1.2rem;">Access your learning dashboard, mentoring & career tools.</p>

                    <?php if (!empty($msg)): ?>
                        <div class="alert-glass">
                            <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                            <span><?php echo htmlspecialchars($msg); ?></span>
                        </div>
                        <?php if (strpos($msg, 'finish the sign-up questionnaire') !== false) { ?>
                            <p style="margin-top:0.75rem;font-size:0.9rem;">
                                <a href="<?php echo htmlspecialchars(onboarding_complete_registration_url(), ENT_QUOTES, 'UTF-8'); ?>"><strong>Complete your registration questionnaire</strong></a>
                            </p>
                        <?php } ?>
                    <?php endif; ?>

                    <form name="FRMLOGIN" action="user_login.php" method="post" onSubmit="return checklogin();">
                        <div style="margin-bottom: 1rem;">
                            <label class="form-label-modern">Email or username</label>
                            <div class="input-group-fancy">
                                <span class="input-icon"><i class="bi bi-envelope"></i></span>
                                <input type="text" class="input-clean" id="uname" placeholder="you@example.com" name="TXUSERID" required autocomplete="username">
                            </div>
                        </div>
                        <div style="margin-bottom: 1.2rem;">
                            <label class="form-label-modern">Password</label>
                            <div class="input-group-fancy">
                                <span class="input-icon"><i class="bi bi-lock"></i></span>
                                <input type="password" class="input-clean" id="pwd" placeholder="••••••••" name="TXPASSWORD" required autocomplete="current-password">
                            </div>
                        </div>
                        <button type="submit" class="btn-login-modern"><i class="bi bi-box-arrow-in-right"></i> Sign in</button>
                        <div class="d-flex justify-content-between mt-3 flex-wrap gap-2">
                            <a href="forgotpwd" class="link-muted"><i class="bi bi-question-circle"></i> Forgot password?</a>
                            <a href="javascript:void(0);" onclick="openwin();" class="link-muted"><i class="bi bi-headset"></i> Trouble signing in?</a>
                        </div>
                        <div class="mt-3">
                            <a href="register" class="btn-outline-light"><i class="bi bi-pen-fill"></i> Create free account</a>
                        </div>
                    </form>
                </div>

                <!-- RIGHT: INFO / BENEFITS SECTION -->
                <div class="info-panel">
                    <div class="mb-2">
                        <span class="hub-badge"><i class="bi bi-stars"></i> Right2Thrive collective</span>
                    </div>
                    <h4 style="font-weight: 700; font-size: 1.3rem; margin-bottom: 0.5rem;">Your career engine</h4>
                    <p style="font-size: 0.8rem; color: #5b6e8c; margin-bottom: 1rem;">The careers hub — mentoring, skills, and real opportunities.</p>
                    
                    <ul class="feature-bullets">
                        <li><i class="bi bi-briefcase-fill"></i> <span><strong>Job prospects boost</strong> — in-demand skills for employers.</span></li>
                        <li><i class="bi bi-trophy-fill"></i> <span><strong>Key employment skills</strong> — IT, communication, teamwork.</span></li>
                        <li><i class="bi bi-chat-dots-fill"></i> <span><strong>1-2-1 mentoring</strong> — dedicated coach support.</span></li>
                        <li><i class="bi bi-people-fill"></i> <span><strong>Self-paced learning</strong> — zero peer pressure.</span></li>
                        <li><i class="bi bi-graph-up"></i> <span><strong>Career planning tools</strong> — track your progress.</span></li>
                    </ul>
                    
                    <div class="divider-grace"></div>
                    
                    <div class="mt-2">
                        <p class="small text-muted mb-1"><i class="bi bi-building"></i> <strong>Tutor?</strong> Use your staff login to access learner support dashboards.</p>
                        <p class="small text-muted"><i class="bi bi-shield-lock-fill"></i> Secure member area · UK collective hub</p>
                    </div>
                </div>
            </div>
            
            <div class="copyright-footer">
                <p class="mb-0">Copyright &copy; <?php echo date("Y"); ?>, <strong>Right2Thrive UK Ltd</strong> — All rights reserved. Career & learning hub</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(window).on("load", function() {
            $("#uname").focus();
        });

        function checklogin() {
            var form = document.FRMLOGIN;
            if (!form) {
                return true;
            }
            var user = (form.TXUSERID && form.TXUSERID.value) ? form.TXUSERID.value.trim() : "";
            if (user.length < 3 || user.length > 254) {
                alert("Please enter a valid username or email address.");
                if (form.TXUSERID) {
                    form.TXUSERID.focus();
                }
                return false;
            }
            if (user.indexOf("@") !== -1) {
                var filter = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!filter.test(user)) {
                    alert("Please enter a valid email address.");
                    if (form.TXUSERID) {
                        form.TXUSERID.focus();
                    }
                    return false;
                }
            }
            var pass = form.TXPASSWORD && form.TXPASSWORD.value ? form.TXPASSWORD.value : "";
            if (pass.length === 0) {
                alert("Please enter your password.");
                if (form.TXPASSWORD) {
                    form.TXPASSWORD.focus();
                }
                return false;
            }
            return true;
        }

        function openwin() {
            window.open("login-help", "", 'height=400,width=600,scrollbars=yes,top=50 left=150');
        }
    </script>
    <?php include "footer.php"; ?>
</body>

</html>
<?php
// Flush the output buffer at the end
ob_end_flush();
?>