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
$userid=$_REQUEST['userid'];
$sql="SELECT * FROM cpo_usermaster where iUserId=".$userid;
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
    <td align="left"><table width="75%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="lmsusers.php" class="greendeactfont">Learning Students</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="regusers.php" class="greendeactfont">Tutors</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
   	 <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Details Of The User</td>
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
		 <?php if($count>0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
						?>		
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3"><a href="viewdetails.php?userid=<?php echo $rs['iUserId'];?>">Details Of <?php echo $rs['vUserName'];?></a> <span style="float:right;padding-right"5px;"><a href="checkhomework.php?userid=<?php echo $rs['iUserId'];?>">View HomeWork</a></td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="whittd">
	  																			
																
					<tr > 
                  <td align='right' class="bodytext" ><br/><table width="80%" border="0" cellspacing="0" cellpadding="0" class="whittd" align="center">
<tr><td width="43%" height="25"   class="lighttd2"><b>Phone Number  </b></td>
  <td width="2%"><strong>:</strong></td>
  <td width="55%"><?php echo $rs['vUserPhone'];?> </td>
</tr>
<tr><td width="43%" height="25"   class="lighttd2"><b>Registration Date  </b></td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['dUserRegDate'];?> </td></tr>
<tr><td width="43%" height="26"  class="lighttd2"><b>Birthday Date  </b></td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['dUserBirthDate'];?> </td></tr>
<tr><td width="43%" height="27" class="lighttd2"><b>Ethenticity</b></td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['vUserEthenticity'];?> </td></tr>
<tr><td height="32"  class="lighttd2"><b>User Qualification</b> </td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['TUserQualification'];?></td></tr>
<tr><td width="43%" height="26"  class="lighttd2"><b>Working Status</b></td>
  <td><strong>:</strong></td>
  <td><?php if($rs['iUserEmployed']!=''){if($rs['iUserEmployed']=='1'){echo "I am an Employe";}else if($rs['iUserEmployed']=='0'){echo "I am an UnEmploye";}}else {echo "Null";}?> </td></tr><tr><td height="32"  class="lighttd2"><b>Job Description</b> </td>
    <td><strong>:</strong></td>
    <td><?php echo $rs['vUserEmployedReason'];?></td></tr>
<tr><td height="33"  class="lighttd2"><b>Career Interests </b> </td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['TUserCareerOccupation'];?></td></tr>
<tr><td height="30"  class="lighttd2"><b>Qualifications do you want to Gain</b> </td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['TUserAchive'];?></td></tr>
<tr><td height="31"  class="lighttd2"><b>User Skills</b> </td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['TUserSkills'];?></td></tr>
<tr><td height="30"  class="lighttd2"><b>User Hobbies</b> </td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['TUserHobbies'];?></td></tr>
<?php if($rs['iUserDisability']!='' &&  $rs['iUserDisability']!=0){?>
<tr><td height="25"  class="lighttd2"><b>Disability</b> </td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['iUserDisability'];?></td></tr>
<tr><td height="25"  class="lighttd2"><b>Reason</b> </td>
  <td><strong>:</strong></td>
  <td><?php echo $rs['TUserDisabilityReason'];?></td></tr><?php }?>                						
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="8"> <div align="center"></div></td>
                </tr>
          
                
                <?php
			            $cnt=$cnt+1;
					}
					?>
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
