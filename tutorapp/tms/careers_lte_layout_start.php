<?php
/**
 * Full AdminLTE shell for legacy tutorapp/tms/*.php (matches tutorapp/tmsnew).
 *
 * Set before include:
 *   $careers_page_title — string (page title / breadcrumb current)
 * Optional: $careers_breadcrumb_current — string (defaults to $careers_page_title)
 * Optional: $careers_extra_head — raw HTML for extra <head> content (scripts, etc.)
 */
if (!isset($careers_page_title)) {
	$careers_page_title = 'Careers';
}
$careers_breadcrumb_current = $careers_breadcrumb_current ?? $careers_page_title;
$stitle = defined('sitename') ? sitename : 'Careers';
$lte = '../tmsnew/';

$GLOBALS['careers_sidebar_assets_included'] = true;
$GLOBALS['careers_tms_full_lte_shell'] = true;
$careers_sidebar_context = 'tms';

header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($stitle . ' | ' . $careers_page_title, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="<?php echo htmlspecialchars($lte, ENT_QUOTES, 'UTF-8'); ?>dist/css/adminlte.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <style>
    .careers-sidebar-shell { font-family: "Source Sans 3", "Segoe UI", system-ui, sans-serif; }
    .careers-sidebar-shell .sidebar-brand-modern {
      background: linear-gradient(145deg, rgba(52,58,64,0.98) 0%, rgba(33,37,41,1) 100%);
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .careers-sidebar-shell .brand-wordmark { letter-spacing: 0.02em; }
    .careers-sidebar-shell .nav-link.active {
      background-color: rgba(255,255,255,0.12) !important;
      border-radius: 0.375rem;
    }
    .careers-sidebar-shell .careers-sidebar-logo-box {
      background: #fff;
      border-radius: 0.375rem;
      padding: 0.35rem 0.45rem;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.18);
    }
    .careers-sidebar-shell .careers-sidebar-logo {
      max-height: 44px;
      width: auto;
      max-width: 56px;
      object-fit: contain;
      display: block;
    }
    .careers-sidebar-shell .brand-title-line {
      font-size: 0.95rem;
      letter-spacing: 0.01em;
    }
    .careers-sidebar-shell .brand-subtitle-line {
      font-size: 0.72rem;
      opacity: 0.85;
    }
  </style>
  <?php
	if (!empty($careers_extra_head)) {
		echo $careers_extra_head;
	}
?>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-body">
      <div class="container-fluid">
        <?php include __DIR__ . '/../tmsnew/topbar.php'; ?>
      </div>
    </nav>
    <?php require __DIR__ . '/../tmsnew/sidebar.php'; ?>
    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0"><?php echo htmlspecialchars($careers_page_title, ENT_QUOTES, 'UTF-8'); ?></h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="<?php echo htmlspecialchars($lte, ENT_QUOTES, 'UTF-8'); ?>index.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($careers_breadcrumb_current, ENT_QUOTES, 'UTF-8'); ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
