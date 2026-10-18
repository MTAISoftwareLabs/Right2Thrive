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

if(isset($_GET['next']) && $_GET['next'] == 1)
								{
									$val = 0;
									if(count($_POST['CMBLEARNER']) < 1)
									{
										?>
										<script language="JavaScript">alert('Please select learner first');document.location = "UpFiles.php";</script>
										<?php
										//header("Location:UpFiles.php");
										//exit;
									}
									if ($_FILES['userfile']['type'] == "application/x-shockwave-flash" || 
										$_FILES['userfile']['type'] == "image/pjpeg" || 
										$_FILES['userfile']['type'] == "application/msword" || 
										$_FILES['userfile']['type']=="application/pdf" || 
										$_FILES['userfile']['type']== "image/gif" || 
										$_FILES['userfile']['type']== "application/octet-stream" || 
										$_FILES['userfile']['type']== "application/vnd.ms-powerpoint" || 
										$_FILES['userfile']['type']== "application/vnd.ms-excel" ||
										$_FILES['userfile']['type']== "video/avi" ||
										$_FILES['userfile']['type']== "video/mpeg")
									{
										//echo "./upload/".$_SESSION['user_name'].$_SESSION['user_id']."/".$_FILES['userfile']['name'];
										if (!(file_exists("./upload/".$_SESSION['user_id']."/".$_FILES['userfile']['name'])))
										{
											//echo "/".file_exists("./upload/".$_SESSION['user_name'].$_SESSION['user_id']."/".$_FILES['userfile']['name'])."/";
										}
									 	if (!file_exists("./upload/".$_SESSION['user_id']))
											mkdir("./upload/".$_SESSION['user_id'],0755);
										//move_uploaded_file($_FILES['FLUPFILE']['tmp_name'],"./upload/".$_SESSION['user_id']."/".$_FILES['userfile']['name']);
										//$uploaddir = './upload/'.$_SESSION['user_id'].'/';
										$uploaddir = '/home/careerp/public_html/tms/upload/'.$_SESSION['user_id'].'/';
										
										$uploadfile = $uploaddir . $_FILES['userfile']['name'];

										move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);
										//print_r($_FILES);

										$UserId='';
										foreach($_POST['CMBLEARNER'] as $value)
										{
											$UserId = $UserId.$value .",";		
										}
										$UserId = substr($UserId,0,strlen($UserId)-1);
										$sqladd = "insert into cpo_uploadfilestutor(iUserId,iTutorId,vFilePath,vUploadDate) values ('".$UserId."',".$_SESSION['user_id'].",'".$_FILES['userfile']['name']."','".date("Y-m-d")."')";
										runquery($sqladd);
										$qry = "select max(iFileId) from cpo_uploadfilestutor";
										$rsqry = runquery($qry);
										$num = isset($rsqry)?mysqli_num_rows($rsqry):0;
										if($num>0)
										{
											$resqry = mysqli_fetch_array($rsqry);
											$iFileId = $resqry[0];
											foreach($_POST['CMBLEARNER'] as $value)
											{
												$sqladdnew = "insert into cpo_uploadfilesviewed (iFileId, iUserId) values (".$iFileId.",".$value.")";		
												runquery($sqladdnew);
											}
										}
									}
								}	
								$sqlfiles = "select vFilePath from cpo_uploadfilestutor where iTutorId=".$_SESSION['user_id'];
								$rsfiles = runquery($sqlfiles);
								echo "<script language='JavaScript'>var files = [];";
								$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
								if ( $num > 0 )
								{ 
									$i = 0;
									while($rsdata = mysqli_fetch_array($rsfiles))
									{
										echo "files[".$i."]= new Array(2);";
										echo "files[".$i."][0]= 0;";										
										echo "files[".$i."][1]= '".$rsdata['vFilePath']."';";
									}
								}								
								echo "</script>";
								$sqllearner = "select iUserId,vUserName from cpo_usermaster ";
								$rslearner = runquery($sqllearner);
								$num = $rslearner ? mysqli_num_rows($rslearner) : 0 ; 
																									
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
        
        function getconfirm()
{	
	return(confirm("Are you sure you want to delete this file?"));

}
function validation()
{
	if (document.FRMUPLOADFILE.userfile.value == "")
	{
		alert("Please select file !");
		return false;
	}
	flag = 0;	
	file = document.FRMUPLOADFILE.userfile.value.split("\\"); 
	for(var j = 0; j<files.length; j++)
	{
		if (files[j][1] == file[file.length-1])
		{
			flag = 1;
		}
	}
	if (flag == 1)
	{
		var cn = confirm("File already uploaded ! Do you want to overwrite");
		if (cn)
		{
			return true;
		}
		else
		{
			document.FRMUPLOADFILE.userfile.value = "";
			return false;
		}	
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
            <?php
              if(isset($_SESSION['msg']) && trim($_SESSION['msg'])!="")
              {
                ?>
                <div class="alert alert-success" role="alert">
                  <?php echo $_SESSION['msg'];?>
                </div>
                <?php
                $_SESSION['msg'] = "";
                unset($_SESSION['msg']);
              }
            ?>
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Upload files</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Upload files</li>
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
                    <form name="FRMUPLOADFILE" enctype="multipart/form-data" method="POST" onSubmit="return validation();" action="UpFiles.php?next=1">
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                
                                <div class="mb-3">
                                    <label for="username" class="form-label">Select Learner</label>
                                    <select name=CMBLEARNER[] class="form-control" multiple>
                                        <?php
                                            while ($rsdata = mysqli_fetch_array($rslearner))
											{ ?>
												 <option value="<?php echo $rsdata['iUserId'];?>"><?php echo $rsdata['vUserName'];?></option>
											<?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="taddress" class="form-label">Upload File</label>
                                    <input type="file" name="userfile" id="userfile" class="form-control" size="50">
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                    </div>
                </div>
            </div>
            <?php
                $sqlfiles = "select vFilePath,vUploadDate,iFileId,iUserId from cpo_uploadfilestutor where iTutorId=".$_SESSION['user_id']." order by vUploadDate desc";
                $rsfiles = runquery($sqlfiles);
                $num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
                if ( $num > 0 )
                {
                    ?>
                    <div class="row mt-5">
                        <div class="col-md-6 col-xs-12">
                            <div class="card ">
                                <div class="card-header"><h2>Uploaded Files</h2></div>
                                    
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <table>
                                            <?php
                                                while($rsdata = mysqli_fetch_array($rsfiles))
                                                { 
                                                    $path = "./upload/".$_SESSION['user_id']."/".$rsdata['vFilePath'];
                                                    ?>
                                                    <tr> 
                                                    <td ><font color="#FF0000"><a target="_blank" href="<?php echo $path;?>"><?php echo $rsdata['vFilePath'];?></a></font></td>
                                                    <td ><?php echo gdate($rsdata['vUploadDate']);?></td>
                                                    <td ></td>
                                                    <td  align="center"><a target="_blank" href="<?php echo $path;?>"><img border="0" src="<?php echo getIcon($rsdata['vFilePath']);?>"></a></td>
                                                    <td  align="center" valign="middle">&nbsp;<a href="UpFilesDeleted.php?id=<?php echo $rsdata['iFileId'] ;?>" ><i class="bi bi-trash" onClick="return getconfirm(<?php echo $rsdata['iFileId'] ;?>)"></i></td>
                                                    </tr>
                                                    <tr><td  colspan="5"><b>Uploaded for</b> - <?php echo getlearnernames($rsdata['iUserId']);?></td></tr>
                                                    <tr>
                                                    <td colspan="5" height="5"><hr width="100%"></td>
                                                    </tr>
                                                    <?php
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
                    <?php
                }
            ?>
            
          
          
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