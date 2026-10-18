<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//include_once '../src/function.php';
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
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d-m-Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}
?>

<html>
<head>
<title>List Learner Log Book </title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript">
function openwin(obj)
{
	new1=window.open("Detail_LogBook.php?id="+obj,"",'height=500,width=600,scrollbars=yes,top=50 left=150');
}
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
		
	ct=document.liststudentlog.cmbcategory.value;	
	document.liststudentlog.action ='liststudentlog.php?ct='+ct;
	document.liststudentlog.submit();
}
function goto($cur)
{
	//getselectedval();
		
	ct=document.liststudentlog.cmbcategory.value;	
	document.liststudentlog.action = 'liststudentlog.php?ct='+ct+'&curpage='+$cur;
	document.liststudentlog.submit();
}
</script>
</head>
<?php

	if($getct=='')						  
	{
		$sqlspn="select iStudentId,iTutorId,dEntryDate,iSubjectId,iLogId from cpo_studentlogbook";
		
	}	
	else
	{
	
		$sqlspn = "select iStudentId,iTutorId,dEntryDate,iSubjectId,iLogId from cpo_studentlogbook where iStudentId='".$getct."'";
	
	}
		
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
				 $sqlspn.=" order by iStudentId  Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by iStudentId  Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by iStudentId Limit 0,".page_size;
		   $curpage=0;
		}
		$result = runquery1($sqlspn) or die('could not'.mysqli_error());
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
    <td align="left" class="schoolfont">Learner Log Book Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=logstudent" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewstudentlog.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">List</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
<td width="0%" align="right"></td>
    <td width="25%" align="center" ></td>
    <td width="0%" align="left"></td>
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
								<td colspan="2" >&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a></td>
								<td width="13%" bgcolor="#FFFFFF"><a href="javascript:print()">Print this page</a></td>
							</tr>
							<tr> 
            <td class="bodytext" align="center">&nbsp;Select Learner&nbsp;<select name="cmbcategory" class="bodytext">
												<option value="" selected>ALL</option>
												<?php
						   							$fetch1="select * from cpo_usermaster where iUserType=2 and iUserStatus=1";
													$result1=runquery1($fetch1);
													$count=mysqli_num_rows($result1);
							
												while($row=mysqli_fetch_array($result1))
												{
																									
												?>
						
														<option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
                      							<?php
												}
												?>
											  </select>&nbsp;
											  <?php if ($getct<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getct;?>',document.liststudentlog.cmbcategory);</script>
												<?php
												}?> 
              &nbsp;&nbsp; &nbsp;&nbsp; <img src="./images/search.gif"  style="cursor:hand" onClick="javascript:getsearch();" align="absmiddle"> 
            </td>
            <td>&nbsp;</td>			
          </tr>
							<tr> 
            <td bgcolor="#FFFFFF" height="10">&nbsp;</td>
          </tr>				  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;Learner Log Book</td>
																								
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
                              <td width="27%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Learner 
                                    Name <br>
                                  </strong> </div></td>
							<td width="16%" height="32" align="left" class="lighttd2"><div align="Left"><strong> 
                                    Log Date<br>
                                  </strong> </div></td>
							<td width="18%" height="32" align="left" class="lighttd2"><div align="Left"><strong> 
                                    Tutor Name<br>
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
		while($row = mysqli_fetch_array($result))
		{
					$tutorname="";
					$subjectname="";
		
						$fetchname="select * from cpo_usermaster where iUserId=".$row["iStudentId"];
						$resultfetchname=mysqli_query($fetchname);
						$studentname=mysqli_result($resultfetchname,0,1);
																			
						$fetchname="select * from cpo_usermaster where iUserId=".$row["iTutorId"];
						$resultfetchname=mysqli_query($fetchname);
						$num = $resultfetchname ? mysqli_num_rows($resultfetchname) : 0;
						if ($num > 0)
						{
						$tutorname=mysqli_result($resultfetchname,0,1);
						}
																			
						$fetchname="select * from cpo_subjectmaster where iSubjectId=".$row["iSubjectId"];
						$resultfetchname=mysqli_query($fetchname);
						$num = $resultfetchname ? mysqli_num_rows($resultfetchname) : 0;
						if ($num > 0)
						{
						$subjectname=mysqli_result($resultfetchname,0,1);
						}
						
																			
						$date=$row["dEntryDate"];
						$logid=$row["iLogId"];
																		
							
						$dispdate = gdate($date);
								
?>
                            <tr class="whittd"> 
                              <td align="center" class="bodytext" height="28"><a href="javascript:openwin(<?php echo $logid ?>)"><?php echo $counter;?></a></td>
                                <td align="left" class="bodytext"><a href="javascript:openwin(<?php echo $logid ?>)"><?php echo $studentname;?></a></td>
								<td align="left" class="bodytext"><a href="javascript:openwin(<?php echo $logid ?>)"><?php echo $dispdate;?></a></td>
								<td align="left" class="bodytext"><a href="javascript:openwin(<?php echo $logid ?>)"><?php echo $tutorname;?></a></td>
								<td align="left" class="bodytext"><a href="javascript:openwin(<?php echo $logid ?>)"><?php echo $subjectname;?></a></td>
                            </tr>
                            <?php
		$counter++;
		}
	}
	else
	{			
?>
                            <tr class="whittd"> 
                              <td align="center" colspan="5"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd">
                              <td align="center" class="error" height="28" colspan="5">No Learner Log Information Found.</td>
                              <?php
}
?>
                            </tr>
                          </table></td></tr>
				
											<tr>
											<td height="22" valign="top"> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td width="148" ></td>
														<td width="720" >&nbsp;</td>
														<td width="1" ><div align="right"></div></td>
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
												<a href="javascript:goto(<?php echo $i-1;?>)"><b><?php echo $i;?></b></a> 
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
										<tr> 
											<td bgcolor="#FFFFFF">&nbsp;</td>
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
