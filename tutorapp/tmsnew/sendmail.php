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
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "images/swf.gif";
			break;
		case "doc" : 
			return "images/doc.gif";
			break;			
		case "jpg" : 
			return "images/jpg.gif";
			break;			
		case "peg" : 
			return "images/jpg.gif";
			break;			
		case "gif" : 
			return "images/gif.gif";
			break;			
		case "pdf" : 
			return "images/pdf.gif";								
			break;
		default : 
			return "NONE";				
			break;			
	}
}

$msg = "";
if(isset($_GET['next']) && $_GET['next'] == 1)
{
    $learner_id = "";	
    foreach($_POST['CMBLEARNER'] as $value)
    {
        $learner_id.= $value. ",";
    }
    $learner_id = substr($learner_id,0,strlen($learner_id)-1);
    if ($learner_id <> "-")
    {
        $fromname=$_SESSION['user_name'];
        $to=$_POST['email'];
        $subject=$_POST['txtsubject'];
        $message=$_POST['txtcontents'];
        $idname =explode(',',$value);								  
        $toname=$idname[1];
        $toaddress=$idname[0];
        $header = "From:hello@right2thrive.org \r\n";
        //  $header .= "Cc:afgh@somedomain.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $mailflg=mail($to, $subject, $message,$header);
        $msg = '<div class="alert alert-success" role="alert">Mail Sent to Learner Successfully.</div>';
    }
    else
    {
        $msg = '<div class="alert alert-danger" role="alert">First Select Learner.</div>';
    }
}    
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Send Mail</title>
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
        
        function validation()
{
  
	if(document.FRMUPLOADFILE.txtsubject.value == "")
	{
		alert("Please write messege Subject !");
		document.FRMUPLOADFILE.txtsubject.focus();
		return false;
	}

	if (document.FRMUPLOADFILE.txtcontents.value == "")
	{
		alert("Please write messege Contents !");
		document.FRMUPLOADFILE.txtcontents.focus();
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
              <div class="col-sm-6"><h3 class="mb-0">Send Mail to Learner</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Send Mail</li>
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
                <div class="col-md-6 col-xs-12">
                    <div class="card ">
                    <form name="FRMUPLOADFILE" method="post" onSubmit="return validation();" action="sendmail.php?next=1"  enctype="multipart/form-data">
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
                                    <?php
                                        $sqllearner = "select vUserEmailId,iUserId,vUserName from cpo_usermaster";
                                        $rslearner = runquery($sqllearner);
                                        $num = $rslearner ? mysqli_num_rows($rslearner) : 0 ; 
                                    ?>
                                    <label for="email" class="form-label">Select Learner</label>
                                    <select name="email" id="email" class="form-control">
									  <option  selected>Select Learner</option>
                                      <?php
                                        while ($rsdata = mysqli_fetch_array($rslearner))
                                        { ?>
                                             <option value="<? echo $rsdata['vUserEmailId'] ?>"><? echo $rsdata['vUserName'];?></option>
                                        <? }
                                      ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="txtsubject" class="form-label">Messege Subject</label>
                                    <input type="text" class="form-control" id="txtsubject" name="txtsubject" maxlength="12" value="" />
                                </div>
                                <div class="mb-3">
                                    <label for="txtcontents" class="form-label">Messege Contents</label>
                                    <textarea class="form-control" id="txtcontents" name="txtcontents"></textarea>
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