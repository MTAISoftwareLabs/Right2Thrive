<?php
$adminLogoSrc = '../../lms/images/logo.png';
?>
<link rel="stylesheet" href="css/admin-layout.css" />
<header class="admin-header" role="banner">
	<a href="main.php" class="admin-header__brand">
		<img src="<?php echo htmlspecialchars($adminLogoSrc, ENT_QUOTES, 'UTF-8'); ?>" alt="Right2Thrive" class="admin-header__logo" width="180" height="44" decoding="async" />
		<div class="admin-header__titles">
			<span class="admin-header__product">Control panel</span>
			<span class="admin-header__org">Right2Thrive</span>
		</div>
	</a>
	<div class="admin-header__actions">
		<span class="admin-header__welcome">Welcome, Admin</span>
		<a class="admin-header__logout" href="logout.php">Sign out</a>
	</div>
</header>
