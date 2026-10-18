<?php

declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/career_chat_lib.php';

$db = app_main_db();
$conn = mysqli_connect($db['host'], $db['username'], $db['password'], $db['database']);
if (!$conn) {
    fwrite(STDERR, "DB connect failed.\n");
    exit(1);
}

if (career_chat_ensure_schema($conn)) {
    echo "[OK] career_chat_messages and career_chat_read_cursors tables are ready.\n";
    exit(0);
}

echo "[FAIL] Could not create career_chat_messages.\n";
exit(1);
