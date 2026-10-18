<?php

declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/registration_questionnaire_lib.php';

if (!function_exists('onboarding_column_exists')) {
    function onboarding_column_exists($conn, string $column): bool
    {
        if (!function_exists('career_column_exists')) {
            require_once __DIR__ . '/career_progress_lib.php';
        }
        return career_column_exists($conn, 'cpo_usermaster', $column);
    }
}

if (!function_exists('onboarding_schema_ready')) {
    function onboarding_schema_ready($conn): bool
    {
        return onboarding_column_exists($conn, 'email_verified')
            && onboarding_column_exists($conn, 'registration_questionnaire_at');
    }
}

if (!function_exists('onboarding_ensure_schema')) {
    /**
     * Add onboarding columns if missing (safe to call repeatedly).
     *
     * @return array{ok:bool,messages:array<int,string>}
     */
    function onboarding_ensure_schema($conn): array
    {
        $messages = array();

        if (!onboarding_column_exists($conn, 'email_verified')) {
            if (!mysqli_query($conn, 'ALTER TABLE cpo_usermaster ADD COLUMN email_verified TINYINT(1) NOT NULL DEFAULT 0')) {
                return array('ok' => false, 'messages' => array('Could not add email_verified: ' . mysqli_error($conn)));
            }
            $messages[] = 'Added email_verified column.';
        }
        if (!onboarding_column_exists($conn, 'email_verified_at')) {
            if (!mysqli_query($conn, 'ALTER TABLE cpo_usermaster ADD COLUMN email_verified_at DATETIME NULL DEFAULT NULL')) {
                return array('ok' => false, 'messages' => array('Could not add email_verified_at: ' . mysqli_error($conn)));
            }
            $messages[] = 'Added email_verified_at column.';
        }
        if (!onboarding_column_exists($conn, 'registration_questionnaire_at')) {
            if (!mysqli_query($conn, 'ALTER TABLE cpo_usermaster ADD COLUMN registration_questionnaire_at DATETIME NULL DEFAULT NULL')) {
                return array('ok' => false, 'messages' => array('Could not add registration_questionnaire_at: ' . mysqli_error($conn)));
            }
            $messages[] = 'Added registration_questionnaire_at column.';
        }

        $root = onboarding_questionnaires_root();
        if (!is_dir($root)) {
            mkdir($root, 0755, true);
            $messages[] = 'Created registration_questionnaires storage folder.';
        }
        $htaccess = $root . DIRECTORY_SEPARATOR . '.htaccess';
        if (!is_file($htaccess)) {
            file_put_contents($htaccess, "Require all denied\n");
        }

        if (function_exists('registration_questionnaire_ensure_schema')) {
            $regSetup = registration_questionnaire_ensure_schema($conn);
            if (!$regSetup['ok']) {
                return $regSetup;
            }
            $messages = array_merge($messages, $regSetup['messages']);
        }

        return array('ok' => true, 'messages' => $messages);
    }
}

if (!function_exists('onboarding_generate_token')) {
    function onboarding_generate_token(): string
    {
        return bin2hex(random_bytes(32));
    }
}

if (!function_exists('onboarding_questionnaires_root')) {
    function onboarding_questionnaires_root(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'registration_questionnaires';
    }
}

if (!function_exists('onboarding_user_questionnaire_dir')) {
    function onboarding_user_questionnaire_dir(int $userId): string
    {
        return onboarding_questionnaires_root() . DIRECTORY_SEPARATOR . 'user_' . $userId;
    }
}

if (!function_exists('onboarding_ensure_user_dir')) {
    function onboarding_ensure_user_dir(int $userId): string
    {
        $dir = onboarding_user_questionnaire_dir($userId);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $htaccess = $dir . DIRECTORY_SEPARATOR . '.htaccess';
        if (!is_file($htaccess)) {
            file_put_contents($htaccess, "Require all denied\n");
        }
        return $dir;
    }
}

if (!function_exists('onboarding_app_base_url')) {
    function onboarding_app_base_url(): string
    {
        $fromEnv = app_env('APP_URL', '');
        if ($fromEnv !== '') {
            return rtrim($fromEnv, '/');
        }
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
        if ($scriptDir === '/' || $scriptDir === '.') {
            return $scheme . '://' . $host;
        }
        return $scheme . '://' . $host . rtrim($scriptDir, '/');
    }
}

if (!function_exists('onboarding_verification_url')) {
    function onboarding_verification_url(string $token): string
    {
        return onboarding_app_base_url() . '/verify_email.php?token=' . urlencode($token);
    }
}

