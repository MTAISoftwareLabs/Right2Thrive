<?php
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
if($getct=='')
{
	$fetch1="select I_user_subid,I_subjectid  from cpo_user_subject where I_tutorid=".$_SESSION['user_id']." order by I_subjectid" ;
	$result1=runquery1($fetch1);
	 $count1=mysqli_num_rows($result1);
	if($count1 > 0)
	{
		while($row1=mysqli_fetch_array($result1))
		{
				$name=mysqli_result($result1,0,0);
				$getct=$row1['I_subjectid'];
				break;								
																
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
<title><?php echo sitename?> Homework</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript">
function openwin(obj)
{
	new1=window.open("Detail_hw.php?id="+obj,"",'height=450,width=600,scrollbars=yes,top=50 left=150');
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
	ct=document.frmex.cmbcategory.value;	
	document.frmex.action ='viewhw.php?ct='+ct;
	document.frmex.submit();
}

</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<form name="frmex" method="post">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc"> 
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr > 
    <td valign="top" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
			<tr >
			<td width="100%" >
				<table width="86%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="60%" >
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
							<?php
							$selsub="select s.iSubjectId, s.vSubjectName,u.I_subjectid  from  cpo_subjectmaster as s, cpo_user_subject as u where s.iSubjectId=u.I_subjectid  and  I_studentid=".$_SESSION['user_id']." group by I_subjectid order by  s.iSubjectId" ;
							$ressub = runquery1($selsub);
							$count = mysqli_num_rows($ressub);
							$div = $count/4;
							for($i=0;$i<=round($div);$i++)
							{
								$display_result .="<tr>";
								if($i==0 )
								{
									if($getct == '')
									{?>
										
						  <td width="20%">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
								<td width="100%" class="tebmidac" align="center" valign="middle"  nowrap="nowrap">All</td>
								<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
							</tr>
						 </table>
						 </td>
									<?php }
									else
									{ ?>
											
						 <td width="20%">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="1%"></td>
								<td width="98%" class="tebmid" align="center" valign="middle" nowrap="nowrap" onMouseOver="className='actbg'" onMouseOut="className='tebmid'"><a href="viewhw.php">All</a></td>
								<td width="1%" >&nbsp;</td>
							</tr>
						 </table>
						 </td>
											 <?php
									}
								}
								
								for($j=0;$j<4;$j++)
								{
									$rowsub = mysqli_fetch_array($ressub);
									if($rowsub['vSubjectName'])
									{
										if($getct != '' && $rowsub['iSubjectId'] == $getct )
										{?> <td width="20%">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
								<td width="1%"  class="tebmid"></td>
								<td width="98%" class="tebmid" align="center" valign="middle" nowrap="nowrap"><a href="viewhw.php?ct=<?php echo $rowsub['iSubjectId']?>"><?php echo $rowsub['vSubjectName']?></a></td>
								<td width="1%" class=" class="tebmid""></td>
							</tr>
					 </table>
					 </td>
										<?php }
										else
										{?>
											  <td width="20%">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="1%"></td>
								<td width="98%" class="tebmid" align="center"  nowrap="nowrap" valign="middle" onMouseOver="className='actbg'" onMouseOut="className='tebmid'"><a href="viewhw.php?ct=<?php echo $rowsub['iSubjectId'];?>"><?php echo $rowsub['vSubjectName']?></a></td>
								<td width="1%" ></td>
							</tr>
						 </table>
						 </td>
										<?php }
									}
								}?>
								</tr>
							<?php }
							
							?>
							</table>
						</td >
					</tr >
				</table>
			</td >
		</tr >
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
        	<td width="100%">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td>
											<table>
												<tr>											
													<td ><img src="images/folder.gif"></td>
													<td class="tabesubtextb"><b>Homework</b></td>
												</tr>
											</table>
										</td>		
									</tr>
									</table>
            	<table width="100%" cellpadding="0" cellspacing="0" class="tabelbor">
                	
					<tr>
						<td>
							
									</td>
									</tr>
								<tr>
									<td width="46%" height="17" class="tabesubtext"><b>Subject</b></td>
									<td width="16%" class="tabesubtext"><b>Date Due</b></td>
									<td width="13%" class="tabesubtext"><b>Completed?</b></td>
									<td width="25%" class="tabesubtext" align="center"><b>Feedback</b></td>
								</tr>
									<?php
										
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
													$subjectname=mysqli_result($resultfetchname,0,1);
														
												 	 $query1="select I_homeworkid,V_title ,D_assign_date,D_due_date,C_Completed,T_Summary from cpo_homework where I_user_subjectid=".$row1['I_user_subid'];
													$result=runquery1($query1);
													$count2=mysqli_num_rows($result);
													while($row=mysqli_fetch_array($result))
													{	
														
														
														$logid=$row["I_homeworkid"];
														$due_date =gdate($row['D_due_date']);
														$compl = ucfirst($row['C_Completed']);
														
														if($row2['T_Summary'] != "" )
															{ $view = 'Click to view';	 }
															else
															{ $view = 'Add Feedback'; }
														
														?>
									<tr>
									<td class="tabesubtext" height="17"><?php echo $subjectname; ?></td>
									<td class="tabesubtext"><?php echo $due_date; ?></td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo  $row['C_Completed'];?></a>&nbsp;</td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo $view; ?></a></td>
																</tr>
								<?php $flg =1;
													 $vcnt++;
													}
													
												}
												if(count($ids)== $vcnt)
												{ ?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="5">No Homework Exists for Selected Subject...!</td>
												</tr>
											<?php }
												
											} 
											else
											{ 
														
											?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="5">No Homework Exists for Selected Subject...!</td>
												</tr>
											<?php } 
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
															$comp = ucfirst($row2['C_Completed']);
															
															//get lesson summary
															if($row2['T_Summary'] != "" )
															{ $view = 'Click to view';	 }
															else
															{ $view = 'Add Feedback'; }
															?>
															<tr>
									<td class="tabesubtext" height="17"><?php echo $subjectname; ?></td>
									<td class="tabesubtext"><?php echo $due_date; ?></td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo $comp; ?></a></td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo $view; ?></a></td>
																</tr>
													<?php
														}
													 }
													 else {
													 $flg =1;
													 $vcnt++;
														} //no rec 
													 
			 									}//for
												if(count($ids)== $vcnt)
												{ ?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="5">No Homework Exists for Selected Subject...!</td>
												</tr>
											<?php }
											}//no
											else
											{ 
														
											?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="5">No Homework Exists for Selected Subject...!</td>
												</tr>
											<?php } ?>
											   <?php
															
												
											}//else
													?>     
																		</table>
						</td>
					</tr>
					
					<tr> 
                        <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td width="96%" background="images/changebttm_center_cor.jpg">
							  	<div align="right" class="bodytext"><?php	
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
												<b><?php echo $i?></b>
											 <?php
												}
												else
												{
													$str="";
											?>
											
												<a href="viewhw.php?ct=<?php=$ct;?>&curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;</div>
							  </td>
                              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table></td>
                      </tr>
                </table>
            </td>
        </tr>
	</table>
			</td >
		</tr>
    </table>
	
	  </td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
      <?php include "includebottom.php";?>
</table>
</form>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
