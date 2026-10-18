<?php

require_once __DIR__ . '/env.php';
app_load_dotenv();

if (!defined('APP_CONFIG_LOADED')) {
	define('APP_CONFIG_LOADED', true);
	date_default_timezone_set(app_env('APP_TIMEZONE', 'Europe/London'));
}

/**
 * Branding constants (sitename, admin_email, etc.) are set in each entry dbConnection
 * so tutorapp/* can use TUTORAPP_SITENAME without conflicting with the Careers Hub.
 */
function app_define_main_branding(): void
{
	if (!defined('sitename')) {
		define('sitename', app_env('SITE_NAME', ' - Right2Thrive UK Collective Careers Hub '));
	}
	if (!defined('SITE_WELLBEING_HUB_URL')) {
		define('SITE_WELLBEING_HUB_URL', app_env('SITE_WELLBEING_HUB_URL', 'https://www.right2thriveuk.com/'));
	}
	if (!defined('page_size')) {
		define('page_size', (int) app_env('PAGE_SIZE', '10'));
	}
	if (!defined('admin_email')) {
		define('admin_email', app_env('ADMIN_EMAIL', 'info@right2thrive.org'));
	}
}

function app_define_tutorapp_shared_constants(): void
{
	if (!defined('page_size')) {
		define('page_size', (int) app_env('PAGE_SIZE', '10'));
	}
	if (!defined('admin_email')) {
		define('admin_email', app_env('ADMIN_EMAIL', 'info@right2thrive.org'));
	}
	if (!defined('SITE_WELLBEING_HUB_URL')) {
		define('SITE_WELLBEING_HUB_URL', app_env('SITE_WELLBEING_HUB_URL', '/'));
	}
}

/** Footer line for tutorapp/tms* and tmsnew (Careers). */
function app_tutorapp_tms_copyright_line(): string
{
	$owner = app_env('TUTORAPP_COPYRIGHT_OWNER', 'Right2Thrive UK Ltd');
	$y = (int) date('Y');
	return 'Copyright &copy; ' . $y . ', ' . $owner . '. All rights reserved.';
}

/**
 * Absolute web path (or full URL) for the Careers sidebar logo.
 * Derives the mount prefix from REQUEST_URI and SCRIPT_NAME (longest wins) so nested
 * deployments like /app21new/app21/tutorapp/... resolve to .../lms/images/logo.png,
 * even when SCRIPT_NAME alone is rewritten to /app21/tutorapp/...
 */
function app_tutorapp_careers_logo_href(): string
{
	$override = app_env('TUTORAPP_CAREERS_LOGO');
	if ($override !== '') {
		return $override;
	}
	$candidates = [];
	foreach ([$_SERVER['REQUEST_URI'] ?? '', $_SERVER['SCRIPT_NAME'] ?? ''] as $raw) {
		if ($raw === '') {
			continue;
		}
		$p = (string) strtok($raw, '?');
		$pos = strpos($p, '/tutorapp/');
		if ($pos !== false) {
			$candidates[] = substr($p, 0, $pos);
		}
	}
	if ($candidates !== []) {
		usort($candidates, static function ($a, $b) {
			return strlen((string) $b) <=> strlen((string) $a);
		});
		$prefix = $candidates[0];
		return ($prefix === '' ? '' : $prefix) . '/lms/images/logo.png';
	}
	return '/lms/images/logo.png';
}

/** tutorapp/tms, tutorapp/tpm, tutorapp/tmsnew — public tutor UI title */
function app_define_tutorapp_tms_branding(): void
{
	app_define_tutorapp_shared_constants();
	if (!defined('sitename')) {
		define('sitename', app_env('TUTORAPP_TMS_SITENAME', 'Right2Thrive UK Collective Careers Hub'));
	}
}

/** tutorapp/lms — legacy learner strings */
function app_define_tutorapp_lms_branding(): void
{
	app_define_tutorapp_shared_constants();
	if (!defined('sitename')) {
		define('sitename', app_env('TUTORAPP_LMS_SITENAME', 'CareerPaths Online :: '));
	}
}

/** tutorapp/dbConnection.php (root) — DB only, optional title */
function app_define_tutorapp_core_branding(): void
{
	app_define_tutorapp_shared_constants();
}

/**
 * Main app DB (Careers Hub — root, lms/, test/).
 *
 * @return array{host:string,username:string,password:string,database:string}
 */
