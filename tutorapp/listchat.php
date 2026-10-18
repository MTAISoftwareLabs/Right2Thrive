<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset(cleancode($_GET['ct']))?cleancode($_GET['ct']):'';
?>
<?
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?
} 
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d/m/Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}

?>
<html>
<head>
<link href="./adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript">
function openwin(obj)
{
	new1=window.open("Detail_Chating.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function open_chat_history(obj)
{
	new1=window.open("../chatnew/download.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function display(sid)
{
	window.open("studentinfo.php?sid="+sid,null,"width=700,height=500,scrollbars=yes");
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
<?
	$sql="SELECT * FROM cpo_bookchattime order by StartApprovalDateTime desc";
    $rID=runquery1( $sql);
	$count = mysqli_num_rows($rID);
	/*Paging Code*/
									  $page=Ceil($count/page_size);
									  if(isset($_GET['curpage']))
									  {
									  	$curpage = cleancode($_GET['curpage']);
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
//									  echo $sql;
									  $num = $rID ? mysqli_num_rows($rID) : 0 ;
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect">

<table width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td>
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
					<td><h3><b>Chat Time Booking Admin</b></h3></td>
				</tr>
				<tr> 
					<td> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
					<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=chat">Overview</a></div></td>
                  <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewchat.php">Delete</a></div></td>
                  <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
                  <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">List </div></td>
                  <td width="1%"><div align="right"><img src="images/active_last.jpg" width="11" height="23"></div></td>
                  <td width="45%" background="images/middle_last.jpg"><div align="right"></div></td>
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
								<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="2">
									<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr> 
											<td width="100%">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
														
                            <td width="661" class="headingtd" colspan="2">&nbsp;List 
                              of Chat Time Booking</td>
														<!--<td width="427" class="headingtd" align="right">&nbsp;</td>-->
														<td width="342" class="headingtd"><div align="right"><img height=20 src="./images/img_header_gradient.jpg" width=147></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td height="22"><div align="right">
                          					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            					<tr class="table"> 
                              						<td width="8%" height="32" align="center" class="lighttd"><strong>Sr No.</strong></td>
                              						<td width="30%" height="32" align="left" class="lighttd"><strong>Tutor Name<br></strong></td>
                                                    <td width="30%" height="32" align="left" class="lighttd"><strong>Learner Name<br></strong></td>
													<td width="30%" height="32" align="left" class="lighttd"><strong>View Chat<br></strong></td>
                            					</tr>
                            <?	
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
                              <td align="center" class="bodytext" height="28"><? echo $counter; ?> 
                              </td>
                              <td align="left" class="bodytext"><a href="#" onClick="javascript:openwin(<? echo $rs[0] ?>)"><? echo $tutorname; ?></a></td>
                             
                              <td align="left" class="bodytext"><a href="#" onClick="javascript:openwin(<? echo $rs[0] ?>)"><? echo $stuname; ?></a>
							  
                              <td align="left" class="bodytext"><a href="javascript:open_chat_history(<? echo $rs[0] ?>)"><? echo $rs[7]; ?></a>                                
                              </td>
							  
                             
                            </tr>
                            <?
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
                              <td align="center" class="error" height="28" colspan="5">No Chat Information exist in database.</td>
                              <?
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
														<td width="772" class="headingtd">&nbsp;</td>
														<td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td height="22" valign="top" align="right" class="bodytext">
													<?	if($page>1){ 
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
												<a href="./listchat.php?curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
											 <?
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
</body>
</html>
