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
    $msg = "";
    if(isset($_POST['hdn_submit']) && $_POST['hdn_submit'] == '1')
	{ 
        
        $nStatus = 0;
		$txtJobName = mysqli_real_escape_string($conn, trim($_POST['txtJobName']));
		$txtJobDesc = mysqli_real_escape_string($conn, trim($_POST['txtJobDesc']));

        $txtLocation = mysqli_real_escape_string($conn, trim($_POST['txtLocation']));
        $txtContactAdd = mysqli_real_escape_string($conn, trim($_POST['txtContactAdd']));
        $txtEmail = mysqli_real_escape_string($conn, trim($_POST['txtEmail']));
        $txtPerson = mysqli_real_escape_string($conn, trim($_POST['txtPerson']));
        $txtPhone = mysqli_real_escape_string($conn, trim($_POST['txtPhone']));
        $txtstdate = mysqli_real_escape_string($conn, trim($_POST['txtstdate']));
        $txtCategoryId = mysqli_real_escape_string($conn, trim($_POST['txtCategoryId']));
        $txtInstituteId = mysqli_real_escape_string($conn, trim($_POST['txtInstituteId']));
		if(isset($_POST['chkActive']))
        {
            $nStatus = 1;
        }
		
        $sqladd = "insert into cpo_jobmaster (vJobTitle,tJobDesc,tJobLocation, iCategoryId, dDate, iStatus, vContactAdd, vContactPerson, vContactPhone, iInstituteId, vJobEmailId) 
        values (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sqladd);
        $stmt->bind_param("sssisisssis", $txtJobName, $txtJobDesc, $txtLocation, $txtCategoryId, $txtstdate, $nStatus, $txtContactAdd, $txtPerson, $txtPhone, $txtInstituteId, $txtEmail);
        //runquery($sqladd);
        $stmt->execute();
		$msg = "New Job has been added.";
		addlog(2);
    }
    
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Add Job</title>
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
              <div class="col-sm-6"><h3 class="mb-0">Add Job</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Job</li>
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
            <div class="row">
                <div class="col-6">
                    <div class="card ">
                        <form name="frmtutor" method="post" >
                            <input type="hidden" name="hdn_submit" value="1">
                            <!--begin::Body-->
                            <div class="card-body">
                                <?php
                                    if($msg!="")
                                    {
                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php
                                                echo $msg;
                                            ?>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <div class="mb-3">
                                    <label for="txtJobName" class="form-label">Job Title</label>
                                    <input type="text" class="form-control" id="txtJobName" name="txtJobName" value="" required />
                                </div>
                                <div class="mb-3">
                                    <label for="txtJobDesc" class="form-label">Job Description</label>
                                    <textarea class="form-control" id="txtJobDesc" name="txtJobDesc" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="txtLocation" class="form-label">Location</label>
                                    <select name="txtLocation" id="txtLocation" class="form-control" required>
                                        <option value="">- Select -</option>
                                        <?php
                                            for($i=0; $i<count($arrLocations); $i++)
                                            {
                                                ?>
                                                <option value="<?php echo $arrLocations[$i];?>"><?php echo $arrLocations[$i];?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="txtContactAdd" class="form-label">Contact Address</label>
                                    <textarea class="form-control" id="txtContactAdd" name="txtContactAdd" required></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="txtEmail" class="form-label">Contact Email</label>
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="" required />
                                </div>
                                <div class="mb-3">
                                    <label for="txtPerson" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="txtPerson" name="txtPerson" value="" required />
                                </div>
                                <div class="mb-3">
                                    <label for="txtPhone" class="form-label">Contact Phone</label>
                                    <input type="text" class="form-control" id="txtPhone" name="txtPhone" value="" required />
                                </div>
                                <div class="mb-3">
                                    <label for="txtstdate" class="form-label">Validity Date</label>
                                    <input type="date" class="form-control" id="txtstdate" name="txtstdate" value="" required />
                                </div>
                                <div class="mb-3">
                                    <label for="txtCategoryId" class="form-label">Job Category</label>
                                    <select name="txtCategoryId" id="txtCategoryId" class="form-control" required>
                                        <option value="">- Select -</option>
                                        <?php
                                            $fetch="select * from cpo_categorymaster where iStatus=1";
                                            $result=runquery1($fetch);
                                            $count= $result ? mysqli_num_rows($result) : 0 ;
                                            
                                            while($row=mysqli_fetch_array($result))
                                            {
                                            ?>
                                            <option value="<? echo $row["iCategoryId"];?>"><? echo $row["vCategoryName"];?></option>
                                            <?
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="txtInstituteId" class="form-label">Institute</label>
                                    <select name="txtInstituteId" id="txtInstituteId" class="form-control" required>
                                        <option value="">- Select -</option>
                                        <?php
                                            $fetch="select * from cpo_institutemaster where iStatus=1";
                                            $result=runquery1($fetch);
                                            $count= $result ? mysqli_num_rows($result) : 0 ;
                                            
                                            while($row=mysqli_fetch_array($result))
                                            {
                                            ?>
                                            <option value="<? echo $row["iInstituteId"];?>"><? echo $row["vInstituteName"];?></option>
                                            <?
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="txtphone" class="form-label">Active</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="chkActive" name="chkActive" value="1" checked>
                                    </div>
                                </div>
                                
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                    </div>
                </div>
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
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>