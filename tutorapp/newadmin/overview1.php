<?php
@ob_start();
include_once 'dbConnection.php';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
//$result = $_GET["id"];
$result = 'subject';
//echo $result;
//die();
if($result=="course") 
{
	$Title="Course";
	$addfile="addcourse.php";
	$viewfile="viewcourse.php";
	$listfile="listcourse.php";
	$sql="select * from cpo_coursemaster";
	$result1=runquery1($sql);
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="subject") 
{
	$Title="Subject";
	$addfile="addsubject.php";
	$viewfile="viewsubject.php";
	$listfile="listsubject.php";
	$sql="select * from cpo_subjectmaster";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
	
}
elseif($result=="tutor") 
{
	$Title="Tutor";
	$addfile="addtutor.php";
	$viewfile="viewtutor.php";
	$listfile="listtutor.php";
	$sql="select * from cpo_usermaster where iUserType=1";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="learner") 
{
	$Title="Learner";
	$addfile="addlearner.php";
	$viewfile="viewuser.php";
	$listfile="listuser.php";
	$sql="select * from cpo_usermaster where iUserType=2";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="thirdparty") 
{
	$Title="Third Party Student";
	$addfile="addtstudent.php";
	$viewfile="viewtstudent.php";
	$listfile="listtstudent.php";
	$sql="select * from cpo_usermaster where iUserType=4";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="school") 
{
	$Title="School";
	$addfile="addschool.php";
	$viewfile="viewschool.php";
	$listfile="listschool.php";
	$sql="select * from cpo_school";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="lesson") 
{
	$Title="Lesson";
	$addfile="addlesson.php";
	$viewfile="viewlesson.php";
	$listfile="listlesson.php";
	$sql="select * from cpo_lessons";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="homework") 
{
	$Title="Homework";
	$addfile="addhomework.php";
	$viewfile="viewhomework.php";
	$listfile="listhomework.php";
	$sql="select * from cpo_homework";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="personal") 
{
	$Title="Personal Development";
	$monthly="mon_main.php?rid=report";
	$detention="de_main.php?rid=det";
	$exclusion = "ex_main.php?rid=exc";
	$count=0;
	$result = "personal";
}
elseif($result=="tsl") 
{
	$Title="Assign Subject To Tutor And Learner";
	$addfile="addtsl.php";
	$viewfile="viewtsl.php";
	$listfile="listtsl.php";
	$sql="select * from cpo_user_subject";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="news") 
{
	$Title="News";
	$addfile="addnews.php";
	$viewfile="viewnews.php";
	$listfile="listnews.php";
	$sql="select * from cpo_newsmaster";
	$result1=runquery1($sql);
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="testimonails") 
{
	$Title="Success Story";
	$addfile="addtestinomails.php";
	$viewfile="viewtestimonails.php";
	$listfile="listtestimonails.php";
	$sql="select * from cpo_testinomailsmaster";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="subjectincourse") 
{
	$Title="Subject - Course";
	$addfile="addsubjectintegrate.php";
	$viewfile="viewsubjectintegrate.php";
	$listfile="listsubjectintegrate.php";
	$sql="select * from cpo_subjectincourse";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="tutorincourse") 
{
	$Title="Tutor - Course";
	$addfile="addtutorintegrate.php";
	$viewfile="viewtutorintegrate.php";
	$listfile="listtutorintegrate.php";
	$sql="select * from cpo_tutorforcourses";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="userfortutor") 
{
	$Title="Learner -  Tutor";
	$addfile="adduserintegrate.php";
	$viewfile="viewuserfortutor.php";
	$listfile="listuserfortutor.php";
	$sql="select * from cpo_usercourse where iCourseStatus=1 and vTutorId!=''";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="tpl") 
{
	$Title="Third Party - Learner";
	$addfile="addtpl.php";
	$viewfile="viewtpl.php";
	$listfile="listtpl.php";
	$sql="select * from cpo_thirdpartylearner";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="studentinfo") 
{
	$Title="Learner Information - Tutor";
	$viewfile="viewstudentinformation.php";
	$listfile="liststudinfo.php";	
	$sql="select * from cpo_studentinfo";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
	$result = "approve";
}
elseif($result=="logstudent") 
{
	$Title="Learner Log Book";
	$viewfile="viewstudentlog.php";
	$listfile="liststudentlog.php";	
	$sql="select * from cpo_studentlogbook";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
	$result = "approve";
}
elseif($result=="chat") 
{
	$Title="Chat Time Booking";
	$viewfile="viewchat.php";
	$listfile="listchat.php";	
	$sql="select * from cpo_bookchattime";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
	$result = "main";
}
elseif($result=="upfiles") 
{
	$Title="Upload Files";
	$viewfile="viewuploadfile.php";
	$listfile="listuploadfile.php";	
	$sql="select um.vUserName from cpo_uploadfiles uf,cpo_usermaster um where um.iUserId=uf.iUserId";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
	$result = "main";
}
elseif($result=="plan") 
{
	$Title="Learner Plan Information";
	$viewfile="viewplan.php";
	$listfile="listplan.php";	
	$sql="select * from cpo_ind_plan";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
	$result = "main";
}
elseif($result=="review") 
{
	$Title="Learner Review Information";
	$viewfile="viewreview.php";
	$listfile="listreview.php";	
	$sql="select * from cpo_ind_review";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
	$result = "main";
}
elseif($result=="institute") 
{
	$Title="Institute";
	$addfile="addinstitute.php";
	$viewfile="viewinstitute.php";
	$listfile="listinstitute.php";
	$sql="select * from cpo_institutemaster";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;	
}
elseif($result=="category") 
{
	$Title="Category";
	$addfile="addcategory.php";
	$viewfile="viewcategory.php";
	$listfile="listcategory.php";
	$sql="select * from cpo_categorymaster";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="job") 
{
	$Title="Job";
	$addfile="addjob.php";
	$viewfile="viewjob.php";
	$listfile="listjob.php";
	$sql="select * from cpo_jobmaster";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
}
elseif($result=="logtutor") 
{
	$Title="Tutor Log Book";
	$viewfile="viewtutorlog.php";
	$listfile="listtutorlog.php";	
	$sql="select * from cpo_tutorlogbook";
	$result1=runquery1($sql) or die('eror'.mysqli_error());
	$count=mysqli_num_rows($result1);
	if($count==0)
		$count=0;
	$result = "approve";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$Title?> Admin</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left"><?=$Title?> Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <?php if($result=="approve")
	{
	?>
    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Overview</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $viewfile?>">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $listfile?>">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"></td>
    <td width="25%" align="center"></td>
    <td width="0%" align="left"></td>
    <?php }
	elseif($result=="mainadminup")
	{
	?>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Overview</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
    <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $addfile?>">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $viewfile?>">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"></td>
    <td width="25%" align="center"></td>
    <td width="0%" align="left"></td>
	<?php
	}
	elseif($result=="main")
	{		
	?>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Overview</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
    <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $viewfile?>">Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $listfile?>">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"></td>
    <td width="25%" align="center"></td>
    <td width="0%" align="left"></td>
	<?php
	}
		elseif($result=="personal")
	{
		?>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Overview</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
    <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $monthly?>">Monthly</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $detention?>">Detention</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid greendeactfont"><a href="<?php echo $exclusion?>">Exclusion</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
<?php
	}
	else
	{
		?>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Overview</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
    <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="<?php echo $addfile?>" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="<?php echo $viewfile?>" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="<?php echo $listfile?>" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	<?php
	}
	?>	
  </tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
          <td class="suntable">
		   <table width="95%" border="0" align="left" cellpadding="1" cellspacing="1" style="margin-left:10px;">
              <tr> 
                <td height="22" class="bodytext"><strong><font color="#666666">What 
                  is <font color="#0A6CCE"><?php echo $Title ?></font>
                  admin ?</font></strong></td>
              </tr>
              <tr> 
                <td height="50" valign="top" class="bodytext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="3%"><div align="center"><img src="./images/arrow.gif"></div></td>
                      <td width="97%" height="20" class="bodytext"><strong><?php echo $Title ?></strong> admin is a module from where you will be able to </td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td height="20" class="bodytext"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
					  	<?php if($result!="approve" && $result!="main")
							{
							?>
                          <tr> 
                            <td width="3%"> <div align="center"><img src="./images/arrow.gif" width="5" height="5"></div></td>
                            <td width="97%" height="18" class="bodytext">Add</td>
                          </tr>
						  	<?php
							}
							?>
                          <tr> 
                            <td><div align="center"><img src="./images/arrow.gif" width="5" height="5"></div></td>
                            <td height="18" class="bodytext"> <?php if($result!="main") echo "Edit /"; ?> Delete</td>
                          </tr>
                          <tr> 
                            <td><div align="center"><img src="./images/arrow.gif" width="5" height="5"></div></td>
                            <td height="18" class="bodytext">And View list of </td>
                          </tr>
                          <tr> 
                            <td height="18" colspan="2" class="bodytext">All the 
                              <strong><?php echo $Title ?></strong></td>
                          </tr>
                          <tr> 
                            <td height="18" colspan="2" class="bodytext"></td>
                          </tr>
                        </table></td>
                    </tr>
						<?php if($result!="approve" && $result!="main")
							{
							?>
                    <tr> 
                      <td><div align="center"><img src="./images/arrow.gif"></div></td>
                      <td height="20" class="bodytext"><font color="#0A6CCE"><strong>Add <?php echo $Title ?></strong></font></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td height="20" class="bodytext">Please use this interface to add new <strong><?php echo $Title ?></strong>.</td>
                    </tr>
					<?php
							}
							?>
                    <tr> 
                      <td><div align="center"><img src="./images/arrow.gif"></div></td>
                      <td height="20" class="bodytext"><font color="#0A6CCE"><strong><?php if($result!="main") echo "Edit /"; ?>  Delete <?php echo $Title ?></strong></font></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td height="20" class="bodytext">Please use this interface to <?php if($result!="main") echo "Edit or "; ?> Delete <strong><?php echo $Title ?></strong> from system.</td>
                    </tr>
                    <tr> 
                      <td><div align="center"><img src="./images/arrow.gif"></div></td>
                      <td height="20" class="bodytext"><font color="#0A6CCE"><strong>List <?php echo $Title ?></strong></font></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td height="20" class="bodytext">Please use this module to see the list of existing <strong><?php echo $Title ?></strong>.</td>
                    </tr>
                  </table></td>
              </tr>
              <?php if($result !="personal"){?>
			  <tr> 
                <td height="50" class="bodytext"><div align="left">&nbsp;<strong><font color="#666666">Total 
                    No. of Records:</font> <font color="#0A6CCE"><?php echo $count ?></font></strong></div></td>
              </tr>
			 	<?php }?>
              <tr>
                <td class="bodytext">&nbsp;</td>
              </tr>
            </table>
		  </td>
        </tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td></tr>
</table>
</td>
  </tr>
</table>
	</td>
  </tr>
</table>


</body>
</html>
