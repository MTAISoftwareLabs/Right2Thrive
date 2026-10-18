<?php
/**
 * Legacy URL — forward to the main password recovery page (PHP 8 safe).
 */
declare(strict_types=1);

$target = '../forgotpwd.php';
if (!empty($_SERVER['QUERY_STRING'])) {
    $target .= '?' . $_SERVER['QUERY_STRING'];
}
header('Location: ' . $target, true, 302);
exit;
