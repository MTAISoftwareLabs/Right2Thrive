<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
$upload = "";
if (isset($_GET['next']))
{
	if ($_FILES['TXFILE']['type'] == "application/pdf")
	{
		move_uploaded_file($_FILES['TXFILE']['tmp_name'],"../CareerPathsIntroductionHandbook.pdf");	
		$upload = "File Uploaded Successfully !";
	}
	else
	{
//		$upload = "Only pdf file allowed !";		
		$upload = "";		
	}
}
$getct = isset($_GET['ct'])?$_GET['ct']:'';
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d-m-Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}
if($getct=='')						  
	{
		$sql="select uf.*,um.vUserName from cpo_uploadfiles uf,cpo_usermaster um where um.iUserId=uf.iUserId order by um.vUserName";
	}	
	else
	{
		$sql="select uf.*,um.vUserName from cpo_uploadfiles uf,cpo_usermaster um where um.iUserId=uf.iUserId and uf.iUserId=".$getct." order by um.vUserName";	
	}
    $rID=runquery1( $sql);
	$count = mysqli_num_rows($rID);
	
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
$rID=runquery1( $sql);
$num = $rID ? mysqli_num_rows($rID) : 0 ;															  
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Upload Files</title>
<script language="JavaScript" src="txteditor.js"></script>
<script language="JavaScript">
function getsearch()
{
	ct=document.FRMUPLOAD.CMBLEARNER.value;	
	document.FRMUPLOAD.action ='viewuploadfile.php?ct='+ct;
	document.FRMUPLOAD.submit();
}
function uploaddfile(cpage,ct)
{
	if (document.FRMUPLOAD.TXFILE.value == "")
	{
		alert("First select file !")
		return false;
	}
	else
	{
		if (ct != 0)
			document.FRMUPLOAD.action ='viewuploadfile.php?next=1&curpage='+cpage+'&ct='+ct;
		else
			document.FRMUPLOAD.action ='viewuploadfile.php?next=1&curpage='+cpage;		
		document.FRMUPLOAD.submit();
	}	
}
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
function validation()
{
	var len=document.all.length;
	var flag = 0;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox")
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
function checkall()
{
	var len=document.all.length;
	var chkname;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox")
		{
			chkname=document.all(i).name;
			if(document.getElementById("visibility").checked)
			{
				if(document.all(i).name=="visibility")
				{
					document.all(i).checked=true;
				}
				else
				{
					document.all(i).checked=true;
				}
			}
			else
			{
				if(document.all(i).name=="visibility")
				{
					document.all(i).checked=false;
				}
				else
				{
					document.all(i).checked=false;
				}
			}
		}
	}	
}
</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="FRMUPLOAD" method="post" action="deleteuploadfile.php?curpage=<?php echo $curpage; ?>" enctype="multipart/form-data" onSubmit="return validation();">	
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
    <td class="schoolfont" align="left">Upload File Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=upfiles" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listuploadfile.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"></td>
    <td width="25%" align="center" ></td>
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
            <td class="bodytext" align="center">&nbsp;Select Learner&nbsp;<select name="CMBLEARNER" class="textbox">
												<option value="" selected>ALL</option>
												<?php
						   							$fetch1="select distinct um.iUserId,um.vUserName from cpo_usermaster um,cpo_uploadfiles uf where um.iUserId=uf.iUserId";
													$result1=runquery1($fetch1);
													$count=mysqli_num_rows($result1);
							
												while($row=mysqli_fetch_array($result1))
												{
																									
												?>
						
														<option value="<?php echo $row["iUserId"];?>" <?php if ($getct == $row["iUserId"]) {?> selected <?php }?>><?php echo $row["vUserName"];?></option>
                      							<?php
												}
												?>
											  </select>&nbsp;
											  
              &nbsp;&nbsp; &nbsp;&nbsp; <img src="images/search.gif" style="cursor:hand" onClick="javascript:getsearch();" align="absmiddle">
											<input type="hidden" name="selecteditems" value="<?php if (isset($_POST['selecteditems'])){ echo $_POST['selecteditems'];}?>"> 
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
																								
																								
                            <td class="toheaderbg" colspan="3">Delete Upload Files</td>
																								
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
                  <td width="7%" height="15" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td width="21%" height="25"  class="lighttd2"><b>Learner Name</b> </td>
				    <td width="37%" height="10"  class="lighttd2"><b>File</b> </td>
					  <td width="15%" height="25"  class="lighttd2"><b>Upload Date</b> </td>
	                  <td width="20%"  class="lighttd2" align="center"><strong>Delete</strong></td>
                </tr>
                            <?php if($num >0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
                      $ext = substr(strrchr($rs['vFilePath'], '.'), 1);
						$learnername = $rs['vUserName'];
						$path = NEWADMIN_LMS_FILES_BASE . "/upload/" . $rs['iUserId'] . "/" . $rs['iFileId'] . "." . $ext;
                    	?>
                <tr height="28" class="whittd"> 
                  <td height="20" align="center"> <input type="checkbox" name=cbo<?phpecho $cnt;?>> 
                    <input type="hidden" name="hb<?php echo $cnt;?>" value=<?php echo $rs['iFileId'];?>> 
					<input type="hidden" name="hbu<?php echo $cnt;?>" value=<?php echo $rs['iUserId'];?>> 
					<input type="hidden" name="hbp<?php echo $cnt;?>" value=<?php echo $rs['vFilePath'];?>> 					
                  </td>
                 	<td align="left" class="bodytext">
                                  <?php echo $learnername; ?>
                                </td>
								<td align="left" class="bodytext">
                                  <a target="_blank" href="<?php echo $path?>"><?php echo $rs['vFilePath']; ?></a>
                                </td>
								<td align="left" class="bodytext">
                                  <?php echo gdate($rs['vUploadDate']); ?>
                                </td>
                  <td width="20%" align="center" ><a href="deleteuploadfile.php?id=<?phpecho $rs['iFileId'];?>&curpage=<?phpecho $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                
                <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="5"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="5" height="1" ></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="5"  >&nbsp;</td>
				</tr> 
                <tr > 
                  <td height="30" colspan="2" align=left><input name="image" type="image" src="images/delete1.gif" > 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  
                  <td align="left" colspan="3"></td>
                </tr>
				<?php
				  }
				  else
				  { ?>
				  	<tr class="whittd"> 
                              <td align="center" height="35" colspan="5"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="5" align="center" class="error" height="28">No Files Found</td>
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
												<a href="./viewuploadfile.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
																					
																					
				<td class="toheaderbg" colspan="3">Upload Files for Induction Pack</td>
																					
																			</tr> 
																			
																	</table>
															</td></tr>
															
															
	
											</table>
									
							</tr>
							<tr> 
									<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																			
													
		<tr > 
	  <td align='right' ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
			<?php
					if ($getct == '')
					{
						$getct = 0;
					}
				?>
				<tr><td colspan="6">&nbsp;</td></tr>
				<tr>
					<td colspan="2" align="right"> &nbsp;Upload File&nbsp;&nbsp;</td>
					<td width="63%" colspan="4">&nbsp;&nbsp;
					    <input type="file" name="TXFILE" class="textbox">&nbsp;&nbsp;<img style="cursor:hand" src="images/upload.gif" onClick="uploaddfile(<?php echo $curpage?>,<?php echo $getct;?>)" align="absmiddle"></td>
				</tr>
				<tr>
					<td colspan="6" align="center" height="20"><font color="red">Only pdf file allowed</font></td>
				</tr>

			<?php
			if ($upload <> "")
			{ ?>
				<tr><td colspan="6">&nbsp;</td></tr>									
				<tr><td colspan="6" align="center">&nbsp;<?php echo $upload;?></td></tr>									
				<tr><td colspan="6">&nbsp;</td></tr>										
			<?php }
		?>		 
			  </table></td></tr >									
	</table></td>
								</tr >
					</table>
			</td>
	
	</tr >
	</table></td>
		</tr >
  
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