function app_main_db(): array
{
	static $cfg = null;
	if ($cfg === null) {
		$cfg = [
			'host' => app_env('DB_HOST', 'localhost'),
			'username' => app_env('DB_USERNAME', 'root'),
			'password' => app_env('DB_PASSWORD', ''),
			'database' => app_env('DB_DATABASE', ''),
		];
	}
	return $cfg;
}

/**
 * Legacy tutorapp/* stacks. Falls back to DB_* when TUTORAPP_DB_* are empty.
 *
 * @return array{host:string,username:string,password:string,database:string}
 */
function app_tutorapp_db(): array
{
	static $cfg = null;
	if ($cfg === null) {
		$main = app_main_db();
		$cfg = [
			'host' => app_env('TUTORAPP_DB_HOST') ?: $main['host'],
			'username' => app_env('TUTORAPP_DB_USERNAME') ?: $main['username'],
			'password' => app_env('TUTORAPP_DB_PASSWORD') !== '' ? app_env('TUTORAPP_DB_PASSWORD') : app_env('DB_PASSWORD', ''),
			'database' => app_env('TUTORAPP_DB_DATABASE') ?: $main['database'],
		];
	}
	return $cfg;
}

/**
 * tutorapp/lms/db.php (GSC user). Falls back to app_tutorapp_db() when unset.
 *
 * @return array{host:string,username:string,password:string,database:string}
 */
function app_tutorapp_gsc_db(): array
{
	static $cfg = null;
	if ($cfg === null) {
		$base = app_tutorapp_db();
		$cfg = [
			'host' => app_env('TUTORAPP_GSC_DB_HOST') ?: $base['host'],
			'username' => app_env('TUTORAPP_GSC_DB_USERNAME') ?: $base['username'],
			'password' => app_env('TUTORAPP_GSC_DB_PASSWORD') !== '' ? app_env('TUTORAPP_GSC_DB_PASSWORD') : $base['password'],
			'database' => app_env('TUTORAPP_GSC_DB_DATABASE') ?: $base['database'],
		];
	}
	return $cfg;
}

/**
 * tutorapp/dbconfig.php (careerpathonline schema). Falls back to GSC then tutorapp.
 *
 * @return array{host:string,username:string,password:string,database:string}
 */
function app_careerpath_db(): array
{
	static $cfg = null;
	if ($cfg === null) {
		$g = app_tutorapp_gsc_db();
		$cfg = [
			'host' => app_env('CAREERPATH_DB_HOST') ?: $g['host'],
			'username' => app_env('CAREERPATH_DB_USERNAME') ?: $g['username'],
			'password' => app_env('CAREERPATH_DB_PASSWORD') !== '' ? app_env('CAREERPATH_DB_PASSWORD') : $g['password'],
			'database' => app_env('CAREERPATH_DB_DATABASE') ?: $g['database'],
		];
	}
	return $cfg;
}

/**
 * SMTP defaults for PHPMailer (override via .env).
 *
 * @return array{host:string,username:string,password:string,port:int,encryption:string,from_email:string,from_name:string}
 */
function app_smtp_config(): array
{
	static $cfg = null;
	if ($cfg === null) {
		$cfg = [
			'host' => app_env('MAIL_HOST', 'mail.21kdigitalmedia.com'),
			'username' => app_env('MAIL_USERNAME', 'hello@21kdigitalmedia.com'),
			'password' => app_env('MAIL_PASSWORD', ''),
			'port' => (int) app_env('MAIL_PORT', '465'),
			'encryption' => app_env('MAIL_ENCRYPTION', 'ssl'),
			'from_email' => app_env('MAIL_FROM_ADDRESS', 'hello@21kdigitalmedia.com'),
			'from_name' => app_env('MAIL_FROM_NAME', 'Right2Thrive UK Collective Careers Hub'),
		];
	}
	return $cfg;
}

function app_smtp_is_configured(): bool
{
	$smtp = app_smtp_config();
	return $smtp['host'] !== '' && $smtp['username'] !== '' && $smtp['password'] !== '';
}

/**
 * @return array{sent:bool,error:string}
 */
