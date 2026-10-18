<?
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
<title><? echo sitename;?>Upload files</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function getconfirm()
{	
	return(confirm("Are you sure you want to delete this file?"));

}
function validation()
{
	if (document.FRMUPLOADFILE.FLUPFILE.value == "")
	{
		alert("Please select file !");
		return false;
	}
	flag = 0;	
	file = document.FRMUPLOADFILE.FLUPFILE.value.split("\\"); 
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
			document.FRMUPLOADFILE.FLUPFILE.value = "";
			return false;
		}	
	}		
	return true;
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
      <? include "leftpanel.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
  </tr>
  <tr> 
    <td valign="top">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#AFE0FA">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td> 
            <form name="FRMUPLOADFILE" method="post" onSubmit="return validation();" action="UploadFiles.php?next=1"  enctype="multipart/form-data">			
			  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
				  <tr> 
					<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
					<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
						  <td class="welcome">Upload Course Work</td>
						  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
						</tr>
					  </table></td>
					<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
				  </tr>
				  <tr> 
					
                  <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
					  <table class="" width="95%" align="center">
					  		<?
								//echo $_FILES['FLUPFILE']['type'];
								//exit;
								if (isset($_GET['next']) && $_GET['next'] == 1)
								{
									if (
									$_FILES['FLUPFILE']['type'] == "application/x-shockwave-flash" || 
									$_FILES['FLUPFILE']['type'] == "image/pjpeg" || 
									$_FILES['FLUPFILE']['type'] == "application/msword" || 
									$_FILES['FLUPFILE']['type']=="application/pdf" || 
									$_FILES['FLUPFILE']['type']== "image/gif" || 
									$_FILES['FLUPFILE']['type']== "application/octet-stream" || 
									$_FILES['FLUPFILE']['type']== "application/vnd.ms-powerpoint" || 
									$_FILES['FLUPFILE']['type']== "application/vnd.ms-excel" ||
									$_FILES['FLUPFILE']['type']== "video/avi" ||
									$_FILES['FLUPFILE']['type']== "video/mpeg"
									)
									{
										//echo "./upload/".$_SESSION['user_name'].$_SESSION['user_id']."/".$_FILES['FLUPFILE']['name'];
										$ext = substr(strrchr($_FILES['FLUPFILE']['name'], '.'), 1);

										if (!(file_exists("./upload/".$_SESSION['user_id']."/".$_FILES['FLUPFILE']['name'])))
										{
											//echo "/".file_exists("./upload/".$_SESSION['user_name'].$_SESSION['user_id']."/".$_FILES['FLUPFILE']['name'])."/";
											$sqladd = "insert into cpo_uploadfiles (iUserId,vFilePath,vUploadDate) values (".$_SESSION['user_id'].",'".ereg_replace('\'','',$_FILES['FLUPFILE']['name'])."','".date("Y-m-d")."')";
											runquery($sqladd);
										}
									 	if (!file_exists("./upload/".$_SESSION['user_id']))
											mkdir("./upload/".$_SESSION['user_id'],0755);
										//move_uploaded_file($_FILES['FLUPFILE']['tmp_name'],"./upload/".$_SESSION['user_id']."/".mysqli_insert_id().".".$ext);
										
										$uploaddir = '/home/careerp/public_html/lms/upload/'.$_SESSION['user_id'].'/';
										$uploadfile = $uploaddir.mysqli_insert_id().".".$ext;

										move_uploaded_file($_FILES['FLUPFILE']['tmp_name'],$uploadfile);

										//echo mysqli_insert_id().".".$ext
										addlog(10);
									}	
								}	
								$sqlfiles = "select vFilePath from cpo_uploadfiles where iUserId=".$_SESSION['user_id'];
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
							?>
					  		<tr>
								<td class="bodytext">&nbsp;Upload File<INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="200000000"></td>
								<td class="bodytext"><input type="file" name="FLUPFILE" id="FLUPFILE" class="textbox" size="50"></td>
							</tr>		
							<tr><td colspan="2" height="10" class="bodytext" align="center"><font color="red">(Only *.pdf, *.doc, *.xls, *.ppt, *.swf, *.gif, *.jpeg, *.avi, *.mpeg files can upload)</font></td></tr>
					  </table>                  </td>
				  </tr>
				  <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input name="image" type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
				
				</table>
				</form>		  	</td>
		</tr>
		<?
			$sqlfiles = "select vFilePath,vUploadDate,iFileId from cpo_uploadfiles where iUserId=".$_SESSION['user_id']." order by vUploadDate desc";
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
						  <td class="welcome">Uploaded  Course Work</td>
						  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
						</tr>
					  </table></td>
					<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
				  </tr>
				  <tr> 
                  <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
					  <table width="99%" align="center">
                    <tr>
                      <td colspan="4" class="bodytext"><b>Uploaded Files :</b></td>
                    </tr>
					<tr>
                      <td colspan="4"  height="5"><hr width="100%"></td>
                    </tr>
                    <?
									while($rsdata = mysqli_fetch_array($rsfiles))
									{ 
									   	$ext = substr(strrchr($rsdata['vFilePath'], '.'), 1);
									   
										$path = "./upload/".$_SESSION['user_id']."/".$rsdata['iFileId'].".".$ext;
									?>
                    <tr> 
                      <td class="bodytext" width="52%"><font color="#FF0000"><a href="<? echo $path;?>" target="_blank"><? echo $rsdata['vFilePath'];?></a></font></td>
                      <td width="25%" class="bodytext"><? echo gdate($rsdata['vUploadDate']);?></td>
                      <td width="10%" class="bodytext" align="center"><a target="_blank" href="<? echo $path;?>"><img border="0" src="<? echo getIcon($rsdata['vFilePath'])?>"></a></td>
                      <td width="13%" class="bodytext" align="center">&nbsp;<a href="UpFilesDeleted.php?id=<? echo $rsdata['iFileId'] ;?>"><img src="images/delete.gif" style="cursor:hand" border="0" onClick="return getconfirm(<? echo $rsdata['iFileId'] ;?>)"></a></td>
                    </tr>
                    <tr>
                      <td colspan="4"  height="5"><hr width="100%"></td>
                    </tr>
                    <? 	} ?>
                    <tr>
                      <td colspan="4" height="10"></td>
                    </tr>
                  </table>                  </td>
				  </tr>
				  <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg">&nbsp;</td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
				</table>			</td>
		</tr>
		
		<?
		}
		?>
        <tr>
		  <td><div align="right"><strong><a href="javascript:history.back();" class="textlink">Back</a></strong></div></td>
	    </tr>
    </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>