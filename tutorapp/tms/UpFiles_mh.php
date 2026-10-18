<?php
	header("Location: ../tmsnew/career_progress.php");
	exit;
	include "dbConnection.php";
	ini_set('display_errors', "Of");
	if (!isset($_SESSION['user_id']))
	{
		header("Location:../user_login.php");
	}

	function getlearnernames($ids)
	{
		$strnames = '';
		if($ids)
		{
			$strids = explode(',',$ids);
			for($i=0;$i<count($strids);$i++)
			{
				$sqlselect = "select vUserName from cpo_usermaster where iUserId=".$strids[$i];
				//echo $sqlselect.'<br>';
				$rssqlselect = runquery($sqlselect);
				if(isset($rssqlselect))
				{
					$rssqlselect1 = mysqli_fetch_array($rssqlselect);
					$strnames = $strnames.$rssqlselect1[0].' , ';
				}
			}
			$strnames = substr($strnames,0,strlen($strnames)-2);
		}

		return $strnames;
	}

	function getIcon($filename)
	{
		switch(substr($filename,strlen($filename)-3,strlen($filename)))
		{
			case "swf" : 
				return "images/swf.gif";
				break;
			case "doc" : 
				return "images/doc.gif";
				break;
			case "jpg" :
				return "images/jpg.gif";
				break;
			case "peg" :
				return "images/jpg.gif";
				break;
			case "gif" :
				return "images/gif.gif";
				break;
			case "pdf" :
				return "images/pdf.gif";
				break;
			case "ppt" :
				return "images/ppt.gif";
				break;
			case "xls" :
				return "images/xls.gif";
				break;
			case "avi" :
				return "images/avi.gif";
				break;
			case "mpg" :
				return "images/mpeg.gif";
				break;
			default :
				return "images/gif.gif";
				break;
		}
	}
