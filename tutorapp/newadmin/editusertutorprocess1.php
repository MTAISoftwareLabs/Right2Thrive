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
} ?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<?php
				$Learnerid = isset($_GET['lid'])?$_GET['lid']:'';
				$Courseid = isset($_GET['cid'])?$_GET['cid']:'';
				$selectdata="select vSubjectID,iCourseID from cpo_subjectincourse where iCourseSubjectid=".$Courseid;
			 	$result=runquery1($selectdata) or die('could'.mysqli_error());
				$str="";
				$flg="";
			 
			  		$id=mysqli_result($result,0,0);
					$id1=explode(",",$id);
					$c=count($id1);
					if($c==1)
					{
							$sql="delete from cpo_subjectincourse where iCourseSubjectid=".$Courseid;
							runquery1($sql) or die('error'.mysqli_error().$sql);
							$msg="Subject Removed Successfully";
					}
					else
					{
							$id=explode(",",$id);
							$c=count($id)-1;										
									for($i=0;$i<count($id);$i++)
										{
												if($id[$i]==$Subjectid)
												{
														
												}
												elseif($c!=$i)
												{
													$str=$str.$id[$i].",";
												}
												else
													$str=$str.$id[$i];
										}
											 $x=strlen($str);
											  $last=substr($str, $x-1, $x); 
											  if($last==',')
											  		$str=substr($str, 0,$x-1); 	
											 
										
																				
															
											$sql="update cpo_subjectincourse set vSubjectID='".$str."'  where iCourseSubjectid=".$Courseid;
											runquery1($sql) or die('error'.mysqli_error().$sql);
											$msg="Subject Removed Successfully";
					}
?>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect">
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b>Edit Subject Integrate Admin</b></h3></td>
	</tr>
	<tr> 
		<td> 
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
        		<td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=tutorincourse">Overview</a></div></td>
        		<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></div></td>
		        <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="addtutorintegrate.php">Add</a></div></td>
        		<td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
		        <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Edit / Delete</font></div></td>
        		<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
		        <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listtutorintegrate.php">List </a></div></td>
        		<td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
		        <td width="34%" background="images/middle_last.jpg"><div align="right"></div></td>
				</tr>
			</table>
		</td>
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
					<td bgcolor="#FFFFFF">
						<table width="65%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
							<tr> 
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr> 
											<td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
											
                      <td width="497" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Edit 
                        Subject Integrate</strong></font></td>
											<td width="500" class="headingtd"><div align="right"><img height=20 src="./images/img_header_gradient.jpg" width=147></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr> 
								<?php
									if($flg == "red")
									{
								?>
								<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
							</tr>
							<tr>
								<td colspan="2" align="center" height="35" class="error"><?php echo $msg; ?></td>
								<?php
								}
								else
								{
								?>
								<td colspan="2" align="center" height="35" class="comment"><?php echo $msg; }?></td>								
							</tr>
							<tr> 
								<td colspan="2" height="30" align="right">
									<a href="viewsubjectintegrate.php"><img src="./images/go_back.gif" alt="Edit Course" border="0"></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr> 
					<td bgcolor="#FFFFFF">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
