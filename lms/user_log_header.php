<?php
if (!function_exists('app_tutor_login_href')) {
	require_once dirname(__DIR__) . '/config/config.php';
}
$wellbeing_url = defined('SITE_WELLBEING_HUB_URL') ? SITE_WELLBEING_HUB_URL : app_env('SITE_WELLBEING_HUB_URL', 'https://www.right2thriveuk.com/');
$public_site_base = rtrim($wellbeing_url, '/');
$tutor_login_href = app_tutor_login_href();
$workshops_href = app_careers_workshops_href();
$about_href = app_careers_about_href();
?>
<header class="header-area hub-public-header bg-white">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light py-2 px-0">
			<a class="navbar-brand brand-area p-0 me-3" href="user_login.php">
				<img class="hub-public-header__logo" src="lms/images/logo.png" alt="Right2Thrive UK Collective Careers Hub" decoding="async" />
			</a>
			<button class="navbar-toggler hub-public-header__toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hubPublicNav" aria-controls="hubPublicNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="hubPublicNav">
				<ul class="navbar-nav ms-auto align-items-lg-center flex-nowrap flex-lg-wrap gap-lg-1 hub-public-nav">
					<li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($wellbeing_url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">Wellbeing Hub</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($workshops_href, ENT_QUOTES, 'UTF-8'); ?>">Workshops</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($tutor_login_href, ENT_QUOTES, 'UTF-8'); ?>">Tutor login</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($public_site_base . '/blog-2/', ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">Blog</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($about_href, ENT_QUOTES, 'UTF-8'); ?>">About us</a></li>
					<li class="nav-item"><a class="nav-link fw-semibold" href="user_login.php">Sign in</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($public_site_base . '/contact-us/', ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">Contact us</a></li>
					<li class="nav-item mt-2 mt-lg-0">
						<ul class="hub-public-social list-inline mb-0" aria-label="Social links">
							<li class="list-inline-item"><a class="hub-public-social__link" href="#" aria-label="Instagram (link pending)"><img src="lms/images/instagram.png" alt="" width="20" height="20" decoding="async" /></a></li>
							<li class="list-inline-item"><a class="hub-public-social__link" href="#" aria-label="Twitter (link pending)"><img src="lms/images/twitter.png" alt="" width="20" height="20" decoding="async" /></a></li>
							<li class="list-inline-item"><a class="hub-public-social__link" href="#" aria-label="TikTok (link pending)"><img src="lms/images/tiktok.png" alt="" width="20" height="20" decoding="async" /></a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>
