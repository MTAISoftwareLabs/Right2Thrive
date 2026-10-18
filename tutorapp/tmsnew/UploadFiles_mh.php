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
    function getIcon($filename)
    {
        switch(substr($filename,strlen($filename)-3,strlen($filename)))
        {
            case "swf" :
                return "../lms/images/swf.gif";
                break;
            case "doc" :
                return "../lms/images/doc.gif";
                break;
            case "jpg" :
                return "../lms/images/jpg.gif";
                break;
            case "peg" :
                return "../lms/images/jpg.gif";
                break;
            case "gif" :
                return "../lms/images/gif.gif";
                break;
            case "pdf" :
                return "../lms/images/pdf.gif";
                break;
            case "ppt" :
                return "images/ppt.gif";
                break;
            case "xls" :
                return "images/xls.gif";
                break;
            case "avi" :
                return "images/avi.gif";
                break;
            case "mpg" :
                return "images/mpeg.gif";
                break;
            default :
                return "images/gif.gif";
                break;
        }
    }

  
																									
							?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Upload files</title>
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
    <script type="text/javascript" language="javascript">
        
        
        
            function submitpage()
            {
                if (document.FRMUPLOAD.CMBLEARNER.value != "0")
                {
                    document.FRMUPLOAD.action = "UploadFiles_mh.php?next=1";
                    document.FRMUPLOAD.submit();
                }
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
              <div class="col-sm-6"><h3 class="mb-0">Progress Report</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Progress Report</li>
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
            <?php
            /*<div class="row">
                <div class="col-6">
                    <div class="card ">
                    <form name="FRMUPLOAD" method="post">
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                
                                <div class="mb-3">
                                    <label for="username" class="form-label">Select Learner</label>
                                    <select name="CMBLEARNER" class="form-control" onChange="submitpage()">
                                        <option value="0">Select Learner</option>
                                        <?php
                                            $sqllearner = "select distinct um.iUserId,um.vUserName from cpo_usermaster um,cpo_usercourse uc where vTutorId like '%".$_SESSION['user_id']."%' and um.iUserId=uc.iUserId";
                                            $rslearner = runquery($sqllearner);
                                            $num = $rslearner ? mysqli_num_rows($rslearner) : 0 ;
                                            
                                            $uid = 0;
                                            if (isset($_POST['CMBLEARNER']))
                                            {
                                                $uid = $_POST['CMBLEARNER'];
                                            }
                                            if ($num > 0)
                                            {
                                                $i = 0;
                                                while ($rsdata = mysqli_fetch_array($rslearner))
                                                {
                                                    if ($i == 0 && !isset($_POST['CMBLEARNER']))
                                                    {
                                                        $uid = $rsdata['iUserId'];
                                                    }
                                                    $i++;
                                                    ?>
                                                    <option value="<? echo $rsdata['iUserId']?>" <? if ($uid == $rsdata['iUserId']) {?> selected <? } ?>><? echo $rsdata['vUserName']?></option>
                                                    <?
                                                }
                                            }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            
                            <!--end::Footer-->
                        </form>
                    </div>
                </div>
            </div>
            */
            ?>
            <div class="row mt-5">
                <div class="col-md-6 col-xs-12">
                    <div class="card ">
                        <div class="card-header"><h2>Progress Report</h2></div>
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                <table>
                                    <?php

                                        $query_tutor_id = "select * from cpo_weekly_wellness_checkin where tutorid =".$_SESSION['user_id'];
                                        $result_tutor_id = runquery($query_tutor_id);
                                        $nos = 0;
                                        if($result_tutor_id)
                                        {
                                            $nos = mysqli_num_rows($result_tutor_id);
                                        }
                                        if($nos>0)
                                        {
                                            while($row = mysqli_fetch_array($result_tutor_id))
                                            {
                                                $sql1="select vUserName from cpo_usermaster where iUserId = '".$row["iStudentId"]."'";
                                                $result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
                                                $num = $result1 ? mysqli_num_rows($result1) : 0;
                                                $name = "";
                                                if ($num > 0)
                                                {
                                                    $rowname = mysqli_fetch_array($result1);
                                                    $name = $rowname['vUserName'];
                                                }
                                                ?>
                                                <tr>
                                                    <td><a target="_blank" href="get_weekly_wellness_details.php?id=<?php echo $row['id'];?>" class="linkcare" data-id="<?php echo $row['id'];?>"><? echo $name;?></a></td>
                                                    <td><? echo date("d/m/Y", strtotime($row['date_submission'])); ?></td>
                                                </tr>
                                                <?
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td colspan="2" class="bodytext" align="center" height="20"><b>No Learners Review Found.</b></td>
                                            </tr>
                                            <?
                                        }
                                    ?>
                                </table>
                                
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            
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