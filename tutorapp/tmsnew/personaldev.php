<?php
    include_once 'dbConnection.php';

    if(!isset($_SESSION['user_id']))
    {
        header("Location:../user_login.php");
    }
    else
    {
        $user_id = $_SESSION['user_id'];
    }
    $arrMonths = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    if(isset($_POST['hdn_submit']) &&  isset($_POST['hdn_submit']))
    {
      $student_name = $_POST['cmbstudent'];
      $tutor_name = $_SESSION['user_id'];
      $subject = $_POST['cmbsubject'];
      $year = $_POST['selyear'];
      $month = $_POST['selmonth'];
      $tutor_cmt = $_POST['tadesc'];

      $sql = "select I_userid from cpo_progressreport  where I_userid=".$student_name." and  I_tutorid=".$tutor_name." and  I_subjectId =".$subject." and I_month=".$month." and I_year=".$year;
      
      $exists=runquery1($sql) or die("could not execute query".mysqli_error($conn));

      $num = mysqli_num_rows($exists);
      
      
      if($num>0)
      {
        $msg = "Report for $month/$year Already Exists!";
        $bReport = false;
      }
      else
      {
        $addsql="insert into cpo_progressreport (I_userid,I_tutorid,I_subjectId,I_month,I_year,T_tcomments ) values (".$student_name.",".$_SESSION['user_id'].",".$subject.",".$month.",".$year.",'".$tutor_cmt."')";
        $record=runquery1($addsql) or die("could not execute query".mysqli_error($conn));

        if($record)
        {
          $bReport = true;
          $msg="Monthly Report Added Successfully";
        }
        else
        {
          $bReport = false;
          $msg="Error in Insert";
        }
      }
      $_SESSION['bReport'] = $bReport;
      $_SESSION['msg'] = $msg;
      header('Location: '.$_SERVER['PHP_SELF']);
      die;
    }

    if(isset($_POST['hdn_detention']) &&  isset($_POST['hdn_detention']))
    {
      $student_name = $_POST['cmbstudent'];
      $tutor_name = $_SESSION['user_id'];
      $date = $_POST['txtddate'];
      $reason = $_POST['txtreason'];
      $improve = $_POST['taimprove'];
      $tcmt = $_POST['tutorcomment'];
      $flag = 'D';

      //$sdate=explode("/",$deten_date);
      //$date = $sdate[2]."-".$sdate[1]."-".$sdate[0];	
      
      //check for duplicate
      $select = " SELECT I_userid, i_tutorid, D_detention FROM cpo_detention where I_userid='".$student_name."' and i_tutorid='".$tutor_name."' and D_detention='".$date."' and C_flag ='".$flag."'";
      $record=runquery1($select);
      $num = mysqli_num_rows($record);

      if($num >0)
      {
        $msg= "Detention Already Exists!";
        $bReport = false;
      }
      else
      {
        $addsql = "INSERT INTO cpo_detention (I_userid, i_tutorid, D_detention, V_reason, T_improve,T_tcomments,  C_flag) values ('".$student_name."','".$tutor_name."','".$date."','".$reason."','".$improve."','".$tcmt."','".$flag."') ";
        $record=runquery1($addsql) or die("could not execute query".mysqli_error($conn));
        if($record)
        {
          $msg="Detention Added Successfully";
          $bReport = true;
        }
        else
        {
          $msg="Error in Insert";	
          $bReport = false;
        }
      }
      $_SESSION['bReport'] = $bReport;
      $_SESSION['msg'] = $msg;
      header('Location: '.$_SERVER['PHP_SELF']);
      die;
    }

    if(isset($_POST['hdn_exclusion']) &&  isset($_POST['hdn_exclusion']))
    {
      $student_name = $_POST['cmbstudent'];
      $tutor_name = $_SESSION['user_id'];
      $deten_date = $_POST['txtddate'];
      $reason = $_POST['txtreason'];
      $improve = $_POST['taimprove'];
      $tcmt = $_POST['tutorcomment'];
      $flag = 'E';

      $sdate=explode("/",$deten_date);
      $date = $sdate[2]."-".$sdate[1]."-".$sdate[0];	

      //check for duplicate
      $select = " SELECT I_userid, i_tutorid, D_detention FROM cpo_detention where I_userid='".$student_name."' and i_tutorid='".$tutor_name."' and D_detention='".$date."' and C_flag ='".$flag."'";
      $record=runquery1($select);
      $num = mysqli_num_rows($record);

      if($num >0)
      {
        $msg= "Exclusion Already Exists!";
        $bReport = false;
      }
      else
      {
        $addsql = "INSERT INTO cpo_detention (I_userid, i_tutorid, D_detention, V_reason, T_improve,T_tcomments,  C_flag) values ('".$student_name."','".$tutor_name."','".$date."','".$reason."','".$improve."','".$tcmt."','".$flag."') ";
        $record=runquery1($addsql) or die("could not execute query".mysqli_error($conn));
        if($record)
        {
          $msg= "Exclusion Added Successfully";
          $bReport = true;
        }
        else
        {
          $msg="Error in Insert";
          $bReport = false;
        }
      }
      $_SESSION['bReport'] = $bReport;
      $_SESSION['msg'] = $msg;
      header('Location: '.$_SERVER['PHP_SELF']);
      die;
    }
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Personal Development</title>
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
        function get_report(id)
        {
          var xmlHttp;
          try
          {
            // Firefox, Opera 8.0+, Safari
            xmlHttp=new XMLHttpRequest();
          }
          catch (e)
          {
            // Internet Explorer
            try
            {
              xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e)
            {
              try
              {
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              catch (e)
              {
                alert("Your browser does not support AJAX!");
                return false;
              }
            }
          }
          if(id !='')
          {
          
            var query = "getreport.php?id="+id;
          }
          else
          {
            document.getElementById('id_report').style.display='none';
            document.getElementById('report').style.display='none';
            return false;
          }
          xmlHttp.onreadystatechange=function()
          {
            if(xmlHttp.readyState==4)
            {
              var number1 = xmlHttp.responseText;
              //document.getElementById('report').style.display = '';
              document.getElementById('id_report').style.display='';
              document.getElementById('id_report').innerHTML= number1;
            }
          }
          xmlHttp.open("GET",query,true);
          xmlHttp.send(null);
        }
        function hidevreport()
        {
          document.getElementById('id_report').style.display = 'none';
        }
        function validation_det()
        {
          var frm = document.frm_det;
          var d = new Date();
          date = d.getDate();
          month = d.getMonth()+1;
          year = d.getFullYear();
          
          for(var i=0; i <10; i++)
          {
            if(month == i)
            {
              month = "0"+month;
            }
            if(date == i)
            {
              date = "0"+date;
            }
          }

          var today = year+month+date;
          var temp = document.frm_det.txtddate.value.split('/');
          var ldate = temp[2]+temp[1]+temp[0];
          if(document.frm_det.cmbstudent.value=="")
          {
            alert("Learner must be selected!");
            document.frm_det.cmbstudent.focus();
            return false;
          }

          if(today > ldate)
          {
            alert("Detention date must be greater than or equal to current date.");
            document.frm_det.txtddate.focus();
            return false;
          }

          if(document.frm_det.txtreason.value=="")
          {
            alert("Detention reason cannot be blank!");
            document.frm_det.txtreason.focus();
            return false;
          }
          
          return true;
        }
        function validation_det()
        {
          
          var frm = document.frm_det;
          var d = new Date();	
          date = d.getDate();
          month = d.getMonth()+1;
          year = d.getFullYear();

          for(var i=0; i <10; i++)
          {
            if(month == i)
            {
              month = "0"+month;
            }
            if(date == i)
            {
              date = "0"+date;
            }
          }

          var today = year+month+date;
          var temp = document.frm_det.txtddate.value.split('-');
          var ldate = temp[0]+temp[1]+temp[2];
          if(document.frm_det.cmbstudent.value=="")
          {
            alert("Learner must be selected!");
            document.frm_det.cmbstudent.focus();
            return false;
          }
          
          if(today > ldate)
          {
            alert("Detention date must be greater than or equal to current date.");
            document.frm_det.txtddate.focus();
            return false;
          }

          if(document.frm_det.txtreason.value=="")
          {
            alert("Detention reason cannot be blank!");
            document.frm_det.txtreason.focus();
            return false;
          }	
          return true;
        }

        function validation_exc()
        {
          var frm = document.frm_exc;
          var d = new Date();
          date = d.getDate();
          month = d.getMonth()+1;
          year = d.getFullYear();

          for(var i=0; i <10; i++)
          {
            if(month == i)
            {
              month = "0"+month;
            }
            if(date == i)
            {
              date = "0"+date;
            }
          }

          var today = year+month+date;
          var temp = document.frm_exc.txtddate.value.split('-');
	        var ldate = temp[0]+temp[1]+temp[2];
          if(document.frm_exc.cmbstudent.value=="")
          {
            alert("Learner must be selected!");
            document.frm_exc.cmbstudent.focus();
            return false;
          }

          if(today > ldate)
          {
            alert("Exclusion date must be greater than or equal to current date.");
            document.frm_exc.txtddate.focus();
            return false;
          }

          if(document.frm_exc.txtreason.value=="")
          {
            alert("Exclusion reason cannot be blank!");
            document.frm_exc.txtreason.focus();
            return false;
          }
          return true;
        }
        function openreport(obj)
        {

          var new1=window.open("detail_report.php?id="+obj,"",'height=300,width=600,scrollbars=yes,top=50 left=150');
          return true;
        }

        function get_deten(id, flag)
        {
          document.getElementById('id_deten').innerHTML= "";
          //document.getElementById('id_exc').innerHTML= "";
          var xmlHttp;
          try
          {
            // Firefox, Opera 8.0+, Safari
            xmlHttp=new XMLHttpRequest();
          }
          catch (e)
          {
            // Internet Explorer
            try
            {
              xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e)
            {
              try
              {
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              catch (e)
              {
                alert("Your browser does not support AJAX!");
                return false;
              }
            }
          }
          if(!isNaN(id))
          {
            var query = "getdeten.php?id="+id+"&flag="+flag;
          }
          xmlHttp.onreadystatechange=function()
          {
            if(xmlHttp.readyState==4)
            {
              var number1 = xmlHttp.responseText;
              document.getElementById('id_deten').innerHTML= number1;
              document.getElementById('id_deten').style.display = 'inline';
            }
          }
          xmlHttp.open("GET",query,true);
          xmlHttp.send(null);
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
                if($_SESSION['bReport'])
                {
                  ?>
                  <div class="alert alert-success" role="alert">
                  <?php
                }
                else{
                  ?>
                  <div class="alert alert-danger" role="alert">
                  <?php
                }
                echo $_SESSION['msg'];
                ?>
                </div>
                <?php
                $_SESSION['msg'] = "";
                unset($_SESSION['msg']);
                unset($_SESSION['bReport']);
              }
            ?>
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Personal Development</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Personal Development</li>
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
                <div class="col-md-12 col-xs-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4>Monthly Progress Report</h4>
                        </div>
                        <form name="frm_report" method="post" action="">
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                
                                <div class="mb-3">
                                    <label for="month" class="form-label">Month</label>
                                    <select name="cmbmonth" class="form-select" onChange="get_report(this.value)">
                                      <option value="">Month</option>
                                      <option value="1">January</option>
                                      <option value="2">February</option>
                                      <option value="3">March</option>
                                      <option value="4">April</option>
                                      <option value="5">May</option>
                                      <option value="6">June</option>
                                      <option value="7">July</option>
                                      <option value="8">August</option>
                                      <option value="9">September</option>
                                      <option value="10">August</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="row">
                                  <div class="col-12" id="id_report">
                                  </div>
                                </div>
                              </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                &nbsp;
                            </div>
                            <!--end::Footer-->
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 col-xs-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4>Add Monthly Progress Report</h4>
                        </div>
                        <form name="frmreport" method="post" action="personaldev.php" onSubmit="return validation();">
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="cmbsubject" class="form-label">Select Subject</label>
                                  </div>
                                  <div class="col-8">
                                      <?php
                                        $sqls = "select us.I_user_subid ,us.I_subjectid , sb.vSubjectName  from cpo_user_subject as  us, cpo_subjectmaster  as sb where  sb.iSubjectId =us.I_subjectid and us.I_tutorid  =".$_SESSION['user_id']." group by us.I_subjectid";
                                        $querys = runquery1($sqls);
                                      ?>
                                      <select name="cmbsubject" id="cmbsubject" class="form-select" onChange="get_learner(this.value)">
                                        <option value="">Select Subject</option>
                                        <?php
                                          while($rows = mysqli_fetch_array($querys))
                                          {
                                            ?>
                                            <option value="<?php echo $rows['I_subjectid'];?>"><?php echo $rows['vSubjectName'];?></option>
                                            <?php
                                          }
                                        ?>
                                      </select>
                                  </div>
                                    
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="cmbstudent" class="form-label">Select Student</label>
                                  </div>
                                  <div class="col-8">
                                    <?php
                                      $sqls = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and us.I_tutorid  =".$_SESSION['user_id'] ." group by  us.I_studentid";
                                      $querys = runquery1($sqls);
                                    ?>
                                    <select name="cmbstudent" class="form-select">
                                      <option value="">Select Learner</option>
                                      <?php 
                                        while($rows = mysqli_fetch_array($querys))
                                        {
                                          ?>
                                          <option value="<?php echo $rows['I_studentid'];?>"><?php echo $rows['vUserName'];?></option>
                                          <?php
                                        }  
                                      ?>
                                      </select>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="selmonth" class="form-label">Select Year & Month</label>
                                  </div>
                                  <div class="col-4">
                                  <select name="selmonth" class="form-select">
                                    <option value="">Month</option>
                                    <?php 
                                    
                                      for ($m=0;$m<count($arrMonths);$m++){
                                        ?>
                                        <option value="<?php echo $m+1;?>"><?php echo $arrMonths[$m];?></option>
                                        <?php
                                      }
                                    ?>
                                  </select>
                                  </div>
                                  <div class="col-4">
                                  <select name="selyear" class="form-select">
                                    <option value="">Year</option>
                                    <?php 
                                      $yr = date('Y')-100;
                                      $year = date('Y')+1;
                                      for ($year;$year>$yr;$year--)
                                      {
                                        ?>
                                        <option value="<?php echo $year;?>" ><?php echo $year;?></option>
                                        <?php
                                      }
                                    ?>
                                    
                                  </select>
                                  </div>
                                    
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="tadesc" class="form-label">Tutor Comments</label>
                                  </div>
                                  <div class="col-8">
                                      <textarea id="tadesc" name="tadesc" class="form-control"></textarea>
                                      <input type="hidden" name="hdn_submit" value="1">
                                  </div>
                                    
                                </div>
                                
                              </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer text-end">
                                <button type="submit" class="btn-primary">Submit</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 col-xs-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4>View Detentions & Exclusions</h4>
                        </div>
                        <form name="frm_report" method="post" action="">
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                
                                <div class="row">
                                  <div class="col-lg-6 col-12">
                                    <label for="cmbdetentionlist" class="form-label">Detentions</label>
                                      <select name="cmbdetentionlist" class="form-select" onChange="get_deten(this.value, 'D')">
                                        <option value="">Detention</option>
                                        <?php
                                          $sqldet="SELECT * FROM cpo_detention where  C_flag='D' and I_tutorid  =".$_SESSION['user_id']." order by I_detentionid";
                                          $resdet=runquery1($sqldet);
                                          $countdet = mysqli_num_rows($resdet);
                                          for($i=0;$i<$countdet;$i++)
                                          {
                                            $rsdet = mysqli_fetch_array($resdet);
                                            ?>
                                            <option value="<? echo $rsdet['I_detentionid']?>"><? echo $rsdet['V_reason']?></option>
                                            <?php
                                          }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="col-lg-6 col-12">
                                    <label for="cmbdetentionlist" class="form-label">Exclusions</label>
                                      <select name="cmbdetentionlist" class="form-select" onChange="get_deten(this.value, 'E')">
                                        <option value="">Exclusions</option>
                                        <?php
                                          $sqldet="SELECT * FROM cpo_detention where  C_flag='E' and I_tutorid  =".$_SESSION['user_id']." order by I_detentionid";
                                          $resdet=runquery1($sqldet);
                                          $countdet = mysqli_num_rows($resdet);
                                          for($i=0;$i<$countdet;$i++)
                                          {
                                            $rsdet = mysqli_fetch_array($resdet);
                                            ?>
                                            <option value="<? echo $rsdet['I_detentionid']?>"><? echo $rsdet['V_reason']?></option>
                                            <?php
                                          }
                                        ?>
                                      </select>
                                  </div>
                                </div>
                                
                                <div class="row">
                                  <div class="col-12" id="id_deten">
                                  </div>
                                </div>
                              </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                &nbsp;
                            </div>
                            <!--end::Footer-->
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 col-xs-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4>Add Detention</h4>
                        </div>
                        <form name="frm_det" method="post" action="personaldev.php" onSubmit="return validation_det();">
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="cmbstudent" class="form-label">Select Learner</label>
                                  </div>
                                  <div class="col-8">
                                    <?php
                                      $sqls = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and us.I_tutorid  =".$_SESSION['user_id'] ." group by  us.I_studentid";
                                      $querys = runquery1($sqls);
                                    ?>
                                    <select name="cmbstudent" class="form-select">
                                      <option value="">Select Learner</option>
                                      <?php 
                                        while($rows = mysqli_fetch_array($querys))
                                        {
                                          ?>
                                          <option value="<?php echo $rows['I_studentid'];?>"><?php echo $rows['vUserName'];?></option>
                                          <?php
                                        }  
                                      ?>
                                      </select>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="selmonth" class="form-label">Date</label>
                                  </div>
                                  <div class="col-8">
                                  <input name="txtddate" type="date" class="form-control" value="<? echo date("Y-m-d");?>">
                                  </div>
                                    
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="tadesc" class="form-label">Reason for Detension</label>
                                  </div>
                                  <div class="col-8">
                                    <input type="text" name="txtreason" maxlength="100" size="40" class="form-control" >
                                      <input type="hidden" name="hdn_detention" value="1">
                                  </div>
                                    
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="tadesc" class="form-label">What do I need to improve?</label>
                                  </div>
                                  <div class="col-8">
                                    <textarea name="taimprove"  class="form-control"></textarea>
                                  </div>
                                    
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="tadesc" class="form-label">Tutor Comments</label>
                                  </div>
                                  <div class="col-8">
                                    <textarea name="tutorcomment"  class="form-control"></textarea>
                                  </div>
                                    
                                </div>
                                
                              </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer text-end">
                                <button type="submit" class="btn-primary">Submit</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 col-xs-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4>Add Exclusion</h4>
                        </div>
                        <form name="frm_exc" method="post" action="personaldev.php" onSubmit="return validation_exc();">
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="cmbstudent" class="form-label">Select Learner</label>
                                  </div>
                                  <div class="col-8">
                                    <?php
                                      $sqls = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and us.I_tutorid  =".$_SESSION['user_id'] ." group by  us.I_studentid";
                                      $querys = runquery1($sqls);
                                    ?>
                                    <select name="cmbstudent" class="form-select">
                                      <option value="">Select Learner</option>
                                      <?php 
                                        while($rows = mysqli_fetch_array($querys))
                                        {
                                          ?>
                                          <option value="<?php echo $rows['I_studentid'];?>"><?php echo $rows['vUserName'];?></option>
                                          <?php
                                        }  
                                      ?>
                                      </select>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="selmonth" class="form-label">Date</label>
                                  </div>
                                  <div class="col-8">
                                  <input name="txtddate" type="date" class="form-control" value="<? echo date("Y-m-d");?>">
                                  </div>
                                    
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="tadesc" class="form-label">Reason for Exclusion</label>
                                  </div>
                                  <div class="col-8">
                                    <input type="text" name="txtreason" maxlength="100" size="40" class="form-control" >
                                      <input type="hidden" name="hdn_exclusion" value="1">
                                  </div>
                                    
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="tadesc" class="form-label">What do I need to improve?</label>
                                  </div>
                                  <div class="col-8">
                                    <textarea name="taimprove"  class="form-control"></textarea>
                                  </div>
                                    
                                </div>
                                <div class="row mb-3">
                                  <div class="col-4">
                                    <label for="tadesc" class="form-label">Tutor Comments</label>
                                  </div>
                                  <div class="col-8">
                                    <textarea name="tutorcomment"  class="form-control"></textarea>
                                  </div>
                                    
                                </div>
                                
                              </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer text-end">
                                <button type="submit" class="btn-primary">Submit</button>
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