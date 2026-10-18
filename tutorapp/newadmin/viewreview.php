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
 
$sql="SELECT * FROM cpo_ind_review where 1=1";
if (isset($_POST['CMBTUTOR']) && $_POST['CMBTUTOR'] <> "0")
{
	$sql .= " and iTutorId=".$_POST['CMBTUTOR'];
}
if (isset($_POST['CMBLEARNER']) && $_POST['CMBLEARNER'] <> "0")
{
	$sql .= " and iStudentId=".$_POST['CMBLEARNER'];
}
$sql .= " order by dDate desc";
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
// echo $sql;
$num = $rID ? mysqli_num_rows($rID) : 0 ;
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>View Learner Review</title>
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function openwin(obj)
{
	new1=window.open("Detail_Chating.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function submitpage()
{
	document.FRMREVIEW.action = "viewreview.php";
	document.FRMREVIEW.submit();
}
function disppage(page)
{
	document.FRMREVIEW.action = "viewreview.php?curpage="+page;
	document.FRMREVIEW.submit();
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
<form name="FRMREVIEW" method="post" action="deletereview.php?curpage=<?php echo $curpage; ?>" onSubmit="return validation()">
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
    <td align="left" class="schoolfont">Learner Review Information Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=review" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listreview.php" class="greendeactfont">List</a></td>
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
            <td class="bodytext" align="center">&nbsp;Selelct Tutor&nbsp; 
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_ind_review uc where um.iUserId =uc.iTutorId order by um.vUserName";
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
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_ind_review uc where um.iUserId=uc.iStudentId order by um.vUserName";
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
																								
																								
                            <td class="toheaderbg" colspan="3">Delete Learner Review</td>
																								
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
                  <td width="3%" height="15" align="center"  class="lighttd2"></td>
                  <td height="25" width="30%" class="lighttd2"><b>Tutor Name</b> </td>
                  <td height="25" width="15%" class="lighttd2"><b>Learner Name</b> </td>
                  <td width="21%" class="lighttd2" align="center"><strong>Delete</strong></td>
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
						
						$path = NEWADMIN_LMS_FILES_BASE . "/review/" . $rs[0] . ".doc";
						if(!file_exists($path))
							$path = "../Individual_Learning_Plan_Review.doc";

																						
											
                    	?>
                <tr class="whittd"> 
                  <td align="center"> <input type="checkbox" id="1" name="cbo<?php echo $cnt;?>"> 
                    <input type="hidden" name="hb<?php echo $cnt;?>" value=<?php echo $rs[0];?>>
                  </td>
                  <td width="30%" height="30" align="left"><a target="_blank" href="<?php echo $path?>" title="Download Review Plan"><?php echo $tutorname; ?></a>
                  </td>
                  <td width="15%" align="left"><a target="_blank" href="<?php echo $path?>" title="Download Review Plan"><?php echo $stuname;?></a></td>
				 
				 
                  
                  <td width="21%" align=left ><div align="center"><a href="deletereview.php?id=<?php echo $rs[0];?>&curpage=<?php echo $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
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
                  <td height="30" colspan="2" align="left"><input name="image" type="image" src="images/delete1.gif" > 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  <td  colspan="3" align="left"></td>
                </tr>
				<?php
				  }
				  else
				  { ?>
				  	 <tr class="whittd"> 
                              <td align="center" height="35" colspan="7"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="7" align="center" class="error" height="28">No Learner Review Information Found</td>
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
												 <a href="javascript:disppage(<?php echo $i-1;?>)"><b><?php echo $i;?></b></a> 
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
