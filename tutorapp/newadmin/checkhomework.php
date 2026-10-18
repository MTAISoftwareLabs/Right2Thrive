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
if(isset($_POST['grade1'])){
	if($_POST['grade1'] == 'Ok'){
	$sql = "UPDATE cpo_uploadhomework SET igrade='".$_POST['grade']."', is_checked='1' WHERE id='".$_POST['homeword_id']."'";
	
	runquery1( $sql);
	}
}
 
if(isset($_GET['Action']) && $_GET['Action'] =='Download')
{
	$speed = 100;
	$export_file = "../homework/".$_REQUEST['file'];
	$file_extension = strtolower(substr(strrchr(basename($export_file),"."),1));
	if(file_exists($export_file) && is_file($export_file) )
	{
		switch( $file_extension ) {
		case "exe":$ctype="application/octet-stream";
			break;
		case "zip":$ctype="application/zip";
			break;
		case "mp3":$ctype="audio/mpeg";
			break;
		case "mpg":$ctype="video/mpeg";
			break;
		case "avi":$ctype="video/x-msvideo";
			break;
		// (sensitive stuff, like php files)
		case "doc":$ctype="application/msword";break;
		case "css":$ctype="text/plain";break;
		case "htm":$ctype="application/force-download";break;
		case "html":$ctype="application/force-download";break;
		case "txt":$ctype="application/force-download";break;
		case "jpg":$ctype="image/jpeg";break;
		case "gif":$ctype="image/gif";break;
		default:
			$ctype="application/force-download";
		}
		$filespaces = str_replace("_", " ", $export_file);
		header("Cache-Control:");
		header("Cache-Control: public");
		header("Content-Type: $ctype");
		header("Accept-Ranges: bytes");
		$size = filesize($export_file); 
		
		header("Content-Length: ".$size);
		header('Content-Disposition: attachment; filename="'.basename($filespaces).'"');
		//open the file
		$fp = fopen($export_file,"rb");
		//seek to start of missing part 
		//start buffered download
		while(!feof($fp)) {  
		//reset time limit for big file
			set_time_limit(0);    
			print(fread($fp,1024*$speed));
			flush();
			sleep(1);
		}
		fclose($fp);
		exit;
	}
	else
	{
		die("<b>404 File not found!</b>");
	}
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
			return "images/avi.gif";								
			break;
		case "mpg" : 
			return "images/mpeg.gif";								
			break;
		default : 
			return NEWADMIN_LMS_FILES_BASE . "/images/gif.gif";				
			break;			
	}
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
<title>Check Homework</title>
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
																								
																								
                            <td class="toheaderbg" colspan="3">
                            <a href="viewdetails.php?userid=<?php echo $rs['iUserId'];?>">Details Of <?php echo $rs['vUserName'];?></a> <span style="float:right;padding-right"5px;"><a href="checkhomework.php?userid=<?php echo $rs['iUserId'];?>">View HomeWork</a></td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="whittd">
	  																			
																
					<tr > 
                  <td align='right' class="bodytext" ><br/><table width="80%" border="0" cellspacing="0" cellpadding="0" class="whittd" align="center">

              						
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
				<tr><td>
				
<table width="100%">
										<tr>
											<td width="46%" height="17" class="lighttd2"><b>Subject</b></td>
											<td width="16%" class="lighttd2"><b>FileName</b></td>
											<td width="16%" class="lighttd2"><b>Type</b></td>
