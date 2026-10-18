<?php
/**
 * Shared Careers hub sidebar for tutorapp/tmsnew (AdminLTE) and tutorapp/tms (embedded in legacy layouts).
 *
 * Before include, set: $careers_sidebar_context = 'tmsnew' | 'tms'
 * Requires $sitename (tmsnew dbConnection sets from sitename constant).
 */
$careers_sidebar_context = $careers_sidebar_context ?? 'tmsnew';
$careers_embed = ($careers_sidebar_context === 'tms');
$preNew = $careers_embed ? '../tmsnew/' : '';
$preTms = $careers_embed ? '' : '../tms/';

if (!function_exists('careers_nav')) {
	function careers_nav(string ...$slugs): string
	{
		static $page = null;
		if ($page === null) {
			$page = basename($_SERVER['SCRIPT_NAME'] ?? '', '.php');
		}
		foreach ($slugs as $s) {
			if ($page === $s) {
				return ' active';
			}
		}
		return '';
	}
}

if (!function_exists('tmsnew_nav')) {
	function tmsnew_nav(string ...$slugs): string
	{
		return careers_nav(...$slugs);
	}
}

$logo_src = app_tutorapp_careers_logo_href();
$css_base = htmlspecialchars($preNew, ENT_QUOTES, 'UTF-8');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<?php if ($careers_embed) { ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo $css_base; ?>dist/css/adminlte.css" />
<?php } ?>
<style>
  .careers-sidebar-shell { font-family: "Source Sans 3", "Segoe UI", system-ui, sans-serif; }
  .careers-sidebar-shell .sidebar-brand-modern {
    background: linear-gradient(145deg, rgba(52,58,64,0.98) 0%, rgba(33,37,41,1) 100%);
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }
  .careers-sidebar-shell .brand-wordmark { letter-spacing: 0.02em; }
  .careers-sidebar-shell.careers-sidebar-embed {
    min-height: 100vh;
    width: 100%;
    max-width: 280px;
  }
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
<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow careers-sidebar-shell<?php echo $careers_embed ? ' careers-sidebar-embed' : ''; ?>" data-bs-theme="dark">
  <div class="sidebar-brand border-0 p-0 sidebar-brand-modern">
    <a href="<?php echo htmlspecialchars($preNew . 'index.php', ENT_QUOTES, 'UTF-8'); ?>" class="brand-link d-block text-decoration-none px-3 py-3">
      <div class="d-flex align-items-center gap-2 flex-nowrap">
        <span class="careers-sidebar-logo-box" aria-hidden="true">
          <img src="<?php echo htmlspecialchars($logo_src, ENT_QUOTES, 'UTF-8'); ?>" alt="" width="56" height="44" class="careers-sidebar-logo" decoding="async" fetchpriority="high" />
        </span>
        <div class="text-start lh-sm flex-grow-1 min-w-0">
          <div class="brand-wordmark brand-title-line text-white fw-semibold">Right2Thrive UK</div>
          <!-- Careers Hub branding hidden for now
          <div class="brand-subtitle-line text-white">Collective Careers Hub</div>
          -->
        </div>
      </div>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <nav class="mt-2 pb-3">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'index.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('index'); ?>">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'AccountSummary.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('AccountSummary'); ?>">
            <i class="fa fa-id-card"></i>
            <p>Account Summary</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'personalinfo.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('personalinfo'); ?>">
            <i class="fa fa-user"></i>
            <p>Personal Information</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'personaldev.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('personaldev'); ?>">
            <i class="fa fa-user"></i>
            <p>Personal Development</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'admindownfiles.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('admindownfiles'); ?>">
            <i class="fa fa-download"></i>
            <p>Admin Uploaded Files</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'career_chat.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('career_chat'); ?>">
            <i class="fa fa-comments"></i>
            <p>Career coach chat</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'bookchattime.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('bookchattime'); ?>">
            <i class="fa fa-calendar"></i>
            <p>Chat Time Bookings</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'chatnow.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('chatnow'); ?>">
            <i class="fa fa-commenting"></i>
            <p>Chat Now</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'career_progress.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('career_progress'); ?>">
            <i class="fa fa-line-chart"></i>
            <p>Career Progress (Mentor)</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'career_progress.php?mode=admin', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link">
            <i class="fa fa-users"></i>
            <p>Career Progress (Admin)</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'gad7.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('gad7'); ?>">
            <i class="fa fa-upload"></i>
            <p>GAD 7</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'phq9.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('phq9'); ?>">
            <i class="fa fa-upload"></i>
            <p>PHQ 9</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'sendmail.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('sendmail'); ?>">
            <i class="fa fa-envelope"></i>
            <p>Send Mail</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'StudentLogBook.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('StudentLogBook'); ?>">
            <i class="fa fa-book"></i>
            <p>Add Learner Log</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'ViewStudentLogBook.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('ViewStudentLogBook'); ?>">
            <i class="fa fa-list"></i>
            <p>View Learner Log</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'StudentInformation.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('StudentInformation'); ?>">
            <i class="fa fa-users"></i>
            <p>Add Learner Information</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'ViewStudentInformation.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('ViewStudentInformation'); ?>">
            <i class="fa fa-list-alt"></i>
            <p>View Learner Information</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'SuggestJob.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('SuggestJob'); ?>">
            <i class="fa fa-briefcase"></i>
            <p>Add Job Suggestion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'ViewSuggestJob.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('ViewSuggestJob'); ?>">
            <i class="fa fa-search"></i>
            <p>View Job Suggestion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'AssignPlan.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('AssignPlan'); ?>">
            <i class="fa fa-tasks"></i>
            <p>Assign Learning Plan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'GetStudentPlan.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('GetStudentPlan'); ?>">
            <i class="fa fa-download"></i>
            <p>Download Learning Plan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'UploadPlan.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('UploadPlan'); ?>">
            <i class="fa fa-upload"></i>
            <p>Upload Learning Plan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'AssignReview.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('AssignReview'); ?>">
            <i class="fa fa-tasks"></i>
            <p>Assign Learning Review</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'GetStudentReview.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('GetStudentReview'); ?>">
            <i class="fa fa-download"></i>
            <p>Download Learning Review</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'UploadReview.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('UploadReview'); ?>">
            <i class="fa fa-upload"></i>
            <p>Upload Learning Review</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'view_care_plan.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('view_care_plan'); ?>">
            <i class="fa fa-heart"></i>
            <p>View Care Plans</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preTms . 'view_weekly_wellness_checking.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('view_weekly_wellness_checking'); ?>">
            <i class="fa fa-calendar-check-o"></i>
            <p>View Weekly Wellness Check-in</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'category.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('category', 'addcategory', 'editcategory', 'deletecategory', 'change_cat_status'); ?>">
            <i class="fa fa-list-alt"></i>
            <p>Categories</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'jobs.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('jobs', 'addjob', 'editjob', 'deletejob', 'change_job_status'); ?>">
            <i class="fa fa-list-alt"></i>
            <p>Jobs</p>
          </a>
        </li>
        <li class="nav-item">
          <a target="_blank" rel="noopener" href="http://www.groupworld.net/mp/parse.cgi?filename=nc&amp;inst_id=375&amp;instance=conf1&amp;iframe=true" class="nav-link">
            <i class="fa fa-video-camera"></i>
            <p>Virtual Classroom</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'guidance.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('guidance'); ?>">
            <i class="fa fa-life-ring"></i>
            <p>Guidance &amp; induction</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'equal_opportunity.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('equal_opportunity'); ?>">
            <i class="fa fa-balance-scale"></i>
            <p>Equal Opportunity</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'terms_conditions.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('terms_conditions'); ?>">
            <i class="fa fa-gavel"></i>
            <p>Terms and Conditions</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'data.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('data'); ?>">
            <i class="fa fa-database"></i>
            <p>Data Protection Policy</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo htmlspecialchars($preNew . 'statement_policy.php', ENT_QUOTES, 'UTF-8'); ?>" class="nav-link<?php echo careers_nav('statement_policy'); ?>">
            <i class="fa fa-bullhorn"></i>
            <p>Service Statement Policy</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!--end::Sidebar-->
