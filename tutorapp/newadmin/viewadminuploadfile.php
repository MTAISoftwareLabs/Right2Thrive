<?php
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
	if(
	$_FILES['TXFILE']['type'] == "application/x-shockwave-flash" || 
	$_FILES['TXFILE']['type'] == "image/jpeg" || 
	$_FILES['TXFILE']['type'] == "application/msword" || 
	$_FILES['TXFILE']['type']=="application/pdf" || 
	$_FILES['TXFILE']['type']== "image/gif" || 
	$_FILES['TXFILE']['type']== "application/octet-stream" || 
	$_FILES['TXFILE']['type']== "application/vnd.ms-powerpoint" ||
	$_FILES['TXFILE']['type']== "application/vnd.ms-excel" ||
	$_FILES['TXFILE']['type']== "video/avi" ||
	$_FILES['TXFILE']['type']== "video/mpeg"){

		$sec = $_POST['section'];
		$fname = $_FILES['TXFILE']['name'];
		$ins = "insert into cpo_uploadfilesadmin (vsection,vFilePath,vUploadDate) values ('".$sec."','".$fname."','".date("Y-m-d")."')";
		runquery1($ins);
		$ext = substr(strrchr($_FILES['TXFILE']['name'], '.'), 1);
		$filename = mysqli_insert_id().".".$ext;

		$uploaddir = $_SERVER[DOCUMENT_ROOT].'/newadmin/adminupload/';
		//echo "<pre>"; print_r($_FILES); exit;
		//$uploaddir = '/home/careerp/public_html/admin/adminupload/';
		//echo $_FILES['FLUPFILE']['tmp_name']; exit;
		$uploadfile = $uploaddir.mysqli_insert_id().".".$ext;
		//echo $uploadfile;exit;
		if(move_uploaded_file($_FILES['TXFILE']['tmp_name'],$uploadfile))
		{	
			$upload = "File Uploaded Successfully !";
		}
		else
		{
			$upload = "Here is some more debugging info:";
			print_r($_FILES);
		}
	}
	else
	{
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
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return NEWADMIN_LMS_FILES_BASE . "/images/swf.gif";
			break;
		case "doc" : 
			return NEWADMIN_LMS_FILES_BASE . "/images/doc.gif";
			break;			
		case "jpg" : 
			return NEWADMIN_LMS_FILES_BASE . "/images/jpg.gif";
			break;			
		case "peg" : 
			return NEWADMIN_LMS_FILES_BASE . "/images/jpg.gif";
			break;			
		case "gif" : 
			return NEWADMIN_LMS_FILES_BASE . "/images/gif.gif";
			break;
		case "xls" : 
			return NEWADMIN_LMS_FILES_BASE . "/images/xls.gif";								
			break;
		case "pdf" : 
			return NEWADMIN_LMS_FILES_BASE . "/images/pdf.gif";								
			break;
		case "ppt" : 
			return NEWADMIN_LMS_FILES_BASE . "/images/ppt.gif";								
			break;
		case "avi" : 
			return "../tms/images/avi.gif";								
			break;
		case "mpg" : 
			return "../tms/images/mpeg.gif";								
			break;
		default : 
			return NEWADMIN_LMS_FILES_BASE . "/images/gif.gif";				
			break;			
	}
}
	if($getct=='')						  
	{
		$sql="select * from cpo_uploadfilesadmin";
	}	
	else
	{
		$sql="select * from cpo_uploadfilesadmin where vsection='".$getct."' order by vUploadDate";	
	}
    $rID=runquery1($sql);
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
<html>
<head>
<title>Admin Uploaded File</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function getsearch()
{
	ct=document.FRMUPLOAD.CMBLEARNER.value;	
	document.FRMUPLOAD.action ='viewadminuploadfile.php?ct='+ct;
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
			document.FRMUPLOAD.action ='viewadminuploadfile.php?next=1&curpage='+cpage+'&ct='+ct;
		else
			document.FRMUPLOAD.action ='viewadminuploadfile.php?next=1&curpage='+cpage;		
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
}</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" >
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
  <form name="FRMUPLOAD" method="post" action="deleteadminuploadfile.php?curpage=<?php echo $curpage; ?>" enctype="multipart/form-data" onSubmit="return validation();">	
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Admin Uploaded File Admin</td>
          </tr>
          <tr>
            <td class="graydotline">&nbsp;</td>
          </tr>
          <tr>
            <td height="30px;"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                         <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
						<td width="25%" align="center" class="midtabgreen">Uploaded Files</td>
						<td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center"></td>
                        <td width="0%" align="left"></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center"></td>
                        <td width="0%" align="left"></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center" ></td>
                        <td width="0%" align="left"></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                  <tr>
                                    <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                        <tr>
                                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td class="toheaderbg" colspan="3">Add Admin Uploaded Files</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        
                                            <tr> 
                  <td width="46%" colspan="2" height="30"  align="right">&nbsp;Upload File&nbsp;&nbsp;</td>
                  <td width="54%" colspan="4">&nbsp;&nbsp; <input type="file" name="TXFILE" class="textbox"></td>
                </tr>
                <tr> 
                  <td  align="right" colspan="2" height="30">&nbsp;Section&nbsp;&nbsp;</td>
                  <td colspan="4">&nbsp;&nbsp; <select name="section" class="bodytext">
                      <option value="l">LMS</option>
                      <option value="t">TMS</option>
                      <option value="b">Both</option>
                    </select> &nbsp;&nbsp;<img style="cursor:hand" src="images/upload.gif" onClick="uploaddfile(<?php echo $curpage?>,'<?php echo $getct;?>')" align="absmiddle">	
                  </td>
                </tr>
                <tr> 
                  <td colspan="6" align="center" height="20"><font color="red">(Only *.pdf, *.doc, *.xls, *.ppt, *.swf, *.gif, *.jpeg, *.avi, *.mpeg files can upload)</font></td>
                </tr>
				<?phpif($upload){?>
				<tr> 
                  <td colspan="6" align="center">&nbsp;<?php echo $upload;?></td>
                </tr>
				<?php}?>
                <tr> 
                  <td colspan="6" class="whittd">&nbsp;</td>
                </tr>
				<tr> 
                  <td colspan="6" align="center" class="whittd">Select Section&nbsp;<select name="CMBLEARNER" class="textbox">
												<option value="" selected>ALL</option>
												<?phpif($getct=='l') echo "<option value='l' selected>LMS</option>"; else echo "<option value='l'>LMS</option>";?>
												<?phpif($getct=='t') echo "<option value='t' selected>TMS</option>"; else echo "<option value='t'>TMS</option>";?>
												<?phpif($getct=='b') echo "<option value='b' selected>TMS</option>"; else echo "<option value='b'>Both</option>";?>
											  </select>&nbsp;&nbsp;<img src="images/search.gif"  style="cursor:hand" onClick="javascript:getsearch();" align="absmiddle"></td>
                </tr>
				<tr> 
                  <td height="15">&nbsp;</td>
                </tr>
				<tr>
				  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td class="toheaderbg">List Admin Uploaded Files</td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
                  <td width="5%" height="15" align="center"  class="lighttd2"></td>
                  <td width="34%" height="25"  class="lighttd2"><b>File Name</b> 
                  </td>
                  <td width="16%"  class="lighttd2" align="left"><b>Type</b></td>
                  <td width="15%" height="10"  class="lighttd2"><b>Section</b> 
                  </td>
                  <td width="16%" height="25"  class="lighttd2"><b>Upload Date</b> 
                  </td>
                  <td width="14%"  class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
				 <?php if($num >0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
                      $ext = substr(strrchr($rs['vFilePath'], '.'), 1);
					  $path = "adminupload/".$rs['iFileId'].".".$ext;
                    ?>
                <tr height="28" class="whittd"> 
                  <td height="20" align="center"> <input type="checkbox" name=cbo<?phpecho $cnt;?>> 
                    <input type="hidden" name="hb<?php echo $cnt;?>" value=<?php echo $rs['iFileId'];?>>
					<input type="hidden" name="he<?php echo $cnt;?>" value=<?php echo $ext;?>>
                  </td>
                  <td align="left" class="bodytext"><a target="_blank" href="<?php echo $path?>"><?php echo $rs['vFilePath'];?></a> 
                  </td>
                  <td class="bodytext" align="left"><img border="0" src="<?php echo getIcon($rs['vFilePath'])?>"></td>
                  <td align="left" class="bodytext"><a target="_blank" href="<?php echo $path?>"> 
                    <?php if($rs['vsection']=='l') 
								  		echo 'LMS'; 
									 elseif($rs['vsection']=='t')
									 	echo 'TMS'; 
									 else 
									 	echo 'LMS & TMS'; 										
								  ?>
                    </a> </td>
                  <td align="left" class="bodytext"><a target="_blank" href="<?php echo $path?>"><?php echo gdate($rs['vUploadDate']);?></a> 
                  </td>
                  <td width="14%" align=left ><div align="center"><a href="deleteadminuploadfile.php?id=<?phpecho $rs['iFileId'];?>&curpage=<?phpecho $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
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
                  <td height="30" colspan="2" align=left style="padding-left:15px"><input name="image" type="image" src="images/delete1.gif"> 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  <td align=left>&nbsp;</td>
                  <td align=left></td>
                  <td align=left>&nbsp;</td>
                </tr>
                 <?php
				  }
				  else
				  { ?>
                <tr class="whittd"> 
                              <td align="center" height="35" colspan="7"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="7" align="center" class="error" height="28">No Files Found</td>
					</tr>	
                <?php
				  }
			?>
			
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="20" colspan="6"> 
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
                    <a href="viewadminuploadfile.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a> 
                    <?php
												}									
											 }}?>
                    &nbsp;&nbsp;</td>
                </tr>
                <?php
					if ($getct == '')
					{
						$getct = 0;
					}
				?>
                <?php
					if ($upload <> "")
					{ ?>
                <?php }
				?>
										
								
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="0%"><img src="images/green_left_corn.gif" /></td>
                        <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                        <td width="0%"><img src="images/green_right_corn.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>
