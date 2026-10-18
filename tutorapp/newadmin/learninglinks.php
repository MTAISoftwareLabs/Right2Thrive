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
$sql="SELECT * FROM cpo_resources_links";
$rID=runquery1($sql);
$count = mysqli_num_rows($rID);
//echo $count;
//$rID=runquery1($sql);
//$count=mysqli_num_rows($rID);
$a=$_GET['active'];
if ($a!='' && $a!='0'){
$act="update cpo_resources_links";
$acti=runquery1($act);
}
$act=$_REQUEST['act'];
if($act=="del"){
$did=$_REQUEST['id'];
mysqli_query("delete from cpo_resources_links where link_id='$did'");
header("location:learninglinks.php");
}
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Learning Resources</title>
<script language="JavaScript">
function sub1(ob)
{
	document.frmhomework.action="viewhomework.php?active=1&curpage="+ob;
	document.frmhomework.submit();
}
function validations(){
var regex =/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(([0-9]{1,5})?\/.*)?$/;
if(document.links.websitename.value==""){
alert('Please Enter The Website Name');
document.links.websitename.focus();
return false;
}
if (!regex.test(document.links.websitelink.value)){
				 alert("Invalid Website Link ex:http://www.domainname.com");
			 	document.links.websitelink.focus();
				 return false;
 }	

}
</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
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
    <td align="left" class="schoolfont">Learning Resources </td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
		<?php $a=$_REQUEST['act'];
	if($act=="add"){?>
	  <tr>
   	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="learninglinks.php" class="greendeactfont">Learning Resources</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add Resource Link</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	</tr>	
	<?php }else{?>
  <tr>
   	 <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Learning Resources </td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="learninglinks.php?act=add" class="greendeactfont">Add Resource Link</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	</tr>
<?php }?>
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
																								
																								
                            <td class="toheaderbg" colspan="3"> <span class="schoolfont">Learning Resources Links</span> </td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            								 	<td align="center" >

												
												
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">															
																
					<tr > 
                  <td align='right' class="bodytext" >
				  					<?php 
$action=$_REQUEST['act'];
if($action=="add"){
if($_POST['submit']!=''){
extract($_POST);
$q="insert into cpo_resources_links (link_name,website_link) values ('$websitename','$websitelink')";
mysqli_query($q);
header("location:learninglinks.php");
}
?>
<form name="links" method="post" onSubmit="return validations();">
<table width="64%" border="0" align="center" class="bodytext">
  <tr>
    <td>Website Name</td>
    <td><input name="websitename" type="text" size="25"></td>
  </tr>
  <tr>
    <td>Website Link</td>
    <td><input name="websitelink" type="text" value="http://" size="30"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td>    
  </tr>
</table>
</form>
<?php }
else if($action=="edit"){
if($_POST['update']!=''){
$lid=$_REQUEST['id'];
extract($_POST);
$q="update cpo_resources_links set link_name='$websitename',website_link='$websitelink' where link_id='$lid'";
mysqli_query($q);
header("location:learninglinks.php");
}
$lid=$_REQUEST['id'];
$edit="select * from cpo_resources_links where link_id='$lid'";
$ed=runquery1($edit);
$e=mysqli_fetch_array($ed);
?>
<form name="links" method="post">
<table width="64%" border="0" align="center" class="bodytext">
  <tr>
    <td>Website Name</td>
    <td><input name="websitename" type="text" size="25" value="<?php echo $e['link_name'];?>"></td>
  </tr>
  <tr>
    <td>Website Link</td>
    <td><input name="websitelink" type="text" size="30" value="<?php echo $e['website_link'];?>"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="update" value="Update"></td>    
  </tr>
</table>
</form>
<?php } else{?>					
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">				
                        <tr> 
                  <td width="14%" height="25" align="center"  class="lighttd2"><strong>Name</strong></td>
                  <td height="25" align="center"  class="lighttd2"><b>Link</b> </td>
				   <td align="center"  class="lighttd2"><strong>Action</strong></td>
                        </tr>
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="3"> <div align="center"></div></td>
                </tr>
				
            <?php if($count>0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
						?>	
                <tr class="whittd"> 
                  <td align="center" ><?php echo $rs['link_name'];?></td>
                  <td width="13%" height="30" align="center"><?php echo $rs['website_link'];?></td>
				  <td width="13%" align="center"><a href="learninglinks.php?act=edit&id=<?php echo $rs['link_id'];?>">Edit</a> / <a href="learninglinks.php?act=del&id=<?php echo $rs['link_id'];?>">Delete</a> </td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="3"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="3" height="1" ></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="3"  >&nbsp;</td>
				</tr> 
                
                <tr > 
                  <td height="30" align="left"  style="padding-left:40px"></td>
                  <td align=left >&nbsp;</td>
                  <td align=left >&nbsp;</td>
                </tr>
				<?php
				  }
				  else
				  { ?>
				  	 <tr class="whittd"> 
                              <td align="center" height="35" colspan="3"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="3" align="center" class="error" height="28">No Links Found</td>
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
											 }}}?>&nbsp;&nbsp;&nbsp;&nbsp;
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
</body>
</html>
