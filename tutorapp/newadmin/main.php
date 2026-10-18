<?php
require_once __DIR__ . '/dbConnection.php';

if (!isset($_SESSION['user_id'], $_SESSION['is_admin']) || (int) $_SESSION['is_admin'] !== 1) {
	header('Location: index.htm');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Admin · Right2Thrive</title>
	<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include_once 'top.php'; ?>
	<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td width="208"><?php include_once 'add.php'; ?></td>
			<td width="791" valign="top"><?php include_once 'middle.php'; ?></td>
		</tr>
	</table>
</body>
</html>
