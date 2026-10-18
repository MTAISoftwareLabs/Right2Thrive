<?php
    session_cache_expire(time()-1);
    session_cache_limiter('nocache');
    @ob_start();	
    include "dbConnection.php";
    if (!isset($_SESSION['user_id']))
    { 
        header("Location:../user_login.php");
    }
    else
    {
        $user_id = $_SESSION['user_id'];
    }
    function getlearnernames($ids)
    {

      $strnames = '';
      if($ids)
      {	
        $strids = explode(',',$ids);
        
        for($i=0;$i<count($strids);$i++)
        {
          $sqlselect = "select vUserName from cpo_usermaster where iUserId=".$strids[$i];
          //echo $sqlselect.'<br>';
          $rssqlselect = runquery($sqlselect);
          if(isset($rssqlselect))
          {
            $rssqlselect1 = mysqli_fetch_array($rssqlselect);
            $strnames = $strnames.$rssqlselect1[0].' , ';
          }
        }
        $strnames = substr($strnames,0,strlen($strnames)-2);
      }
      return $strnames;
    }
    
    
    
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['file_delete_id'])) {
   
    $fileId = intval($_POST['file_delete_id']);

    $stmt = $conn->prepare("DELETE FROM cpo_uploadfilestutor WHERE iFileId = ?");
    $stmt->bind_param("i", $fileId);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
    exit;
}

$tutorName = isset($_SESSION['user_name']) ? trim((string) $_SESSION['user_name']) : 'Coach';
$fileCount = 0;
$fileRes = runquery("SELECT COUNT(*) AS c FROM cpo_uploadfilestutor WHERE iTutorId=" . (int) $_SESSION['user_id']);
if ($fileRes && mysqli_num_rows($fileRes)) {
    $fileCount = (int) mysqli_fetch_assoc($fileRes)['c'];
}
$learnerCount = 0;
if (function_exists('career_column_exists') || file_exists(dirname(__DIR__, 2) . '/career_progress_lib.php')) {
    require_once dirname(__DIR__, 2) . '/career_progress_lib.php';
    if (career_column_exists($conn, 'cpo_usermaster', 'career_mentor_id')) {
        $lr = mysqli_query($conn, 'SELECT COUNT(*) AS c FROM cpo_usermaster WHERE iUserType=2 AND iUserStatus=1 AND career_mentor_id=' . (int) $_SESSION['user_id']);
        if ($lr && mysqli_num_rows($lr)) {
            $learnerCount = (int) mysqli_fetch_assoc($lr)['c'];
        }
    }
}

