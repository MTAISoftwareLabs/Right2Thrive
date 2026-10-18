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
} ?>
<html>
<head>
<script language="JavaScript">
function display(sid)
{
	window.open("instituteinfo.php?sid="+sid,null,"width=700,height=300,scrollbars=yes");
}
</script>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<title>List Institute</title>
</head>
<?php
	$sqlspn = "Select * from cpo_institutemaster";
	//echo $sqlspn;
	//die();
	$result = runquery1($sqlspn) or die('could not execuate');
	if($result)
	{	
		$count = mysqli_num_rows($result);
		$page=Ceil($count/page_size);
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by vInstituteName  Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by vInstituteName Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by vInstituteName Limit 0,".page_size;
		   $curpage=0;
		}
		$result = runquery1($sqlspn);
	}
?>
<body leftmargin="0" topmargin="0" class="seffact">
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Institute Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a> &nbsp;&nbsp;</td>
							</tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=institute" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addinstitute.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewinstitute.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">List</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;List of Category</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr > 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr> 
                  <td align='right' class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class=""> 
							<td width="11%" class="lighttd2" align="center"><strong>Sr No.</strong></td>
                              <td width="36%" height="32" class="lighttd2" align=""><strong>Institute 
 Name</strong></td>
                              <td width="34%" height="32" class="lighttd2"><strong>Institute Location</strong></td>
                              <td width="19%" height="32" class="lighttd2"><strong>Status</strong></td>
                            </tr>
                            <?php	
	if($curpage!=0)
	{
		$counter = ($curpage*page_size)+1;
	}else
	{
		$counter = 1;
	}
	$num = mysqli_num_rows($result);
	if($num > 0)
	{
		while($rslist = mysqli_fetch_array($result))
		{
?>
                           <tr class="whittd">
						   <td align="center" class="bodytext" height="28"><?php echo $counter; ?> 
                              </td>
                              <td align="left" class="bodytext"><a href="javascript:display(<?php echo $rslist["iInstituteId"];?>)"><?php echo $rslist["vInstituteName"]; ?></a></td>
                              
							  <td width="34%" align="left" class="bodytext"><a href="javascript:display(<?php echo $rslist["iInstituteId"];?>)"><?php echo $rslist["vInstituteLocation"]; ?></a></td>
                              <td width="19%" align="left" class="bodytext">
                                <?php if($rslist["iStatus"]==0) 
	   									 												echo "No";
																							else
																						echo "Yes";
																						?>                              </td>
                            </tr>
                            <?php
		$counter++;
		}
	}
	else
	{			
?>
                            <tr class="whittd"> 
                              <td align="center" height="35" colspan="6"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd"> 
                              <td align="center" class="error" height="28" colspan="6">No Institute Information Found</td>
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
												<a href="./listinstitute.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
						
							
    															
</table></td>
											</tr>
        						</table>
						</td>
    			
				</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td ></tr>
</table>
</td >
  </tr>
</table>
		</form>

	</td>
  </tr>
</table>
</body>
</html>