if (!function_exists('onboarding_collect_questionnaire_from_post')) {
    function onboarding_collect_questionnaire_from_post(array $post, $conn = null): array
    {
        if ($conn && registration_questionnaire_schema_ready($conn)) {
            return registration_questionnaire_collect_from_post($conn, $post);
        }
        return array(
            'submitted_at' => date('c'),
            'in_work' => isset($post['rnde']) ? (string) $post['rnde'] : '',
            'qualifications_held' => isset($post['TXqua_achieved']) ? trim((string) $post['TXqua_achieved']) : '',
            'employment_detail' => isset($post['TXlong_employed']) ? trim((string) $post['TXlong_employed']) : '',
            'career_interests' => isset($post['TXcareer_ocuu']) ? trim((string) $post['TXcareer_ocuu']) : '',
            'qualifications_wanted' => isset($post['TXqua_likeachieved']) ? trim((string) $post['TXqua_likeachieved']) : '',
            'skills' => isset($post['TXskill_achieved']) ? trim((string) $post['TXskill_achieved']) : '',
            'hobbies' => isset($post['TXhobbies']) ? trim((string) $post['TXhobbies']) : '',
            'has_disability' => isset($post['rnddis']) ? (string) $post['rnddis'] : '',
            'disability_detail' => isset($post['TXdisability']) ? trim((string) $post['TXdisability']) : '',
            'terms_accepted' => !empty($post['chkterm_cond']),
        );
    }
}

