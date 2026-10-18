<?php
@ob_start();
include_once 'dbConnection.php';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
}
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d/m/Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}
$sql="SELECT TrackLogId,StudentId,StudentName,OperationId,DateTime,IPAddress,LEFT(DateTime,10) AS logdate,RIGHT(DateTime,8) AS logtime FROM tracklogstudent where 1=1";
		
if (isset($_REQUEST['CMBEVENT']) && $_REQUEST['CMBEVENT'] <> "0")
{
$sql .= " and OperationId=".$_REQUEST['CMBEVENT'];
}
if (isset($_REQUEST['CMBLEARNER']) && $_REQUEST['CMBLEARNER'] <> "0")
{
$sql .= " and StudentId=".$_REQUEST['CMBLEARNER'];
}
if (isset($_REQUEST['TXSTARTDATE']) && $_REQUEST['TXSTARTDATE'] <> "")
{
$sdate = explode("/",$_REQUEST['TXSTARTDATE']);
$tday=$sdate[2]."-".$sdate[1]."-".$sdate[0];
//$tday = date("d/m/Y G:i:s", mktime(0,0,0,$datadate[2],$datadate[1],$datadate[0]));
//$sql .= " and DateTime>='".$_REQUEST['TXSTARTDATE']."'";
$sql .= " and DateTime>='".$tday."'";
}
if (isset($_REQUEST['TXENDDATE']) && $_REQUEST['TXENDDATE'] <> "")
{
$sdate = explode("/",$_REQUEST['TXENDDATE']);
$tday=$sdate[2]."-".$sdate[1]."-".($sdate[0]+1);
//$datadate = explode("/",$_REQUEST['TXENDDATE']);
//$tday = date("Y-m-d G:i:s", mktime(0,0,0,$datadate[2],$datadate[1],$datadate[0]));
//$sql .= " and DateTime<='".$_REQUEST['TXENDDATE']."'";
$sql .= " and DateTime<'".$tday."'";
}
$sql .= " ORDER BY logdate DESC,logtime ASC";


$rID=runquery1($sql);
$count = $rID ? mysqli_num_rows($rID) : 0;
/*Paging Code*/
$page=Ceil($count/page_size);
if(isset($_GET['curpage']))
{
$curpage = $_GET['curpage'];
if($curpage==0)
{
$sql.=" Limit 0,".page_size;
$lmt =" Limit 0,".page_size;
}
else
{
$current=page_size*($curpage);
$sql.=" Limit " .$current. ",".page_size;
$lmt=" Limit " .$current. ",".page_size;
}
}
else
{
$sql.=" Limit 0,".page_size;
$lmt=" Limit 0,".page_size;
$curpage=0;
}
$rID=runquery($sql) or die('could not'.mysqli_error());
		