?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Dashboard</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="<?php echo $sitename;?> | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet" />
    <style>
      .tms-dash {
        --td-indigo: #4f46e5;
        --td-indigo-soft: #eef2ff;
        --td-teal: #0d9488;
        --td-teal-soft: #ecfdf5;
        --td-amber-soft: #fffbeb;
        --td-ink: #0f172a;
        --td-muted: #64748b;
        --td-line: #e2e8f0;
        --td-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
        font-family: "Plus Jakarta Sans", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
      }
      .tms-dash .app-content-header {
        background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);
        border-bottom: 1px solid var(--td-line);
        padding: 1rem 0;
      }
      .tms-dash .app-content-header h3 {
        font-weight: 800;
        letter-spacing: -0.03em;
        color: var(--td-ink);
        margin: 0;
      }
      .tms-dash .app-content { padding-top: 1.25rem; padding-bottom: 2rem; }
      .tms-hero {
        border-radius: 1.15rem;
        padding: 1.5rem 1.6rem;
        background: linear-gradient(135deg, #f8fafc 0%, var(--td-indigo-soft) 42%, var(--td-teal-soft) 100%);
        border: 1px solid var(--td-line);
        box-shadow: var(--td-shadow);
        margin-bottom: 1.5rem;
      }
      .tms-hero__eyebrow {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--td-indigo);
        margin-bottom: 0.35rem;
      }
      .tms-hero__title {
        font-size: clamp(1.35rem, 2.5vw, 1.75rem);
        font-weight: 800;
        letter-spacing: -0.03em;
        color: var(--td-ink);
        margin: 0 0 0.35rem;
      }
      .tms-hero__sub { color: var(--td-muted); font-size: 0.95rem; margin: 0; max-width: 42rem; }
      .tms-stat-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 0.85rem; margin-bottom: 1.5rem; }
      .tms-stat {
        background: #fff;
        border: 1px solid var(--td-line);
        border-radius: 1rem;
        padding: 1rem 1.1rem;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
      }
      .tms-stat__label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--td-muted); }
      .tms-stat__value { font-size: 1.65rem; font-weight: 800; color: var(--td-ink); line-height: 1.2; margin-top: 0.2rem; }
      .tms-stat__icon {
        width: 2.25rem; height: 2.25rem; border-radius: 0.65rem;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 1.1rem; margin-bottom: 0.5rem;
      }
      .tms-stat__icon--indigo { background: var(--td-indigo-soft); color: var(--td-indigo); }
      .tms-stat__icon--teal { background: var(--td-teal-soft); color: var(--td-teal); }
      .tms-stat__icon--amber { background: var(--td-amber-soft); color: #b45309; }
      .tms-hub-card {
        border: 1px solid var(--td-line) !important;
        border-radius: 1rem !important;
        box-shadow: var(--td-shadow) !important;
        height: 100%;
        overflow: hidden;
      }
      .tms-hub-card .card-header {
        background: linear-gradient(180deg, #fafbff 0%, #fff 100%);
        border-bottom: 1px solid var(--td-line);
        padding: 1rem 1.15rem;
      }
      .tms-hub-card .card-header h2 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: var(--td-ink);
        display: flex;
        align-items: center;
        gap: 0.5rem;
      }
      .tms-hub-card .card-header .hub-icon {
        width: 2rem; height: 2rem; border-radius: 0.5rem;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 1rem;
      }
      .tms-hub-card .card-body { padding: 0.65rem 0.85rem 1rem; }
      .tms-link-grid { display: flex; flex-direction: column; gap: 0.35rem; }
      .tms-link-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 0.75rem;
        border-radius: 0.65rem;
        text-decoration: none !important;
        color: var(--td-ink) !important;
        border: 1px solid transparent;
        transition: background 0.15s, border-color 0.15s, transform 0.12s;
      }
      .tms-link-item:hover {
        background: #f8fafc;
        border-color: var(--td-line);
        transform: translateX(2px);
      }
      .tms-link-item__icon {
        flex-shrink: 0;
        width: 2.1rem; height: 2.1rem; border-radius: 0.55rem;
        background: var(--td-indigo-soft);
        color: var(--td-indigo);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
      }
      .tms-link-item--teal .tms-link-item__icon { background: var(--td-teal-soft); color: var(--td-teal); }
      .tms-link-item--amber .tms-link-item__icon { background: var(--td-amber-soft); color: #b45309; }
      .tms-link-item__text { flex: 1; min-width: 0; }
      .tms-link-item__title { font-weight: 600; font-size: 0.9rem; display: block; }
      .tms-link-item__desc { font-size: 0.78rem; color: var(--td-muted); display: block; margin-top: 0.1rem; }
      .tms-link-item__arrow { color: #94a3b8; font-size: 0.85rem; }
      .tms-files-card .card-header h2 { margin: 0; font-size: 1.05rem; font-weight: 800; }
      .tms-files-table { margin: 0; font-size: 0.875rem; }
      .tms-files-table thead th {
        background: #f8fafc;
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--td-muted);
        border-bottom: 1px solid var(--td-line);
        white-space: nowrap;
      }
      .tms-files-table tbody td { vertical-align: middle; border-color: #f1f5f9; }
      .tms-files-table a { font-weight: 500; color: var(--td-indigo); word-break: break-all; }
      .tms-empty {
        text-align: center;
        padding: 2.5rem 1rem;
        color: var(--td-muted);
      }
      .tms-empty i { font-size: 2.5rem; opacity: 0.35; display: block; margin-bottom: 0.75rem; }
      .tms-featured {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        margin-top: 1rem;
        padding: 0.45rem 0.85rem;
        border-radius: 999px;
        background: #fff;
        border: 1px solid var(--td-line);
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--td-indigo);
        text-decoration: none;
      }
      .tms-featured:hover { background: var(--td-indigo-soft); color: var(--td-indigo); }
    </style>
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary tms-dash">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <?php include "topbar.php";?>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <?php require "sidebar.php";?>
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-8"><h3 class="mb-0">Tutor dashboard</h3></div>
              <div class="col-sm-4">
                <ol class="breadcrumb float-sm-end mb-0">
                  <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <?php require __DIR__ . '/index_dashboard_body.php'; ?>
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <?php require "footer.php";?>
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script language="JavaScript" type="text/javascript">
      function openwin(obj)
      {
        new1=window.open("Detail_LogBook.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
      }
</script>
<script>
$(document).ready(function(){
    $('.deleteFileBtn').on('click', function(){
        var fileID = $(this).data('id');

        if (confirm("Are you sure you want to delete this file?")) {
            $.ajax({
                url: 'index.php', // Same page or separate handler
                type: 'POST',
                data: { file_delete_id: fileID },
                success: function(response){
                    if (response.trim() === 'success') {
                        $('#file-row-' + fileID).fadeOut(300, function(){
                            $(this).remove();
                        });
                    } else {
                        alert('Delete failed: ' + response);
                    }
                },
                error: function(){
                    alert('An error occurred while deleting.');
                }
            });
        }
    });
});
</script>

    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
