<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		document.location ="index.htm";
	</script> 
<?php
} 
if(isset($_GET['id']))
{

				$sql="select count(*) from cpo_subjectincourse where iCourseID='".$_GET['id']."'";
				$rIDPass=runquery1($sql);
				$rIDans=mysqli_fetch_row($rIDPass);
				if($rIDans[0]>0)
				{
				
					$flg="red";
					$msg="Course Already Integrated to Subjects First Remove From There";
					
				}
				else
				{
				
						$sql="select count(*) from cpo_tutorforcourse where iCourseID='".$_GET['id']."'";
						$rIDPass=runquery1($sql);
						$rIDans=mysqli_fetch_row($rIDPass);
						if($rIDans[0]>0)
						{
							$flg="red";
							$msg="Course Already Integrated to Tutor First Remove Tutor From That Course";
					
						}
						else
						{
				
        					$sql="delete from cpo_coursemaster where iCourseId=".$_GET['id'];
							$rscheck=runquery1($sql);
							$msg1="Course Deleted Successfully";
						}
				}
			
		
}  
elseif($_POST['txtcnt']>1)
        {
            for($count=1;$count<=$_POST['txtcnt'];$count++)
            {
               if(isset($_POST['cbo'.$count]))
               {
			   
			   				$sql="select count(*) from cpo_subjectincourse where iCourseID='".$_POST['hb'.$count]."'";
							$rIDPass=runquery1($sql);
							$rIDans=mysqli_fetch_row($rIDPass);
							if($rIDans[0]>0)
								{
								
									$sql="select vCourseName from cpo_coursemaster where iCourseId='".$_POST['hb'.$count]."'";
									$result=runquery1($sql);
									$cname=mysqli_result($result,0,0);
									$flg="red";
									$msg=$msg.$cname.",";
																	
									
								}
								else
								{
								
										$sql="select count(*) from cpo_tutorforcourse where iCourseID='".$_POST['hb'.$count]."'";
										$rIDPass=runquery1($sql);
										$rIDans=mysqli_fetch_row($rIDPass);
										if($rIDans[0]>0)
										{
										
											$sql="select vCourseName from cpo_coursemaster where iCourseId='".$_POST['hb'.$count]."'";
											$result=runquery1($sql);
											$cname=mysqli_result($result,0,0);
											$flg="red";
											$msg=$msg.$cname.",";
																												
										}
										else
										{
								
                   							$sql="delete from cpo_coursemaster where iCourseId=" .$_POST['hb'.$count];
											$rscheck=runquery1($sql);
                  
	          							 }
               
								}

       				 }
				}
			}
      
      
    		

?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Course</title>
</HEAD>
<BODY>

  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Course Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=course">Overview</a></div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></div></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><font color="#000099"><a class="tablink" href="addcourse.php">Add</a></font></div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listcourse.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="34%" background="images/middle_last.jpg"></td>
          </tr>
        </table></td>
	</tr>
	<tr> 
      <td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF">&nbsp;</td>
          </tr>
         
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
                <tr> 
                  <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                  <td width="652" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
                </tr>
                <tr> 
                  <td height="35" colspan="2" class="comment" align="center"><?php if($flg=="red")
				  																{
																				echo $msg."Cant Deleted,They are Integrated to Subjects And Tutors";
																				}
																				else
																				echo $msg1;?>
                    </td>
                </tr>
                <tr> 
                  <td colspan="2" ><div align="right">&nbsp; 
                      <a href="viewcourse.php"><img src="images/edit1.gif" width="73" height="22" border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=course"><img src="images/cancel.gif" width="73" height="22" border="0"></a></b></font>&nbsp;&nbsp; 
                    </div></td>
                </tr>
                <tr> 
                  <td class="headingtd" colspan="2">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
         
        </table>
		</td>
	</tr>
</table>

</BODY>
</HTML>