$num = $rID ? mysqli_num_rows($rID) : 0 ;
?>
<html>
<head>
<title>Learner Event Log</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function validate()
{
	var con = confirm('History will be Deleted,Do you want to Continue!');
	if(con)
	{
		document.FRMOPERATION.action="viewoperation.php?delete=1";
		document.FRMOPERATION.submit();
	}
	return false;
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['FRMOPERATION'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	//mydatetime.MX = obj.x;
	//mydatetime.MY = obj.y;	
	mydatetime.popup();
}

function submitpage()
{
	document.FRMOPERATION.action = "viewoperation.php?search='yes'";
	document.FRMOPERATION.submit();
}
</script>
<script language="javascript" src="calendar1.js"></script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" >
<?php include_once('top.php')?>
<form name="FRMOPERATION" method="post">	
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top"><?php 

if(isset($_GET['delete']))
{
	$sql="delete FROM tracklogstudent where 1=1";
	if (isset($_REQUEST['CMBLEARNER1']) && $_REQUEST['CMBLEARNER1'] <> "0")
	{
		$sql .= " and StudentId=".$_REQUEST['CMBLEARNER1'];
	}
	if (isset($_REQUEST['CMBDATE']) && $_REQUEST['CMBDATE'] <> "0")
	{
		$tday=date("Y")."-".date("m")."-".(date("d") - $_REQUEST['CMBDATE']);
		$sql .= " and DateTime<='".$tday."'";
		
	}
	//echo day(date("Y-m-d"));									
	runquery1($sql) or die('could not execute');
			?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Learner Event Log Admin</td>
        </tr>
        <tr>
          <td class="graydotline">&nbsp;</td>
        </tr>

        <tr>
          <td height="30px;"></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                       <td width="0%" align="right"><img src="images/ac_left_corner.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Learner Event Log </td>
                      <td width="0%" align="left"><img src="images/ac_right_corner.gif" /></td>
					  <td width="0%" align="right"></td>
                      <td width="25%" align="center" ></td>
                      <td width="0%" align="left"></td>
                     
                      <td width="0%" align="right"></td>
                      <td width="25%" align="center"></td>
                      <td width="0%" align="left"></td>
                      <td width="25%" align="center" ></td>
                      <td width="0%" align="left"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                  <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                      <tr>
                                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td class="toheaderbg" colspan="3">Learner Event Log Information</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                </tr>
                                <tr>
                                  <td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1">
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>

									
									  <tr>
										<td align="center"><font class="fontblue"><b>History deleted successfully.</b></font> </td>
									  </tr>
									  <tr>
										<td align="center">&nbsp;</td>
									  </tr>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="center"><div align="right"><a href="viewoperation.php"><img src="./images/go_back.gif" border="0"></a></div></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <?php } else {?>
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Learner Event Log Admin</td>
          </tr>
          <tr>
            <td class="graydotline">&nbsp;</td>
          </tr>
          <tr>
            <td height="30px;"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                       <td width="0%" align="right"><img src="images/ac_left_corner.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Learner Event Log </td>
                      <td width="0%" align="left"><img src="images/ac_right_corner.gif" /></td>
					  <td width="0%" align="right"></td>
                      <td width="25%" align="center" ></td>
                      <td width="0%" align="left"></td>
                     
                      <td width="0%" align="right"></td>
                      <td width="25%" align="center"></td>
                      <td width="0%" align="left"></td>
                      <td width="25%" align="center" ></td>
                      <td width="0%" align="left"></td>
                    </tr>
                  </table></td>
              </tr>
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
									<?php if(isset($_GET['search']))
									{?>
														
															<tr> 
																<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg"border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a></td>
															</tr>
															
									<?php
									}?>
									
									<?php if(!isset($_GET['search']))
		  {
		  ?>
		  <tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;Search Criteria</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
										<tr>
										<td>
										<table width="100%">
										<tr>
										<td width="28%" height="30" align="left" class="bodytext">&nbsp;&nbsp;Select From Date&nbsp;</td>
										<td width="72%"><a href="javascript:pickdate('TXSTARTDATE')"><input name="TXSTARTDATE" type="text" readonly="" class="textbox" style="cursor:hand"></a>&nbsp;<a href="javascript:pickdate('TXSTARTDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date" align="absmiddle"></a>&nbsp; &nbsp; To <a href="javascript:pickdate('TXENDDATE')"><input name="TXENDDATE" type="text" readonly="" class="textbox" style="cursor:hand"></a>&nbsp;<a href="javascript:pickdate('TXENDDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date" align="absmiddle"></a></td>
										</tr>
                						<tr> 
						                <td height="30" align="left" class="bodytext">&nbsp;&nbsp;Select Learner&nbsp;&nbsp;
				
														</td>
											            <td>
														<?php
				$seltutor = "select distinct StudentId,StudentName from tracklogstudent";
				$rst = runquery($seltutor);
			?>
														                    <select name="CMBLEARNER" class="textbox">
					<option value="0">ALL</option>
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor[0]?>" <?php if (isset($_POST['CMBLEARNER']) && $_POST['CMBLEARNER'] == $rstutor[0]) {?> selected <?php }?>><?php echo $rstutor[1]?></option>
					<?php }
				?>
				</select></td>
				
										
                 
										</tr>
																<tr> 
                 									 
                  <td height="30"  align="left" class="bodytext">&nbsp;&nbsp;Select Operation&nbsp;&nbsp;
		  
                    
														</td>
														<td>
<?php
				$seltutor = "select * from operation";
				$rst = runquery($seltutor);
			?>														
														<select name="CMBEVENT" class="textbox">
					<option value="0">ALL</option>
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor[0]?>" <?php if (isset($_POST['CMBEVENT']) && $_POST['CMBEVENT'] == $rstutor[0]) {?> selected <?php }?>><?php echo $rstutor[1]?></option>
					<?php }
				?>
				</select>&nbsp;&nbsp;<img src="./images/search.gif" style="cursor:hand" onClick="submitpage();" align="absbottom"></td>
										</tr>
										</table>
										</td>
										</tr>
										
										<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;Delete Criteria</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
										<tr>
										<td>
										<table width="100%">
									<tr> 
                 									 
                        <td width="28%" height="30"  align="left" class="bodytext">&nbsp;&nbsp;Select 
                          Learner 
                          <?php
				$seltutor = "select distinct StudentId,StudentName from tracklogstudent";
				$rst = runquery($seltutor);
			?>
                        </td>
														<td><select name="CMBLEARNER1" class="textbox">
                            <option value="0">ALL</option>
                            <?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
                            <option value="<?php echo $rstutor[0]?>" <?php if (isset($_POST['CMBLEARNER1']) && $_POST['CMBLEARNER1'] == $rstutor[0]) {?> selected <?php }?>><?php echo $rstutor[1]?></option>
                            <?php }
				?>
                          </select></td>
											            
				
										
                 
										</tr>
										<tr> 
                 									 
                        <td height="30" align="left" class="bodytext">&nbsp;&nbsp;History to Delete (Prior Days)</td>
                        <td width="72%"><select name="CMBDATE" class="textbox">
                            <option value="0">ALL</option>
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                          </select>
                          <img name="image" type="image" src="images/delete1.gif"  onClick="return validate()" align="absbottom">
						</td>
											            
				
										
                 
										</tr>
										</table>
										</td>
										</tr>
										
		  <?php } else {?>
									<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;Event Log Detail</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr > 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr> 
                  <td align='right' class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                  
                  <td height="25" width="15%" class="lighttd2"><b>&nbsp;&nbsp;Learner</b></td>
                  <td height="25" width="45%" class="lighttd2"><b>Operation</b></td>  
				  <td height="25" width="23%" class="lighttd2"><b>Date & Time</b></td>  
				   <td height="25" width="17%" class="lighttd2"><b>Ip Address</b></td>                      
                                
                 
                </tr>
                             <?php if($num)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_row($rID))
                    {
						$tutorname = "";
						$sqltutor = "select OperationDesc from operation where OperationId=".$rs[3];
						$rstutor = runquery($sqltutor);
						$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rstutor);
							$tutorname = $rsdata[0];
						}
						
						$sdt=explode(" ",$rs[4]); 
						 $sddt=explode("-",$sdt[0]);
						 $stdt=explode(":",$sdt[1]);
														
						$sdcon=$sddt[2]."/".$sddt[1]."/".$sddt[0];
						$stcon=$stdt[0].":".$stdt[1].":".$stdt[2];
					 
										
											
                    	?>
                           <tr class="whittd"> 
                  
                  <td width="15%" height="30" align="left">&nbsp;&nbsp;<?php echo $rs[2]; ?></a>
                  </td>
                  <td width="45%" align="left"><?php echo $tutorname;?></a></td>
				  <td width="23%" align="left"><?php echo $sdcon." ".$stcon;?></a></td>
				  <td width="17%" align="left"><?php echo $rs[5];?></a></td>
				 
				 
                  
                  
                </tr>
                          <?php
			            $cnt=$cnt+1;
					}
				}	
				  else
				  { ?>
                            <tr class="whittd"> 
                              <td align="center" height="35" colspan="6"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd"> 
                              <td align="center" class="error" height="28" colspan="6">No Learner Event Log Information Found</td>
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
												<a href="viewoperation.php?curpage=<?php echo $i-1;?>&search=<?php echo "yes" ?>&CMBEVENT=<?php echo $_REQUEST['CMBEVENT'] ?>&CMBLEARNER=<?php echo $_REQUEST['CMBLEARNER'] ?>&TXSTARTDATE=<?php echo $_REQUEST['TXSTARTDATE'] ?>&TXENDDATE=<?php echo $_REQUEST['TXENDDATE'] ?>"><b><?php echo $i;?></b></a> 
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
										<tr bgcolor="#FFFFFF"> 
            <td colspan="4" align="right"><a href="viewoperation.php"><img src="images/go_back.gif" border="0"></a>&nbsp;</td>			
          </tr>
							
					
    															
</table></td>
											</tr>
											<?php }?>
        						</table>
						</td>
    			
				</tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="0%"><img src="images/green_left_corn.gif" /></td>
                        <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                        <td width="0%"><img src="images/green_right_corn.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
      <?php }?>
    </td>
  </tr>
</table>
</form>
</body>
</html>