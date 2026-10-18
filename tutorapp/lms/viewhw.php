<?
include_once 'dbConnection.php';
if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
$getct = isset($_GET['ct'])?$_GET['ct']:'';
if($getct !='')
{
	$q = '?ct='.$getct;
}
?>
<html>
<head>
<title><? echo sitename?> Homework</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript">
function openwin(obj)
{
	new1=window.open("Detail_hw.php?id="+obj,"",'height=450,width=600,scrollbars=yes,top=50 left=150');
}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<form name="frmex" method="post" enctype="multipart/form-data">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
 
  <tr> 
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF"> 
      <? include "leftpanel.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr > 
    <td valign="top" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		  <tr >
			<td width="100%" valign="top">
				<table width="96%" align="center" cellpadding="0" cellspacing="0">
<tr>
						<td width="60%" valign="top">
							<table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
							  <tr>
							<?
							$selsub="select s.iSubjectId, s.vSubjectName,u.I_subjectid  from  cpo_subjectmaster as s, cpo_user_subject as u where s.iSubjectId=u.I_subjectid  and  I_studentid=".$_SESSION['user_id']." group by I_subjectid order by  s.iSubjectId" ;
							$ressub = runquery1($selsub);
							$count = mysqli_num_rows($ressub);
							if($count)
							{
								$div = $count/5;
								for($i=0;$i<=round($div);$i++)
								{
									$display_result .="<tr>";
									if($i==0 )
									{
										if($getct == '')
										{?>
											
							  <td >
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle"  nowrap="nowrap">&nbsp;&nbsp;&nbsp;All&nbsp;&nbsp;&nbsp;</td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>
							 </td>
										<? }
										else
										{ ?>
												
							 <td>
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="1%"></td>
									<td width="98%" class="tebmid" align="center" valign="middle" nowrap="nowrap" onMouseOver="className='actbg'" onMouseOut="className='tebmid'">&nbsp;&nbsp;&nbsp;<a href="viewhw.php">All</a>&nbsp;&nbsp;&nbsp;</td>
									<td width="1%" ></td>
								</tr>
							 </table>
							 </td>
												 <?
										}
									}
									
									for($j=0;$j<5;$j++)
									{
										$rowsub = mysqli_fetch_array($ressub);
										if($rowsub['vSubjectName'])
										{
											if($getct != '' && $rowsub['iSubjectId'] == $getct )
											{?> <td >
						<table cellpadding="0" cellspacing="0" width="100%">
							<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle"  nowrap="nowrap"><?php echo $rowsub['vSubjectName']?></td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
						 </table>
						 </td>
											<? }
											else
											{?>
												  <td>
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="1%"></td>
									<td width="98%" class="tebmid" align="center"  nowrap="nowrap" valign="middle" onMouseOver="className='actbg'" onMouseOut="className='tebmid'"><a href="viewhw.php?ct=<?php echo $rowsub['iSubjectId'];?>"><?php echo $rowsub['vSubjectName']?></a></td>
									<td width="1%" ></td>
								</tr>
							 </table>
							 </td>
											<? }
										}
									}?>
									</tr>
								<? }
							} else
							{?>
							<tr>
							<td width="20%">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle"  nowrap="nowrap">No Subject Assigned</td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>
							 </td>
							 <td width="80%"></td>
							</tr>
							<? }
							?>
							</table>
				  </td >
					</tr >
				</table>
			</td >
		</tr >
		<tr>
			<td valign="top">
				<table width="99%" align="center" cellpadding="0" cellspacing="0" bgcolor="#AFE0FA">
        <tr>
        	<td width="100%" valign="top">
			
            	<table width="97%" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tabelbor">
							<? if($count >0){?>
		  <tr>
									<td valign="top" colspan="5">
										<table>
											<tr>											
												<td ><a href="hwfolder.php<? echo $q?>" ><img src="images/folder.gif" border="0"></a></td>
												<td class="tabesubtextb"><b>Homework</b></td>
											</tr>
										</table>									</td>		
								</tr>
								<? }?>	
								
								<tr>
									<td width="46%" height="17" class="tabesubtext"><b>Subject</b></td>
									<td width="46%" height="17" class="tabesubtext"><b>Title</b></td>
									<td width="16%" class="tabesubtext"><b>Date Due</b></td>
									<td width="13%" class="tabesubtext"><b>Completed?</b></td>
									<td width="25%" class="tabesubtext" align="center"><b>Feedback</b></td>
								</tr>
									<?
										if($getct=='')						  
										{
										
											$fetch1="select I_user_subid,I_subjectid  from cpo_user_subject where I_studentid=".$_SESSION['user_id']." group by I_subjectid" ;
											$result1=runquery1($fetch1);
											 $count1=mysqli_num_rows($result1);
											if($count1 > 0)
											{$vcnt =0;
												while($row1=mysqli_fetch_array($result1))
												{
													$fetchname="select * from cpo_subjectmaster where iSubjectId=".$row1["I_subjectid"];
													$resultfetchname=mysqli_query($fetchname);
													$count10=mysqli_num_rows($resultfetchname);
													if ($count10 > 0) {
													$subjectname=mysqli_result($resultfetchname,0,1);
													}
													
												 	 $query1="select I_homeworkid,V_title ,D_assign_date,D_due_date,C_Completed,T_Summary from cpo_homework where I_user_subjectid=".$row1['I_user_subid'];
													$result=runquery1($query1);
													$count2=mysqli_num_rows($result);
													while($row=mysqli_fetch_array($result))
													{	
														
														
														$logid=$row["I_homeworkid"];
														$due_date =gdate($row['D_due_date']);
														$compl = ucfirst($row['C_Completed']);
														$title=ucfirst($row['V_title']);
														
														if($row2['T_Summary'] != "" )
															{ $view = 'Click to view';	 }
															else
															{ $view = 'Add Feedback'; }
														
														?>
									<tr>
									<td class="tabesubtext" height="17"><a href="hwfolder.php<? echo $q?>" ><? echo $subjectname; ?></a></td>
									<td class="tabesubtext"><? echo $title; ?></td>
									<td class="tabesubtext"><? echo $due_date; ?></td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin(<? echo $logid ?>)"><? echo  $row['C_Completed'];?></a>&nbsp;</td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin(<? echo $logid ?>)"><? echo $view; ?></a></td>
																</tr>
								<? $flg =1;
													 $vcnt++;
													}
													
												}
												if(count($ids)== $vcnt)
												{ ?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="7"><font color="#FF0000">No Homework Exists</font></td>
												</tr>
											<? }
												
											} 
											else
											{ 
														
											?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="7"><font color="#FF0000">No Homework Exists</font></td>
												</tr>
											<? } 
										}	
										else
										{
									
										  	$fetch1="select  I_user_subid,I_subjectid  from cpo_user_subject where I_studentid =".$_SESSION['user_id']." and I_subjectid=".$getct;
											$result1=runquery1($fetch1);
											 $count1=mysqli_num_rows($result1);
											while($row_ius =mysqli_fetch_array($result1))
											{
												$ids[] = $row_ius['I_user_subid'];
												
												
											}$vcnt =0;
											if($count1 > 0)
											{
												
												for($ij=0;$ij<count($ids);$ij++)
												{
												
												$fetchname="select * from cpo_subjectmaster where iSubjectId=".$getct;
												$resultfetchname=mysqli_query($fetchname);
												$subjectname=mysqli_result($resultfetchname,0,1);
													
													$sqlspn="select I_homeworkid,V_title ,D_assign_date ,D_due_date,C_Completed,T_Summary from cpo_homework where I_user_subjectid=".$ids[$ij];
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
																 $sqlspn.=" order by D_due_date desc  Limit 0,".page_size;
															}
															else
															{
																$current=page_size*($curpage);
																$sqlspn.=" order by D_due_date desc  Limit " .$current. ",".page_size;
															}
														}
														else
														{
														   $sqlspn.=" order by D_due_date desc Limit 0,".page_size;
														   $curpage=0;
														}
														
														  $result2 = runquery1($sqlspn);												
														while($row2=mysqli_fetch_array($result2))
														{
															$logid=$row2["I_homeworkid"];
															$due_date =gdate($row2['D_due_date']);
															$title=ucfirst($row2['V_title']);
															$comp = ucfirst($row2['C_Completed']);
															
															//get lesson summary
															if($row2['T_Summary'] != "" )
															{ $view = 'Click to view';	 }
															else
															{ $view = 'Add Feedback'; }
															?>
															<tr>
									<td class="tabesubtext" height="17"><a href="hwfolder.php<? echo $q?>" ><? echo $subjectname; ?></a></td>
									<td class="tabesubtext" height="17"><? echo $title; ?></td>
									<td class="tabesubtext"><? echo $due_date; ?></td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin(<? echo $logid ?>)"><? echo $comp; ?></a></td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin(<? echo $logid ?>)"><? echo $view; ?></a></td>
																</tr>
													<?
														}
													 }
													 else {
													 $flg =1;
													 $vcnt++;
														} //no rec 
													 
			 									}//for
												if(count($ids)== $vcnt)
												{ ?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="7"><font color="#FF0000">No Homework Exists</font></td>
												</tr>
											<? }
											}//no
											else
											{ 
														
											?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="7"><font color="#FF0000">No Homework Exists</font></td>
												</tr>
											<? } ?>
											   <?
															
												
											}//else
													?>     
																		</table>				  </td>
					</tr>
					
					<tr> 
                        <td colspan="4"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                        <tr> 
                              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td width="96%" background="images/changebttm_center_cor.jpg">
							  	<div align="right" class="bodytext"><?	
								if($getct != '')
								{$ct = $getct;}
								else
								{ $ct ='';}
								if($page>1){ 
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
											
												<a href="viewhw.php?ct=<?=$ct;?>&curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
											 <?
												}									
											 }}?>&nbsp;&nbsp;</div>							  </td>
                              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table>
                          <table align="center">
                            <tr>
                              <td width="596"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
                            </tr>
                          </table>                          <p>&nbsp;</p></td>
                      </tr>
                </table>
            </td>
        </tr>
	</table>
	  </td >
		</tr>
    </table>
	
	  </td>
      <p>&nbsp;</p>
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
