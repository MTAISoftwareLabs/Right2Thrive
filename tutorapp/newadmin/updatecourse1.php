<?php
@ob_start();
include_once 'dbConnection.php';
?>

<html>
<head>
<title>Edit Course</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<form name=frmupdatecourse action=modifycourse.php>
<?php
	   	$Course_name=ereg_replace("'","''",$_GET['txtCourseName']);
        $Course_desc=ereg_replace("'","''",$_GET['txtCourseDesc']);
		$institute_id=$_GET['txtInstituteId'];
		$status=$_GET['txtStatus'];
		
		$sql="update course_master set Course_name='". $Course_name ."',Course_desc='".$Course_desc."', Institute_id='".$institute_id."',Status='".$status."' where Course_id=".$_GET['id'];
       // echo $sql;
		//die();
		$rscheck=mysqli_query($sql,$_SESSION['conn']);
?>
<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
   	<tr> 
   		<td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
   		<td width="100%" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
   	</tr>
	<tr> 
   		<td width="100%" height="36" colspan="2" class="comment" align="center">Course Information is Updated successfully..</td>
	</tr>
	<tr> 
   		<td width="100%" class="headingtd" colspan="2">&nbsp;</td>
	</tr>
</table> 
</BODY>
</HTML>