function app_send_smtp_mail(
	string $toEmail,
	string $toName,
	string $subject,
	string $htmlBody,
	string $altBody = ''
): array {
	if (!app_smtp_is_configured()) {
		return array(
			'sent' => false,
			'error' => 'SMTP is not fully configured. Set MAIL_HOST, MAIL_USERNAME, and MAIL_PASSWORD in .env.',
		);
	}

	if (!class_exists(\PHPMailer\PHPMailer\PHPMailer::class)) {
		$autoload = app_project_root() . '/vendor/autoload.php';
		if (is_readable($autoload)) {
			require_once $autoload;
		}
	}

	$smtp = app_smtp_config();

	try {
		$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
		$mail->CharSet = \PHPMailer\PHPMailer\PHPMailer::CHARSET_UTF8;
		$mail->isSMTP();
		$mail->Host = $smtp['host'];
		$mail->SMTPAuth = true;
		$mail->Username = $smtp['username'];
		$mail->Password = $smtp['password'];
		$mail->Port = $smtp['port'];

		$enc = strtolower(trim($smtp['encryption']));
		if ($smtp['port'] === 465 || $enc === 'ssl' || $enc === 'smtps') {
			$mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
		} elseif ($enc === 'tls' || $enc === 'starttls') {
			$mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
		}
		$mail->SMTPAutoTLS = ($mail->Port !== 465);

		$fromEmail = $smtp['from_email'] !== '' ? $smtp['from_email'] : $smtp['username'];
		$mail->setFrom($fromEmail, $smtp['from_name']);
		$mail->addAddress($toEmail, $toName);
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $htmlBody;
		$mail->AltBody = $altBody !== '' ? $altBody : strip_tags(str_replace('<br>', "\n", $htmlBody));

		$mail->send();
		return array('sent' => true, 'error' => '');
	} catch (Throwable $e) {
		error_log('SMTP send failed: ' . $e->getMessage());
		return array('sent' => false, 'error' => $e->getMessage());
	}
}

/**
 * Legacy SendingMail() wrapper — uses SMTP from .env when configured, else PHP mail().
 */
function app_sending_mail(
	string $fromname,
	string $fromaddress,
	string $toname,
	string $toaddress,
	string $subject,
	string $message
): bool {
	if (app_smtp_is_configured()) {
		$result = app_send_smtp_mail(
			$toaddress,
			$toname,
			$subject,
			$message,
			strip_tags(str_replace(array('<br>', '<br/>', '<br />'), "\n", $message))
		);
		return $result['sent'];
	}

	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= 'From: "' . str_replace('"', '', $fromname) . '" <' . $fromaddress . ">\r\n";
	return @mail($toaddress, $subject, $message, $headers);
}

/**
 * Public Careers Hub nav links (login / assessment header). Relative paths work on any deploy.
 */
function app_careers_workshops_href(): string
{
	return app_env('SITE_WORKSHOPS_URL', 'workshops.php');
}

function app_careers_about_href(): string
{
	$custom = app_env('SITE_ABOUT_URL', '');
	if ($custom !== '') {
		return $custom;
	}
	return 'about.php';
}

/**
 * Web paths relative to the app root (e.g. /app21/) — nav + main user_login redirects.
 */
function app_tutor_login_href(): string
{
	return app_env('TUTORAPP_LOGIN_PATH', 'tutorapp/user_login.php');
}

function app_tutor_tms_dashboard_href(): string
{
	return app_env('TUTORAPP_TMS_DASHBOARD', 'tutorapp/tmsnew/index.php');
}

function app_tutor_tpm_dashboard_href(): string
{
	return app_env('TUTORAPP_TPM_DASHBOARD', 'tutorapp/tpm/index.php');
}

/** Paths for header(Location:) from scripts running inside tutorapp/. */
function app_tutorapp_local_tms_home(): string
{
	return app_env('TUTORAPP_LOCAL_TMS_INDEX', 'tmsnew/index.php');
}

function app_tutorapp_local_lms_home(): string
{
	return app_env('TUTORAPP_LOCAL_LMS_INDEX', 'lms/index.php');
}

function app_tutorapp_local_tpm_home(): string
{
	return app_env('TUTORAPP_LOCAL_TPM_INDEX', 'tpm/index.php');
}

/**
 * Relative URL/path from tutorapp/newadmin/*.php to learner file storage (upload, review, plan, images).
 * Default ../lms resolves to tutorapp/lms (legacy). Use ../../lms if learner files live under project root lms/.
 */
function app_newadmin_learner_lms_prefix(): string
{
	return rtrim(str_replace('\\', '/', app_env('NEWADMIN_LEARNER_FILES_BASE', '../lms')), '/');
}
