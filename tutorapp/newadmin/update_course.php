<?php
@ob_start();
include_once 'dbConnection.php';

$courseid= $HTTP_GET_VARS['id'];
 $sql="SELECT * FROM course_master where course_id= ".$courseid." ";
 $rID1=mysqli_query( $sql,$_SESSION['conn']);
 if($rID1)
 {
 	$rs1 = mysqli_fetch_row($rID1);
	$course_name= $rs1[1];
    $course_description = $rs1[2];
	$institute_id= $rs1[3];
	$status=$rs1[4];
	
		   
}	
?>

<HTML>
<HEAD>
<link href="adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script language="javascript">
<script language="javascript">
function checked()
{
         if(document.UpdateCourse.txtCourseName.value=="")
         {
          alert("Please Enter Course Name");
          document.UpdateCourse .txtCourseName.focus();
          return false;
         }
         if(document.UpdateCourse.txtCourseDesc.value=="")
         {
          alert("Please Enter Course Description");
          document.UpdateCourse.txtCourseDesc.focus();
          return false;
         }
         return true;
}
</script>
</script>
</HEAD>
<BODY leftmargin="0" topmargin="0"><form name=UpdateCourse method=GET action="updatecourse1.php" onSubmit="return checked()">	
	<br><br>		
<table width="70%" border=0 align=center cellpadding="0" cellspacing="0" class="table" >
<tr> 
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
            <td width="417" class="headingtd">Edit Course Information</td>
            <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
          </tr>
        </table></td>
    </tr>
<tr>
<td colspan="2" height="2%">&nbsp;</td>
</tr>
  <tr> 
    <td align=right width="30%" class="bodytext"> New Course Name : 
    </td>
    <td align=left width="70%"> &nbsp;&nbsp;<input name=txtCourseName value="<?php echo $course_name; ?>"  maxlength =255  size=33 class="textbox">
      </b></font> </td>
  </tr>
  <tr>
<td colspan="2" height="2%">&nbsp;</td>
</tr>
  <tr> 
    <td align=right class="bodytext">New Course Description: </td>
    <td align=left>&nbsp;&nbsp;<textarea name=txtCourseDesc maxlength =255  rows="3" cols="45"class="textbox"><?php echo ereg_replace('<br />',  '' , $course_description);?></textarea>
      </td>
  </tr>
  <td colspan="2" height="2%">&nbsp;</td>
  <tr> 
    <td align=right class="bodytext">Institue Id : </td>
                  <td align=left>&nbsp;&nbsp;
                    <select name="txtInstituteId">
						<option value="0">C M University</option>
                      	<option value="1">University of london</option>
                    </select> </b></font></td>
  </tr>
  <td colspan="2" height="2%">&nbsp;</td>
  <tr> 
    <td align=right class="bodytext">Status : </td>
                  <td align=left>&nbsp;&nbsp;
                    <select name="txtStatus" size="1">
                      <option value="y" <?php if($status=='y') { ?> selected <?php }?>>Open</option>
                      <option value="n" <?php if($status=='n') { ?> selected <?php }?>>Close</option>
                    </select> </b></font></td>
  </tr>
  <input type="hidden" name="id" value="<?php echo $courseid;?>">
  <tr>
<td colspan="2" height="2%">&nbsp;</td>
</tr>
  <tr> 
      <td >&nbsp;</td>
    <td align=left>&nbsp;
        <input name="image" type="image" src="images/edit1.gif" width="73" height="22">
        </td>
  </tr>
</table>
		    
			
			</form>	
</BODY>
</HTML>

