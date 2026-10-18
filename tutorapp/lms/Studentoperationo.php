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
?>
<html>
<head>
<title>Learner History - CareerPaths Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../admin/calendar1.js"></script> 
<script language="JavaScript">
function clean_string($str)
{
	$str = htmlspecialchars(str_replace("\'", "'", trim($str)));
	$str = rtrim($str);	
	$str = str_replace("'", "\'", $str);
	return $str;
}
var myvar = 1;
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['FRMLEARNEROPERATION'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top" ><table width="99%" border="0" cellspacing="0" cellpadding="0" style="border-right : 1pt solid  #E2E2E2;">
        <tr> 
          <td width="100%"  valign="top"><? include "includetop.php";?></td>
          <td  ></td>
        </tr>
      </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc">
      <? include "includeleft.php";?>
    </td>
	<td background="images/welcome_bg.jpg" align="right" style="border-left:2px solid #ffffff"> 
      <? include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMLEARNEROPERATION" method="post" action="Studentoperation.php?next=1">
			<?
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="98%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Search Criteria</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table width="80%" align="center">
					<tr>
                        <td height="10" colspan="2" class="bodytext" align="right">&nbsp;</td>
                      </tr>
					<tr>
							
                        <td class="bodytext" height="32">Select Operation</td>
							<td class="bodytext">&nbsp;<select name="CMBEVENT" class="textbox">
							<?
							$seltutor = "select * from operation";
							$rst = runquery($seltutor);?>
							
					<option value="0">ALL</option>
				<?
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<? echo $rstutor[0]?>" <? if (isset($_POST['CMBEVENT']) && $_POST['CMBEVENT'] == $rstutor[0]) {?> selected <? }?>><? echo $rstutor[1]?></option>
					<? }
				?>
				</select>
                          &nbsp;</td>
						</tr>
						<?
						?>
						<tr>
							
                        <td width="31%" height="30" class="bodytext">From Date</td>
							<td width="69%" class="bodytext">&nbsp;<input name="TXSTARTDATE" type="text" class="textbox">
                         <a href="javascript:pickdate('TXSTARTDATE')"> <img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a></td>
						</tr>
						<tr>
							
                        <td width="31%" height="32" class="bodytext">To Date</td>
							<td width="69%">&nbsp;<input name="TXENDDATE" type="text" class="textbox">&nbsp;<a href="javascript:pickdate('TXENDDATE')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></td>
						</tr>
						
						<tr><td colspan="2">&nbsp;</td></tr>
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?
			  }
			  else
			  {?>
			 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> 
                <tr>
                  <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                              <td width="98%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="77%" class="welcome">Search Result</td>
                                    <td width="20%" class="welcome"></td>
                                    <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                  </tr>
                                </table></td>
                              <td width="1%"><img src="images/changep_right_cor.jpg"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td  class="forborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
                                  <tr> 
                                    <td width="46%" class="bodytext"><strong>&nbsp;Operations</strong></td>
                                    <td width="31%" class="bodytext"><strong>&nbsp;Date &amp; Time</strong></td>
									<td width="23%" class="bodytext"><strong>&nbsp;Ip Address</strong></td>
                                  </tr>
                                  <?
								$sql="SELECT * FROM tracklogstudent where 1=1 and StudentId=".$user_id;
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
						
							if($num)
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
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" class="bodytext">&nbsp;<? echo $tutorname;?></td>
										<td class="bodytext">&nbsp;<? echo $sdcon." ".$stcon;?></td>
										<td class="bodytext">&nbsp;<? echo $rs[5];?></td>										
									  </tr>
							 <?
							
							}
						}
						else
						{?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" colspan="3" class="bodytext"><b>No Records found</b></td>
									  </tr>
						<?
						}
					?>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td><table width="550" border="0" cellspacing="0" cellpadding="0">
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
												<a href="Studentoperation.php?curpage=<? echo $i-1;?>&next=<? echo "1" ?>&CMBEVENT=<? echo $_REQUEST['CMBEVENT'] ?>&TXSTARTDATE=<? echo $_REQUEST['TXSTARTDATE'] ?>&TXENDDATE=<? echo $_REQUEST['TXENDDATE'] ?>"><b><? echo $i;?></b></a>
											 <?
												}									
											 }}?>&nbsp;&nbsp;</div>
							  </td>
                              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
	           <? }
			  ?>
			
			</form></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      <? include "includebottom.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="30" border="0" alt=""></td>
  </tr>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
