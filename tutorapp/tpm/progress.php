<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";
if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}

$getct = isset($_GET['ct'])?$_GET['ct']:'';
if($getct=='')
{
	$fetch1="select * from cpo_thirdpartylearner where iTId=".$user_id;
	$result1=runquery1($fetch1);
	$count=mysqli_num_rows($result1);
	if($count > 0)
	{
		$result_info = mysqli_fetch_array($result1);
				
		$idlearner=explode(",",$result_info['vLearnerIds']);
																							
		for($j=0;$j<count($idlearner);$j++)
		{
			$fetchname="select * from cpo_usermaster where iUserId=".$idlearner[$j];
			$resultfetchname=runquery1($fetchname);
			$num = $resultfetchname ? mysqli_num_rows($resultfetchname) : 0;
			if ($num > 0)
			{
				$name=mysqli_result($result1,0,0);
				$getct=mysqli_result($resultfetchname,0,0);
				break;
			}
												
																
		}
	}
//echo $sqlcourse;
}
else
{
//echo $sqlcourse;
}

?>
<html>
<head>
<title><? echo sitename;?>Tutor Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
function openwin(obj)
{
	new1=window.open("Detail_progress.php?id="+obj,"",'height=450,width=600,scrollbars=yes,top=50 left=150');
}
</script>
<script language="JavaScript">
var myvar = 1;
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
		
	ct=document.frmprogress.cmbcategory.value;	
	document.frmprogress.action ='progress.php?ct='+ct;
	document.frmprogress.submit();
}

</script>

