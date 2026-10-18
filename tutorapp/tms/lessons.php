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

$currentpage = $_GET['curpage'];
$upload = "";

$getct = isset($_GET['ct'])?$_GET['ct']:'';
if($getct=='')
{
// 	$fetch1="select I_user_subid,I_subjectid  from cpo_user_subject where I_tutorid=".$_SESSION['user_id'] ." order by I_subjectid" ;
// 	$result1=runquery1($fetch1);
// 	$count1=mysqli_num_rows($result1);
// 	if($count1 > 0)
// 	{
// 		while($row1=mysqli_fetch_array($result1))
// 		{
// 			$name=mysqli_result($result1,0,0);
// 			$getct =$row1['I_subjectid'];
// 			break;												
// 		}
// 	}
}
?>
<html>
<head>
<title><?php echo sitename?> Lessons</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript">
function openwin(obj)
{
	new1=window.open("Detail_lesson.php?id="+obj,"",'height=450,width=600,scrollbars=yes,top=50 left=150');
}
function openwin_detail(obj)
{
	new1=window.open("lesson_detail.php?id="+obj,"",'height=450,width=600,scrollbars=yes,top=50 left=150');
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<form name="frmex" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
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
  <tr> 
    <td valign="top">
	<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td style="padding-right:10px" class="bodytext"  align="right"><a href="addlesson_new.php" ><b>Add a New Lesson</b></a></td></tr>
	<tr><td style="padding-right:10px" class="bodytext"  align="right"><a href="assignlesson_new.php" ><b>Assign a Lesson</b></a></td></tr>
	<tr><td height="20"></td></tr>
		<tr>
			<td width="80%">
				<table width="60%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100%">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
							<?php
							$selsub="select s.iSubjectId, s.vSubjectName,u.I_subjectid  from  cpo_subjectmaster as s, cpo_user_subject as u where s.iSubjectId=u.I_subjectid  and  I_tutorid=".$_SESSION['user_id']." group by I_subjectid order by  s.iSubjectId" ;
							$ressub = runquery1($selsub);
							$count = mysqli_num_rows($ressub);
							if($count)
							{
								$div = $count/6;
								for($i=0;$i<=round($div);$i++)
								{
									$display_result .="<tr>";
									for($j=0;$j<6;$j++)
									{
										$rowsub = mysqli_fetch_array($ressub);
										if($rowsub['vSubjectName'])
										{
										if($getct == '' && $j==0 && $i==0)
											{
												?>
							  <td >
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="1%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="98%" class="tebmidac" align="center" valign="middle" nowrap="nowrap"><?php echo ucfirst($rowsub['vSubjectName']);?></td>
									<td width="1%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>
							 </td>
										<?php	}
											elseif($getct != '' && $rowsub['iSubjectId'] == $getct)
											{
											?>
							 <td >
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle"  nowrap="nowrap"><?php echo ucfirst($rowsub['vSubjectName']);?></td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>
							 </td>
							 <?php
											}
											else
											{ ?>
											
												  <td >
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="1%"></td>
									<td width="98%" class="tebmid" align="center" valign="middle" nowrap="nowrap" onMouseOver="className='actbg'" onMouseOut="className='tebmid'"><a href="lessons.php?ct=<?php echo ucfirst($rowsub['iSubjectId']);?>"><?php echo $rowsub['vSubjectName'];?> </a></td>
									<td width="1%" ></td>
								</tr>
							 </table>
							 </td>
												 <?php
											}
										}
									} ?>
							  </tr>
									
								<?php }}
								else{
								//echo $display_result;
								?>
								<tr>
								<td width="20%">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="1%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="98%" class="tebmidac" align="center" valign="middle" nowrap="nowrap">No Subject Assigned</td>
									<td width="1%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>
							 </td>
							 <td width="80%"></td>
								</tr>
								<?php }?>
						  </table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
        	<td width="97%" class="tabelbor" align="center">
            	<table width="100%" align="center" cellpadding="0" cellspacing="0">
                	<?php if($getct !=''){?>
					<tr>
						<td  valign="top" colspan="4" class="tabesubtextb" height="35">
						<table>
							<tr>
								<td align="right"><a href="lefolder.php?ct=<?php echo $getct?>" ><img src="images/folder.gif" width="41"  border="0"/></a></td>
								<td valign="middle" class="tabesubtextb" align="left" style="padding-top:10px"><b>Lesson</b></td>
							</tr>
						</table>
						</td>
					</tr>
					<?php }?>
								
								
								
					<?php 
					if($count > 0){?>
					<!--<tr>-->
     <!--               	<td class="tabitafont" height="20"><strong>&gt;&gt;</strong> Click on the Lesson Name to view the details for that lesson -->
     <!--          	          <br>-->
     <!--          	          <strong>&gt;&gt;</strong> Click on View Summary to see students uploaded files and summary</td>-->
     <!--               </tr>-->
					<?php }?>
					
					<tr>
						<td>
							<table width="100%" align="center" cellpadding="0" cellspacing="0">
								<tr align="center">
								  <td class="tabesubtext" height="17"><strong>Lesson Assigned</strong></td>
								  <td class="tabesubtext"><strong>Subject</strong></td>
								  <td class="tabesubtext"><strong>Learner Name</strong></td>
								  <td class="tabesubtext"><strong>Learning Objective</strong></td>
							  </tr>
								<?php if($getct=='')						  
									{
									
					$fetch1="select I_user_subid,I_subjectid  from cpo_user_subject where  I_tutorid=".$_SESSION['user_id'];
										$result1=runquery1($fetch1);
										$count1=mysqli_num_rows($result1);
										if($count1 > 0)
										{
											while($row1=mysqli_fetch_array($result1))
											{
												$query1="select I_lid,V_name ,T_desc ,D_date ,D_duedate  from cpo_lessons where I_user_subjectid=".$row1['I_user_subid'];
												$result=runquery1($query1);
												$count2=mysqli_num_rows($result);
												while($row=mysqli_fetch_array($result))
												{	
													
													$logid=$row["I_lid"];
													$asign_date=gdate($row['D_date']);
													$desc = substr($row['T_desc'],0,30);
													
													//get lesson summary
													$sql_gl = "select  I_ulid,D_date  from cpo_user_lesson where I_lesson=".$logid;
													$res_gl = runquery1($sql_gl);
													$num_gl = @mysqli_num_rows($res_gl);
													$resles = mysqli_fetch_array($res_gl);
													?>							
								<tr align="center">
									<!-- <td class="tabesubtext" height="17"><?php //echo $asign_date; ?></td>-->
									<td class="tabesubtext"><?php if($resles['D_date'] != '' )
													{ ?><a href="#" onClick="javascript:openwin(<?php echo $logid ?>)" title="This lesson has summary. Click here to display box shown below"><?php echo ucfirst($row['V_name']); ?></a><?php }
													else
													{ ?><?php echo ucfirst($row['V_name']); ?><?php }?></td>
									<td class="tabesubtext"><?php echo ucfirst($desc); ?></td>
									<td class="tabesubtext"><?php if($resles['D_date'] != '' )
													{ ?><a href="#" onClick="javascript:openwin(<?php echo $logid ?>)" title="This lesson has summary. Click here to display box shown below">View Summary</a>	<?php }
													else
													{ ?>No Summary<?php }?></td>
								</tr>
								<?php
													}
												}
												
											}
											else
											{?>
												<tr>
									<td  colspan="4" height="30" class="tabesubtext" align="center"><font color="#FF0000">No lesson exists.</font></td>
									 </tr>
											<?php } // end no lesson else
										}	//end if no ct
										else
										{
	$fetch1="SELECT ul.I_ulid, ul.I_userid, ul.I_lesson, cl.I_lid, cl.I_sid
FROM cpo_user_lesson AS ul, cpo_lessons_new AS cl
WHERE cl.I_lid = ul.I_lesson
AND ul.I_tutorid=".$_SESSION['user_id']." and cl.I_sid=".$getct;
											$result1=runquery1($fetch1);
											$count1=mysqli_num_rows($result1);
											$mycount = 0;
											while($row_ius =mysqli_fetch_array($result1))
											{
												//$ids[] = $row_ius['I_user_subid'];
												$ids[$mycount]['lesson'] = $row_ius['I_lid'];
												$ids[$mycount]['user'] = $row_ius['I_userid'];
												$mycount++;
											}
											$vcnt =0;
											if($count1 > 0)
											{
												for($ij=0;$ij<count($ids);$ij++)
												{
												
													$sqlspn="select I_lid,V_name ,D_date ,D_duedate  from cpo_lessons_new where I_lid=".$ids[$ij]['lesson'];
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
																 $sqlspn.=" order by D_date desc  Limit 0,".page_size;
															}
															else
															{
																$current=page_size*($curpage);
																$sqlspn.=" order by D_date desc  Limit " .$current. ",".page_size;
															}
														}
														else
														{
														   $sqlspn.=" order by D_date desc Limit 0,".page_size;
														   $curpage=0;
														}
														
														  $result2 = runquery1($sqlspn);												
														while($row2=mysqli_fetch_array($result2))
														{
															$logid=$row2["I_lid"];
															$asign_date=gdate($row2['D_date']);
															//$desc = substr($row2['T_desc'],0,30);
															//get students name
															$sql_g2 = "select  vUserName from cpo_usermaster where iUserId=".$ids[$ij]['user'];
															$res_g2 = runquery1($sql_g2);
															$num_g2 = @mysqli_num_rows($res_g2);
															$resles2 = mysqli_fetch_array($res_g2);
															//get lesson summary
														 	$sql_gl = "select I_ulid,D_date,T_didulearn  from cpo_user_lesson where I_lesson=".$logid." and I_userid=".$ids[$ij]['user'];
															//echo $sql_gl;
															$res_gl = runquery1($sql_gl);
															$num_gl = @mysqli_num_rows($res_gl);
															$resles = mysqli_fetch_array($res_gl);
															?>
															<tr align="center">
															
								<!--	<td class="tabesubtext"><?php //echo $logid; ?></td>			-->			
									<td class="tabesubtext" height="17"><?php echo $asign_date; ?></td>
									<td class="tabesubtext">
									   <a href="#" onClick="javascript:openwin_detail(<?php echo $logid ?>)" title="Click here to view lesson details"><?php echo ucfirst($row2['V_name']); ?></a>									</td>
									<td class="tabesubtext"><?php echo ucfirst($resles2['vUserName']); ?></td>
									<td class="tabesubtext"><?php if($resles['T_didulearn'] != '' )
													{ ?><a href="#" onClick="javascript:openwin(<?php echo $resles['I_ulid'] ?>)" title="This lesson has summary. Click here to display box shown below">View Summary</a>	<?php }
													else
													{ ?>No Summary<?php }?></td>
								</tr>
													<?php }
												}
												 else {
													$flg =1;
													 $vcnt++;
														} //no rec 
													 
			 									}//for
												if(count($ids)== $vcnt)
												{ ?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="5"><font color="#FF0000">No Lesson Exists</font></td>
												</tr>
											<?php }
											}//no
											else
											{ 
														
											?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="5"><font color="#FF0000">No Lesson Exists</font></td>
												</tr>
											<?php } ?>
											   <?php
															
												
											}//else
													?>  
													<tr>
			<td colspan="5">			</td>
		</tr>
						  </table>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr> 
                        <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td width="96%" background="images/changebttm_center_cor.jpg">
							  	<div align="right" class="bodytext"><?php	if($page>1){ 
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
												<a href="lessons.php?ct=<?php=$getct?>&curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
			</td>
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
