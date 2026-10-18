<?php

/**
 * Locate project root (folder containing composer.json and .env).
 */
function app_project_root(): string
{
	static $root = null;
	if ($root === null) {
		$root = dirname(__DIR__);
	}
	return $root;
}

/**
 * Load .env into $_ENV / getenv (safe if file missing).
 */
function app_load_dotenv(): void
{
	static $loaded = false;
	if ($loaded) {
		return;
	}
	$loaded = true;
	$root = app_project_root();
	$autoload = $root . '/vendor/autoload.php';
	if (is_readable($autoload)) {
		require_once $autoload;
	}
	if (class_exists(\Dotenv\Dotenv::class) && is_readable($root . '/.env')) {
		\Dotenv\Dotenv::createImmutable($root)->safeLoad();
	}
}

/**
 * Read env var with optional default (empty string means "use default").
 */
function app_env(string $key, string $default = ''): string
{
	if (isset($_ENV[$key]) && $_ENV[$key] !== null && (string) $_ENV[$key] !== '') {
		return (string) $_ENV[$key];
	}
	$v = getenv($key);
	if ($v !== false && $v !== '') {
		return (string) $v;
	}
	return $default;
}
