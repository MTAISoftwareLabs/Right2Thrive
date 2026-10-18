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

    $sqlspn="select * from cpo_bookchattime where iTutorId=".$user_id." and iIsApproved=0 or (iIsApproved=1 and  EndApprovalDateTime >='".date('Y-m-d G:i:s')."')";
		$result = runquery($sqlspn);
		$count = mysqli_num_rows($result);
		$page=Ceil($count/page_size);
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by dBookingDate desc Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by dBookingDate desc Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by dBookingDate desc Limit 0,".page_size;
		   $curpage=0;
		}
		$result = runquery($sqlspn);
		$num=$result ? mysqli_num_rows($result) : 0;
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Approve Chat Time</title>
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
    <script language="JavaScript">
function getnewwin(obj,fid)
{
	new1=window.open("viewdownload.php?id="+obj+"&fid="+fid);
}
function submitpage()
{
	if (document.FRMUPLOAD.CMBLEARNER.value != "0")
	{
		document.FRMUPLOAD.action = "DownFiles.php?next=1&id="+document.FRMUPLOAD.CMBLEARNER.value;
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
              <div class="col-sm-6"><h3 class="mb-0">	
              Chat Time Bookings</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">	
                  Chat Time Bookings</li>
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
                            <?php
                                if($num>0)
                                {
                                    ?>
                                    <thead>
                                        <tr>
                                            <th width="30%"><b>Learner Name</b></th>
                                            <th width="25%"><b>Chat start date/time</b></th>
                                            <th width="25%"><b>Chat end date/time</b></th>
                                            <th width="25%"><b>Topic to discuss</b></th>
                                            <th width="15%"><b>Urgent</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($res=mysqli_fetch_array($result))
                                            {
                                                $sqluser="select vUserName from cpo_usermaster where iUserId=".$res['iUserId']."";
                                                $ressqluser=runquery($sqluser);
                                                $no=$ressqluser ? mysqli_num_rows($ressqluser) : 0;
                                                if($no>0)
                                                {
                                                    $ressqluser=mysqli_fetch_array($ressqluser);
                                                }
                                                ?>
                                                <tr>
                                                    <td height="25">&nbsp;<? echo $ressqluser['vUserName']; ?></td>
                                                    <?php
                                                        $sdt=explode(" ",$res['StartApprovalDateTime']); 
                                                        $startdt=gdate($sdt[0]).' '.$sdt[1];
                                                        $edt=explode(" ",$res['EndApprovalDateTime']); 
                                                        $enddt=gdate($sdt[0]).' '.$edt[1];
                                                    ?>
                                                    <td height="25" align="center"><? echo $startdt;?></td>
                                                    <td height="25" align="center"><? echo $enddt;?></td>
                                                    <td height="25" align="center"><? echo $res['vTopicToDiscuss']; ?></td>
                                                    <?php
                                                        if($res['iIsUrgent']==1)
                                                        {
                                                            ?>
                                                            <td align="center">&nbsp;Yes</td> 
                                                            <?php 
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <td align="center">&nbsp;No</td> 
                                                            <?php
                                                        }
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td style="width:100%; text-align: center;">
                                            No records exist in database !
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                }
                            ?>
                            
                        </table>
                    </div>
                    <?php
                        if($num>0)
                        {
                            ?>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <?php
                                        for($i=1;$i<=$page;$i++)
                                        {
                                            if($i==($curpage+1))
                                            {
                                                ?>
                                                <li class="page-item"><a class="page-link" href="#"><?php echo $i;?></a></li>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <li class="page-item"><a class="page-link" href="bookchattime.php?curpage=<?php echo $i-1;?>"><?php echo $i;?></a></li>
                                                <?php
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                    ?>
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