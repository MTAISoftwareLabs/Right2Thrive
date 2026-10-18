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
$sql="SELECT * FROM cpo_bookchattime where 1=1";
if (isset($_REQUEST['CMBTUTOR']) && $_REQUEST['CMBTUTOR'] <> "0")
{
	$sql .= " and iTutorId=".$_POST['CMBTUTOR'];
}
if (isset($_REQUEST['CMBLEARNER']) && $_REQUEST['CMBLEARNER'] <> "0")
{
	$sql .= " and iUserId=".$_POST['CMBLEARNER'];
}
$sql .= " order by StartApprovalDateTime desc";
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
$rID=runquery($sql);
$num = $rID ? mysqli_num_rows($rID) : 0 ;
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Chat Time Booking</title>
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">

function openwin(obj)
{
	new1=window.open("Detail_Chating.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function submitpage()
{
	document.FRMCHAT.action = "viewchat.php";
	document.FRMCHAT.submit();
}
function disppage(page)
{
	document.FRMCHAT.action = "viewchat.php?curpage="+page;
	document.FRMCHAT.submit();
}
function validation()
{
	var len=document.all.length;
	var flag = 0;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox" && document.all(i).id==1)
		{
			if (document.all(i).checked == true)
			{
				flag = 1;
			}
		}
	}
	if (flag == 0)
	{
		alert("First Select Item !");
		return false;
	}	
	return true;
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
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listchat.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
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
            <td class="bodytext" align="center">&nbsp;Select Tutor&nbsp; 
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_bookchattime uc where um.iUserId =uc.iTutorId order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select name="CMBTUTOR" class="textbox">
					<option value="0">Select Tutor</option>
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor[1]?>" <?php if (isset($_POST['CMBTUTOR']) && $_POST['CMBTUTOR'] == $rstutor[1]) {?> selected <?php }?>><?php echo $rstutor[0]?></option>
					<?php }
				?>
				</select>
              Select Learner&nbsp;&nbsp; 
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_bookchattime uc where um.iUserId=uc.iUserId order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select class="textbox" name="CMBLEARNER">
				<option value="0">Select Learner</option>				
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor[1]?>" <?php if (isset($_POST['CMBLEARNER']) && $_POST['CMBLEARNER'] == $rstutor[1]) {?> selected <?php }?>><?php echo $rstutor[0]?></option>
					<?php }
				?>				

				</select>&nbsp;&nbsp;
				<img src="./images/search.gif" style="cursor:hand" onClick="submitpage();" align="absmiddle">
			</td>
           
          </tr>		
		  								<tr><td height="15"></td></tr>		
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">Delete Chat Time Booking</td>
																								
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
                  <td width="5%" height="32" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td width="18%" class="lighttd2"><b>Tutor </b></td>
                  <td width="18%" class="lighttd2"><b>Learner</b></td> 
				  <td width="18%" class="lighttd2"><b>Booking Time</b></td>  
                  <td width="18%" class="lighttd2"><b>Chat Start Time</b></td>
                  <td width="18%" class="lighttd2"><b>Chat End Time</b></td>                    
                  <td width="7%" align="center" class="lighttd2"><b>Delete</b></td>
                </tr>
                               <?php if($num)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_row($rID))
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
						 $sdt=explode(" ",$rs[3]); 
						 $sddt=explode("-",$sdt[0]);
						 $stdt=explode(":",$sdt[1]);
														
						$sdcon=$sddt[2]."/".$sddt[1]."/".$sddt[0];
						$stcon=$stdt[0].":".$stdt[1].":".$stdt[2];
						if($rs[8]==1)
						{
						
						$sdt1=explode(" ",$rs[6]); 
						 $sddt1=explode("-",$sdt1[0]);
						 $stdt1=explode(":",$sdt1[1]);
														
						$sdcon1=$sddt1[2]."/".$sddt1[1]."/".$sddt1[0];
						$stcon1=$stdt1[0].":".$stdt1[1].":".$stdt1[2];
						
						$sdt2=explode(" ",$rs[7]); 
						 $sddt2=explode("-",$sdt2[0]);
						 $stdt2=explode(":",$sdt2[1]);
														
						$sdcon2=$sddt2[2]."/".$sddt2[1]."/".$sddt2[0];
						$stcon2=$stdt2[0].":".$stdt2[1].":".$stdt2[2];
						}?>
                <tr class="whittd"> 
                <td align="center" height="28"> <input type="checkbox" id="1" name="cbo<?php echo $cnt;?>"><input type="hidden" name="hb<?php echo $cnt;?>" value=<?php echo $rs[0];?>></td>
                <td><a href="#" onClick="javascript:openwin(<?php echo $rs[0] ?>)"><?php echo $tutorname; ?></a></td>
                <td><a href="#" onClick="javascript:openwin(<?php echo $rs[0] ?>)"><?php echo $stuname;?></a></td>
				<td><a href="#" onClick="javascript:openwin(<?php echo $rs[0] ?>)"><?php echo $sdcon." ".$stcon;?></a></td>
				<td><a href="#" onClick="javascript:openwin(<?php echo $rs[0] ?>)"><?php if($rs[8]==1)
																					{ echo $sdcon1." ".$stcon1;
																					}?></a></td>
				<td><a href="#" onClick="javascript:openwin(<?php echo $rs[0] ?>)"><?php if($rs[8]==1)
																					{ echo $sdcon2." ".$stcon2;
																					}?></a></td>
                <td align="center"><a href="deletechat.php?id=<?php echo $rs[0];?>&curpage=<?php echo $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                
                 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="7"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="7" height="1" ></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="7"  >&nbsp;</td>
				</tr>
                <tr > 
                  <td height="30" colspan="2"><input name="image" type="image" src="images/delete1.gif" ><input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                 <td colspan="7">&nbsp;</td>
                </tr>
				<?php
				  }
				  else
				  { ?>
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
												<a href="./viewchat.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
