<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
?>
<script language="JavaScript">
function openwin(obj)
{
	window.open("homework.php?id="+obj,"","height=300,width=600,scrollbars=1");
}
</script>

<html>
<head>
<title>List Homework</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<?php
$sqlspn = "Select * from cpo_homework group by V_title";
$result = runquery1($sqlspn) or die('could not execuate');
if($result)
{	
	$count = mysqli_num_rows($result);
	$page=Ceil($count/page_size);
	if(isset($_GET['curpage']))
	{
		$curpage = $_GET['curpage'];
		if($curpage==0)
		{
			 $sqlspn.=" order by I_homeworkid Limit 0,".page_size;
		}
		else
		{
			$current=page_size*($curpage);
			$sqlspn.=" order by I_homeworkid  Limit " .$current. ",".page_size;
		}
	}
	else
	{
	   $sqlspn.=" order by I_homeworkid Limit 0,".page_size;
	   $curpage=0;
	}
	$result = runquery1($sqlspn);
}
?>
<body leftmargin="0" topmargin="0" class="seffact">
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Homework Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=homework" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addhomework.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewhomework.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">List</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
								<tr><td height="15"></td></tr>
																
																			<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a>&nbsp;&nbsp;</td>
							</tr>
							<tr><td height="15"></td></tr>
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;List of Homework </td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr > 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr> 
                  <td align='right' class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class=""> 
                              <td width="7%" height="32" align="center" class="lighttd2"> 
                                <div align="center"><strong>Sr No.<br>
                              </strong> </div></td>
								  <td width="19%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Subject<br>
                              </strong> </div></td>
                              <td width="26%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Homework Title<br>
                              </strong> </div></td>
								  <td width="22%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Assigned To<br>
                                  </strong> </div>
						<td width="12%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Due Date<br>
                              </strong> </div></td>
							<td width="14%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Assign Date<br>
                              </strong> </div></td>
                            </tr>
                           <?php	
if($curpage!=0)
{
	$counter = ($curpage*page_size)+1;
}else
{
	$counter = 1;
}
$num = mysqli_num_rows($result);
if($num > 0)
{
	while($rslist = mysqli_fetch_array($result))
	{
	$d=explode("-",$rslist["D_due_date"]);
	$duedate=$d[2]."/".$d[1]."/".$d[0];
	
	$a=explode("-",$rslist["D_assign_date"]);
	$assigndate=$a[2]."/".$a[1]."/".$a[0];
?>
                            <tr class="whittd"> 
                              <td align="center" class="bodytext" height="28"><?php echo $counter; ?> 
                              </td>
                              <td align="left" class="bodytext"><a href="javascript:openwin(<?php echo $rslist["I_homeworkid"] ?>);">
							  <?php
						$sqls = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rslist["I_Subject"];
						$querys = runquery1($sqls);
						$rows = mysqli_fetch_array($querys);
						echo ($rows && isset($rows['vSubjectName'])) ? ucfirst($rows['vSubjectName']) : '—';
					 ?> </a></td>
							  <td align="left" class="bodytext"><a href="javascript:openwin(<?php echo $rslist["I_homeworkid"] ?>);"><?php echo ucfirst($rslist["V_title"]); ?></a></td>
							  <td align="left" class="bodytext"><?php $sqls = "select sub.vUserName,sub.iUserId,us.I_studentid from cpo_usermaster as sub, cpo_user_subject as us,cpo_homework as l where sub.iUserId=us.I_studentid and l.I_user_subjectid=".$rslist["I_user_subjectid"]." and l.I_user_subjectid=us.I_user_subid";
						$querys = runquery1($sqls);
						$rows = mysqli_fetch_array($querys);
						echo ($rows && isset($rows['vUserName'])) ? ucfirst($rows['vUserName']) . '...' : '—'; ?></td>
							  <td align="left" class="bodytext"><?php echo $duedate ?></td>
                              <td align="left" class="bodytext"><?php echo $assigndate ?></td>
                            </tr>
                            <?php
		$counter++;
		}
	}
	else
	{			
?>
                            <tr class="whittd"> 
                              <td align="center" height="35" colspan="6"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd"> 
                              <td align="center" class="error" height="28" colspan="6">No Homework Information Found</td>
                              <?php
}
?>

                            </tr>
                          </table></td></tr>
				
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
												<a href="./listhomework.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
						
							
    															
</table></td>
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
</td ></tr>
</table>
</td >
  </tr>
</table>
		</form>

	</td>
  </tr>
</table>
</body>
</html>
