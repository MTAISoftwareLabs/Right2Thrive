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

$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<html>
<head>
<title>List Third Party-Learner</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript">
function getselected(val,obj)
{
	if(val != "")
	{
		for(i=obj.length-1;i>=0;i--)
		{
			if(obj.options[i].value==val)
			{
				obj.options[i].selected=true;
			}
		}
	}
	else
	{
		obj.options[0].selected=true;
	}
}
function getsearch()
{
		
	ct=document.listtpl.cmbcategory.value;	
	document.listtpl.action ='listtpl.php?ct='+ct;
	document.listtpl.submit();
}
function goto($cur)
{
	//getselectedval();
		
	ct=document.listtpl.cmbcategory.value;	
	document.listtpl.action = 'listtpl.php?ct='+ct+'&curpage='+$cur;
	document.listtpl.submit();
}
</script>

</head>
<?php

	if($getct=='')						  
	{
		$sqlspn = "select * from cpo_thirdpartylearner";
		
	}	
	else
	{
	
	$sqlspn = "select * from cpo_thirdpartylearner where iTId='".$getct."'";
	//echo $sqlspn;
	//die();
	}
		//echo $sqlspn;
	//die();
	$result = runquery1($sqlspn) or die('could not execute'.mysqli_error());
	if($result)
	{	
		$count = mysqli_num_rows($result);
		$page=Ceil($count/page_size);
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by iTId  Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by iTId  Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by iTId Limit 0,".page_size;
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
    <td align="left" class="schoolfont">Third Party - Learner Admin</td>
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
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tpl" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addtpl.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtpl.php" class="greendeactfont">Edit / Delete</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">List Third Party - Learner</td>
																								
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
                              <td width="7%" height="32" align="center" class="lighttd2"> 
                                <div align="center"><strong>Sr No.<br>
                                  </strong> </div></td>
                              <td width="46%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Third 
                                    Party Name<br>
                                  </strong> </div></td>
							<td width="47%" height="32" align="left" class="lighttd2"><div align="Left"><strong> 
                                    Learner Names<br>
                                  </strong> </div></td>
                             
                              
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
                              <td align="left" class="bodytext"><?php
							  		$sql1="select vUserName from cpo_usermaster where iUserId = '".$rslist["iTId"]."'";
									
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
									if ($num > 0)
									{
									$name=mysqli_result($result1,0,0);
							  							
									
									 echo $name;
									 } ?></td>
                              
									 <td align="left" class="bodytext">
									 <?php
									 	if($rslist["vLearnerIds"]==-2)
										{
											echo "ALL SUBJECT";
										}
										else
										{
									 					$id=explode(",", $rslist["vLearnerIds"]);
														
														$str="";
														for($i=0;$i<count($id);$i++)
														{
																	$sql2="select vUserName from cpo_usermaster where iUserId = '".$id[$i]."'";
															
                            
							  									$result2=runquery1($sql2) or die('could not execute query'.mysqli_error());
																$num = $result2 ? mysqli_num_rows($result2) : 0;
																if ($num > 0)
																{
																	$name=mysqli_result($result2,0,0);
																
																if ($i%3 == 0 && $i != 0)
																{?>
																<br>
																<?php }
																echo $name."  ";}
														}
															
										}
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
                              <td align="center" height="35" colspan="3"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd">
                              <td align="center" class="error" height="28" colspan="3">No Third Party - Learner Information Found</td>
                              <?php
}
?>
                            </tr>
                          </table></td></tr>
				<tr> 
              
											<td height="22" valign="top"> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													
												</table>
											</td>
										</tr>
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
												<a href="./listtpl.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
