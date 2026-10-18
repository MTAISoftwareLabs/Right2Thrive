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
$sql="SELECT * FROM cpo_usermaster where iUserType=1";
$rID=runquery1( $sql);
$count = mysqli_num_rows($rID);
/*Paging Code*/
$page=Ceil($count/page_size);
if(isset($_GET['curpage']))
{
	$curpage = $_GET['curpage'];
	if($curpage==0)
	{
		$sql.=" order by iUserId Limit 0,".page_size;
		
	}
	else
	{
	$current=page_size*($curpage);
	$sql.=" order by iUserId Limit " .$current. ",".page_size;
	}
}
else
{
	$sql.=" order by iUserId Limit 0,".page_size;
	$curpage=0;
}
$rID=runquery1($sql);
$count=mysqli_num_rows($rID);
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Registerd Users</title>
<script language="JavaScript">
function sub1(ob)
{
	document.frmhomework.action="viewhomework.php?active=1&curpage="+ob;
	document.frmhomework.submit();
}

</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="frmhomework" method="post" action="deletehomework.php?curpage=<?php echo $curpage; ?>" onSubmit="return validation();">
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
    <td align="left" class="schoolfont">Registered Members </td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="lmsusers.php" class="greendeactfont">Learning Students</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Tutors</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
		</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr ><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr > 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">Tutor Users</td>
																								
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
                  <td width="14%" height="15" align="center"  class="lighttd2"><b>Name</b></td>
                  <td height="25"  class="lighttd2"><b>Password</b> </td>
                  <td height="25"  class="lighttd2"><b>Gender</b> </td>				  
				   <td height="25"  class="lighttd2"><b>Address</b> </td>
				   <td height="25"  class="lighttd2"><b>Country</b></td>
				   <td height="25"  class="lighttd2"><b>Mobile</b></td>				   
                   <td width="12%" align="center"  class="lighttd2"><strong>E-Mail</strong></div></td>
				   <td height="25"  class="lighttd2"><b> Details</b></td>				   
                </tr>
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="7"> <div align="center"></div></td>
                </tr>
                <?php if($count>0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
						?>
                <tr class="whittd"> 
                  <td align="center" ><?php echo $rs['vUserName'];?></td>
                  <td width="13%" height="30" align="left"><?php echo $rs['vUserPassword'];?></td>
				    <td width="13%" height="30" align="left"><?php if($rs['iUserGender']!=''){if($rs['iUserGender']=='1'){echo "Male";}else if($rs['iUserGender']=='0'){echo "Female";}}else{echo "Null";}?></td>
				    <td width="17%" height="30" align="left"> <?php echo $rs['vUserAddress'];if($rs['vUserPostCode']!=''){echo "-".$rs['vUserPostCode'];}?>        </td>
					<td width="15%" height="30" align="left"><?php echo $rs['vUserCountry'];?>	</td>
				    <td width="16%" height="30" align="left" ><?php echo $rs['vUserMobile'];?>      </td> 
                  <td width="12%" align="left" ><?php echo $rs['vUserEmailId'];?></td>
  				  <td width="13%" height="30" align="center" ><a href="viewdetails.php?userid=<?php echo $rs['iUserId'];?>">Details</a>          </td> 
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="8"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="8" height="1" ></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="8"  >&nbsp;</td>
				</tr> 
                
                <tr > 
                  <td height="30" align="left"  style="padding-left:40px"></td>
                  <td align=left colspan="5" >&nbsp;</td>
                  <td align=left></td>
                  <td align=left>&nbsp;</td>
                </tr>
				<?php
				  }
				  else
				  { ?>
				  	 <tr class="whittd"> 
                              <td align="center" height="35" colspan="8"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="8" align="center" class="error" height="28">No Users Found</td>
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
												<a href="./viewcourse.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
