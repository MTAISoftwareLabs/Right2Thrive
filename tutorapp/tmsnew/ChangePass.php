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
    $class = "";
    if(isset($_POST['TXTUTOROLDPASSWORD']))
    {
        $sqlchange = "select vUserEmailId,vUserName from cpo_usermaster where vUserEmailId='".$_SESSION['email_id']."' and vUserPassword='".$_POST['TXTUTOROLDPASSWORD']."'";
        $rschange = runquery1($sqlchange);	
        $num = $rschange ? mysqli_num_rows($rschange) : 0 ;
        if ($num > 0 )
        {
            $rsdata = mysqli_fetch_array($rschange);
            $sqldelete = "update cpo_usermaster set vUserPassword='".$_POST['TXTUTORNEWPASSWORD']."' where iUserId=".$_SESSION['user_id'];
            runquery1($sqldelete);
            $msg = "Password changed successfully !";
            $fromname = "Auto response system";
            $fromaddress = admin_email;
            $toname = $rsdata['vUserName'];
            $toaddress = $rsdata['vUserEmailId'];
            $subject = "Change password from CareerPaths Online";
            $message ="<html><body><p>Dear ".$rsdata['vUserName'].",</p>";
            $message .= "<p>You have successfully change your password from '".$_POST['TXTUTOROLDPASSWORD']."' to '".$_POST['TXTUTORNEWPASSWORD']."'</p>";
            $message .= "<p>Warm Regard From,</p>";
            $message .= "<p>CareerPathOnline Team</p></body></html>";
            SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
            $class = "alert-success";
        }
        else
        {
            $msg = "Your Password does not match !";
            $class = "alert-danger";						
        }
    }
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Change Password</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="FAQ | AdminLTE 4" />
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
    <style>
      [data-astro-image] {
        width: 100%;
        height: auto;
        object-fit: var(--fit);
        object-position: var(--pos);
        aspect-ratio: var(--w) / var(--h);
      }
      [data-astro-image='responsive'] {
        max-width: calc(var(--w) * 1px);
        max-height: calc(var(--h) * 1px);
      }
      [data-astro-image='fixed'] {
        width: calc(var(--w) * 1px);
        height: calc(var(--h) * 1px);
      }
    </style>
    <script language="JavaScript">


function validation()
{
	if (document.FRMTUTORCHANGEPASSWORD.TXTUTOROLDPASSWORD.value == "")
	{	
		alert("Please enter old password !!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTOROLDPASSWORD.focus();
		return false;
	}
	if (document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.value == "")
	{	
		alert("Please enter new password !!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.focus();
		return false;
	}
	if(document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.value.length<4)
	{	
		alert("Password must be more than 4 character!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.focus();
		return false;
	}
	if(document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.value.length>16)
	{	
		alert("Password not more than 16 character!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.focus();
		return false;
	}
	
	if (document.FRMTUTORCHANGEPASSWORD.TXTUTORCONFIRMPASSWORD.value == "")
	{	
		alert("Please enter confirm password !!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORCONFIRMPASSWORD.focus();
		return false;
	}
	if (document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.value != document.FRMTUTORCHANGEPASSWORD.TXTUTORCONFIRMPASSWORD.value)
	{	
		alert("new password and confirm password must be same !!");
		document.FRMTUTORCHANGEPASSWORD.TXTUTORNEWPASSWORD.focus();
		document.FRMTUTORCHANGEPASSWORD.TXTUTORCONFIRMPASSWORD.value = "";
		return false;
	}
	return true;	
}


</script>
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
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
      <!--begin::Sidebar-->
      <?php require "sidebar.php";?>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Change Password</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
          <div class="col-md-6">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <!--end::Header-->
                  <?php
                    if($class!="")
                    {
                        ?>
                        <div class="alert m-1 <?php echo $class;?>" role="alert">
                            <?php echo $msg;?>
                        </div>
                        <?php
                    }
                  ?>
                  <!--begin::Form-->
                  <form name="FRMTUTORCHANGEPASSWORD" method="post" action="ChangePass.php" onSubmit=" return validation();">
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="TXTUTOROLDPASSWORD" class="form-label">Old Password</label>
                        <input type="password"  name="TXTUTOROLDPASSWORD" class="form-control" id="TXTUTOROLDPASSWORD">
                      </div>
                      <div class="mb-3">
                        <label for="TXTUTORNEWPASSWORD" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="TXTUTORNEWPASSWORD" name="TXTUTORNEWPASSWORD">
                      </div>
                      <div class="mb-3">
                        <label for="TXTUTORCONFIRMPASSWORD" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="TXTUTORCONFIRMPASSWORD" name="TXTUTORCONFIRMPASSWORD">
                      </div>
                      
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
                
              </div>
          
          
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <?php include "footer.php";?>
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
    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <?php 
    if($class!="")
    {
        ?>
        <script>
            $(document).ready(function(){
                console.log('function');
                $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
            });
        </script>
        <?php
    }
?>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>