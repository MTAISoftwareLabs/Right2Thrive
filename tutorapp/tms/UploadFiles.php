<?php
header("Location: ../tmsnew/career_progress.php");
exit;
include "dbConnection.php";

if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
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
		case "pdf" : 
			return "../lms/images/pdf.gif";								
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
<title><?php echo sitename;?>Learner Uploaded Files</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function submitpage()
{
	if (document.FRMUPLOAD.CMBLEARNER.value != "0")
	{
		document.FRMUPLOAD.action = "UploadFiles.php?next=1";
		document.FRMUPLOAD.submit();
	}	
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
	<form name="FRMUPLOAD" method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr><td>&nbsp;</td></tr>	
        <?php
			$sqllearner = "select distinct um.iUserId,um.vUserName from cpo_usermaster um,cpo_usercourse uc where vTutorId like '%".$_SESSION['user_id']."%' and um.iUserId=uc.iUserId";
			$rslearner = runquery($sqllearner);
			$num = $rslearner ? mysqli_num_rows($rslearner) : 0 ; ?>
			<tr>
				<td align="center" class="bodytext"> Select Learner    
					<select name="CMBLEARNER" class="textbox" onChange="submitpage()">
						<option value="0">Select Learner</option>
			
		<?php	$uid = 0;
			if (isset($_POST['CMBLEARNER']))
			{
				$uid = $_POST['CMBLEARNER'];
			}
			if ($num > 0)
			{ 
				$i = 0;
				while ($rsdata = mysqli_fetch_array($rslearner))
				{ 
					if ($i == 0 && !isset($_POST['CMBLEARNER']))
					{
						$uid = $rsdata['iUserId'];
					}
					$i++;
					?>
					<option value="<?php echo $rsdata['iUserId']?>" <?php if ($uid == $rsdata['iUserId']) {?> selected <?php } ?>><?php echo $rsdata['vUserName']?></option>
				<?php }
			 }
		?>
				</select>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<?php
		
//			if (isset($_GET['next']) && $_GET['next'] == 1)
	//		{
				$sqlfiles = "SELECT * FROM cpo_ind_review WHERE iTutorId = " .$uid." and file_type is null";
				

				$rsfiles = runquery($sqlfiles);
// 				var_dump(mysqli_fetch_array($rsfiles));
// exit;
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ 		?>
				<tr>
					<td>
					  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr> 
							<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
							<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr> 
								  <td class="welcome">Uploaded Files</td>
								  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
								</tr>
							  </table></td>
							<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
						  </tr>
						  <tr> 
							
						  <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
							  <table width="90%" align="center">
										<tr><td colspan="3" class="bodytext">Uploaded Files :</td></tr>
										
											<?php
											while($rsdata = mysqli_fetch_array($rsfiles))
											{ 
												$ext = "doc";												
												$path = "https://www.right2thrive.org/app21/lms/uploads/".$rsdata['iIndId'].'.'.$ext;
											?>
												<tr>
													<td class="bodytext" width="40%"><font color="#FF0000"><a target="_blank" href="<?php echo $path;?>"><?php echo $path;?></a></font></td>
													<td width="35%" class="bodytext"><?php echo gdate($rsdata['dDate']);?></td>
													<td width="25%" class="bodytext" align="center"><a target="_blank" href="<?php echo $path;?>"><img border="0`"src="<?php echo getIcon($path)?>"></a></td>
												</tr>
												<tr><td colspan="3"><hr width="100%"></td></tr>
										<?php 	} ?>
									<tr><td colspan="3" height="10"></td></tr>
							  </table>
						  </td>
						  </tr>
						  <tr> 
							<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
							<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"> 
						  </div></td>
							<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
						  </tr>
						  <tr><td>&nbsp;</td></tr>
						</table>
					</td>
				</tr>
			<?php
				}
				else
				{ ?>
				<tr>
					<td>
					  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr> 
							<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
							<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr> 
								  <td class="welcome">Uploaded Files</td>
								  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
								</tr>
							  </table></td>
							<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;</td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><b>No Files Uploaded.</b></td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;</td>
						  </tr>						  
						  <tr> 
							<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
							<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"> 
						  </div></td>
							<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
						  </tr>
						</table>
					</td>
				</tr>
				
				<?php }
			//}
			//else
			//{ ?>
<!--				<tr>
					<td>
					  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr> 
							<td width="11"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
							<td width="493" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr> 
								  <td class="welcome">Uploaded Files</td>
								  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
								</tr>
							  </table></td>
							<td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;</td>
						  </tr>
						  <tr> 
							<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
							<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"> 
						  </div></td>
							<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
						  </tr>
						</table>
					</td>
				</tr> -->
			<?php //}
			?>
      </table>
	  </form></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>

</html>
