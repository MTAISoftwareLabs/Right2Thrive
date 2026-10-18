<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
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
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d/m/Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}
$sql="SELECT * FROM cpo_bookchattime order by StartApprovalDateTime desc";
$rID=runquery1( $sql);
$count = mysqli_num_rows($rID);
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
$rID=runquery($sql);
$num = $rID ? mysqli_num_rows($rID) : 0 ;
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>List Chat Time Booking</title>
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function openwin(obj)
{
	new1=window.open("Detail_Chating.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function open_chat_history(obj)
{
	new1=window.open("../chatnew/download.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
}
function display(sid)
{
	window.open("studentinfo.php?sid="+sid,null,"width=700,height=500,scrollbars=yes");
}
</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="FRMCHAT" method="post" action="deletechat.php?curpage=<?php echo $curpage; ?>" onSubmit="return validation()">		
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td align="left" class="schoolfont">Chat Time Booking Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=chat" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewchat.php" class="greendeactfont">Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">List</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"></td>
    <td width="25%" align="center"></td>
    <td width="0%" align="left"></td>
	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr ><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr > 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
												<tr><td height="15"></td></tr>
																
																			<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a>&nbsp;&nbsp;</td>
							</tr>
							<tr><td height="15"></td></tr>				
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">List Chat Time Booking</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr > 
                  <td align='right' class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr> 
                              						<td width="8%" height="32" align="center" class="lighttd"><strong>Sr No.</strong></td>
                              						<td width="30%" height="32" align="left" class="lighttd"><strong>Tutor Name<br></strong></td>
                                                    <td width="30%" height="32" align="left" class="lighttd"><strong>Learner Name<br></strong></td>
													<td width="30%" height="32" align="left" class="lighttd"><strong>View Chat<br></strong></td>
                            					</tr>
                               <?php	
	if($curpage!=0)
	{
		$counter = ($curpage*page_size)+1;
	}else
	{
		$counter = 1;
	}
	$num = mysqli_num_rows($rID);
	if($num > 0)
	{
		while($rs = mysqli_fetch_array($rID))
		{
						$tutorname = "";
						$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rs[2];
						$rstutor = runquery($sqltutor);
						$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rstutor);
							$tutorname = $rsdata[0];
						}

						$stuname = "";
						$sqlstu = "select vUserName from cpo_usermaster where iUserId=".$rs[1];
						$rsstu = runquery($sqlstu);
						$num1 = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rsstu);
							$stuname = $rsdata[0];
						}

						$subname = "";
						$sqlsub = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rs[3];
						$rssub = runquery($sqlsub);
						$num1 = $rssub ? mysqli_num_rows($rssub) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rssub);
							$subname = $rsdata[0];
						}
						?>
                <tr class="whittd"> 
                              <td align="center" class="bodytext" height="28"><?php echo $counter; ?> 
                              </td>
                              <td align="left" class="bodytext"><a href="#" onClick="javascript:openwin(<?php echo $rs[0] ?>)"><?php echo $tutorname; ?></a></td>
                             
                              <td align="left" class="bodytext"><a href="#" onClick="javascript:openwin(<?php echo $rs[0] ?>)"><?php echo $stuname; ?></a>
							  
                              <td align="left" class="bodytext">
							  	<?php
								if($rs[7]<date('Y-m-d G:i:s') && $rs[7]!='')
								{?>
								  <a href="javascript:open_chat_history('<?php echo $rs[0];?>');"><img src="images/view.gif" alt="View Chat" border="0"></a>
								<?php }
								?>
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
                              <td align="center" height="35" colspan="7"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="7" align="center" class="error" height="28">No Chat Information Found</td>
					</tr>	
				  <?php
				  }
			?>
                           
                          </table></td></tr >
				
									
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
												<a href="./listchat.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
									
							
							
    															
</table></td>
											</tr >
        						</table>
						</td>
    			
				</tr >
      </table></td></tr >
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table></td ></tr >
</table>
</td >
  </tr>
</table>
		

	</td>
  </tr>
</table>
</form>
</body>
</html>