if (!function_exists('onboarding_save_registration_questionnaire')) {
    function onboarding_save_registration_questionnaire(int $userId, array $questionnaire, array $personal = array()): bool
    {
        $dir = onboarding_ensure_user_dir($userId);
        $payload = array(
            'user_id' => $userId,
            'questionnaire' => $questionnaire,
            'personal' => $personal,
        );
        $jsonPath = $dir . DIRECTORY_SEPARATOR . 'registration_questionnaire.json';
        $written = file_put_contents(
            $jsonPath,
            json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
        return $written !== false;
    }
}

if (!function_exists('onboarding_load_registration_questionnaire')) {
    function onboarding_load_registration_questionnaire(int $userId): ?array
    {
        $path = onboarding_user_questionnaire_dir($userId) . DIRECTORY_SEPARATOR . 'registration_questionnaire.json';
        if (!is_file($path)) {
            return null;
        }
        $raw = file_get_contents($path);
        if ($raw === false) {
            return null;
        }
        $data = json_decode($raw, true);
        return is_array($data) ? $data : null;
    }
}

if (!function_exists('onboarding_apply_questionnaire_to_user')) {
    function onboarding_apply_questionnaire_to_user($conn, int $userId, array $post): void
    {
        if (registration_questionnaire_schema_ready($conn)) {
            registration_questionnaire_apply_to_user($conn, $userId, $post);
            return;
        }
        $qua = mysqli_real_escape_string($conn, trim((string) ($post['TXqua_achieved'] ?? '')));
        $employed = mysqli_real_escape_string($conn, trim((string) ($post['rnde'] ?? '0')));
        $employedReason = mysqli_real_escape_string($conn, trim((string) ($post['TXlong_employed'] ?? '')));
        $career = mysqli_real_escape_string($conn, trim((string) ($post['TXcareer_ocuu'] ?? '')));
        $quaWant = mysqli_real_escape_string($conn, trim((string) ($post['TXqua_likeachieved'] ?? '')));
        $skills = mysqli_real_escape_string($conn, trim((string) ($post['TXskill_achieved'] ?? '')));
        $hobbies = mysqli_real_escape_string($conn, trim((string) ($post['TXhobbies'] ?? '')));
        $disFlag = mysqli_real_escape_string($conn, trim((string) ($post['rnddis'] ?? '0')));
        $disReason = mysqli_real_escape_string($conn, trim((string) ($post['TXdisability'] ?? '')));
        $now = mysqli_real_escape_string($conn, date('Y-m-d H:i:s'));

        $sql = "UPDATE cpo_usermaster SET
            TUserQualification='" . $qua . "',
            iUserEmployed='" . $employed . "',
            vUserEmployedReason='" . $employedReason . "',
            TUserCareerOccupation='" . $career . "',
            TUserAchive='" . $quaWant . "',
            TUserSkills='" . $skills . "',
            TUserHobbies='" . $hobbies . "',
            iUserDisability='" . $disFlag . "',
            TUserDisabilityReason='" . $disReason . "'";
        if (onboarding_schema_ready($conn)) {
            $sql .= ", registration_questionnaire_at='" . $now . "'";
        }
        $sql .= ' WHERE iUserId=' . $userId;
        mysqli_query($conn, $sql);
    }
}

if (!function_exists('onboarding_fetch_user_by_token')) {
    function onboarding_fetch_user_by_token($conn, string $token): ?array
    {
        $token = trim($token);
        if ($token === '') {
            return null;
        }
        $st = mysqli_prepare($conn, 'SELECT iUserId, vUserName, vUserEmailId, email_verified, iUserStatus FROM cpo_usermaster WHERE random = ? LIMIT 1');
        if (!$st) {
            return null;
        }
        mysqli_stmt_bind_param($st, 's', $token);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        return $row ?: null;
    }
}

if (!function_exists('onboarding_mark_email_verified')) {
    function onboarding_mark_email_verified($conn, int $userId): bool
    {
        if (!onboarding_schema_ready($conn)) {
            return false;
        }
        $now = date('Y-m-d H:i:s');
        $st = mysqli_prepare(
            $conn,
            'UPDATE cpo_usermaster SET email_verified = 1, email_verified_at = ? WHERE iUserId = ?'
        );
        if (!$st) {
            return false;
        }
        mysqli_stmt_bind_param($st, 'si', $now, $userId);
        $ok = mysqli_stmt_execute($st);
        mysqli_stmt_close($st);
        return $ok;
    }
}

if (!function_exists('onboarding_send_verification_email')) {
    /**
     * @return array{sent:bool,error:string}
     */
    function onboarding_send_verification_email($conn, int $userId): array
    {
        $st = mysqli_prepare($conn, 'SELECT vUserName, vUserEmailId, random FROM cpo_usermaster WHERE iUserId = ? LIMIT 1');
        if (!$st) {
            return array('sent' => false, 'error' => 'Could not load user.');
        }
        mysqli_stmt_bind_param($st, 'i', $userId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $user = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        if (!$user || empty($user['vUserEmailId'])) {
            return array('sent' => false, 'error' => 'User email not found.');
        }

        $token = (string) ($user['random'] ?? '');
        if ($token === '') {
            $token = onboarding_generate_token();
            $upd = mysqli_prepare($conn, 'UPDATE cpo_usermaster SET random = ? WHERE iUserId = ?');
            if ($upd) {
                mysqli_stmt_bind_param($upd, 'si', $token, $userId);
                mysqli_stmt_execute($upd);
                mysqli_stmt_close($upd);
            }
        }

        $verifyUrl = onboarding_verification_url($token);
        $name = htmlspecialchars((string) $user['vUserName'], ENT_QUOTES, 'UTF-8');
        $body = '<p>Hello ' . $name . ',</p>'
            . '<p>Thank you for registering with the Right2Thrive UK Collective Careers Hub.</p>'
            . '<p>Please confirm your email address by clicking the link below:</p>'
            . '<p><a href="' . htmlspecialchars($verifyUrl, ENT_QUOTES, 'UTF-8') . '">Verify my email</a></p>'
            . '<p>After verification, a super administrator will review your application. You will be able to sign in once your account has been approved.</p>'
            . '<p>If you did not register, you can ignore this message.</p>';

        if (!app_smtp_is_configured()) {
            $_SESSION['verification_link_' . $userId] = $verifyUrl;
            return array(
                'sent' => false,
                'error' => 'SMTP is not fully configured. Add MAIL_PASSWORD to .env, then use Resend verification in super admin.',
            );
        }

        $result = app_send_smtp_mail(
            (string) $user['vUserEmailId'],
            (string) $user['vUserName'],
            'Confirm your Right2Thrive UK account',
            $body,
            "Please open this link to verify your email:\n" . $verifyUrl
        );
        if (!$result['sent']) {
            $_SESSION['verification_link_' . $userId] = $verifyUrl;
        }
        return $result;
    }
}

if (!function_exists('onboarding_user_may_login')) {
    function onboarding_user_may_login(array $userRow): bool
    {
        if ((int) ($userRow['iUserStatus'] ?? 0) !== 1) {
            return false;
        }
        if (array_key_exists('email_verified', $userRow) && (int) $userRow['email_verified'] !== 1) {
            return false;
        }
        if (array_key_exists('registration_questionnaire_at', $userRow)) {
            $qAt = $userRow['registration_questionnaire_at'] ?? null;
            if ($qAt === null || $qAt === '' || $qAt === '0000-00-00 00:00:00') {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('onboarding_questionnaire_is_complete')) {
    function onboarding_questionnaire_is_complete(?array $userRow): bool
    {
        if (!$userRow || !array_key_exists('registration_questionnaire_at', $userRow)) {
            return true;
        }
        $qAt = $userRow['registration_questionnaire_at'] ?? null;
        return !($qAt === null || $qAt === '' || $qAt === '0000-00-00 00:00:00');
    }
}

if (!function_exists('onboarding_user_needs_onboarding')) {
    /** Learner still needs questionnaire and/or email verification (any iUserStatus). */
    function onboarding_user_needs_onboarding(?array $userRow): bool
    {
        if (!$userRow || (int) ($userRow['iUserType'] ?? 0) !== 2) {
            return false;
        }
        if (!array_key_exists('registration_questionnaire_at', $userRow)) {
            return false;
        }
        if (!onboarding_questionnaire_is_complete($userRow)) {
            return true;
        }
        if (array_key_exists('email_verified', $userRow) && (int) ($userRow['email_verified'] ?? 0) !== 1) {
            return true;
        }
        return false;
    }
}

if (!function_exists('onboarding_complete_registration_url')) {
    function onboarding_complete_registration_url(): string
    {
        return onboarding_app_base_url() . '/complete_registration.php';
    }
}

if (!function_exists('onboarding_fetch_learner_by_email_password')) {
    function onboarding_fetch_learner_by_email_password($conn, string $email, string $password): ?array
    {
        $email = trim($email);
        if ($email === '' || $password === '') {
            return null;
        }
        $cols = onboarding_login_select_columns($conn);
        $st = mysqli_prepare($conn, 'SELECT ' . $cols . ' FROM cpo_usermaster WHERE vUserEmailId = ? AND iUserType = 2 LIMIT 1');
        if (!$st) {
            return null;
        }
        mysqli_stmt_bind_param($st, 's', $email);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        if (!$row || !hash_equals((string) ($row['vUserPassword'] ?? ''), $password)) {
            return null;
        }
        return $row;
    }
}

if (!function_exists('onboarding_finish_existing_learner_questionnaire')) {
    /**
     * Save questionnaire for an account that already exists (legacy / pre-onboarding users).
     *
     * @return array{ok:bool,error:string,email_sent:bool,email_note:string}
     */
    function onboarding_finish_existing_learner_questionnaire($conn, int $userId, array $post): array
    {
        if ($userId <= 0) {
            return array('ok' => false, 'error' => 'Invalid account.', 'email_sent' => false, 'email_note' => '');
        }
        if (empty($post['chkterm_cond'])) {
            return array('ok' => false, 'error' => 'You must accept the terms and conditions.', 'email_sent' => false, 'email_note' => '');
        }

        $st = mysqli_prepare(
            $conn,
            'SELECT iUserId, vUserName, vUserEmailId, iUserType, iUserStatus, vUserPassword,
                vUserAddress, vUserPostCode, vUserCountry, vUserMobile, vUserPhone,
                dUserBirthDate, vUserEthenticity, iUserGender,
                COALESCE(email_verified, 0) AS email_verified
                FROM cpo_usermaster WHERE iUserId = ? AND iUserType = 2 LIMIT 1'
        );
        if (!$st) {
            return array('ok' => false, 'error' => 'Database error.', 'email_sent' => false, 'email_note' => '');
        }
        mysqli_stmt_bind_param($st, 'i', $userId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $user = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        if (!$user) {
            return array('ok' => false, 'error' => 'Learner account not found.', 'email_sent' => false, 'email_note' => '');
        }

        $questionnaire = onboarding_collect_questionnaire_from_post($post, $conn);
        $personal = array(
            'TXusername' => (string) ($user['vUserName'] ?? ''),
            'TXemailid' => (string) ($user['vUserEmailId'] ?? ''),
            'CBOcountry' => (string) ($user['vUserCountry'] ?? ''),
            'TXtelephone' => (string) ($user['vUserPhone'] ?? ''),
            'TXmobile' => (string) ($user['vUserMobile'] ?? ''),
            'TXbdate' => (string) ($user['dUserBirthDate'] ?? ''),
            'TXethnicity' => (string) ($user['vUserEthenticity'] ?? ''),
            'rnd' => ((int) ($user['iUserGender'] ?? 1) === 2) ? 'Female' : 'Male',
            'legacy_completion' => true,
        );

        onboarding_apply_questionnaire_to_user($conn, $userId, $post);
        if (!onboarding_save_registration_questionnaire($userId, $questionnaire, $personal)) {
            return array('ok' => false, 'error' => 'Could not save questionnaire file.', 'email_sent' => false, 'email_note' => '');
        }

        $emailSent = false;
        $emailNote = '';
        if (onboarding_schema_ready($conn) && (int) ($user['email_verified'] ?? 0) !== 1) {
            $mail = onboarding_send_verification_email($conn, $userId);
            $emailSent = $mail['sent'];
            $emailNote = $mail['error'] ?? '';
        }

        return array('ok' => true, 'error' => '', 'email_sent' => $emailSent, 'email_note' => $emailNote);
    }
}

if (!function_exists('onboarding_login_block_reason')) {
    function onboarding_login_block_reason(array $userRow, string $password, string $submittedPassword): string
    {
        if (!hash_equals((string) $password, $submittedPassword)) {
            return '';
        }
        if (array_key_exists('registration_questionnaire_at', $userRow)) {
            $qAt = $userRow['registration_questionnaire_at'] ?? null;
            if ($qAt === null || $qAt === '' || $qAt === '0000-00-00 00:00:00') {
                return 'Your registration is incomplete. Please finish the sign-up questionnaire, then verify your email. Use the link below to complete your questionnaire.';
            }
        }
        if (array_key_exists('email_verified', $userRow) && (int) $userRow['email_verified'] !== 1) {
            return 'Please verify your email address before signing in. Check your inbox for the confirmation link (or contact support if you need it resent).';
        }
        if ((int) ($userRow['iUserStatus'] ?? 0) !== 1) {
            return 'Your email may be verified, but your account is still awaiting super administrator approval. You will be notified when you can sign in.';
        }
        return '';
    }
}

if (!function_exists('onboarding_login_select_columns')) {
    function onboarding_login_select_columns($conn): string
    {
        $cols = 'iUserId, vUserName, vUserPassword, vUserEmailId, iUserType, iUserStatus';
        if (onboarding_schema_ready($conn)) {
            $cols .= ', email_verified, registration_questionnaire_at';
        }
        return $cols;
    }
}

if (!function_exists('onboarding_complete_registration')) {
    /**
     * Create learner account (pending), save questionnaire, send verification email.
     *
     * @return array{ok:bool,user_id:int,error:string,email_sent:bool,email_note:string}
     */
    function onboarding_complete_registration($conn, array $personal, array $questionnairePost): array
    {
        $email = trim((string) ($personal['TXemailid'] ?? ''));
        if ($email === '') {
            return array('ok' => false, 'user_id' => 0, 'error' => 'Email address is required.', 'email_sent' => false, 'email_note' => '');
        }

        $st = mysqli_prepare($conn, 'SELECT iUserId FROM cpo_usermaster WHERE vUserEmailId = ? LIMIT 1');
        if ($st) {
            mysqli_stmt_bind_param($st, 's', $email);
            mysqli_stmt_execute($st);
            $rs = mysqli_stmt_get_result($st);
            if ($rs && mysqli_num_rows($rs) > 0) {
                mysqli_stmt_close($st);
                return array('ok' => false, 'user_id' => 0, 'error' => 'Email already exists in our database.', 'email_sent' => false, 'email_note' => '');
            }
            mysqli_stmt_close($st);
        }

        $username = mysqli_real_escape_string($conn, trim((string) ($personal['TXusername'] ?? '')));
        $pwd = mysqli_real_escape_string($conn, (string) ($personal['TXpwd'] ?? ''));
        $country = mysqli_real_escape_string($conn, trim((string) ($personal['CBOcountry'] ?? '')));
        $mobile = mysqli_real_escape_string($conn, trim((string) ($personal['TXmobile'] ?? '')));
        $telephone = mysqli_real_escape_string($conn, trim((string) ($personal['TXtelephone'] ?? '')));
        $emailEsc = mysqli_real_escape_string($conn, $email);
        $bdate = mysqli_real_escape_string($conn, trim((string) ($personal['TXbdate'] ?? '')));
        $ethnicity = mysqli_real_escape_string($conn, trim((string) ($personal['TXethnicity'] ?? '')));
        $gender = mysqli_real_escape_string($conn, trim((string) ($personal['rnd'] ?? 'Male')));
        $token = onboarding_generate_token();
        $tokenEsc = mysqli_real_escape_string($conn, $token);
        $regDate = mysqli_real_escape_string($conn, date('Y-m-d'));

        $statusPending = 0;
        if (onboarding_schema_ready($conn)) {
            $sql = "INSERT INTO cpo_usermaster (
                vUserName, vUserPassword, vUserCountry, vUserMobile, vUserPhone, vUserEmailId,
                dUserBirthDate, vUserEthenticity, iUserGender, iUserType, iUserStatus, random,
                dUserRegDate, email_verified
            ) VALUES (
                '" . $username . "', '" . $pwd . "', '" . $country . "', '" . $mobile . "', '" . $telephone . "', '" . $emailEsc . "',
                '" . $bdate . "', '" . $ethnicity . "', '" . $gender . "', 2, " . $statusPending . ", '" . $tokenEsc . "',
                '" . $regDate . "', 0
            )";
        } else {
            $sql = "INSERT INTO cpo_usermaster (
                vUserName, vUserPassword, vUserCountry, vUserMobile, vUserPhone, vUserEmailId,
                dUserBirthDate, vUserEthenticity, iUserGender, iUserType, iUserStatus, random, dUserRegDate
            ) VALUES (
                '" . $username . "', '" . $pwd . "', '" . $country . "', '" . $mobile . "', '" . $telephone . "', '" . $emailEsc . "',
                '" . $bdate . "', '" . $ethnicity . "', '" . $gender . "', 2, " . $statusPending . ", '" . $tokenEsc . "',
                '" . $regDate . "'
            )";
        }

        if (!mysqli_query($conn, $sql)) {
            return array('ok' => false, 'user_id' => 0, 'error' => 'Could not save registration. Please try again.', 'email_sent' => false, 'email_note' => '');
        }

        $userId = (int) mysqli_insert_id($conn);
        if ($userId <= 0) {
            return array('ok' => false, 'user_id' => 0, 'error' => 'Could not save registration. Please try again.', 'email_sent' => false, 'email_note' => '');
        }

        if (function_exists('career_bootstrap_user_profile')) {
            career_bootstrap_user_profile($conn, $userId);
        }

        $mergedPost = array_merge($personal, $questionnairePost);
        onboarding_apply_questionnaire_to_user($conn, $userId, $mergedPost);

        $questionnaire = onboarding_collect_questionnaire_from_post($mergedPost, $conn);
        $personalSnapshot = array(
            'name' => trim((string) ($personal['TXusername'] ?? '')),
            'email' => $email,
            'telephone' => trim((string) ($personal['TXtelephone'] ?? '')),
            'mobile' => trim((string) ($personal['TXmobile'] ?? '')),
            'country' => trim((string) ($personal['CBOcountry'] ?? '')),
            'date_of_birth' => trim((string) ($personal['TXbdate'] ?? '')),
            'employment_status' => trim((string) ($personal['TXethnicity'] ?? '')),
            'gender' => trim((string) ($personal['rnd'] ?? '')),
        );
        onboarding_save_registration_questionnaire($userId, $questionnaire, $personalSnapshot);

        $mailResult = onboarding_send_verification_email($conn, $userId);
        onboarding_notify_superadmin_new_registration($conn, $userId);

        return array(
            'ok' => true,
            'user_id' => $userId,
            'error' => '',
            'email_sent' => $mailResult['sent'],
            'email_note' => $mailResult['error'],
        );
    }
}

if (!function_exists('onboarding_notify_superadmin_new_registration')) {
    function onboarding_notify_superadmin_new_registration($conn, int $userId): void
    {
        if (!class_exists(PHPMailer\PHPMailer\PHPMailer::class)) {
            $autoload = __DIR__ . '/vendor/autoload.php';
            if (is_file($autoload)) {
                require_once $autoload;
            }
        }
        if (!app_smtp_is_configured()) {
            return;
        }

        $st = mysqli_prepare($conn, 'SELECT vUserName, vUserEmailId FROM cpo_usermaster WHERE iUserId = ? LIMIT 1');
        if (!$st) {
            return;
        }
        mysqli_stmt_bind_param($st, 'i', $userId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $user = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        if (!$user) {
            return;
        }

        $adminTo = defined('admin_email') ? (string) admin_email : '';
        if ($adminTo === '') {
            return;
        }

        $name = htmlspecialchars((string) $user['vUserName'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars((string) $user['vUserEmailId'], ENT_QUOTES, 'UTF-8');
        $reviewUrl = onboarding_app_base_url() . '/tutorapp/newadmin/pending_registrations.php';

        app_send_smtp_mail(
            $adminTo,
            'Super administrator',
            'New learner registration awaiting approval',
            '<p>A new learner has registered and needs review.</p>'
                . '<p><strong>Name:</strong> ' . $name . '<br><strong>Email:</strong> ' . $email . '</p>'
                . '<p><a href="' . htmlspecialchars($reviewUrl, ENT_QUOTES, 'UTF-8') . '">Open pending registrations</a></p>'
        );
    }
}

if (!function_exists('onboarding_list_pending_learners')) {
    function onboarding_list_pending_learners($conn): array
    {
        $cols = 'iUserId, vUserName, vUserEmailId, dUserRegDate, iUserStatus';
        if (onboarding_schema_ready($conn)) {
            $cols .= ', email_verified, email_verified_at, registration_questionnaire_at';
        }
        $sql = 'SELECT ' . $cols . ' FROM cpo_usermaster WHERE iUserType = 2 AND iUserStatus = 0 ORDER BY dUserRegDate DESC, iUserId DESC';
        $rs = mysqli_query($conn, $sql);
        if (!$rs) {
            return array();
        }
        $rows = array();
        while ($row = mysqli_fetch_assoc($rs)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

if (!function_exists('onboarding_list_incomplete_learners')) {
    /**
     * Existing learner accounts missing questionnaire and/or email verification (any approval status).
     */
    function onboarding_list_incomplete_learners($conn): array
    {
        if (!onboarding_schema_ready($conn)) {
            return array();
        }
        $sql = "SELECT iUserId, vUserName, vUserEmailId, dUserRegDate, iUserStatus,
            email_verified, email_verified_at, registration_questionnaire_at
            FROM cpo_usermaster
            WHERE iUserType = 2
            AND (
                registration_questionnaire_at IS NULL
                OR registration_questionnaire_at = ''
                OR registration_questionnaire_at = '0000-00-00 00:00:00'
                OR COALESCE(email_verified, 0) = 0
            )
            ORDER BY dUserRegDate DESC, iUserId DESC";
        $rs = mysqli_query($conn, $sql);
        if (!$rs) {
            return array();
        }
        $rows = array();
        while ($row = mysqli_fetch_assoc($rs)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

if (!function_exists('onboarding_admin_mark_email_verified')) {
    /**
     * @return array{ok:bool,message:string}
     */
    function onboarding_admin_mark_email_verified($conn, int $userId): array
    {
        if ($userId <= 0 || !onboarding_schema_ready($conn)) {
            return array('ok' => false, 'message' => 'Invalid request or schema not ready.');
        }
        $st = mysqli_prepare(
            $conn,
            'UPDATE cpo_usermaster SET email_verified = 1, email_verified_at = NOW() WHERE iUserId = ? AND iUserType = 2'
        );
        if (!$st) {
            return array('ok' => false, 'message' => 'Database error: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($st, 'i', $userId);
        $ok = mysqli_stmt_execute($st);
        mysqli_stmt_close($st);
        if (!$ok) {
            return array('ok' => false, 'message' => 'Could not update email verification.');
        }
        return array('ok' => true, 'message' => 'Email marked as verified.');
    }
}

if (!function_exists('onboarding_approve_learner')) {
    /**
     * @return array{ok:bool,message:string}
     */
    function onboarding_approve_learner($conn, int $userId): array
    {
        if ($userId <= 0) {
            return array('ok' => false, 'message' => 'Invalid learner id.');
        }

        $st = mysqli_prepare(
            $conn,
            'SELECT iUserId, iUserType, iUserStatus, vUserName FROM cpo_usermaster WHERE iUserId = ? LIMIT 1'
        );
        if (!$st) {
            return array('ok' => false, 'message' => 'Database error: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($st, 'i', $userId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);

        if (!$row) {
            return array('ok' => false, 'message' => 'Learner not found.');
        }
        if ((int) ($row['iUserType'] ?? 0) !== 2) {
            return array('ok' => false, 'message' => 'This account is not a learner (cannot approve here).');
        }
        if ((int) ($row['iUserStatus'] ?? 0) === 1) {
            return array(
                'ok' => true,
                'message' => trim((string) $row['vUserName']) . ' is already approved.',
            );
        }

        $upd = mysqli_prepare($conn, 'UPDATE cpo_usermaster SET iUserStatus = 1 WHERE iUserId = ? AND iUserType = 2');
        if (!$upd) {
            return array('ok' => false, 'message' => 'Database error: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($upd, 'i', $userId);
        $executed = mysqli_stmt_execute($upd);
        $affected = mysqli_stmt_affected_rows($upd);
        mysqli_stmt_close($upd);

        if (!$executed) {
            return array('ok' => false, 'message' => 'Could not approve: ' . mysqli_error($conn));
        }
        if ($affected < 1) {
            return array('ok' => false, 'message' => 'No change was saved. Refresh the page and try again.');
        }

        return array(
            'ok' => true,
            'message' => 'Learner approved. They can sign in after verifying their email.',
        );
    }
}

if (!function_exists('onboarding_learner_has_legacy_profile_data')) {
    function onboarding_learner_has_legacy_profile_data(array $userRow): bool
    {
        $fields = array(
            'TUserQualification',
            'vUserEmployedReason',
            'TUserCareerOccupation',
            'TUserAchive',
            'TUserSkills',
            'TUserHobbies',
            'TUserDisabilityReason',
        );
        foreach ($fields as $field) {
            $val = trim((string) ($userRow[$field] ?? ''));
            if ($val !== '') {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('onboarding_questionnaire_status')) {
    /**
     * @return array{done:bool,label:string,has_file:bool,has_legacy:bool}
     */
    function onboarding_questionnaire_status($conn, int $userId, ?array $row = null): array
    {
        if ($row === null || !array_key_exists('TUserQualification', $row)) {
            $st = mysqli_prepare(
                $conn,
                'SELECT iUserId, registration_questionnaire_at, TUserQualification, vUserEmployedReason,
                TUserCareerOccupation, TUserAchive, TUserSkills, TUserHobbies, TUserDisabilityReason,
                iUserEmployed, iUserDisability
                FROM cpo_usermaster WHERE iUserId = ? AND iUserType = 2 LIMIT 1'
            );
            if (!$st) {
                return array('done' => false, 'label' => 'Unknown', 'has_file' => false, 'has_legacy' => false);
            }
            mysqli_stmt_bind_param($st, 'i', $userId);
            mysqli_stmt_execute($st);
            $rs = mysqli_stmt_get_result($st);
            $row = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
            mysqli_stmt_close($st);
        }
        if (!$row) {
            return array('done' => false, 'label' => 'Missing', 'has_file' => false, 'has_legacy' => false);
        }
        $hasFile = is_file(onboarding_user_questionnaire_dir($userId) . DIRECTORY_SEPARATOR . 'registration_questionnaire.json');
        $qAt = $row['registration_questionnaire_at'] ?? null;
        $done = onboarding_questionnaire_is_complete($row) || $hasFile;
        $hasLegacy = onboarding_learner_has_legacy_profile_data($row);
        if ($done) {
            $label = $hasFile ? 'Saved' : 'Saved (timestamp)';
        } elseif ($hasLegacy) {
            $label = 'Legacy in database';
        } else {
            $label = 'Missing';
        }
        return array('done' => $done, 'label' => $label, 'has_file' => $hasFile, 'has_legacy' => $hasLegacy);
    }
}

if (!function_exists('onboarding_import_legacy_questionnaire')) {
    /**
     * Copy old cpo_usermaster profile fields into JSON + registration_questionnaire_at.
     *
     * @return array{ok:bool,message:string}
     */
    function onboarding_import_legacy_questionnaire($conn, int $userId): array
    {
        if ($userId <= 0) {
            return array('ok' => false, 'message' => 'Invalid learner id.');
        }
        $st = mysqli_prepare(
            $conn,
            'SELECT iUserId, vUserName, vUserEmailId, vUserCountry, vUserPhone, vUserMobile,
                dUserBirthDate, vUserEthenticity, iUserGender,
                TUserQualification, iUserEmployed, vUserEmployedReason, TUserCareerOccupation,
                TUserAchive, TUserSkills, TUserHobbies, iUserDisability, TUserDisabilityReason,
                registration_questionnaire_at
                FROM cpo_usermaster WHERE iUserId = ? AND iUserType = 2 LIMIT 1'
        );
        if (!$st) {
            return array('ok' => false, 'message' => 'Database error.');
        }
        mysqli_stmt_bind_param($st, 'i', $userId);
        mysqli_stmt_execute($st);
        $rs = mysqli_stmt_get_result($st);
        $user = ($rs && mysqli_num_rows($rs) > 0) ? mysqli_fetch_assoc($rs) : null;
        mysqli_stmt_close($st);
        if (!$user) {
            return array('ok' => false, 'message' => 'Learner not found.');
        }
        if (!onboarding_learner_has_legacy_profile_data($user)) {
            return array('ok' => false, 'message' => 'No legacy questionnaire data in the database for this user.');
        }
        if (onboarding_questionnaire_is_complete($user)) {
            return array('ok' => true, 'message' => 'Questionnaire was already marked complete.');
        }

        $questionnaire = array(
            'submitted_at' => date('c'),
            'in_work' => (string) ((int) ($user['iUserEmployed'] ?? 0)),
            'qualifications_held' => trim((string) ($user['TUserQualification'] ?? '')),
            'employment_detail' => trim((string) ($user['vUserEmployedReason'] ?? '')),
            'career_interests' => trim((string) ($user['TUserCareerOccupation'] ?? '')),
            'qualifications_wanted' => trim((string) ($user['TUserAchive'] ?? '')),
            'skills' => trim((string) ($user['TUserSkills'] ?? '')),
            'hobbies' => trim((string) ($user['TUserHobbies'] ?? '')),
            'has_disability' => (string) ((int) ($user['iUserDisability'] ?? 0)),
            'disability_detail' => trim((string) ($user['TUserDisabilityReason'] ?? '')),
            'terms_accepted' => true,
            'imported_from_legacy' => true,
        );
        $personal = array(
            'TXusername' => (string) ($user['vUserName'] ?? ''),
            'TXemailid' => (string) ($user['vUserEmailId'] ?? ''),
            'CBOcountry' => (string) ($user['vUserCountry'] ?? ''),
            'TXtelephone' => (string) ($user['vUserPhone'] ?? ''),
            'TXmobile' => (string) ($user['vUserMobile'] ?? ''),
            'TXbdate' => (string) ($user['dUserBirthDate'] ?? ''),
            'TXethnicity' => (string) ($user['vUserEthenticity'] ?? ''),
            'rnd' => ((int) ($user['iUserGender'] ?? 1) === 2) ? 'Female' : 'Male',
            'legacy_import' => true,
        );
        if (!onboarding_save_registration_questionnaire($userId, $questionnaire, $personal)) {
            return array('ok' => false, 'message' => 'Could not write questionnaire file.');
        }
        $now = date('Y-m-d H:i:s');
        $upd = mysqli_prepare(
            $conn,
            'UPDATE cpo_usermaster SET registration_questionnaire_at = ? WHERE iUserId = ? AND iUserType = 2'
        );
        if ($upd) {
            mysqli_stmt_bind_param($upd, 'si', $now, $userId);
            mysqli_stmt_execute($upd);
            mysqli_stmt_close($upd);
        }
        return array('ok' => true, 'message' => 'Legacy profile imported as registration questionnaire.');
    }
}

if (!function_exists('onboarding_questionnaire_labels')) {
    function onboarding_questionnaire_labels($conn = null): array
    {
        if ($conn && registration_questionnaire_schema_ready($conn)) {
            return registration_questionnaire_labels($conn);
        }
        return array(
            'in_work' => 'Currently in work',
            'qualifications_held' => 'Qualifications held',
            'employment_detail' => 'Job / time out of work',
            'career_interests' => 'Career interests',
            'qualifications_wanted' => 'Qualifications wanted',
            'skills' => 'Skills',
            'hobbies' => 'Hobbies',
            'has_disability' => 'Disability (yes/no)',
            'disability_detail' => 'Disability details',
            'terms_accepted' => 'Terms accepted',
        );
    }
}
