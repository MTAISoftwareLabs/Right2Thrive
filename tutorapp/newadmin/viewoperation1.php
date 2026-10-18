<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d/m/Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}

?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>

	<script language="JavaScript">
		document.location ="index.htm";
	</script> 
<?php
} 
	$sql="SELECT * FROM tracklogstudent where 1=1";
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
	$sql .= " order by DateTime desc";

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

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">

function validate()
{
	var con = confirm('History will be Delete Permaneteley,Do you want to Continue!');
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
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="FRMOPERATION" method="post">		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Learner Event Log Admin</b></h3></td>
		
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%"  height="23"><img src="./images/start.jpg" width="6" height="23"></td>
            <td width="18%" background="./images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Learner</font><font color="#000099"> 
                Event </font></div></td>
            <td width="1%" valign="top" background="./images/middle.jpg"><div align="center"><img src="./images/active_last.jpg" width="11" height="23"></div></td>
            <td width="80%" background="./images/middle_last.jpg"><div align="right"></div></td>
          </tr>
        </table></td>
	</tr>
	<tr> 
      <td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF" width="8%">&nbsp;</td>
            <td bgcolor="F5F8FF" width="92%">&nbsp;</td>			
          </tr>
          <tr> 
            <td colspan="2">
			<?php if(isset($_GET['search']))
			{?>
			<table width="85%" border="0" cellspacing="0" cellpadding="0" height="20" align="center">
			<tr> 
				<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a></td>
				<td width="13%" bgcolor="#FFFFFF"><a href="javascript:print()">Print this page</a></td>
			</tr>
			</table>
			<?php
			}?>
			</td>
          </tr>
		  <?php
		  if(!isset($_GET['search']))
		  {
		  ?>
          			<tr> 
						 	<td colspan="4">
													<table width="85%" border="0" cellspacing="0" align="center" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        
                  <td width="517" class="headingtd">Search Criteria</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table>
								</td>
								</tr>
								<tr>
								<td colspan="2" height="10"></td></tr>
								<tr>
								
								<td height="105" colspan="2">
									<table width="100%" align="center"  border="0" cellspacing="0" cellpadding="0">
										<tr> 
                 									 
                  <td width="32%" height="44"  align="left" class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search 
                    From Date&nbsp; 
                    <input name="TXSTARTDATE" type="text" readonly="" class="textbox">&nbsp;<a href="javascript:pickdate('TXSTARTDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>
                    &nbsp; &nbsp; To <input name="TXENDDATE" type="text" readonly="" class="textbox">&nbsp;<a href="javascript:pickdate('TXENDDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a></td>
											            
				
										
                 
										</tr>
									
                						<tr> 
                 									 
                  <td width="32%" height="30"  align="left" class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select 
                    Learner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
				</select>
														</td>
											            
				
										
                 
										</tr>
																<tr> 
                 									 
                  <td width="32%" height="39"  align="left" class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select 
                    Operation&nbsp;&nbsp;&nbsp;
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
				</select>&nbsp; &nbsp; <img src="./images/search.gif" style="cursor:hand" onClick="submitpage();">
														</td>
											            
				
										
                 
										</tr>
									</table>
								</td>
          </tr>
		  <tr align="right" bgcolor="#FFFFFF" >
                  <td colspan="4"><table width="85%" align="center" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
                        <td width="772" class="headingtd">&nbsp;</td>
                        <td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
                      </tr>
                    </table></td>
                </tr>
				<tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
		  
		  <tr> 
						 	<td colspan="4">
													<table width="85%" border="0" cellspacing="0" align="center" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        
                  <td width="517" class="headingtd">Delete Criteria</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table>
								</td>
								</tr>
								<tr>
								<td colspan="2" height="10"></td></tr>
								<tr>
								
								<td height="105" colspan="2">
									<table width="100%" align="center"  border="0" cellspacing="0" cellpadding="0">
										
									
                						<tr> 
                 									 
                  <td width="44%" height="30"  align="left" class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select 
                    Learner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
				</select>
														</td>
											            
				
										
                 
										</tr>
										<tr> 
                 									 
                  <td width="44%" height="39"  align="left" class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;History 
                    to Delete (Piror Days)&nbsp;&nbsp;&nbsp; 
                    <select name="CMBEVENT" class="textbox">
					<option value="0">ALL</option>
					<option value="1">1</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
				
				
				</select>&nbsp; &nbsp;
				</td><td width="56%"><input name="image" type="image" src="images/delete1.gif" width="73" height="22" onClick="return validate()">
						</td>
											            
				
										
                 
										</tr>
									</table>
								</td>
          </tr>
		  <tr align="right" bgcolor="#FFFFFF" >
                  <td colspan="4"><table width="85%" align="center" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
                        <td width="772" class="headingtd">&nbsp;</td>
                        <td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
                      </tr>
                    </table></td>
                </tr>
				<tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
		  <?php
		  }
		  else
		  {
		  		 if(!isset($_GET['delete']))
				 {	
		  ?>
          <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="85%" cellSpacing=0 cellPadding=0 border=0 class="table" align="center">
                <tr> 
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="517" class="headingtd">Event Log Detail</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  
                  <td height="25" width="15%" class="lighttd2"><b>&nbsp;&nbsp;Learner</b></td>
                  <td height="25" width="45%" class="lighttd2"><b>Operation</b></td>  
				  <td height="25" width="23%" class="lighttd2"><b>Date & Time</b></td>  
				   <td height="25" width="17%" class="lighttd2"><b>Ip Address</b></td>                      
                                
                 
                </tr>
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="5"> <div align="center"></div></td>
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
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="6" align="center"> No Information found 
                  </td>
                </tr>
				  <?php }

					?>
                
			<tr align="right" bgcolor="#FFFFFF" >
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
                        <td width="772" class="headingtd">&nbsp;</td>
                        <td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
                      </tr>
                    </table></td>
                </tr>
				<tr align="right" bgcolor="#FFFFFF" >
				
            <td height="30" colspan="4">
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
											 }}?>
              &nbsp;&nbsp;
			  </td>
           </tr>
              </table> </td>
          </tr>
                  
          
			
          
          <tr> 
            <td>&nbsp;</td>
            <td><a href="viewoperation.php"><img src="images/go_back.gif" border="0"></a></td>			
          </tr>
		  <?php
		  }
		  else
		  {
		  	?>
				<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
                <tr> 
                  <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                  <td width="652" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
                </tr>
                <tr> 
                  <td height="35" colspan="2" class="comment" align="center">History Cleared Successfully</td>
				  
																				
																					 
                </tr>
                <tr> 
                  <td colspan="2" ><div align="right">&nbsp; 
                      <a href="viewuser.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif" width="73" height="22" border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=approve"><img src="images/cancel.gif" width="73" height="22" border="0"></a></b></font>&nbsp;&nbsp; 
                    </div></td>
                </tr>
                <tr> 
                  <td class="headingtd" colspan="2">&nbsp;</td>
                </tr>
              </table>
			<?php	
		  }
	}
			?>
        </table>
		</td>
	</tr>
</table>
</form>
</BODY>
</HTML>

