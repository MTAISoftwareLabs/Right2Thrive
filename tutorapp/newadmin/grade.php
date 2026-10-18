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
function checkgradeform()
{
	grade = document.getElementById('grade').value;
	message = '';
	if(!grade){
		message = 'Please Enter Grade';
	}else if(isNaN(grade)){
		message = 'Please Enter Only Number';
	}else if((grade < 0) || (grade > 100) ){
		message = 'Please Enter Grade Between 0 to 100';
	}
	if(message){	
		document.getElementById('error').style.display="block";
		document.getElementById("error").innerHTML= message;
		
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
				

										<?php
										$sqlf = "select h.* ,s.vSubjectName  from cpo_uploadhomework as h LEFT JOIN cpo_subjectmaster AS s ON ( h.isubject_id = s.iSubjectId ) where  h.id='".$_REQUEST['id']."'";
										$resf = runquery1($sqlf);
										$counthu = mysqli_num_rows($resf);
										if($counthu >0 )
										{													
												while($rowf = mysqli_fetch_array($resf))
												{
													$subjectname = $rowf['vSubjectName'];
													$filename = $rowf['vfilename'];
													$submission_time = $rowf['submission_time'];
													$grade =  $rowf['igrade'] ;
													$checked = $rowf['is_checked'] ;
													$homeword_id = $rowf['id'];
													}
										}
										?>
										<form action="checkhomework.php?userid=<?php echo $userid;?>" method="post">
										<table width="80%" align="center">
										<tr>
											<td align="center" colspan="2"><b><?php if($checked == '1'){ echo 'Update Grade';}else{ echo 'Assign Grade';}?></b></td>
										</tr>
										<tr>
											<td   colspan="2" height="17" class="lighttd2" align="center"><span id="error" style="display:none;color:red;"></span></td>
										</tr>
										<tr>
											<td width="50%" height="17" class="lighttd2" align="right"><b>Subject</b></td>
											<td class="lighttd2" align="left" style="margin-left:10px;"><?php echo $subjectname; ?></td>
										</tr>
										<tr>
											<td width="50%" class="lighttd2"  align="right"><b>FileName</b></td>
											<td class="lighttd2" align="left" style="margin-left:10px;"><?php echo $filename; ?></td>
										</tr>
										<tr>
											<td width="50%" class="lighttd2"  align="right"><b>Submission time</b></td>
											<td  class="lighttd2" align="left" style="margin-left:10px;"><?php echo $submission_time;?></td>
										</tr>
										<tr>
											<td width="50%" class="lighttd2"  align="right"><b>Grade</b></td>
											<td  class="lighttd2" align="left" style="margin-left:10px;"><input type="text" id="grade" name="grade" value="<?php if($checked== '1'){ echo $grade;}?>"></td>
										</tr>
										<tr>
											<input type="hidden" name="homeword_id" value="<?php echo $homeword_id;?>">
											<td  width="50%" class="lighttd2"  align="right"><input type="submit" name="grade1" value="Ok" onclick="return checkgradeform();"></td>
											<td><a style="text-decoration:none;" href="checkhomework.php?userid=<?php echo $userid;?>"><input type="button" value="Cancel"></a></td>
										</tr>
										</table>
										</form>
										
										
									
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

</body>
</html>
