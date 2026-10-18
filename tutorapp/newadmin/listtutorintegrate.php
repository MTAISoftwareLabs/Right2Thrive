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

$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<html>
<head>
<title>List Tutor - Course</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript">
function getselected(val,obj)
{
	if(val != "")
	{
		for(i=obj.length-1;i>=0;i--)
		{
			if(obj.options[i].value==val)
			{
				obj.options[i].selected=true;
			}
		}
	}
	else
	{
		obj.options[0].selected=true;
	}
}
function getsearch()
{
		
	ct=document.listtutorintegrate.cmbcategory.value;	
	document.listtutorintegrate.action ='listtutorintegrate.php?ct='+ct;
	document.listtutorintegrate.submit();
}
function goto($cur)
{
	//getselectedval();
		
	ct=document.listtutorintegrate.cmbcategory.value;	
	document.listtutorintegrate.action = 'listtutorintegrate.php?ct='+ct+'&curpage='+$cur;
	document.listtutorintegrate.submit();
}
</script>

</head>
<?php

	if($getct=='')						  
	{
		$sqlspn = "select * from cpo_tutorforcourses";
		
	}	
	else
	{
	
	$sqlspn = "select * from cpo_tutorforcourses where iUserID='".$getct."'";
	//echo $sqlspn;
	//die();
	}
		//echo $sqlspn;
	//die();
	$result = runquery1($sqlspn) or die('could not execute'.mysqli_error());
	if($result)
	{	
		$count = mysqli_num_rows($result);
		$page=Ceil($count/page_size);
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by iUserID  Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by iUserID  Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by iUserID Limit 0,".page_size;
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
    <td align="left" class="schoolfont">Tutor - Course Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tutorincourse" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addtutorintegrate.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtutorintegrate.php" class="greendeactfont">Edit / Delete</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">List of Tutor - Course </td>
																								
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
                              <td width="25%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Tutor 
                                    Name<br>
                                  </strong> </div></td>
							<td width="36%" height="32" align="left" class="lighttd2"><div align="Left"><strong> 
                                    Course Name<br>
                                  </strong> </div></td>
                              <td width="32%" height="32" align="left" class="lighttd2"><div align="Left"><strong> 
                                    Subjects<br>
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
								
?>
                            <tr class="whittd"> 
                              <td align="center" class="bodytext" height="28"><?php echo $counter; ?> 
                              </td>
                              <td align="left" class="bodytext"><?php
							  		$sql1="select vUserName from cpo_usermaster where iUserId = '".$rslist["iUserID"]."'";
									
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
									if ($num > 0)
									{
									$name=mysqli_result($result1,0,0);
							  							
									
									 echo $name;
									 } ?></td>
                              <td align="left" class="bodytext">
							  	<?php
								    //echo $rslist["iCourseID"];
							  		$sql1="select vCourseName from cpo_coursemaster where iCourseId = '".$rslist["iCourseID"]."'";
									
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
										if ($num > 0)
										{
									$name=mysqli_result($result1,0,0);
									
							  
									
									 echo $name; 
									 } ?></td>
									 <td align="left" class="bodytext">
									 <?php
									 	if($rslist["vSubjectIDs"]==-2)
										{
											echo "ALL SUBJECT";
										}
										else
										{
											            //echo $rslist["vSubjectIDs"];
									 					$id=explode(",", $rslist["vSubjectIDs"]);
														
														$str="";
														for($i=0;$i<count($id);$i++)
														{
															
                            								$sql2="select vSubjectName from cpo_subjectmaster where iSubjectId= '".$id[$i]."'";
							  								$result2=runquery1($sql2) or die('could not execute query'.mysqli_error());
															$num = $result2 ? mysqli_num_rows($result2) : 0;
															if ($num > 0)
															{
															$name=mysqli_result($result2,0,0);
									 						$str=$str."  ".$name."  "; 
															}
														}
															echo $str;
										}
														?>
														</td>
                            </tr>
                            <?php
		$counter++;
		}
	}
	else
	{			
?>
                            <tr class="whittd"> 
                              <td align="center" height="35" colspan="5"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd">
                              <td align="center" class="error" height="28" colspan="5">No Tutor - Course Information Found</td>
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
												<a href="./listtutorintegrate.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
