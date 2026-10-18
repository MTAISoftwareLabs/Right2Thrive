<?php
include_once __DIR__ . '/dbConnection.php';

$path = isset($_GET['path']) ? trim($_GET['path']) : '';
if ($path === '' || strpos($path, '..') !== false) {
    http_response_code(400);
    exit('Invalid archive path.');
}

$path = ltrim(str_replace('\\', '/', $path), '/');
$parts = explode('/', $path);

$candidate = '';
if (count($parts) >= 2 && ctype_digit($parts[0])) {
    $candidate = __DIR__ . '/lms/uploads/' . $path;
} else {
    $candidate = __DIR__ . '/tutorapp/uploads/' . $path;
}

if (!is_file($candidate)) {
    http_response_code(404);
    exit('Archived file not found.');
}

$basename = basename($candidate);
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: inline; filename="' . $basename . '"');
header('Content-Length: ' . filesize($candidate));
readfile($candidate);
exit;
