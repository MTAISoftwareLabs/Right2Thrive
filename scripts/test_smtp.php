<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/config.php';
app_load_dotenv();
app_define_main_branding();

$to = $argv[1] ?? '';
if ($to === '' || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
    fwrite(STDERR, "Usage: php scripts/test_smtp.php recipient@example.com\n");
    exit(1);
}

if (!app_smtp_is_configured()) {
    fwrite(STDERR, "SMTP not configured: set MAIL_HOST, MAIL_USERNAME, and MAIL_PASSWORD in .env\n");
    exit(1);
}

$result = app_send_smtp_mail(
    $to,
    'SMTP test',
    'Right2Thrive SMTP test',
    '<p>If you received this, SMTP is working.</p>',
    'If you received this, SMTP is working.'
);

if ($result['sent']) {
    echo "OK: message sent to {$to}\n";
    exit(0);
}

fwrite(STDERR, 'FAIL: ' . $result['error'] . "\n");
exit(1);
