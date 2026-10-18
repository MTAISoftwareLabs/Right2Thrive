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
if($getct=='')
{
	$fetch1="select I_user_subid,I_subjectid  from cpo_user_subject where I_studentid=".$_SESSION['user_id']." order by I_subjectid" ;
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
}
else
{
//echo $sqlcourse;
}
?>
<html>
<head>
<title><? echo sitename?> Lessons</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
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
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
.style1 {
	color: #FF9933;
	font-weight: bold;
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
<form name="frmex" method="post">

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
  <tr> 
    <td valign="top">
	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#AFE0FA">
		<tr>
			<td width="100%">
				<table width="98%" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="60%">
							<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
								<tr>
							<?
							$selsub="select s.iSubjectId, s.vSubjectName,u.I_subjectid  from  cpo_subjectmaster as s, cpo_user_subject as u where s.iSubjectId=u.I_subjectid  and  I_studentid=".$_SESSION['user_id']." group by I_subjectid order by  s.iSubjectId" ;
							$ressub = runquery1($selsub);
							$count = mysqli_num_rows($ressub);
							if($count > 0)
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
											if($getct == '' && $j==0 && $i==0 )
											{?>
							  <td >
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle" nowrap="nowrap"><?php echo $rowsub['vSubjectName'];?></td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>							 </td>
									<? 		}									
											elseif($getct != '' && $rowsub['iSubjectId'] == $getct)
											{ ?>
							 <td >
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle"  nowrap="nowrap"><?php echo $rowsub['vSubjectName'];?></td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>							 </td>
							<?				}
											else
											{?>
												 <td>
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="1%"></td>
									<td width="98%" class="tebmid" align="center" valign="middle" nowrap="nowrap" onMouseOver="className='actbg'" onMouseOut="className='tebmid'"><a href="sub_lesson.php?ct=<?php echo $rowsub['iSubjectId'];?>"><?php echo $rowsub['vSubjectName'];?> </a></td>
									<td width="1%" ></td>
								</tr>
							 </table>							 </td>
											<? }
										}
									}?>
							  </tr>
								<? }
							}else{ ?>
							<tr>
							<td width="20%">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle" nowrap="nowrap">No Subject Assigned</td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>							 </td>
							 <td width="80%"></td>
							</tr>
							<? }?>
						  </table>						</td>
					</tr>
			  </table>			</td>
		</tr>
		<tr>
			<td>
				<table width="98%" align="center" cellpadding="0" cellspacing="0">
        <tr>
        	<td width="100%" class="tabelbor">
            	<table width="99%" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                	<? if($getct !=''){?>
				<tr>
							<td valign="top" colspan="4">
								<table>
									<tr>											
										<td ><a href="lefolder.php?ct=<? echo $getct?>" ><img src="images/folder.gif" border="0"></a></td>
										<td class="tabesubtextb"><b>Lessons</b></td>
									</tr>
								</table>							</td>		
					  </tr>
					<? }?>	
						
						
					<? if($count >0){?>
					<tr>
                    	<td class="tabitafont" height="20"><p class="style1">Click on the lesson name to write your summary for that lesson</p>
                   	    <p>&nbsp;</p></td>
                    </tr>
					<? }?>
					<tr>
						<td>
							<table width="100%" align="right" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
							
								<?
										if($getct=='')						  
										{
										
											$fetch1="select  I_user_subid,I_subjectid  from cpo_user_subject where I_studentid=".$_SESSION['user_id'];
											
											$result1=runquery1($fetch1);
											$count1=mysqli_num_rows($result1);?>
											  <tr>
		                          <td  height="17" class="tabesubtext">Lesson Received </td>
		                          <td class="tabesubtext"   >Subject</td>
		                          <td  class="tabesubtext">Topic</td>
		                          <td class="tabesubtext"  >Lession completed </td>
								  <td width="20%" class="tabesubtext"  >Learning Objective </td>
	                          </tr>
										<?	if($count1 > 0)
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
														$due_date =gdate($row['D_duedate']);
														$desc = substr($row['T_desc'],0,30);
														
														//get lesson summary
														$sql_gl = "select  I_ulid  from cpo_user_lesson where I_lesson=".$logid;
														$res_gl = runquery1($sql_gl);
														$num_gl = @mysqli_num_rows($res_gl);
														
														?>
		                  
	                          <tr>
									<td width="22%"  height="17" class="tabesubtext"><? echo $asign_date; ?></td>
										<td width="13%" class="tabesubtext"   >
										<? if ($num_gl > 0){?>
									<a href="#" onClick="javascript:openwin(<? echo $logid ?>)" title="This lesson has summary."><? echo ucfirst($row2['V_name']); ?></a>
									<? } 
									else
									{ ?> <a href="#" onClick="javascript:openwin(<? echo $logid ?>)" title="This lesson requires a summary. Click here to display box shown below"><? echo ucfirst($row2['V_name']); ?></a>
									 <? } ?>									</td>
									<td width="24%"  class="tabesubtext"><? echo ucfirst($desc); ?></td>
									<td width="21%" class="tabesubtext"  ><? echo $due_date; ?></td>
									 <td class="tabesubtext"  ><? if ($num_gl > 0){?>
                                       <a href="#" onClick="javascript:openwin(<? echo $logid ?>)"  title="This lesson has summary.">View Summary</a>
                                       <? } 
									else
									{ ?>
                                       <a href="#" onClick="javascript:openwin(<? echo $logid ?>)" title="This lesson requires a summary. Click here to display box shown below" >New - Add Summary</a>
                                       <? } ?></td>
							  </tr>
								<?
													}
												}
												
											}
											else
											{?>
												<tr>
									<td  colspan="5" height="30" class="tabesubtext" align="center"><font color="#FF0000">No lesson exists.</font></td>
									 </tr>
											<? }
										}	
										else
										{
									
										 	//$fetch1="select  I_user_subid,I_subjectid  from cpo_user_subject where I_studentid=".$_SESSION['user_id']." and I_subjectid=".$getct;
											$fetch1="SELECT ul.I_ulid, ul.I_userid, ul.I_lesson, cl.I_lid, cl.I_sid
FROM cpo_user_lesson AS ul, cpo_lessons_new AS cl
WHERE cl.I_lid = ul.I_lesson
AND ul.I_userid=".$_SESSION['user_id']." and cl.I_sid=".$getct;
											$result1=runquery1($fetch1);
											$count1=mysqli_num_rows($result1);
											$mycount = 0;?>
											 <tr>
															  <td height="17" class="tabesubtext"><strong>Lesson Received </strong></td>
															  <td class="tabesubtext"  ><strong>Subject</strong></td>
															  <td class="tabesubtext"><strong>Topic</strong></td>
															  <td class="tabesubtext"  ><strong>Lession completed </strong></td>
															  <td class="tabesubtext"  ><strong>Learning Objective</strong></td>
							  </tr>									
										<?	while($row_ius =mysqli_fetch_array($result1))
											{
												//$ids[] = $row_ius['I_user_subid'];
												$ids[$mycount]['lesson'] = $row_ius['I_lid'];
												//$ids[$mycount]['user'] = $row_ius['I_userid'];
												$mycount++;
											}
											$vcnt =0;
											if($count1 > 0)
											{
												for($ij=0;$ij<count($ids);$ij++)
												{
												
//													$sqlspn="select I_lid,V_name ,T_desc ,D_date ,D_duedate  from cpo_lessons where I_user_subjectid=".$ids[$ij];
	$sqlspn="select I_lid,V_name ,D_date ,D_duedate,T_desc from cpo_lessons_new where I_lid=".$ids[$ij]['lesson'];
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
														
														  $result2 = runquery1($sqlspn);?>
														 			
												<?		while($row2=mysqli_fetch_array($result2))
														{
															$logid=$row2["I_lid"];
															$asign_date=gdate($row2['D_date']);
															$due_date =gdate($row2['D_duedate']);
															$desc = substr($row2['T_desc'],0,30);
															
															//get lesson summary
														 	$sql_gl = "select  I_ulid  from cpo_user_lesson where I_lesson=".$logid;
															$res_gl = runquery1($sql_gl);
															$num_gl = @mysqli_num_rows($res_gl);
															
															?>
															
															<tr>
									<td class="tabesubtext" height="17" align="center"><? echo $asign_date; ?>
									 </td>
									<td class="tabesubtext" align="center" >
									<a href="#" onClick="javascript:openwin_detail(<? echo $logid ?>)" title="Click here to download lesson details"><? echo ucfirst($row2['V_name']); ?></a>									 </td>
									<td class="tabesubtext" align="center"><a href="#" onClick="javascript:openwin_detail(<? echo $logid ?>)" title="Click here to download lesson details"><? echo ucfirst($row2['T_desc']); ?></a></td>
									 <td class="tabesubtext" align="center" ><? echo $due_date; ?></td>
									<td class="tabesubtext" align="center" >
									<? if ($num_gl > 0){?>
									<a href="#" onClick="javascript:openwin(<? echo $logid ?>)" title="This lesson has summary. Click here to display box shown below" >View Summary</a>
									<? } 
									else
									{ ?> <a href="#" onClick="javascript:openwin(<? echo $logid ?>)" title="This lesson requires a summary. Click here to display box shown below" >New - Add Summary</a>
									 <? } ?>									 </td>
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
														<td align="center" class="bodytext" height="28" colspan="10"><font color="#FF0000">No Lesson Exists</font></td>
												</tr>
											<? }
											}//no
											else
											{ 
														
											?>	<tr class="whittd"> 
														<td align="center" class="bodytext" height="28" colspan="9"><font color="#FF0000">No Lesson Exists</font></td>
												</tr>
											<? } ?>
											   <?
															
												
											}//else
													?>   
													<tr>
			<td colspan="9">
				<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
					<tr>
				<td height="40"></td>
				</tr>
					<tr>
				<td class="tabesubtextb"><b>To View all Homework Assignments Click here </b></td>
				</tr>
				<tr>
				<td height="20"></td>
				</tr>
				<tr>
						<td class="tabbgcolor" align="center" height="10"> </td>
					</tr>
					<tr>
						<td class="tabbgcolor" align="center">
				<? //get hw
				if($getct !='')
				{
					$curdate = date('Y-m-d');
					$sql_hw = "select h.V_title, s.vSubjectName from cpo_homework as h, cpo_subjectmaster as s  where h.I_Subject =".$getct." and s.iSubjectId =".$getct."  and
								h.I_studentid =".$_SESSION['user_id']."  and h.D_due_date='".$curdate."'";
					$res_hw = runquery1($sql_hw);
					$num_hw = mysqli_num_rows($res_hw);
					$fet_hw = mysqli_fetch_array($res_hw);
					//get hw
						
					?>
					
						<? if($num_hw >0)
					{ 
					echo 'Your current homework for '.$fet_hw['vSubjectName'].'  is '.$fet_hw['V_title'].'. <a href="viewhw.php" title="Homework Assignment">Click here</a> to view all<br>
										home work assignments';
					}
					else
					{
					$sql_hw1 = "select  vSubjectName from cpo_subjectmaster  where iSubjectId =".$getct;
					$res_hw1 = runquery1($sql_hw1);
					$num_hw1 = mysqli_num_rows($res_hw1);
					$fet_hw1= mysqli_fetch_array($res_hw1);
					 echo 'No Homework for '.$fet_hw1['vSubjectName'].'. <a href="viewhw.php"   title="Homework Assignment">Click here</a> to view all<br>
										home work assignments' ;}
				} else
				{
					 echo 'No Homework exists.' ;
				}
					?>						</td>
					</tr>
						<tr>
						<td class="tabbgcolor" align="center" height="10"> </td>
					</tr>
				</table>			</td>
		</tr>  
							</table>						</td>
					</tr>
					<tr> 
                        <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
												<a href="lessons.php?ct=<?=$getct?>&curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
											 <?
												}									
											 }}?>&nbsp;&nbsp;</div>							  </td>
                              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table></td>
                      </tr>
                </table>            </td>
        </tr>
	</table>			</td>
		</tr>
		<tr>
		  <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
		  </tr>
    </table>
	
	  </td>
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
