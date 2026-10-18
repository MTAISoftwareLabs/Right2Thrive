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
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript">
function openwin(obj)
{
	new1=window.open("Detail_LogBookTutor.php?id="+obj,"",'height=500,width=600,scrollbars=yes,top=50 left=150');
	return true;
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
		
	ct=document.listtutorlog.cmbcategory.value;	
	document.listtutorlog.action ='listtutorlog.php?ct='+ct;
	document.listtutorlog.submit();
}
function goto($cur)
{
	//getselectedval();
		
	ct=document.listtutorlog.cmbcategory.value;	
	document.listtutorlog.action = 'listtutorlog.php?ct='+ct+'&curpage='+$cur;
	document.listtutorlog.submit();
}
</script>

</head>
<?php

	if($getct=='')						  
	{
		$sqlspn="select iStudentId,iTutorId,dEntryDate,vSubject,iLogId from cpo_tutorlogbook";
		
	}	
	else
	{
	
		$sqlspn = "select iStudentId,iTutorId,dEntryDate,vSubject,iLogId from cpo_tutorlogbook where iTutorId='".$getct."'";
	
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
				 $sqlspn.=" order by iTutorId  Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by iTutorId  Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by iTutorId Limit 0,".page_size;
		   $curpage=0;
		}
		$result = runquery1($sqlspn) or die('could not'.mysqli_error());
	}
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect">
<form name="listtutorlog" method="post">
<table width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td>
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
					<td><h3><b>Tutor Log Book Admin</b></h3></td>
				</tr>
				<tr> 
					<td> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
					<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
                  <td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=logtutor">Overview</a></div></td>
                  
                  <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewtutorlog.php"> 
                      Edit/Delete</a><a class="tablink" href="viewcategory.asp"></a></div></td>
                  <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
                  <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">List </div></td>
                  <td width="1%"><div align="right"><img src="images/active_last.jpg" width="11" height="23"></div></td>
                  <td width="34%" background="images/middle_last.jpg"><div align="right"></div></td>
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
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a></td>
								<td width="13%" bgcolor="#FFFFFF"><a href="javascript:print()">Print this page</a></td>
							</tr>
							<tr> 
            <td class="bodytext" align="center">&nbsp;Select Tutor&nbsp; 
              <select name="cmbcategory" class="bodytext">
												<option value="" selected>ALL</option>
												<?php
						   							$fetch1="select * from cpo_usermaster where iUserType=1 and iUserStatus=1";
													$result1=runquery1($fetch1);
													$count=mysqli_num_rows($result1);
							
												while($row=mysqli_fetch_array($result1))
												{
																									
												?>
						
														<option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
                      							<?php
												}
												?>
											  </select>&nbsp; <?php if ($getct<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getct;?>',document.listtutorlog.cmbcategory);</script>
												<?php
												}?>
											 
              &nbsp;&nbsp; &nbsp;&nbsp; <img src="./images/search.gif" width="73" height="21" style="cursor:hand" onClick="javascript:getsearch();" align="absmiddle"> 
            </td>
            <td>&nbsp;</td>			
          </tr>
		  <tr> 
								<td colspan="2" bgcolor="F5F8FF">&nbsp;</td>
							</tr>
							<tr></tr>
							
                
							<tr> 
								<td colspan="2">
									<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr> 
											<td width="100%">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
						                              
                              <td width="518" class="headingtd">Tutor Log Book</td>
														<td width="347" class="headingtd"><div align="right"><img height=20 src="./images/img_header_gradient.jpg" width=147></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td height="22"> <div align="right"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="table"> 
                              <td width="9%" height="32" align="center" class="lighttd"> 
                                <div align="center"><strong>Sr No.<br>
                                  </strong> </div></td>
                              <td width="18%" height="32" align="left" class="lighttd"><div align="Left"><strong>Tutor 
                                    Name <br>
                                  </strong> </div></td>
							<td width="15%" height="32" align="left" class="lighttd"><div align="Left"><strong> 
                                    Log Date<br>
                                  </strong> </div></td>
							<td width="15%" height="32" align="left" class="lighttd"><div align="Left"><strong> 
                                    Learner Name<br>
                                  </strong> </div></td>
							<td width="15%" height="32" align="left" class="lighttd"><div align="Left"><strong> 
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
																			
						$fetchname="select * from cpo_subjectmaster where iSubjectId=".$row["vSubject"];
						$resultfetchname=mysqli_query($fetchname);
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
                              <td align="center" class="bodytext" height="28"><?php echo $counter; ?> 
                              </td>
							  <td align="left" class="bodytext">
                                  <a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo $tutorname; ?></a>
                                </td>
                               
								<td align="left" class="bodytext">
                                  <a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo $dispdate; ?></a>
                                </td>
								 <td align="left" class="bodytext">
                                  <a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo $studentname; ?></a>
                                </td>
								
								<td align="left" class="bodytext">
                                  <a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo $subjectname; ?></a>
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
							<td></td> 
                              <td align="center" class="error" height="28" colspan="5">No 
                                Record Exist in Database...!</td>
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
														<td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
														<td width="720" class="headingtd">&nbsp;</td>
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
												<a href="javascript:goto(<?php echo $i-1;?>)"><b><?php echo $i;?></b></a> 
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
