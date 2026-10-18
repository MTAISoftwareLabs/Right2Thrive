<?php

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/career_stage3_lib.php';

header('Content-Type: text/plain; charset=UTF-8');

if (career_stage3_ensure_schema($conn)) {
    echo "Stage 3 (PCAP) migration completed successfully.\n";
} else {
    http_response_code(500);
    echo "Stage 3 migration failed. Check database permissions.\n";
}