<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script>

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<form name="frmprogress" method="post">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><? include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <? include "includeleft.php";?>
    </td>
    <td background="images/welcome_bg.jpg" align="right" style="border-left:2px solid #ffffff" valign="top"> 
      <? include "includewelcome.php";?>
    </td>
  </tr>
 
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	
	<tr align="center"> 
		<td align="center" colspan="2" bgcolor="#FFFFFF">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
					<td width="53%" align="right"><strong class="bodytext">Select Learner</strong>&nbsp;&nbsp;&nbsp;<select name="cmbcategory" class="bodytext">
					<?
					$fetch1="select * from cpo_thirdpartylearner where iTId=".$user_id;
					$result1=runquery1($fetch1);
					$count=mysqli_num_rows($result1);
					if($count > 0)
					{
						$result_info = mysqli_fetch_array($result1);
						$idlearner=explode(",",$result_info['vLearnerIds']);
	
						for($j=0;$j<count($idlearner);$j++)
						{
							$fetchname="select * from cpo_usermaster where iUserId=".$idlearner[$j];
							$resultfetchname=runquery1($fetchname);
							$num = $resultfetchname? mysqli_num_rows($resultfetchname) : 0;
							if ($num > 0)
							{
								$id=mysqli_result($resultfetchname,0,0);
								$name=mysqli_result($resultfetchname,0,1);
							?>
								<option value="<? echo $id;?>"><? echo $name;?></option>
							<?
							
							}
						}
					}?>
					</select></td>
					<td width="47%">&nbsp;&nbsp;<img src="../admin/images/search.gif" align="absmiddle"  style="cursor:hand" onClick="javascript:getsearch();"></td><? if ($getct<>''){?><script language="JavaScript">getselected('<? echo $getct;?>',document.frmprogress.cmbcategory);</script><? }?>
				</tr>
			</table>
		</td>
		<td></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr> 
		<td valign="top"> 
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr> 
					<td valign="top"> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
								<td valign="top">
									<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr> 
											<td width="80%" height="22">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
														<td width="96%"  class="welcome"  background="images/changep_center_cor.jpg">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr> 
					<td width="77%" class="welcome"><strong>View Monthly Progress Report</strong></td>
					<td width="20%" class="welcome"></td>
					<td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
					</tr>
                                							</table>
														</td>
                              							<td width="1%"><img src="images/changep_right_cor.jpg"></td>
                            						</tr>
                         						</table>
											</td>
                     					</tr>
										<tr> 
											<td  class="forborder" valign="top">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td valign="top">
															<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
																<tr> 
																	<td width="21%" align="center" class="bodytext"><strong>&nbsp;Tutor Name</strong></td>
																	<td width="40%" align="center" class="bodytext"><strong>&nbsp;Subject</strong></td>
																	<td width="23%" align="center" class="bodytext"><strong>&nbsp; Month / Year</strong></td>
																	<td class="bodytext" align="center"><strong>View</strong></td>
																</tr>
										<?
										if($getct=='')						  
										{
											$fetch1="select * from cpo_thirdpartylearner where iTId=".$user_id;
											$result1=runquery1($fetch1);
											$count=mysqli_num_rows($result1);
											if($count > 0)
											{
												$result_info = mysqli_fetch_array($result1);
												$idlearner=explode(",",$result_info['vLearnerIds']);
												for($j=0;$j<count($idlearner);$j++)
												{
													$query1="select I_progressid,I_userid,I_tutorid,I_subjectId,I_year,I_month from cpo_progressreport where I_userid=".$idlearner[$j]." order by I_year desc";
													$result=runquery1($query1);
													$count=mysqli_num_rows($result);
													while($row=mysqli_fetch_array($result))
													{
													
														$fetchname="select * from cpo_usermaster where iUserId=".$row["I_userid"];
														$resultfetchname=mysqli_query($fetchname);
														$studentname=mysqli_result($resultfetchname,0,1);
														
														$fetchname="select * from cpo_usermaster where iUserId=".$row["I_tutorid"];
														$resultfetchname=mysqli_query($fetchname);
														$tutorname=mysqli_result($resultfetchname,0,1);
														
														$fetchname="select * from cpo_subjectmaster where iSubjectId=".$row["I_subjectId"];
														$resultfetchname=mysqli_query($fetchname);
														$subjectname=mysqli_result($resultfetchname,0,1);
														$logid = $row["I_progressid"];
														$dispdate=$row["I_month"]."/".$row["I_year"];
														?>
																<tr bgcolor="#FFFFFF"> 
																	
																		   
																	<td align="center" class="bodytext"><? echo $tutorname; ?></td>
																	<td align="center" class="bodytext"><? echo $subjectname; ?></td>
																	<td height="25" align="center" class="bodytext"><? echo $dispdate; ?></td>
																	<td class="bodytext" align="center"><a href="#" onClick="javascript:openwin(<? echo $logid ?>)">Click</a></td>
																</tr>
										<?
													}
												}
											}
										}	
										else
										{
											$sqlspn="select I_progressid,I_userid,I_tutorid,I_subjectId,I_year,I_month from cpo_progressreport where I_userid='".$getct."'";
											$result = runquery1($sqlspn) or die('could not execute'.mysqli_error());
											$num = $result? mysqli_num_rows($result) : 0;
											if ($num > 0)
											{
												$count = mysqli_num_rows($result);
												$page=Ceil($count/page_size);
												if(isset($_GET['curpage']))
												{
													$curpage = $_GET['curpage'];
													if($curpage==0)
													{
														 $sqlspn.="order by I_year desc  Limit 0,".page_size;
													}
													else
													{
														$current=page_size*($curpage);
														$sqlspn.="order by I_year desc  Limit " .$current. ",".page_size;
													}
												}
												else
												{
												   $sqlspn.="order by I_year desc Limit 0,".page_size;
												   $curpage=0;
												}
												$result = runquery1($sqlspn);												
												while($row=mysqli_fetch_array($result))
												{
													$fetchname="select * from cpo_usermaster where iUserId=".$row["I_userid"];
													$resultfetchname=mysqli_query($fetchname);
													$studentname=mysqli_result($resultfetchname,0,1);
													
													$fetchname="select * from cpo_usermaster where iUserId=".$row["I_tutorid"];
													$resultfetchname=mysqli_query($fetchname);
													$tutorname=mysqli_result($resultfetchname,0,1);
													
													if($row["I_subjectId"] !=0)
													{
													$fetchname="select * from cpo_subjectmaster where iSubjectId=".$row["I_subjectId"];
													$resultfetchname=mysqli_query($fetchname);
													$subjectname=mysqli_result($resultfetchname,0,1);
													}
													$logid = $row["I_progressid"];
													$dispdate=$row["I_month"]."/".$row["I_year"];
										?>
														  <tr class="whittd"> 
															
															<td align="center" class="bodytext"><? echo $tutorname; ?></td>
															<td align="center" class="bodytext"><? echo $subjectname; ?></td>
															<td height="25" align="center" class="bodytext"><? echo $dispdate; ?></td>
															<td class="bodytext" align="center"><a href="#" onClick="javascript:openwin(<? echo $logid ?>)">Click</a></td>
															
														  </tr>
										<?
													}
										
										?>
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
					</td>
				</tr>							
				<tr> 
					<td>
						<table width="90%" align="center"  border="0" cellpadding="0" cellspacing="0">
							<tr> 
								<td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
								<td width="96%" background="images/changebttm_center_cor.jpg">
									<div align="right" class="bodytext"><?	if($page>1){ 
									echo "Page : ";
									for($i=1;$i<=$page;$i++)
									{
									if($i==($curpage+1))
									{
									?>
									<b><? echo $i?></b>
									<?
									}
									else
									{
									$str="";
									?>
									<a href="progress.php?curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
									<?
									}									
									}}?>&nbsp;&nbsp;</div>
								</td>
								<td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
							</tr>
						</table>
					</td>
				</tr>  
			  <?
			  }
				else
				{			
				?>						
                                  
				<tr class="whittd"> 
					<td align="center" class="bodytext" height="28" colspan="3">No 
				Monthly Progress Report Exists for Selected Learner...!</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</td>
</tr>
				
				<tr> 
				<td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
				<tr> 
				<td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
				<td width="96%" background="images/changebttm_center_cor.jpg">
				<div align="right" class="bodytext">&nbsp;&nbsp;</div>
				</td>
				<td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				</tr>
				</table></td>
				</tr>
                                  <?
															}
													}
													?>     
			</table>
		</td>
	</tr>
	
      </table></td>
   <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <? include "includebottom.php";?>
</table>
</form>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
