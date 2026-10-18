<?
include_once 'dbConnection.php';
if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
$getct = isset($_GET['ct'])?$_GET['ct']:'';
if($getct=='')
{
	$fetch1="select I_user_subid,I_subjectid  from cpo_user_subject where I_studentid=".$_SESSION['user_id']." order by I_subjectid" ;
	$result1=runquery1($fetch1);
	$count1=mysqli_num_rows($result1);
	if($count1 > 0)
	{
		while($row1=mysqli_fetch_array($result1))
		{
				$name=mysqli_result($result1,0,0);
				$getct=$row1['I_subjectid'];
				
				break;								
																
		}
	}
//echo $sqlcourse;
}
else
{
	
}
if(isset($_GET['Action']) && $_GET['Action'] =='Download')
{
	$speed = 100;
	$export_file = "../lesson/".$_REQUEST['file'];
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
$currentpage = $_GET['curpage'];
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
	$_FILES['TXFILE']['type']== "video/mpeg"
	)
	{
		$subject = $_POST['hdn_subject'];
		$fname = $_FILES['TXFILE']['name'];
		$ins = "insert into cpo_uploadlesson (isubject_id,istudent_id,vfilename,vUploadDate) values (".$subject.",".$user_id.",'".$fname."','".date("Y-m-d")."')";
		runquery1($ins);
		//$ext = substr(strrchr($_FILES['TXFILE']['name'], '.'), 1);
		$filename = $_FILES['TXFILE']['name'];

		$uploaddir ='../lesson/';
		//$uploaddir = '/home/careerp/public_html/admin/adminupload/';
		//echo $_FILES['FLUPFILE']['tmp_name']; exit;
		$uploadfile = $uploaddir.$filename;
		//echo $uploadfile;exit;
		if(move_uploaded_file($_FILES['TXFILE']['tmp_name'],$uploadfile))
		{	
			$upload = "File Uploaded Successfully !";
		}
		else
		{
			$upload = "Here is some more debugging info:";
		}
	}
	else
	{
		$upload = "";		
	}
}
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "../lms/images/swf.gif";
			break;
		case "doc" : 
			return "../lms/images/doc.gif";
			break;			
		case "jpg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "peg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "gif" : 
			return "../lms/images/gif.gif";
			break;
		case "xls" : 
			return "../lms/images/xls.gif";								
			break;
		case "pdf" : 
			return "../lms/images/pdf.gif";								
			break;
		case "ppt" : 
			return "../lms/images/ppt.gif";								
			break;
		case "avi" : 
			return "images/avi.gif";								
			break;
		case "mpg" : 
			return "images/mpeg.gif";								
			break;
		default : 
			return "../lms/images/gif.gif";				
			break;			
	}
}
?>
<html>
<head>
<title><? echo sitename?> Lessons</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
function uploaddfile(cpage,ct)
{
	if (document.frmex.TXFILE.value == "")
	{
		alert("First select file !")
		return false;
	}
	else
	{
		if (ct != 0)
			document.frmex.action ='lefolder.php?next=1&curpage='+cpage+'&ct='+ct;
		else
			document.frmex.action ='lefolder.php?next=1&curpage='+cpage;		
		document.frmex.submit();
	}	
}
</script>
<style>
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
</style>
</head>
<body>
<pre>&nbsp;</pre>
<table width="857"  cellspacing="0" cellpadding="0">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<form name="frmex" method="post" enctype="multipart/form-data">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">

  <tr> 
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF"> 
      <? include "leftpanel.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top">
	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td width="100%">
				<table width="86%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="60%">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
							<?
							$selsub="select s.iSubjectId, s.vSubjectName,u.I_subjectid  from  cpo_subjectmaster as s, cpo_user_subject as u where s.iSubjectId=u.I_subjectid  and  I_studentid=".$_SESSION['user_id']." group by I_subjectid order by  s.iSubjectId" ;
							$ressub = runquery1($selsub);
							$count = mysqli_num_rows($ressub);
							if($count > 0)
							{
							$div = $count/6;
								for($i=0;$i<=round($div);$i++)
								{
									$display_result .="<tr>";
									for($j=0;$j<6;$j++)
									{
										$rowsub = mysqli_fetch_array($ressub);
										if($rowsub['vSubjectName'])
										{
											if($getct == '' && $j==0 && $i==0 )
											{?>
							  <td >
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle" nowrap="nowrap"><?php echo $rowsub['vSubjectName'];?></td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>
							 </td>
									<? 		}
											elseif($getct != '' && $rowsub['iSubjectId'] == $getct)
											{ ?>
							 <td >
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle"  nowrap="nowrap"><?php echo $rowsub['vSubjectName'];?></td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>
							 </td>
							<?				}
											else
											{ ?>
												 <td>
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="1%"></td>
									<td width="98%" class="tebmid" align="center" valign="middle" nowrap="nowrap" onMouseOver="className='actbg'" onMouseOut="className='tebmid'"><a href="lefolder.php?ct=<?php echo $rowsub['iSubjectId'];?>"><?php echo $rowsub['vSubjectName'];?> </a></td>
									<td width="1%" ></td>
								</tr>
							 </table>
							 </td>
											<? }
										}
									}?>
							  </tr>
								<? }
							}else{ ?>
							<tr>
							<td width="20%">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="0%" align="right"><img src="images/leftac.gif" alt="" border="0"></td>
									<td width="100%" class="tebmidac" align="center" valign="middle" nowrap="nowrap">No Subject Assigned</td>
									<td width="0%" align="left5"><img src="images/righcornac.gif" alt="" border=""></td>
								</tr>
							 </table>
							 </td>
							 <td width="80%"></td>
							</tr>
							<? }?>
						  </table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
        	<td width="100%" class="tabelbor">
            	<table width="100%" cellpadding="0" cellspacing="0">
                	<tr>
							<td valign="top" colspan="4">
								<table>
									<tr>											
										<td ></td>

										<td class="tabesubtextb"><a href="sub_lesson.php?ct=<? echo $getct;?>" ><b>Back</b></a></td>
									</tr>
								</table>
							</td>		
					  </tr>
						
						<tr id="showhomework" >
									<td  valign="top" colspan="4" class="tabesubtextb" height="35">
									<? 
									if($count > 0){
									?>
									<table width="100%"  >
									
										<tr> 
										  <td width="46%" colspan="2" height="30"  align="right" class="bodytext">&nbsp;Upload File&nbsp;&nbsp;</td>
										  <td width="54%" colspan="4">&nbsp;&nbsp; <input type="file" name="TXFILE" class="textbox"><input type="hidden" value="<? echo $getct;?>" name="hdn_subject" accept=""></td>
										</tr>
										<tr> 
											  <td  align="right" colspan="2" height="30">&nbsp;&nbsp;&nbsp;</td>
											  <td colspan="4">&nbsp;&nbsp;<a href="#" onClick="uploaddfile('<? echo $currentpage?>','<? echo $getct;?>')" ><img style="cursor:hand" src="images/upload.gif"  align="absmiddle" border="0"></a>	
											  </td>
									  </tr>
											<tr> 
                  <td colspan="6" align="center" height="20" class="bodytext"><font color="red">(Only *.pdf, *.doc, *.xls, *.ppt, *.swf, *.gif, *.jpeg, *.avi, *.mpeg files can upload)</font></td>
                </tr>
									</table>
									<table width="100%">
										<tr>
											<td width="46%" height="17" class="tabesubtext"><b>Subject</b></td>
											<td width="16%" class="tabesubtext"><b>FileName</b></td>
											<td width="16%" class="tabesubtext"><b>Type</b></td>
										</tr>
										<?
										
										$sqls = "select I_tutorid from cpo_user_subject where I_studentid=".$user_id." and I_subjectid=".$getct;
										$ress = runquery1($sqls);
										$nums = mysqli_num_rows($ress);
										if($nums)
										{
											while($rows = mysqli_fetch_array($ress))
											{
												
													$sqlf = "select h.* ,s.vSubjectName  from cpo_subjectmaster s,cpo_uploadlesson as h where (h.itutor_id=".$rows['I_tutorid']." || h.istudent_id=".$user_id." ) and h.isubject_id=".$getct." and s.iSubjectId=".$getct;
												
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
												while($rowf = mysqli_fetch_array($resf2))
												{ 
											   
										?>
										<tr>
											<td width="40%" height="17" class="tabesubtext"><b><?php echo $rowf['vSubjectName'];?></b></td>
											<td width="60%" class="tabesubtext">
											<a href="lefolder.php?Action=Download&file=<?php echo $rowf['vfilename'];?>">
											<b><?php echo $rowf['vfilename'];?></b></a></td>
											<td class="tabesubtext" align="left"><img border="0" src="<? echo getIcon($rowf['vfilename'])?>"></td>
										</tr>
										
										<? 		} //while in
											}
											else 
											{?>
												<tr>
													<td align="center" height="17" colspan="3" class="bodytext"><font color="#FF0000">No files uploaded</font></td>
												</tr>
												
											<? }
										?>
											<? }
											
										}
										
								} //get ct not null ?>
									</table>
									</td>
					  </tr>
				
					
					<tr> 
                        <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td width="96%" background="images/changebttm_center_cor.jpg">
							  	<div align="right" class="bodytext"><?	if($page>1){ 
												echo "Page : ";
											 for($i=1;$i<=$page;$i++)
											 {
												if($i==($curpage+1))
												{
											 ?>
												<b><? echo $i?></b>
											 <?
												}
												else
												{
													$str="";
											?>
												<a href="lefolder.php?ct=<?=$getct?>&curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
											 <?
												}									
											 }}?>&nbsp;&nbsp;</div>
							  </td>
                              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table></td>
                      </tr>
                </table>
            </td>
        </tr>
	</table>
			</td>
		</tr>
    </table>
	
	  </td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
      <? include "includebottom.php";?>
</table>
</form>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
