<?php

declare(strict_types=1);

if (!isset($_SESSION['user_id'], $_SESSION['is_admin']) || (int) $_SESSION['is_admin'] !== 1) {
	header('Location: index.htm');
	exit;
}