<td width="16%" class="lighttd2"><b>Checked</b></td>
<td width="16%" class="lighttd2">&nbsp;</td>
<td width="16%" class="lighttd2"><b>Grade</b></td>
<td width="16%" class="lighttd2"><b>Submission time</b></td>
										</tr>
										<?php
										if($getct !='')
										{
										$sqls = "select I_tutorid from cpo_user_subject where I_studentid=".$user_id." and I_subjectid=".$getct;
										}
										else
										{
											$sqls = "select I_tutorid,I_subjectid from cpo_user_subject where I_studentid=".$user_id;
										}
										$ress = runquery1($sqls);
										$nums = mysqli_num_rows($ress);
										if($nums)
										{
											$exist = 0;
											while($rows = mysqli_fetch_array($ress))
											{
												if($getct !='')
												{
													$sqlf = "select h.* ,s.vSubjectName  from cpo_subjectmaster s,cpo_uploadhomework as h where (h.istudent_id=".$user_id." || h.itutor_id=".$rows['I_tutorid'].") and h.isubject_id=".$getct." and s.iSubjectId=".$getct;
												}
												else
												{
													$sqlf = "select h.* ,s.vSubjectName  from cpo_subjectmaster s,cpo_uploadhomework as h where (h.istudent_id=".$user_id." || h.itutor_id=".$rows['I_tutorid'].") and h.isubject_id=".$rows['I_subjectid']." and s.iSubjectId=".$rows['I_subjectid'];
												}
												$resf = runquery1($sqlf);
												$counthu = mysqli_num_rows($resf);
												if($counthu >0 )
												{
													$page=Ceil($counthu/page_size);
													if(isset($_GET['curpage']))
													{
														$curpage = $_GET['curpage'];
														if($curpage==0)
														{
															 $sqlf.=" order by id  Limit 0,".page_size;
														}
														else
														{
															$current=page_size*($curpage);
															$sqlf.=" order by id  Limit " .$current. ",".page_size;
														}
													}
													else
													{
													   $sqlf.=" order by id desc Limit 0,".page_size;
													   $curpage=0;
													}
														 $resf2 = runquery1($sqlf);		
$counter = 0;
$mark = 0;

												while($rowf = mysqli_fetch_array($resf2))
												{ 
													$path = '../homework/'.$rowf['vfilename'];
											   
										?>
										<tr class="whittd" style="border-bottom:1px solid">
											<td width="40%" height="17" class="tabesubtext"><?php echo $rowf['vSubjectName'];?></td>
											<td width="60%" class="tabesubtext">
											<a href="checkhomework.php?Action=Download&file=<?php echo $rowf['vfilename'];?>">
											<?php echo $rowf['vfilename'];?></a></td>
											<td class="tabesubtext" align="center"><img border="0" src="<?php echo getIcon($rowf['vfilename'])?>"></td>
<td class="tabesubtext"><?php if($rowf['is_checked'] === '1'){ echo 'Yes';}else{ echo 'No';}?></td>
<td class="tabesubtext"><?php if($rowf['is_checked'] === '1'){ echo '<a href="grade.php?userid='.$rowf['istudent_id'].'&id='.$rowf['id'].'">Change Grade</a>';}else{ echo '<a href="grade.php?userid='.$rowf['istudent_id'].'&id='.$rowf['id'].'">Give Grade</a>';}?></td>
<td class="tabesubtext"><?php if($rowf['is_checked'] === '1'){ echo $rowf['igrade'];}else{ echo 'Not checked';} ?></td>
<td class="tabesubtext" align="center"><?php echo $rowf['submission_time'];?></td>
										</tr>
										
										<?php 	if($rowf['is_checked'] === '1'){$mark = $mark + $rowf['igrade'];		 $counter++;}	} ?>
<tr class="whittd"><td class="tabesubtext" colspan="5" align="right">Average Grade</td><td class="tabesubtext"><?php echo round($mark/$counter,2);?></td></tr>
<?php	}
												else
												{
												$exist = $exist +1;
												 }
												
												?>
											<?php }
											if($exist >0 && $exist ==$nums )
											{?>
											<tr>
												<td align="center" height="17" colspan="3" class="bodytext"><font color="#FF0000">No files uploaded</font></td>
											</tr>	
										<?php 	}
											
										}
										else
										{?>
											<tr>
												<td align="center" height="17" colspan="3" class="bodytext"><font color="#FF0000">No files uploaded</font></td>
											</tr>
										
										<?php }
									
										
								?>
									</table>
				</td></tr>
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
