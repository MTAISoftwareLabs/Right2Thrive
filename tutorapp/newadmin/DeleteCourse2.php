<?php
@ob_start();
include_once 'dbConnection.php';
require "../include/globals.php";
?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<script language="JavaScript">
function getconfirm(id)
{	
	
		cn = confirm('Are you sure you want to delete the Course?');
		if(cn)
		{
			document.frmAreasDelete.action = 'DeleteCourse3.php?aid='+id;
			document.frmAreasDelete.submit();
		}
	
}
function chkDelete(pg)
{
	
//		document.frmReelJobsDelete.operation.value="Delete";
		cn = confirm('Are you sure you want to delete this Course?');
		if(cn)
		{
			document.frmAreasDelete.action = 'DeleteCourse3.php?aid=0&curpage='+pg;
			document.frmAreasDelete.submit();
		}
	
}
function val(obj)
{

	if(obj.checked==true)
	{
		str="a"+obj.name;
		document.getElementById(str).style.backgroundColor="#F7F5FE";
	}
	else
	{
		str="a"+obj.name;
		document.getElementById(str).style.backgroundColor="#FFFFFF";
	}
}
function chkall()
{

	var len=document.all.length;
		var chkname;
		for(i=0;i<len;i++)
		{
			if(document.all(i).type=="checkbox")
			{
				chkname=document.all(i).name;
					if(document.getElementById("visibility").checked)
					{
						if(document.all(i).name=="visibility")
						{
							document.all(i).checked=true;
						}
						else
						{
							document.all(i).checked=true;
							str="a"+document.all(i).name;
							document.getElementById(str).style.backgroundColor="#F7F5FE";
						}
						
					}
					else
					{
						if(document.all(i).name=="visibility")
						{
							document.all(i).checked=false;
						}
						else
						{
							document.all(i).checked=false;
							str="a"+document.all(i).name;
							document.getElementById(str).style.backgroundColor="#FFFFFF";
						}
						
					}
				}
	}
}
</script>

<?php
	
 	$sqlspn="SELECT * FROM course_master";
 	$result=mysqli_query( $sqlspn,$_SESSION['conn']);
 	if($result)
	{
		$count = mysqli_num_rows($result);
		$page=Ceil($count/page_size);
	}
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by Course_name Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by Course_name  Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by Course_name Limit 0,".page_size;
		   $curpage=0;
		}
		$result = mysqli_query($sqlspn);
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect">
<form name="frmAreasDelete" method="post">
<table width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td>
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
					<td><h3><b>Admin - Course</b></h3></td>
				</tr>
				<tr> 
					<td> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
							<td width="1%" height="23" background="./images/middle.jpg"><img src="./images/start1.jpg" width="6" height="23"></td>
            					<td width="17%" background="./images/middle.jpg"><div align="center"><a class="tablink" href="./addcourse.php">Add</a></div></td>
            					<td width="1%" background="./images/middle.jpg"><IMG height=23 src="./images/bg_bodytab_crnr2.jpg" width=11></td>																
            					<td width="17%" background="./images/middle.jpg"><div align="center"><a class="tablink" href="./modifycourse.php">Edit</a></div></td>
            					<td width="1%" valign="top" background="./images/middle.jpg"><div align="center"><img src="./images/active_middle.jpg" width="11" height="23"></div></td>
            					<td width="17%" background="./images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Delete</font></div></td>
            					<td width="1%" background="./images/middle.jpg"><img src="./images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            					<td width="17%" background="./images/middle.jpg"><div align="center"><a class="tablink" href="./viewcourse.php">View</a></div></td>
            					<td width="1%"><div align="right"><IMG height=23 src="./images/bg_bodytab_crnr3.jpg" width=11></div></td>
            					<td width="28%" background="./images/middle_last.jpg"><div align="right"></div></td>
           
					
				</tr>
						</table> 
					</td>
				</tr>
				<tr> 
					<td> 
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
							<tr> 
								<td colspan="2" bgcolor="F5F8FF">&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="../images/print.jpg" width="16" height="16" border="0"></a></td>
								<td width="13%" bgcolor="#FFFFFF"><a href="javascript:print()">Print this page</a></td>
							</tr>
							<tr> 
								<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="2">
									<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr> 
											<td width="100%">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
														<td width="237" class="headingtd">&nbsp;List of Course</td>
														<td width="427" class="headingtd" align="right">&nbsp;</td>
														<td width="342" class="headingtd"><div align="right"><img height=20 src="./images/img_header_gradient.jpg" width=147></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td height="22"> <div align="right">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr class="table"> 
                      									<td width="16%" height="32" align="center" class="lighttd"> 
                        									<div align="center"><strong> All 
                          									<input type="checkbox" name="visibility" value="visibility"  onClick="chkall(this)">
                          									&nbsp;&nbsp;&nbsp;&nbsp;<br></strong> </div>
														</td>
														<td width="57%" height="32" align="left" class="lighttd"><div align="Left"><strong>Course Name<br></strong> </div></td>
														<td width="20%" height="32" align="left" class="lighttd"><div align="center"><strong>Delete<br></strong></div></td>
													</tr>
<?php	
	$num = mysqli_num_rows($result);
	if($num > 0)
	{
		while($rslist = mysqli_fetch_array($result))
		{
?>
													<tr class="whittd" id="a<?php echo $rslist["Course_id"];?>">
														<td align="center" class="bodytext" height="28"><input type="checkbox" name="<?php echo $rslist["Course_id"]; ?>" onClick="val(this)"></td>
														<td align="left" class="bodytext"><?php echo $rslist["Course_name"]; ?></td>
														<td align="center" class=""><a href="javascript:getconfirm(<?php echo $rslist["Course_id"] ?>);"><img src="./images/delete.gif" border="0" alt="Delete Course"></a></td>
													</tr>
<?php
		}
?>
													<tr class="whittd"> 
                      									<td width="16%" height="28" > <div align="center"> 
                          									<img style="cursor:hand" src="./images/delete1.gif" alt="Delete Area" onClick="javascript: return chkDelete(<?php echo $curpage;?>);"></div></td>
                      									<td width="37%" height="28" colspan="2"></td>
                    								</tr>

<?php		
	}
	else
	{			
?>

													<tr class="whittd">
														<td align="center" height="35" colspan="3"><img src="./images/alert.gif" border="0"></td>
													</tr>
													<tr class="whittd">
														<td align="center" class="error" height="28" colspan="3">No Record Exist in Database...!</td>
<?php
}
?>													
													</tr>
												</table>
												</div>
											</td>
										</tr>  
										<tr>
											<td height="22" valign="top"> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient.jpg" width=147></td>
														<td width="772" class="headingtd">&nbsp;</td>
														<td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td height="22" valign="top" align="right" class="bodytext">
											<?php	if($page>1){ 
												echo "Page : ";
											 for($i=1;$i<=$page;$i++)
											 {
												if($i==($curpage+1))
												{
											 ?>
												<b><?php echo $i?></b>
											 <?php
												}
												else
												{
													$str="";
											?>
												<a href="./DeleteCourse2.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
										<tr> 
											<td bgcolor="#FFFFFF">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>	
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</body>
</html>
