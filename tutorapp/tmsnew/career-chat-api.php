<?php

declare(strict_types=1);

include 'dbConnection.php';
require_once dirname(__DIR__, 2) . '/career_chat_lib.php';

$userId = (int) ($_SESSION['user_id'] ?? 0);
career_chat_api_handle($conn, $userId, 'tutor');
