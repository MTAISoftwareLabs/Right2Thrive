<?php

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/onboarding_lib.php';

header('Content-Type: text/plain; charset=UTF-8');

try {
    echo 'Starting onboarding migration...' . PHP_EOL;
    $setup = onboarding_ensure_schema($conn);
    if (!$setup['ok']) {
        throw new RuntimeException(implode(' ', $setup['messages']));
    }
    foreach ($setup['messages'] as $msg) {
        echo '[OK] ' . $msg . PHP_EOL;
    }
    if ($setup['messages'] === array()) {
        echo '[SKIP] All onboarding columns already exist' . PHP_EOL;
    }

    if (!mysqli_query(
        $conn,
        'UPDATE cpo_usermaster SET email_verified = 1 WHERE iUserStatus = 1 AND (email_verified IS NULL OR email_verified = 0)'
    )) {
        throw new RuntimeException('Backfill email_verified: ' . mysqli_error($conn));
    }
    echo '[OK] Backfill email_verified for existing active accounts' . PHP_EOL;

    echo PHP_EOL . 'Onboarding migration completed.' . PHP_EOL;
} catch (Throwable $e) {
    http_response_code(500);
    echo 'Migration failed: ' . $e->getMessage() . PHP_EOL;
}
