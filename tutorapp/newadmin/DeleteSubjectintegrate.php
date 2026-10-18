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
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
if(isset($_GET['cid']))
{

					$flg="green";
					$msg="";
					$msg1="";

						$sql="select count(*) from cpo_tutorforcourses where iCourseID='".$_GET['id']."'";
						$rIDPass=runquery1($sql);
						$rIDans=mysqli_fetch_row($rIDPass);
						if($rIDans[0]>0)
						{
									$sql="select vCourseName from cpo_coursemaster where iCourseId='".$_GET['id']."'";
									$result=runquery1($sql);
									$cname=mysqli_result($result,0,0);
									$flg="red";
									$msg=$msg.$cname.",";
					
						}
						else
						{
									$sql="select count(*) from cpo_usercourse where iCourseId='".$_GET['id']."' and iCourseStatus=1";
									$rIDPass=runquery1($sql);
									$rIDans=mysqli_fetch_row($rIDPass);
									if($rIDans[0]>0)
									{
												$sql="select vCourseName from cpo_coursemaster where iCourseId='".$_GET['id']."' and iCourseStatus=1";
												$result=runquery1($sql);
												$cname=mysqli_result($result,0,0);
												$flg="red";
												$msg=$msg.$cname.",";
								
									}
									else
									{
						
											$sql="delete from cpo_subjectincourse where iCourseSubjectid=".$_GET['cid'];
											$rscheck=runquery1($sql);
											$msg1="Course deleted successfully.";
									}
						}
}
elseif($_POST['txtcnt']>1)
{
	$flg="green";
				$msg="";
				$msg1="";
				
	
	for($count=1;$count<=$_POST['txtcnt'];$count++)
	{
		//echo $_POST['cbo'.$count];
	   if(isset($_POST['cbo'.$count]))
	   {
	   
	   
	   					$sql="select count(*) from cpo_tutorforcourses where iCourseID=".$_POST['hb1'.$count];
						$rIDPass=runquery1($sql);
						$rIDans=mysqli_fetch_row($rIDPass);
						if($rIDans[0]>0)
						{
									$sql="select vCourseName from cpo_coursemaster where iCourseId=".$_POST['hb1'.$count];
									$result=runquery1($sql);
									$cname=mysqli_result($result,0,0);
									$flg="red";
									$msg=$msg.$cname.",";
					
						}
						else
						{
									$sql="select count(*) from cpo_usercourse where iCourseId='".$_POST['hb1'.$count]."' and iCourseStatus=1";
									$rIDPass=runquery1($sql);
									$rIDans=mysqli_fetch_row($rIDPass);
									if($rIDans[0]>0)
									{
												$sql="select vCourseName from cpo_coursemaster where iCourseId=".$_POST['hb1'.$count];
												$result=runquery1($sql);
												$cname=mysqli_result($result,0,0);
												$flg="red";
												$msg=$msg.$cname.",";
								
									}
									else
									{
						
										   $sql="delete from cpo_subjectincourse where iCourseSubjectid=".$_POST['hb'.$count];
										   //echo $sql; 
										   $rscheck=runquery1($sql);
										   $msg1="Course deleted successfully.";
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
<BODY  topmargin="0" leftmargin="0" class="seffact">
  <?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Subject Admin</td>
          </tr>
          <tr>
            <td class="graydotline">&nbsp;</td>
          </tr>
          <tr>
            <td height="30px;"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a  href="overview.php?id=subjectincourse" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
            		  <td width="25%" align="center" class="graymid"><a href="addsubjectintegrate.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listsubjectintegrate.php" class="greendeactfont">List</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                  <tr>
                                    <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                        <tr>

                                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              
											  <tr>
                                                <td class="toheaderbg" colspan="3">Subject Information</td>
                                              </tr>
												  <tr> 
                  <td height="35" colspan="2" class="fontblue" align="center"><?php if($flg=="red")
				  																{
																				echo $msg."Course cannot deleted,they are integrated to learners and tutors first remove from there.";
																				}
																				else
																				{
																				echo $msg1;
																				}?></td>
                </tr>
												<tr> 
												  <td colspan="2" ><div align="right">&nbsp; 
													  <a href="viewsubjectintegrate.php"><img src="images/edit1.gif"  border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=subjectincourse"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
                    </div></td>
												</tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        
                                    
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="0%"><img src="images/green_left_corn.gif" /></td>
                        <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                        <td width="0%"><img src="images/green_right_corn.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
    </td>
  </tr>
</table>
  

</BODY>
</HTML>
