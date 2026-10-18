<?
include "dbConnection.php";
if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
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
			return "../lms/images/ppt.gif";								
			break;			
		case "avi" : 
			return "../lms/images/avi.gif";								
			break;
		case "mpg" : 
			return "../lms/images/mpeg.gif";								
			break;
		default : 
			return "../lms/images/gif.gif";				
			break;			
	}
}
?>
<html>
<head>
<title><? echo sitename;?>Learner Uploaded Files</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function getnewwin(obj,fid)
{
	new1=window.open("viewdownload.php?id="+obj+"&fid="+fid);
}
function submitpage()
{
	if (document.FRMUPLOAD.CMBLEARNER.value != "0")
	{
		document.FRMUPLOAD.action = "DownFiles.php?next=1&id="+document.FRMUPLOAD.CMBLEARNER.value;
		document.FRMUPLOAD.submit();
	}	
}	
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
 
  <tr> 
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF">
      <? include "leftpanel.php";?>    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>    </td>
  </tr>
  <tr> 
    <td valign="top">
	<form name="FRMUPLOAD" method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
		<tr><td height="10">&nbsp;</td></tr>
		<?		$sqlfiles = "select * from cpo_uploadfilesadmin where vsection='l' or vsection='b' order by vUploadDate desc";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ 		?>
				<tr>
					<td>
					  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
						  <tr> 
							<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
							<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr> 
								  <td class="welcome">Uploaded Files by Admin</td>
								  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
								</tr>
							  </table></td>
							<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
						  </tr>
						  <tr> 
							
						  <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
							  <table width="90%" align="center">
										<tr><td colspan="3" class="bodytext">Uploaded Files :</td></tr>
											<?
											while($rsdata = mysqli_fetch_array($rsfiles))
											{ 
												$ext = substr(strrchr($rsdata['vFilePath'], '.'), 1);
												$path = "../admin/adminupload/".$rsdata['iFileId'].".".$ext;
											?>
												<tr>
													<td class="bodytext" width="40%"><font color="#FF0000"><a target="_blank" href="<? echo $path?>" title="Download Admin Uploaded file"><? echo $rsdata['vFilePath'];?></a></font></td>
													<td width="35%" class="bodytext"><? echo gdate($rsdata['vUploadDate']);?></td>
													<td width="25%" class="bodytext" align="center"><a target="_blank" href="<? echo $path?>" title="Download Admin Uploaded file"><img border="0`"src="<? echo getIcon($rsdata['vFilePath'])?>"></a></td>
												</tr>
												<tr><td colspan="3" height="5"><hr width="100%"></td></tr>
										<? 	} ?>
									<tr><td colspan="3" height="10"></td></tr>
							  </table>						  </td>
						  </tr>
						  <tr> 
							<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
							<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"> 
						  </div></td>
							<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
						  </tr>
						</table>					</td>
				</tr>
			<?
				}
				else
				{ ?>
				<tr>
					<td>
					  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
						  <tr> 
							<td width="11"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
							<td width="493" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr> 
								  <td class="welcome">Uploaded Files by Admin</td>
								  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
								</tr>
							  </table></td>
							<td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;</td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext">No Files Uploaded</td>
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
						</table>					</td>
				</tr>
			
				
				<? }
			//}
			//else
			//{ ?>
            	<tr>
				  <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
		  </tr>
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
			<? //}
			?>
      </table>
	  </form></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
   
 <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>

</html>
