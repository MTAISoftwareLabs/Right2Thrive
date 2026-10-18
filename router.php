<?php
/**
 * PHP built-in server router — supports /app21/* (production-style URL)
 * and root /* when the document root is the project itself.
 */
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');

if (strpos($uri, '/app21') === 0) {
	$uri = substr($uri, strlen('/app21')) ?: '/';
}

$file = __DIR__ . $uri;

if ($uri !== '/' && is_file($file)) {
	return false; // serve static / existing file as-is
}

if ($uri !== '/' && is_file($file . '.php')) {
	require $file . '.php';
	return true;
}

if ($uri === '/' || $uri === '') {
	require __DIR__ . '/user_login.php';
	return true;
}

http_response_code(404);
echo 'Not Found';
return true;