?>
<html>
	<head>
		<title><?php echo sitename;?>Upload files</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="tms.css" rel="stylesheet" type="text/css">
		<script language="JavaScript">
			function getconfirm()
			{
				return(confirm("Are you sure you want to delete this file?"));
			}
			
			function validation()
			{
				if (document.FRMUPLOADFILE.userfile.value == "")
				{
					alert("Please select file !");
					return false;
				}
				flag = 0;
				file = document.FRMUPLOADFILE.userfile.value.split("\\");
				for(var j = 0; j<files.length; j++)
				{
					if (files[j][1] == file[file.length-1])
					{
						flag = 1;
					}
				}
				if (flag == 1)
				{
					var cn = confirm("File already uploaded ! Do you want to overwrite");
					if (cn)
					{
						return true;
					}
					else
					{
						document.FRMUPLOADFILE.userfile.value = "";
						return false;
					}
				}
				return true;
			}
		</script>
	</head>
	<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
			<tr>
				<td colspan="2" valign="top"><?php include "includetop.php";?></td>
			</tr>
			<tr>
				<td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
					<?php include "includeleft.php";?>
				</td>
				<td valign="top">
					<?php include "includewelcome.php";?>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<form name="FRMUPLOADFILE" enctype="multipart/form-data" method="POST" onSubmit="return validation();" action="UpFiles_mh.php?next=1">
									<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
											<td width="96%" background="images/changep_center_cor.jpg">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td class="welcome">Upload Care Plan</td>
														<td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
													</tr>
												</table>
											</td>
											<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
										</tr>
										<tr>
											<td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
												<table class="" width="94%" align="center">
													<?php
														if(isset($_GET['next']) && $_GET['next'] == 1)
														{
															$val = 0;
															if(isset($_POST['CMBLEARNER']) && count($_POST['CMBLEARNER']) < 1)
															{
																?>
																<script language="JavaScript">alert('Please select learner first');document.location = "UpFiles.php";</script>
																<?php
																//header("Location:UpFiles.php");
																//exit;
															}
															if ($_FILES['userfile']['type'] == "application/x-shockwave-flash" || 
																$_FILES['userfile']['type'] == "image/pjpeg" || 
																$_FILES['userfile']['type'] == "application/msword" || 
																$_FILES['userfile']['type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || 
																$_FILES['userfile']['type']=="application/pdf" || 
																$_FILES['userfile']['type']== "image/gif" || 
																$_FILES['userfile']['type']== "application/octet-stream" || 
																$_FILES['userfile']['type']== "application/vnd.ms-powerpoint" || 
																$_FILES['userfile']['type']== "application/vnd.ms-excel" ||
																$_FILES['userfile']['type']== "video/avi" ||
																$_FILES['userfile']['type']== "video/mpeg")
															{
																//echo "./upload/".$_SESSION['user_name'].$_SESSION['user_id']."/".$_FILES['userfile']['name'];
																if (!(file_exists("./upload/".$_SESSION['user_id']."/".$_FILES['userfile']['name'])))
																{
																	//echo "/".file_exists("./upload/".$_SESSION['user_name'].$_SESSION['user_id']."/".$_FILES['userfile']['name'])."/";
																}
																if (!file_exists("./upload/".$_SESSION['user_id']))
																	mkdir("./upload/".$_SESSION['user_id'],0755);
																//move_uploaded_file($_FILES['FLUPFILE']['tmp_name'],"./upload/".$_SESSION['user_id']."/".$_FILES['userfile']['name']);
																//$uploaddir = './upload/'.$_SESSION['user_id'].'/';
																//$uploaddir = '/home/careerp/public_html/tms/upload/'.$_SESSION['user_id'].'/';
																$uploaddir = './upload/'.$_SESSION['user_id'].'/';
																$uploadfile = $uploaddir . $_FILES['userfile']['name'];
																move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);
																//print_r($_FILES);
																$UserId='';
																foreach($_POST['CMBLEARNER'] as $value)
																{
																	$UserId = $UserId.$value .",";
																}
																$UserId = substr($UserId,0,strlen($UserId)-1);
																//$sqladd = "insert into cpo_uploadfilestutor(iUserId,iTutorId,vFilePath,vUploadDate,file_type) values ('".$UserId."',".$_SESSION['user_id'].",'".$_FILES['userfile']['name']."','".date("Y-m-d")."','mh_upload')";
																$sqladd = "insert into cpo_uploadfilestutor(iUserId,iTutorId,vFilePath,vUploadDate,file_type) values ('".$UserId."',".$_SESSION['user_id'].",'".$_FILES['userfile']['name']."','".date("Y-m-d")."','mh_upload')";
																runquery($sqladd);
																$qry = "select max(iFileId) from cpo_uploadfilestutor";
																$rsqry = runquery($qry);
																$num = isset($rsqry)?mysqli_num_rows($rsqry):0;
																if($num>0)
																{
																	$resqry = mysqli_fetch_array($rsqry);
																	$iFileId = $resqry[0];
																	foreach($_POST['CMBLEARNER'] as $value)
																	{
																		$sqladdnew = "insert into cpo_uploadfilesviewed (iFileId, iUserId) values (".$iFileId.",".$value.")";
																		runquery($sqladdnew);
																	}
																}
															}
														}
														$sqlfiles = "select vFilePath from cpo_uploadfilestutor where iTutorId=".$_SESSION['user_id']." and file_type='mh_upload'";
														$rsfiles = runquery($sqlfiles);
														echo "<script language='JavaScript'>var files = [];";
														$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
														if ( $num > 0 )
														{
															$i = 0;
															while($rsdata = mysqli_fetch_array($rsfiles))
															{
																echo "files[".$i."]= new Array(2);";
																echo "files[".$i."][0]= 0;";
																echo "files[".$i."][1]= '".$rsdata['vFilePath']."';";
															}
														}
														echo "</script>";
														$sqllearner = "select iUserId,vUserName from cpo_usermaster ";
														$rslearner = runquery($sqllearner);
														$num = $rslearner ? mysqli_num_rows($rslearner) : 0 ; 
													?>
													<tr>
														<td class="bodytext">&nbsp;Select Learner</td>
														<td class="bodytext">
															<select name=CMBLEARNER[] class="textbox" multiple>
																<?php
																	while ($rsdata = mysqli_fetch_array($rslearner))
																	{
																		?>
																		<option value="<?php echo $rsdata['iUserId'];?>"><?php echo $rsdata['vUserName'];?></option>
																		<?php
																	}
																?>
															</select>
														</td>
													</tr>
													<tr>
														<td class="bodytext">&nbsp;Upload File</td>
														<td class="bodytext"><input type="file" name="userfile" id="userfile" class="textbox" size="50"></td>
													</tr>
													<tr><td colspan="2" height="10" class="bodytext" align="center"><font color="red">(Only *.pdf, *.doc, *.xls, *.ppt, *.swf, *.gif, *.jpeg, *.avi, *.mpeg files can upload)</font></td></tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
											<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
												<input name="image" type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">
											</div></td>
											<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
										</tr>
										<tr><td>&nbsp;</td></tr>
									</table>
								</form>
							</td>
						</tr>
						<?php
							$sqlfiles = "select vFilePath,vUploadDate,iFileId,iUserId from cpo_uploadfilestutor where iTutorId=".$_SESSION['user_id']." and file_type='mh_upload' order by vUploadDate desc";
							$rsfiles = runquery($sqlfiles);
							$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
							if ( $num > 0 )
							{
								?>
								<tr>
									<td>
										<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
												<td width="96%" background="images/changep_center_cor.jpg">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="welcome">Uploaded Files</td>
															<td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
														</tr>
													</table>
												</td>
												<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
											</tr>
											<tr>
												<td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
													<table width="99%" align="center">
														<tr>
															<td colspan="5" class="bodytext"><b>Uploaded Files :</b></td>
														</tr>
														<tr>
															<td colspan="5" height="5"><hr width="100%"></td>
														</tr>
														<?php
															while($rsdata = mysqli_fetch_array($rsfiles))
															{
																$path = "./upload/".$_SESSION['user_id']."/".$rsdata['vFilePath'];
																?>
																<tr>
																	<td class="bodytext"><font color="#FF0000"><a target="_blank" href="<?php echo $path;?>"><?php echo $rsdata['vFilePath'];?></a></font></td>
																	<td class="bodytext"><?php echo gdate($rsdata['vUploadDate']);?></td>
																	<td class="bodytext"></td>
																	<td class="bodytext" align="center"><a target="_blank" href="<?php echo $path;?>"><img border="0" src="<?php echo getIcon($rsdata['vFilePath']);?>"></a></td>
																	<td class="bodytext" align="center" valign="middle">&nbsp;<a href="UpFilesDeleted.php?id=<?php echo $rsdata['iFileId'] ;?>" ><img src="images/delete.gif" style="cursor:hand" border="0" onClick="return getconfirm(<?php echo $rsdata['iFileId'] ;?>)"></a></td>
																</tr>
																<tr><td class="bodytext" colspan="5"><b>Uploaded for</b> - <?php echo getlearnernames($rsdata['iUserId']);?></td></tr>
																<tr>
																	<td colspan="5" height="5"><hr width="100%"></td>
																</tr>
																<?php
															}
														?>
														<tr>
															<td colspan="5" height="10"></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
												<td height="22" background="images/changebttm_center_cor.jpg"></td>
												<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
											</tr>
										</table>
									</td>
								</tr>
								<?php
							}
						?>
					</table>
				</td>
				<td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
			</tr>
			<?php include "includebottom.php";?>
		</table>
		<map name="lms_1_r2_c2Map">
			<area shape="rect" coords="491,88,551,100" href="logout.php">
		</map>
	</body>
</html>