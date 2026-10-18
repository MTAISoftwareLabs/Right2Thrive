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

    if (isset($_GET['submit'])  && $_GET['submit'] == 1)
    {
        $sqlacc = "select * from cpo_usercourse where iCourseStatus=1 and vTutorId like '%".$user_id."%' order by iUserId";
        $rsacc = runquery($sqlacc);
        $num = $sqlacc ? mysqli_num_rows($rsacc) : 0 ;
        if ($num > 0)
        {
            while ($rsdata = mysqli_fetch_array($rsacc))
            {
                $allsubject = explode(",",$rsdata['vSubjectId']);
                $alltutor = explode(",",$rsdata['vTutorId']);
                $status = explode(",",$rsdata['vSubjectStatus']);
                $value = $_POST["t".$rsdata['iUserCourseId']."t"];
                $t = explode(":",$value);
                $str = "";
                if (count($allsubject) > 0)
                {
                    for($i=0;$i<=count($allsubject)-1;$i++)
                    {
                        if (isset($_POST['CHK'.$rsdata['iUserCourseId'].$i]) && $_POST['CHK'.$rsdata['iUserCourseId'].$i] == "on")
                        {
                            $str .= "1,";
                        }
                        else
                        {
                            $f = 0;
                            for ($j = 0;$j<=count($t)-1;$j++)
                            {
                                if ($t[$j] == $i)
                                {
                                    $f = 1;
                                }
                            }
                            if ($f == 1)
                            {
                                $str .= "0,";
                            }
                            else
                            {
                                $str .= $status[$i].",";
                            }
                        }
                    }
                }
                else
                {
                    for ($i=0;$i<=count($alltutor)-1;$i++)
                    {
                        if (isset($_POST['CHK'.$rsdata['iUserCourseId'].$i]) && $_POST['CHK'.$rsdata['iUserCourseId'].$i] == "on")
                        {
                            $str .= "1,";
                        }
                        else
                        {
                            $f = 0;
                            for ($j = 0;$j<=count($t)-1;$j++)
                            {
                                if ($t[$j] == $i)
                                {
                                    $f = 1;
                                }
                            }
                            if ($f == 1)
                            {
                                $str .= "0,";
                            }
                            else
                            {
                                $str .= $status[$i].",";
                            }
                        }
                    }	
                }
                $sqlupdate = "update cpo_usercourse set vSubjectStatus='".substr($str,0,strlen($str)-1)."' where iUserCourseId=".$rsdata['iUserCourseId'];	
                runquery($sqlupdate);
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Tutor Account Summary</title>
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
        function complete()
        {
            var len=document.all.length;
            var chkname;
            for(i=0;i<len;i++)
            {
                if(document.all(i).type=="checkbox" && document.all(i).checked == false)
                {
                    name = document.all(i).name;
                    id = String(eval("document.FRMACCSUMMARY."+name+"t").value).split("/");	
                    temp = "document.FRMACCSUMMARY.t"+id[0]+"t";
                    document.getElementById(id[0]).value = document.getElementById(id[0]).value + id[1] + ":";
                }
            }	
            document.FRMACCSUMMARY.action = "AccountSummary.php?submit=1";
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
              <div class="col-sm-6"><h3 class="mb-0">Account Summary</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Account Summary</li>
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
            <form name="FRMACCSUMMARY" method="post" onSubmit="return complete();">
                <div class="card">
                    <div class="card-body">
                    
                        <table class="table table-bordered">
                            <tbody>
                                <?php
                                    $sqlacc = "select * from cpo_usercourse where  vTutorId like '".$_SESSION['user_id']."' order by iUserId";
                                    //echo $sqlacc;
                                    $rsacc = runquery1($sqlacc);
                                    $num = $rsacc ? mysqli_num_rows($rsacc) : 0 ;
                                    $cname = "";
                                    $uname = "";
                                    $once = 0;
                                    if ($num > 0 )
                                    {
                                        while ($rsdata = mysqli_fetch_array($rsacc))
                                        {
                                            $status = explode(",",$rsdata['vSubjectStatus']);
                                            if ($uname <> $rsdata['iUserId'])
                                            {
                                                $sqlcourse = "select vUserName from cpo_usermaster where iUserId=".$rsdata['iUserId'];
                                                $rscourse = runquery($sqlcourse);
                                                $num1 = $rscourse ? mysqli_num_rows($rscourse) : 0 ;
                                                if ( $num1 > 0 )
                                                {
                                                    $rscs = mysqli_fetch_array($rscourse);
                                                    $cname = $rscs['vUserName'];
                                                }
                                            }
                                            $uname = $rsdata['iUserId'];
                                            ?>
                                            <tr>
                                                <th>
                                                    Learner Name
                                                    <input type="hidden" name="t<?php echo $rsdata['iUserCourseId']; ?>t" id="<?php echo $rsdata['iUserCourseId']; ?>">
                                                </th>
                                                <td><strong><?php echo $cname; ?></strong></td>
                                            </tr>
                                            <?php
                                            $couname = '';
                                            if(trim($rsdata['iCourseId'])!="")
                                            {
                                                $sqlsubject = "select vCourseName from cpo_coursemaster where iCourseId=".$rsdata['iCourseId'];
                                                $rssubject = runquery($sqlsubject);
                                                $num2 = $rssubject ? mysqli_num_rows($rssubject) : 0;
                                                if ($num2 > 0)
                                                {
                                                    $rsc = mysqli_fetch_array($rssubject);
                                                    $couname = $rsc['vCourseName'];
                                                }
                                            }

                                            if(trim($rsdata['vSubjectId'])!='')
                                            {
                                                $sqlusers ="SELECT vSubjectName FROM cpo_subjectmaster WHERE iSubjectId in (".$rsdata['vSubjectId'].")";
                                                $rsusers = runquery($sqlusers);
                                                $num3 = $rsusers ? mysqli_num_rows($rsusers) : 0;
                                                if ($num3 > 0)
                                                {
                                                    ?>
                                                    <tr>
                                                        <th>Course Name</th>
                                                        <th>Subject Name</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    <?php
                                                    $ind = 0;
                                                    $allsubject	= explode(",",$rsdata['vTutorId']);
                                                    $allcomp = explode(",",$rsdata['vSubjectStatus']);
                                                    while ($rssubjectids = mysqli_fetch_array($rsusers))
                                                    {
                                                        if ($allsubject[$ind] == $_SESSION['user_id'])
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $couname;?></td>
                                                                <td><?php echo $rssubjectids['vSubjectName'];?></td>
                                                                <?php
                                                                    $name = "CHK".$rsdata['iUserCourseId'].$ind;
                                                                ?>
                                                                <td>
                                                                    <input type="checkbox" name="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"<?php if ($allcomp[$ind] == 1) { echo ' checked'; } ?>>
                                                                    <input type="hidden" name="<?php echo htmlspecialchars($name.'t', ENT_QUOTES, 'UTF-8'); ?>" value="<?php echo htmlspecialchars($rsdata['iUserCourseId']."/".$ind, ENT_QUOTES, 'UTF-8'); ?>">
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        $ind++;
                                                    } // Inner while loop end
                                                    $once = 1;
                                                }
                                            }
                                        }
                                    }
                                    else {
                                        ?>
                                        <tr>
                                            <td>No summary available</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <?php
                    if ($num > 0 )
                    {
                        ?>
                        <input type="submit" class="btn btn-primary" value="Submit" />
                        <?php
                    }
                ?>
            </form>
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