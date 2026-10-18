<?php
@ob_start();
include_once 'dbConnection.php';
?>

<html>
<head>
<title>Add News</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<form name=frmadd action=addcourse.php>
<?php
		$Course_name=ereg_replace("'","''",$_GET['txtCourseName']);
        $Course_desc=ereg_replace("'","''",$_GET['txtCourseDesc']);
		$institute_id=$_GET['txtInstituteId'];
		$status=$_GET['txtstatus'];

	
        $sql="select max(course_id) from course_master";
        $rscheck=mysqli_query($sql,$_SESSION['conn']);
		$num=1;
        if(! empty($rscheck))
		{
		    $rs=mysqli_fetch_row($rscheck);
		    if($rs)
		    {
		        $num=$rs[0]+1;
            }
          
            $addsql="insert into course_master values (".$num.",'".$Course_name."','".$Course_desc."','".$institute_id."','".$status."')";
			//echo $addsql;
			//die();
            //echo $addsql;
            $record=mysqli_query($addsql,$_SESSION['conn']) or die("could not execute query".mysqli_error());
			?>
	<br>		
<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
   	<tr> 
   		<td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
   		<td width="100%" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
   	</tr>
	<tr> 
   		<td width="100%" height="36" colspan="2" class="comment" align="center">Course is added successfully</td>
	</tr>
	<tr> 
   		<td width="100%" class="headingtd" colspan="2">&nbsp;</td>
	</tr>
</table> 
		 
			<?php		

		}
?>
</BODY>
</HTML>
